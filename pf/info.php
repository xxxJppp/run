<?php
include "config.php";
ks;
use xh\library\url;
        $act = $_POST['act'];
        $appid = $_POST['appid'];

file_put_contents("awlog.txt", '---time:'.date('Y-m-d H:i:s',time()).'---xml:'.$GLOBALS['HTTP_RAW_POST_DATA'].var_export($_POST,TRUE).PHP_EOL, FILE_APPEND);
			if('login' == $act){
					echo json_encode(array('msg'=>'登录成功',
					   'status'=>'1',
					   'return_url'=>'/index/panel/home.do',
					   'notify_url'=>"http://".DOMAINS_URL."/server/moren/uploadOrder" ,  // 默认回调地址
					   'alipay_notify_url'=>"http://".DOMAINS_URL."/server/alipay/uploadOrder" , // 支付宝订单回调地址
                      'alipay_gm_notify_url'=>"http://".DOMAINS_URL."/server/alipaygm/uploadOrder" , // 支付宝固码订单回调地址
					   'yun_notify_url'=>"http://".DOMAINS_URL."/server/yunshanfu/uploadOrder" , // 云闪付订单回调地址
                       'lakala_notify_url'=>"http://".DOMAINS_URL."/server/lakala/uploadOrder" , // 拉卡拉订单回调地址
                       'wechat_notify_url'=>"http://".DOMAINS_URL."/server/wechatsj/uploadOrder" , // 微信订单回调地址
                       'wechat_sj_notify_url'=>"http://".DOMAINS_URL."/server/wechatsj/uploadOrder" , // 微信商家订单回调地址
                       'wechat_dy_notify_url'=>"http://".DOMAINS_URL."/server/wechatdy/uploadOrder" , // 微信订单回调地址
                       'pdd_notify_url'=>"http://".DOMAINS_URL."/server/pddgm/uploadOrder" , // 微信订单回调地址
                       'nxys_1_notify_url'=>"http://".DOMAINS_URL."/server/nxysali/uploadOrder" , // 农信支付宝
                      'nxys_2_notify_url'=>"http://".DOMAINS_URL."/server/nxyswx/uploadOrder" , // 农信微信
                       'nxys_yl_notify_url'=>"http://".DOMAINS_URL."/server/nxysyl/uploadOrder" , // 农信易扫银联
                        'cashbar_notify_url'=>"http://".DOMAINS_URL."/server/sqbalipay/uploadOrder" , // 收钱吧支付宝
					   'cashbarwx_notify_url'=>"http://".DOMAINS_URL."/server/sqbwx/uploadOrder" , // 收钱吧微信
					   'notify_key'=>'12345667',
					   'app_type'=>1,
					   'receive_url'=>'http://'.DOMAINS_URL.'/info.php',
					   'run_alipay'=>1,
					   'run_weixin'=>1,
					   'run_qq'=>1,
                       'yun_sleed'=>20, 
                       'lakala_sleed'=>180,                 
					   'mqtt_need'=>1,
                       "mqtt_host"=>"tcp://".MQQT_HOST.":".MQQT_PORT,"mqtt_username"=>MQQT_USER,"mqtt_password"=>MQQT_PASS,"mqtt_topic"=>$appid,
					   'appid'=>$appid));
			}elseif('change_acp' == $act){
			}elseif('logout' == $act){
              echo json_encode(array('msg'=>'注销成功',
					   'status'=>'1'));
			}elseif('rec_pay' == $act){
				$data = $_POST;
             	$array1 = array('code'=>1,'pay_url'=>trim($_POST['payurl']));
            	file_put_contents('log/'.$_POST['mark'].'.ul1',json_encode($array1));
              	echo 'success';
			}else{
				echo 's3c';
				
			}
		exit;
?>