<?php

namespace xh\run\admin\controller;

use xh\library\session;
use xh\library\model;
use xh\library\url;
use xh\library\mysql;
use xh\library\view;
use xh\library\request;
use xh\library\functions;
use xh\unity\page;
use xh\unity\cog;
use xh\unity\callbacks;

class pddgm
{
    //构造一个mysql请求
    private $mysql;

    //权限验证
    protected function powerLogin($Mid)
    {
        session::check();
        if (!(new model())->load('user', 'authority')->moduleValidate($Mid)) {
            url::address(url::s('admin/index/home'), '您没有权限访问', 3);
        }
        $this->mysql = new mysql();
    }

    //微信-全自动版
    //权限ID: 21
    public function automatic()
    {
        $this->powerLogin(21);
        $where = null;

        $userid = intval(request::filter('get.userid'));
        $id = intval(request::filter('get.id'));
        //检测是否查询会员id
        if (!empty($userid)) {
            $where = 'user_id = ' . $userid;
        }
        //检测是否查询微信id
        if (!empty($id)) {
            $where = 'id=' . $id;
        }
        $result = page::conduct('client_pddgm_automatic_account', request::filter('get.page'), 10, $where, null, 'id', 'asc');
        new view('pddgm/index', [
            'mysql'  => $this->mysql,
            'result' => $result
        ]);
    }
    //启动automatic轮训
    //权限ID: 21
    public function startAutomaticRb()
    {
        $this->powerLogin(21);
        $id = intval(request::filter('get.id'));
        //检查该微信
        $find_pddgm = $this->mysql->query("client_pddgm_automatic_account", "id={$id}")[0];
     //   if (!is_array($find_pddgm)) functions::json(-3, '更改异常!');
        $training = 2;
        if ($find_pddgm['training'] == 2) {
            //开启状态
            $training = 1;
            //检测账号是否异常
           // if ($find_pddgm['status'] != 4) functions::json(-3, '更改失败,当前微信没有在线!');
        }
        $update = $this->mysql->update("client_pddgm_automatic_account", [
            'training' => $training
        ], "id={$id}");
        if ($update > 0) functions::json(200, '更改轮训成功!');
        functions::json(-2, '更改失败!');
    }

    //启动网关
    //权限ID: 21
    public function startAutomaticGateway()
    {
        $this->powerLogin(21);
        $id = intval(request::filter('get.id'));
        //检查该微信
        $find_pddgm = $this->mysql->query("client_pddgm_automatic_account", "id={$id}")[0];
        if (!is_array($find_pddgm)) functions::json(-3, '更改异常!');
        $receiving = 2;
        if ($find_pddgm['receiving'] == 2) {
            //开启状态
            $receiving = 1;
            //检测账号是否异常
            if ($find_pddgm['status'] != 4) functions::json(-3, '更改失败,当前微信没有在线!');
        }
        $update = $this->mysql->update("client_pddgm_automatic_account", [
            'receiving' => $receiving
        ], "id={$id}");
        if ($update > 0) functions::json(200, '更改网关成功!');
        functions::json(-2, '更改失败!');
    }

    //订单统计
    //权限ID：34
    public function orderCount()
    {
        $this->powerLogin(34);
        $status = request::filter('get.status', '', 'intval');
        $pddgm_id = request::filter('get.pddgm_id', '', 'trim');
        $user_id = request::filter('get.user_id', '', 'intval');
        $start_time = request::filter('get.start_time', '', 'trim');
        $end_time = request::filter('get.end_time', '', 'trim');

        $where = '1=1';

        if (!empty($status) && $status != 0) {
            $where .= ' AND status=' . $status;
        }

        if (!empty($pddgm_id)) {
            $where .= " AND pddgm_id='{$pddgm_id}'";
        }


        if (!empty($user_id)) {
            $where .= " AND user_id='{$user_id}'";
        }

        if (!empty($start_time)) {
            $start_time = strtotime($start_time . ' 00:00:00');
            $end_time = strtotime($end_time . ' 23:59:59');
            $where .= " AND creation_time between {$start_time} AND {$end_time}";
        }


        $result = page::conduct('client_pddgm_automatic_orders', request::filter('get.page'), 15, $where, null, 'id', 'desc');

        new view('pddgm/count', [
            'result' => $result,
            'mysql'  => $this->mysql,
            'where'  => $where
        ]);
    }

    //安全注销
    //权限ID: 21
    public function startAutomaticLogOut()
    {
        $this->powerLogin(21);
        $id = intval(request::filter('get.id'));
        //检查该微信
        $find_pddgm = $this->mysql->query("client_pddgm_automatic_account", "id={$id}")[0];
        if (!is_array($find_pddgm)) functions::json(-3, '当前微信出现异常!');
        if ($find_pddgm['status'] == 6 || $find_pddgm['status'] == 1) functions::json(-3, '当前微信账号已经安全注销过了!');
        $update = $this->mysql->update("client_pddgm_automatic_account", [
            'status' => 1
        ], "id={$id}");
        if ($update > 0) functions::json(200, '安全注销成功!');
        functions::json(-2, '注销失败!');
    }


    //删除微信
    //权限ID: 21
    public function automaticDelete()
    {
        $this->powerLogin(21);
        $id = intval(request::filter('get.id'));
        //检查该微信
        $find_pddgm = $this->mysql->query("client_pddgm_automatic_account", "id={$id}")[0];
     //   if (!is_array($find_pddgm)) functions::json(-2, '删除该微信号时出现一个错误!');
       // if ($find_pddgm['status'] == 6) functions::json(-2, '当前微信正在进行安全注销,请耐心等待注销完成后再进行删除!');
       // if ($find_pddgm['status'] != 1) functions::json(-2, '请将微信安全下线后再进行删除!');
        $this->mysql->delete("client_pddgm_automatic_account", "id={$id}");
        functions::json(200, '您成功的删除了该微信!');
    }


    //订单管理
    //权限ID：23
    public function automaticOrder()
    {
        $this->powerLogin(23);
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');

        //锁定用户查找
        if ($sorting == 'user') {
            if (!empty($code)) {
                if ($_GET['locking'] == 'true') {
                    $_SESSION['pddgm']['WHERE'] = 'user_id=' . $code . ' ';
                }
            }
            if ($_GET['locking'] == 'false') {
                unset($_SESSION['pddgm']['WHERE']);
            }
        }

        $where = $_SESSION['pddgm']['WHERE'];

        //排序
        if ($sorting == 'status') {
            if ($code < 1) $code = 0;
            if ($code <= 4) $where .= 'and status=' . $code;
            if ($code > 4) $code = 0;
        }
        //callback
        if ($sorting == 'callback') {
            if ($code < 0) $code = 0;
            if ($code <= 1) $where .= 'and callback_status=' . $code;
            if ($code > 1) $code = -1;
        }
        //订单号
        if ($sorting == 'trade_no') {
            if ($code != '') {
                $code = trim($code);
                $where = "id='{$code}'";
            }
        }
        //微信id
        if ($sorting == 'pddgm') {
            if ($code != '') {
                $code = intval($code);
                $where .= "and pddgm_id={$code}";
            }
        }


        $where = trim($where, 'and');
        $result = page::conduct('client_pddgm_automatic_orders', request::filter('get.page'), 15, $where, null, 'id', 'desc');

        new view('pddgm/order', [
            'result'  => $result,
            'mysql'   => $this->mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ],
            "where"   => $where
        ]);
    }

    //手动回调管理员版
    //权限ID：23
    public function callback()
    {
        $this->powerLogin(23);
        $module_name = 'pddgm_auto';
        $order_id = request::filter('get.id');
        if (empty($order_id)) functions::json(-1, '订单ID错误');
        $order = $this->mysql->query('client_pddgm_automatic_orders', "id={$order_id}")[0];
        if (!is_array($order)) functions::json(-2, '当前订单不存在');
        //查询用户
        $user = $this->mysql->query("client_user", "id={$order['user_id']}")[0];
        if (!is_array($user)) functions::json(-2, '该订单的主用户不存在');

        //检测订单是否为未支付
        if ($order['status'] != 4) {
            $this->mysql->update("client_pddgm_automatic_orders", [
                'pay_time' => time(),
                'status'   => 4
            ], "id={$order['id']}");
        }
        if ($order['pay_time'] == 0) {
            $pay_time = time();
        } else {
            $pay_time = $order['pay_time'];
        }

        // 手续费扣除成功，开始回调
        $result = callbacks::curl($order['callback_url'], http_build_query([
            'account_name'  => $user['username'],
            'pay_time'      => $pay_time,
            'status'        => 'success',
            'amount'        => $order['amount'],
            'out_trade_no'  => $order['out_trade_no'],
            'trade_no'      => $order['trade_no'],
            'fees'          => 0.00,
            'sign'          => functions::sign($user['key_id'], [
                'amount'       => $order['amount'],
                'out_trade_no' => $order['out_trade_no']
            ]),
            'callback_time' => $callback_time
        ]));

        $this->mysql->update("client_pddgm_automatic_orders", [
            'pay_time'         => $pay_time,
            'callback_time'    => $callback_time,
            'callback_status'  => 1,
            'callback_content' => $result,
            'fees'             => 0.00
        ], "id={$order['id']}");


        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 订单号->' . $order['trade_no'] . ' 异步通知任务下发成功!');
        //-----------------------------
    }

    //删除订单ID,管理员版
    //权限ID：23
    public function automaticOrderDelete()
    {
        $this->powerLogin(23);
        $id = intval(request::filter('get.id'));
        $this->mysql->delete("client_pddgm_automatic_orders", "id={$id}");
        functions::json(200, '您成功的删除了该订单!');
    }


}