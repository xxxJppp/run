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
  <div class="row">
    <div class="col-sm-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>操作记录</h5>
        </div>
        <div class="ibox-content"><br>
               <table class="layui-table" lay-skin="line">
                   <thead>
                   <tr>
                       <th>操作人</th>
                       <th>用户id/用户名</th>
                       <th>说明</th>
                       <th>操作时间</th>
                       <th>操作ip</th>
                   </tr>
                   </thead>
                   <tbody>
                      <?php  foreach ($member['result'] as $em){?>
                   <tr>
                       <td><?php echo $em['agent_id'];?></td>
                       <td>用户ID：<?php echo $em['user_id'];?>/用户名：(<?php echo $em['username'];?>)</td>
                       <td><?php echo $em['info'];?></td>
                       <td><?php echo date("Y/m/d H:i:s",$em['addtime']);?></td>
                      <td><?php echo $em['ip'];?>【<a target="_blank" href="http://www.ip138.com/ips138.asp?ip=<?php echo $em['ip'];?>&action=2">查询IP</a>】</td>
                   </tr>
                  <?php }?>
                 </tbody>
               </table>
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
    $('#pageList').change(function(){
        $('#pageForm').submit();
    });
</script>
</body>
</html>