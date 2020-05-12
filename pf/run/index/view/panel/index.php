<?php
use xh\library\url;
use xh\unity\cog;
use xh\library\model;
$fix = DB_PREFIX;
$nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
$zrTime = strtotime(date("Y-m-d",$nowTime-86400) . ' 00:00:00'); //昨日的时间
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>管理中心</title>
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
      .no-margins{line-height:6px}
    </style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated">

<div class="row">
  <div class="col-md-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>用户名：<?php echo $_SESSION['MEMBER']['username'];?></h5><h5>&nbsp;&nbsp;商户ID：<?php echo $_SESSION['MEMBER']['uid'];?></h5><h5>&nbsp;&nbsp;所属用户组：<?php echo $_SESSION['MEMBER']['group']['name'];?></h5>
      </div>

      <div class="ibox-content">
        <p>商户KEY： <?php echo $_SESSION['MEMBER']['key_id'];?>，接口余额：<?php echo $_SESSION['MEMBER']['balance'];?> </p>
              </div>
    </div>
  </div>
</div>
 <div class="row zuy-nav">
<div class="col-sm-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>今日订单统计</h5>
      </div>
      <div class="ibox-content" style="height: 600px">

       
          <h1 class="no-margins">淘宝代付订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_taobaodf_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">微信固码订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechat_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
          <h1 class="no-margins">微信赞赏订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechatzs_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
          <h1 class="no-margins">话费订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_huafei_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        
          <h1 class="no-margins">微信转手机订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechatphone_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">微信店员订单数：
                              <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechatdy_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">微信商家订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechatsj_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">支付宝固码订单数：
                            <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_alipaygm_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">支付宝转账订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_alipay_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">微信转卡订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_bank_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">拼多多商家订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_pddgm_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">农信易扫订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_nxys_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">云闪付订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_yunshanfu_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">拉卡拉订单数：
                            <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_lakala_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
          <h1 class="no-margins">收钱吧订单数：
                            <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_shouqianba_automatic_orders where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">服务版订单数：
                            <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}service_order where creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        

      </div>
    </div>
  </div>
   
   <div class="col-sm-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>昨日订单统计</h5>
      </div>
      <div class="ibox-content" style="height: 600px">
      
        
          <h1 class="no-margins">淘宝代付订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_taobaodf_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}");
                               ?> <?php  echo $order[0]['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order[0]['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">微信固码订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechat_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">微信赞赏订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechatzs_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">话费订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_huafei_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">微信转手机订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechatphone_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">微信店员订单数：
                              <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechatdy_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">微信商家订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechatsj_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">支付宝固码订单数：
                            <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_alipaygm_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">支付宝转账订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_alipay_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">微信转卡订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_bank_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">拼多多商家订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_pddgm_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">农信易扫订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_nxys_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">云闪付订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_yunshanfu_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">拉卡拉订单数：
                            <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_lakala_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
          <h1 class="no-margins">收钱吧订单数：
                            <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_shouqianba_automatic_orders where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">服务版订单数：
                            <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}service_order where creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
      </div>
    </div>
  </div>
   
   <div class="col-sm-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>总订单统计</h5>
      </div>
      <div class="ibox-content" style="height: 600px">
      
        
          <h1 class="no-margins">淘宝代付订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_taobaodf_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">微信固码订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechat_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">微信赞赏订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechatzs_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">话费订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_huafei_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">微信赞赏订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechatzs_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">微信店员订单数：
                              <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechatdy_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">微信商家订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_wechatsj_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">支付宝固码订单数：
                            <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_alipaygm_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">支付宝转账订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_alipay_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">微信转卡订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_bank_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">拼多多商家订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_pddgm_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">农信易扫订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_nxys_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
        <h1 class="no-margins">云闪付订单数：
                             <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_yunshanfu_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">拉卡拉订单数：
                            <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_lakala_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
          <h1 class="no-margins">收钱吧订单数：
                            <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_shouqianba_automatic_orders where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        
         <h1 class="no-margins">服务版订单数：
                            <span style="color:blue;font-weight:bold;">
                               <?php
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                               $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}service_order where status=4 and user_id={$_SESSION['MEMBER']['uid']}")[0];
                                ?> <?php  echo $order['count']; ?> 单</span>，
                                 <span style="color:red;font-weight:bold;">
                                  <?php  echo number_format($order['money'],3); ?> 元</span>
        </h1>
        

      </div>
    </div>
  </div>
   
    <div class="col-sm-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>提现统计</h5>
      </div>
      <div class="ibox-content" style="height: 120px">

                      <?php //查询全部提现 
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_withdraw where user_id={$_SESSION['MEMBER']['uid']} and types=2");
                      
                      
                        ?>
        <h1 class="no-margins">总提现金额：<?php echo '<span style="color:blue;font-weight:bold;"> '.floatval($order[0]['money']) .' </span>' ?> 元</h1>
         <h1 class="no-margins">总提现笔数：<?php echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['count']) .' </span>' ?> 个</h1>
        
        <button class="layui-btn layui-btn-small" style="float:right" onclick="order_view('提现','/index/member/withdraw',880,500)">申请提现</button>


      </div>
    </div>
  </div>
    
 
 </div>
     

<div class="row">
  <div class="col-md-12">
    <div class="ibox float-e-margins">

        <div class="ibox-title">
          <h5>我的提现（最新5条）</h5>
        </div>
      
       
           <table class="layui-table" >
          <thead>
          <tr>
            <th lay-data="{field:'out_trade_id', width:240,style:'color:#060;'}">提现金额</th>
            <th lay-data="{field:'out_trade_id', width:240,style:'color:#060;'}">流水单号</th>
            <th lay-data="{field:'memberid', width:140}">提现时间</th>
            <th lay-data="{field:'amount', width:180,style:'color:#060;'}">订单信息</th>
            <th lay-data="{field:'rate', width:120}">提现状态</th>
            <th lay-data="{field:'actualamount', width:190,style:'color:#C00;'}">反馈</th>

          </tr>
          </thead>
          <tbody>
             <?php foreach ($withdrawal as $with){?>
          <tr>
             
              <td style="text-align:center; color:#090;"><?php echo $with['amount'];?> </td>
              <td style="text-align:center; color:#090;"><?php echo $with['flow_no'];?> </td>
              <td style="text-align:center;"> <?php echo date("Y/m/d H:i:s",$with['apply_time']);?> </td>
              <td style="text-align:center; color:#060"><?php echo $with['deal_time'] == 0 ? '处理中' : date("Y/m/d H:i:s",$with['deal_time']);?></td>
              <td style="text-align:center; color:#666"><?php
                                if ($with['types'] == 1) echo '<span style="color:#039be5;">正在处理</span>';
                                if ($with['types'] == 2) echo '<span style="color:green;">已经到账</span>';
                                if ($with['types'] == 3) echo '<span style="color:#bdbdbd;">驳回</span>';
                                if ($with['types'] == 4) echo '<span style="color:red;">流水异常</span>';
                                ?></td>

             <td style="text-align:center; color:#666"><?php echo $with['content'];?></td>

             
           
            </tr>
             <?php }?>
          </tbody>
        </table>
    
          
      </div>
    </div>
  </div>
    </div>
  </div>

  <!--<div class="row">
    <div class="col-md-12">
      <div class="ibox float-e-margins">
        
        <div class="ibox-title">
          <h5>日交易统计</h5>
        </div>
        <div class="ibox-content">
          <div id="main" style="height:300px"></div>
        </div>
        
      </div>
    </div>
  </div> -->

<!-- 全局js -->
<script src="/Public/Front/js/echarts.common.min.js"></script>

<script src="/Public/Front/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/Public/Front/js/content.js"></script>
<script src="/Public/Front/js/plugins/layui/layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/x-layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/Util.js" charset="utf-8"></script>
<script type="text/javascript">

     layui.use(['laydate', 'laypage', 'layer', 'table', 'form'], function() {
        var laydate = layui.laydate //日期
            , laypage = layui.laypage //分页
            ,layer = layui.layer //弹层
            ,form = layui.form //表单
            , table = layui.table; //表格
        //日期时间范围
        laydate.render({
            elem: '#createtime'
            , type: 'datetime'
            ,theme: 'molv'
            , range: '|'
        });
        //日期时间范围
        laydate.render({
            elem: '#successtime'
            , type: 'datetime'
            ,theme: 'molv'
            , range: '|'
        });
    });
    /*订单-查看*/
    function order_view(title,url,w,h){
        x_admin_show(title,url,w,h);
    }
    /*订单-删除*/
    function order_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                url:"/agent_Order_delOrder.html",
                type:'post',
                data:'id='+id,
                success:function(res){
                    if(res.status){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    }
                }
            });
        });
    }
    $('#export').on('click',function(){
        window.location.href
            ="/agent_Order_exportorder_status_2.html";
    });
    $('#pageList').change(function(){
        $('#pageForm').submit();
    });
</script>
</body>
</html>