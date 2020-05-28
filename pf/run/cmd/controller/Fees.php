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
        $order_data = $this->mysql->query('client_paofen_automatic_orders',"batch=0 and status=4 and reached=1",'','','',20);
        foreach ($order_data as $item){

            $agent_rate = $item['agent_rate'];

            $pankou_fees = $item['pankou_fees'];
            
            //开启事务
            $this->mysql->startThings();

            //1、代理返佣
            if($agent_rate>0){
                //获取代理id
                $user_agent = $this->mysql->query('client_user',"id='{$item['agent_id']}'")[0];
                if(!empty($user_agent)){
                    $before_balance = functions::user_balance($user_agent['id'], $agent_rate,$agent_rate);
                    if($before_balance===false){
                        //回滚事务
                        $this->mysql->rollBack();
                        echo "更新代理返佣金额时错误\r\n";
                        continue;
                    }

                    $user_balance_record = functions::user_balance_record($user_agent['id'], $agent_rate, 2, $item['id'], $remark='代理返佣',$before_balance);
                    if($user_balance_record===false){
                        //回滚事务
                        $this->mysql->rollBack();
                        echo "写入代理返佣账变时错误\r\n";
                        continue;
                    }
                }
            }

            //2、盘口扣费
            if($pankou_fees>0){
                //获取代理id
                $user_pankou = $this->mysql->query('client_user',"id='{$item['pankou_id']}'")[0];
                if(!empty($user_pankou)){
                    $before_balance = functions::user_balance($user_pankou['id'], $pankou_fees,$pankou_fees);
                    if($before_balance===false){
                        //回滚事务
                        $this->mysql->rollBack();
                        echo "更新盘口扣费金额时错误\r\n";
                        continue;
                    }

                    $user_balance_record = functions::user_balance_record($user_pankou['id'], $pankou_fees, 1, $item['id'], $remark='盘口扣费',$before_balance);
                    if($user_balance_record===false){
                        //回滚事务
                        $this->mysql->rollBack();
                        echo "写入盘口扣费账变时错误\r\n";
                        continue;
                    }
                }
            }

            //更新订单表
            $result_order = $this->mysql->update("client_paofen_automatic_orders", ['batch'=>date('Ymdhis',time())], "id='{$item['id']}'");
            if(!$result_order){
                //回滚事务
                $this->mysql->rollBack();
                echo "更新订单表错误\r\n";
                continue;
            }
            //提交事务
            $this->mysql->commit();
        }
        echo 'success';

	 }

}
