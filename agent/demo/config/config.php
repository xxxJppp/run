<?php

	
	header('Content-Type:text/html;charset=utf8');
	date_default_timezone_set('Asia/Shanghai');

	$userid='';//平台账号 

	$userkey='';//平台密码 

	$apiurl='http://zf.zhaozhaowang.cn/pay/api.php';//网关地址
	
	$checkurl='http://zf.zhaozhaowang.cn/pay/order.php';//查单地址

	$notify='http://'.$_SERVER['HTTP_HOST'].'/demo/php/notify.php';//异步通知地址

	$return='http://'.$_SERVER['HTTP_HOST'].'/demo/php/return.php';//同步跳转地址
	
	/******************/


?>
