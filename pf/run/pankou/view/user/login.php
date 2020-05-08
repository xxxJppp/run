<?php
use xh\library\url;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=yes">
<link href="/favicon.ico" rel="shortcut icon"/>
<title>商户登录 - <?php echo WEB_NAME; ?> - 支付技术服务商，让支付简单、专业、快捷！</title>
<link rel="stylesheet" href="/Public/theme/view4/css/qietu.css">
<link rel="stylesheet" href="/Public/theme/view4/css/animate.min.css"/>
<link rel="stylesheet" href="/Public/theme/view4/css/iconfont.css">
<link rel="stylesheet" href="/Public/theme/view4/css/style.css">
<link rel="stylesheet" href="/Public/theme/view4/css/style_tr.css">
<link rel="stylesheet" href="/Public/theme/view4/css/responsive.css">
<script src="Public/Front/login/js/modernizr-2.6.2.min.js"></script>
<link rel="stylesheet" href="/static/home/css/layui.css">
<script src="/static/home/js/jquery-1.11.1.js"></script>
<script src="/static/home/js/layui.js"></script>
<script src="/static/home/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/login/jquery-1.9.1.js\"></script>
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/login/jquery.slideunlock.js"></script>
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/login/common.js"></script>
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/login/WdatePicker.js"></script>
  <script>
        if (window.top !== window.self) {
            window.top.location = window.location;
        }
    </script>

    <style>
        .bj-3d7bf8{
            background: #3D7BF8;
        }
		#embed-captcha {

			margin: 0 auto;
		}
		.show {
			display: block;
		}
		.hide {
			display: none;
		}
		#notice {
			color: red;
		}
        .geetest_holder.geetest_wind{
             width: 100% !important;
        }
    </style>
</head>

<body>
<body>

<link rel="stylesheet" type="text/css" href="/static/images/style.css" />
<div class="m-head">
	
	
	<div class="m-head-nav">
		<ul class="c-wrapper">
			<li class="m-head-nav-logo">
				<h4 style="font-size: 28px;font-weight: bold;line-height: 61px;"><?php echo WEB_NAME; ?></h4>
			</li>

			<li class="m-head-nav-item ">
				<a href="/">首页</a>
			</li>

			<li class="m-head-nav-item ">
				<a href="/index/user/login">商户登录</a>
			</li>

          <li class="m-head-nav-item  ">
				<a href="/mashang/user/login">供码登录</a>
			</li>
          
          <li class="m-head-nav-item  active">
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

<div class=" login2">
	<div class="login-wp">
		<div class="login-hd">
			<h2>盘口登录</h2>
		</div>
		<div class="login-bd">
			 <form name="loginForm" id="profile">
			<ul>
				<li>
					<input type="text" class="txt" name="member_id" id="member_id" maxlength="30" placeholder="请输入帐号" aria-required="true" autocomplete="off" />
				</li>
				<li>
					<input type="password" class="txt" name="pwd" id="pwd"  placeholder="请输入密码" aria-required="true" autocomplete="off"/>
				</li>
				
			</ul>
               
             <div class="login-btn">  
			 <label>
                        <button  class="sbm_btn login_btn_sbm btn" lay-submit="" lay-filter="profile">登录</button>
                    </label>
			
              </div>
			
		</div>
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
 <script src="/Public/Front/js/jquery.min.js"></script>
<script src="/Public/Front/js/bootstrap.min.js"></script>
<script src="/Public/Front/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/Public/Front/js/content.js"></script>
<script src="/Public/Front/js/plugins/layui/layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/x-layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/Util.js" charset="utf-8"></script>
<script>
  layui.use(['laydate', 'laypage', 'layer', 'form', 'element'], function() {
        var laydate = layui.laydate //日期
            ,layer = layui.layer //弹层
            ,form = layui.form //弹层
            , element = layui.element; //元素操作
        //日期
        laydate.render({
            elem: '#date'
        });
        //监听提交
      
       form.on('submit(profile)', function(data){
           
            $.ajax({
            url:"<?php echo url::s('pankou/user/dologin');?>",
            type:"post",
            data:$('#profile').serialize(),
            success:function(res){
                if(res.code == '200'){
                    layer.alert(res.msg, {icon: 1},function () {
                      layer.closeAll();
                      location.href="<?php echo url::s('pankou/panel/home');?>";
                    });
                }else{
                    layer.alert(res.msg ? res.msg :"登录提示", {icon: 6},function () {
                     layer.closeAll();
                    });
                }
            }
        });
            return false;
        });
    });
  
</script>
</body>
</html>