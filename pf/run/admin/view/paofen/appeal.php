<?php
use xh\library\ip;
use xh\library\url;
use xh\unity\cog;
use xh\library\model;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
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
<div class="content">
<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <!--条件查询-->
                <div class="ibox-title">
                    <h5>申诉管理</h5>
                    <div class="ibox-tools">
                        <i class="layui-icon" onclick="location.replace(location.href);" title="刷新"
                           style="cursor:pointer;">ဂ</i>
                    </div>
                </div>

                <table class="layui-table" lay-data="{width:'100%',limit:15,id:'userData'}">
                    <thead>
                    <tr>
                        <th lay-data="{field:'check',width:80,checkbox:true}"></th>
                        <th lay-data="{field:'key',width:90}">ID</th>
                        <th lay-data="{field:'key1',width:130}">用户名</th>
                        <th lay-data="{field:'out_trade_id', width:200,style:'color:#060;'}">订单号</th>
                        <th lay-data="{field:'memberid', width:140}">申诉理由</th>
                        <th lay-data="{field:'voucher', width:140}">申诉凭证</th>
                        <th lay-data="{field:'remarks', width:400}">备注</th>
                        <th lay-data="{field:'create_time', width:200}">申请时间</th>
                        <th lay-data="{field:'mas', width:180,style:'color:#C00;'}">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $em) { ?>
                        <tr id="user_<?php echo $em['id']; ?>">
                            <td></td>
                            <td style="text-align:center; color:#090;"><?php echo $em['id']; ?> </td>
                            <td><?php echo $mysql->query('client_user','id='.$em['user_id'],'username')[0]['username']; ?> </td>
                            <td style="text-align:center; color:#090;">
                                <?php echo $em['trade_no']; ?>
                            </td>
                            <td style="text-align:center;"><?php echo $em['status']==1?'钱多了':'钱少了'; ?></td>
                            <td style="text-align:center;">
                                <?php if($em['voucher']){?>
                                <button class="layui-btn layui-btn-small"
                                        onclick="voucher('<?php echo $em['voucher']; ?>')">
                                    查看图片
                                </button>
                                <?php } ?>
                            </td>
                            <td style="text-align:center; color:#060"><span title="<?php echo $em['remarks']; ?>"><?php echo $em['remarks']; ?></span></td>
                            <td style="text-align:center; color:#666">
                                <?php echo date('Y-m-d H:i:s',$em['create_time']);?>
                            </td>
                            <td style="text-align:center;">
                                <?php if($em['audit'] == 0){?>
                                <button class="layui-btn layui-btn-small"
                                        onclick="audit('<?php echo $em['id']; ?>',1)">
                                    审核
                                </button>
                                <button class="layui-btn layui-btn-small"
                                        onclick="audit('<?php echo $em['id']; ?>',2)">
                                    驳回
                                </button>
                                <?php }else{ ?>
                                    已审核
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

                <!--交易列表-->
                <div class="page">
                    <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-0">
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
<!-- Modal -->
<div class="modal fade" id="add1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal" id="from" method="post" action="#">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加会员</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label form-label">用户名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-line" name="username"  placeholder="登录用户名">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label form-label">密码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-line" name="pwd"  placeholder="登录密码">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label form-label">权限组</label>
                        <div class="col-sm-10">
                            <select class="selectpicker" name="group_id">
                                <?php foreach ($groups as $gp){?>
                                    <option value="<?php echo $gp['id'];?>"><?php echo $gp['name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label form-label">手机号</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-line" name="phone"  placeholder="手机号码">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label form-label">上级ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-line" name="level_id"  placeholder="0">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label form-label">账户余额</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-line" name="balance"  placeholder="0.00">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label form-label">账户金额</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-line" name="money"  placeholder="0.00">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label form-label">是否代理</label>
                        <div class="col-sm-10">
                            <span style="float:left;width:60px">不是 <input style="width:20px;" type="radio" class="form-control" name="is_agent" value="0" ></span>
                            <span style="float:left;width:60px">  是  <input style="width:20px;" type="radio" class="form-control " name="is_agent" value="1"></span>
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" onclick="add()" class="btn btn-default">确认添加</button>
                </div>
            </div>
        </form>
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
    layui.use(['laydate', 'laypage', 'layer', 'table', 'form'], function () {
        var laydate = layui.laydate //日期
            , laypage = layui.laypage //分页
            , layer = layui.layer //弹层
            , form = layui.form //表单
            , table = layui.table; //表格
        //日期时间范围
        laydate.render({
            elem: '#createtime'
            , type: 'datetime'
            , theme: 'molv'
            , range: '|'
        });
        //日期时间范围
        laydate.render({
            elem: '#successtime'
            , type: 'datetime'
            , theme: 'molv'
            , range: '|'
        });
    });

    /*订单-查看*/
    function order_view(title, url, w, h) {
        x_admin_show(title, url, w, h);
    }
    function open_erweima(uid) {
        layer.confirm('确认要上线吗？', function (index) {
            $.ajax({
                url: "/admin/member/openrobin",
                type: 'post',
                data: 'member_id=' + uid,
                success: function (res) {
                    if (res.code == 200) {
                        layer.msg(res.msg, {icon: 1, time: 1000});
                        window.location.href = "/admin/member/daili";
                    }
                }
            });
        });
    }

    function off_erweima(uid) {
        layer.confirm('确认要下线吗？', function (index) {
            $.ajax({
                url: "/admin/member/offrobin",
                type: 'post',
                data: 'member_id=' + uid,
                success: function (res) {
                    console.log(res);
                    if (res.code == 200) {
                        layer.msg(res.msg, {icon: 1, time: 1000});
                        window.location.href = "/admin/member/daili";
                    }
                }
            });
        });
    }

    $('#export').on('click', function () {
        window.location.href
            = "/agent_Order_exportorder_status_2.html";
    });
    $('#pageList').change(function () {
        $('#pageForm').submit();
    });

    function voucher(url) {
        layer.open({
            title:"查看凭证",
            content:'<img src="'+url+'" alt="">'
        })
    }

    function audit(id,type) {
        if(type == 1){
            layer.prompt({title: '请填写正确金额', formType: 0}, function(ret, index){
                $.ajax({
                    url: "/admin/paofen/appealaudit",
                    type: 'post',
                    data: {id:id,amount:ret,type:type},
                    success: function (res) {
                        if(res.code == 1){
                            layer.msg(res.msg, {icon: 1, time: 1000});
                        }else{
                            layer.msg(res.msg, {icon: 2, time: 1000});
                        }

                        window.location.href = "/admin/paofen/appeal";
                    }
                });
            });
        }else{
            $.ajax({
                url: "/admin/paofen/appealaudit",
                type: 'post',
                data: {id:id,type:type},
                success: function (res) {
                    if(res.code == 1){
                        layer.msg(res.msg, {icon: 1, time: 1000});
                    }else{
                        layer.msg(res.msg, {icon: 2, time: 1000});
                    }

                    window.location.href = "/admin/paofen/appeal";
                }
            });
        }

    }

    function showBtn() {
        var Inc = 0;
        $("input[name='items']:checkbox").each(function () {
            if (this.checked) {
                $('#deletes').show();
                return true;
            }
            Inc++;
        });
        if ($("input[name='items']:checkbox").length == Inc) {
            $('#deletes').hide();
        }
    }
</script>
</body>
</html>
