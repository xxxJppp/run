<?php

namespace xh\run\server\controller;

use xh\library\mysql;
use xh\unity\callbacks;
use xh\library\functions;
use xh\library\request;

class callback
{

    private $mysql;

    public function __construct()
    {
        $this->mysql = new mysql();
    }

    public function addLog()
    {
        return false;
        $create_order = $this->mysql->insert('log', [
            'data' => json_encode($_REQUEST, JSON_UNESCAPED_UNICODE),
            'date' => date('Y-m-d H:i:s')
        ]);
        echo $create_order;

    }

    function makeSign()
    {

        $sign = functions::sign('7F544B8BAA2202', [
            'amount'       => sprintf("%.2f", floatval(2972)),
            'out_trade_no' => date('ymd') . date('ymd')
        ]);
        echo "key_id:7F544B8BAA2202" . "<br>";
        echo "amount:" . sprintf("%.2f", floatval(2972)) . "<br>";
        echo "out_trade_no:" . date('ymd') . date('ymd') . "<br>";
        echo "sign:{$sign}" . "<br>";

    }

    //Automatic v1.0 接口
    public function automatic()
    {
        $module_name = 'wechat_auto';
        $wechat_id = request::filter('post.id');
        if (empty($wechat_id)) functions::json(-1, '微信ID错误');
        //通过微信id得到用户信息
        $wechat = $this->mysql->query('client_wechat_automatic_account', "id={$wechat_id}")[0];
        if (!is_array($wechat)) functions::json(-1, '微信错误');
        //得到用户信息
        $user = $this->mysql->query("client_user", "id={$wechat['user_id']}")[0];
        if (!is_array($user)) functions::json(-1, '商户错误');
        //得到用户组
        $group = $this->mysql->query('client_group', "id={$user['group_id']}")[0];
        //解析数据
        $authority = json_decode($group['authority'], true)[$module_name];
        if (!is_array($group) || $group['authority'] == -1 || $authority['open'] != 1) functions::json(-1, '用户组错误');
        // -------------------------
        // 获取需要回调的列表
        $order = $this->mysql->query('client_wechat_automatic_orders', "wechat_id={$wechat_id} and status=4 and callback_status=0 and callback_count<4  limit 0,30");
        foreach ($order as $obj) {

            $fees = $obj['amount'] * $authority['cost'];
            $isCall = 0 ;  //判断是否进行回调
            //查看订单是否已支付
            if ($obj['reached'] == 1) {
                $isCall = 1;

            }else{
                $user_balance = $user['balance'] - $fees; // 用户最终余额
                $user_balance = number_format($user_balance,3,'.','');

                if($user_balance >=0 ){
                    $isCall = 1;

                    $updateStatus = $this->mysql->update("client_user", ['balance' => floatval($user_balance),], "id={$user['id']}");
                    if($updateStatus !== false){
                        $this->mysql->update("client_wechat_automatic_orders", ['reached' => 1], "id={$obj['id']}");
                    }
                }
            }

            if ($isCall == 1) {

                // 开始回调、回调成功，再扣除手续费
                $http_build_data = http_build_query([
                    'account_name'  => $user['username'],
                    'pay_time'      => $obj['pay_time'],
                    'status'        => 'success',
                    'amount'        => $obj['amount'],
                    'out_trade_no'  => $obj['out_trade_no'],
                    'trade_no'      => $obj['trade_no'],
                    'fees'          => $fees,
                    'sign'          => functions::sign($user['key_id'], [
                        'amount'       => floatval($obj['amount']),
                        'out_trade_no' => $obj['out_trade_no']
                    ]),
                    'callback_time' => time(),
                    'type'          => 1,
                    'account_key'   => $user['key_id']
                ]);

                $result = callbacks::sendRequest($obj['callback_url'], $http_build_data);

                $callback_status =  (strtolower($result['msg']) == 'success') ? 1:0;

                $this->mysql->update("client_wechat_automatic_orders", [
                    'callback_time'    => time(),
                    'callback_status'  => $callback_status,
                    'callback_content' => htmlentities($result['msg'] . $result['info']),
                    'callback_count'   => $obj['callback_count'] + 1,
                    'fees'             => $fees,
                ], "id={$obj['id']}");
            }
        }
        $this->mysql->update("client_wechat_automatic_account", ['active_time' => time()], "id={$wechat_id}");
        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 微信ID->' . $wechat_id . ' 异步通知成功');
        //-----------------------------
    }


    //alipay v1.0 接口
    public function alipay()
    {
        $module_name = 'alipay_auto';
        $alipay_id = request::filter('post.id');
        if (empty($alipay_id)) functions::json(-1, '支付宝ID错误');
        //通过微信id得到用户信息
        $wechat = $this->mysql->query('client_alipay_automatic_account', "id={$alipay_id}")[0];
        if (!is_array($wechat)) functions::json(-1, '支付宝错误');
        //得到用户信息
        $user = $this->mysql->query("client_user", "id={$wechat['user_id']}")[0];
        if (!is_array($user)) functions::json(-1, '商户错误');
        //得到用户组
        $group = $this->mysql->query('client_group', "id={$user['group_id']}")[0];
        //解析数据
        $authority = json_decode($group['authority'], true)[$module_name];
        if (!is_array($group) || $group['authority'] == -1 || $authority['open'] != 1) functions::json(-1, '用户组错误');
        // -------------------------
        // 获取需要回调的列表
        $order = $this->mysql->query('client_alipay_automatic_orders', "alipay_id={$alipay_id} and status=4 and callback_status=0 and callback_count<4  limit 0,30");
        foreach ($order as $obj) {

            $fees = $obj['amount'] * $authority['cost'];
            $isCall = 0 ;  //判断是否进行回调
            //查看订单是否已支付
            if ($obj['reached'] == 1) {
                $isCall = 1;

            }else{
                $user_balance = $user['balance'] - $fees; // 用户最终余额
                $user_balance = number_format($user_balance,3,'.','');

                if($user_balance >=0 ){
                    $isCall = 1;

                    $updateStatus = $this->mysql->update("client_user", ['balance' => floatval($user_balance),], "id={$user['id']}");
                    if($updateStatus !== false){
                        $this->mysql->update("client_alipay_automatic_orders", ['reached' => 1], "id={$obj['id']}");
                    }
                }
            }


            if ($isCall == 1) {

                // 开始回调、回调成功，再扣除手续费
                $http_build_data = http_build_query([
                    'account_name'  => $user['username'],
                    'pay_time'      => $obj['pay_time'],
                    'status'        => 'success',
                    'amount'        => $obj['amount'],
                    'out_trade_no'  => $obj['out_trade_no'],
                    'trade_no'      => $obj['trade_no'],
                    'fees'          => $fees,
                    'sign'          => functions::sign($user['key_id'], [
                        'amount'       => floatval($obj['amount']),
                        'out_trade_no' => $obj['out_trade_no']
                    ]),
                    'callback_time' => time(),
                    'type'          => 2,
                    'account_key'   => $user['key_id']
                ]);
                $result = callbacks::sendRequest($obj['callback_url'], $http_build_data);

                $callback_status =  (strtolower($result['msg']) == 'success') ? 1:0;

                $this->mysql->update("client_alipay_automatic_orders", [
                    'callback_time'    => time(),
                    'callback_status'  => $callback_status,
                    'callback_content' => htmlentities($result['msg'] . $result['info']),
                    'callback_count'   => $obj['callback_count'] + 1,
                    'fees'             => $fees,
                ], "id={$obj['id']}");
            }
        }

        //$this->mysql->update("client_alipay_automatic_account", ['active_time' => time()], "id={$alipay_id}");
        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 支付宝ID->' . $alipay_id . ' 异步通知成功');
        //-----------------------------
    }

    //支付宝银行转账
    public function bank()
    {
        $module_name = 'bank_auto';
        $alipay_id = request::filter('post.id');
        if (empty($alipay_id)) functions::json(-1, '支付宝ID错误');
        //通过微信id得到用户信息
        $wechat = $this->mysql->query('client_bank_automatic_account', "id={$alipay_id}")[0];
        if (!is_array($wechat)) functions::json(-1, '支付宝错误');
        //得到用户信息
        $user = $this->mysql->query("client_user", "id={$wechat['user_id']}")[0];
        if (!is_array($user)) functions::json(-1, '商户错误');
        //得到用户组
        $group = $this->mysql->query('client_group', "id={$user['group_id']}")[0];
        //解析数据
        $authority = json_decode($group['authority'], true)[$module_name];
        if (!is_array($group) || $group['authority'] == -1 || $authority['open'] != 1) functions::json(-1, '用户组错误');
        // -------------------------
        // 获取需要回调的列表
        $order = $this->mysql->query('client_bank_automatic_orders', "alipay_id={$alipay_id} and status=4 and callback_status=0 and callback_count<4  limit 0,30");
        foreach ($order as $obj) {

            $fees = $obj['amount'] * $authority['cost'];
            $isCall = 0 ;  //判断是否进行回调
            //查看订单是否已支付
            if ($obj['reached'] == 1) {
                $isCall = 1;

            }else{
                $user_balance = $user['balance'] - $fees; // 用户最终余额
                $user_balance = number_format($user_balance,3,'.','');

                if($user_balance >=0 ){
                    $isCall = 1;

                    $updateStatus = $this->mysql->update("client_user", ['balance' => floatval($user_balance),], "id={$user['id']}");
                    if($updateStatus !== false){
                        $this->mysql->update("client_bank_automatic_orders", ['reached' => 1], "id={$obj['id']}");
                    }
                }
            }


            if ($isCall == 1) {

                // 开始回调、回调成功，再扣除手续费
                $http_build_data = http_build_query([
                    'account_name'  => $user['username'],
                    'pay_time'      => $obj['pay_time'],
                    'status'        => 'success',
                    'amount'        => $obj['amount'],
                    'out_trade_no'  => $obj['out_trade_no'],
                    'trade_no'      => $obj['trade_no'],
                    'fees'          => $fees,
                    'sign'          => functions::sign($user['key_id'], [
                        'amount'       => floatval($obj['amount']),
                        'out_trade_no' => $obj['out_trade_no']
                    ]),
                    'callback_time' => time(),
                    'type'          => 2,
                    'account_key'   => $user['key_id']
                ]);
                $result = callbacks::sendRequest($obj['callback_url'], $http_build_data);

                $callback_status =  (strtolower($result['msg']) == 'success') ? 1:0;

                $this->mysql->update("client_bank_automatic_orders", [
                    'callback_time'    => time(),
                    'callback_status'  => $callback_status,
                    'callback_content' => htmlentities($result['msg'] . $result['info']),
                    'callback_count'   => $obj['callback_count'] + 1,
                    'fees'             => $fees,
                ], "id={$obj['id']}");
            }
        }

        //$this->mysql->update("client_alipay_automatic_account", ['active_time' => time()], "id={$alipay_id}");
        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 支付宝ID->' . $alipay_id . ' 异步通知成功');
        //-----------------------------
    }

}
