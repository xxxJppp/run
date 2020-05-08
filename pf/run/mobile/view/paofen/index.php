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
   
    <div class="tab-content" style="margin-top: -40px;">
        <div>
            <!--<div class="no-content">
                <i></i>
                <p>暂无内容</p>
            </div>-->
             <?php foreach ($result['result'] as $ru){?>
            <div class="trade-order-list">
                <div class="trade-order-title"> 
                    <span class="fl">备注: <?php echo $ru['name'];?></span>
                    <span class="trade-order-status fr"><?php if($ru['type'] == '1'){ echo "支付宝固码"; }else  if($ru['type'] == '2'){ echo "微信固码"; }else if($ru['type'] == '3'){ echo $ru['typename']; }else if($ru['type'] == '4'){ echo '支付宝转账模式'; }else if($ru['type'] == '5'){ echo '支付宝/微信转卡'; }else if($ru['type'] == '6'){ echo '微信店员'; }  ?></span>
                </div>
                
                <div class="trade-order-info">
                    
        
                        <div class="trade-order-content" style="padding: 10px;">
                            <h3>APP商户号: <?php echo $ru['app_user'] ;?>[ <span style="color:red" onclick="edit('<?php echo $ru['id'];?>');">修改</span> ]</h3><br>
                          <?php  if($ru['type'] == '4'){   ?>
                    <h3>  支付宝账号: <?php echo $ru['account'];?></h3><br>
                        <h3>   PID: <?php echo $ru['pid'] ;?></h3><br>
                          <?php } else if($ru['type'] == '5'){ ?>
                          <h3> 姓名：<?php echo $ru['gathering_name'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['gathering_name'].'</span>';?></h3><br>
                          <h3> 卡号：<?php echo $ru['account_no'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['account_no'].'</span>';?> </h3><br>
                          <h3>CARDID：<?php echo $ru['cardid'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['cardid'].'</span>';?>  </h3>   <br>             
                         <h3> 银行：<?php echo $ru['bank_id'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['bank_id'].'</span>';?>  </h3> <br>                
                                                             
                                                        <?php  } else  if($ru['type'] == '6'){ ?>
                           <h3>微信名称: <?php echo $ru['dy_name'];?>[ <span style="color:red" onclick="editdyname('<?php echo $ru['id'];?>');">修改</span> ]</h3><br>
                           <h3> 收款码链接: <?php echo $str=substr($ru['ewm_url'],0,32) . '...';?></h3>
                          
                          <?php }else { ?>
                          <br>
                           <h3> 收款码链接: <?php echo $str=substr($ru['ewm_url'],0,32) . '...';?></h3>
                          <br>
                          <?php } ?>
                          
                          <b>今日收入:</b> <?php //查询今日收入
                              $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                              $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}");
                              $today_order_all = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and creation_time > {$nowTime} and user_id={$_SESSION['MEMBER']['uid']}");
                              if($order[0]['count']!=0){
                                  $today_rate = round($order[0]['count']/ $today_order_all[0]['count']* 100,2).'%';
                              }else{
                                  $today_rate = '0%';
                              }
                              echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> 人民币 ( 成功/全部 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'/'.$today_order_all[0]['count'].'&nbsp;成功率&nbsp;'.$today_rate.'</span> )';
                              ?><br>
                              <b>昨日收入:</b> <?php
                              $zrTime = strtotime(date("Y-m-d",$nowTime-86400) . ' 00:00:00'); //昨日的时间

                              $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}");
                              $yesterday_order_all = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and creation_time > {$zrTime} and creation_time<{$nowTime} and user_id={$_SESSION['MEMBER']['uid']}");
                              if($order[0]['count']!=0){
                                  $yesterday_rate = round($order[0]['count']/ $yesterday_order_all[0]['count']* 100,2).'%';
                              }else{
                                  $yesterday_rate = '0%';
                              }
                              echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> 人民币 ( 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'/'.$yesterday_order_all[0]['count'].'&nbsp;成功率&nbsp;'.$yesterday_rate.'</span> )';
                              ?><br>
                              <b>全部收入:</b> <?php
                              $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and status=4 and user_id={$_SESSION['MEMBER']['uid']}");
                              echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> 人民币 ( 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'</span> )';
                              ?>
                        </div>
        
                       
            
                </div>
                
                <div class="trade-order-operate">
                    <ul>
                        <li>
                  
                          <?php echo $ru['training'] == 1 ? '<span style="color:#4caf50;"><a href="#" style="color:#006064;" onclick="startAutomaticRb('.$ru['id'].');">关闭轮训 </a></span>' : '<span style="color:red;"><a href="#" style="color:#e57373;" onclick="startAutomaticRb('.$ru['id'].');">启动轮训 </a></span>';?>
                          <?php echo $ru['receiving'] == 1 ? '<span style="color:#4caf50;"><a href="#" style="color:#006064;" onclick="startAutomaticGateway('.$ru['id'].');">停止网关 </a> </span>' : '<span style="color:red;"> <a href="#" style="color:#e57373;" onclick="startAutomaticGateway('.$ru['id'].');">启动网关 </a></span>';?>
                       <a href="#" style="color:red" onclick="del('<?php echo $ru['id'];?>');">删除</a>
                      </li>
                    </ul>
                </div>
            </div>
            <div class="clr"></div>
            
           <?php }?>
           
         
        
        <div>
          
        </div>
    </div>
      
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
</section>

<script src="/static/Theme/js/jquery-1.11.2.min.js"></script>
  <script src="/static/js/layer/layer.js" type="text/javascript"></script>

 <script type="text/javascript">

      function startAutomaticRb(id){
			$.ajax({
		          type: "GET",
		          dataType: "json",
		          url: "<?php echo url::s('mobile/paofen/startAutomaticRb',"id=");?>"+ id,
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
		  });
		}
   
    function startAutomaticGateway(id){
			$.ajax({
		          type: "GET",
		          dataType: "json",
		          url: "<?php echo url::s('mobile/paofen/startAutomaticGateway',"id=");?>"+ id,
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
		  });
		}
   


   function del(id){
       index = layer.prompt({
                        formType: 1,
                        title: '为了安全起见，请输入密码',
                        close: false,
                        btn: ['确定','取消']
                    }, function (value){
                        if(!value){
                            layer.msg('请输入密码', {icon: 5});
                            return false;
                        }
              
         $.ajax({
		          type: "GET",
		          dataType: "json",
		          url: "<?php echo url::s('mobile/paofen/automaticDelete',"id=");?>"+ id+ "&pwd="+value,
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
		  });
        
                    });
        };
   
    function edit(id){
       index = layer.prompt({
                        formType: 3,
                        title: '修改商户号',
                        close: false,
                        btn: ['确定','取消']
                    }, function (value){
                        if(!value){
                            layer.msg('请输入商户号', {icon: 5});
                            return false;
                        }
              
         $.ajax({
		          type: "GET",
		          dataType: "json",
		          url: "<?php echo url::s('mobile/paofen/automaticEditName',"id=");?>" + id + "&app_user=" +value,
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
		  });
        
                    });
        };
   
       function editdyname(id){
       index = layer.prompt({
                        formType: 3,
                        title: '店长微信名称 比如 (**张)',
                        close: false,
                        btn: ['确定','取消']
                    }, function (value){
                        if(!value){
                            layer.msg('店长微信名称 比如 (**张)', {icon: 5});
                            return false;
                        }
              
         $.ajax({
		          type: "GET",
		          dataType: "json",
		          url: "<?php echo url::s('mobile/paofen/editdyname',"id=");?>" + id + "&dyname=" +value,
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
		  });
        
                    });
        };
   
	  </script>
</body>
</html>
