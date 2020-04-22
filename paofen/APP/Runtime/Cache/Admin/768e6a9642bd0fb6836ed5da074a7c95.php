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
        <!-- 面包屑导航 -->
        <ul class="breadcrumb">
            <li><i class="fa fa-map-marker"></i></li>

             <li class="text-muted">游戏参数设置</li>
        </ul>

        <!-- 主体内容区域 -->
        <div class="tab-content ct-tab-content">
            <div class="panel-body">
                <div class="builder formbuilder-box">

                    <div class="form-group"></div>
                    <div class="builder-container" >
                        <div class="row" >
                            <div class="col-xs-12" >
                                <form action="<?php echo U('Roborder/asystem');?>" enctype="multipart/form-data" method="post" class="form-horizontal form form-builder">
                                <div class="form-type-list">
                                    抢单参数设置<hr style="margin-top: 0px;width: 100%">
														<div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">联系客服：</label>
                                         <div style="width:50%" class="input-group">
                                            <input type="text" name="qd_kf" class="form-control" value="<?php echo ($info["qd_kf"]); ?>" placeholder="我的-设置-联系客服 显示的联系方式！"/>我的-设置-联系客服 显示的联系方式！
                                         
                                        </div>
                                    </div>
																		<!--div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">联系客服二维码：</label>
                                         <div style="width:50%" class="input-group">
                                           <div  style="float:left;width:20%;">
                                                    <input type="file" name="wxewm" value=" "  style="height:100%;line-height:100%;"/>
                                                </div>
												<?php if($info['qd_sq']){?>
												<div  style="float:left;width:30%;">
                                                   <img src ="/Uploads/payimg/<?php echo $info['qd_sq'];?>" style="height:100%;width:auto;"/>
                                                </div>
												<?php } ?>
                                            
                                        </div>
                                    </div-->
                                   <div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">抢单额度比例：</label>
                                        <div style="width:50%" class="input-group">
                                            <input type="text" name="qd_cf" class="form-control" value="<?php echo ($info["qd_cf"]); ?>" placeholder="抢单金额和用户余额比例，如余额1000，最大抢单为700，就填70，表示70%"/>
                                            
                                        </div>
                                    </div>

                                     <div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">抢单难度:</label>
                                        <div style="width:50%" class="input-group">
                                            <input type="text" name="qd_nd" class="form-control" value="<?php echo ($info["qd_nd"]); ?>" placeholder="0.1,0.2,0.3,0.4 注意输入时难度系数单以英文逗号隔开，否则会出错"/>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">会员预留款额度:</label>
                                        <div style="width:50%" class="input-group">
                                            <input type="text" name="ed" class="form-control" value="<?php echo ($info["ed"]); ?>" placeholder="额度低于多少，不可以抢单 元"/>
                                            
                                        </div>
                                    </div>


                                    <span style="display: none">
                                    <div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">微信抢单佣金比例：</label>
                                        <div style="width:50%" class="input-group">
                                            <input type="text" name="qd_wxyj" class="form-control" value="<?php echo ($info["qd_wxyj"]); ?>" placeholder="微信抢单佣金比例：如30%要写成30"/>
                                            
                                        </div>
                                    </div>
									<div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">支付宝抢单佣金比：</label>
                                         <div style="width:50%" class="input-group">
                                            <input type="text" name="qd_zfbyj" class="form-control" value="<?php echo ($info["qd_zfbyj"]); ?>" placeholder="支付宝抢单佣金比例：如30%要写成30"/>
                                            
                                        </div>
                                    </div>
									<div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">银行抢单佣金比例：</label>
                                         <div style="width:50%" class="input-group">
                                            <input type="text" name="qd_bkyj" class="form-control" value="<?php echo ($info["qd_bkyj"]); ?>" placeholder="银行抢单佣金比例：如30%要写成30"/>
                                            
                                        </div>
                                    </div>
                                  </span>

                                    <div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">微信充值手续费：(&nbsp;%）</label>
                                        <div style="width:50%" class="input-group">
                                            <input type="text" name="wxb" class="form-control" value="<?php echo ($info["wxb"]); ?>" placeholder="微信充值手续费：如10%要写成10"/>
                                      
                                        </div>
                                    </div>
                                    <div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">支付宝充值手续费：(&nbsp;%）</label>
                                         <div style="width:50%" class="input-group">
                                            <input type="text" name="zfbb" class="form-control" value="<?php echo ($info["zfbb"]); ?>" placeholder="支付宝充值手续费：如10%要写成10"/>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">银行充值手续费：(&nbsp;%）</label>
                                         <div style="width:50%" class="input-group">
                                            <input type="text" name="ylb" class="form-control" value="<?php echo ($info["ylb"]); ?>" placeholder="银行充值手续费：如10%要写成10"/>
                                    
                                        </div>
                                    </div>




									<div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">增加难度时间点：</label>
                                         <div style="width:50%" class="input-group">
                                            <input type="text" name="qd_ndtime" class="form-control" value="<?php echo ($info["qd_ndtime"]); ?>" placeholder="如11点写成11,表示11点至12点，多个点写成9,11,13,15以英文逗号隔开"/>
                                            
                                        </div>
                                    </div>
									<div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">佣金加成：</label>
                                         <div style="width:50%" class="input-group">
                                            <input type="text" name="qd_yjjc" class="form-control" value="<?php echo ($info["qd_yjjc"]); ?>" placeholder="如加成0.1%，写成0.01"/>
                                            
                                        </div>
                                    </div>

                                 
                                     <div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">二维码匹配间隔时间(分钟)</label>
                                         <div style="width:50%" class="input-group">
                                            <input type="text" name="jdtime" class="form-control" value="<?php echo ($info["jdtime"]); ?>" placeholder="单位:分钟"/>
                                            
                                        </div>
                                    </div>
                                    



									<div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">最低抢单额度：</label>
                                         <div style="width:50%" class="input-group">
                                            <input type="text" name="qd_minmoney" class="form-control" value="<?php echo ($info["qd_minmoney"]); ?>" placeholder="如：100"/>
                                            
                                        </div>
                                    </div>
                                    
                                     充值提现参数设置<hr style="margin-top: 0px;width: 100%">
                                   <div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">最小充值额度：</label>
                                        <div style="width:50%" class="input-group">
                                            <input type="text" name="min_recharge" class="form-control" value="<?php echo ($info["min_recharge"]); ?>" placeholder="直接填写最小充值金额如：1000"/>
                                            
                                        </div>
                                    </div>

                                   
                                    
                                     <div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">最小提现额度：</label>
                                       <div style="width:50%" class="input-group">
                                            <input type="text" name="mix_withdraw" class="form-control" value="<?php echo ($info["mix_withdraw"]); ?>" placeholder="直接填写最小提现金额如：1000"/>
                                            
                                        </div>
                                    </div>
									 <div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">最大提现额度：</label>
                                       <div style="width:50%" class="input-group">
                                            <input type="text" name="max_withdraw" class="form-control" value="<?php echo ($info["max_withdraw"]); ?>" placeholder="直接填写最大提现额度如：10000"/>
                                            
                                        </div>
                                    </div>
									<div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">收款与充值额度比：</label>
                                       <div style="width:50%" class="input-group">
                                            <input type="text" name="tx_yeb" class="form-control" value="<?php echo ($info["tx_yeb"]); ?>" placeholder="提现时需对与收款与充值额度比例，70% 写70"/>
                                            
                                        </div>
                                    </div>tx_yeb
									
									团队奖励设置<hr style="margin-top: 0px;width: 100%">
									
                                     <div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">直推佣金收益比例：</label>
                                        <div style="width:50%" class="input-group">
                                            <input type="text" name="team_oneyj" class="form-control" value="<?php echo ($info["team_oneyj"]); ?>" placeholder="直推佣金收益比例10%写成0.1"/>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">二代佣金收益比例：</label>
                                         <div style="width:50%" class="input-group">
                                            <input type="text" name="team_twoyj" class="form-control" value="<?php echo ($info["team_twoyj"]); ?>" placeholder="二代佣金收益比例5%写成0.05"/>
                                            
                                        </div>
                                    </div>

                                   <div class="form-group item_config[WEB_SITE_TITLE] ">
                                        <label class="left control-label">三代佣金收益比例：</label>
                                        <div style="width:50%" class="input-group">
                                            <input type="text" name="team_threeyj" class="form-control" value="<?php echo ($info["team_threeyj"]); ?>" placeholder="三代佣金收益比例3%写成0.03"/>
                                            
                                        </div>
                                    </div>

                                 
                                <div class="form-group"></div>
                                <div class="form-group bottom_button_list">
                                    <a class="btn btn-primary submit ajax-post" type="submit" target-form="form-builder">确定</a>
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