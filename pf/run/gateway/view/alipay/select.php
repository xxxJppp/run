<?php
use xh\library\url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   
	<title>收银台</title>
</head>
<body>

<div id="main-container">
	<h1 class="mod-title"> <img class="ico_log"   src="/static/logo_alipay.jpg"> </h1>
 
 
<div class="amount" id="money" style="padding-top:10px;margin:8px;">充值金额 <span style="color:red;"><?php echo $amount;?></span>元</div>


	<style>
		*{
			margin: 0;
			padding: 0;
			border: 0;
		}
		#main-container{
			list-style: none;
			width: 80%;
			margin: 0 auto;
		}
		.list {
			list-style: none;
		}
		.list li{
			padding: 5px;
			background: #eee; 
			margin-top: 5px;

		}
		.list a{
			color: #fff;
			background: red;
			padding: 2px;
			text-decoration: none;
			font-size: 12px;
			float: right;
		}
	</style>
	<ul class="list">
		<li>飞行模式 <a href="zzh5.do?id=<?php echo $id;?>">点击打开（支付宝专用）</a></li>
		<li>延时模式<a href="delayAlipay?id=<?php echo $id;?>">点击打开（快速支付）</a></li>
	</ul>

	<div>重要提醒</div>
</div>
</body>
</html>