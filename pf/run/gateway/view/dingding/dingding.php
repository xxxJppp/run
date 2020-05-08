<?php

 use xh\library\url;
  use xh\library\mysql;

   $out_trade_no = $trade_no;//$_GET['orderid'];
    $total_amount = $amount;//$_GET['money'];
    $type = 'alipay';

	$payurl = "http://dd.qakmak.com/gateway/pay/automaticdingding.do?id=".$id."&orderid=".$trade_no."&money=".$amount; 
	if('get_url' == $_GET['act']){
      $str = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.$_GET['orderid'].'.ul1');
      echo $str;
      exit;
    }
  include "/www/wwwroot/dd.qakmak.com/aes.php";
  $keyStr = 'U1TXC5LQ11C436IM';
  $plainText = "pay_".$trade_no.'_'.$amount.'_dd_1'; // 这个是通过mqtt传到app上的内容，  alipay是支付宝， yun是云闪付，
  $aes = new CryptAES();
  $aes->set_key($keyStr);
  $aes->require_pkcs5();
  $encText = $aes->encrypt($plainText);
  include "/www/wwwroot/dd.qakmak.com/Mqtt.php"; //这个是路径 
  $mqtt = new Mqtt("182.254.171.217", 61613, $app_user."_server"); //实例化MQTT类  这个是mqtt的信息 
  if ($mqtt->connect(true, NULL, "admin", "ackm2389")) {   
    //如果创建链接成功
    $mqtt->publish($app_user, $encText, 0); 
    $mqtt->close();    //发送后关闭链接
  }
    $payorderid = $out_trade_no;
    $paymoney = $total_amount;
	//$zfaccount= $account;
	//$zfpid= $pid;
	$zfdingding_id= $app_user;
    $return_url = "http://dd.qakmak.com/server/dingding/uploadOrder";
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Alipay') !== false){
    	include "/www/wwwroot/dd.qakmak.com/w_dingding2.php";
    }else{
    	include "/www/wwwroot/dd.qakmak.com/w_dingding.php";
    }
	exit;
?>