<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title></title>
    <link href="/Public/home/wap/css/mui.min.css" rel="stylesheet">

	<style>
		.body{
			line-height: px;
		}
		.mui-table-view-cell:after{
			left: 0px;
			background-color:#292828;
		}
		.mui-table-view:before{
			background-color:#292828;
		}
		.mui-table-view:after{
			background-color:#292828;
		}
		.header{
			background:#1f253d;
			top:0;
			box-shadow:0 0px 0px #ccc;
			-webkit-box-shadow:0 0px 0px #ccc;
		}
		.imgadd{
			position:absolute;
			margin-top:9px;
			width:24px;
			right: 8px;
		}
		.h1erweima{
			font-family:'微软雅黑';
			color: #fff;
		}
		.ul{
			margin-top:15%;
			background:#1a1d2e;
			line-height:2em;
		}
		.p{
			margin-left:10%;
			font-family:'微软雅黑';
			color:#fff;
		}
	</style>
</head>
<body style="background:#1a1d2e;">
	<header class="mui-bar mui-bar-nav header">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.go(-1)"></a>
			<a href="<?php echo U('User/adderweima');?>" ><img src="../Public/home/wap/images/add.png" class="imgadd"/></a>
			<h1 class="mui-title h1erweima" >添加二维吗</h1>
	</header>
		<ul class="mui-table-view ul">
			<li class="mui-table-view-cell mui-collapse-content">
			    <a href="<?php echo U('User/wxerweima');?>" class="mui-navigate-right">
					<p class="p">微信二维码</p>
				</a>
			</li>
		    <li class="mui-table-view-cell mui-collapse-content">
		        <a href="<?php echo U('User/zfberweima');?>" class="mui-navigate-right">
					<p class="p">支付宝二维码</p>
		        </a>
		    </li>
			<li class="mui-table-view-cell mui-collapse-content">
				<a href="<?php echo U('User/yhkerweima');?>" class="mui-navigate-right">
					<p class="p">支付宝转银行卡二维码</p>
				</a>
			</li>
		</ul>
			
</body>
</html>