<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0038)http://103.200.29.54/index.html#tabbar -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title></title>

    <link href="/Public/home/wap/css/mui.min.css" rel="stylesheet">
	<link href="/Public/home/wap/css/app.css" rel="stylesheet">
	<link href="/Public/home/wap/css/indexindex.css" rel="stylesheet">

	<style>
		.bgcolor10{background: #8A6DE9;}
		.bgcolor9{background:grey;}
		.bgcolor8{background: darkslateblue;}
		.bgcolor7{background: darkgray;}
		.bgcolor6{background: #EC971F;}
		.bgcolor5{background: #007aff;}
		.bgcolor4{background: orange;}
		.bgcolor3{background: burlywood;}
		.bgcolor2{background:  blue;}
		.bgcolor1{background: red;}


	</style>
</head>
<body style="background:#1a1d2e;" class="mui-ios mui-ios-11 mui-ios-11-0">
		<div id="tabbar" class="mui-control-content mui-active">
			<header class="mui-bar mui-bar-nav header">
					<h1 class="mui-title h1">排行榜</h1>
			</header>
				<img src="../Public/home/wap/images/phbbg.png" class="img">
			<div class="mui-card-content">
				<ul class="mui-table-view ul">
					<?php for($i=1;$i<=$num;$i++){?>
		            <li class="mui-table-view-cell mui-collapse mui-collapse-content">
						<span class="phblist">
							<img src="../Public/home/wap/images/logoer.png" style="width: 40px;/">
							<span class="phbacc"><?php echo $ulist[$i-1]['username'];?></span>
							<span class="phbaac"><?php echo $ulist[$i-1]['zsy'];?></span>
						</span>
						<span class="mui-badge mui-badge-primary <?php echo 'bgcolor'.$i;?>"><?php echo $i;?></span>
					</li>
					<?php }?>

		        </ul>
			</div>
		</div>
			

		<nav class="mui-bar mui-bar-tab" style="background:#1f253d;">
			<a class="mui-tab-item mui-active" href="<?php echo U('Index/index');?>">
				<span class="mui-icon mui-icon-home"></span>
				<span class="mui-tab-label">首页</span>
			</a>
			<a class="mui-tab-item" href="<?php echo U('Index/qdgame');?>">
				<span class="mui-icon mui-icon-email"></span>
				<span class="mui-tab-label">抢单</span>
			</a>
			
			<a class="mui-tab-item" href="<?php echo U('Index/shoudan');?>">
				<span class="mui-icon mui-icon-gear"></span>
				<span class="mui-tab-label">收单</span>
			</a>
			<a class="mui-tab-item" href="<?php echo U('User/index');?>">
				<span class="mui-icon mui-icon-contact"></span>
				<span class="mui-tab-label">我的</span>
			</a>
		</nav>
		
</body>
</html>