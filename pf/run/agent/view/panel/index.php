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
        <h5>用户名：<?php echo $_SESSION['MEMBER']['username'];?></h5><h5>&nbsp;&nbsp;商户ID：<?php echo $_SESSION['MEMBER']['uid'];?></h5><h5>&nbsp;返点：
              <?php
              echo $_SESSION['MEMBER']['group']['name'];
              ?>%</h5>
      </div>

<!--      <div class="ibox-content">-->
<!--        <p>商户KEY： --><?php //echo $_SESSION['MEMBER']['key_id'];?><!--，余额：--><?php //echo $_SESSION['MEMBER']['balance'];?><!--</p><br>推荐链接：--><?php //echo URL_ROOT; ?><!--/index/user/register.do?username=--><?php //echo $_SESSION['MEMBER']['username'];?><!-- (通过这个链接注册会成为您的下级)-->
<!--              </div>-->
    </div>
  </div>
</div>
 <div class="row zuy-nav">
<div class="col-sm-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>今日获利统计</h5>
      </div>
      <div class="ibox-content" style="height: 120px">
         <?php //查询今日收入 
                        $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                       
                        $order = $mysql->select("select sum(huoli) as money,count(id) as count,sum(amount) as amount from {$fix}agent_huoli_log where agent_id = {$_SESSION['MEMBER']['uid']} and time > {$nowTime}  ");
                       
                        ?>
      
        <h1 class="no-margins">今日总订单数：<?php echo '<span style="color:blue;font-weight:bold;"> '.floatval($order[0]['count']) .' </span>' ?> 单</h1>
         <h1 class="no-margins">今日总获利：<?php echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span>' ?> 元</h1>
         <h1 class="no-margins">今日总交易额：<?php echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['amount']) .' </span>' ?> 元</h1>

      </div>
    </div>
  </div>
   
   <div class="col-sm-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>昨日获利统计</h5>
      </div>
      <div class="ibox-content" style="height: 120px">
         <?php 
                        $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                        $zrTime = strtotime(date("Y-m-d",$nowTime-86400) . ' 00:00:00'); //昨日的时间
                       
                        $order = $mysql->select("select sum(huoli) as money,count(id) as count,sum(amount) as amount from {$fix}agent_huoli_log where agent_id = {$_SESSION['MEMBER']['uid']} and time > {$zrTime} and time<{$nowTime}");
                      
                        ?>
        <h1 class="no-margins">昨日总订单数：<?php echo '<span style="color:blue;font-weight:bold;"> '.floatval($order[0]['count']) .' </span>' ?> 单</h1>
         <h1 class="no-margins">昨日总获利：<?php echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span>' ?> 元</h1>
         <h1 class="no-margins">昨日总交易额：<?php echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['amount']) .' </span>' ?> 元</h1>

      </div>
    </div>
  </div>
   
   <div class="col-sm-3">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5>总获利统计</h5>
      </div>
      <div class="ibox-content" style="height: 120px">
         <?php //查询今日收入 
                        $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                       
                        $order = $mysql->select("select sum(huoli) as money,count(id) as count,sum(amount) as amount from {$fix}agent_huoli_log where agent_id = {$_SESSION['MEMBER']['uid']} ");
                      
                        ?>
        <h1 class="no-margins">总订单数：<?php echo '<span style="color:blue;font-weight:bold;"> '.floatval($order[0]['count']) .' </span>' ?> 单</h1>
         <h1 class="no-margins">总获利：<?php echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span>' ?> 元</h1>
         <h1 class="no-margins">总交易额：<?php echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['amount']) .' </span>' ?> 元  </h1>
         

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
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_agentwithdraw where user_id={$_SESSION['MEMBER']['uid']} and types=2");
                      
                      
                        ?>
        <h1 class="no-margins">总提现金额：<?php echo '<span style="color:blue;font-weight:bold;"> '.floatval($order[0]['money']) .' </span>' ?> 元</h1>
         <h1 class="no-margins">总提现笔数：<?php echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['count']) .' </span>' ?> 个</h1>
        
        <button class="layui-btn layui-btn-small" style="float:right" onclick="order_view('提现','/agent/member/withdraw',980,650)">申请提现</button>


      </div>
    </div>
  </div>
    
 
 </div>
     

<div class="row">
  <div class="col-md-12">
    <div class="ibox float-e-margins">

        <div class="ibox-title">
          <h5>获利列表（最新10条）</h5>
<!--            <button class="layui-btn layui-btn-small" style="margin-left: 20px" onclick="rebate_day('提现','/agent/member/withdraw',980,650)">当日佣金结算</button>-->
        </div>
      
       
           <table class="layui-table" >
          <thead>
          <tr>
            <th lay-data="{field:'key',width:90}">用户ID</th>
            <th lay-data="{field:'out_trade_id', width:240,style:'color:#060;'}">支付类型</th>
            <th lay-data="{field:'out_trade_id', width:240,style:'color:#060;'}">订单号</th>
            <th lay-data="{field:'memberid', width:140}">订单金额</th>
            <th lay-data="{field:'amount', width:180,style:'color:#060;'}">订单获利</th>
            <th lay-data="{field:'rate', width:120}">最终余额</th>
            <th lay-data="{field:'actualamount', width:190,style:'color:#C00;'}">时间</th>

          </tr>
          </thead>
          <tbody>
             <?php  foreach ($member['result'] as $em){?>
          <tr>

              <td style="text-align:center; color:#090;"><?php echo $em['uid'];?> </td>
              <td style="text-align:center; color:#090;"><?php echo $em['type'];?> </td>
              <td style="text-align:center;"> <?php echo $em['trade_no'];?>  </td>
              <td style="text-align:center; color:#060"><?php echo $em['amount'];?> </td>
              <td style="text-align:center; color:#666"><?php echo $em['huoli'];?></td>

             <td style="text-align:center; color:#666"><?php echo $em['daili_balance'];?></td>
              <td style="text-align:center;"><?php echo date("Y/m/d H:i:s",$em['time']);?></td>


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
<script src="/Public/Front/js/jquery.min.js"></script>

<script src="/Public/Front/js/plugins/layui/layui.js" charset="utf-8"></script>
<script src="/Public/Front/js/x-layui.js" charset="utf-8"></script>
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

    function rebate_day() {
        layer.confirm('确认要结算当日佣金吗？', function (index) {
            $.ajax({
                url:"/agent/panel/rebateSettlement.do",
                type:'get',
                success:function(res){
                    if(res.code == 200){
                        layer.msg(res.msg,{
                            icon:1,
                            time:2000,
                            end:function () {
                                location.reload();
                            }
                        });
                    }
                }
            });
        });
    }
</script>
</body>
</html>