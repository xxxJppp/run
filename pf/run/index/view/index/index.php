<?php
use xh\library\url;
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title><?php echo WEB_NAME; ?></title>
<link rel="stylesheet" type="text/css" href="/static/images/style.css" />
</head>

<body>


<div class="m-head">
	
	
	<div class="m-head-nav">
		<ul class="c-wrapper">
			<li class="m-head-nav-logo">
				<h4 style="font-size: 28px;font-weight: bold;line-height: 61px;"><?php echo WEB_NAME; ?></h4>
			</li>

			<li class="m-head-nav-item  active">
				<a href="/">首页</a>
			</li>

			<li class="m-head-nav-item  ">
				<a href="/index/user/login">商户登录</a>
			</li>

          <li class="m-head-nav-item  ">
				<a href="/mashang/user/login">供码登录</a>
			</li>
          
          <li class="m-head-nav-item  ">
				<a href="/pankou/user/login">盘口登录</a>
			</li>
          
          <li class="m-head-nav-item  ">
				<a href="/agent/user/login">代理登录</a>
			</li>
			
			
			<li class="m-head-nav-item m-head-nav-right ">
				<a href="/demo">支付体验</a>
			</li>
          
          
			<li class="m-head-nav-item m-head-nav-right ">
				<a href="/index/user/register">商户注册</a>
			</li>


		</ul>
	</div>
</div>
<div class="index-top">
	<div class="m-carousel">
		<div class="bd">
			<ul class="m-carousel-list">

				<li style="background-image: url(/static/images/banner.jpg);">
					
						<h2 class="c-line-clamp m-carousel-title">“<?php echo WEB_NAME; ?>” 为支付而生！</h2>
						<p class="c-line-clamp m-carousel-note" style="margin-top:40px">一款专为个人和企业服务的产品，让在线交易更快，更简单！一次对接，全渠道聚合，多场景支持。</p>
						
					
						<p class="m-carousel-btn"><a href="/index/user/login">商户登录</a></p>
						<p class="m-carousel-btn"><a href="/mashang/user/login">供码登录</a></p>
						<p class="m-carousel-btn"><a href="/pankou/user/login">盘口登录</a></p>
						<p class="m-carousel-btn"><a href="/agent/user/login">代理登录</a></p>
						
					
				</li>

				
			</ul>
		</div>
		
	</div>
	<div class="index-top-bar">
		<div class="c-wrapper">
			<div class="c-row">
			
			<p style="text-align:center;">Copyright 2018-2019 <?php echo WEB_NAME; ?> All Rights Reserved</p>
				
			</div>
		</div>
	</div>
</div>

</body>

</html>