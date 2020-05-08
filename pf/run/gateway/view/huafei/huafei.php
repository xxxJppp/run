<?php

 use xh\library\url;
  use xh\library\mysql;

   $out_trade_no = $trade_no;//$_GET['orderid'];
    $total_amount = $amount;//$_GET['money'];
    $type = 'alipay';
   

	$payurl = "http:/".DOMAINS_URL."/gateway/pay/automatichuafei.do?id=".$id."&orderid=".$trade_no."&money=".$amount;
	if('get_url' == $_GET['act']){
      $str = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.$_GET['orderid'].'.ul1');
      
      if(!empty($str)){
        $str2 = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.$_GET['orderid'].'.1.html');
        if(empty($str2)){
          $data = json_decode($str,true);
          $url = 'https'.explode('https',$data['pay_url'])[1];

          $url = str_replace('订单编号','%e8%ae%a2%e5%8d%95%e7%bc%96%e5%8f%b7',$url);
          $url2 = explode('&return_url=',$url);
          $url3 = explode('&sign=',$url2[1]);
          $url = $url2[0].'&return_url='.urlencode($url3[0]).'&sign='.$url3[1];


          $url2 = explode('&sign=',$url);
          $url3 = explode('&sign_type=',$url2[1]);
          $url = $url2[0].'&sign='.urlencode($url3[0]).'&sign_type='.$url3[1];
          file_put_contents($_SERVER['DOCUMENT_ROOT'].'/log/'.$_GET['orderid'].'1.html','<script>location.href="'.$url.'"</script>');
        }
      	echo '{"code":1,"pay_url":"http://'.DOMAINS_URL.'/log/'.$_GET['orderid'].'1.html"}';
        exit;
      }
      echo $str;
      exit;
    }
	if('msg' == $_GET['act']){
        include ROOT_PATHS."/aes.php";
        $keyStr = 'U1TXC5LQ11C436IM';
        $plainText = "pay_".$_GET['id'].'_'.$_GET['money'].'_pdd_'.$_GET['phone']; // 这个是通过mqtt传到app上的内容，  alipay是支付宝， yun是云闪付，
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
          echo '开始创建支付连接'.$plainText;
    	exit;
    }
    $payorderid = $out_trade_no;
    $paymoney = $total_amount;
	//$zfaccount= $account;
	//$zfpid= $pid;
	$zfalipay_id= $app_user;
    $return_url = "http://".DOMAINS_URL."/server/huafei/uploadOrder";

 include ROOT_PATHS."/w_pdd.php";
	exit;
?>