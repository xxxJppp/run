<?php

namespace xh\run\cmd\controller;

use xh\library\functions;
use xh\library\mysql;
use xh\unity\callbacks;


class order
{
    private $mysql;
    public function __construct(){
        $this->mysql = new mysql();
    }
    /*public function cleantable(){
        $this->mysql->delete("agent_huoli_log","id>0");
        $this->mysql->delete("agent_rate","id>0");
        $this->mysql->delete("withdraw","id>0 and catalog=2");
        $this->mysql->delete("withdraw","id>0 and catalog=3");
        $this->mysql->delete("withdraw","id>0 and catalog=1");
        $this->mysql->delete("client_paofen_automatic_account","id>0");
        $this->mysql->delete("client_paofen_automatic_orders","id>0");
        $this->mysql->delete("client_user","id>0");
        $this->mysql->delete("client_withdraw","id>0");
        $this->mysql->delete("deposit","id>0");
        $this->mysql->delete("mashang_huoli_log","id>0");
        $this->mysql->delete("mashang_yajin_log","id>0");
        $this->mysql->delete("pankou_huoli_log","id>0");
        $this->mysql->delete("user_paylog","id>0");
    }*/

    public function depositRelease(){
        $chaoshi = time()-900;
        $begin_time = time()-7200;
        $orders = $this->mysql->query("client_paofen_automatic_orders","status=3 and creation_time > {$begin_time} and creation_time<={$chaoshi} and type=1 and pay_time=0");
        print_r($orders);
        foreach($orders as $order){
            $user_id = $order['user_id'];
            $deposit = $this->mysql->query("deposit","user_id={$user_id} and order_id={$order['id']}")[0];
            if(is_array($deposit)){
                $puser = $this->mysql->query("client_user", "id={$user_id}")[0];
                $mashang_balance = $puser['balance'] +  $deposit['money']; // 用户最终余额
                $mashang_balance = floatval($mashang_balance);
                $updateStatus = $this->mysql->update("client_user", ['balance' => $mashang_balance], "id={$user_id}");
                $del = $this->mysql->delete("deposit","id={$deposit['id']}");

            }
            //$p2user = $this->mysql->query("client_user", "id={$user_id}")[0];

        }
        echo 'success';
    }
    public function orderovertime(){
        $chaoshi = time()-300;
        $order = $this->mysql->query("client_paofen_automatic_orders","status=2 and creation_time <= {$chaoshi} and type=1 and pay_time=0");
        foreach($order as $val){
            $this->mysql->update("client_paofen_automatic_orders",['status'=>3],"id={$val['id']}");
            $this->mysql->update("client_paofen_automatic_account",['bind_uid'=>''],"id={$val['paofen_id']}");
        }
        echo 'success';
    }
    public function orderDel(){
        $chaoshi = time()-300;
        $order = $this->mysql->query("client_paofen_automatic_orders","creation_time <= {$chaoshi} and paofen_id=0 and user_id=0");
        foreach($order as $val){
            $this->mysql->delete("client_paofen_automatic_orders","id={$val['id']}");
        }
        echo 'success';
    }

    /**
     * 回调
     */
    public function callback()
    {
        //查询未回调的订单
        $order_data = $this->mysql->query('client_paofen_automatic_orders',"callback_status=0 and status=4 and reached=1",'','','',20);
        foreach ($order_data as $item){
            //查询用户
            $user = $this->mysql->query("client_user", "id={$item['user_id']}")[0];
            if (!is_array($user)) functions::json(-2, '该订单的主用户不存在');

            //检测订单是否为未支付
            if ($item['status'] != 4) {
                $this->mysql->update("client_paofen_automatic_orders", [
                    'pay_time' => time(),
                    'status'   => 4
                ], "id={$item['id']}");
            }
            if ($item['pay_time'] == 0) {
                $pay_time = time();
            } else {
                $pay_time = $item['pay_time'];
            }
            $callback_time = time();
            // 手续费扣除成功，开始回调
            $result = callbacks::curl($item['callback_url'], http_build_query([
                'account_name'  => $user['username'],
                'pay_time'      => $pay_time,
                'status'        => 'success',
                'amount'        => $item['amount'],
                'out_trade_no'  => $item['out_trade_no'],
                'trade_no'      => $item['trade_no'],
                'fees'          => $item['fees'],
                'sign'          => functions::sign($user['key_id'], [
                    'amount'        => $item['amount'],
                    'out_trade_no'  => $item['out_trade_no']]),
                'callback_time' => $callback_time
            ]));

            $this->mysql->update("client_paofen_automatic_orders", [
                'pay_time'         => $pay_time,
                'callback_time'    => $callback_time,
                'callback_status'  => 1,
                'callback_content' => $result,
                'fees'             => $item['fees']
            ], "id={$item['id']}");

            functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 订单号->' . $item['trade_no'] . ' 异步通知任务下发成功!');
        }
    }

}