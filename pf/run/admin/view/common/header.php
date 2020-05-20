<?php

use xh\library\mysql;
use xh\library\url;

$mysql = new mysql();
//菜单加载
$menu = $mysql->query("mgt_menu", "hide=1");
$view_module = $_SESSION['USER_MGT']['view_module'] != 0 ? explode(',', $_SESSION['USER_MGT']['view_module']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Kode is a Premium Bootstrap Admin Template, It's responsive, clean coded and mobile friendly">
    <meta name="keywords" content="bootstrap, admin, dashboard, flat admin template, responsive,"/>
    <title><?php echo WEB_NAME; ?> - 管理系统 v <?php echo SYSTEM_VERSION; ?></title>
    <link href="<?php echo URL_VIEW; ?>static/console/css/root.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/Public/Front/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Public/Front/css/style.css" rel="stylesheet">
    <link href="/Public/Front/css/zuy.css" rel="stylesheet">
    <link rel="stylesheet" href="/Public/Front/js/plugins/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/Public/Front/iconfont/iconfont.css"/>
    <style>
        li {
            list-style: none;
        }
    </style>
</head>
<body>
<!-- Start Page Loading
  <div class="loading"><img src="<?php echo URL_VIEW; ?>/static/console/img/loading.gif" alt="loading-img"></div> -->
<!-- End Page Loading -->
<!-- START TOP -->

<script src="/Public/Front/js/jquery.min.js"></script>
<script src="/Public/Front/js/bootstrap.min.js"></script>
<script src="/Public/Front/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/static/js/layui/layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/x-layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/Util.js" charset="utf-8"></script>
<script>
    layui.use(['laydate', 'laypage', 'layer', 'table', 'form'], function () {
        var laydate = layui.laydate //日期
            , laypage = layui.laypage //分页
            , layer = layui.layer //弹层
            , form = layui.form //表单
            , table = layui.table; //表格
        //日期时间范围
        laydate.render({
            elem: '#createtime'
            , type: 'datetime'
            , theme: 'molv'
            , range: '|'
        });
        //日期时间范围
        laydate.render({
            elem: '#successtime'
            , type: 'datetime'
            , theme: 'molv'
            , range: '|'
        });
    });
</script>