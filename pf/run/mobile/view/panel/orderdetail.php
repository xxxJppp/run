<?php
use xh\library\url;
use xh\library\model;

$fix = DB_PREFIX;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>聚合支付 - 管理中心</title>
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
<div class="wrapper wrapper-content animated">
      <div class="ibox-content">
        <table class="layui-table">
          <tr><td>交易金额：</td><td><strong class="text-danger">1.0000</strong></td></tr>
          <tr><td>手续费：</td><td><strong class="">0.0000</strong></td></tr>
          <tr><td>实际金额：</td><td><strong class="text-success">1.0000</strong></td></tr>
          <tr><td>提交时间：</td><td><strong class="text-warning">2019-09-17 20:53:21</strong></td></tr>
          <tr><td>成功时间：</td><td><strong class="text-danger">1970-01-01 08:00:00</strong></td></tr>
          <tr><td>交易通道：</td><td>支付宝扫码</td></tr>
          <tr><td>交易银行：</td><td>聚合支付</td></tr>
         <tr><td>提交地址：</td><td>http://kehu.erinqak.cn/demo/index1.php</td></tr>
          <tr><td>页面返回地址：</td><td>http://kehu.erinqak.cn/demo/page.php</td></tr>
          <tr><td>服务器通知地址：</td><td>http://kehu.erinqak.cn/demo/server.php</td></tr>
          <tr><td>订单描述：</td><td>测试商品</td></tr>          <tr><td>状态：</td><td>
            <strong class="text-danger">未处理</strong>          </td></tr>
        </table>
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
layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element'], function() {
        var laydate = layui.laydate //日期
            , laypage = layui.laypage //分页
            ,layer = layui.layer //弹层
            , table = layui.table; //表格
    });
</script>
</body>
</html>