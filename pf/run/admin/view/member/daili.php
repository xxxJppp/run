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
                    <h5>代理管理</h5>
                    <div class="ibox-tools">
                        <a data-toggle="modal" data-target="#add1" class="btn btn-light">添加会员</a>
                        <i class="layui-icon" onclick="location.replace(location.href);" title="刷新"
                           style="cursor:pointer;">ဂ</i>
                    </div>
                </div>

                <table class="layui-table" lay-data="{width:'100%',limit:15,id:'userData'}">
                    <thead>
                    <tr>
                        <th lay-data="{field:'check',width:80,checkbox:true}">></th>
                        <th lay-data="{field:'key',width:90}">ID</th>
                        <th lay-data="{field:'key1',width:130}">会员名</th>
                        <th lay-data="{field:'out_trade_id', width:100,style:'color:#060;'}">用户组</th>
                        <th lay-data="{field:'memberid', width:140}">手机号</th>
                        <th lay-data="{field:'amount', width:100,style:'color:#060;'}">账户余额</th>
                        <th lay-data="{field:'rate', width:170}">登录时间</th>
                        <th lay-data="{field:'bbb', width:100,style:'color:#C00;'}">IP地址</th>
                        <th lay-data="{field:'aaa', width:120,style:'color:#C00;'}">今日订单数</th>
                        <th lay-data="{field:'ccc', width:120,style:'color:#C00;'}">今日总获利</th>
                        <th lay-data="{field:'ddd', width:120,style:'color:#C00;'}">今日总交易额</th>
                        <th lay-data="{field:'eee', width:120,style:'color:#C00;'}">昨日总订单数</th>
                        <th lay-data="{field:'fff', width:130,style:'color:#C00;'}">昨日总获利</th>
                        <th lay-data="{field:'ggg', width:120,style:'color:#C00;'}">昨日总交易额</th>
                        <th lay-data="{field:'zzz', width:120,style:'color:#C00;'}">总订单数</th>
                        <th lay-data="{field:'xxx', width:120,style:'color:#C00;'}">总获利</th>
                        <th lay-data="{field:'haha', width:120,style:'color:#C00;'}">总交易额</th>
                        <th lay-data="{field:'actualamount', width:200,style:'color:#C00;'}">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($member['result'] as $em) { ?>
                        <tr id="user_<?php echo $em['id']; ?>">
                            <td></td>
                            <td><?php echo $em['id']; ?> </td>

                            <td style="text-align:center; color:#090;"><?php echo $em['username']; ?> </td>
                            <td style="text-align:center; color:#090;">
                                <?php $group = $mysql->query("client_group", "id={$em['group_id']}")[0];
                                echo is_array($group) ? '<span style="color:orange;"><b>' . $group['name'] . '</b></span>' : '<span style="color:red;">未分配</span>'; ?>
                            </td>
                            <td style="text-align:center;"><?php echo $em['phone']; ?></td>
                            <td style="text-align:center; color:#060"><?php echo $em['balance']; ?> </td>
                            <td style="text-align:center; color:#666">
                                <?php echo date("Y/m/d H:i:s",$em['login_time']);?>
                            </td>
                            <td style="text-align:center;">
                                <?php echo $em['ip'];?>
                                <!--( <a href="#" onclick="ipGet('<?php /*echo $em['ip'];*/?>',this);" style="color: green;">显示归属地</a> )-->
                            </td>
                            <td>
                                <?php //查询今日收入

                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');

                                $order = $mysql->select("select sum(huoli) as money,count(id) as count,sum(amount) as amount from {$fix}agent_huoli_log where agent_id = {$em['id']} and time > {$nowTime}  ");

                                echo '<span style="color:blue;font-weight:bold;"> '.floatval($order[0]['count']) .' </span>' ?>

                            </td>
                            <td>
                                <?php

                                echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span>' ?>
                            </td>
                            <td>
                                <?php
                                echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['amount']) .' </span>' ?>
                            </td>
                            <td>
                                <?php //查询今日收入

                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                                $zrTime = strtotime(date("Y-m-d",$nowTime-86400) . ' 00:00:00'); //昨日的时间

                                $order = $mysql->select("select sum(huoli) as money,count(id) as count,sum(amount) as amount from {$fix}agent_huoli_log where agent_id = {$em['id']} and time > {$zrTime} and time<{$nowTime}");

                                echo '<span style="color:blue;font-weight:bold;"> '.floatval($order[0]['count']) .' </span>' ?>
                            </td>
                            <td>
                                <?php

                                echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span>' ?>

                            </td>
                            <td>
                                <?php
                                echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['amount']) .' </span>' ?>
                            </td>
                            <td>
                                <?php //查询今日收入

                                $order = $mysql->select("select sum(huoli) as money,count(id) as count,sum(amount) as amount from {$fix}agent_huoli_log where agent_id ={$em['id']}");

                                echo '<span style="color:blue;font-weight:bold;"> '.floatval($order[0]['count']) .' </span>' ?>

                            </td>
                            <td>
                                <?php

                                echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span>' ?>
                            </td>
                            <td>
                                <?php
                                echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['amount']) .' </span>' ?>
                            </td>
                            <td>
                                <a class="layui-btn layui-btn-small"
                                        href="/admin/member/edit.do?id=<?php echo str_replace('=', '@', base64_encode($em['id'])); ?>">
                                    更改资料
                                </a>
                                <button class="layui-btn layui-btn-small"
                                        onclick="order_del(this,'<?php echo $em['id']; ?>')">
                                    移除会员
                                </button>
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
                        <?php (new model())->load('page', 'turn')->auto($member['info']['pageAll'], $member['info']['page'], 10); ?>
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
    //添加用户
    function add(){
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo url::s('admin/member/add');?>",
            data: $('#from').serialize(),
            success: function (data) {
                console.log(data);
                if(data.code == '200'){
                    layer.msg('添加成功!', {icon: 1, time: 1000});
                    window.location.href="/admin/member/daili";
                }else{
                    layer.msg(data.msg, {icon: 1, time: 1000});
                }
            },
            error: function(data) {
                alert("error:"+data.responseText);
            }
        });
    }
    /*订单-删除*/
    function order_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                url: "/admin/member/delete",
                type: 'post',
                data: 'id=' + id,
                success: function (res) {
                    if (res.code==200) {
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!', {icon: 1, time: 1000});
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

    function deletes() {
        swal({
                title: "非常危险",
                text: "你确定要批量删除已选中的会员吗？",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "是的,我要删除这些会员!",
                closeOnConfirm: false
            },
            function () {
                $("input[name='items']:checked").each(function () {
                    $.get("<?php echo url::s('admin/member/delete', 'id=');?>" + $(this).val(), function (result) {
                        swal("操作提示", '当前操作已经执行完毕!', "success");
                        setTimeout(function () {
                            location.href = '';
                        }, 1500);
                    });
                });

            });

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
