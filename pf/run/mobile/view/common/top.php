<?php
use xh\library\url;
use xh\unity\cog;
use xh\library\model;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="<?php echo cog::web()['description'];?>">
    <meta name="keywords" content="<?php echo cog::web()['keywords'];?>">
    <title><?php echo cog::web()['name'];?></title>
    <!-- CORE CSS-->
    <link rel="icon" href="<?php echo URL_ROOT;?>/favicon.ico" />
    <link href="<?php echo URL_VIEW;?>/static/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">

    <!-- new css-->
    <link href="<?php echo URL_VIEW;?>/static/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo URL_VIEW;?>/static/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo URL_VIEW;?>/static/css/ace.min.css" />
    <link rel="stylesheet" href="<?php echo URL_VIEW;?>/static/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="<?php echo URL_VIEW;?>/static/css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?php echo URL_VIEW;?>/static/css/style.css" />
    <!-- Custome CSS-->
    <link href="<?php echo URL_VIEW;?>/static/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?php echo URL_VIEW;?>/static/js/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet" media="screen,projection">
</head>
<body style="font-family:微软雅黑;">
<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try {
            ace.settings.check('navbar', 'fixed')
        } catch (e) {}
    </script>
    <style>
        .logo_css {
            font-size: 36px;
            line-height: 69px;
            font-family: cursive;
        }
    </style>
    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <small class="logo_css">
                    <!--<img src="images/logo.png">-->
                    商户中心
                </small>
            </a><!-- /.brand -->
        </div><!-- /.navbar-header -->
        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <span  class="time"><em id="time"></em></span><span class="user-info" title="<?php echo $_SESSION['MEMBER']['group']['name'];?>"><small>欢迎光临,</small><?php echo $_SESSION['MEMBER']['username'];?></span>
                        <i class="icon-caret-down"></i>
                    </a>
                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li><a href="#" onclick="edit()"><i class="icon-cog"></i>修改资料</a></li>
                        <li><a href="#" onclick="pay();"><i class="icon-credit-card"></i>余额充值</a></li>
                        <li class="divider"></li>
                        <li><a href="/index/member/logout.do"><i class="icon-off"></i>安全注销</a></li>
                    </ul>
                </li>
                <li class="purple">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-bell-alt"></i><span class=""></span></a>

                </li>
            </ul>
        </div>
    </div>
</div>
<!-- END LEFT SIDEBAR NAV-->

<!-- //////////////////////////////////////////////////////////////////////////// -->

<script src="<?php echo URL_VIEW;?>static/js/assset/ace-extra.min.js"></script>
<script src="<?php echo URL_VIEW;?>static/js/assset/jquery-1.9.1.min.js"></script>
<script src="<?php echo URL_VIEW;?>static/js/assset/bootstrap.min.js"></script>
<script src="<?php echo URL_VIEW;?>static/js/assset/typeahead-bs2.min.js"></script>
<script src="<?php echo URL_VIEW;?>static/js/assset/ace-elements.min.js"></script>
<script src="<?php echo URL_VIEW;?>static/js/assset/ace.min.js"></script>
<script src="<?php echo URL_VIEW;?>static/js/assset/layer.js" type="text/javascript"></script>
<script src="<?php echo URL_VIEW;?>static/js/assset/laydate.js" type="text/javascript"></script>
<script>

    //选择头像
    function imgSelect(){
        document.getElementById('uploadavatar').click();
    }

    //上传头像
    function uploadPic(){
        var pic = $("#uploadavatar")[0].files[0];
        var fd = new FormData();
        fd.append('avatar', pic);
        $.ajax({
            url:"<?php echo url::s('index/member/avatarUpload');?>",
            type:"post",
            // Form数据
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success:function(data){
                if(data.code == '200'){
                    play(['<?php echo FILE_CACHE . "/download/sound/头像更改成功1.mp3";?>']);
                    swal("操作提示", data.msg, "success");
                    $('#img_avatar').attr('src','<?php echo URL_VIEW . '/upload/avatar/' . $_SESSION['MEMBER']['uid'] . '/';?>' + data.data.img);
                }else{
                    swal("操作提示", data.msg, "error");
                }
            }
        });

    }
    function edit(){
        layer.open({
            type: 2,
            title: '修改资料',
            shadeClose: true,
            shade: 0.8,
            area: ['500px', '550px'],
            content: '<?php echo url::s('index/member/edit');?>' //iframe的url
        });
    }

    function pay(){
        layer.open({
            type: 2,
            title: '充值',
            shadeClose: true,
            shade: 0.8,
            area: ['500px', '340px'],
            content: '<?php echo url::s('index/member/pay');?>' //iframe的url
        });
    }

    //时间设置
    $(function() {
        var cid = $('#nav_list> li>.submenu');
        cid.each(function(i) {
            $(this).attr('id', "Sort_link_" + i);

        })
    })
    jQuery(document).ready(function() {
        $.each($(".submenu"), function() {
            var $aobjs = $(this).children("li");
            var rowCount = $aobjs.size();
            var divHeigth = $(this).height();
            $aobjs.height(divHeigth / rowCount);
        });
        //初始化宽度、高度
        $("#main-container").height($(window).height() - 76);
        $("#iframe").height($(window).height() - 140);

        $(".sidebar").height($(window).height() - 99);
        var thisHeight = $("#nav_list").height($(window).outerHeight() - 173);
        $(".submenu").height();
        $("#nav_list").children(".submenu").css("height", thisHeight);

        //当文档窗口发生改变时 触发
        $(window).resize(function() {
            $("#main-container").height($(window).height() - 76);
            $("#iframe").height($(window).height() - 140);
            $(".sidebar").height($(window).height() - 99);

            var thisHeight = $("#nav_list").height($(window).outerHeight() - 173);
            $(".submenu").height();
            $("#nav_list").children(".submenu").css("height", thisHeight);
        });
        $(".iframeurl").click(function() {
            var cid = $(this).attr("name");
            var cname = $(this).attr("title");
            $("#iframe").attr("src", cid).ready();
            $("#Bcrumbs").attr("href", cid).ready();
            $(".Current_page a").attr('href', cid).ready();
            $(".Current_page").attr('name', cid);
            $(".Current_page").html(cname).css({ "color": "#333333", "cursor": "default" }).ready();
            $("#parentIframe").html('<span class="parentIframe iframeurl"> </span>').css("display", "none").ready();
            $("#parentIfour").html('').css("display", "none").ready();
        });


    });

    $(document).ready(function() {
        $('#nav_list').find('li.home').click(function() {
            $('#nav_list').find('li.home').removeClass('active');
            $(this).addClass('active');
        });


        //时间设置
        function currentTime() {
            var d = new Date(),
                str = '';
            str += d.getFullYear() + '年';
            str += d.getMonth() + 1 + '月';
            str += d.getDate() + '日';
            str += d.getHours() + '时';
            str += d.getMinutes() + '分';
            str += d.getSeconds() + '秒';
            return str;
        }
        setInterval(function() {
            $('#time').html(currentTime)
        }, 1000);
        //修改密码
        $('.change_Password').on('click', function() {
            layer.open({
                type: 1,
                title: '修改密码',
                area: ['300px', '300px'],
                shadeClose: true,
                content: $('#change_Pass'),
                btn: ['确认修改'],
                yes: function(index, layero) {
                    if ($("#password").val() == "") {
                        layer.alert('原密码不能为空!', {
                            title: '提示框',
                            icon: 0,
                        });
                        return false;
                    }
                    if ($("#Nes_pas").val() == "") {
                        layer.alert('新密码不能为空!', {
                            title: '提示框',
                            icon: 0,
                        });
                        return false;
                    }

                    if ($("#c_mew_pas").val() == "") {
                        layer.alert('确认新密码不能为空!', {
                            title: '提示框',
                            icon: 0,
                        });
                        return false;
                    }
                    if (!$("#c_mew_pas").val || $("#c_mew_pas").val() != $("#Nes_pas").val()) {
                        layer.alert('密码不一致!', {
                            title: '提示框',
                            icon: 0,
                        });
                        return false;
                    } else {
                        layer.alert('修改成功！', {
                            title: '提示框',
                            icon: 1,
                        });
                        layer.close(index);
                    }
                }
            });
        });
        $('#Exit_system').on('click', function() {
            layer.confirm('是否确定退出系统？', {
                    btn: ['是', '否'], //按钮
                    icon: 2,
                },
                function() {
                    location.href = "{:U('Home/Login/login_out')}";

                });
        });
    })
    //控制手机端
    if ($(window).height() <= 800) {
        //控制手机端iframe高度
        var hhh = $("#sidebar").height(($(window).height() + 40) + 'px');
        $("#iframe").height($(window).height())
        //右侧切换皮肤。。。
        $("#ace-settings-btn").click(function() {
            $("#ace-settings-box").toggle();
        });
        //设置点击弹出
        $(".ace-nav .light-blue").eq(0).click(function() {
            $(".dropdown-close").eq(0).toggle();
        })
        //设置点击弹出
        $(".ace-nav .purple").eq(0).click(function() {
            $(".dropdown-close").eq(1).toggle();
        })
        setInterval(function() {
            //时间
            var time = new Date;
            var t = time.toLocaleString();
            $(".light-blue .time").text(t);
        }, 1000);
        //闹铃样式
        $(".ace-nav .purple").eq(0).css("float", "left !important");
    }
    $(window).ready(function() {
        var xh = $(window).height();
        $("#sidebar").height((xh - 75) + 'px');
    })
</script>
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {}
    </script>
    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>
        <!-- 左侧 -->
        <div class="sidebar" id="sidebar">
            <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'fixed')
                } catch (e) {}
            </script>
            <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                   <?php echo $_SESSION['MEMBER']['username'];?>   ( <span class="user-roal" style="color: #FFD700;"><b><?php echo $_SESSION['MEMBER']['group']['name'];?></b></span> )
                </div>
                <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                    <span class="btn btn-success"></span>
                    <span class="btn btn-info"></span>
                    <span class="btn btn-warning"></span>
                    <span class="btn btn-danger"></span>
                </div>
            </div><!-- #sidebar-shortcuts -->
            <ul class="nav nav-list" id="nav_list">
                <li class="home active">
                    <a href="#" name="<?php echo url::s('index/panel/index');?>" class="iframeurl" title=""><i class="icon-dashboard"></i><span class="menu-text"> 系统首页 </span></a>
                </li>
              
                 <?php if ((new model())->load("user", "group")->check('taobaodf_auto')){?>
                <li>
                    <a href="#" class="dropdown-toggle"><i class="icon-edit"></i><span class="menu-text"> 淘宝代付 </span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/taobaodf/automatic');?>" target="iframe" name="<?php echo url::s('index/taobaodf/automatic');?>" title="商户版<?php echo SYSTEM_VERSION; ?>" class="iframeurl" ><i class="icon-double-angle-right"></i>账户管理<?php echo SYSTEM_VERSION; ?></a>
                        </li>
                       <li class="home">
                            <a href="<?php echo url::s('index/taobaodf/maku');?>" target="iframe" name="<?php echo url::s('index/taobaodf/maku');?>" title="商户版<?php echo SYSTEM_VERSION; ?>" class="iframeurl" ><i class="icon-double-angle-right"></i>码库管理<?php echo SYSTEM_VERSION; ?></a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/taobaodf/automaticOrder');?>" target="iframe" name="<?php echo url::s('index/taobaodf/automaticOrder');?>;?>" title="支付订单" class="iframeurl" ><i class="icon-double-angle-right"></i>支付订单</a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/taobaodf/statisticOrder');?>" target="iframe" name="<?php echo url::s('index/taobaodf/statisticOrder');?>" title="订单统计" class="iframeurl" ><i class="icon-double-angle-right"></i>订单统计</a>
                        </li>
                    </ul>
                </li>
                <?php }?>
              
              
                <?php if ((new model())->load("user", "group")->check('wechat_auto')){?>
                <li>
                    <a href="#" class="dropdown-toggle"><i class="icon-edit"></i><span class="menu-text"> 微信固码 </span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/wechat/automatic');?>" target="iframe" name="<?php echo url::s('index/wechat/automatic');?>" title="商户版<?php echo SYSTEM_VERSION; ?>" class="iframeurl" ><i class="icon-double-angle-right"></i>商户版<?php echo SYSTEM_VERSION; ?></a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/wechat/automaticOrder');?>" target="iframe" name="<?php echo url::s('index/wechat/automaticOrder');?>;?>" title="支付订单" class="iframeurl" ><i class="icon-double-angle-right"></i>支付订单</a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/wechat/statisticOrder');?>" target="iframe" name="<?php echo url::s('index/wechat/statisticOrder');?>" title="订单统计" class="iframeurl" ><i class="icon-double-angle-right"></i>订单统计</a>
                        </li>
                    </ul>
                </li>
                <?php }?>
              
              
               <?php if ((new model())->load("user", "group")->check('wechatdy_auto')){?>
                <li>
                    <a href="#" class="dropdown-toggle"><i class="icon-edit"></i><span class="menu-text"> 微信店员模式 </span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/wechatdy/automatic');?>" target="iframe" name="<?php echo url::s('index/wechatdy/automatic');?>" title="商户版<?php echo SYSTEM_VERSION; ?>" class="iframeurl" ><i class="icon-double-angle-right"></i>商户版<?php echo SYSTEM_VERSION; ?></a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/wechatdy/automaticOrder');?>" target="iframe" name="<?php echo url::s('index/wechatdy/automaticOrder');?>;?>" title="支付订单" class="iframeurl" ><i class="icon-double-angle-right"></i>支付订单</a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/wechatdy/statisticOrder');?>" target="iframe" name="<?php echo url::s('index/wechatdy/statisticOrder');?>" title="订单统计" class="iframeurl" ><i class="icon-double-angle-right"></i>订单统计</a>
                        </li>
                    </ul>
                </li>
                <?php }?>
               <?php if ((new model())->load("user", "group")->check('wechatsj_auto')){?>
                <li>
                    <a href="#" class="dropdown-toggle"><i class="icon-edit"></i><span class="menu-text"> 微信商家固码 </span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/wechatsj/automatic');?>" target="iframe" name="<?php echo url::s('index/wechatsj/automatic');?>" title="商户版<?php echo SYSTEM_VERSION; ?>" class="iframeurl" ><i class="icon-double-angle-right"></i>商户版<?php echo SYSTEM_VERSION; ?></a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/wechatsj/automaticOrder');?>" target="iframe" name="<?php echo url::s('index/wechatsj/automaticOrder');?>;?>" title="支付订单" class="iframeurl" ><i class="icon-double-angle-right"></i>支付订单</a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/wechatsj/statisticOrder');?>" target="iframe" name="<?php echo url::s('index/wechatsj/statisticOrder');?>" title="订单统计" class="iframeurl" ><i class="icon-double-angle-right"></i>订单统计</a>
                        </li>
                    </ul>
                </li>
                <?php }?>
              
                <?php if ((new model())->load("user", "group")->check('alipaygm_auto')){?>
                <li>
                    <a href="#" class="dropdown-toggle"><i class="icon-list"></i><span class="menu-text"> 支付宝固码</span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/alipaygm/automatic');?>" target="iframe" name="<?php echo url::s('index/alipaygm/automatic');?>" title="商户版4.0" class="iframeurl" ><i class="icon-double-angle-right"></i>商户版<?php echo SYSTEM_VERSION; ?></a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/alipaygm/automaticOrder');?>" target="iframe" name="<?php echo url::s('index/alipaygm/automaticOrder');?>" title="支付订单" class="iframeurl" ><i class="icon-double-angle-right"></i>支付订单</a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/alipaygm/statisticOrder');?>" target="iframe" name="<?php echo url::s('index/alipaygm/statisticOrder');?>" title="订单统计" class="iframeurl" ><i class="icon-double-angle-right"></i>订单统计</a>
                        </li>
                    </ul>
                </li>
                <?php }?>
              
               
                 <?php if ((new model())->load("user", "group")->check('alipay_auto')){?>
                <li>
                    <a href="#" class="dropdown-toggle"><i class="icon-list"></i><span class="menu-text"> 支付宝转账 </span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/alipay/automatic');?>" target="iframe" name="<?php echo url::s('index/alipay/automatic');?>" title="商户版4.0" class="iframeurl" ><i class="icon-double-angle-right"></i>商户版<?php echo SYSTEM_VERSION; ?></a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/alipay/automaticOrder');?>" target="iframe" name="<?php echo url::s('index/alipay/automaticOrder');?>" title="支付订单" class="iframeurl" ><i class="icon-double-angle-right"></i>支付订单</a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/alipay/statisticOrder');?>" target="iframe" name="<?php echo url::s('index/alipay/statisticOrder');?>" title="订单统计" class="iframeurl" ><i class="icon-double-angle-right"></i>订单统计</a>
                        </li>
                    </ul>
                </li>
                <?php }?>
              
              
                <?php if ((new model())->load("user", "group")->check('bank_auto')){?>
                <li>
                    <a href="#" class="dropdown-toggle"><i class="icon-user"></i><span class="menu-text"> 支付宝/微信转卡</span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/bank/automatic');?>" target="iframe" name="<?php echo url::s('index/bank/automatic');?>" title="商户版4.0" class="iframeurl" ><i class="icon-double-angle-right"></i>商户版<?php echo SYSTEM_VERSION; ?></a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/bank/automaticOrder');?>" target="iframe" name="<?php echo url::s('index/bank/automaticOrder');?>" title="支付订单" class="iframeurl" ><i class="icon-double-angle-right"></i>支付订单</a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/bank/statisticOrder');?>" target="iframe" name="<?php echo url::s('index/bank/statisticOrder');?>" title="订单统计" class="iframeurl" ><i class="icon-double-angle-right"></i>订单统计</a>
                        </li>
                      
                    </ul>
                </li>
                <?php }?>
             
             
             
                <?php if ((new model())->load("user", "group")->check('pddgm_auto')){?>
                <li>
                    <a href="#" class="dropdown-toggle"><i class="icon-edit"></i><span class="menu-text"> 拼多多商家固码 </span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/pddgm/automatic');?>" target="iframe" name="<?php echo url::s('index/pddgm/automatic');?>" title="商户版<?php echo SYSTEM_VERSION; ?>" class="iframeurl" ><i class="icon-double-angle-right"></i>商户版<?php echo SYSTEM_VERSION; ?></a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/pddgm/automaticOrder');?>" target="iframe" name="<?php echo url::s('index/pddgm/automaticOrder');?>;?>" title="支付订单" class="iframeurl" ><i class="icon-double-angle-right"></i>支付订单</a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/pddgm/statisticOrder');?>" target="iframe" name="<?php echo url::s('index/pddgm/statisticOrder');?>" title="订单统计" class="iframeurl" ><i class="icon-double-angle-right"></i>订单统计</a>
                        </li>
                    </ul>
                </li>
                <?php }?>
           
                 <?php if ((new model())->load("user", "group")->check('nxyswx_auto')){?>
                <li>
                    <a href="#" class="dropdown-toggle"><i class="icon-user"></i><span class="menu-text"> 农信易扫</span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/nxys/automatic');?>" target="iframe" name="<?php echo url::s('index/nxys/automatic');?>" title="商户版7.0" class="iframeurl" ><i class="icon-double-angle-right"></i>商户版<?php echo SYSTEM_VERSION; ?></a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/nxys/automaticOrder');?>" target="iframe" name="<?php echo url::s('index/nxys/automaticOrder');?>" title="支付订单" class="iframeurl" ><i class="icon-double-angle-right"></i>支付订单</a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/nxys/statisticOrder');?>" target="iframe" name="<?php echo url::s('index/nxys/statisticOrder');?>" title="订单统计" class="iframeurl" ><i class="icon-double-angle-right"></i>订单统计</a>
                        </li>
                        
                    </ul>
                </li>
                <?php }?>
              
              
                <?php if ((new model())->load("user", "group")->check('yunshanfu_auto')){?>
                <li>
                    <a href="#" class="dropdown-toggle"><i class="icon-user"></i><span class="menu-text"> 云闪付</span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/yunshanfu/automatic');?>" target="iframe" name="<?php echo url::s('index/yunshanfu/automatic');?>" title="商户版7.0" class="iframeurl" ><i class="icon-double-angle-right"></i>商户版<?php echo SYSTEM_VERSION; ?></a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/yunshanfu/automaticOrder');?>" target="iframe" name="<?php echo url::s('index/yunshanfu/automaticOrder');?>" title="支付订单" class="iframeurl" ><i class="icon-double-angle-right"></i>支付订单</a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/yunshanfu/statisticOrder');?>" target="iframe" name="<?php echo url::s('index/yunshanfu/statisticOrder');?>" title="订单统计" class="iframeurl" ><i class="icon-double-angle-right"></i>订单统计</a>
                        </li>
                        
                    </ul>
                </li>
                <?php }?>
              
                <?php if ((new model())->load("user", "group")->check('lakala_auto')){?>
                <li>
                    <a href="#" class="dropdown-toggle"><i class="icon-user"></i><span class="menu-text"> 拉卡拉</span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/lakala/automatic');?>" target="iframe" name="<?php echo url::s('index/lakala/automatic');?>" title="商户版7.0" class="iframeurl" ><i class="icon-double-angle-right"></i>商户版<?php echo SYSTEM_VERSION; ?></a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/lakala/automaticOrder');?>" target="iframe" name="<?php echo url::s('index/lakala/automaticOrder');?>" title="支付订单" class="iframeurl" ><i class="icon-double-angle-right"></i>支付订单</a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/lakala/statisticOrder');?>" target="iframe" name="<?php echo url::s('index/lakala/statisticOrder');?>" title="订单统计" class="iframeurl" ><i class="icon-double-angle-right"></i>订单统计</a>
                        </li>
                        
                    </ul>
                </li>
                <?php }?>
              
            
              
               <?php if ((new model())->load("user", "group")->check('shouqianba_auto')){?>
                <li>
                    <a href="#" class="dropdown-toggle"><i class="icon-user"></i><span class="menu-text"> 收钱吧</span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/shouqianba/automatic');?>" target="iframe" name="<?php echo url::s('index/shouqianba/automatic');?>" title="商户版7.0" class="iframeurl" ><i class="icon-double-angle-right"></i>商户版<?php echo SYSTEM_VERSION; ?></a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/shouqianba/automaticOrder');?>" target="iframe" name="<?php echo url::s('index/shouqianba/automaticOrder');?>" title="支付订单" class="iframeurl" ><i class="icon-double-angle-right"></i>支付订单</a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/shouqianba/statisticOrder');?>" target="iframe" name="<?php echo url::s('index/shouqianba/statisticOrder');?>" title="订单统计" class="iframeurl" ><i class="icon-double-angle-right"></i>订单统计</a>
                        </li>
                        
                    </ul>
                </li>
                <?php }?>
              
               
              
              
                <?php if ((new model())->load("user", "group")->check('service_auto')){?>
                <li><a href="#" class="dropdown-toggle"><i class="icon-credit-card"></i><span class="menu-text"> 服务版 </span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/service/order');?>" target="iframe" name="<?php echo url::s('index/service/order');?>" title="提交认证" class="iframeurl" ><i class="icon-double-angle-right"></i>我的订单</a>
                        </li>
                    </ul>
                </li>
                <?php }?>
               
                <li>
                    <a href="#" class="dropdown-toggle"><i class="icon-user"></i><span class="menu-text"> 个人中心 </span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/member/withdraw');?>" target="iframe" name="<?php echo url::s('index/member/withdraw');?>" title="我的提现" class="iframeurl" ><i class="icon-double-angle-right"></i>我的提现</a>
                        </li>
                        <li class="home">
               
                      
                            <a href="#" onclick="edit()"  title="修改资料" class="iframeurl" ><i class="icon-double-angle-right"></i>修改资料</a>
                        </li>
                        <li class="home">
                            <a  href="#" onclick="pay();" title="余额充值" class="iframeurl" ><i class="icon-double-angle-right"></i>余额充值</a>
                        </li>
                       
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle"><i class="icon-map-marker"></i><span class="menu-text"> 接口文档 </span><b class="arrow icon-angle-down"></b></a>
                    <ul class="submenu">
                        <li class="home">
                            <a href="<?php echo url::s('index/doc/getQrcode');?>" target="iframe" name="<?php echo url::s('index/doc/getQrcode');?>" title="扫码支付" class="iframeurl" ><i class="icon-double-angle-right"></i>扫码支付</a>
                        </li>
                        <li class="home">
                            <a href="<?php echo url::s('index/doc/sign');?>" target="iframe" name="<?php echo url::s('index/doc/sign');?>" title="签名算法" class="iframeurl" ><i class="icon-double-angle-right"></i>签名算法</a>
                        </li>
                       
                        <li class="home">
                            <a href="<?php echo url::s('index/doc/callback');?>" target="iframe" name="<?php echo url::s('index/doc/callback');?>" title="异步通知" class="iframeurl" ><i class="icon-double-angle-right"></i>异步通知</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
            </div>
            <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'collapsed')
                } catch (e) {}
            </script>
        </div>