<?php

namespace xh\run\server\controller;

use GatewayClient\Gateway;

use xh\library\client;
use xh\unity\encrypt;
use xh\library\request;
use xh\library\functions;
use xh\library\mysql;
use xh\unity\cog;

class socketGateway
{

    private $mysql;

    public function __construct()
    {
        $this->mysql = new mysql();
    }

    protected function keyVerification()
    {
        $key = request::filter('request.key');
        //$key = (request::filter('get.key') or request::filter('post.key'));
        //验证key是否正确
        if (cog::read("server")['key'] != $key) functions::json(-1, '通讯失败');
    }

    public function gatewayLogin()
    {
        //file_put_contents("log.txt",json_encode($_REQUEST,512),FILE_APPEND );
        $this->keyVerification();
        $signkey = request::filter('post.signkey');
        $s_key = request::filter('post.s_key');
        $user_id = request::filter('post.user_id');
        $wechat_id = request::filter('post.wechat_id');
        $alipay_id = request::filter('post.alipay_id');
        $alipay_account_user_id = request::filter('post.alipay_account_user_id', '0');
        $client_id = request::filter('post.client_id');
        $find = $this->mysql->query("client_user", "id='{$user_id}' AND key_id='{$s_key}'")[0];
        if (empty($find)) functions::json('500', '用户信息错误');
        //ALTER TABLE  `xh_client_alipay_automatic_account` ADD  `bind_uid` VARCHAR( 50 ) NOT NULL DEFAULT  ' ' AFTER  `key_id` ;
        //ALTER TABLE  `xh_client_wechat_automatic_account` ADD  `bind_uid` VARCHAR( 50 ) NOT NULL DEFAULT  ' ' AFTER  `key_id` ;
        $alipay_max_amount = 0;
        $wechat_max_amount = 0;
        //更新支付宝心跳
        try {
            if (!empty($alipay_id)) {

                $alipay = $this->mysql->query("client_alipay_automatic_account", "key_id='{$alipay_id}' AND user_id='{$user_id}'", 'status,max_amount,account_user_id,is_new_version')[0];

                $time = time();
                if (!empty($alipay)) {

                    $editData = [
                        'status'            => 4,
                        'login_time'        => $time,
                        'active_time'       => $time,
                        'android_heartbeat' => $time,

                    ];
                    if ($alipay_account_user_id) {
                        $editData['account_user_id'] = $alipay_account_user_id;
                    }
                    $alipay_max_amount = $alipay['max_amount'];
                    $this->mysql->update("client_alipay_automatic_account", $editData, "key_id='{$alipay_id}'");

                }
            }

            //更新微信心跳
            if (!empty($wechat_id)) {

                $alipay = $this->mysql->query("client_wechat_automatic_account", "key_id='{$wechat_id}' AND user_id='{$user_id}'", 'status,max_amount')[0];

                $time = time();
                if (!empty($alipay)) {
                    $editData = [
                        'status'            => 4,
                        'login_time'        => $time,
                        'active_time'       => $time,
                        'android_heartbeat' => $time,
                    ];
                    $wechat_max_amount = $alipay['max_amount'];
                    $this->mysql->update("client_wechat_automatic_account", $editData, "key_id='{$wechat_id}'");

                }
            }

            // error_reporting(-1);
            \xh\library\gateway::serverBindUid($client_id, intval($user_id));
            //发送设置的最大金额
            \xh\library\gateway::setMaxAmount(intval($user_id), $alipay_max_amount, $alipay_id, $wechat_max_amount, $wechat_id);
            functions::json('200', '登陆成功' . json_encode($_REQUEST, 512));

        } catch (\Exception $e) {
            //file_put_contents("log.txt",json_encode($e->getMessage(),512),FILE_APPEND );
            echo $e->getMessage() . json_encode($_REQUEST, 512);
        }

    }


    public function uploadOrderCode()
    {
        $this->keyVerification();
        $type = request::filter('post.type', '', 'trim');
        $remark = request::filter('request.mark');
        $remark = explode('|', $remark);
        $order_id = $remark[1];
        $amount = request::filter('post.money', 0);
        $qrcode = request::filter('post.payurl', '', 'trim');

        if (empty($order_id)) functions::json('500', 'order_id不能为空');
        if (empty($amount)) functions::json('501', '金额不能为空');
        if (empty($qrcode)) functions::json('502', '二维码不能为空');


        switch ($type) {
            case 'alipay':
                $order_eck = $this->mysql->query("client_alipay_automatic_orders", "status=4 and id={$order_id}")[0];

                if (!is_array($order_eck)) {
                    $this->mysql->update("client_alipay_automatic_orders", [
                        'status' => 2,
                        'qrcode' => $qrcode
                    ], "id={$order_id}");
                    functions::setOrderCode("alipay_" . intval($order_id), $qrcode);

                }

                functions::json(200, 'success');
                break;
            case 'wechat':
                $order_eck = $this->mysql->query("client_wechat_automatic_orders", "status=4 and id={$order_id}")[0];

                if (!is_array($order_eck)) {
                    $this->mysql->update("client_wechat_automatic_orders", [
                        'status' => 2,
                        'qrcode' => $qrcode
                    ], "id={$order_id}");
                    functions::setOrderCode("wechat_" . intval($order_id), $qrcode);
                }
                functions::json(200, 'success');
                break;
        }

        functions::json(300, '订单已支付或失效');
    }

    //服务版登陆
    public function gatewayServerLogin()
    {
        $this->keyVerification();
        $signkey = request::filter('post.signkey');
        $wechat_id = request::filter('post.wechat_id');
        $alipay_id = request::filter('post.alipay_id', '', 'trim');
        $alipay_account_user_id = request::filter('post.alipay_account_user_id', '0', 'trim');
        $client_id = request::filter('post.client_id');
        if (empty($client_id)) functions::json(-1, '参数错误');
        $wechat_id = trim($wechat_id);
        $alipay_id = trim($alipay_id);
        $alipay_max_amount = 0;
        $wechat_max_amount = 0;

        if (!empty($alipay_id)) {
            $data = $this->mysql->query("service_account", "key_id='{$alipay_id}'", 'status,max_amount,account_user_id,is_new_version')[0];

            if (!empty($data)) {
                $time = time();
                $editData = [
                    'status'            => 4,
                    'login_time'        => $time,
                    'active_time'       => $time,
                    'android_heartbeat' => $time,
                ];
                if ($alipay_account_user_id) {
                    $editData['account_user_id'] = $alipay_account_user_id;
                }

                $alipay_max_amount = $data['max_amount'];
                $this->mysql->update("service_account", $editData, "key_id='{$alipay_id}'");

            }
        }

        if (!empty($wechat_id)) {
            $data = $this->mysql->query("service_account", "key_id='{$wechat_id}'", 'status,max_amount')[0];
            if (!empty($data)) {
                $time = time();
                $editData = [
                    'status'            => 4,
                    'login_time'        => $time,
                    'active_time'       => $time,
                    'android_heartbeat' => $time,
                ];
                $wechat_max_amount = $data['max_amount'];
                $this->mysql->update("service_account", $editData, "key_id='{$wechat_id}'");

            }
        }

        // error_reporting(-1);
        \xh\library\gateway::serverBindUid($client_id, SERVER_BIND_UID);
        \xh\library\gateway::setMaxAmount(SERVER_BIND_UID, $alipay_max_amount, $alipay_id, $wechat_max_amount, $wechat_id);
        functions::json('200', '注册成功.' . json_encode($_REQUEST, 512));

    }


    public function uploadServerOrderCode()
    {
        $this->keyVerification();
        $remark = request::filter('request.mark');
        $remark = explode('|', $remark);
        $order_id = $remark[1];
        $amount = request::filter('post.money', 0);
        $qrcode = request::filter('post.payurl', '', 'trim');

        if (empty($order_id)) functions::json('500', 'order_id不能为空');
        if (empty($amount)) functions::json('501', '金额不能为空');
        if (empty($qrcode)) functions::json('502', '二维码不能为空');


        $order_eck = $this->mysql->query("service_order", "status=4 and id={$order_id}")[0];

        if (!is_array($order_eck)) {
            $this->mysql->update("service_order", [
                'status' => 2,
                'qrcode' => $qrcode
            ], "id={$order_id}");
            functions::setOrderCode("service_" . intval($order_id), $qrcode);
            functions::json(200, 'success', 'qrcode=' . $qrcode);
        }


        functions::json(300, '订单已支付或失效');
    }


    public function closeReceiving()
    {
        error_reporting(-1);
        $key_id = request::filter('post.key_id');
        $thoroughfare = request::filter('post.thoroughfare');

        $edit = 0;
        switch ($thoroughfare) {
            case "alipay_auto":

                $edit = $this->mysql->update("client_alipay_automatic_account", ['receiving' => 2, 'training' => 2],
                    "key_id='{$key_id}'");

                break;
            case "wechat_auto":
                $edit = $this->mysql->update("client_wechat_automatic_account", [
                    'receiving' => 2],
                    "key_id='{$key_id}'");
                break;
            case "service_auto":
                $edit = $this->mysql->update("service_account", [
                    'receiving' => 2],
                    "key_id='{$key_id}'");
                break;
        }
        if ($edit > 0) {
            functions::json(200, '停止网关成功');

        } else {
            functions::json(200, '停止网关失败' . "key_id='{$key_id}'");
        }
    }

    //开启网关
    public function reopenReceiving()
    {
        //error_reporting(-1);
        $key_id = request::filter('post.key_id');
        $thoroughfare = request::filter('post.thoroughfare');

        $edit = 0;
        switch ($thoroughfare) {
            case "alipay_auto":

                $edit = $this->mysql->update("client_alipay_automatic_account", ['receiving' => 1, 'training' => 1],
                    "key_id='{$key_id}'");

                break;
            case "wechat_auto":
                $edit = $this->mysql->update("client_wechat_automatic_account", [
                    'receiving' => 1],
                    "key_id='{$key_id}'");
                break;
            case "service_auto":
                $edit = $this->mysql->update("service_account", [
                    'receiving' => 1],
                    "key_id='{$key_id}'");
                break;
        }
        if ($edit > 0 || $edit !== false) {

            $returnData=[
                'code'=>200,
                'msg'=>'重新打开网关',
                'continue'=>true,
                'data'=>null,
            ];
            exit(json_encode($returnData));

        } else {
            functions::json(200, '停止网关失败' . "key_id='{$key_id}'");
        }
    }

    public function test()
    {

        error_reporting(-1);
        $mark = 1111 . '|' . mt_rand(1000, 9999);
        \xh\library\gateway::getQrCode(SERVER_BIND_UID, $mark, 100.00, 'alipay');
    }
}
