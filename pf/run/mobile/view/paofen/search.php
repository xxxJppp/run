<?php
use xh\library\url;
use xh\library\model;
$fix = DB_PREFIX;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = 0">
	
<title>店铺资料</title>

<link href="/static/Theme/css/base.css" rel="stylesheet">
<link href="/static/Theme/css/user.css" rel="stylesheet">
</head>

<body>
<header class="header">
	<div class="header-return">
	    <a href="javascript:history.go(-1);"></a>
	</div>
	
	<div class="logo">店铺资料</div>
	
	<div class="header-btn">
		<a href="SettingShopInfo.html">编辑</a>
	</div>
</header>
 <?php foreach ($result['result'] as $ru){?>
<section class="container">
    <div class="shop-card">
        <h1>备注：<?php echo $ru['name'];?></h1>
		<p>id:<?php echo $ru['id'];?></p>
    </div>
	<div class="clr"></div>
	
	<div class="form-widget">
		<div class="form-group">
			<label class="form-label">APP商户号</label>

			<div class="form-control">
				<span><?php echo $ru['app_user']?></span>
			</div>
		</div>
		
		<div class="form-group">
			<label class="form-label">二维码</label>

			<div class="form-control">
				<span><?php echo $ru['ewm_url']?></span>
			</div>
		</div>
		
		<div class="form-group">
			<label class="form-label">店铺地址</label>

			<div class="form-control">
				<span>广西南宁市青秀区金湖路63号金源CBD</span>
			</div>
		</div>
		
		<div class="form-group">
			<label class="form-label">联系电话</label>

			<div class="form-control">
				<span>13977188888</span>
			</div>
		</div>
		
		<div class="form-group">
			<label class="form-label">开业时间</label>

			<div class="form-control">
				<span>2018-7-27 09:13:15</span>
			</div>
		</div>
	</div>
	<div class="clr"></div>
	
	<div class="enter-shop">
		<a href="../Shop/ShopStore.html">进入店铺主页</a>
	</div>
 <?php }?>
</section>
</body>
</html>
