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
                <h5>0.03 为 3%</h5>
            </div>
            <div class="ibox-content">
                <!--用户信息-->
               <form class="layui-form"  id="profile">
                  
                 
                    <div class="layui-form-item">
                        <label class="layui-form-label" style="width: auto;padding: 4px; margin-top: 5px;">微信固码：</label>
                        <div class="layui-input-block" style="margin-left: 0px;width: 30%;float: left;">
                            <input type="text" lay-verify="title" autocomplete="off"
                                  name="wechat_auto"  placeholder="请设置费率" class="layui-input" value="<?php echo $result['wechat_auto'];?>">
                        </div>
                      
                       <label class="layui-form-label" style="width: auto;padding: 4px; margin-top: 5px;margin-left: 30px;">微信店员：</label>
                        <div class="layui-input-block" style="margin-left: 0px;width: 30%;float: left;">
                            <input type="text" lay-verify="title" autocomplete="off"
                                  name="wechatdy_auto"  placeholder="请设置费率" class="layui-input" value="<?php echo $result['wechatdy_auto'];?>">
                        </div>
                      
                    </div>
                  
                  
                   <div class="layui-form-item">
                        <label class="layui-form-label" style="width: auto;padding: 4px; margin-top: 5px;">微信商户：</label>
                        <div class="layui-input-block" style="margin-left: 0px;width: 30%;float: left;">
                            <input type="text" lay-verify="title" autocomplete="off"
                                  name="wechatsj_auto"  placeholder="请设置费率" class="layui-input" value="<?php echo $result['wechatsj_auto'];?>">
                        </div>
                      
                       <label class="layui-form-label" style="width: auto;padding: 4px; margin-top: 5px;margin-left: 30px;">支付宝固码：</label>
                        <div class="layui-input-block" style="margin-left: 0px;width: 30%;float: left;">
                            <input type="text" lay-verify="title" autocomplete="off"
                                  name="alipaygm_auto"  placeholder="请设置费率" class="layui-input" value="<?php echo $result['alipaygm_auto'];?>">
                        </div>
                      
                    </div>
                  
                  
                   <div class="layui-form-item">
                        <label class="layui-form-label" style="width: auto;padding: 4px; margin-top: 5px;">支付宝转账：</label>
                        <div class="layui-input-block" style="margin-left: 0px;width: 30%;float: left;">
                            <input type="text" lay-verify="title" autocomplete="off"
                                  name="alipay_auto"  placeholder="被风控用不了" class="layui-input" value="<?php if($result['alipay_auto'] == ''){echo "被风控用不了";}?>">
                        </div>
                      
                       <label class="layui-form-label" style="width: auto;padding: 4px; margin-top: 5px;margin-left: 30px;">支付宝/微信转卡：</label>
                        <div class="layui-input-block" style="margin-left: 0px;width: 30%;float: left;">
                            <input type="text" lay-verify="title" autocomplete="off"
                                  name="bank_auto"  placeholder="请设置费率" class="layui-input" value="<?php echo $result['bank_auto'];?>">
                        </div>
                      
                    </div>
                  
                  
                   <div class="layui-form-item">
                        <label class="layui-form-label" style="width: auto;padding: 4px; margin-top: 5px;">云闪付：</label>
                        <div class="layui-input-block" style="margin-left: 0px;width: 30%;float: left;">
                            <input type="text" lay-verify="title" autocomplete="off"
                                  name="yunshanfu_auto"  placeholder="请设置费率" class="layui-input" value="<?php echo $result['yunshanfu_auto'];?>">
                        </div>
                      
                       <label class="layui-form-label" style="width: auto;padding: 4px; margin-top: 5px;margin-left: 30px;">拉卡拉：</label>
                        <div class="layui-input-block" style="margin-left: 0px;width: 30%;float: left;">
                            <input type="text" lay-verify="title" autocomplete="off"
                                  name="lakala_auto"  placeholder="请设置费率" class="layui-input" value="<?php echo $result['lakala_auto'];?>">
                        </div>
                      
                    </div>
                  
                  
                   <div class="layui-form-item">
                        <label class="layui-form-label" style="width: auto;padding: 4px; margin-top: 5px;">农信易扫：</label>
                        <div class="layui-input-block" style="margin-left: 0px;width: 30%;float: left;">
                            <input type="text" lay-verify="title" autocomplete="off"
                                  name="nxyswx_auto"  placeholder="请设置费率" class="layui-input" value="<?php echo $result['nxyswx_auto'];?>">
                        </div>
                      
                       <label class="layui-form-label" style="width: auto;padding: 4px; margin-top: 5px;margin-left: 30px;">淘宝代付：</label>
                        <div class="layui-input-block" style="margin-left: 0px;width: 30%;float: left;">
                            <input type="text" lay-verify="title" autocomplete="off"
                                  name="taobaodf_auto"  placeholder="请设置费率" class="layui-input" value="<?php echo $result['taobaodf_auto'];?>">
                        </div>
                      
                    </div>
                  
                  
                   <div class="layui-form-item">
                        <label class="layui-form-label" style="width: auto;padding: 4px; margin-top: 5px;">收钱吧：</label>
                        <div class="layui-input-block" style="margin-left: 0px;width: 30%;float: left;">
                            <input type="text" lay-verify="title" autocomplete="off"
                                  name="shouqianba_auto"  placeholder="请设置费率" class="layui-input" value="<?php echo $result['shouqianba_auto'];?>">
                        </div>
                      
                       <label class="layui-form-label" style="width: auto;padding: 4px; margin-top: 5px;margin-left: 30px;">拼多多固码：</label>
                        <div class="layui-input-block" style="margin-left: 0px;width: 30%;float: left;">
                            <input type="text" lay-verify="title" autocomplete="off"
                                  name="pddgm_auto"  placeholder="请设置费率" class="layui-input" value="<?php echo $result['pddgm_auto'];?>">
                        </div>
                      
                    </div>
                  
              
                <input type="hidden" name="type" value="edit">
                   <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">

                   
                   

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                          <button class="layui-btn" lay-submit="" lay-filter="profile">确定</button>
                           
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
            url:"/agent/panel/feilv.do",
            type:"post",
            data:$('#profile').serialize(),
            success:function(res){
                if(res.code == '200'){
                    layer.alert(res.msg, {icon: 1},function () {
                      layer.closeAll();
                    });
                }else{
                    layer.alert(res.msg ? res.msg :"操作失败", {icon: 6},function () {
                     layer.closeAll();
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