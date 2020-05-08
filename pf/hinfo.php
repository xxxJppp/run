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
                       'pdd_notify_url'=>"http://".DOMAINS_URL."/server/huafei/uploadOrder" , // 微信订单回调地址
					   'notify_key'=>'12345667',
					   'app_type'=>1,
					   'receive_url'=>'http://'.DOMAINS_URL.'/hinfo.php',
					   'run_alipay'=>1,
					   'run_weixin'=>1,
					   'run_qq'=>1,
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