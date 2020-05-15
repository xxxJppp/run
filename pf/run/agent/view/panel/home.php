<?php
use xh\library\url;
use xh\unity\cog;
use xh\library\model;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="renderer" content="webkit">
<title><?php echo WEB_NAME; ?>-  代理中心 </title>
  <!--[if lt IE 9]>
  <meta http-equiv="refresh" content="0;ie.html" />
  <![endif]-->
  <link rel="shortcut icon" href="favicon.ico">
  <link href="/Public/Front/css/bootstrap.min.css" rel="stylesheet">
  <link href="/Public/Front/css/font-awesome.min.css" rel="stylesheet">
  <link href="/Public/Front/css/animate.css" rel="stylesheet">
  <link href="/Public/Front/css/style.css" rel="stylesheet">
  <link href="/Public/Front/css/zuy.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/Public/Front/iconfont/iconfont.css"/>
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">

<div class=" zuy-header">
  <nav class="navbar navbar-static-top" role="navigation" >
    <!--<div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

    </div>-->
    <ul class="nav navbar-left">
      <li class="nav-header zuy-user">
        <div class="dropdown profile-element">

          <span><i class="iconfont icon-mine_fill"></i></span>
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span >
                    <span class=" m-t-xs">
                        
                       
                       
                       <font>代理中心</font> 
                    </span>
                </span>
          </a>
        </div>
        <div class="logo-element">MENU</div>
      </li>
    </ul>
    <ul class="nav navbar-top-links navbar-right">
      <li>  </li>
      <!--<li class="hidden-xs edtpwd">
        <a href="javascript:;" onClick="reset_pwd('修改密码','/agent_System_editPassword.html',360,320)"><i class="iconfont icon-mima"></i>修改密码</a>
      </li> -->
      <li class="dropdown hidden-xs"> <a  href="/agent/member/logout.do" class="right-sidebar-toggle"
                                          aria-expanded="false"> <i class="fa fa-sign-out"></i> 退出</a> </li>
    </ul>
  </nav>
</div>
<div id="wrapper">
  <!--左侧导航开始-->
  <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i></div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
           
            <li>
               <a href="/agent/panel/home.do"> <i class="fa fa-home"></i>
                <span class="nav-label">管理中心</span></a>
                    

            </li>

                   
           
            <li><a href="#"> <i class="fa fa fa-user"></i> 
              <span class="nav-label">会员管理</span> <span class="fa arrow"></span> </a>
            
                <ul class="nav nav-second-level">
                    <li><a href="/agent/panel/userlist.do" class="J_menuItem"><span class="nav-label">会员列表</span></a> </li>
                  
                    <li><a href="/agent/panel/useradd.do" class="J_menuItem"><span class="nav-label">添加会员</span></a> </li>
                   
                    <li><a href="/agent/panel/moneylog.do" class="J_menuItem"><span class="nav-label">会员余额操作记录</span></a> </li>
                </ul>
            </li>
  
          
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">订单管理</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="/agent/panel/order" class="J_menuItem"><span class="nav-label">已支付订单</span></a>
                    </li>
                   
                    <li><a href="/agent/panel/orderweifu" class="J_menuItem"><span class="nav-label">未支付订单</span></a>
                    </li>
                  
                    <li><a href="/agent/panel/dailihuoli" class="J_menuItem"><span class="nav-label">订单获利</span></a>
                    </li>
                   
                </ul>
            </li>         
               

           
            <li><a href="#"> <i class="fa fa fa-user"></i> 
              <span class="nav-label">账户管理</span> <span class="fa arrow"></span> </a>
            
                <ul class="nav nav-second-level">
                    <li><a href="/agent/member/edit" class="J_menuItem"><span class="nav-label">修改资料</span></a> </li>
                    <li><a href="/agent/member/withdraw" class="J_menuItem"><span class="nav-label">我的提现</span></a> </li>
                </ul>
            </li>
          
          
          

        </ul>
    </div>
</nav>
    
  <!--左侧导航结束-->
  <!--右侧部分开始-->
  <div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row J_mainContent" id="content-main">
      <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="/agent/panel/index.do"
              frameborder="0" data-id="/agent/panel/index.do" seamless></iframe>
    </div>
 <!-- <div class="layui-footer">版本：5.8.6    </div>-->
 <div class="footer">
      <div class="pull-right">&copy;2019 <?php echo WEB_NAME; ?> 版权所有</div>
    </div>

  </div>
  <!--右侧部分结束-->
</div>
<!-- 全局js -->
</div>
<script src="/Public/Front/js/jquery.min.js"></script>
<script src="/Public/Front/js/bootstrap.min.js"></script>
<script src="/Public/Front/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/Public/Front/js/content.js"></script>
<script src="/Public/Front/js/plugins/layui/layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/x-layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/Util.js" charset="utf-8"></script>
<script src="/Public/Front/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/Public/Front/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/Public/Front/js/hplus.js"></script>
<script type="text/javascript" src="/Public/Front/js/contabs.js"></script>
<script src="/Public/Front/js/iNotify.js"></script>
<script>
    layui.use(['laypage', 'layer', 'form'], function () {
        var form = layui.form,
            layer = layui.layer,
            $ = layui.jquery;
    });
    function reset_pwd(title,url,w,h){
        x_admin_show(title,url,w,h);
    }
</script>
  <script>


//side
$(function(){
    	 $('.logo-element').click(function(){
    	 	 if($('.navbar-static-side').hasClass('show')){
    	 	 	$('.navbar-static-side').removeClass('show');
    	 	 }
    	 	 else{
    	 	 	$('.navbar-static-side').addClass('show');
    	 	 }
    	 })
		 
		 
		 $('.navbar-static-side li>ul a').click(function(){
		 	$('.navbar-static-side').removeClass('show');
		 })
    })
</script>
</body>
</html>