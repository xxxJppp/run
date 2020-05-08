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
	
<title>充值记录</title>

<link href="/static/Theme/css/base.css" rel="stylesheet">
<link href="/static/Theme/css/trade.css" rel="stylesheet">
</head>

<body>
<header class="header">
	<div class="header-return">
	    <a href="javascript:history.go(-1);"></a>
	</div>
	
	<div class="logo">充值记录</div>
</header>

<section class="container">
	
	
	<!--<div class="no-content">
		<i></i>
		<p>暂无内容</p>
	</div>-->
	
	<div class="record-list">
	    <div class="record-list-title">
			
			<span>原金额</span>
           <span>充值金额</span>
			<span>最终金额</span>
			<span>充值时间</span>
		</div>
		
       <?php  foreach ($member['result'] as $em){?>
		<div class="record-list-content">
          <span><?php echo $em['old_money'];?></span>
			<span><?php echo $em['money'];?></span>
			<span><?php echo $em['new_money'];?></span>
			<span><?php echo date("Y/m/d H:i:s",$em['time']);?></span>
		</div>
		 <?php }?>
		
		<div class="load-no-more">
			<span>没有更多了</span>
		</div>
	</div>
</section>
</body>
</html>
