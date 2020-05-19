<?php
use xh\library\url;
use xh\unity\cog;
use xh\library\model;
$fix = DB_PREFIX;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title><?php echo cog::web()['name'];?>-接口文档</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/Public/Front/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/Front/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Public/Front/css/animate.css" rel="stylesheet">
    <link href="/Public/Front/css/style.css" rel="stylesheet">
   <link href="/Public/Front/css/zuy.css" rel="stylesheet">
    <link rel="stylesheet" href="/Public/Front/js/plugins/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/Public/Front/iconfont/iconfont.css"/>
    <style>
        .layui-form-label {width:110px;padding:4px}
        .layui-form-item .layui-form-checkbox[lay-skin="primary"]{margin-top:0;}
        .layui-form-switch {width:54px;margin-top:0px;}
    </style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated" style="float:left;width:1200px;!important;margin:10px">
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>API设置</h5>
            </div>
            <!--条件查询-->
            <div class="ibox-content">
                <address>
                    <strong>API对接参数：</strong><br><br>
                    商户号：<?php echo $_SESSION['MEMBER']['uid'];?><br><br>
                    网关地址：<?php echo URL_ROOT; ?>/gateway/index/addorder.do<br><br>
                    商户APIKEY：<?php echo $_SESSION['MEMBER']['key_id'];?></span>
                </address>
                <address>
                    <strong>对接Demo下载</strong><br><br>
                    点击下载：<a href="/download/phpdemo.zip">PHP DEMO</a> &nbsp;	&nbsp;	<a href="/download/javademo.zip">JAVA DEMO</a>   &nbsp;	&nbsp;	 <a href="/download/Cdemo.zip">C# DEMO</a>
                  <br><br>
                  <a href="/pankou/doc/getQrcode.do" target="_blank">在线浏览 扫码支付API文档</a> <br><br>
                  <a href="/pankou/doc/sign.do" target="_blank">在线浏览 sign签名文档</a> <br><br>
                  <a href="/pankou/doc/callback.do" target="_blank">在线浏览 异步通知</a><br><br>
                  <a href="/pankou/doc/getOrder.do" target="_blank">在线浏览 订单查询接口</a>
    
                </address>
           
</div>
<script src="/Public/Front/js/jquery.min.js"></script>
<script src="/Public/Front/js/bootstrap.min.js"></script>
<script src="/Public/Front/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/Public/Front/js/content.js"></script>
<script src="/Public/Front/js/plugins/layui/layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/x-layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/Util.js" charset="utf-8"></script>
</body>
<script>
    var apikey;
    var index;
    layui.use('layer', function(layer){
        apikey = function (obj) {
            index = layer.prompt({
                        formType: 1,
                        title: '为了安全起见，请输入支付密码',
                        close: false,
                        btn: ['确定','取消']
                    }, function (value){
                        if(!value){
                            layer.msg('请输入支付密码', {icon: 5});
                            return false;
                        }
                        show(value)
                    });
        };
    });
    

    function show(code){
        var data = {};
        if(code){
            data = {code:code};
        }
        $.ajax({
            url:"/agent_Channel_Apikey.html",
            type:"post",
            data: data,
            success:function(res){
                if(res.status){
                    $('#apikey-query').hide();
                    $('#apikey').text(res.apikey).removeClass('hide')
                    layer.close(index);
                }else {
                    layer.msg(res.msg, {icon: 5});
                    return false;
                }
            }
        });
    }
</script>
</html>