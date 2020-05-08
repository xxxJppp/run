<?php
use xh\library\url;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = 0">
	
<title>添加账号</title>

<link href="/static/Theme/css/base.css" rel="stylesheet">
<link href="/static/Theme/css/user.css" rel="stylesheet">
 <script src="/static//js/llqrcode.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/js/analyticCode.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
  		<style type="text/css">
		
			.module-content{
				min-width: 770px;
				max-width: 1000px;
				width: 100%;
				color: #000;
				margin: 0 auto;
			}
			.module-head{
				text-align: center;
				font-weight: 500;
				margin: 0;
				font-size: 30px;
				height: 100px;
				line-height: 100px;
				color: #000;
			}
			.box h3{
				font-weight: 300;
				margin: 0;
				font-size: 20px;
				height: 60px;
				line-height: 60px;
				color: #000;
			}
			.url-box{
				height: 30px;
				line-height: 30px;
				font-size: 14px;
			}
			#file{
				position: absolute;
				width: 120px;
				height: 120px;
				opacity: 0;
				top: 0;
				left: 0;
				overflow: hidden;
				z-index: 10;
			}
          .form-submit-btn a{color:white}
		</style>
<header class="header">
	<div class="header-return">
	    <a href="javascript:history.go(-1);"></a>
	</div>
	
	<div class="logo">添加账号</div>
</header>

<section class="container">
	<div class="setting-form">
		<div class="form-widget">


				<div class="form-submit">
                  <p type="submit" class="form-submit-btn" ><a  href="/mobile/paofen/addwechat">添加微信固码</a></p>
				</div>
          
          
				<div class="form-submit">
                  <p type="submit" class="form-submit-btn" ><a href="/mobile/paofen/addwechatdy">添加微信店员</a></p>
				</div>
          
          <div class="form-submit">
                  <p type="submit" class="form-submit-btn" ><a href="/mobile/paofen/addalipay">添加支付宝固码</a></p>
				</div>
          
          <div class="form-submit">
                  <p type="submit" class="form-submit-btn" ><a href="/mobile/paofen/addalipaypid">添加支付宝转账模式</a></p>
				</div>
          
          <div class="form-submit">
                  <p type="submit" class="form-submit-btn" ><a href="/mobile/paofen/addbank">添加支付宝/微信转卡</a></p>
				</div>
	
		</div>
	</div>
</section>


</body>
</html>
