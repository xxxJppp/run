<?php

namespace xh\run\admin\controller;

use xh\library\GoogleAuthenticator;
use xh\library\session;
use xh\library\model;
use xh\library\url;
use xh\library\mysql;
use xh\library\view;
use xh\library\request;
use xh\library\functions;
use xh\library\Config;
use xh\unity\page;
use xh\unity\cog;
use xh\unity\callbacks;

class paofen
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

    //支付宝-全自动版
    //权限ID: 24
    public function automatic()
    {
        $this->powerLogin(24);
        $where = null;
        $userid = intval(request::filter('get.userid'));
        $id = intval(request::filter('get.id'));
        //检测是否查询会员id
        if (!empty($userid)) {
            $where = 'user_id = ' . $userid;
        }
        //检测是否查询支付宝id
        if (!empty($id)) {
            $where = 'id=' . $id;
        }
        $result = page::conduct('client_paofen_automatic_account', request::filter('get.page'), 10, $where, null, 'id', 'desc');
        new view('paofen/index', [
            'mysql'  => $this->mysql,
            'result' => $result
        ]);
    }

    //支付宝-全自动版
    //权限ID: 24
    public function test()
    {
        echo 1212;exit;
        $config = new Config();

        $name = "customer";

        $result = $config->inquire($name);
        var_dump($result) ;

    }

    //启动automatic轮训
    //权限ID: 24
    public function startAutomaticRb()
    {
        $this->powerLogin(24);
        $id = intval(request::filter('get.id'));
        //检查该支付宝
        $find_paofen = $this->mysql->query("client_paofen_automatic_account", "id={$id}")[0];
      //  if (!is_array($find_paofen)) functions::json(-3, '更改异常!');
        $training = 2;
        if ($find_paofen['training'] == 2) {
            //开启状态
            $training = 1;
            //检测账号是否异常
         //   if ($find_paofen['status'] != 4) functions::json(-3, '更改失败,当前支付宝没有在线!');
        }
        $update = $this->mysql->update("client_paofen_automatic_account", [
            'training' => $training
        ], "id={$id}");
        if ($update > 0) functions::json(200, '更改轮训成功!');
        functions::json(-2, '更改失败!');
    }

    //启动网关
    //权限ID: 24
    public function startAutomaticGateway()
    {
        $this->powerLogin(24);
        $id = intval(request::filter('get.id'));
        //检查该支付宝
        $find_paofen = $this->mysql->query("client_paofen_automatic_account", "id={$id}")[0];
     //   if (!is_array($find_paofen)) functions::json(-3, '更改异常!');
        $receiving = 2;
        if ($find_paofen['receiving'] == 2) {
            //开启状态
            $receiving = 1;
            //检测账号是否异常
          //  if ($find_paofen['status'] != 4) functions::json(-3, '更改失败,当前支付宝没有在线!');
        }
        $update = $this->mysql->update("client_paofen_automatic_account", [
            'receiving' => $receiving
        ], "id={$id}");
        if ($update > 0) functions::json(200, '更改网关成功!');
        functions::json(-2, '更改失败!');
    }

    //安全注销
    //权限ID: 24
    public function startAutomaticLogOut()
    {
        $this->powerLogin(24);
        $id = intval(request::filter('get.id'));
        //检查该支付宝
        $find_paofen = $this->mysql->query("client_paofen_automatic_account", "id={$id}")[0];
        if (!is_array($find_paofen)) functions::json(-3, '当前支付宝出现异常!');
        if ($find_paofen['status'] == 6 || $find_paofen['status'] == 1) functions::json(-3, '当前支付宝账号已经安全注销过了!');
        $update = $this->mysql->update("client_paofen_automatic_account", [
            'status' => 1
        ], "id={$id}");
        if ($update > 0) functions::json(200, '安全注销成功!');
        functions::json(-2, '注销失败!');
    }


    //删除支付宝
    //权限ID: 24
    public function automaticDelete()
    {
        $this->powerLogin(24);
        $id = intval(request::filter('get.id'));
        //检查该支付宝
        $find_paofen = $this->mysql->query("client_paofen_automatic_account", "id={$id}")[0];
      //  if (!is_array($find_paofen)) functions::json(-2, '删除该支付宝号时出现一个错误!');
       // if ($find_paofen['status'] == 6) functions::json(-2, '当前支付宝正在进行安全注销,请耐心等待注销完成后再进行删除!');
       // if ($find_paofen['status'] != 1) functions::json(-2, '请将支付宝安全下线后再进行删除!');
        $this->mysql->delete("client_paofen_automatic_account", "id={$id}");
        functions::json(200, '您成功的删除了该支付宝!');
    }
    //订单统计
    //权限ID：33
    public function orderCount()
    {
        $this->powerLogin(33);
        $status = request::filter('get.status', 0, 'intval');
        $trade_no = request::filter('get.trade_no', '', 'trim');

        $paofen_id = request::filter('get.paofen_id', '', 'trim');
        $username = request::filter('get.username', '', 'trim');

        $pankou_id = request::filter('get.pankou_id', '', 'intval');
        $start_time = request::filter('get.start_time', '', 'trim');
        $end_time = request::filter('get.end_time', '', 'trim');

        $where = 'paofen_id>0 and user_id>0';

        if (!empty($status) && $status != 0) {
            $where .= ' AND status=' . $status;
        }

        if (!empty($paofen_id)) {
            $where .= " AND paofen_id='{$paofen_id}'";
        }

        if (!empty($trade_no)) {
            $where .= " AND trade_no='{$trade_no}'";
        }

        if (!empty($username)) {
            $user = $this->mysql->query("client_user", "username='{$username}'",'id')[0];

            if($user){
                $where .= " AND user_id='{$user['id']}'";
            }
        }

        if (!empty($pankou_id)) {
            $where .= " AND pankou_id='{$pankou_id}'";
        }

        if (!empty($start_time)) {
            $start_time = strtotime($start_time . ' 00:00:00');
            $end_time = strtotime($end_time . ' 23:59:59');
            $where .= " AND creation_time between {$start_time} AND {$end_time}";
        }

        $result = page::conduct('client_paofen_automatic_orders', request::filter('get.page'), 15, $where, null, 'id', 'desc');

        new view('paofen/count', [
            'result' => $result,
            'mysql'  => $this->mysql,
            'where'  => $where
        ]);
    }

    //订单管理
    //权限ID：25
    public function automaticOrder()
    {
        $this->powerLogin(25);
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');
        $where = '1=1';

        //锁定用户查找
        if ($sorting == 'user') {
            if (!empty($code)) {
                if ($_GET['locking'] == 'true') {
                    $where .= ' AND user_id=' . $code;
                }
            }
        }

        //支付宝id
        if ($sorting == 'paofen') {
            if ($code != '') {
                $code = intval($code);
                $where .= ' AND paofen_id=' . $code;
            }
        }


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
                $where .= "trade_no='{$code}'";
            }
        }

        $result = page::conduct('client_paofen_automatic_orders', request::filter('get.page'), 15, $where, null, 'id', 'desc');

        new view('paofen/order', [
            'result'  => $result,
            'mysql'   => $this->mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ],
            'where'   => $where
        ]);
    }

    //手动回调管理员版
    //权限ID：25
    public function callback()
    {
        $this->powerLogin(25);
        $module_name = 'paofen_auto';
        $order_id = request::filter('get.id');
        if (empty($order_id)) functions::json(-1, '订单ID错误');
        $order = $this->mysql->query('client_paofen_automatic_orders', "id={$order_id}")[0];
        if (!is_array($order)) functions::json(-2, '当前订单不存在');
        //查询用户
        $user = $this->mysql->query("client_user", "id={$order['user_id']}")[0];
        if (!is_array($user)) functions::json(-2, '该订单的主用户不存在');

        //检测订单是否为未支付
        if ($order['status'] != 4) {
            $this->mysql->update("client_paofen_automatic_orders", [
                'pay_time' => time(),
                'status'   => 4
            ], "id={$order['id']}");
        }
        if ($order['pay_time'] == 0) {
            $pay_time = time();
        } else {
            $pay_time = $order['pay_time'];
        }
        $callback_time = time();
        // 手续费扣除成功，开始回调
        $result = callbacks::curl($order['callback_url'], http_build_query([
            'account_name'  => $user['username'],
            'pay_time'      => $pay_time,
            'status'        => 'success',
            'amount'        => $order['amount'],
            'out_trade_no'  => $order['out_trade_no'],
            'trade_no'      => $order['trade_no'],
            'fees'          => $order['fees'],
            'sign'          => functions::sign($user['key_id'], [
                'amount'       => $order['amount'],
                'out_trade_no' => $order['out_trade_no']
            ]),
            'callback_time' => $callback_time
        ]));

        $this->mysql->update("client_paofen_automatic_orders", [
            'pay_time'         => $pay_time,
            'callback_time'    => $callback_time,
            'callback_status'  => 1,
            'callback_content' => $result,
            'fees'             => $order['fees']
        ], "id={$order['id']}");


        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 订单号->' . $order['trade_no'] . ' 异步通知任务下发成功!');
        //-----------------------------
    }

    //删除订单ID,管理员版
    //权限ID：25
    public function automaticOrderDelete()
    {
        $this->powerLogin(25);
        $id = intval(request::filter('get.id'));
        $this->mysql->delete("client_paofen_automatic_orders", "id={$id}");
        functions::json(200, '您成功的删除了该订单!');
    }

    /**
     * 导出
     */
    public function export() {
        $status = request::filter('get.status', '', 'intval');
        $paofen_id = request::filter('get.paofen_id', '', 'trim');
        $user_id = request::filter('get.user_id', '', 'intval');
        $start_time = request::filter('get.start_time', '', 'trim');
        $end_time = request::filter('get.end_time', '', 'trim');

        $where = '1=1';
        if (!empty($status) && $status != 0) {
            $where .= ' AND status=' . $status;
        }

        if (!empty($paofen_id)) {
            $where .= " AND paofen_id='{$paofen_id}'";
        }


        if (!empty($user_id)) {
            $where .= " AND user_id='{$user_id}'";
        }

        if (!empty($start_time) && $start_time != 'null') {
            $start_time = strtotime($start_time . ' 00:00:00');
            $end_time = strtotime($end_time . ' 23:59:59');
            $where .= " AND creation_time between {$start_time} AND {$end_time}";
        }
        $mysql = new Mysql();
        $list = $mysql->query('client_paofen_automatic_orders',$where);
        foreach ($list as $key => $value) {
            if ($value['status'] == 1) {
                $list[$key]['status'] = '等待下发支付二维码';
            }else if ($value['status'] == 2) {
                $list[$key]['status'] = '未支付';
            }else if ($value['status'] == 3) {
                $list[$key]['status'] = '订单超时';
            }else {
                $list[$key]['status'] = '已支付';
            }
            if ($value['pay_time']) {
                $list[$key]['pay_time'] = date('Y-m-d H:i:s',$value['pay_time']);
            }else {
                $list[$key]['pay_time'] = '无';
            }
            if ($value['callback_status'] == 1) {
                $list[$key]['callback_status'] = '已回调';
            }else {
                $list[$key]['callback_status'] = '未回调';
            }
            $list[$key]['creation_time'] = date('Y-m-d H:i:s',$value['creation_time']);
            $user_info = $mysql->query('client_user','id = '.$value['user_id']);
            $list[$key]['user_name'] = $user_info[0]['username'];
            $list[$key]['phone'] = $user_info[0]['phone'];
            $list[$key]['percentage'] = $value['amount'] - $value['fees'];
        }
        $name = '跑分订单';
        $data_info = array(
            array('id' , '订单ID'),
            array('user_id' , '商户ID'),
            array('user_name' , '商户名称'),
            array('phone' , '商户手机号'),
            array('trade_no' , '交易订单号'),
            array('paofen_id' , '支付宝ID'),
            array('amount' , '金额'),
            array('percentage' , '抽成'),
            array('status' , '交易状态'),
            array('fees' , '手续费'),
            array('pay_time' , '异步通知时间'),
            array('callback_status' , '异步通知状态'),
            array('callback_from' , '异步通知'),
            array('callback_content' , '回调信息'),
            array('creation_time' , '订单创建时间'),
        );
        functions::commonExport($name,$data_info,$list);
    }


    public function appeal(){
        $this->powerLogin(93);
        $result = page::conduct('appeal', request::filter('get.page'), 10, '', null, 'id', 'desc');
        new view('paofen/appeal', [
            'result'  => $result,
            'mysql'  => $this->mysql,
        ]);
    }


    public function appealaudit(){
        $this->powerLogin(93);

        $id = request::filter('post.id', '' );

        $amount = request::filter('post.amount', '');
        $type = request::filter('post.type', '');
        if($type == 1 && !is_numeric($amount)){
            functions::json(-3,'请输入正确金额');
        }

        $mysql = new Mysql();
        $appeal = $mysql->query('appeal','id='.$id,'trade_no');
        if(!$appeal){
            functions::json(-3,'该申诉记录不存在或已审核');
        }

        $this->mysql->startThings();

        if($type == 1){

            $result = $mysql->update('client_paofen_automatic_orders',['amount'=>$amount],'trade_no='.$appeal[0]['trade_no']);
            if(!$result){
                $this->mysql->rollBack();
                functions::json(-3,'请确认订单是否正确');
            }

            $result1 = $mysql->update('appeal',['money'=>$amount],'id='.$id);
            if(!$result1){
                $this->mysql->rollBack();
                functions::json(-3,'请确认订单是否正确');
            }

        }

        $result_appeal = $mysql->update('appeal',['audit'=>$type],'id='.$id);
        if(!$result_appeal){
            $this->mysql->rollBack();
            functions::json(-3,'请确认订单是否正确');
        }

        $this->mysql->commit();
        functions::json(1,'操作成功');
    }

}