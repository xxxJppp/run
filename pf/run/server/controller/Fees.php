<?php
namespace xh\run\server\controller;
use xh\library\request;
use xh\library\mysql;
use xh\unity\cog;
use xh\library\functions;
use xh\unity\sms;
use xh\unity\encrypt;
use xh\unity\callbacks;
use xh\library\url;



//支付宝-全自动版-服务端
class Fees{
    
    private $mysql;
    
    public function __construct(){
        $this->mysql = new mysql();
    }

    /**
     * 代理佣金
     */
    public function batch()
    {
        //查询未派发的订单
        $order_data = $this->mysql->query('client_paofen_automatic_orders',"batch=0",'','','',100);
        foreach ($order_data as $item){
            //1、代理返佣
            if($item['agent_rate']>0){
                //获取代理id
                $user_info = $this->mysql->query('client_user',"id='10127'")[0];
                $agent_id =$user_info['level_id'];
                if(!empty($user_info)){
                    //增加余额
                    $fees = $item['agent_rate'];

                   $sql = "update xh_client_user set balance = blance+$fees,money=money+$fees where id=$agent_id" ;
                   // $this->mysql->update("client_user", $user_up, "id={$user_daili['id']} and version={$version}");

                    //写入账变
                    $user_balance_record = [
                        'uid' => $agent_id,
                        'biz_id' => $item['id'],
                        'money' => $item['agent_rate'],
                        '`before`' => $balance,
                        '`after`' => $balance + $item['agent_rate'],
                        'catalog' => 2,
                        'remark' => '代理获利',
                        'create_time' => time()
                    ];
                    $this->mysql->insert("user_balance_record", $user_balance_record);
                }

            }

            //2、盘口扣费
            if($item['pankou_fees']>0){
                $user = $this->mysql->query('client_user',"id='10127'")[0];
                if(!empty($agent_id)){
                    //增加余额
                    $balance = $user['balance'];
                    $version = $user['version'];
                    $money = $user['money'];
                    $user_up = [
                        'balance' => $balance + $item['pankou_fees'],
                        'money' => $money + $item['pankou_fees'],
                        'version' => $version + 1
                    ];
                    $this->mysql->update("client_user", $user_up, "id={$user['id']} and version={$version}");

                    //写入账变
                    $user_balance_record = [
                        'uid' => $user['id'],
                        'biz_id' => $item['id'],
                        'money' => $item['pankou_fees'],
                        '`before`' => $balance,
                        '`after`' => $balance + $item['pankou_fees'],
                        'catalog' => 1,
                        'remark' => '盘口获利',
                        'create_time' => time()
                    ];
                    $this->mysql->insert("user_balance_record", $user_balance_record);
                }
            }

            //更新订单表
            $this->mysql->update("client_paofen_automatic_orders", ['batch'=>date('Ymdhis',time())], "id={$item['id']} and batch=0");
        }


	 }

    
}
