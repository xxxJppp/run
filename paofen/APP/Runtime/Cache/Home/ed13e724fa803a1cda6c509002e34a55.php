<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0051)http://103.200.29.54/index.html#tabbar-with-contact -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title></title>
    
    <link href="/Public/home/wap/css/mui.min.css" rel="stylesheet">
	<link href="/Public/home/wap/css/app.css" rel="stylesheet">
	<link href="/Public/home/wap/css/userindex.css" rel="stylesheet">

</head>
<body style="background:#1a1d2e;" class="mui-ios mui-ios-11 mui-ios-11-0">
		
			<!--我的-->
	<div id="tabbar-with-contact" class="mui-control-content mui-active">
		<header class="mui-bar mui-bar-nav header">
				<h1 class="mui-title h1">我的</h1>
		</header>
		<div class="mui-card-content my">
			<img src="../Public/home/wap/images/logoer.png" class="myimg">
			<span class="acc"><?php echo ($list["username"]); ?></span>
			<span class="acc" style="top: 50%; margin-left: 5%;">邀请码</span>
			<span class="acc" style="top: 50%; margin-left: 20%;"><?php echo ($list["u_yqm"]); ?></span>
			<button type="button" class="jibie">普通会员V1</button>
		</div>
		<ul class="mui-table-view ullist">
			<li class="mui-table-view-cell mui-collapse-content">
				<img src="../Public/home/wap/images/zichan.png" class="imglist">
				<a href="<?php echo U('User/zichan');?>" class="mui-navigate-right" style=" margin-left: 10%;font-size: 0.9em; bottom: 4px; ">
					我的资产
				</a>
			</li>
			<li class="mui-table-view-cell mui-collapse-content">
				<img src="../Public/home/wap/images/ziliao.png" class="imglist">
				<a href="<?php echo U('User/ziliao');?>" class="mui-navigate-right" style=" margin-left: 10%;font-size: 0.9em; bottom: 4px; ">
					个人资料
				</a>
			</li>
			<li class="mui-table-view-cell mui-collapse-content">
				<img src="../Public/home/wap/images/chongzhi.png" class="imglist">
				<a href="<?php echo U('Recharge/chongzhijilu');?>" class="mui-navigate-right" style=" margin-left: 10%;font-size: 0.9em; bottom: 4px; ">
					充值管理
				</a>
			</li>
			<li class="mui-table-view-cell mui-collapse-content">
				<img src="../Public/home/wap/images/tixian.png" class="imglist">
				<a href="<?php echo U('Withdraw/index');?>" class="mui-navigate-right" style=" margin-left: 10%; font-size: 0.9em;bottom: 4px; ">
					提现管理
				</a>
			</li>
			<li class="mui-table-view-cell mui-collapse-content">
				<img src="../Public/home/wap/images/tixian.png" class="imglist">
				<a href="<?php echo U('User/bill');?>" class="mui-navigate-right" style=" margin-left: 10%; font-size: 0.9em;bottom: 4px; ">
					资金日志
				</a>
			</li>
			<li class="mui-table-view-cell mui-collapse-content">
				<img src="../Public/home/wap/images/tixian.png" class="imglist">
				<a href="<?php echo U('User/yjbill');?>" class="mui-navigate-right" style=" margin-left: 10%; font-size: 0.9em;bottom: 4px; ">
					支出明细
				</a>
			</li>
			<li class="mui-table-view-cell mui-collapse-content">
				<img src="../Public/home/wap/images/erweima.png" class="imglist">
				<a href="<?php echo U('User/erweima');?>" class="mui-navigate-right" style=" margin-left: 10%; font-size: 0.9em;bottom: 4px; ">
					二维码管理
				</a>
			</li>

			<li class="mui-table-view-cell mui-collapse-content">
				<img src="../Public/home/wap/images/fenxiang.png" class="imglist">
				<a href="<?php echo U('User/Sharecode');?>" class="mui-navigate-right" style=" margin-left: 10%; font-size: 0.9em;bottom: 4px; ">
					邀请好友
				</a>
			</li>
			<li class="mui-table-view-cell mui-collapse-content">
				<img src="../Public/home/wap/images/guanyu.png" class="imglist">
				<style>
				#ib_iconDiv{display:none}
				</style>
				<div style="display:none">
					<script type="text/javascript" src="http://c.ibangkf.com/i/c-kakapaofen.js"></script>
				</div>
				<a href="javascript:;" class="mui-navigate-right" style=" margin-left: 10%;font-size: 0.9em; bottom: 4px; " onClick="ib_wopen();">
					在线客服
				</a>
			</li>
			<li class="mui-table-view-cell mui-collapse-content">
				<img src="../Public/home/wap/images/shezhi.png" class="imglist">
				<a href="<?php echo U('User/shezhi');?>" class="mui-navigate-right" style=" margin-left: 10%;font-size: 0.9em; bottom: 4px; ">
					设置
				</a>
			</li>

		</ul>
		
	</div>
		
	
<nav class="mui-bar mui-bar-tab" style="background:#1f253d;">
	<a class="mui-tab-item" href="<?php echo U('Index/index');?>">
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
	<a class="mui-tab-item mui-active" href="<?php echo U('User/index');?>">
		<span class="mui-icon mui-icon-contact"></span>
		<span class="mui-tab-label">我的</span>
	</a>
</nav>
</body>
 <script type="text/javascript" src="/Public/home/common/js/jquery-1.9.1.min.js" ></script>
 <script type="text/javascript" src="/Public/home/common/layer/layer.js" ></script>
 <script type="text/javascript">
	function loginout(){
		window.location.href="<?php echo U('User/Loginout');?>";
	}
 </script>
</html>