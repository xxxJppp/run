<?php

namespace xh\run\server\controller;

use xh\library\request;
use xh\library\mysql;
use xh\unity\callbacks;
use xh\unity\cog;
use xh\library\functions;
use xh\unity\sms;
use xh\unity\encrypt;

//支付宝-全自动版-服务端
class alipayAutomatic
{

    private $mysql;

    public function __construct()
    {
        $this->mysql = new mysql();
    }

    //验证服务端KEY
    protected function keyVerification()
    {
        $key = request::filter('request.key');
        //$key = (request::filter('get.key') or request::filter('post.key'));
        //验证key是否正确
        if (cog::read("server")['key'] != $key) functions::json(-1, '通讯失败');
    }

    //安卓验证账号密码
    protected function loginAndroid()
    {
        $encrpty = new encrypt();
        $data = json_decode($encrpty->Decode(request::filter('post.data'), cog::read("server")['key']), true);
        $username = $data['member_id'];
        $pwd = $data['pwd'];
        $DEVICE_Key = $data['device_Key'];
        $find = $this->mysql->query("client_user", "username='{$username}'")[0];
        if (is_array($find)) {
            //开始验证密码
            if (functions::pwd($pwd, $find['token']) != $find['pwd']) functions::json_encode(-2, '密码错误!');
            $find['device'] = $this->mysql->query("client_alipay_automatic_account", "user_id={$find['id']} and key_id='{$DEVICE_Key}'")[0];
            if (!is_array($find['device'])) functions::json_encode(-4, 'DEVICE Key识别失败!');
            $find['data'] = $data;

            return $find;
        }
        //如果没找到用户名，检测是否为手机号
        if (!functions::isMobile($username)) functions::json_encode('-6', request::filter('post.data', '', 'htmlspecialchars'));
        //检测手机号码
        $find = $this->mysql->query("client_user", "phone={$username}")[0];
        if (is_array($find)) {
            //开始验证密码
            if (functions::pwd($pwd, $find['token']) != $find['pwd']) functions::json_encode(-2, '密码错误!');
            $find['device'] = $this->mysql->query("client_alipay_automatic_account", "user_id={$find['id']} and key_id='{$DEVICE_Key}'")[0];
            if (!is_array($find['device'])) functions::json_encode(-3, 'DEVICE Key识别失败!');
            $find['data'] = $data;

            return $find;
        }
        functions::json_encode(-3, '手机号码输入有误');
    }

    //安卓获取二维码生成任务 -> 废除
    public function orderGet()
    {
        $user = $this->loginAndroid();
        //查询准备生成二维码的订单
        $order = $this->mysql->query('client_alipay_automatic_orders', "alipay_id={$user['device']['id']} and status=1 and user_id={$user['id']}", "id,amount,trade_no");
        //更新心跳
        $this->mysql->update("client_alipay_automatic_account", ['android_heartbeat' => time()], "id={$user['device']['id']}");
        functions::json_encode(200, 'success', $order[0]);
    }


    //安卓上载二维码到服务器
    public function uploadCode()
    {
        $user = $this->loginAndroid();
        //上载二维码
        $order_id = $user['data']['order_id'];//订单ID
        $qrcode = $user['data']['qrcode'];//支付二维码
        $order_eck = $this->mysql->query("client_alipay_automatic_orders", "status=4 and trade_no={$order_id}")[0];

        if (!is_array($order_eck)) {
            $this->mysql->update("client_alipay_automatic_orders", [
                'status' => 2,
                'qrcode' => $qrcode
            ], "alipay_id={$user['device']['id']} and trade_no={$order_id}");
        }

        functions::json_encode(200, 'success');
    }

    //获取所有需要登录的支付宝账户，并处理一些事物
    public function loginGet()
    {
        $this->keyVerification();
        $NowTime = time() - 120;
        $find = $this->mysql->query("client_alipay_automatic_account", "status=2 and login_time>{$NowTime}", "id,user_id,key_id");
        $this->mysql->update("client_alipay_automatic_account", ['status' => 3], "status=2");
        //判定支付宝掉线
        $droppedResult = $this->mysql->query('client_alipay_automatic_account', "status!=4 and status!=1 and login_time<{$NowTime} or status=6");
        //判断异常的支付宝账户，并发送短信
        $errorResult = $this->mysql->query("client_alipay_automatic_account", "status=5");
        //更改状态
        $this->mysql->update("client_alipay_automatic_account", ['status' => 1, 'training' => 2, 'receiving' => 2], "status!=4 and status!=1 and login_time<{$NowTime} or status=6");
        if (count($errorResult) > 0) {
            foreach ($errorResult as $error) {
                $find_user = $this->mysql->query("client_user", "id={$error['user_id']}")[0];
                if (is_array($find_user)) {
                    //发送短信
                    (new sms())->sendError($find_user['phone'], $error['name']);
                    $this->mysql->update("client_alipay_automatic_account", ['status' => 1], "id={$error['id']}");
                }
            }
        }
        $erroralipay = array_merge($droppedResult, $errorResult);
        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: alipayAutomatic Success', [
            'login'   => ['list' => $find, 'num' => count($find)],
            'dropped' => ['list' => $erroralipay, 'num' => count($erroralipay)]
        ]);
    }

    //上载支付宝二维码
    public function uploadLoginImg()
    {
        $this->keyVerification();
        $id = request::filter('post.id');
        $login_img = request::filter('post.img');
        if (empty($login_img)) functions::json(-2, ' [' . date("Y/m/d H:i:s", time()) . ']: 支付宝ID->' . $id . ' 没有截取到登录二维码');
        $this->mysql->update("client_alipay_automatic_account", [
            'status'    => 7,
            'login_img' => str_replace("@", "+", $login_img)
        ], "id={$id}");
        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 支付宝ID->' . $id . ' 登录二维码上载完毕');
    }

    //上载登录成功，以及更新支付宝信息
    public function uploadLoginData()
    {
        $this->keyVerification();
        $id = request::filter('post.id');
        $name = request::filter('post.name');
        if (trim($name) == "") $name = '商户' . $id;
        $this->mysql->update("client_alipay_automatic_account", [
            'name'        => $name,
            'status'      => 4,
            'login_time'  => time(),
            'active_time' => time()
        ], "id={$id}");
        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 支付宝ID->' . $id . ' 登录成功');
    }

    //上载异常通知
    public function uploadLoginError()
    {
        $this->keyVerification();
        $id = request::filter('post.id');
        $this->mysql->update("client_alipay_automatic_account", [
            'status'    => 5,
            'training'  => 2,
            'receiving' => 2
        ], "id={$id}");
        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 支付宝ID->' . $id . ' 异常通知成功');
    }


    //上载订单通知
    public function uploadOrder()
    {

        $this->keyVerification();
        $id = intval(request::filter('post.id'));
        $money = str_replace("￥", '', request::filter('post.money'));
        $money = sprintf("%.2f", $money);
        $no = request::filter('post.no');
        $order = trim(request::filter('post.order'));
//        $today_money = str_replace("￥", '', request::filter('post.today_money'));
//        $today_money = number_format($today_money, 2);
//
//        $today_pens = intval(request::filter('post.today_pens'));
        $find_order = $this->mysql->query('client_alipay_automatic_orders', "alipay_id={$id} and status=2 and amount={$money} and id={$order}")[0];
        if (is_array($find_order)) {
            $this->mysql->update("client_alipay_automatic_orders", [
                'status'        => 4,
                'pay_time'      => time(),
                'callback_from' => 'app',
                'no'            => $no,
            ], "id={$find_order['id']}");
            $remark = ' - 订单信息：' . $order;
            $average = 1;

        } else {
            $remark = ' - 该订单不是第三方交易订单';
            $average = 0;
        }
        //查询用户信息
        $find_uid = $this->mysql->query("client_alipay_automatic_account", "id={$id}")[0]['user_id'];
        //写到交易记录
        $this->mysql->insert("client_pay_record", [
            'pay_time'     => time(),
            'amount'       => $money,
            'user_id'      => $find_uid,
            'pay_note'     => '[公开版]支付宝ID：' . $order . $remark,
            'types'        => 2,
            'version_code' => 'alipay_auto',
            'average'      => $average
        ]);
        //更新当前支付宝账号的实时统计
        //$this->mysql->update("client_alipay_automatic_account", ['today_money' => $today_money, 'today_pens' => $today_pens], "id={$id}");

        $result = callbacks::curl(URL_ROOT . '/server/callback/alipay', http_build_query(['id' => $id]));

        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 这里是支付宝回调-支付宝ID->' . $order . ' 订单处理完成' . $result);
    }

    public function pcUploadOrder()
    {

        //$this->keyVerification();
        $remark = request::filter('request.remark');
        $remark = str_replace("=姓牛", '', $remark);
        if (strpos($remark, ')') !== false) {
            $remark = substr($remark, strpos($remark, ')') + 1);

        } elseif (strpos($remark, 'ORDER') !== false) {
            $remark = explode("QX", str_replace("ORDER", "", $remark));
        }

        $remark = explode('|', $remark);
        if (empty($remark)) functions::json(500, 'remark信息错误');
        $log_id = $this->mysql->insert("order_log", [
            'id'        => $remark[0],
            'order_id'  => $remark[1],
            'money'     => request::filter('post.money'),
            'json_data' => json_encode($_REQUEST, JSON_UNESCAPED_UNICODE),
            'type'      => 'pc-alypay',
            'add_time'  => time(),
        ]);

        $id = $remark[0];
        $money = str_replace("￥", '', request::filter('request.money'));
        $money = sprintf("%.2f", $money);
        $no = request::filter('request.orderNo');
        $order = $remark[1];
        $today_money = str_replace("￥", '', request::filter('post.today_money'));
        $today_money = number_format($today_money, 2);

        $today_pens = intval(request::filter('post.today_pens'));
        $find_order = $this->mysql->query('client_alipay_automatic_orders', "alipay_id={$id} and status=2 and amount={$money} and id={$order}")[0];
        if (is_array($find_order)) {
            $update_id = $this->mysql->update("client_alipay_automatic_orders", [
                'status'        => 4,
                'pay_time'      => time(),
                'callback_from' => 'pc',
                'no'            => $no,
            ], "id={$find_order['id']}");
            $remark = ' - 订单信息：' . $order;
            $average = 1;
            if ($log_id > 0 && $update_id !== false) {
                $this->mysql->update("order_log", [
                    'status' => 1,
                ], "log_id={$log_id}");
            }

        } else {
            $order = $this->mysql->query('client_alipay_automatic_orders', "id={$remark[1]}", 'status,amount')[0];
            if (is_array($order) && $order['status'] == 4) {
                $this->mysql->update("order_log", [
                    'status' => 1,
                ], "log_id={$log_id}");
                exit('ok');
            }
            functions::json(700, '订单已成功或失效,订单信息' . json_encode($_REQUEST));

        }

        //查询用户信息
        $find_uid = $this->mysql->query("client_alipay_automatic_account", "id={$id}")[0]['user_id'];
        //写到交易记录
        $this->mysql->insert("client_pay_record", [
            'pay_time'     => time(),
            'amount'       => $money,
            'user_id'      => $find_uid,
            'pay_note'     => '[公开版]支付宝ID：' . $order . $remark,
            'types'        => 2,
            'version_code' => 'alipay_auto',
            'average'      => $average
        ]);
        //更新当前支付宝账号的实时统计
        //$this->mysql->update("client_alipay_automatic_account", ['today_money' => $today_money, 'today_pens' => $today_pens], "id={$id}");

        $result = callbacks::curl(URL_ROOT . '/server/callback/alipay', http_build_query(['id' => $id]));
        echo 'ok';

        //  functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 这里是支付宝回调-支付宝ID->' . $order . ' 订单处理完成' . $result);
    }

    public function testPcUploadOrder()
    {

        //$this->keyVerification();
        $remark = request::filter('request.remark');
        $remark = explode('|', $remark);
        if (empty($remark)) exit('remark信息错误');

        $id = $remark[0];
        $money = str_replace("￥", '', request::filter('request.money'));
        $money = sprintf("%.2f", $money);
        $no = request::filter('request.orderNo');
        $order = $remark[1];
        $today_money = str_replace("￥", '', request::filter('post.today_money'));
        $today_money = number_format($today_money, 2);

        $today_pens = intval(request::filter('post.today_pens'));
        $find_order = $this->mysql->query('client_alipay_automatic_orders', "alipay_id={$id} and status=2 and amount={$money} and id={$order}")[0];
        echo "alipay_id={$id} and status=2 and amount={$money} and id={$order}";

        if (is_array($find_order)) {
            $this->mysql->update("client_alipay_automatic_orders", [
                'status'   => 4,
                'pay_time' => time(),
                'no'       => $no,
            ], "id={$find_order['id']}");
            $remark = ' - 订单信息：' . $order;
            $average = 1;
        } else {
            exit('订单已成功或失效,订单信息' . json_encode($_REQUEST));
        }
        //查询用户信息
        $find_uid = $this->mysql->query("client_alipay_automatic_account", "id={$id}")[0]['user_id'];
        //写到交易记录
        echo $this->mysql->insert("client_pay_record", [
            'pay_time'     => time(),
            'amount'       => $money,
            'user_id'      => $find_uid,
            'pay_note'     => '[公开版]支付宝ID：' . $order . $remark,
            'types'        => 2,
            'version_code' => 'alipay_auto',
            'average'      => $average
        ]);
        //更新当前支付宝账号的实时统计
        $this->mysql->update("client_alipay_automatic_account", ['today_money' => $today_money, 'today_pens' => $today_pens], "id={$id}");

        $result = callbacks::curl(URL_ROOT . '/server/callback/alipay', http_build_query(['id' => $id]));
        echo 'ok';

        //  functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 这里是支付宝回调-支付宝ID->' . $order . ' 订单处理完成' . $result);
    }

    //程序自杀通知
    public function cillself()
    {
        $this->keyVerification();
        $id = request::filter('post.id');
        $this->mysql->update("client_alipay_automatic_account", [
            'status'    => 1,
            'training'  => 2,
            'receiving' => 2
        ], "id={$id}");
        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 支付宝ID->' . $id . ' 自杀成功');
    }


    function appCallback()
    {
        $callback_list = request::filter('request.callback_list');
        $callback_list = json_decode($callback_list, true);
        foreach ($callback_list as $val) {
            $remark = explode('|', $val['tradeRemark']);

            if (!empty($remark)) {

                $id = $remark[0];
                $money = str_replace("￥", '', $val['tradeAmount']);
                $money = sprintf("%.2f", $money);
                $no = request::filter('request.tradeNo');
                $pay_time = request::filter('request.tradeTime');
                $order = $remark[1];

                $find_order = $this->mysql->query('client_alipay_automatic_orders', "alipay_id={$id} and amount={$money} and id={$order}", 'id,status')[0];
                if (is_array($find_order)) {
                    if ($find_order['status'] == 4) {
                        continue;
                        //成功的信息
                    } else {

                        $this->mysql->update("client_alipay_automatic_orders", [
                            'status'        => 4,
                            'pay_time'      => time(),
                            'callback_from' => 'app-call',
                            'no'            => $no,
                        ], "id={$find_order['id']}");

                        $result = callbacks::curl(URL_ROOT . '/server/callback/alipay', http_build_query(['id' => $id]));
                        $result = json_decode($result, true);
                        if ($result['code'] == 200) {
                            //插入日志
                            continue;
                        }
                    }

                }

                //失败的全写入日志
                $this->mysql->insert("app_log", [
                    'alipay_id' => $id,
                    'order_id'  => $order,
                    'money'     => $money,
                    'no'        => $no,
                    'pay_time'  => $pay_time,
                ]);

            }

        }
        functions::json(200, '已接收到请求');

    }

    //支付宝银行转账上载订单通知   author xi
    public function uploadOrderBank()
    {

        $this->keyVerification();
        //$id = intval(request::filter('post.id'));
        $amount_true = request::filter('post.Money','0');//实际收款金额
        //$money = sprintf("%.2f", $money);
        //$no = request::filter('post.no');
        $bank_acount = request::filter('post.Mycard','','trim');//收款卡号
//        $today_money = str_replace("￥", '', request::filter('post.today_money'));
//        $today_money = number_format($today_money, 2);
//
//        $today_pens = intval(request::filter('post.today_pens'));
        $newTime = time();
        $find_order = $this->mysql->query('client_bank_automatic_orders', "amount_true='{$amount_true}' and status=2 and bank_acount='{$bank_acount}' and expire_time>{$newTime}",'','creation_time');

        //找到订单数量超过2条，则记录未匹配订单
        if(count($find_order)>1){
            //插入无匹配订单，删除订单
            foreach($find_order as $k=>$v) {
                $status = $this->mysql->insert('client_bank_automatic_orders_no', [
                    'amount_true'          => $v['amount_true'],
                    'bank_acount'          => $v['bank_acount'],
                    'time'                 => $newTime,
                ]);
            }

        }

        $status = false;
        if (is_array($find_order)&&!empty($find_order)) {
           $status =  $this->mysql->update("client_bank_automatic_orders", [
                'status'        => 4,
                'pay_time'      => time(),
                'callback_from' => 'app',
            ], "id={$find_order[0]['id']}");
            $remark = ' - 订单信息：' . $find_order[0]['amount_true'];
            $average = 1;
        } else {
            //插入无匹配订单
            $status = $this->mysql->insert('client_bank_automatic_orders_no', [
                'amount_true'          => $amount_true,
                'bank_acount'          => $bank_acount,
                'time'                 => $newTime,
            ]);

            $remark = ' - 该订单不是第三方交易订单';
            $average = 0;
        }
        //查询用户信息
        $find_uid = $this->mysql->query("client_bank_automatic_account", "id={$find_order[0]['alipay_id']}")[0]['user_id'];
        //写到交易记录
        $this->mysql->insert("client_pay_record", [
            'pay_time'     => time(),
            'amount'       => $amount_true,
            'user_id'      => $find_uid,
            'pay_note'     => '[公开版]支付宝ID：' . $find_order[0]['id'] . $remark,
            'types'        => 2,
            'version_code' => 'bank_auto',
            'average'      => $average
        ]);
        //更新当前支付宝账号的实时统计
        //$this->mysql->update("client_alipay_automatic_account", ['today_money' => $today_money, 'today_pens' => $today_pens], "id={$id}");
        if($status){
            echo 'Success';
        }else{
            echo 'error:'.json_encode($find_order,JSON_UNESCAPED_LINE_TERMINATORS);

        }
        $result = callbacks::curl(URL_ROOT . '/server/callback/bank', http_build_query(['id' => $find_order[0]['alipay_id']]));

     //   functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 这里是支付宝回调-支付宝ID->' . $find_order[0]['id'] . ' 订单处理完成' . $result);
    }


}
