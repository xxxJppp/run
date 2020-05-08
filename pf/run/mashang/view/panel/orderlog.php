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
        <h5>日志</h5>
        <div class="ibox-tools">
          <i class="layui-icon" onclick="location.replace(location.href);" title="刷新"
             style="cursor:pointer;">ဂ</i>
        </div>
      </div>
     
        <table class="layui-table" lay-data="{width:'100%',limit:15,id:'userData'}">
          <thead>
            <tr>
            <th lay-data="{field:'key',width:90}">用户ID</th>
            <th lay-data="{field:'out_trade_id', width:220,style:'color:#060;'}">订单号</th>
            <th lay-data="{field:'memberid', width:140}">冻结金额</th>
              <th lay-data="{field:'rate1', width:800}">备注</th>
            <th lay-data="{field:'actualamount', width:190,style:'color:#C00;'}">时间</th>
               <th lay-data="{field:'actualamount3', width:190,style:'color:#C00;'}">订单详情</th>

          </tr>
          </thead>
          <tbody>
             <?php  foreach ($member['result'] as $em){?>
          <tr>
             
              <td style="text-align:center; color:#090;"><?php echo $em['uid'];?> </td>
              <td style="text-align:center;"> <?php echo $em['trade_no'];?>  </td>
              <td style="text-align:center; color:#060"><?php echo $em['money'];?> 元</td>
             <td style="text-align:center; color:#666"><?php echo $em['remark'];?></td>
              <td style="text-align:center;"><?php echo date("Y/m/d H:i:s",$em['time']);?></td>
              <td style="text-align:center;"><a style="color:red" href="/mashang/paofen/automaticOrder.do?sorting=trade_no&code=<?php echo $em['trade_no'];?>" >查看订单</a></td>
           
            </tr>
             <?php }?>
          </tbody>
        </table>
       
        <!--交易列表-->
        <div class="page">
          <div  class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-0">  
      <!--    <span class="layui-laypage-curr current"><em class="layui-laypage-em"></em><em>1</em></span>
            <a class="num" href="/agent_Order_index.html?p=2">2</a><
            a class="num" href="/agent_Order_index.html?p=3">3</a>
            <a class="next layui-laypage-next" href="/agent_Order_index.html?p=2">下一页</a> </div>       -->      
          <?php (new model())->load('page', 'turn')->auto($member['info']['pageAll'], $member['info']['page'], 10); ?>
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
            ="/agent_Order_exportorder_status_2.html";
    });
    $('#pageList').change(function(){
        $('#pageForm').submit();
    });
</script>
</body>
</html>