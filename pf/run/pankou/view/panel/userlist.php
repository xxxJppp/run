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
        <h5>用户列表</h5>
        <div class="ibox-tools">
          <i class="layui-icon" onclick="location.replace(location.href);" title="刷新"
             style="cursor:pointer;">ဂ</i>
        </div>
      </div>
     
        <table class="layui-table" lay-data="{width:'100%',limit:15,id:'userData'}">
          <thead>
          <tr>
            <th lay-data="{field:'key',width:90}">ID</th>
            <th lay-data="{field:'out_trade_id', width:240,style:'color:#060;'}">用户名</th>
            <th lay-data="{field:'memberid', width:140}">用户组</th>
            <th lay-data="{field:'amount', width:180,style:'color:#060;'}">手机号</th>
            <th lay-data="{field:'rate', width:120}">余额</th>
            <th lay-data="{field:'actualamount', width:190,style:'color:#C00;'}">上次登录时间</th>
           
            <th lay-data="{field:'op',width:330}">操作</th>
          </tr>
          </thead>
          <tbody>
             <?php  foreach ($member['result'] as $em){?>
          <tr>
              <td><?php echo $em['id'];?> </td>
             
              <td style="text-align:center; color:#090;"><?php echo $em['username'];?>                           </td>
              <td style="text-align:center;"><?php $group = $mysql->query("client_group","id={$em['group_id']}")[0]; echo is_array($group) ? '<span style="color:orange;"><b>'.$group['name'].'</b></span>' : '<span style="color:red;">未分配</span>'; ?> </td>
              <td style="text-align:center; color:#060"><?php echo $em['phone'];?> </td>
              <td style="text-align:center; color:#666"><?php echo $em['balance'];?></td>
              <td style="text-align:center;"><?php echo date("Y/m/d H:i:s",$em['login_time']);?></td>
             
              <td>
                <button class="layui-btn layui-btn-small" onclick="order_view('<?php echo $em['username'];?>->余额操作','/agent/panel/moneyedit.do?id=<?php echo $em['id'];?>',780,630)">余额操作</button>
                 <button class="layui-btn layui-btn-small" onclick="order_view('<?php echo $em['username'];?>->修改密码','/agent/panel/passwordedit.do?id=<?php echo $em['id'];?>',780,630)">修改密码</button>
                 <button class="layui-btn layui-btn-small" onclick="order_view('<?php echo $em['username'];?>->费率设置','/agent/panel/feilv.do?id=<?php echo $em['id'];?>',780,630)">费率设置</button>

              </td>
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