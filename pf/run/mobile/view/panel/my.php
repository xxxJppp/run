<?php
use xh\unity\cog;
use xh\library\url;

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = 0">
	
<title>我的</title>

<link href="/static/Theme/css/base.css" rel="stylesheet">
<link href="/static/Theme/css/user.css" rel="stylesheet">
  <link href="/static/Theme/css/trade.css" rel="stylesheet">


</head>

<body>
<header class="header">
	<div class="header-return">
	    <a href="javascript:history.go(-1);"></a>
	</div>
	
	<div class="logo">我的</div>
</header>

<section class="container">
	<div class="digital-balance">
		<div class="digital-balance-current">
			<span>余额</span>
			<h3><?php echo $_SESSION['MEMBER']['balance'];?></h3>
		</div>
		
		<div class="digital-balance-charge">
			<a href="/mobile/member/pay">
				<span>充值</span>
			</a>
		</div>
	</div>

	<div class="setting-menu">
	
	<div class="clr"></div>
	
	<div class="setting-menu">
		<a href="/mobile/member/edit" class="setting-menu-3">
			<i></i>
			<h3>提现信息及密码</h3>
		</a>

     <a href="/mobile/member/applyWithdraw" class="setting-menu-4">
			<i></i>
			<h3>申请提现</h3>
		</a>

      <a href="/mobile/member/withdraw" class="setting-menu-17">
			<i></i>
			<h3>提现记录</h3>
		</a>
<a href="/mobile/panel/paylog" class="setting-menu-17">
			<i></i>
			<h3>充值记录</h3>
		</a>

		
	</div>
	
	<div class="clr"></div>
	<div class="form-submit">
		<button onclick="logout()" type="submit" class="form-submit-btn" style="background-color:#fa5e6a;">退出登录</button>
	</div>


	
</section>


        
      

<script src="/static/Theme/js/jquery-1.11.2.min.js"></script>
<script src="/static/Theme/js/main.js"></script>
  
  <script>
    
    function logout(){
    location.href="/mobile/member/logout.do";
    
    }
  </script>
</body>
</html>
