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
        .layui-form-label {
            width: 110px;
            padding: 4px
        }

        .layui-form-item .layui-form-checkbox[lay-skin="primary"] {
            margin-top: 0;
        }

        .layui-form-switch {
            width: 54px;
            margin-top: 0px;
        }
    </style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <!--用户信息-->
                    <form class="layui-form" id="profile" enctype="multipart/form-data" method="post">
                        <div class="layui-form-item">
                            <label class="layui-form-label">订单号：</label>
                            <div class="layui-input-block">
                                <input type="hidden" name="id"   value="<?php echo $id; ?>">
                                <input type="text" lay-verify="title" name="trade_no" autocomplete="off" class="layui-input"
                                       value="<?php echo $result['trade_no']; ?>" readonly>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">类型：</label>
                            <div class="layui-input-block">
                                <input name="status" type="radio" value="1" title="钱多了" class="ayui-input" checked>
                                <input name="status" type="radio" value="2" title="钱少了" class="ayui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">实际到账金额：</label>
                            <div class="layui-input-block">
                                <input type="hidden" name="id"   value="<?php echo $id; ?>">
                                <input type="number" lay-verify="title" name="money" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">上传凭证：</label>
                            <div class="layui-input-block">
                                <button type="button" class="layui-btn" id="upload">
                                    <i class="layui-icon">&#xe67c;</i>上传图片
                                </button>
                                <input name="voucher" id="voucher" type="hidden" value="">
                                <div style="width: 300px" id="img"></div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">备注：</label>
                            <div class="layui-input-block">
                                <textarea name="remarks" placeholder="请输入备注" autocomplete="off"
                                          class="layui-input"></textarea>
                            </div>
                        </div>


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

    layui.use(['layer', 'form','upload','element'], function () {
        var form = layui.form;
        var upload = layui.upload;
        form.on('submit(profile)', function (data) {
            layer.msg('加载中', {
                icon: 16
                ,shade: 0.4
                ,time:0
            });
            $.ajax({
                url: "/mashang/paofen/addappeal.do",
                type: "post",
                data: $('#profile').serialize(),
                success: function (res) {
                    layer.close(layer.index);
                    if (res.code == '200') {
                        layer.alert(res.msg, {icon: 1}, function () {
                            window.location.href="/mashang/paofen/automaticOrder.do"
                        });
                    } else {
                        layer.alert(res.msg ? res.msg : "操作失败", {icon: 2});
                    }
                }
            });
            return false;
        });
        var uploadInst = upload.render({
            elem: '#upload' //绑定元素
            ,url:'/mashang/paofen/uploadappeal.do'
            ,accept:'images'
            ,before: function(obj){
                layer.msg('加载中', {
                    icon: 16
                    ,shade: 0.4
                    ,time:0
                });
            },done: function(res){
                layer.close(layer.index);
                if(res.code == 200){
                    $("#img").html('<img src="'+res.msg+'">');
                    $("#voucher").val(res.msg);
                }else{
                    layer.msg('请求异常');
                }
            }
            ,error: function(){
                layer.close(layer.index);
            }
        });
    });


</script>
</body>
</html>