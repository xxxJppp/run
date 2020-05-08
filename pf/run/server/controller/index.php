<?php

namespace xh\run\server\controller;


use xh\unity\callbacks;
use xh\unity\encrypt;
use xh\library\request;
use xh\library\functions;
use xh\library\mysql;
use xh\unity\cog;

class index
{

    private $mysql;

    public function __construct()
    {
        $this->mysql = new mysql();
    }

    //服务版回调成功之后，修改用户余额
    public function updateUserAccount()
    {
        return true;
        $module_name = 'service_auto';
        $order = $this->mysql->query('service_order', " status=4 and callback_status=1 and reached=0");

        foreach ($order as $obj) {
            //检测是否为用户订单
            if ($obj['user_id'] != 0) {

                $user = $this->mysql->query("client_user", "id={$obj['user_id']}")[0];
                $group = $this->mysql->query('client_group', "id={$user['group_id']}")[0];
                $authority = json_decode($group['authority'], true)[$module_name];

                //判断用户组是否存在
                if (is_array($group) || $group['authority'] != -1 || $authority['open'] == 1) {

                    //手续费扣掉后的金额
                    $fees = $obj['amount'] * $authority['cost'];
                    $user_money = $obj['amount'] - $fees;

                    //给用户加钱
                    $this->mysql->update("client_user", ['money' => $user['money'] + $user_money], "id={$user['id']}");

                    //直接强制修改reached
                    $this->mysql->update("service_order", ['reached' => 1], "id={$obj['id']}");

                }
            }

        }


        functions::json(200, 'ok');
    }

    // 服务版回调
    function serviceCallback()
    {
        return true;
        $service = $this->mysql->query('service_account', "status = 4", 'id,status');
        var_dump($service);
        echo "<br/>";
        if (!empty($service)) {
            foreach ($service as $val) {
                $result = callbacks::curl(URL_ROOT . '/server/service/callback', http_build_query(['id' => $val['id']]));
                print_r($result);
                echo $val['id'] . "<br/>";
            }
        }

    }

    //alipay v1.0 接口
    public function alipayCallback()
    {
        $module_name = 'alipay_auto';
        error_reporting(-1);
        $creation_time = time() - 300;
        // -------------------------
        // 获取需要回调的列表
        $order = $this->mysql->query('client_alipay_automatic_orders', "status=4 and callback_status=0 AND callback_count < 3 AND creation_time > $creation_time");
        print_r($order);
        foreach ($order as $obj) {
            $user = $this->mysql->query("client_user", "id={$obj['user_id']}")[0];
            if (!is_array($user)) continue;

            $group = $this->mysql->query('client_group', "id={$user['group_id']}")[0];

            $authority = json_decode($group['authority'], true)[$module_name];
            if (!is_array($group) || $group['authority'] == -1 || $authority['open'] != 1) continue;

            // 开始扣手续费
            $fees = $obj['amount'] * $authority['cost'];
            $user_balance = $user['balance'] - $fees; // 用户最终余额
            $user_balance = floatval($user_balance);

            if ($user_balance >= 0) {

                $user['balance'] = $user_balance;
                $callback_time = time();
                // 手续费扣除成功，开始回调

                $result = callbacks::curl_request($obj['callback_url'], [
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
                    'callback_time' => $callback_time,
                    'type'          => 2,
                    'account_key'   => $user['key_id']
                ]);
                var_dump($result);
                $callback_status = 0;
                if (strtolower($result) == 'success') {
                    $callback_status = 1;

                    $deductionStatus = $this->mysql->update("client_user", [
                        'balance' => floatval($user_balance)
                    ], "id={$user['id']}");
                    echo $deductionStatus;
                }

                echo $this->mysql->update("client_alipay_automatic_orders", [
                    'callback_time'    => $callback_time,
                    'callback_status'  => $callback_status,
                    'callback_content' => htmlentities($result),
                    'callback_count'   => $obj['callback_count'] + 1,
                    'fees'             => $fees
                ], "id={$obj['id']}");
            }


        }

    }

    //检测服务端掉线
    public function checkOnline()
    {
        return true;
        $time = functions::getAndroidHeartbeatNowTime(30);

        //支付宝公开版
        $this->mysql->update("client_wechat_automatic_account", ['status' => 1], "status=4 and active_time<{$time}");
        //微信公开版
        $this->mysql->update("client_alipay_automatic_account", ['status' => 1], "status=4 and active_time<{$time}");

        //服务版
        $this->mysql->update("service_account", ['status' => 5], "status=4 and active_time<{$time}");
        functions::json(200, '异常处理完毕');
    }

    // 废弃的
    function checkWechatHeartbeat()
    {
        return false;
        // file_put_contents('log.txt', date('Y-m-d H:i:s') . '=======checkWechatHeartbeat=======', FILE_APPEND);
        $signkey = @cog::read("server")['key'];
        $now = time() - functions::getAndroidHeartbeatNowTime();
        $data_list = $this->mysql->query('client_wechat_automatic_account', "natapp_url != ' '", 'id,user_id,key_id,heartbeats,natapp_url', 'android_heartbeat', 'desc');
        if (empty($data_list)) return false;
        foreach ($data_list as $val) {
            print_r($val);
            if (empty($val)) continue;

            $url = $val['natapp_url'] . "checkHeartbeat?device_key={$val['key_id']}&signkey={$signkey}&type=1&uid={$val['user_id']}";

            $text = @file_get_contents($url);
            var_dump($text);
            $time = time();
            if ((int)$text == 1) {

                $editData = [
                    'status'            => 4,
                    'login_time'        => $time,
                    'heartbeats'        => $val['heartbeats'] + 1,
                    'active_time'       => $time,
                    'android_heartbeat' => $time,
                ];

            } else {

                $editData = [
                    'status' => 1,
//                    'training'  => 2,
//                    'receiving' => 2
                ];

            }

            var_dump($this->mysql->update("client_wechat_automatic_account", $editData, "id={$val['id']}"));

        }
        functions::json(200, '微信检测完毕');
    }

    // 废弃的
    function checkServiceHeartbeat()
    {
        return false;
        //file_put_contents('log.txt', date('Y-m-d H:i:s') . '=======checkServiceHeartbeat=======', FILE_APPEND);
        $signkey = @cog::read("server")['key'];

        $now = time() - functions::getAndroidHeartbeatNowTime();
        $data_list = $this->mysql->query('service_account', "natapp_url != ' ' ", 'id,key_id,natapp_url,heartbeats,types', 'android_heartbeat', 'desc');
        if (empty($data_list)) return false;
        foreach ($data_list as $val) {
            print_r($val);
            if (empty($val)) continue;

            $url = $val['natapp_url'] . "checkHeartbeat?device_key={$val['key_id']}&signkey={$signkey}&type={$val['types']}";
            echo $url;
            $text = @file_get_contents($url);
            var_dump($text);
            $time = time();
            if ((int)$text == 1) {
                $editData = [
                    'status'            => 4,
                    'login_time'        => $time,
                    'heartbeats'        => $val['heartbeats'] + 1,
                    'active_time'       => $time,
                    'android_heartbeat' => $time,
                ];

            } else {
                $editData = [
                    'status' => 1,
//                    'training'  => 2,
//                    'receiving' => 2
                ];

            }
            $this->mysql->update("service_account", $editData, "id={$val['id']}");

        }
        functions::json(200, '服务端心跳检测完毕');
    }

    // 废弃的
    public function checkAlipayHeartbeat()
    {
        return false;
        //error_reporting(E_ALL);
        // file_put_contents('log.txt', date('Y-m-d H:i:s') . '=======checkAlipayHeartbeat=======', FILE_APPEND);
        $signkey = @cog::read("server")['key'];
        $now = time() - functions::getAndroidHeartbeatNowTime();
        $data_list = $this->mysql->query('client_alipay_automatic_account', "natapp_url != ' ' ", 'id,user_id,key_id,heartbeats,natapp_url,training,receiving', 'android_heartbeat', 'desc');

        if (empty($data_list)) return false;
        $data_list[] = [];
        foreach ($data_list as $val) {
            if (empty($val)) continue;
            print_r($val);
            $url = $val['natapp_url'] . "checkHeartbeat?device_key={$val['key_id']}&signkey={$signkey}&type=2&uid={$val['user_id']}";
            $text = @file_get_contents($url);
            var_dump($text);
            $time = time();
            if ((int)$text == 1) {
                $editData = [
                    'status'            => 4,
                    'login_time'        => $time,
                    'heartbeats'        => $val['heartbeats'] + 1,
                    'active_time'       => $time,
                    'android_heartbeat' => $time,
                ];

            } else {
                $editData = [
                    'status' => 1,
//                    'training'  => 2,
//                    'receiving' => 2
                ];


            }
            $update_id = $this->mysql->update("client_alipay_automatic_account", $editData, "id={$val['id']}");


        }
        functions::json(200, '阿里心跳检测完毕');
    }


    public function uploadLoginData()
    {
        $wechat_key = request::filter('post.wechat_key', '', 'trim');
        $alipay_key = request::filter('post.alipay_key', '', 'trim');
        $service_alypay_key = request::filter('post.service_alypay_key', '', 'trim');
        $service_wechat_key = request::filter('post.service_wechat_key', '', 'trim');
        if (!empty($service_wechat_key)) {
            $this->mysql->update("service_account", [
                'status'      => 4,
                'login_time'  => time(),
                'active_time' => time()
            ], "key_id='{$service_wechat_key}'");
        }
        if (!empty($service_alypay_key)) {
            $this->mysql->update("service_account", [
                'status'      => 4,
                'login_time'  => time(),
                'active_time' => time()
            ], "key_id='{$service_alypay_key}'");
        }
        if (!empty($wechat_key)) {
            $this->mysql->update("client_wechat_automatic_account", [
                'status'      => 4,
                'login_time'  => time(),
                'active_time' => time()
            ], "key_id='{$wechat_key}'");
        }

        if (!empty($alipay_key)) {
            $this->mysql->update("client_alipay_automatic_account", [
                'status'      => 4,
                'login_time'  => time(),
                'active_time' => time()
            ], "key_id='{$alipay_key}'");
        }

        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 服务ID->登录成功');
    }


    //安卓登录
    public function loginDo()
    {


        $username = request::filter('post.member_id', '', 'trim');
        $pwd = request::filter('post.pwd', '', 'trim');
        $signkey = request::filter('post.signkey', '', 'trim');
        if (cog::read("server")['key'] != $signkey) functions::json(-1, '通讯失败');

        $find = $this->mysql->query("client_user", "username='{$username}'", 'id,username,pwd,token,key_id')[0];

        if (is_array($find)) {
            //开始验证密码
            if (functions::pwd($pwd, $find['token']) != $find['pwd']) functions::json(-2, '密码错误!');
            unset($find['token']);
            unset($find['pwd']);
            functions::json(200, '登录成功', $find);
        }
        //如果没找到用户名，检测是否为手机号
        if (!functions::isMobile($username)) functions::json('-3', '会员名输入有误');
        //检测手机号码
        $find = $this->mysql->query("client_user", "phone={$username}")[0];
        if (is_array($find)) {
            //开始验证密码
            if (functions::pwd($pwd, $find['token']) != $find['pwd']) functions::json(-2, '密码错误!');
            unset($find['token']);
            unset($find['pwd']);
            functions::json(200, '登录成功', $find);
        }

        functions::json(-3, '手机号码输入有误');
    }


    public function login()
    {

        $encrpty = new encrypt();
        $data = json_decode($encrpty->Decode(request::filter('post.data', '', 'htmlspecialchars'), cog::read("server")['key']), true);
        $username = $data['member_id'];
        $pwd = $data['pwd'];
        $find = $this->mysql->query("client_user", "username='{$username}'")[0];
        if (is_array($find)) {
            //开始验证密码
            if (functions::pwd($pwd, $find['token']) != $find['pwd']) functions::json_encode(-2, '密码错误!');
            functions::json_encode(200, '登录成功');
        }
        //如果没找到用户名，检测是否为手机号
        if (!functions::isMobile($username)) functions::json_encode('-3', '会员名输入有误');
        //检测手机号码
        $find = $this->mysql->query("client_user", "phone={$username}")[0];
        if (is_array($find)) {
            //开始验证密码
            if (functions::pwd($pwd, $find['token']) != $find['pwd']) functions::json_encode(-2, '密码错误!');
            functions::json_encode(200, '登录成功');
        }
        functions::json_encode(-3, '手机号码输入有误');
    }


    //获取二维码生成任务
    public function taskGet()
    {
        //调用登录
        $user = $this->loginAndroid();
        //任务队列
        $Task = [];
        //检测微信是否有值
        if (is_array($user['wechat'])) {
            //查询准备生成二维码的订单
            $wechat_order = $this->mysql->query('client_wechat_automatic_orders', "wechat_id={$user['wechat']['id']} and status=1 and user_id={$user['id']}", "amount,trade_no")[0];
            //更新心跳
            //$this->mysql->update("client_wechat_automatic_account", ['android_heartbeat'=>time()],"id={$user['wechat']['id']}");
            if (is_array($wechat_order)) {
                //将该任务添加到队列
                $Task[] = array_merge($wechat_order, ['type' => 'wechat']);
            }
            //更新心跳
            $this->mysql->update("client_wechat_automatic_account", ['android_heartbeat' => time()], "id={$user['wechat']['id']}");
        }
        //检测支付宝是否有值
        if (is_array($user['alipay'])) {
            //查询准备生成二维码的订单
            $alipay_order = $this->mysql->query('client_alipay_automatic_orders', "alipay_id={$user['alipay']['id']} and status=1 and user_id={$user['id']}", "amount,trade_no")[0];
            //更新心跳
            //$this->mysql->update("client_alipay_automatic_account", ['android_heartbeat'=>time()],"id={$user['alipay']['id']}");
            if (is_array($alipay_order)) {
                //将该任务添加到队列
                $Task[] = array_merge($alipay_order, ['type' => 'alipay']);
            }
            //更新心跳
            $this->mysql->update("client_alipay_automatic_account", ['android_heartbeat' => time()], "id={$user['alipay']['id']}");
        }
        //下发任务
        functions::json_encode(200, 'success', $Task);
    }

    //安卓验证账号密码
    protected function loginAndroid()
    {
        $encrpty = new encrypt();
        $data = json_decode($encrpty->Decode(request::filter('post.data'), cog::read("server")['key']), true);
        //会员名/手机号
        $username = $data['member_id'];
        //密码
        $pwd = $data['pwd'];
        //微信_key
        $WECHAT_Key = $data['wechat_key'];
        //支付宝_key
        $ALIPAY_Key = $data['alipay_key'];
        //QQ_key -> 未开发
        $QQ_key = $data['tenpay_key'];

        $find = $this->mysql->query("client_user", "username='{$username}'")[0];

        //验证用户名模式
        if (is_array($find)) {
            //开始验证密码
            if (functions::pwd($pwd, $find['token']) != $find['pwd']) functions::json_encode(-2, '密码错误!');
            //验证微信key
            $find['wechat'] = $this->mysql->query("client_wechat_automatic_account", "user_id={$find['id']} and key_id='{$WECHAT_Key}'")[0];
            //验证支付宝key
            $find['alipay'] = $this->mysql->query("client_alipay_automatic_account", "user_id={$find['id']} and key_id='{$ALIPAY_Key}'")[0];
            //附加post参数
            $find['data'] = $data;

            //返回
            return $data;
        }

        //如果没找到用户名，检测是否为手机号
        if (!functions::isMobile($username)) functions::json_encode('-6', request::filter('post.data', '', 'htmlspecialchars'));
        //检测手机号码
        $find = $this->mysql->query("client_user", "phone={$username}")[0];
        if (is_array($find)) {
            //开始验证密码
            if (functions::pwd($pwd, $find['token']) != $find['pwd']) functions::json_encode(-2, '密码错误!');
            //验证微信key
            $find['wechat'] = $this->mysql->query("client_wechat_automatic_account", "user_id={$find['id']} and key_id='{$WECHAT_Key}'")[0];
            //验证支付宝key
            $find['alipay'] = $this->mysql->query("client_alipay_automatic_account", "user_id={$find['id']} and key_id='{$ALIPAY_Key}'")[0];
            //附加post参数
            $find['data'] = $data;

            //返回
            return $find;
        }
        functions::json_encode(-3, '手机号码输入有误');
    }

    //删除1天以前的所有日志记录
    public function crontabClearLog()
    {
        $add_time = time() - (60 * 60 * 24);
        $delete = $this->mysql->delete('order_log', "add_time < {$add_time}");
        file_put_contents("crontabClearLog.txt", date('Y-m-d H:i:s') . "sql:" . "add_time < {$add_time}" . ';delete_count' . $delete . PHP_EOL, FILE_APPEND);
    }

    //删除7天前无效的订单数据
    public function crontabClearOrder()
    {
        $add_time = time() - (60 * 60 * 24 * 7);
        $delete = $this->mysql->delete('client_alipay_automatic_orders', "status != 4 AND creation_time < {$add_time}");
        file_put_contents("crontabClearOrder.txt", date('Y-m-d H:i:s') . "sql:" . "add_time < {$add_time}" . ';delete_count' . $delete . PHP_EOL, FILE_APPEND);
        $delete = $this->mysql->delete('client_wechat_automatic_orders', "status != 4 AND creation_time < {$add_time}");
        file_put_contents("crontabClearOrder.txt", date('Y-m-d H:i:s') . "type:wecht-sql:" . "add_time < {$add_time}" . ';delete_count' . $delete . PHP_EOL, FILE_APPEND);
        $delete = $this->mysql->delete('client_pay_record', "pay_time < {$add_time}");

    }

    public function editName()
    {
        $name = request::filter('post.name');
        $id = request::filter('post.id');
        $where = 'id = ' . $id;
        $update['name'] = $name;
        $result = $this->mysql->update('service_account', $update, $where);
        if ($result) {
            echo json_encode(['code' => 200, 'msg' => '成功']);
        } else {
            echo json_encode(['code' => -1, 'msg' => '失败']);
        }
    }
}
