<?php

 use xh\library\url;
  use xh\library\mysql;

   $out_trade_no = $trade_no;//$_GET['orderid'];
    $total_amount = $amount;//$_GET['money'];
    $type = 'alipay';
   

	$payurl = "http://".DOMAINS_URL."/gateway/pay/automaticyunshanfu.do?id=".$id."&orderid=".$trade_no."&money=".$amount;
	if('get_url' == $_GET['act']){
      $str = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.$_GET['orderid'].'.ul1');
      echo $str;
      exit;
    }
	if('msg' == $_GET['act']){
        include ROOT_PATHS."/aes.php";
        $keyStr = 'U1TXC5LQ11C436IM';
        $plainText = "pay_".$_GET['id'].'_'.$_GET['money'].'_yun_1'; // 这个是通过mqtt传到app上的内容，  alipay是支付宝， yun是云闪付，
        $aes = new CryptAES();
        $aes->set_key($keyStr);
        $aes->require_pkcs5();
        $encText = $aes->encrypt($plainText);
         $z = substr(mt_rand(1,100), 0,100);
        include ROOT_PATHS."/Mqtt.php";
        $mqtt = new Mqtt(MQQT_HOST, MQQT_PORT, $_GET['app_user']."_server"); //实例化MQTT类  这个是mqtt的信息 
        if ($mqtt->connect(true, NULL, MQQT_USER, MQQT_PASS)) {  
          //如果创建链接成功
          $mqtt->publish($_GET['app_user'], $encText, 0); 
          $mqtt->close();    //发送后关闭链接
        }
          echo '开始创建支付连接';
    	exit;
    }
    $payorderid = $out_trade_no;
    $paymoney = $total_amount;
	$zfalipay_id= $app_user;
    $return_url = "http://".DOMAINS_URL."/server/yunshanfu/uploadOrder";

    include ROOT_PATHS."/w_yun.php";
	exit;
?>