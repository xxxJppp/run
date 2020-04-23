<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <title>后台管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="generator" content="CoreThink">
  <!--meta http-equiv="refresh" content="60"-->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php echo C('WEB_SITE_TITLE');?>">
    <meta name="format-detection" content="telephone=no,email=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="apple-touch-icon" type="image/x-icon" href="/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="/logo.png">
    <link rel="stylesheet" type="text/css" href="/Public/libs/lyui/dist/css/lyui.min.css">
    <link rel="stylesheet" type="text/css" href="/APP/Admin/View/Public/css/admin.css">
    
    <style type="text/css">
        .background {
            position: absolute;
            right: 0px;
            top: 0px;
            bottom: 0px;
            left: 0px;
            background: #1685d0;
            overflow: hidden;
        }
        .brand {
            width: 100%;
            margin-bottom: 50px;
            text-align: center;
        }
        .brand a {
            height: 65px;
            font-size: 50px;
            text-align: center;
        }
        .brand a:hover {
            text-decoration: none;
        }
        .brand img.logo {
            width: 100%;
            max-height: 100px;
            padding: 0 30px;
            text-align: center;
        }
        .panel-lite {
            margin: 5% auto;
            max-width: 400px;
            background: #fff;
            padding: 45px 30px;
            border-radius: 4px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        .panel-lite h4 {
            font-weight: 400;
            font-size: 24px;
            text-align: center;
            color: #1685d0;
            margin: 20px auto 35px;
        }
        .panel-lite a.link {
            display: inline-block;
            margin-top: 25px;
            text-decoration: none;
            color: #1685d0;
            font-size: 14px;
        }
        .form-group {
            position: relative;
            font-size: 15px;
            color: #666;
        }
        .form-group + .form-group {
            margin-top: 30px;
        }
        .form-group .form-label {
            position: absolute;
            z-index: 1;
            left: 0;
            top: 5px;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }
        .form-group .form-control {
            width: 100%;
            position: relative;
            z-index: 3;
            height: 35px;
            background: none;
            border: none;
            padding: 5px 0;
            -webkit-transition: 0.3s;
            transition: 0.3s;
            border-bottom: 1px solid #777;
            box-shadow: none;
            border-radius: 0;
        }
        .form-group .form-control:invalid {
            outline: none;
        }
        .form-group .form-control:focus, .form-group .form-control:valid {
            outline: none;
            color: #1685d0;
            box-shadow: 0 1px #1685d0;
            border-color: #1685d0;
        }
        .form-group .form-control:focus + .form-label,
        .form-group .form-control:valid + .form-label {
            font-size: 12px;
            -ms-transform: translateY(-15px);
            -webkit-transform: translateY(-15px);
            transform: translateY(-15px);
        }
        .floating-btn {
            background: #1685d0;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            color: #fff;
            font-size: 32px;
            border: none;
            position: absolute;
            margin: auto;
            -webkit-transition: 0.3s;
            transition: 0.3s;
            box-shadow: 1px 0px 0px rgba(0, 0, 0, 0.3) inset;
            margin: auto;
            right: -30px;
            bottom: 90px;
            cursor: pointer;
        }
        .floating-btn:hover {
            box-shadow: 0 0 0 rgba(0, 0, 0, 0.3) inset, 0 3px 6px rgba(0, 0, 0, 0.16), 0 5px 11px rgba(0, 0, 0, 0.23);
        }
        .floating-btn:hover .icon-arrow {
            -ms-transform: rotate(45deg) scale(1.2);
            -webkit-transform: rotate(45deg) scale(1.2);
            transform: rotate(45deg) scale(1.2);
        }
        .floating-btn:focus, .floating-btn:active {
            outline: none;
        }
        .icon-arrow {
            position: relative;
            width: 13px;
            height: 13px;
            border-right: 3px solid #fff;
            border-top: 3px solid #fff;
            display: block;
            -ms-transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            margin: auto;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }
        .icon-arrow:after {
            content: '';
            position: absolute;
            width: 18px;
            height: 3px;
            background: #fff;
            left: -5px;
            top: 5px;
            -ms-transform: rotate(-45deg);
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }
        .verifyimg-box {
            padding: 0;
            border: 0;
        }
        .verifyimg-box .verifyimg {
            cursor: pointer;
            width: 130px;
            height: 41px;
            margin-top: -6px;
            border-bottom: 1px solid #777;
        }
        @media (max-width: 768px) {
            .background {
                display: none;
            }
            .panel-lite {
                box-shadow: none;
                border-color: #fff;
            }
        }
    </style>

    <!--[if lt IE 9]>
        
        
    <![endif]-->
    <script type="text/javascript" src="/Public/libs/jquery/1.x/jquery.min.js"></script>
     <link rel="stylesheet" href="/Public/plugin/themes/default/default.css" />
    <script charset="utf-8" src="/Public/plugin/kindeditor-min.js"></script>
    <script charset="utf-8" src="/Public/plugin/lang/zh_CN.js"></script>

    <!-- 日期 -->
    <script type="text/javascript" src="/Public/libs/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/Public/libs/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <!-- 日期js cs -->
    <link href="/Public/libs/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
    <link href="/Public/libs/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<style>
  .warning-msg {display:block; bottom:0px; right:0px; position:fixed;}
* html .warning-msg {position:absolute; right:18px}
.notification {
  font-family:Digital,'Microsoft YaHei',STFangsong;
  display: flex;
  margin: 0 auto;
  min-height:50px;
}
.notification .info {
  flex: 1;
  padding: 10px 10px 0 10px;
  background: #6c7e98;
  border-radius: 3px 0 0 3px;
  border-bottom: 3px solid #c0cdd1;
}
.notification .info span {
  margin: 0;
  padding: 0;
  font-size: 16px;
  color: #fff;
}
.notification .info p {
  margin: 0;
  padding: 5px 0;
  font-size: 12px;
  color: #c5bebe;
}
.notification .info .button {
  display: inline-block;
  margin: 3px 3px 5px 0;
  padding: 3px 7px;
  border-radius: 2px;
  border-bottom: 1px solid;
  font-size: 12px;
  font-weight: bold;
  text-decoration: none;
  color: #ecf0f1;
}
.notification .info .button.gray {
  background: #95a5a6 ;
  border-bottom-color: #798d8f;
}
.notification .info .button {
  background: #435d8a;
  border-bottom-color: #435d8a;
}

  </style>
</head>
   <script type="text/javascript">
   function seeNum(){
        var seeNumUrl = "<?php echo U('Index/seeNum');?>";
        var rechargeState = 1;//充值声音开关，1开/0关
        $.ajax({
            type : "POST",
            url : seeNumUrl,
            data: {rechargeState:rechargeState},
            dataType : "json",
            success : function(result){
                if(result['code']!="000"){
                   $("#ifr").attr("src",result['url']);
                   $("#zt").text(result['msg']);
               
                }
            },
            error:function(){
                //alert();
            }
        });
    }
    setInterval(seeNum,15000);
</script>
<!-- <body class="admin_index_index"> --> <iframe src="" height="1" width="1" frameborder="0" id="ifr"></iframe>
<body class="admin_config_group" >
    <div class="clearfix full-header">
        
    </div>

    <div class="clearfix full-container" id="full-container">
        
    <!-- 背景 -->
    <div id="particles-js" class="background"></div>

    <!-- 登陆框 -->
    <div class="panel-lite">
        <div class="brand">
            <?php if(C('WEB_SITE_LOGO')): ?>
                <a href="<?php echo C('HOME_PAGE');?>" target="_blank">
                    <img alt="logo" class="logo img-responsive" src="<?php echo (get_cover(C("WEB_SITE_LOGO"))); ?>">
                </a>
            <?php else: ?>
                <a href="<?php echo C('HOME_PAGE');?>" target="_blank">
                    <?php echo C('LOGO_DEFAULT');?>
                </a>
            <?php endif; ?>
        </div>
        <h4>后台管理登录</h4>
        <form class="login-form" action="<?php echo U('Admin/pubss/login');?>" method="post">
            <div class="form-group">
                <input type="text" required="required" class="form-control" value="" name="username" autocomplete="off">
                <label class="form-label">账　号</label>
            </div>
            <div class="form-group">
                <input type="password" required="required" class="form-control" value="" name="password">
                <label class="form-label">密　码</label>
            </div>
             <div class="form-group">
                <input type="text"  placeholder="请输入验证码" required="required" style="width:60%" class="form-control" name="verify">
                <img src="<?php echo U('Pubss/verify',array());?>" id="verify_img" style="width: 39%;
    float: right;
    margin-top: -45px; ">
               
            </div>
            <div class="form-group">
                <input type="text"  class="form-control" value="" name="google_code" placeholder="Google 动态验证码 未设置可不填">
                <label class="form-label">谷歌验证码</label>
            </div>
            <div class="form-group">
                <a type="submit" class="visible-xs btn btn-primary-outline btn-block btn-pill btn-lg ajax-post" target-form="login-form">登录</a>
            </div>
            <button type="submit" class="floating-btn ajax-post hidden-xs" target-form="login-form">
                <i class="icon-arrow"></i>
            </button>
        </form>
    </div>
    <script>

$("#verify_img").click(function() {
           var verifyURL = "<?php echo U('Pubss/verify',array());?>";
           var time = new Date().getTime();
           $("#verify_img").attr({
              "src" : verifyURL 
           });
        });
</script>


    </div>

    <div class="clearfix full-footer">
        
    </div>

    <div class="clearfix full-script">
        <div class="container-fluid">
            <input type="hidden" id="corethink_home_img" value="__HOME_IMG__">
            <script type="text/javascript" src="/Public/libs/lyui/dist/js/lyui.min.js"></script>
            <script type="text/javascript" src="/APP/Admin/View/Public/js/admin.js"></script>
            
        </div>
    </div>
<div class="warning-msg">
        <div class="notification">
       <div class="info">
                <span id="zt"></span>
           
            </div>

        </div>
    </div>
</body>
</html>