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
class paofenwechatdy{
    
    private $mysql;
    
    public function __construct(){
        $this->mysql = new mysql();
    }
    

 public function update(){
		 
		
			
			 $NowTime = time() -300;
			 
			 $this->mysql->update("client_paofen_automatic_orders", [
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
	
     file_put_contents("paofen_log32.txt", json_encode($_POST));
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
  
      file_put_contents("paofen_sign.txt", $sign);
       file_put_contents("paofen_signn.txt", $signn);
     if($signn !== $sign){
      functions::json(200, 'sign不匹配');
       exit;
     }
	

		

        $find_order = $this->mysql->query('client_paofen_automatic_orders',"status=2 and type=6 and amount={$money} and app_user LIKE '{$appid}' and dy_name LIKE '{$dy_name}'")[0];
        $order_id = $find_order['id'];
		$paofen_id = $find_order['paofen_id'];
       $id = $find_order['user_id'];
	
        if (is_array($find_order)) {
            $this->mysql->update("client_paofen_automatic_orders", [
                'status'=>4,
                'pay_time'=>time()
				
            ],"id={$find_order['id']}");
			
			$result = callbacks::curl('http://'.DOMAINS_URL.'/server/paofenwechatdy/callback.do', http_build_query([
                                'orderid' => $order_id,
                                'id' => $paofen_id
                                
                            ]));
				
            $remark = ' - 订单信息：'.$tradeNo . '，流水号：'.$tradeNo;  
            $average = 1;
        }else{
            $remark = ' - 普通收款，流水号：' . $tradeNo;
            $average = 0;
            //检测是否
        }

        //查询用户信息
        $find_uid = $this->mysql->query("client_paofen_automatic_account","user_id={$id}")[0]['user_id'];

        //检测是否已经有当前流水号了
        $cook = $this->mysql->query("client_pay_record","amount={$money} and user_id={$find_uid} and types=2 and version_code='paofen_auto' and trade_no like '%{$remark}%'")[0];
        
        if (is_array($cook)){
            functions::json(200, '当前订单已经处理过,无需重复处理');
        }
        
		
	    
		
        //写到交易记录
        $this->mysql->insert("client_pay_record", [
            'pay_time'=>time(),
            'amount'=>$money,
            'user_id'=>$find_uid,
            'pay_note'=>'[微信店员]ID：'.$id . $remark,
            'types'=>2,
            'version_code'=>'paofen_auto',
            'average'=>$average
        ]);
       // functions::json(200, ' ['.date("Y/m/d H:i:s",time()).']: 订单ID->' . $order_id . ' 订单处理完成');
		  echo 'success';exit;
		
	 
    } 
    
	
      //异步通知
   //异步通知
    public function callback(){


         $module_name = 'paofen_auto';
        $paofen_id = request::filter('post.id');
		$order_id = request::filter('post.orderid');
        if (empty($paofen_id)) functions::json(-1, 'ID错误');
        //服务信息
        $service = $this->mysql->query('client_paofen_automatic_account',"id={$paofen_id}")[0];
        if (!is_array($service)) functions::json(-1, '服务错误');
        // -------------------------
        // 开启事务
        $this->mysql->select('start transaction');
        // 查询订单并且加上悲观锁
        // 获取需要回调的列表
       $order = $this->mysql->query('client_paofen_automatic_orders', "id={$order_id} and status=4 and callback_status=0", null, null, 'desc', null, 'for update');
      
        foreach ($order as $obj) {
            //检测是否为用户订单
            if ($obj['user_id'] != 0){
              
         $user = $this->mysql->query("client_user", "id={$obj['user_id']}")[0];
        //得到用户组
        $group = $this->mysql->query('client_group', "id={$user['group_id']}")[0];
        $agent_group = $this->mysql->query('agent_rate',"uid={$obj['user_id']}")[0];
      
        //解析数据
        $authority = json_decode($group['authority'], true)[$module_name];
        if (!is_array($group) || $group['authority'] == -1 || $authority['open'] != 1) functions::json(-1, '用户组错误');

        $user = $this->mysql->query("client_user", "id={$obj['user_id']}")[0];
        if (!is_array($user)) functions::json(-1, '商户错误');

      //获取上级用户组
        $shangji=$user['level_id'];
              
              if($shangji !== '0' ){   
                
        $duser = $this->mysql->query("client_user", "id={$shangji}")[0];
        $dailigroup = $this->mysql->query('client_group', "id={$duser['group_id']}")[0];
              //获取盘口用户组
       $puser = $this->mysql->query("client_user", "id={$obj['pankou_id']}")[0];
       $pankougroup = $this->mysql->query('client_group', "id={$puser['group_id']}")[0];
       $pankouauthority = json_decode($pankougroup['authority'], true)[$module_name];
              
        //解析数据
        $dailiauthority = json_decode($dailigroup['authority'], true)[$module_name];
          //获取代理给商户的费率
        $shanghuauthority = json_decode($agent_group['authority'], true);
      
           //代理的获利   代理的费率- 给商户的费率
        $fess2= $dailiauthority['cost']-$shanghuauthority{$module_name};
    
      //系统对代理的费率
       $dailifees = $obj['amount'] * $dailiauthority['cost'];
      
       $dailihuoli = $obj['amount'] * $fess2;


       $shanghufees = $obj['amount'] * $shanghuauthority{$module_name};
     

     $pankoufees = $obj['amount'] * $pankouauthority['cost'];
     
    $pankouhuoli = $obj['amount'] - $pankoufees;
      
        $isCallback = 0;

        if ($order['reached'] == 1) {
            $isCallback = 1;
        } else {
          
             $shanghu_balance = $user['balance'] +  $shanghufees; // 用户最终余额
            $user_balance = floatval($shanghu_balance);
          
                $daili_balance = $duser['balance'] +  $dailihuoli; // 代理最终余额
                $daili_balance = floatval($daili_balance);
          
          
                $pankou_balance = $puser['balance'] +  $pankouhuoli; //盘口最终余额
                $pankou_balance = floatval($pankou_balance);
          
          
            if ($user_balance >= 0) {
                $isCallback = 1;
              
            

                $updateStatus = $this->mysql->update("client_user", ['balance' => $user_balance], "id={$user['id']}");
               
                $agentlog = $this->mysql->query('agent_huoli_log', "trade_no LIKE '{$obj['trade_no']}'")[0];
              
                if (!is_array($agentlog)){
              
                        //写代理获利记录
                    $alog=$this->mysql->insert("agent_huoli_log", [
                          'uid' => $obj['user_id'],
                          'agent_id' =>$duser['id'],
                          'orderid' => $order_id,
                          'amount'    => $obj['amount'],
                          'huoli'  => $dailihuoli,
                          'trade_no' =>$obj['trade_no'],
                          'daili_balance' =>$daili_balance,
                         'shanghu_fees' =>$shanghufees,
                        'type' =>'跑分微信店员',
                         'time' => time()
                  ]);
              
               if ($alog > 0) {

            $updateStatus_daili =$this->mysql->update("client_user", ['balance' => $daili_balance], "id={$duser['id']}");
        }
                }
              //写盘口获利记录
              
                 $pankoulog = $this->mysql->query('pankou_huoli_log', "trade_no LIKE '{$obj['trade_no']}'")[0];
              
                if (!is_array($pankoulog)){
                    $plog= $this->mysql->insert("pankou_huoli_log", [
                          'uid' => $puser['id'],
                          'orderid' => $order_id,
                          'amount'    => $obj['amount'],
                          'balance'  => $pankou_balance,
                          'trade_no' =>$obj['trade_no'],
                          'old_balance' =>$puser['balance'],
                         'pankou_fees' =>$pankoufees,
                        'type' =>$obj['type'],
                         'time' => time()
                  ]);
           if ($plog > 0) {

             $updateStatus_pankou =$this->mysql->update("client_user", ['balance' => $pankou_balance], "id={$puser['id']}");
        }
             
                }
            }
        }
              }else{
           
                 //获取盘口用户组
       $puser = $this->mysql->query("client_user", "id={$obj['pankou_id']}")[0];
       $pankougroup = $this->mysql->query('client_group', "id={$puser['group_id']}")[0];
       $pankouauthority = json_decode($pankougroup['authority'], true)[$module_name];
                									// 开始扣手续费
              
              
           $pankoufees = $obj['amount'] * $pankouauthority['cost'];
           $pankouhuoli = $obj['amount'] - $pankoufees;      
              
           $pankou_balance = $puser['balance'] +  $pankouhuoli; // 盘口最终余额
           $pankou_balance = floatval($pankou_balance);
              
            $fees = $obj['amount'] * $authority['cost'];
                $dailifees = 0;
              $shanghufees = $fees;
              $dailihuoli = 0;
              
            $user_balance = $user['balance'] + $fees; // 用户最终余额
            if ($user_balance >= 0) {
              
           
                // 扣除费用
                $updateStatus = $this->mysql->update("client_user", ['balance' => $user_balance], "id={$user['id']}");
              
           
                $pankoulog = $this->mysql->query('pankou_huoli_log', "trade_no LIKE '{$obj['trade_no']}'")[0];
              
                if (!is_array($pankoulog)){
              
                  //写盘口获利记录
                    $plog= $this->mysql->insert("pankou_huoli_log", [
                          'uid' => $puser['id'],
                          'orderid' => $order_id,
                          'amount'    => $obj['amount'],
                          'balance'  => $pankou_balance,
                          'trade_no' =>$obj['trade_no'],
                          'old_balance' =>$puser['balance'],
                         'pankou_fees' =>$pankoufees,
                        'type' =>$obj['type'],
                         'time' => time(),
                  ]);
              
               if ($plog > 0) {

             $updateStatus_pankou =$this->mysql->update("client_user", ['balance' => $pankou_balance], "id={$puser['id']}");
                      }
              
                }
            
              }
            
            
            }
              
               if ($updateStatus !== false) { 
                 
                     $mauser =  $this->mysql->query("client_user", "id={$obj['user_id']}")[0];
                //写押金记录 冻结金额
                     $this->mysql->insert("mashang_yajin_log", [
                          'uid' =>$obj['user_id'],
                          'trade_no' =>$obj['trade_no'],
                          'money'    => $obj['amount'],
                          'old_balance'    =>  $user['balance'],
                         'new_balance'    => $mauser['balance'],
                         'remark'    =>'回调成功！订单号：'.$obj['trade_no'].',扣除金额：'.$obj['amount'].'元，扣除前余额：'. $user['balance'].'元，扣除后余额：'. $mauser['balance'].'元',
                         'time' => time(),
                        'status' => 2
                       
                     ]);
                 
                    $user['balance'] = $user_balance;
                    $callback_time = time();
                          
						 
                            // 手续费扣除成功，开始回调
                            $result = callbacks::curl($obj['callback_url'], http_build_query([
                                'account_name' => $user['username'],
                               'pankou_id' => $puser['id'],
                                'pay_time' => $pay_time,
                                'status' => 'success',
                                'amount' => $obj['amount'],
                                'out_trade_no' => $obj['out_trade_no'],
                                'trade_no' => $obj['trade_no'],
                                'fees' => $fees,
                                'sign' => functions::sign($puser['key_id'], [
                               'amount' => $obj['amount'],
                               'out_trade_no' => $obj['out_trade_no']
                        ]),
                                'callback_time' => $callback_time,
                                'type'=>$obj['types'],
                                'account_key'=>$puser['key_id'],
								'money'=>$obj['money']
                            ]));
                            //更新订单
                            $this->mysql->update("client_paofen_automatic_orders", [
                                'callback_time' => $callback_time,
                                'callback_status' => 1,
                                'callback_content' => $result,
                               'fees' => $shanghufees,
                               'xitong_fees'   => $dailifees,
                                'agent_rate'     => $dailihuoli,
                               'pankou_fees'     => $pankoufees,
                                'reached'         =>1
                            ], "id={$obj['id']}");

                }
            }
		}
        $this->mysql->update("client_paofen_automatic_account", ['active_time'=>time()],"id={$paofen_id}");
        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: ID->' . $paofen_id . ' 异步通知成功');
        //-----------------------------
    }
    
    /**%E5%BC%80%E5%8F%91%E8%80%85%EF%BC%9AMardan%20QQ:3823903%20%E4%BA%92%E7%AB%99%E5%BA%97%E9%93%BA%20%EF%BC%9Ahttps://www.huzhan.com/ishop8502/%20%20%20%E7%81%AB%E5%B1%B1%E7%BD%91%E7%BB%9C%E7%A7%91%E6%8A%80*/
   
    
}
