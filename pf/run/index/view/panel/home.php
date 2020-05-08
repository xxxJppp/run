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
<title><?php echo WEB_NAME; ?>- 	用户中心 </title>
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
                        
                       
                       
                       <font>用户中心</font> 
                    </span>
                </span>
          </a>
        </div>
        <div class="logo-element">MENU</div>
      </li>
    </ul>
    <ul class="nav navbar-top-links navbar-right">
      <li>  <a href="/" target="_blank"> <i class="fa fa-home"></i> 首页 </a></li>
      <!--<li class="hidden-xs edtpwd">
        <a href="javascript:;" onClick="reset_pwd('修改密码','/agent_System_editPassword.html',360,320)"><i class="iconfont icon-mima"></i>修改密码</a>
      </li> -->
      <li class="dropdown hidden-xs"> <a  href="/index/member/logout.do" class="right-sidebar-toggle"
                                          aria-expanded="false"> <i class="fa fa-sign-out"></i> 退出</a> </li>
    </ul>
  </nav>
</div>
  <style>
    .slimScrollDiv >* {
    /* overflow: hidden; 
    overflow: scroll;*/
}
  </style>
<div id="wrapper">
  <!--左侧导航开始-->
  <nav class="navbar-default navbar-static-side" role="navigation">
   
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
           
            <li>
               <a href="/index/panel/home.do"> <i class="fa fa-home"></i>
                <span class="nav-label">管理中心</span></a>
                    

            </li>

                   
           
          
            <?php if ((new model())->load("user", "group")->check('taobaodf_auto')){?>
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">淘宝代付</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/taobaodf/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                   <li><a href="<?php echo url::s('index/taobaodf/maku');?>" class="J_menuItem"><span class="nav-label">码库管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/taobaodf/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/taobaodf/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
  <?php }?>
          
           <?php if ((new model())->load("user", "group")->check('huafei_auto')){?>
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">话费</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/huafei/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/huafei/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/huafei/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
  <?php }?>
          
           <?php if ((new model())->load("user", "group")->check('wechat_auto')){?>
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">微信固码</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/wechat/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/wechat/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/wechat/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
  <?php }?>
          
            <?php if ((new model())->load("user", "group")->check('wechatzs_auto')){?>
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">微信赞赏</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/wechatzs/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/wechatzs/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/wechatzs/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
  <?php }?>
          
            <?php if ((new model())->load("user", "group")->check('wechatphone_auto')){?>
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">微信转手机</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/wechatphone/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/wechatphone/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/wechatphone/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
  <?php }?>
          
           <?php if ((new model())->load("user", "group")->check('wechatdy_auto')){?>
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">微信店员模式</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/wechatdy/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/wechatdy/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/wechatdy/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
  <?php }?>
          
          
           <?php if ((new model())->load("user", "group")->check('wechatsj_auto')){?>
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">微信商家固码</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/wechatsj/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/wechatsj/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/wechatsj/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
  <?php }?>
          
          
           <?php if ((new model())->load("user", "group")->check('alipaygm_auto')){?>
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">支付宝固码</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/alipaygm/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/alipaygm/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/alipaygm/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
  <?php }?>
          
          
           <?php if ((new model())->load("user", "group")->check('alipay_auto')){?>
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">支付宝转账</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/alipay/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/alipay/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/alipay/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
  <?php }?>
          
          
           <?php if ((new model())->load("user", "group")->check('bank_auto')){?>
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">支付宝/微信转卡</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/bank/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/bank/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/bank/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
  <?php }?>
          
          
           <?php if ((new model())->load("user", "group")->check('pddgm_auto')){?>
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">拼多多商家固码</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/pddgm/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/pddgm/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/pddgm/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
  <?php }?>
          
          
           <?php if ((new model())->load("user", "group")->check('nxyswx_auto')){?>
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">农信易扫</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/nxys/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/nxys/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/nxys/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
  <?php }?>
           
            <?php if ((new model())->load("user", "group")->check('yunshanfu_auto')){?>
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">云闪付</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/yunshanfu/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/yunshanfu/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/yunshanfu/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
  <?php }?>
          
            <?php if ((new model())->load("user", "group")->check('lakala_auto')){?>
          
                        <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">拉卡拉</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/lakala/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/lakala/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/lakala/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
  <?php }?>
          
          
            <?php if ((new model())->load("user", "group")->check('shouqianba_auto')){?>
          
              <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">收钱吧</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo url::s('index/shouqianba/automatic');?>" class="J_menuItem"><span class="nav-label">账户管理</span></a> </li>
                  
                    <li><a href="<?php echo url::s('index/shouqianba/automaticOrder');?>" class="J_menuItem"><span class="nav-label">支付订单</span></a> </li>
                   
                    <li><a href="<?php echo url::s('index/shouqianba/statisticOrder');?>" class="J_menuItem"><span class="nav-label">订单统计</span></a> </li>
                </ul>
            </li>         
               
               
  <?php }?>
          
          
            <?php if ((new model())->load("user", "group")->check('service_auto')){?>
          
                    
          
            <li><a href="#"> <i class="fa fa fa-sellsy"></i> <span class="nav-label">服务版</span> <span
                    class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                  
                    <li><a href="<?php echo url::s('index/service/order');?>" class="J_menuItem"><span class="nav-label">我的订单</span></a> </li>
                   
                  
                </ul>
            </li>         
  <?php }?>
          
          
            <li><a href="#"> <i class="fa fa fa-user"></i> 
              <span class="nav-label">账户管理</span> <span class="fa arrow"></span> </a>
            
                <ul class="nav nav-second-level">
                    <li><a href="/index/member/edit" class="J_menuItem"><span class="nav-label">修改资料</span></a> </li>
                    <li><a href="/index/member/withdraw" class="J_menuItem"><span class="nav-label">我的提现</span></a> </li>
                </ul>
            </li>
          
          
            <li><a href="#"> <i class="fa fa fa-bank"></i> <span class="nav-label">API管理</span> <span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    <li><a href="/index/doc/home" class="J_menuItem"><span class="nav-label">对接文档</span> </a>  </li>
                    
              </ul>
            </li>


        </ul>
    </div>
</nav>
    
  <!--左侧导航结束-->
  <!--右侧部分开始-->
  <div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="row J_mainContent" id="content-main">
      <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="/index/panel/index.do"
              frameborder="0" data-id="/index/panel/index.do" seamless></iframe>
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
<script src="/Public/Front/js/indexcontent.js"></script>
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