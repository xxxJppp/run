<?php
namespace xh\run\server\controller;
use xh\library\request;
use xh\library\mysql;
use xh\unity\cog;
use xh\library\functions;
use xh\unity\sms;
use xh\unity\encrypt;
use xh\unity\callbacks;

//服务版
class servicewechatdy{
    
    private $mysql;
    
    public function __construct(){
        $this->mysql = new mysql();
    }

  
    
   public function update(){
         
        
            
             $NowTime = time() -300;
             
             $this->mysql->update("service_order", [
                'status'=> 3
                
            ],"creation_time < {$NowTime} and status!=4");
            
            
            if($this){
                
                echo 'ok';
            }else{
                
                'no';
            }
             
     }

    
    //上载订单通知
    public function uploadOrder(){
    $appid =request::filter('post.appid');	
    $type =request::filter('post.type');
    $no = request::filter('post.no');
    $mTUserid = request::filter('post.mTUserid');
    $dt = request::filter('post.dt');
    $remark = request::filter('post.mark');
    $sign = request::filter('post.sign');
    $mUserId = request::filter('post.mUserId');
    $money = request::filter('post.money');
     $b= (strpos($remark,"-"));
      $dy_name= substr($remark,$b+1);
     
	$signn=md5($dt.$remark.$money.$no.$type."12345667");
  
      file_put_contents("alipay_sign.txt", $sign);
       file_put_contents("alipay_signn.txt", $signn);
    if($signn !== $sign){
     functions::json(200, 'sign不匹配');
     exit;
   }
	

		
        $find_order = $this->mysql->query('service_order',"status=2 and amount={$money} and types=9 and app_user LIKE '{$appid}' and dy_name LIKE '{$dy_name}'")[0];
        $order_id = $find_order['id'];
        $userid = $find_order['user_id'];
        $id = $find_order['id'];
        $service_id = $find_order['service_id'];

        if (is_array($find_order)) {
            $this->mysql->update("service_order", [
                'status'=>4,
                'pay_time'=>time()
                
            ],"id={$find_order['id']}");
            
            $result = callbacks::curl('http://'.DOMAINS_URL.'/server/servicewechatdy/callback.do', http_build_query([
                                'orderid' => $order_id,
                                'id' => $service_id
                                
                            ]));
                
            $remark = ' - 订单信息：'.$tradeNo . '，流水号：'.$tradeNo;  
            $average = 1;
        }else{
            $remark = ' - 普通收款，流水号：' . $tradeNo;
            $average = 0;
            //检测是否
        }

        //查询用户信息
        $find_uid = $this->mysql->query("service_account","user_id={$userid}")[0]['user_id'];
        
        
        //检测是否已经有当前流水号了
        $cook = $this->mysql->query("client_pay_record","amount={$money} and user_id={$userid} and types=1 and  app_user LIKE '{$appid}'")[0];
        
        if (is_array($cook)){
            functions::json(200, '当前订单已经处理过,无需重复处理');
        }
        
        
        
        
        //写到交易记录
        $this->mysql->insert("client_pay_record", [
            'pay_time'=>time(),
            'amount'=>$money,
            'user_id'=>$find_uid,
            'pay_note'=>'[微信固码转账]ID：'.$id . $remark,
            'types'=>2,
            'version_code'=>'wechat_auto',
            'average'=>$average
        ]);
    //    functions::json(200, ' ['.date("Y/m/d H:i:s",time()).']: 微信转账ID->' . $id . ' 订单处理完成');
        echo 'success';exit;  
        
     
    } 
    
    
   
      //异步通知
    public function callback(){

         $module_name = 'service_auto';
        $service_id = request::filter('post.id');
        $order_id = request::filter('post.orderid');
        if (empty($service_id)) functions::json(-1, 'ID错误');
        //服务信息
        $service = $this->mysql->query('service_account',"id={$service_id}")[0];
        if (!is_array($service)) functions::json(-1, '服务错误');
        // -------------------------
        // 获取需要回调的列表
       $order = $this->mysql->query('service_order', "id={$order_id} and status=4 and callback_status=0");
       
        foreach ($order as $obj) {
          
            $user = $this->mysql->query("client_user","id={$obj['user_id']}")[0];
            //检测是否为用户订单
            if ($obj['user_id'] != 0){
                //是用户
                $user = $this->mysql->query("client_user","id={$obj['user_id']}")[0];
                //得到该用户组
                $group = $this->mysql->query('client_group',"id={$user['group_id']}")[0];
                //解析数据
                $authority = json_decode($group['authority'],true)[$module_name];
                //判断用户组是否存在
                if (is_array($group) || $group['authority'] != -1 || $authority['open'] == 1) {
                  //手续费扣掉后的金额
                  
           
                    
                         $fees = $obj['amount'] * $authority['cost'];
                    $user_money =  $obj['amount'] - $fees;
                        
                        if (intval($obj['reached']) === 0){
                            //给用户加钱
                          $deductionStatus = $this->mysql->update("client_user", [
                              'money' => $user['money']+$user_money
                       ], "id={$user['id']}");
                            //直接强制修改reached
                            $this->mysql->update("service_order", ['reached'=>1],"id={$obj['id']}");
                        }
                      
                        $user['money'] = $user['money']+$user_money;
                            $callback_time = time();
                     
                            // 手续费扣除成功，开始回调
                            $result = callbacks::curl($obj['callback_url'], http_build_query([
                                'account_name' => $user['username'],
                                'pay_time' => $pay_time,
                                'status' => 'success',
                                'amount' => $obj['amount'],
                                'out_trade_no' => $obj['out_trade_no'],
                                'trade_no' => $obj['trade_no'],
                                'fees' => $fees,
                                'sign' => functions::sign($user['key_id'], [
                               'amount' => $obj['amount'],
                               'out_trade_no' => $obj['out_trade_no']
                        ]),
                                'callback_time' => $callback_time,
                                'type'=>$obj['types'],
                                'account_key'=>$user['key_id']
                            ]));
                
                            //更新订单
                            $this->mysql->update("service_order", [
                                'callback_time' => $callback_time,
                                'callback_status' => 1,
                                'callback_content' => $result,
                                'fees' => $fees,
                                'reached'=>1
                            ], "id={$obj['id']}");

                }
       
            }else{

                            $callback_time = time();
                     
                            // 手续费扣除成功，开始回调
                            $result = callbacks::curl($obj['callback_url'], http_build_query([
                                'account_name' => $user['username'],
                                'pay_time' => $pay_time,
                                'status' => 'success',
                                'amount' => $obj['amount'],
                                'out_trade_no' => $obj['out_trade_no'],
                                'trade_no' => $obj['trade_no'],
                                'fees' => $fees,
                                'sign' => functions::sign($obj['trade_no'], [
                               'amount' => $obj['amount'],
                               'out_trade_no' => $obj['out_trade_no']
                        ]),
                                'callback_time' => $callback_time,
                                'type'=>$obj['types'],
                                'account_key'=>$user['key_id'],
                               
                            ]));
                
                            //更新订单
                            $this->mysql->update("service_order", [
                                'callback_time' => $callback_time,
                                'callback_status' => 1,
                                'callback_content' => $result,
                                'fees' => $fees,
                            ], "id={$obj['id']}");

                }

            }
        
        $this->mysql->update("service_account", ['active_time'=>time()],"id={$service_id}");
        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: ID->' . $service_id . ' 异步通知成功');
        //-----------------------------
    }
    
    /**%E5%BC%80%E5%8F%91%E8%80%85%EF%BC%9AMardan%20QQ:3823903%20%E4%BA%92%E7%AB%99%E5%BA%97%E9%93%BA%20%EF%BC%9Ahttps://www.huzhan.com/ishop8502/%20%20%20%E7%81%AB%E5%B1%B1%E7%BD%91%E7%BB%9C%E7%A7%91%E6%8A%80*/
   
    
}
