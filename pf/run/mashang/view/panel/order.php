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
    </style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated">
<div class="row">
  <div class="col-md-12">
    <div class="ibox float-e-margins">
      <!--条件查询-->
      <div class="ibox-title">
        <h5>订单管理</h5>
        <div class="ibox-tools">
          <i class="layui-icon" onclick="location.replace(location.href);" title="刷新"
             style="cursor:pointer;">ဂ</i>
        </div>
      </div>
      <!--条件查询-->
      <div class="ibox-content">
        <form class="layui-form" action="" method="get" autocomplete="off" id="orderform">
          <input type="hidden" name="sorting" value="trade_no">
        
          <div class="layui-form-item">
            <div class="layui-inline">
              <div class="layui-input-inline">
                <input type="text" name="code" autocomplete="off" placeholder="请输入订单号"
                       class="layui-input" value="<?php if(!empty($_GET['code'])){  echo $_GET['code']; }?>">
              </div>
              
              <div class="layui-input-inline" style="width:300px">
                <input type="date" class="layui-input" name="start_time" 
                       placeholder="创建起始时间" value="<?php if(!empty($_GET['start_time'])){  echo $_GET['start_time']; }  ?>">
              </div>
              <div class="layui-input-inline" style="width:300px">
                <input type="date" class="layui-input" name="end_time" 
                       placeholder="完成起始时间" value="<?php if(!empty($_GET['end_time'])){  echo $_GET['end_time']; } ?>">
              </div>
            </div>
           
            </div>

            <div class="layui-inline">
              <button type="submit" class="layui-btn"><span
                      class="glyphicon glyphicon-search"></span> 搜索
              </button>
             
            </div>
          </div>
        </form>
        
                        <!--交易列表-->
        <table class="layui-table" lay-data="{width:'100%',limit:15,id:'userData'}">
          <thead>
          <tr>
            <th lay-data="{field:'key',width:90}">序号</th>
            <th lay-data="{field:'ddlx', width:90}">类型</th>
            <th lay-data="{field:'out_trade_id', width:240,style:'color:#060;'}">系统订单号</th>
             <th lay-data="{field:'trade_id', width:240,style:'color:#060;'}">外部订单号</th>
             <th lay-data="{field:'timetrade_id', width:240,style:'color:#060;'}">创建时间</th>
            <th lay-data="{field:'amount', width:100,style:'color:#060;'}">交易金额</th>
            <th lay-data="{field:'rate', width:90}">接口费用</th>
            <th lay-data="{field:'applydate', width:160}">异步通知时间</th>
            <th lay-data="{field:'successdate', width:160}">异步通知状态</th>
            <th lay-data="{field:'successdate', width:160}">接口返回信息</th>
            <th lay-data="{field:'status', width:110}">支付状态</th>
           
          </tr>
          </thead>
          <tbody>
               <?php foreach ($result['result'] as $ru) { ?>
          <tr>
              <td><?php echo $ru['id']; ?></td>
              <td><?php if($ru['type'] == 1){  echo '支付宝';}else if($ru['type'] == 2){echo '微信';} else { echo '其他';} ?></td>
              <td style="text-align:center; color:#090;"><?php echo $ru['trade_no']; ?></td>
             <td style="text-align:center; color:#090;"><?php echo $ru['out_trade_no']; ?></td>
            <td style="text-align:center; color:#090;"> <?php echo date('Y/m/d H:i:s', $ru['creation_time']); ?></td>
              <td style="text-align:center; color:#060"><?php echo $ru['amount']; ?></td>
              <td style="text-align:center; color:#666"><?php echo $ru['callback_status'] == 1 ? $ru['pankou_fees'] : '暂无信息'; ?></td>
              <td style="text-align:center;"><?php echo $ru['callback_time'] != 0 ? date('Y/m/d H:i:s', $ru['callback_time']) : '无信息'; ?></td>
              <td style="text-align:center;"> <?php echo $ru['callback_status'] == 1 ? '<span style="color:green;">已回调</span>' : '<span style="color:red;">未回调</span>'; ?></td>
             <td style="text-align:center;"> <?php echo $ru['callback_status'] == 1 ? htmlspecialchars($ru['callback_content']) : '未回调'; ?></td>

              <td style="text-align:center; color:#369"><?php
                                        if ($ru['status'] == 1) echo '<span style="color:#039be5;">任务下发中..</span>';
                                        if ($ru['status'] == 2) echo '<span style="color:red;">未支付</span>';
                                        if ($ru['status'] == 3) echo '<span style="color:#bdbdbd;">订单超时</span>';
                                        if ($ru['status'] == 4) echo '<span style="color:green;"><b>已支付</b></span>';
                                        ?></td>
            
            </tr>
           <?php } ?>
          </tbody>
        </table>
        <!--交易列表-->
        <div class="page">
          <div  class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-0">  
      <!--    <span class="layui-laypage-curr current"><em class="layui-laypage-em"></em><em>1</em></span>
            <a class="num" href="/agent_Order_index.html?p=2">2</a><
            a class="num" href="/agent_Order_index.html?p=3">3</a>
            <a class="next layui-laypage-next" href="/agent_Order_index.html?p=2">下一页</a> </div>       -->      
          <?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 10); ?>
        </div> 
      </div>
    </div>
  </div>
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
            ="/agent_Order_exportorder_status_0.html";
    });
    $('#pageList').change(function(){
        $('#pageForm').submit();
    });
</script>
</body>
</html>