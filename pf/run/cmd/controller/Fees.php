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

	 }

    /**
     * 回调
     */
    public function callback()
    {
        //查询未回调的订单
        $order_data = $this->mysql->query('client_paofen_automatic_orders',"callback_status=0 and callback_count<10 and status=4 and reached=1",'','','',20);
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
