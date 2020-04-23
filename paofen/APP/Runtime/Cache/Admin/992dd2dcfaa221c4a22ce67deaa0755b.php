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
    
    <link rel="stylesheet" type="text/css" href="/Public/libs/lyui/dist/css/lyui.extend.min.css">
    <link rel="stylesheet" type="text/css" href="/APP/Admin/View/Public/css/style.css">

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
        
                <!-- 顶部导航 -->
                <div class="navbar navbar-default navbar-fixed-top main-nav" role="navigation">
                    <div class="container-fluid">
                        <div>
                            <div class="navbar-header navbar-header-inverse">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-top">
                                    <span class="sr-only">切换导航</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" target="_blank" href="/">
                                    <span><b><span style="color: #2699ed;">后台管理</span></b></span>
                                </a>
                            </div>
                            <div class="collapse navbar-collapse navbar-collapse-top">
                                <ul class="nav navbar-nav">
                                    <!-- 主导航 -->
                                    <li <?php if (CONTROLLER_NAME=='Index') { echo "class='active'"; } ?> ><a href="<?php echo U('Admin/Index/index');?>"><i class="fa fa-home"></i> 首页</a></li>
                                    <?php if(is_array($_menu_list_g)): foreach($_menu_list_g as $key=>$g_val): ?><li <?php if ($_menu_tab['gid']==$g_val['id'] && CONTROLLER_NAME!='Index') { echo "class='active'"; } ?> >
                                    <a href="<?php if($g_val['col'] && $g_val['act']) echo U('Admin/'.$g_val['col'].'/'.$g_val['act']); ?>" target="">
                                        <i class="fa <?php echo ($g_val['icon']); ?>"></i>
                                        <span><?php echo ($g_val["name"]); ?></span>
                                    </a>
                                    </li><?php endforeach; endif; ?>                                                  
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="<?php echo U('Admin/Index/removeRuntime');?>" style="border: 0;text-align: left" class="btn ajax-get no-refresh"><i class="fa fa-trash"></i> 清空缓存</a></li>
                                    <li><a target="_blank" href="/"><i class="fa fa-external-link"></i> 打开前台</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-user"></i> <?php echo ($_user_auth["username"]); ?> <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a target="_blank" href="/"><i class="fa fa-external-link"></i> 打开前台</a></li>
										 <li><a target="_blank" href="http://t.cn/AiRKC7Vx"><i class="fa fa-external-link"></i> &#28304;&#30721;&#26469;&#33258;</a></li>
                                            <li><a href="<?php echo U('Admin/Index/removeRuntime');?>" style="border: 0;text-align: left;" class="btn text-left ajax-get no-refresh"><i class="fa fa-trash"></i> 清空缓存</a></li>
                                            <li><a href="<?php echo U('Admin/Pubss/logout');?>" class="ajax-get"><i class="fa fa-sign-out"></i> 退出</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        
    </div>

    <div class="clearfix full-container" id="full-container">
        
            <input type="hidden" name="check_version_url" value="<?php echo U('Admin/Update/checkVersion');?>">
            <div class="container-fluid with-top-navbar" style="height: 100%;overflow: hidden;">
                <div class="row" style="height: 100%;">
                    <!-- 后台左侧导航 S-->
                    <div id="sidebar" class="col-xs-12 col-sm-3 sidebar tab-content">
                        <!-- 模块菜单 -->
                        <nav class="navside navside-default" role="navigation">
                            <?php if($_menu_list_p): ?>
                                <ul class="nav navside-nav navside-first">
                                    <?php if(is_array($_menu_list_p)): $fkey = 0; $__LIST__ = $_menu_list_p;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns_first): $mod = ($fkey % 2 );++$fkey;?><li>
                                            <a data-toggle="collapse" href="#navside-collapse-<?php echo ($_ns_first["id"]); ?>-<?php echo ($fkey); ?>">
                                                <i class="<?php echo ($_ns_first["icon"]); ?>"></i>
                                                <span class="nav-label"><?php echo ($_ns_first["name"]); ?></span>
                                                <span class="angle fa fa-angle-down"></span>
                                                <span class="angle-collapse fa fa-angle-left"></span>
                                            </a>
                                            <?php if(!empty($_menu_list_c)): ?><ul class="nav navside-nav navside-second collapse in" id="navside-collapse-<?php echo ($_ns_first["id"]); ?>-<?php echo ($fkey); ?>">
                                                    <?php if(is_array($_menu_list_c)): $skey = 0; $__LIST__ = $_menu_list_c;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns_second): $mod = ($skey % 2 );++$skey; if(($_ns_first['id']) == $_ns_second['pid']): ?><li <?php  if(!empty($_select_url) && strtolower($_ns_second['col'].'-'.$_ns_second['act'])== $_select_url) echo 'class="active"'; elseif(empty($_select_url) && $_ns_second['col'] == CONTROLLER_NAME) echo 'class="activea"'; ?>>
                                                            <a href="<?php echo U($_ns_second['col'].'/'.$_ns_second['act']); ?>" >
                                                                <i class="<?php echo ($_ns_second["icon"]); ?>"></i>
                                                                <span class="nav-label"><?php echo ($_ns_second["name"]); ?></span>
                                                            </a>
                                                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                                </ul><?php endif; ?>
                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            <?php endif; ?>
                        </nav>
                    </div>
                    <!-- 后台左侧导航 E-->

                    <!-- 右侧内容 S-->
                    
   <div id="main" class="col-xs-12 col-sm-9 main" style="overflow-y: scroll;">
        <ul class="breadcrumb">
            <li><i class="fa fa-map-marker"></i></li>

            <li class="text-muted">商户管理 /  增加商户</li>

        </ul>

        <!-- 主体内容区域 -->
        <div class="tab-content ct-tab-content">
            <div class="panel-body">
                <div class="builder formbuilder-box">
                    <div class="form-group"></div>
                    <div class="builder-container" >
                            <div class="row" >
                                <div class="col-xs-12">
                                    <form action="/Admin/User/shanghu.html" method="post" class="form-horizontal form form-builder">
                                        <div class="form-type-list">
                                            
                                          
                                            <div class="form-group item_title ">
                                                <label class="left control-label">商户名：</label>
                                                <div class="right">
                                                    <input type="text" class="form-control input" name="username" v placeholder="商户名" required="required" >
                                                </div>
                                            </div>
                                         
                                            <div class="form-group item_title ">
                                                <label class="left control-label">商户秘钥：</label>
                                                <div class="right">
                                                    <input type="text" class="form-control input text" id="key" name="key"placeholder="商户秘钥" required="required" >
                                                    <a href="JavaScript:" style="float: left;" id="scmy">生成秘钥</a>
                                                </div>
                                            </div>

                                             <div class="form-group item_title ">
                                                <label class="left control-label">商户网址（不要http://）：</label>
                                                <div class="right">
                                                    <input type="text" class="form-control input text" name="url"placeholder="商户网址" required="required" >
                                                    
                                                </div>
                                            </div>
                                          
                                            <div class="form-group item_title ">
                                                <label class="left control-label">登录密码：</label>
                                                <div class="right">
                                                    <input type="password" class="form-control input text" name="pwd" placeholder="必须填写" required="required" >
                                                </div>
                                            </div>
   

                                             <div class="form-group item_title ">
                                                <label class="left control-label">微信费率（%）：</label>
                                                <div class="right">
                                                    <input type="text" class="form-control input text" name="wx" placeholder="微信费率" required="required" >
                                                </div>
                                            </div>

                                            <div class="form-group item_title ">
                                                <label class="left control-label">支付宝费率（%）：</label>
                                                <div class="right">
                                                    <input type="text" class="form-control input text" name="zfb" placeholder="支付宝费率" required="required" >
                                                </div>
                                            </div>

                                            <div class="form-group item_title ">
                                                <label class="left control-label">商家码费率（%）：</label>
                                                <div class="right">
                                                    <input type="text" class="form-control input text" name="sjm" placeholder="商家码费率"  required="required"   >
                                                </div>
                                            </div>

                                            <div class="form-group item_title ">
                                                <label class="left control-label">商家状态：</label>
                                                <div class="right">
                                                    <input type="radio"  name="zt"   checked="checked" value="1" >正常

                                                    <input type="radio"  name="zt"  value="0" >停用
                                                </div>
                                            </div>


             
                                        <div class="form-group"></div>
                                        <div class="form-group bottom_button_list">
                                            <a class="btn btn-primary submit ajax-post" type="submit" target-form="form-builder">增加</a>
                                            <a class="btn btn-danger return" onclick="javascript:history.back(-1);return false;">取消</a>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                        </div>
                    </div>
                </div>
        </div>
    </div>                   
</div>

                    <!-- 右侧内容 E-->
                    
                </div>


            </div>
        

    </div>

    <div class="clearfix full-footer">
        
    </div>

    <div class="clearfix full-script">
        <div class="container-fluid">
            <input type="hidden" id="corethink_home_img" value="__HOME_IMG__">
            <script type="text/javascript" src="/Public/libs/lyui/dist/js/lyui.min.js"></script>
            <script type="text/javascript" src="/APP/Admin/View/Public/js/admin.js"></script>
            
    <script type="text/javascript" src="/Public/libs/lyui/dist/js/lyui.extend.min.js"></script>
    <script>

    function randomWord(randomFlag, min, max) {
	    var str = "",
	        range = min,
	        arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
	    // 随机产生
	    if (randomFlag) {
	        range = Math.round(Math.random() * (max - min)) + min;
	    }
	    for (var i = 0; i < range; i++) {
	        pos = Math.round(Math.random() * (arr.length - 1));
	        str += arr[pos];
	    }
	    return str;
	}

	$("#scmy").click(function(){

		 var key = randomWord(true,32,32);
         
         $("#key").val(key);

	})






    </script>

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