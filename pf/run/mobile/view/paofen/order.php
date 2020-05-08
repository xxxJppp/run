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
	
<title>收款账号列表</title>

<link href="/static/Theme/css/base.css" rel="stylesheet">
<link href="/static/Theme/css/trade.css" rel="stylesheet">
</head>

<body>
<header class="header">
	<div class="header-return">
	    <a href="/mobile/panel/index.do"></a>
	</div>
	
	<div class="logo">收款账号列表</div>
</header>

<section class="container tab-container">
   
    <div class="tab-content" style="margin-top: -36px;">
      <div style="font-size:16px">
      
       <span style="font-size: 15px;">[ <b>今日收入:</b> <?php //查询今日收入
                    $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');
                    $where_call = "creation_time > {$nowTime} and status=4 and " . $where;
                    $where_call = trim(trim($where_call), 'and');
                    $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_paofen_automatic_orders where {$where_call}");
                    echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 盈利: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  / 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '</span> ';
         ?>] </br>[ <b>昨日收入:</b> <?php
                    $zrTime = strtotime(date("Y-m-d", $nowTime - 86400) . ' 00:00:00'); //昨日的时间
                    $where_call = "creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and " . $where;
                    $where_call = trim(trim($where_call), 'and');


                    $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_paofen_automatic_orders where {$where_call}");
                    echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 盈利: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  / 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '</span> ';
                    ?> ] </br> [ <b>全部收入:</b> <?php
                    $where_call = "status=4 and " . $where;
                    $where_call = trim(trim($where_call), 'and');

                    $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_paofen_automatic_orders where {$where_call}");
                    echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 盈利: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  / 订单数量: <span style="color:green;font-weight:bold;">' . floatval($order[0]['count']) . '</span> ';
                    ?>
                    ]
  </br></br>  </span>

        <div>
            <!--<div class="no-content">
                <i></i>
                <p>暂无内容</p>
            </div>-->
             <?php foreach ($result['result'] as $ru){?>
            <div class="trade-order-list">
                <div class="trade-order-title"> 
                    <span class="fl">订单ID: <?php echo $ru['id']; ?></span>
                    <span class="trade-order-status fr"><?php if($ru['type'] == '1'){ echo "支付宝固码"; }else  if($ru['type'] == '2'){ echo "微信固码"; }else if($ru['type'] == '3'){ echo $ru['typename']; }else if($ru['type'] == '4'){ echo '支付宝转账模式'; }else if($ru['type'] == '5'){ echo '支付宝/微信转卡'; }else if($ru['type'] == '6'){ echo '微信店员'; }  ?></span>
                </div>
                
                <div class="trade-order-info">
                    
        
                        <div class="trade-order-content" style="padding: 10px;">
                          <h3>订单号码：<?php echo $ru['out_trade_no']; ?></h3>
                          <h3> 系统订单号码：<?php echo $ru['trade_no']; ?></h3>
                           <h3> 创建时间：<?php echo date('Y/m/d H:i:s', $ru['creation_time']); ?></h3>
                          
                            <h3> 支付金额：<span
                                                style="color: green;"><b><?php echo $ru['amount']; ?></b> <?php echo $ru['callback_status'] == 1 ? " ( 利: " . ($ru['amount'] - $ru['fees']) . " )" : ''; ?></span></h3>
                            <h3> 支付状态：<?php
                                        if ($ru['status'] == 1) echo '<span style="color:#039be5;">任务下发中..</span>';
                                        if ($ru['status'] == 2) echo '<span style="color:red;">未支付</span>';
                                        if ($ru['status'] == 3) echo '<span style="color:#bdbdbd;">订单超时</span>';
                                        if ($ru['status'] == 4) echo '<span style="color:green;"><b>已支付</b></span>';
                                        ?><?php if ($ru['status'] == 4) echo ' (' . date("Y/m/d H:i:s", $ru['pay_time']) . ')'; ?></h3>
                            <h3> 异步通知时间：<?php echo $ru['callback_time'] != 0 ? date('Y/m/d H:i:s', $ru['callback_time']) : '无信息'; ?></h3>
                            <h3> 异步通知状态：<?php echo $ru['callback_status'] == 1 ? '<span style="color:green;">已回调</span>' : '<span style="color:red;">未回调</span>'; ?></h3>
                          <h3> 单笔接口费用：<?php echo $ru['callback_status'] == 1 ? $ru['fees'] : '暂无信息'; ?></h3>
                          <h3> 接口返回信息：<span
                                                style="color:green;"><?php echo $ru['callback_status'] == 1 ? htmlspecialchars($ru['callback_content']) : '未回调'; ?> </span></h3>
 



                                    </td>
                        </div>
        
                       
            
                </div>
                
                <div class="trade-order-operate">
                    <ul>
                        <li>
                          
                   <?php if ($ru['callback_status'] == 1 ){ echo '<span style="color:red;">已回调</span>';}else{ ?>
                                      <a onclick="reissue('<?php echo $ru['id']; ?>');" style="font-size: 14px;color:#4caf50;"
                                           class="btn waves-effect waves-light indigo"><i
                                                    class="mdi-action-lock-open left" style="width: 10px;color:#4caf50;"></i>手动补发</a>
                                      <?php } ?>
                         
                      </li>
                    </ul>
                </div>
            </div>
            <div class="clr"></div>
            
           <?php }?>
           
        <div class="clr"></div>
      <link rel="stylesheet" href="/Public/Front/js/plugins/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/Public/Front/iconfont/iconfont.css"/>
 <div class="page">
          <div  class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-0">  
      <!--    <span class="layui-laypage-curr current"><em class="layui-laypage-em"></em><em>1</em></span>
            <a class="num" href="/agent_Order_index.html?p=2">2</a><
            a class="num" href="/agent_Order_index.html?p=3">3</a>
            <a class="next layui-laypage-next" href="/agent_Order_index.html?p=2">下一页</a> </div>       -->      
          <?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 6); ?>
        </div> 
      </div>
<div class="clr"></div>
          
        </div>
    </div>
</section>

<script src="/static/Theme/js/jquery-1.11.2.min.js"></script>
  <script src="/static/js/layer/layer.js" type="text/javascript"></script>

 <script type="text/javascript">

      function reissue(id){
          layer.confirm("手动补发也是需要扣除手续费,您是否要继续?", { title: "订单通知" }, function (index) {
			$.ajax({
		          type: "GET",
		          dataType: "json",
             
		          url: "<?php echo url::s('mobile/paofen/automaticReissue', "id=");?>" + id,
		          data: $('#from').serialize(),
		          success: function (data) {
                    
		              if(data.code == '200'){
                        
                        layer.msg(data.msg,{
                            icon: 1,
                            time:1000,
                            end:function () {
                           location.reload();
                            }
                        })

		              }else{
		            	  layer.msg(data.msg, {icon: 2});
		              }
		          },
		          error: function(data) {
		              alert("error:"+data.responseText);
		           }
		  })
        });
		}
   
  
   
	  </script>
</body>
</html>
