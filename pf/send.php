<?php
// register_shutdown_function(function(){ var_dump(error_get_last()); });

  
    //商户订单号，商户网站订单系统中唯一订单号，必填
    $out_trade_no =$_GET['orderid'];//$_GET['orderid'];
    $total_amount = $_GET['money'];//$_GET['money'];
    $type = 'alipay';

	$payurl = "http://hbnew.uymtv.cn/send.php?orderid=".$out_trade_no."&money=".$_GET['money'];
	if('get_url' == $_GET['act']){
      $str = file_get_contents('log/'.$_POST['orderid'].'.ul1');
      echo $str;
      exit;
    }
	if('get_ordercheck' == $_GET['act']){
      $str = file_get_contents('log/'.$_GET['orderid'].'.ul2');
      echo $str;
      exit;
    }
	if('msg' == $_GET['act']){
        include "aes.php";
        $keyStr = 'U1TXC5LQ11C436IM';
        $plainText = "pay_".$_GET['id'].'_'.$total_amount.'_alipay_'.$_GET['userid'];
        $aes = new CryptAES();
        $aes->set_key($keyStr);
        $aes->require_pkcs5();
        $encText = $aes->encrypt($plainText);
        include "Mqtt.php";
        $mqtt = new Mqtt("182.254.171.217", 61613, "acc1123_server"); //实例化MQTT类
        if ($mqtt->connect(true, NULL, "admin", "ackm2389")) { 
          //如果创建链接成功
          $mqtt->publish('acc1123', $encText, 0); 
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
      $userid = file_get_contents("http://hbnew.uymtv.cn/alipay_user.php?code=".$auth_code);
      
      include "w_alipay_sk2.php";
    }
exit;
?> 
