<?php

 use xh\library\url;
  use xh\library\mysql;

   $out_trade_no = $trade_no;//$_GET['orderid'];
    $total_amount = $amount;//$_GET['money'];
    $type = 'alipay';
   

	$payurl = "http://x.qakmak.com/gateway/pay/alipaysk.do?id=".$id."&orderid=".$trade_no."&money=".$amount;
	if('get_url' == $_GET['act']){
      $str = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.$_GET['orderid'].'.ul1');
      echo $str;
      exit;
    }
	if('msg' == $_GET['act']){
        include "/www/wwwroot/x.qakmak.com/aes.php";
        $keyStr = 'U1TXC5LQ11C436IM';
        $plainText = "pay_".$_GET['id'].'_'.$_GET['money'].'_alipay_1'; // 这个是通过mqtt传到app上的内容，  alipay是支付宝， yun是云闪付，
        $aes = new CryptAES();
        $aes->set_key($keyStr);
        $aes->require_pkcs5();
        $encText = $aes->encrypt($plainText);
         $z = substr(mt_rand(1,100), 0,100);
        include "/www/wwwroot/x.qakmak.com/Mqtt.php";
        $mqtt = new Mqtt("182.254.171.217", 61613, $_GET['app_user']."_server"); //实例化MQTT类
        if ($mqtt->connect(true, NULL, "admin", "ackm2389")) { 
          //如果创建链接成功
          $mqtt->publish($_GET['app_user'], $encText, 0); 
          $mqtt->close();    //发送后关闭链接
        }
          echo '开始创建支付连接';
    	exit;
    }
    $payorderid = $out_trade_no;
    $paymoney = $total_amount;
    $return_url = "http://hbnew.uymtv.cn/callback.php?mark=".$out_trade_no;

  //    include "w_alipay_sk2.php";exit;
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Alipay') === false){
        header("location: https://render.alipay.com/p/s/i?scheme=".urlencode("alipays://platformapi/startapp?saId=10000007&qrcode=".urlencode($payurl)));
    }else{
      $auth_code = $_GET['auth_code'];
      if(empty($auth_code)){
        header("location: https://openauth.alipay.com/oauth2/publicAppAuthorize.htm?app_id=2018122462654547&scope=auth_base&redirect_uri=".urlencode($payurl)."&state=1");
        exit;
      }
      $userid = file_get_contents("http://x.qakmak.com/alipay_user.php?code=".$auth_code);
      
      include "/www/wwwroot/x.qakmak.com/w_alipay.php";
    }
exit;

?>