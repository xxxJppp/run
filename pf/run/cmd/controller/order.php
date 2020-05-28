<?php

namespace xh\run\cmd\controller;

use xh\library\mysql;



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
}