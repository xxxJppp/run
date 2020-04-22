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
  <link rel="stylesheet" type="text/css" href="/APP/Admin/View/Public/css/lytebox_v5.5/lytebox.css">
  	<script src="/APP/Admin/View/Public/css/lytebox_v5.5/lytebox.js" charset=""></script>


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

            <li class="text-muted">交易完成订单</li>

        </ul>

        <!-- 主体内容区域 -->
        <div class="tab-content ct-tab-content">
            <div class="panel-body">
                <div class="builder formbuilder-box">
                        
                        <div class="form-group"></div>

                        <!-- 顶部工具栏按钮 -->
                        <div class="builder-toolbar">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 clearfix" style="margin-bottom:20px;padding-top:0px;padding-bottom:10px;">
                                        
                                            <div class="form-group right">
												<form class="form" method="get" action="">
                                                      <div style="float:left;width:12%;" class="input-group search-form ssssy">  <span style="float:left;height: 34px; ">订单号</span>
                                                    <input  type="text" name="mobile" class="search-input  " value="<?php echo ($_GET["mobile"]); ?>"  placeholder="" style="float: left;width: 65%;"> </div>
                                                 <div style="float:left;width:15%;" class="input-group search-form ssssy"> <span style="float:left;height: 34px; ">类型</span>
                                                   <input  type="text" name="class" class="search-input  " value="<?php echo ($_GET["class"]); ?>"  placeholder="1:微信,2:支付宝,3:银行卡" style="float: left;width: 84%;"> </div>
                                                
                                                   <div style="float:left;width:12%" class="input-group search-form ssssy"> <span style="float:left;height: 34px; ">用户</span>
                                                   <input  type="text" name="userid" class="search-input  " value="<?php echo ($_GET["userid"]); ?>"  placeholder="" style="float: left;width: 80%;"> </div> 
                                                <div style="float:left;width:10%" class="input-group search-form ssssy">  <span style="float:left;height: 34px; ">金额</span>
                                                  <input  type="text" name="money" class="search-input  " value="<?php echo ($_GET["money"]); ?>"  placeholder="" style="float: left;width: 70%;"> </div>
                                                 <div style="float:left;" class="input-group search-form ssssy"> <span style="float:left;height: 34px; ">起始日期</span>
                                                   <input  type="text" name="date" class="search-input " value="<?php echo ($_GET["date"]); ?>"  placeholder="格式:2019-11-19" style="float: left;width: 65%;"> </div>
                                       <div style="float:left;" class="input-group search-form ssssy"> <span style="float:left;height: 34px; ">结束日期</span>
                                                   <input  type="text" name="dateend" class="search-input " value="<?php echo ($_GET["dateend"]); ?>"  placeholder="格式:2019-11-19" style="float: left;width: 65%;"> </div>
                                                  <div style="float:left;width:3%" class="input-group search-form ssssy">   
                                               <span class="input-group-btn"><a class="btn btn-default search-btn" style="padding:2px;"><i class="fa fa-search"></i></a></span></div>
                                               
										
												 
												<form class="form" method="get" action="">
												<div style="float:left;width:7%;" class="input-group search-form" style="">
                                                    <input type="hidden" value="1" name="coinpx" />
                                                    <input type="submit" value="余额排序" style="border:none;height:33px;width:80%;background:#2699ed;color:#ffffff;cursor:pointer;"/></button>
                                                </div>
												 </form>

												
                                            </div>
                                       
                                 </div>
                            </div>
                        </div>
                        <style type="text/css">tr,td{margin: 0 !important;padding: 5px 5px !important;}</style>

                        <!-- 数据列表 -->
                        <div class="builder-container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="builder-table">
                                        <div class="panel panel-default table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                              <thead>
                                                <tr>
                                                    <th style="font-size:12px;">ID</th>
                                                    <th style="font-size:12px;">订单号</th>
                                                    <th style="font-size:12px;">会员账号</th>
                                                  <th style="font-size:12px;">收款姓名</th>
                                                   <th style="font-size:12px;">收款账号</th>
                                                    <th style="font-size:12px;">余额</th>
                                                    <th style="font-size:12px;">收款类型</th>
                                                    <th style="font-size:12px;">收款金额</th>
                                                    <th style="font-size:12px;">匹配时间</th>
                                                    <th style="font-size:12px;">完成时间</th>
                                                   <th style="font-size:12px;">二维码</th>
                                                    <th style="font-size:12px;">状态</th>
                                                    <th style="max-width:20%;font-size:12px;" >操作</th>
                                                </tr>
                                            </thead>
												<tbody>
													<?php if(empty($list)): ?><tr class="builder-data-empty">
                                                            <td class="text-center empty-info" colspan="20"  style="font-size:12px;">
                                                                <i class="fa fa-database"></i> 暂时没有数据<br>
                                                            </td>
                                                        </tr> 
													<?php else: ?>
													<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
															<td style="font-size:12px;"><?php echo $v['id'];?></td>
															<td style="font-size:12px;"><?php echo $v['ordernum'];?></td>
															<td style="font-size:12px;"><?php echo $v['uaccount'];?></td>
														<td style="font-size:12px;"><?php echo getskname($v['idewm']);?></td>
                                                          <td style="font-size:12px;"><?php echo getskhao($v['idewm']);?></td>
															<td style="font-size:12px;"><?php echo getusermoney($v['uid']);?></td>
															<td style="font-size:12px;">
																<?php if($v['class'] ==1){ echo '微信收款'; }elseif($v['class'] ==2){ echo '支付宝收款'; }elseif($v['class'] ==2){ echo '银行收款'; }?>
															</td>
															<td style="font-size:12px;"><?php echo $v['price'];?></td>
															<td style="font-size:12px;"><?php echo date('Y-m-d H:i',$v['pipeitime']);?></td>
															<td style="font-size:12px;"><?php echo date('Y-m-d H:i',$v['finishtime']);?></td>
                                                          <td style="font-size:12px;">
                                                              
                                                              <a href="<?php echo $v['ewmimg'];?>" rel="lytebox">查看二维码</a>
                                                              
                                                            </td>
															<td style="font-size:12px;color:red;"><?php if($v['status']==3){echo '交易成功';}?></td>
															
															<td style="font-size:12px;">
																<a href="<?php echo U('Roborder/delsuccess',array('id'=>$v['id']));?>"  style="font-size:12px;cursor:pointer;">删除订单</a>
															</td>	
														</tr><?php endforeach; endif; endif; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        
                                           <style>
												.pages a,.pages span {display:inline-block;padding:2px 5px;margin:0 1px;border:1px solid #f0f0f0;-webkit-border-radius:3px; -moz-border-radius:3px;border-radius:3px;}
												.pages a,.pages li {display:inline-block;list-style: none;text-decoration:none; color:#58A0D3;}
												.pages a.first,.pages a.prev,.pages a.next,.pages a.end{ margin:0;}
												.pages a:hover{ border-color:#50A8E6;}
												.pages span.current{ background:#50A8E6;color:#FFF; font-weight:700;border-color:#50A8E6;}
											</style>
											<div class="pages"><br /> <div align="right"> <li class="rows">每页显示</li>:
                                              <a class="num" href="?fy=100">100</a>
                                              <a class="num" href="?fy=500">500</a>
                                              <a class="num" href="?fy=1000">1000</a><?php echo ($page); ?></div></div>
                                    
                                    </div>
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
            
<script type="text/javascript">
    $('.date').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        minView:2,
        autoclose:true,
        todayBtn:1, //是否显示今日按钮
    });
 
    $(document).ready(function(){
  
    $(".bky").click(function(){
      
        this.href="###";
        alert("您无权限访问");  
        return false;     

        });

    });
	
	
	
	
</script>
   <script type="text/javascript">
    
	
 function show_sub(v){ 
   if(v=='class'){
    $('#tips').attr('placeholder','1:微信,2:支付宝,3:银行卡');
   }else if(v=='zt'){
    $('#tips').attr('placeholder','1:未匹配,2:已匹配,3:成功,4:超时');
   }else if(v=='date'){
     $('#tips').attr('placeholder','格式:2019-11-19');
   }else{ $('#tips').attr('placeholder','请输入搜索内容');}
  
            //alert(v);     
        }   
	
</script>
  <!--   <script type="text/javascript" src="/Public/libs/lyui/dist/js/lyui.extend.min.js"></script> -->

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