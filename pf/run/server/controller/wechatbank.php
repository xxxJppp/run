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
class wechatbank{
    
    private $mysql;
    
    public function __construct(){
        $this->mysql = new mysql();
    }
    

 public function update(){
		 
		
			
			 $NowTime = time() -600;
			 
			 $this->mysql->update("client_wechatbank_automatic_orders", [
                'status'=> 3
                
            ],"creation_time < {$NowTime} and status!=4");
			
			
			if($this){
				
				echo 'ok';
			}else{
				
				'no';
			}
             
	 }
    
	

	
		 /**
     * 正则表达式
     * @param  [type] $str        [description]
     * @param  [type] $regularStr [description]
     * @return [type]             [description]
     */
	public function getRegular($str, $regularStr){
		preg_match_all ($regularStr, $str, $pat_array, PREG_PATTERN_ORDER);
		return ($pat_array);
	}
	
    
    //上载订单通知
    public function uploadOrder(){

		file_put_contents("yinhang_log.txt", json_encode($_POST));

		$money = request::filter('post.money');
        $wechatbank_phone = trim(request::filter('post.trade_no'));
       $mcid= request::filter('post.mcid');
       $dt= request::filter('post.dt');
       $sign= request::filter('post.sign');
      $signn= md5("huoshan123456".$wechatbank_phone.$dt.$mcid);

     if($signn !== $sign){
      functions::json(200, 'sign不匹配');
       exit;
     }
	

	   
	   
			   
		if($wechatbank_phone == '95533'){//建设银行
			
			 $regular = "/人民币(.*?)元/";
             $Arr     = $this->getRegular($money, $regular);
	         $money2 = $Arr[1][0] ;
			 
			
			
		}else if($wechatbank_phone == '95588'){//工商
			
			  //$regular = "@收入\(.*支付宝\)(.*?)元@is";
            $regular = "@收入\(.*\)(.*?)元@is";
             $Arr     = $this->getRegular($money, $regular);
	         $money2 = $Arr[1][0] ;
			
			
		}else if($wechatbank_phone == '95566'){//中国银行
			
			 $regular = "/人民币(.*?)元/";
             $Arr     = $this->getRegular($money, $regular);
	         $money2 = $Arr[1][0] ;
			 
			
			
		}else if($wechatbank_phone == '95599'){//农行
			
			 $regular = "/人民币(.*?)，/";
             $Arr     = $this->getRegular($money, $regular);
	         $money2 = $Arr[1][0] ;
			 
			
		}else if($wechatbank_phone == '95555'){//招商银行
			
			 $regular = "/人民币(.*?)，/";
             $Arr     = $this->getRegular($money, $regular);
	         $money2 = $Arr[1][0] ;
			
			
		}else if($wechatbank_phone == '9555595555'){//招商银行
			
			 $regular = "/人民币(.*?)，/";
             $Arr     = $this->getRegular($money, $regular);
	         $money2 = $Arr[1][0] ;
			
			
		}else if($wechatbank_phone == '95568'){//民生银行
			
			$regular = "/存入￥(.*?)元/";
             $Arr     = $this->getRegular($money, $regular);
	         $money2 = $Arr[1][0] ;
			
			
		}else if($wechatbank_phone == '9556895568'){//民生银行
			
			$regular = "/存入￥(.*?)元/";
             $Arr     = $this->getRegular($money, $regular);
	         $money2 = $Arr[1][0] ;
			
			
		}else if($wechatbank_phone == '95511'){//平安银行
			
			 $regular = "/人民币(.*?)元/";
             $Arr     = $this->getRegular($money, $regular);
	         $money2 = $Arr[1][0] ;
			
			
		}else if($wechatbank_phone == '95559'){//交通银行
			
			  $regular = "/转入(.*?)元/";
             $Arr     = $this->getRegular($money, $regular);
	         $money2 = $Arr[1][0] ;
			
			
		}else if($wechatbank_phone == '95580'){//邮政银行
			
			 $regular = "/金额(.*?)元/";
             $Arr     = $this->getRegular($money, $regular);
	         $money2 = $Arr[1][0] ;
			
			
		}else if($wechatbank_phone == '95528'){//浦发银行
			
			 $regular = "/存入(.*?)[/";//存入1.00[
             $Arr     = $this->getRegular($money, $regular);
	         $money2 = $Arr[1][0] ;
			
			
		}


        $find_order = $this->mysql->query('client_wechatbank_automatic_orders',"app_user LIKE '{$mcid}' and status=2 and amount={$money2}")[0];
        $order_id = $find_order['id'];
		$alipay_id = $find_order['alipay_id'];
		$user_id = $find_order['user_id'];
		
		file_put_contents("yinhang_or.txt", json_encode($order_id));
        if (is_array($find_order)) {
            $this->mysql->update("client_wechatbank_automatic_orders", [
                'status'=>4,
                'pay_time'=>time()
            ],"id={$find_order['id']}");
			
			$result = callbacks::curl('http://'.DOMAINS_URL.'/server/wechatbank/callback.do', http_build_query([
                                'orderid' => $order_id,
                                'id' => $alipay_id
                                
                            ]));
				
            $remark = ' - 订单信息：'.$tradeNo . '，流水号：'.$tradeNo;  
            $average = 1;
        }else{
            $remark = ' - 普通收款，流水号：' . $tradeNo;
            $average = 0;
            //检测是否
        }

        //查询用户信息
        $find_uid = $this->mysql->query("client_wechatbank_automatic_account","user_id={$user_id}")[0]['user_id'];
		
		file_put_contents("yinhang_uid.txt", json_encode( $find_uid));
        
        //检测是否已经有当前流水号了
        $cook = $this->mysql->query("client_pay_record","amount={$money2} and user_id={$find_uid} and types=2 and version_code='wechatbank_auto' and wechatbankorderid like '%{$tradeNo}%'")[0];
        
        if (is_array($cook)){
            functions::json(200, '当前订单已经处理过,无需重复处理');
        }
        
		
	    
		
        //写到交易记录
        $this->mysql->insert("client_pay_record", [
            'pay_time'=>time(),
            'amount'=>$money,
            'user_id'=>$find_uid,
            'pay_note'=>'[银行转账]ID：'.$id . $remark,
            'types'=>2,
            'version_code'=>'wechatbank_auto',
            'average'=>$average
        ]);
     //   functions::json(200, ' ['.date("Y/m/d H:i:s",time()).']: 银行转账订单ID->' . $order_id . ' 订单处理完成');
		  echo 'success';exit;
		
	 
    } 
    
	
   
      //异步通知
    public function callback(){
       // $module_name = 'service_auto';
         $module_name = 'wechatbank_auto';
        $alipay_id = request::filter('post.id');
		$order_id = request::filter('post.orderid');
        if (empty($alipay_id)) functions::json(-1, 'ID错误');
        //服务信息
        $service = $this->mysql->query('client_wechatbank_automatic_account',"id={$alipay_id}")[0];
        if (!is_array($service)) functions::json(-1, '服务错误');
        // -------------------------
        // 获取需要回调的列表
       $order = $this->mysql->query('client_wechatbank_automatic_orders', "id={$order_id} and status=4 and callback_status=0");
      
        foreach ($order as $obj) {
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
                  
											// 开始扣手续费
            $fees = $obj['amount'] * $authority['cost'];
            $user_balance = $user['balance'] - $fees; // 用户最终余额
            if ($user_balance >= 0) {
                // 扣除费用
                $deductionStatus = $this->mysql->update("client_user", [
                    'balance' => $user_balance
                ], "id={$user['id']}");
                if ($deductionStatus > 0 || $obj['amount'] < 1) {
                    $user['balance'] = $user_balance;
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
                            $this->mysql->update("client_wechatbank_automatic_orders", [
                                'callback_time' => $callback_time,
                                'callback_status' => 1,
                                'callback_content' => $result,
                                'fees' => $fees,
                                'reached'=>1
                            ], "id={$obj['id']}");

                }
            }
        }
			}
		}
        $this->mysql->update("client_wechatbank_automatic_account", ['active_time'=>time()],"id={$alipay_id}");
        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: ID->' . $alipay_id . ' 异步通知成功');
        //-----------------------------
    }
    
    /**%E5%BC%80%E5%8F%91%E8%80%85%EF%BC%9AMardan%20QQ:3823903%20%E4%BA%92%E7%AB%99%E5%BA%97%E9%93%BA%20%EF%BC%9Ahttps://www.huzhan.com/ishop8502/%20%20%20%E7%81%AB%E5%B1%B1%E7%BD%91%E7%BB%9C%E7%A7%91%E6%8A%80*/
   
    
}
