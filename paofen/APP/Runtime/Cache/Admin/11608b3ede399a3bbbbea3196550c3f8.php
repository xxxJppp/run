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
            <?php if(is_array($_menu_tab['name'])): foreach($_menu_tab['name'] as $key=>$tab_v): ?><li class="text-muted"><?php echo ($tab_v); ?></li><?php endforeach; endif; ?>
            <li class="text-muted">google验证码绑定</li>
        </ul>

        <!-- 主体内容区域 -->
        <div class="tab-content ct-tab-content">
            <div class="panel-body">
                <div class="builder formbuilder-box">
                    <div class="form-group"></div>
                    <div class="builder-container" >

                        <div>
                            <div class="">
                                <p class="">两步验证</p>
                                <p>请下载 Google 的两步验证器。</p>
                                <p><i class="fa fa-android"></i><a id="android" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2">&nbsp;Android</a></p>
                                <p><i class="fa fa-apple"></i><a id="ios" href="https://itunes.apple.com/cn/app/google-authenticator/id388497605?mt=8">&nbsp;iOS</a></p>

                                <p>如果遇到问题，请参考：<a href="https://phpartisan.cn/specials/5" target="_blank">Google Authenticator帮助文档</a></p>

                                <p style="color:red">在没有测试完成绑定成功之前请不要启用。</p>
                                <p>当前设置：<?php if($info['is_open_google_auth']){ ?> <code> 要求验证 </code><?php }else{ ?> <code> 不要求验证 </code>  <?php } ?></p>
                                <p>当前服务器时间：<span class="text-red" id="txt"></span></p>
                                <div class="form-group form-group-label control-highlight-custom dropdown control-highlight">
                                    <label class="floating-label" for="ga-enable">验证设置</label>
                                    <button type="button" id="ga-enable" class="form-control maxwidth-edit" data-toggle="dropdown" value="<?php if($info['is_open_google_auth'] || empty($info['google_auth'])){ ?>1<?php }else{ ?>0<?php } ?>">
                                        <?php if($info['is_open_google_auth'] || empty($info['google_auth'])){ ?>   要求验证 </code><?php }else{ ?> 不要求验证  <?php } ?>
                                    </button>
                                    <ul class="dropdown-menu text-center"  style="width: 100%;border-radius: unset;box-shadow: 0 6px 12px rgba(0,0,0,.175);">
                                        <li><a class="yes_auth" >要求验证</a></li>
                                        <li><a class="no_auth" >不要求</a> </li>

                                    </ul>
                                </div>
                                <div class="form-group form-group-label">
                                    <div class="text-center">
                                        <div>
                                            <img src = "<?php echo ($qrcode); ?>" height="200" width="200" />
                                        </div>
                                        <h4 class="">
                                            密钥：<span class="text-red"><?php echo ($createSecret); ?></span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="form-group form-group-label">
                                    <label class="floating-label" for="code">测试一下</label>
                                    <input type="hidden" name="google" value="<?php echo ($createSecret); ?>" />
                                    <input name="onecode" class="form-control"  type="text" placeholder="请输入扫描后手机显示的6位验证码" value="" />
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="">
                                    <button class="btn btn-default test">测试</button>
                                    <button class="btn btn-primary success">设置</button>
                                </div>
                            </div>
                        </div>


                        <script>




                            $(document).ready(function(){

                                $('.no_auth').on('click',function (e) {
                                    $('#ga-enable').val(0);
                                    $('#ga-enable').html($(this).html());
                                });

                                $('.yes_auth').on('click',function (e) {
                                    $('#ga-enable').val(1);
                                    $('#ga-enable').html($(this).html());

                                });

                                $('.test').on('click',function (e) {
                                    $.ajax({
                                        url:"googlePost",
                                        type:'post',
                                        data:{google:$("input[name='google']").val(),onecode:$("input[name='onecode']").val()},
                                        success:function (obj) {
                                            console.log(obj);
                                            alert(obj.info);
                                        }
                                    });

                                });
                                $('.success').on('click',function (e) {

                                    $.ajax({
                                        url:"setGoogleAuth",
                                        type:'post',
                                        data:{is_open_google_auth:$('#ga-enable').val()},
                                        success:function (obj) {
                                            console.log(obj);
                                            alert(obj.info);
                                        }
                                    });
                                });

                                $('#android').popover({
                                    trigger : 'hover',
                                    html:true,
                                    content:"<img height='100' width='100' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEAAQAAAAB0CZXLAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAd2KE6QAAAAHdElNRQfjCxUOBxONcq8jAAACnElEQVRo3tWZPY7rMAyEKbhI6SPkKL6ZldzMR/ERXKowzMeZkTa722z5TEEIAuhrCP4NafM/jt0BaBantOfb99Xid7N5O82meMJZkgDPsCVeawP2wtMW95w9GD/SAC9YtxdipS0wzZbTlumwKRfQrPoevqlhIF7NwsyEQGm2PvbqHq+w0ZMBCDmkD7AVPloQab9i8u7ASP9+Aej+rg93BlRw5SnCJxIHvz9q9c2BcNaIOiMTDjrnzaMmm3Vv3h9A4XpeFtcK7Y0ibEycTACts4dfvO8OIPH9K3EyACue0NkdJivY0N9PdPkkANo6Ej/aukIuylcPOfzxJIBHsK2It11e8yMizdjf2VBSAE11WD1xXx9wkBh2xiwAPMWs2U1njoQJxSiXeRIgxJXLzPBX1RMbChJnzgJ0rVgoFwuscwqtTdI3B8CnghnKqN43+qunf+84CQCca2itq1dgMKaQywGgcIVEgVCJCtaY+72zm5z1/4FvOlDi3Ob+2iV6CoD9mrGEG2bKEfE6GkoKAJ6KSvuCyzDxyUwWKCmQHIDDzF1qil7rOsq9K5AMAFp2pacuzd3Ia3ZtLkNyANinwV/c50T7W+SpiVJKY1QCgM2isoK9WAJ8TNzTYXkAf9NS5g4VCAE/PoN5AiDkB5tdTEmyNLKGKbNxPbjkABzWFU3faIvGJS0b93BWCkCrA2MdLsNZ5/BXDoDNXdsDpybkAkTp/5Eodwf6Vk3jHjQtPGVdn0xHEqBvOLE6CBtrSBTOF58ilgN4OnsihQq+X2BJi3EPZp6WBujfLxrrGJe02OEwlTSxpgG898Q6Jlbj3G3JgL6t9abOblqA/Phkdm+AIacNJ0ZXfoLZhsuyAEp/rc3DTKlEU9Zo1ZMA8D9OCuAfOvBOGWO+UU0AAAAldEVYdGRhdGU6Y3JlYXRlADIwMTktMTEtMjFUMjE6MDc6MTktMDc6MDDQWz//AAAAJXRFWHRkYXRlOm1vZGlmeQAyMDE5LTExLTIxVDIxOjA3OjE5LTA3OjAwoQaHQwAAAABJRU5ErkJggg=='>",

                                })
                                $('#ios').popover({
                                    trigger : 'hover',
                                    html:true,
                                    content:"<img height='100' width='100' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEAAQAAAAB0CZXLAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAd2KE6QAAAAHdElNRQfjCxUOCQp3miptAAACe0lEQVRo3t2ZMZKDMAxFzVC45AgchZsFcjMfhSNQUjDW/v8F2U22SIvlmZAEXgpZsr6kJPuyUhPAkbgGs35P09O2NBsvx7DqwRwFyDB2H9aZXx+JH/I24d7KS2kGWFNHAGam1Busw08WfJhgfURgtIp9ALRpQxoEbIF1ZcazZAzOIxygoEUqYdD227jwzvNfVN8c8AQib5YT2GTme4ZpHDizPgDzE6edqcycb3rROHAlUsTqiE/YB3wrM7Znqni1AvCK+8b0aAfOIEMYz8YiXYgDuHZjH2A+AawK35YPcb81kJEQ80ZPrhQ1mEp7mTCVOcMAZyL1oAWFh5Mxw3xk2lsDPGMZCcT25KvH0UtImKVm86o4AEDzO6leXhW9Cz2qWgVOphzEALA6hiiVgPkTr0FyUOpL9ZoA4MhRekZK5bHqyW4PBrA3gwC46vW7uxRBSzloAjhwP3nNb6VjFWI6eqYIVYaJAFDsOjc/saVmrTJQ9dZUJQdtALCOMUktKyqPr4Q5SdKDAPJm9tamKNV4styu9NkIQHvgSI4DdN/t9XLRK7EAADtPiTTjdeabJleHAA/aEADOpv1qNzfEEyn7bmXaFgAGLQstjT7qOWZUeXz+LgigUQ+1mz0O5eDQXA6H1MWwEYCOtFUyJl1gXHImPF2dWgxAFRUSC/trNqRH3tJrNQJ4oaUWZrSF9xSKII31iAUBfv+eQE55qrf2DcH2/B0/tg6cfbfPRpL87j2ONQX4xFtBywmPsa1+0FhvYWIBC9Was2L2bRQ8XPa3yX8TAOsN7zdNE286+c3MxgEPWvOiRBPvE/iYy90a8ATiFchyeVN/T9RAgH1ZMYAfXZaYCVpMtGYAAAAldEVYdGRhdGU6Y3JlYXRlADIwMTktMTEtMjFUMjE6MDk6MTAtMDc6MDBbCkqfAAAAJXRFWHRkYXRlOm1vZGlmeQAyMDE5LTExLTIxVDIxOjA5OjEwLTA3OjAwKlfyIwAAAABJRU5ErkJggg=='>",

                                })

                            });

                            startTime();
                            function startTime()
                            {
                                //获取当前系统日期
                                var myDate = new Date();
                                var y=myDate.getFullYear(); //获取当前年份(2位)
                                var m=myDate.getMonth()+1; //获取当前月份(0-11,0代表1月)
                                var d=myDate.getDate(); //获取当前日(1-31)
                                var h=myDate.getHours(); //获取当前小时数(0-23)
                                var mi=myDate.getMinutes(); //获取当前分钟数(0-59)
                                var s=myDate.getSeconds(); //获取当前秒数(0-59)
                                var hmiao=myDate.getMilliseconds(); //获取当前毫秒数(0-999)
                                //s设置层txt的内容
                                document.getElementById('txt').innerHTML=y+"-"+m+"-"+d+" "+h+":"+mi+":"+s;
                                //过500毫秒再调用一次
                                t=setTimeout('startTime()',500)
                                //小于10，加0
                                function checkTime(i)
                                {
                                    if(i<10)
                                    {i="0"+i}
                                    return i
                                }
                            }



                        </script>






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
            
    <?php echo ($extra_html); ?>
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