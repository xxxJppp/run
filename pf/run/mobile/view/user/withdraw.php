<?php
use xh\library\url;
use xh\library\model;
$fix = DB_PREFIX;
?>
	
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = 0">
	
<title>提现记录</title>

<link href="/static/Theme/css/base.css" rel="stylesheet">

<link href="/static/Theme/css/funding.css" rel="stylesheet">
</head>

<body>
<header class="header">
	<div class="header-return">
	    <a href="javascript:history.go(-1);"></a>
	</div>
	
	<div class="logo">提现记录</div>
</header>

<section class="container">
	<div class="digital-balance">
<style>
  
  .record-list-content span{text-align:left}
      </style>

	
	<!--<div class="no-content">
		<i></i>
		<p>暂无内容</p>
	</div>-->
	<div class="vpay-account">
		<div class="vpay-account-balance">
            <span>余额</span>
            
            <h1><?php echo $_SESSION['MEMBER']['balance'];?></h1>
        </div>
        
        <div class="vpay-account-details">
            <ul>
                <li>
                
                    <a href="#">
                        <span>总提现金额</span>
                      <?php 
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}withdraw where user_id={$_SESSION['MEMBER']['uid']} and types=2 and catalog=3");
                        ?>
                        <h3><?php echo floatval($order[0]['money']); ?></h3>
                    </a>
                </li>
                
                <li>
                    <a href="#">
                        <span>总提现笔数</span>
                        <h3><?php echo floatval($order[0]['count']); ?></h3>
                    </a>
                </li>
            </ul>
        </div>
	</div>
	<div class="record-list">
	    <div class="record-list-title">
			<span>金额</span>
			<span>银行状态</span>
			<span>提现时间</span>
		</div>
		 <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="4" style="text-align: center;">暂时没有查询到您的提现记录!</td></tr>';?>
                    
                    <?php foreach ($result['result'] as $ru){?>
      
		<div class="record-list-content">
			<span><b class="record-red"><?php echo $ru['amount'];?> 元</b>
             <br>手续费用：<b style="color:red;"><?php echo $ru['fees'];?> 元</b>
           <br>   实际到款 : <?php echo $ru['amount']-$ru['fees'];?> 元
          </span>
			<span><?php echo $ru['content'];?> </br>
          <?php 
                        if ($ru['types'] == 1) echo '<span style="color:#039be5;">正在处理..</span>';
                        if ($ru['types'] == 2) echo '<span style="color:green;">已经到账</span>';
                        if ($ru['types'] == 3) echo '<span style="color:#bdbdbd;">银行驳回</span>';
                        if ($ru['types'] == 4) echo '<span style="color:red;">流水异常</span>';
          ?></br><?php if ($ru['status'] == 4) echo ' (' . date("Y/m/d H:i:s",$ru['pay_time']) . ')';?>
          </span>
			<span>提交时间：<?php echo date("Y/m/d H:i:s",$ru['apply_time']);?>
              </br>  处理时间：<?php if ($ru['deal_time'] != 0) {echo date("Y/m/d H:i:s",$ru['deal_time']);}else {echo '银行处理中';}?>
      </span>
		</div>
		
		 <?php }?>

		<!--<div class="load-no-more">
			<span>没有更多了</span>
		</div>-->
	</div>
    <div class="clr"></div>
      <link rel="stylesheet" href="/Public/Front/js/plugins/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/Public/Front/iconfont/iconfont.css"/>
 <div class="page">
          <div  class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-0">     
          <?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 6); ?>
        </div> 
      </div>
<div class="clr"></div>
</section>
</body>
</html>
