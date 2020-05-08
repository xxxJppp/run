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
            <div class="ibox-title">
                <h5>修改密码</h5>
            </div>
            <div class="ibox-content">
                <!--用户信息-->
                <form class="layui-form" id="profile">
                    <input type="hidden" name="id" value="<?php echo $result['id'];?>">
                   <input type="hidden" name="username" value="<?php echo $result['username'];?>">
                  
                    <div class="layui-form-item">
                        <label class="layui-form-label">用户名：</label>
                        <div class="layui-input-block">
                           <?php echo $result['username'];?>
                        </div>
                    </div>
                  
                   <div class="layui-form-item">
                        <label class="layui-form-label">余额：</label>
                        <div class="layui-input-block">
                           <?php echo $result['balance'];?>
                        </div>
                    </div>
                  
                    <div class="layui-form-item">
                        <label class="layui-form-label">操作金额：</label>
                        <div class="layui-input-block">
                            <input type="text" lay-verify="title" autocomplete="off"
                                  name="money"  placeholder="增加金额直接输入正数，减金额输入负数" class="layui-input" value="">
                          <p style="margin-top:10px;color:red">注意：增加金额直接输入正数，减金额输入负数 比如：增加100元  输入100 ， 扣100 输入 -100</p>
                        </div>
                    </div>
                   

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                          <button class="layui-btn" lay-submit=""  lay-filter="profile" >确定</button>
                           
                        </div>
                    </div>
              </form>
                <!--用户信息-->
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
  
    layui.use(['laydate', 'laypage', 'layer', 'form', 'element'], function() {
        var laydate = layui.laydate //日期
            ,layer = layui.layer //弹层
            ,form = layui.form //弹层
            , element = layui.element; //元素操作
        //日期
        laydate.render({
            elem: '#date'
        });
        //监听提交
      
       form.on('submit(profile)', function(data){
            $.ajax({
            url:"/agent/panel/moneyeditResult.do",
            type:"post",
            data:$('#profile').serialize(),
            success:function(res){
                if(res.code == '200'){
                    layer.alert(res.msg, {icon: 1},function () {
                        parent.location.reload();
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                    });
                }else{
                    layer.alert(res.msg ? res.msg :"操作失败", {icon: 6},function () {
                        
                       
                    });
                }
            }
        });
            return false;
        });
    });
  
  
</script>

</body>
</html>