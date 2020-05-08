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
                <form class="layui-form" action="<?php echo url::s('agent/panel/editResult');?>" autocomplete="off" id="profile1">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['MEMBER']['uid'];?>">
                   <input type="hidden" name="username" value="<?php echo $_SESSION['MEMBER']['username'];?>">
                     <input type="hidden" name="phone" value=" <?php echo $_SESSION['MEMBER']['phone'];?>">
                  
                 
                  
                    <div class="layui-form-item">
                        <label class="layui-form-label">用户名：</label>
                        <div class="layui-input-block">
                          <?php echo $_SESSION['MEMBER']['username'];?>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">新密码：</label>
                        <div class="layui-input-block">
                            <input type="text" lay-verify="title" autocomplete="off"
                                  name="pwd" id="pwd"  placeholder="登录的密码，不修改请留空" class="layui-input" value="">
                        </div>
                    </div>
                   

                     <div class="row" id="input-select">
                       
                       <div class="input-field col s6">
                       <label>银行卡</label>
                    <select name="bank_type" onchange="bank_show(this.value)">
                      <option value="" disabled selected>请选择一个提现方式</option>
                      <option value="1">支付宝</option>
                      <option value="2">银行卡</option>
                      <option value="3">暂不填写</option>
                    </select>
                  </div>
                      </div>
                      
                      <div class="row" style="display: none;" id="bank_a">
                         <div class="input-field col s3">
                          <input placeholder="真实姓名" name="alipay_name" type="text" class="validate">
                          <label>姓名</label>
                        </div>
                        <div class="input-field col s5">
                          <input placeholder="支付宝账号" name="alipay_content" type="text" class="validate">
                          <label>账号</label>
                        </div>
                      </div>
                      
                      <div class="row" style="display: none;" id="bank_b">
                         <div class="input-field col s3">
                          <input placeholder="真实姓名" name="bank_name" type="text" class="validate">
                          <label>姓名</label>
                        </div>
                        <div class="input-field col s3">
                          <input placeholder="银行" name="bank" type="text" class="validate" value="工商银行">
                          <label>银行名称</label>
                        </div>
                        <div class="input-field col s5">
                          <input placeholder="银行卡号" name="card" type="text" class="validate">
                          <label>银行卡号</label>
                        </div>
                      </div>
                  
                  
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                          <button class="layui-btn" lay-submit="" lay-filter="save">确定</button>
                           
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
<script>
     function bank_show(type){
		if(type == 1){
			$('#bank_a').show();
			$('#bank_b').hide();
		}
		if(type == 2){
			$('#bank_a').hide();
			$('#bank_b').show();
		}
		if(type == 3){
			$('#bank_a').hide();
			$('#bank_b').hide();
		}
      }
     
        //监听提交
        form.on('submit(save)', function(data){
            $.ajax({
                url:"/agent/panel/passwordeditResult.do",
                type:"post",
                data:$('#profile').serialize(),
                success:function(res){
                    if(res.code== 200){
                        layer.alert("编辑成功", {icon: 6},function () {
                            parent.location.reload();
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(index);
                        });
                    }else{
                        layer.alert("操作失败", {icon: 5},function () {
                            parent.location.reload();
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(index);
                        });
                    }
                }
            });
            return false;
        });
    });
</script>
</script>
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jquery-1.11.2.min.js"></script>    
    <!--materialize js-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- chartist 
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/chartist-js/chartist.min.js"></script>   -->
    <!-- chartjs -->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/chartjs/chart.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/chartjs/chart-script.js"></script> -->
    <!-- sparkline -->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/sparkline/sparkline-script.js"></script>
    <!--jvectormap-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/jvectormap/vectormap-script.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/custom-script.js"></script>
    <!-- Toast Notification -->
    <script type="text/javascript" src="<?php echo URL_VIEW;?>/static/js/plugins/sweetalert/sweetalert.min.js"></script>  
    <!-- layer -->
    <script src="<?php echo URL_STATIC . 'js/layer/layer.js';?>" charset="utf-8"></script>
   
</body>
</html>