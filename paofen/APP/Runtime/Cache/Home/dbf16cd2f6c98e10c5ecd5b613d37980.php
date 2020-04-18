<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title></title>

    <link href="/Public/home/wap/css/mui.min.css" rel="stylesheet"/>

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
		.h1{
			font-family:'微软雅黑';
			color: #fff;
		}
		.button{
			position:absolute;
			color:aquamarine;
			font-family:'微软雅黑';
			width:80%;
			line-height:2em;
			border-radius:20px;
			background:linear-gradient(45deg,BLUE,purple);
			border:0px solid;
			top:25%;
			left: 10%;
		}
		.ul{
			margin-top:15%;
			background:#1a1d2e;
			line-height:2em;
		}
		.li{
			margin-left:10%;
			font-family:'微软雅黑';
			color:aquamarine;
		}
		.right{
			position:absolute;
			right:35px;
			bottom:12px;
			font-family:'微软雅黑';
			color:#fff;
		}
	</style>
</head>
<body style="background:#1a1d2e;">
	<header class="mui-bar mui-bar-nav header">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="javascript:history.go(-1)"></a>
			<h1 class="mui-title h1">设置</h1>
	</header>

	<a href="javascript:void(0)"> <button type="button" class="button"style="margin-top:50px;" onclick="loginout()" >退出登录</button></a>	
	<ul class="mui-table-view ul">
		<li class="mui-table-view-cell mui-collapse-content"><p class="li">联系客服</p> </li>
	    <li class="mui-table-view-cell mui-collapse-content" ><p class="li">当前版本</p><p class="right">v1.0.0</p> </li>
	</ul>
	
</body>
 <script type="text/javascript" src="/Public/home/common/js/jquery-1.9.1.min.js" ></script>
 <script type="text/javascript" src="/Public/home/common/layer/layer.js" ></script>
 <script type="text/javascript">
	function loginout(){
		window.location.href="<?php echo U('User/Loginout');?>";
	}
 </script>
</html>