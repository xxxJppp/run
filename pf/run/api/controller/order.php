<?php

namespace xh\run\api\controller;

use xh\library\functions;
use xh\library\request;
use xh\unity\callbacks;
use xh\unity\page;
use xh\unity\upload;

require_once __DIR__ . '/common.php';

class order extends common
{

    public function __construct()
    {
        parent::__construct();
    }

    public function automaticOrder()
    {

        $type = request::filter('post.type');
        $where = "user_id={$this->user['id']}";
        if ($type) {
            $where .= " and status={$type}";
        }
        $result = page::conduct('client_paofen_automatic_orders', request::filter('get.page'), 15, $where, 'id,trade_no,creation_time,amount,status', 'id', 'desc');

        foreach ($result['result'] as &$v) {
            $v['creation_time'] = date('Y-m-d H:i:s', $v['creation_time']);
            $v['status_name'] = $v['status'] == 2 ? '未支付' : ($v['status'] == 3 ? '订单超时' : '已支付');
        }
        functions::json(1, '获取成功', $result['result']);
    }

    public function orderDetails()
    {
        $order_id = request::filter('post.id');
        if (empty($order_id)) functions::json(0, '订单ID错误');
        $order = $this->mysql->query('client_paofen_automatic_orders', "id={$order_id} and user_id={$this->user['id']}", 'paofen_id,status,trade_no,amount,creation_time', null, 'desc', 1);
        if (!isset($order[0])) functions::json(0, '当前订单不存在');
        $order = $order[0];
        $account = $this->mysql->query("client_paofen_automatic_account", "id={$order['paofen_id']}", 'name,ewm_url')[0];
        $shenshu = $this->mysql->query("appeal", "trade_no={$order['trade_no']}", 'audit')[0];
        $order['creation_time'] = date('Y-m-d H:i:s', $order['creation_time']);
        $order['type'] = '支付宝';
        $order['account'] = $account['name'];
        $order['qrcode'] = $account['ewm_url'];
        if ($order['status'] == 1) {
            $order['status_name'] = '等待下发支付二维码';
        } else if ($order['status'] == 2) {
            $order['status_name'] = '未支付';
        } else if ($order['status'] == 3) {
            $order['status_name'] = '订单超时';
        } else if ($order['status'] == 4) {
            $order['status_name'] = '已支付';
        }

        if ($shenshu) {
            $appeal = [];
            $appeal[0] = '未审核';
            $appeal[1] = '已审核';
            $appeal[2] = '已驳回';
            $appeal[3] = '处理中';

            $order['appeal'] = $shenshu[0]['audit'];
            $order['appeal_name'] = $appeal[$order['appeal']];
        } else {
            $order['appeal'] = '';
            $order['appeal_name'] = '立即申诉';
        }
        functions::json(1, '请求成功', $order);
    }


    public function reissue()
    {
        $module_name = 'paofen_auto';
        $order_id = request::filter('post.id');
        if (empty($order_id)) functions::json(0, '订单ID错误');
        $order = $this->mysql->query('client_paofen_automatic_orders', "id={$order_id} and user_id={$this->user['id']}")[0];
        if (!is_array($order)) functions::json(0, '当前订单不存在');

        if($order['status'] == 4){
            functions::json(0, '该订单已完成');
        }
        $user = $this->mysql->query("client_user", "id={$this->user['id']}")[0];

        if (!is_array($user)) functions::json(0, '商户错误');
        //得到用户组
        $group = $this->mysql->query('client_group', "id={$user['group_id']}");
        $group && $group = $group[0];
        //解析数据
        $authority = json_decode($group['authority'], true)[$module_name];
        if (!is_array($group) || $group['authority'] == -1 || $authority['open'] != 1) functions::json(0, '用户组错误');
        $fees = $order['amount'] * $authority['cost'];
        $puser = $this->mysql->query("client_user", "id={$order['pankou_id']}")[0];
        //盘口返佣
        $pankou = $this->mysql->query('client_group', "id={$puser['group_id']}")[0];
        $pankou_feilv = json_decode($pankou['authority'], true)[$module_name];
        $pankou_fees = $order['amount'] * $pankou_feilv['cost'];

        $agent = $this->mysql->query("client_user", "id={$user['level_id']}")[0];
        $agent_group = $this->mysql->query('client_group', "id={$agent['group_id']}")[0];
        $agent_feilv = json_decode($agent_group['authority'], true)[$module_name];
        $count_fees = $order['amount'] * $agent_feilv['cost'];
        $agent_fees = $order['amount'] * $agent_feilv['cost'] - $fees;

        $isCallback = 0;
        $this->mysql->startThings();
        if ($order['reached'] == 1) {
            $isCallback = 1;
        } else {

            $shanghu_balance = $user['balance'] + $fees; // 用户最终余额
            $user_balance = floatval($shanghu_balance);

            if ($user_balance >= 0) {
                $isCallback = 1;

                //$updateStatus = $this->mysql->update("client_user", ['balance' => $user_balance], "id={$user['id']}");
                $updateStatus = functions::user_balance($user['id'], $fees, $fees);
                $change = functions::user_balance_record($user['id'], $fees, 3, $order['id'], '码商返利', $user['balance']);
                if ($updateStatus === false || $change === false) {
                    $this->mysql->rollBack();
                    functions::json(0, '回调失败');
                }

                $this->user['balance'] = $user_balance;
                $erweima = $this->mysql->update("client_paofen_automatic_account", ['bind_uid' => ''], "id={$order['paofen_id']}");
                $deposit = $this->mysql->query("deposit", "order_id={$order['id']} and user_id={$this->user['id']}")[0];
                if (!is_array($deposit)) {
                    if ($order['status'] == 3) {
                        $bac = $this->mysql->query("client_user", "id={$this->user['id']}")[0];
                        $yue = $bac['balance'] - $order['amount'];
                        //$this->mysql->update("client_user",['balance'=>$yue],"id={$this->user['id']}");
                        $user_dongjie = functions::user_balance($user['id'], '-' . $order['amount']);
                        $chang = functions::user_balance_record($user['id'], '-' . $order['amount'], 5, $order['id'], '超时订单确认收款扣除', $bac['balance']);
                        if ($user_dongjie === false || $chang === false) {
                            $this->mysql->rollBack();
                            functions::json(0, '回调失败1');
                        }
                    }
                } else {
                    $del_deposit = $this->mysql->delete("deposit", "user_id={$order['user_id']} and order_id={$order['id']}");
                    if (!$del_deposit) {
                        $this->mysql->rollBack();
                        functions::json(0, '回调失败0');
                    }
                }

                $order_up = $this->mysql->update("client_paofen_automatic_orders", ['reached' => 1], "id={$order['id']}");
                if (!$order_up) {
                    $this->mysql->rollBack();
                    functions::json(0, '回调失败2');
                }

            } else {
                functions::json(0, '账户余额不足，回调失败');
            }
        }

        //检测订单是否为未支付
        if ($order['status'] != 4) {
            $update_order = $this->mysql->update("client_paofen_automatic_orders", [
                'pay_time' => time(),
                'status' => 4,
                'callback_time' => time(),
                'callback_status' => 1,
                'callback_content' => '商户后台回调',
                'reached' => 1
            ], "id={$order['id']}");
        } else {
            $update_order = $this->mysql->update("client_paofen_automatic_orders", [
                'callback_time' => time(),
                'callback_status' => 1,
                'callback_content' => '商户后台回调',
                'reached' => 1
            ], "id={$order['id']}");
        }
        if (!$update_order) {
            $this->mysql->rollBack();
            functions::json(0, '回调失败3');
        }
        if ($isCallback == 1) {
            $pay_time = $order['pay_time'] == 0 ? time() : $order['pay_time'];

            $result = callbacks::curl($order['callback_url'], http_build_query([
                'account_name' => $this->user['username'],
                'pay_time' => $pay_time,
                'status' => 'success',
                'amount' => $order['amount'],
                'out_trade_no' => $order['out_trade_no'],
                'trade_no' => $order['trade_no'],
                'fees' => $fees,
                'sign' => functions::sign($puser['key_id'], [
                    'amount' => $order['amount'],
                    'out_trade_no' => $order['out_trade_no']
                ]),
                'callback_time' => time(),
                'type' => 1,
                'account_key' => $puser['key_id']
            ]));
            $set = $this->mysql->update("client_paofen_automatic_orders", [
                'fees' => $fees,
                'agent_rate' => $agent_fees,
                'xitong_fees' => $count_fees,
                'pankou_fees' => $pankou_fees,
                'reached' => 1
            ], "id={$order['id']}");
            if (!$set) {
                $this->mysql->rollBack();
                functions::json(0, '回调失败4');
            }
        }

        $this->mysql->commit();
        functions::json(1, ' [' . date("Y/m/d H:i:s", time()) . ']: 订单号->' . $order['trade_no'] . ' 异步通知任务下发成功!');
    }


    public function addappeal()
    {


        $id = intval(request::filter('post.id'));
        $remarks = request::filter('post.remarks');
        $status = intval(request::filter('post.status'));
        $money = request::filter('post.money');

        if ($money == '') {
            functions::json(0, '请填写实际到账金额');
        }

        $result = $this->mysql->query('client_paofen_automatic_orders', 'status!=4 and id=' . $id . ' and user_id=' . $this->user['id'], 'trade_no');

        if (!$result) {
            functions::json(0, '订单信息有误');
        }

        $check_appeal = $this->mysql->query('appeal', 'trade_no=' . $result[0]['trade_no'] . ' and audit=0', 'id', null, '', 1);
        if ($check_appeal) {
            functions::json(0, '该申诉订单正在审核');
        }
        if (!isset($_FILES['file'])) {
            functions::json(0, '请上传申诉凭证');
        }

        $path = ROOT_PATH . '/web/mashang/Public/uploade/';
        $upload = (new upload())->run($_FILES['file'], $path, array('jpg', 'png'), 1000);
        if (!is_array($upload)) functions::json(0, '上传时错误,请选择一张小于1M的图片!');

        $Insert = $this->mysql->insert("appeal", [
            'trade_no' => $result[0]['trade_no'],
            'remarks' => $remarks,
            'type' => 1,
            'user_id' => $this->user['id'],
            'voucher' => '/Public/uploade/' . $upload['new'],
            'money' => $money,
            'status' => $status,
            'create_time' => time(),
        ]);
        if (!$Insert) {
            functions::json(0, '申诉请求失败');
        }
        functions::json(200, '申诉成功，等待审核');
    }
}