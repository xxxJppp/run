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

        $uid = request::filter('post.uid');
        $type = request::filter('post.type');
        $where = "user_id={$uid}";
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
        $order = $this->mysql->query('client_paofen_automatic_orders', "id={$order_id} and user_id={$this->user['id']}",'status,trade_no,amount,creation_time',null,'desc',1);

        if (!is_array($order)) functions::json(0, '当前订单不存在');
        $order = $order[0];
        $account = $this->mysql->query("client_paofen_automatic_account", "id={$order['paofen_id']}")[0];
        $shenshu = $this->mysql->query("appeal", "trade_no={$order['trade_no']}",'audit')[0];
        $order['creation_time'] = date('Y-m-d H:i:s', $order['creation_time']);
        $order['type'] = '支付宝';
        if ($order['status'] == 1) {
            $order['status_name'] = '等待下发支付二维码';
        } else if ($order['status'] == 2) {
            $order['status_name'] = '未支付';
        } else if ($order['status'] == 3) {
            $order['status_name'] = '订单超时';
        } else if ($order['status'] == 4) {
            $order['status_name'] = '已支付';
        }

        if($shenshu){
            $appeal = [];
            $appeal[0] = '未审核';
            $appeal[1] = '已审核';
            $appeal[0] = '已驳回';

            $order['appeal'] = $shenshu[0]['audit'];
            $order['appeal_name'] = $appeal[$order['appeal']];
        }else{
            $order['appeal'] = '';
            $order['appeal_name'] = '立即申诉';
        }
        functions::json(1, '请求成功',$order);
    }


    public function reissue()
    {
        $module_name = 'paofen_auto';
        $order_id = request::filter('post.id');
        if (empty($order_id)) functions::json(0, '订单ID错误');
        $order = $this->mysql->query('client_paofen_automatic_orders', "id={$order_id} and user_id={$this->user['id']}")[0];
        if (!is_array($order)) functions::json(0, '当前订单不存在');
        //if($order['status']==3) functions::json(-2, '订单超时，无法收款');
        $a = functions::lock($this->user['id']);
        if (!$a) {
            functions::json(0, '稍等片刻');
        }
        if (!is_array($this->user)) functions::json(0, '商户错误');


        //得到用户组
        $agt = $this->mysql->query("client_user", "id={$this->user['level_id']}")[0];
        $agt_a = functions::lock($agt['id']);
        if (!$agt_a) {
            functions::json(0, '稍等片刻');
        }

        $group = $this->mysql->query('client_group', "id={$agt['group_id']}");
        $group && $group = $group[0];
        //$agent_group = $this->mysql->query('agent_rate', "uid={$this->user['id']}");
        $agent_group = $this->mysql->query('client_group', "id={$this->user['group_id']}");
        $agent_group && $agent_group = $agent_group[0];

        //解析数据
        $authority = json_decode($group['authority'], true)[$module_name];
        if (!is_array($group) || $group['authority'] == -1 || $authority['open'] != 1) functions::json(-1, '用户组错误');
        //获取上级用户组


        if ($this->user['level_id'] !== '0') {
            //得到用户组

            //$agent_group = $this->mysql->query('agent_rate', "uid={$this->user['id']}")[0];
            $agent_group = $this->mysql->query('client_group', "id={$this->user['group_id']}")[0];

            $duser = $this->mysql->query("client_user", "id={$this->user['level_id']}")[0];
            $dailigroup = $this->mysql->query('client_group', "id={$duser['group_id']}")[0];
            //获取盘口用户组
            $puser = $this->mysql->query("client_user", "id={$order['pankou_id']}")[0];
            $puser_a = functions::lock($puser['id']);
            if (!$puser_a) {
                functions::json(0, '稍等片刻');
            }

            $pankougroup = $this->mysql->query('client_group', "id={$puser['group_id']}")[0];
            $pankouauthority = json_decode($pankougroup['authority'], true)[$module_name];
            //解析数据
            $dailiauthority = json_decode($dailigroup['authority'], true)[$module_name];
            //获取代理给商户的费率
            $shanghuauthority = json_decode($agent_group['authority'], true)[$module_name];

            //代理的获利    代理的费率-给商户的费率
            $fess2 = $dailiauthority['cost'] - $shanghuauthority['cost'];

            //系统对代理的费率
            $dailifees = $order['amount'] * $dailiauthority['cost'];

            $dailihuoli = $order['amount'] * $fess2;


            $shanghufees = $order['amount'] * $shanghuauthority['cost'];

            $pankoufees = $order['amount'] * $pankouauthority['cost'];

            $pankouhuoli = $order['amount'] - $pankoufees;


            $isCallback = 0;
            if ($order['reached'] == 1) {
                $isCallback = 1;
            } else {

                $shanghu_balance = $this->user['balance'] + $shanghufees; // 用户最终余额
                $user_balance = floatval($shanghu_balance);

                $daili_balance = $duser['balance'] + $dailihuoli; // 代理最终余额
                $daili_balance = floatval($daili_balance);


                $pankou_balance = $puser['balance'] + $pankouhuoli; // 代理最终余额
                $pankou_balance = floatval($pankou_balance);


                if ($user_balance >= 0) {
                    $isCallback = 1;

                    $updateStatus = $this->mysql->update("client_user", ['balance' => $user_balance], "id={$this->user['id']}");
                    functions::unlock($this->user['id']);
                    $agentlog = $this->mysql->query('agent_huoli_log', "trade_no LIKE '{$order['trade_no']}'")[0];

                    if (!is_array($agentlog)) {

                        //写代理获利记录
                        $alog = $this->mysql->insert("agent_huoli_log", [
                            'uid' => $this->user['id'],
                            'agent_id' => $duser['id'],
                            'orderid' => $order_id,
                            'amount' => $order['amount'],
                            'huoli' => $dailihuoli,
                            'trade_no' => $order['trade_no'],
                            'daili_balance' => $daili_balance,
                            'shanghu_fees' => $shanghufees,
                            'type' => '跑分模式',
                            'time' => time()
                        ]);

                        if ($alog > 0) {

                            $updateStatus_daili = $this->mysql->update("client_user", ['balance' => $daili_balance], "id={$duser['id']}");
                            functions::unlock($duser['id']);
                        }
                    }
                    //写盘口获利记录
                    $pankoulog = $this->mysql->query('pankou_huoli_log', "trade_no LIKE '{$order['trade_no']}'")[0];

                    if (!is_array($pankoulog)) {
                        $plog = $this->mysql->insert("pankou_huoli_log", [
                            'uid' => $puser['id'],
                            'orderid' => $order_id,
                            'amount' => $order['amount'],
                            'balance' => $pankou_balance,
                            'trade_no' => $order['trade_no'],
                            'old_balance' => $puser['balance'],
                            'pankou_fees' => $pankoufees,
                            'type' => $order['type'],
                            'time' => time()
                        ]);

                        if ($plog > 0) {

                            $updateStatus_pankou = $this->mysql->update("client_user", ['balance' => $pankou_balance], "id={$puser['id']}");
                            functions::unlock($puser['id']);
                        }
                    }

                    if ($updateStatus !== false) {
                        $this->user['balance'] = $user_balance;
                        $this->mysql->update("client_paofen_automatic_account", ['bind_uid' => ''], "id={$order['paofen_id']}");
                        $deposit = $this->mysql->query("deposit", "order_id={$order['id']} and user_id={$this->user['id']}")[0];
                        if (!is_array($deposit)) {
                            if ($order['status'] == 3) {
                                $bac = $this->mysql->query("client_user", "id={$this->user['id']}")[0];
                                $act_a = functions::lock($bac['id']);
                                if (!$act_a) {
                                    functions::json(0, '稍等片刻');
                                }
                                $yue = $bac['balance'] - $order['amount'];
                                $this->mysql->update("client_user", ['balance' => $yue], "id={$this->user['id']}");
                                functions::unlock($this->user['id']);
                            }
                        }
                        $this->mysql->delete("deposit", "user_id={$order['user_id']} and order_id={$order['id']}");
                        $this->mysql->update("client_paofen_automatic_orders", ['reached' => 1], "id={$order['id']}");
                    }
                } else {
                    functions::json(-1, '账户余额不足，回调失败');
                }
            }

        } else {

            //获取盘口用户组
            $puser = $this->mysql->query("client_user", "id={$order['pankou_id']}");
            $puser && $puser = $puser[0];
            $puser_sult = functions::lock($puser['id']);
            if (!$puser_sult) {
                functions::json(0, '稍等片刻');
            }
            $pankougroup = $this->mysql->query('client_group', "id={$puser['group_id']}");
            $pankougroup && $pankougroup = $pankougroup[0];
            $pankouauthority = json_decode($pankougroup['authority'], true)[$module_name];
            $pankoufees = $order['amount'] * $pankouauthority['cost'];
            $pankouhuoli = $order['amount'] - $pankoufees;

            $fees = $order['amount'] * $authority['cost'];

            $dailifees = 0;
            $shanghufees = $fees;
            $dailihuoli = 0;


            $isCallback = 0;

            if ($order['reached'] == 1) {
                $isCallback = 1;
            } else {
                $user_balance = $this->user['balance'] + $fees; // 用户最终余额
                $user_balance = floatval($user_balance);


                $pankou_balance = $puser['balance'] + $pankouhuoli; // 盘口最终余额
                $pankou_balance = floatval($pankou_balance);

                if ($user_balance >= 0) {
                    $isCallback = 1;

                    $updateStatus = $this->mysql->update("client_user", ['balance' => $user_balance], "id={$this->user['id']}");
                    functions::unlock($this->user['id']);

                    //写盘口获利记录
                    $pankoulog = $this->mysql->query('pankou_huoli_log', "trade_no LIKE '{$order['trade_no']}'")[0];

                    if (!is_array($pankoulog)) {
                        $plog = $this->mysql->insert("pankou_huoli_log", [
                            'uid' => $puser['id'],
                            'orderid' => $order_id,
                            'amount' => $order['amount'],
                            'balance' => $pankou_balance,
                            'trade_no' => $order['trade_no'],
                            'old_balance' => $puser['balance'],
                            'pankou_fees' => $pankoufees,
                            'type' => $order['type'],
                            'time' => time()
                        ]);

                        if ($plog > 0) {

                            $updateStatus_pankou = $this->mysql->update("client_user", ['balance' => $pankou_balance], "id={$puser['id']}");
                            functions::unlock($puser['id']);
                        }
                    }

                    $mauser = $this->mysql->query("client_user", "id={$this->user['id']}")[0];
                    //写押金记录 冻结金额
                    $this->mysql->insert("mashang_yajin_log", [
                        'uid' => $this->user['id'],
                        'trade_no' => $order['trade_no'],
                        'money' => $order['amount'],
                        'old_balance' => $this->user['balance'],
                        'new_balance' => $mauser['balance'],
                        'remark' => '补发订单成功！订单号：' . $order['trade_no'] . ',扣除金额：' . $order['amount'] . '元，扣除前余额：' . $this->user['balance'] . '元，扣除后余额：' . $mauser['balance'] . '元',
                        'time' => time(),
                        'status' => 2

                    ]);
                    if ($updateStatus !== false) {
                        $this->user['balance'] = $user_balance;
                        $this->mysql->update("client_paofen_automatic_account", ['bind_uid' => ''], "id={$order['paofen_id']}");
                        $deposit = $this->mysql->query("deposit", "order_id={$order['id']} and user_id={$this->user['id']}")[0];
                        if (!is_array($deposit)) {
                            if ($order['status'] == 3) {
                                $bac = $this->mysql->query("client_user", "id={$this->user['id']}")[0];
                                $act_a = functions::lock($bac['id']);
                                if (!$act_a) {
                                    functions::json(0, '稍等片刻');
                                }
                                $yue = $bac['balance'] - $order['amount'];
                                $this->mysql->update("client_user", ['balance' => $yue], "id={$this->user['id']}");
                                functions::unlock($this->user['id']);
                            }
                        }
                        $this->mysql->delete("deposit", "user_id={$order['user_id']} and order_id={$order['id']}");
                        $this->mysql->update("client_alipaygm_automatic_orders", ['reached' => 1], "id={$order['id']}");
                    }
                } else {
                    functions::json(-1, '账户余额不足，回调失败');
                }
            }


        }


        //检测订单是否为未支付
        if ($order['status'] != 4) {
            $this->mysql->update("client_paofen_automatic_orders", [
                'pay_time' => time(),
                'status' => 4,
                'callback_time' => time(),
                'callback_status' => 1,
                'callback_content' => '商户后台回调',
                'reached' => 1
            ], "id={$order['id']}");
        } else {
            $this->mysql->update("client_paofen_automatic_orders", [
                'callback_time' => time(),
                'callback_status' => 1,
                'callback_content' => '商户后台回调',
                'reached' => 1
            ], "id={$order['id']}");
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
                'fees' => $shanghufees,
                'sign' => functions::sign($puser['key_id'], [
                    'amount' => $order['amount'],
                    'out_trade_no' => $order['out_trade_no']
                ]),
                'callback_time' => time(),
                'type' => 1,
                'account_key' => $puser['key_id']
            ]));
            $this->mysql->update("client_paofen_automatic_orders", [
                'fees' => $shanghufees,
                'xitong_fees' => $dailifees,
                'agent_rate' => $dailihuoli,
                'pankou_fees' => $pankoufees,
                'reached' => 1
            ], "id={$order['id']}");
        }

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