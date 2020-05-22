<?php
use xh\unity\cog;
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
          
          <li class="m-head-nav-item  ">
				<a href="/pankou/user/login">盘口登录</a>
			</li>
          
          <li class="m-head-nav-item  ">
				<a href="/agent/user/login">代理登录</a>
			</li>
			
			
			<li class="m-head-nav-item m-head-nav-right ">
				<a href="/demo">支付体验</a>
			</li>
          
          
			<li class="m-head-nav-item m-head-nav-right active">
				<a href="/index/user/register">商户注册</a>
			</li>

		</ul>
	</div>
</div>

<div class=" login2">
	<div class="login-wp">
		<div class="login-hd">
			<h2>商户注册</h2>
		</div>
		<div class="login-bd">
			  <form class="login-form" id="profile">
                <input type="hidden" name="xz" id="xz" value="1">
			<ul>
				<li>
					<input type="text" class="txt" name="username" id="username" maxlength="30" placeholder="请输入用户名" aria-required="true" autocomplete="off" />
				</li>
              <li>
					<input type="password" class="txt" name="password" id="password"  placeholder="请输入密码" aria-required="true" autocomplete="off"/>
				</li>
              
              <li>
					<input type="password" class="txt" id="password-again" name="pwd_repeat"  placeholder="请再次输入密码确认" aria-required="true" autocomplete="off"/>
				</li>
             
              <li>
					<input type="text" class="txt" name="phone" id="phone-code" maxlength="11" placeholder="请输入手机号" aria-required="true" autocomplete="off" />
				</li>
              
              <?php if (cog::read('registerCog')['scale_open'] == 1){?>
              <li>
					<input type="text" class="txt" name="recommend_username" id="text" maxlength="30"    disabled placeholder="推荐人会员名,选填" value="<?php if(!empty($_GET['username'])){  echo $_GET['username']; } ?>" />
				</li>
              
              <?php }?>
				
                 <p class="margin center medium-small sign-up" style="    margin-left: 400px;"> 
                      <input type="checkbox" name="provision" value="1" class="filled-in" id="filled-in-box" checked="checked" />
                      <label for="filled-in-box"></label>
                   	  <a href="">《<?php echo WEB_NAME; ?>网站服务条款》</a>
           </p>
				
			</ul>
               
             <div class="login-btn">  
			 <label>
                        <button  class="sbm_btn login_btn_sbm btn"  lay-submit="" lay-filter="profile">同意条款并注册</button>
                    </label>
			
              </div>
			 </form>
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
            url:"<?php echo url::s('index/user/registerCheck');?>",
            type:"post",
            data:$('#profile').serialize(),
            success:function(res){
                if(res.code == '200'){
                    layer.alert(res.msg, {icon: 1},function () {
                      location.href="<?php echo url::s('index/user/login');?>";
                    });
                }else{
                    layer.alert(res.msg ? res.msg :"注册提示", {icon: 6},function () {
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