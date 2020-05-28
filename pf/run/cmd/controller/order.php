<?php

namespace xh\run\cmd\controller;
use xh\library\request;
use xh\library\mysql;
use xh\unity\cog;
use xh\library\functions;
use xh\unity\sms;
use xh\unity\encrypt;
use xh\unity\callbacks;
use xh\library\url;


class order{

    private $mysql;

    public function __construct(){
        $this->mysql = new mysql();
    }

    public function depositRelease(){
        $chaoshi = time()-900;
        $begin_time = time()-7200;
        $orders = $this->mysql->query("client_paofen_automatic_orders","status=3 and creation_time > {$begin_time} and creation_time<={$chaoshi} and type=1 and pay_time=0");
        foreach($orders as $order){
            $user_id = $order['user_id'];
            $deposit = $this->mysql->query("deposit","user_id={$user_id} and order_id={$order['id']}")[0];
            if(is_array($deposit)){
                $this->mysql->startThings();
                $puser = $this->mysql->query("client_user", "id={$user_id}")[0];
                $mashang_balance = $puser['balance'] +  $deposit['money']; // 用户最终余额
                $mashang_balance = floatval($mashang_balance);
                //$updateStatus = $this->mysql->update("client_user", ['balance' => $mashang_balance], "id={$user_id}");
                $updateStatus = functions::user_balance($user_id,$deposit['money']);
                $change = functions::user_balance_record($user_id,$deposit['money'],5,$order['id'],'冻结押金退回',$puser['balance']);
                $del = $this->mysql->delete("deposit","id={$deposit['id']}");
                if($updateStatus===false || $change===false || !$del){
                    $this->mysql->rollBack();
                    echo '失败\r\n';
                }
                $this->mysql->commit();
                echo 'success\r\n';
            }
            //$p2user = $this->mysql->query("client_user", "id={$user_id}")[0];

        }

    }
    public function orderovertime(){
        $chaoshi = time()-300;
        $order = $this->mysql->query("client_paofen_automatic_orders","status=2 and creation_time <= {$chaoshi} and type=1 and pay_time=0");
        foreach($order as $val){
            $up = $this->mysql->update("client_paofen_automatic_orders",['status'=>3],"id={$val['id']}");
            $set = $this->mysql->update("client_paofen_automatic_account",['bind_uid'=>''],"id={$val['paofen_id']}");
            echo 'success\r\n';
        }

    }
    public function orderDel(){
        $chaoshi = time()-300;
        $order = $this->mysql->query("client_paofen_automatic_orders","creation_time <= {$chaoshi} and paofen_id=0 and user_id=0");
        foreach($order as $val){
            if($this->mysql->delete("client_paofen_automatic_orders","id={$val['id']}")){
            echo 'success\r\n';
            }
        }

    }

    /**
     * 回调
     */
    public function Callback()
    {
        //查询未回调的订单
        $order_data = $this->mysql->query('client_paofen_automatic_orders',"callback_status!=1 and status=4 and reached=1",'','','',20);

        foreach ($order_data as $item){
            //查询用户
            $user = $this->mysql->query("client_user", "id={$item['user_id']}")[0];
            if(!is_array($user)){
                echo "该订单的主用户不存在\r\n";
                continue;
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

            if($result == 'success'){
                $callback_status = 1;
            }else{
                $callback_status = 2;
            }

            $this->mysql->update("client_paofen_automatic_orders", [
                'pay_time'         => $pay_time,
                'callback_time'    => $callback_time,
                'callback_status'  => $callback_status,
                'callback_content' => $result,
                'fees'             => $item['fees']
            ], "id={$item['id']}");

            if($result != 'success'){
                echo "订单id:".$item['id']."回调失败\r\n";
                continue;
            }
        }
        echo 'success';
    }

}