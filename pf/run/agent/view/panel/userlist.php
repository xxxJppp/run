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
                <!--条件查询-->
                <div class="ibox-title">
                    <h5>码商管理</h5>
                    <div class="ibox-tools">
                        <i class="layui-icon" onclick="location.replace(location.href);" title="刷新"
                           style="cursor:pointer;">ဂ</i>
                    </div>
                </div>

                <table class="layui-table" lay-data="{width:'100%',limit:15,id:'userData'}">
                    <thead>
                    <tr>
                        <th lay-data="{field:'check',width:80,checkbox:true}">></th>
                        <th lay-data="{field:'key1',width:90}">ID</th>
                        <th lay-data="{field:'key',width:130}">用户名</th>
                        <th lay-data="{field:'out_trade_id', width:100,style:'color:#060;'}">用户组</th>
                        <th lay-data="{field:'memberid', width:140}">用户余额</th>
                        <th lay-data="{field:'amount', width:100,style:'color:#060;'}">IP地址</th>
                        <th lay-data="{field:'rate', width:100}">今日跑量</th>
                        <th lay-data="{field:'bbb', width:120,style:'color:#C00;'}">今日下发金额</th>
                        <th lay-data="{field:'aaa', width:120,style:'color:#C00;'}">未下发金额</th>
                        <th lay-data="{field:'ccc', width:120,style:'color:#C00;'}">今日订单数</th>
                        <th lay-data="{field:'ddd', width:120,style:'color:#C00;'}">今日成功数</th>
                        <th lay-data="{field:'eee', width:120,style:'color:#C00;'}">今日成功率</th>
                        <th lay-data="{field:'fff', width:130,style:'color:#C00;'}">今日码商佣金</th>
                        <th lay-data="{field:'ggg', width:120,style:'color:#C00;'}">在线码数</th>
                        <th lay-data="{field:'zzz', width:120,style:'color:#C00;'}">昨日订单数</th>
                        <th lay-data="{field:'xxx', width:120,style:'color:#C00;'}">昨日成功数</th>
                        <th lay-data="{field:'haha', width:120,style:'color:#C00;'}">昨日成功率</th>
                        <th lay-data="{field:'zxc', width:120,style:'color:#C00;'}">昨日码商佣金</th>
                        <th lay-data="{field:'actualamount', width:100,style:'color:#C00;'}">所有码上下线</th>
                        <th lay-data="{field:'mas', width:180,style:'color:#C00;'}">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($member['result'] as $em) { ?>
                        <tr id="user_<?php echo $em['id']; ?>">
                            <td></td>
                            <td style="text-align:center; color:#090;"><?php echo $em['id']; ?> </td>
                            <td><?php echo $em['username']; ?> </td>
                            <td style="text-align:center; color:#090;">
                                <?php $group = $mysql->query("client_group", "id={$em['group_id']}")[0];
                                echo is_array($group) ? '<span style="color:orange;"><b>' . $group['name'] . '</b></span>' : '<span style="color:red;">未分配</span>'; ?>
                            </td>
                            <td style="text-align:center;"><?php echo $em['balance']; ?></td>
                            <td style="text-align:center; color:#060"><?php echo $em['ip']; ?> </td>
                            <td style="text-align:center; color:#666">
                                <?php //查询今日收入

                                $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');

                                $order = $mysql->select("select sum(fees) as fees,count(id) as count,sum(amount) as amount from {$fix}client_paofen_automatic_orders where user_id = {$em['id']} and creation_time > {$nowTime} and status=4 ");

                                echo '<span style="color:blue;font-weight:bold;"> ' . floatval($order[0]['amount']) . ' </span>' ?>
                            </td>
                            <td style="text-align:center;">
                                <a href="#" onclick="order_view('<?php echo $em['username']; ?>->设置押金','/agent/panel/editdeposit.do?id=<?php echo $em['id']; ?>',500,400)" class="btn btn-danger btn-xs">
                                <?php echo $em['yajin'];?>
                                </a>
                            </td>
                            <td>
                                <?php
                                $tody = $em['yajin']-floatval($order[0]['amount']);
                                if($tody>0){
                                echo $tody;
                                }else{
                                    echo 0;
                                }
                                ?>
                            </td>
                            <td>
                                <?php

                                $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');

                                $order_all = $mysql->select("select sum(fees) as fees,count(id) as count,sum(amount) as amount from {$fix}client_paofen_automatic_orders where user_id = {$em['id']} and creation_time > {$nowTime}");

                                echo '<span style="color:blue;font-weight:bold;"> ' . floatval($order_all[0]['count']) . ' </span>' ?>
                            </td>
                            <td>
                                <?php //查询今日收入

                                echo '<span style="color:blue;font-weight:bold;"> ' . floatval($order[0]['count']) . ' </span>' ?>
                            </td>
                            <td>
                                <?php
                                if (intval($order_all[0]['count']) > 0) {
                                    $lv = sprintf("%.2f",intval($order[0]['count']) / intval($order_all[0]['count'])*100);
                                } else {
                                    $lv = 0;
                                }
                                echo $lv;
                                ?>%
                            </td>
                            <td>
                                <?php
                                $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');
                                $huoli = $mysql->select("select sum(huoli) as huoli from {$fix}agent_huoli_log where agent_id={$em['level_id']} and uid={$em['id']} and time > {$nowTime}");
                               // echo floatval($huoli[0]['huoli']);
                                echo sprintf("%.2f",floatval($order[0]['amount'])*$em['mashang_rebate']/100);
                                ?>
                            </td>
                            <td>
                                <?php
                                $erweima = $mysql->select("select count(id) as count from {$fix}client_paofen_automatic_account where user_id={$em['id']} and training=1");
                                echo $erweima[0]['count'];
                                ?>
                            </td>
                            <td>
                                <?php //查询今日收入

                                $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');
                                $zrTime = strtotime(date("Y-m-d", $nowTime - 86400) . ' 00:00:00'); //昨日的时间

                                $y_order_all = $mysql->select("select sum(fees) as fees,count(id) as count,sum(amount) as amount from {$fix}client_paofen_automatic_orders where user_id = {$em['id']} and creation_time > {$zrTime} and creation_time<{$nowTime}");


                                echo '<span style="color:blue;font-weight:bold;"> ' . floatval($y_order_all[0]['count']) . ' </span>' ?>
                            </td>
                            <td>
                                <?php //查询今日收入

                                $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');
                                $zrTime = strtotime(date("Y-m-d", $nowTime - 86400) . ' 00:00:00'); //昨日的时间

                                $y_order = $mysql->select("select sum(fees) as fees,count(id) as count,sum(amount) as amount from {$fix}client_paofen_automatic_orders where user_id = {$em['id']} and creation_time > {$zrTime} and creation_time<{$nowTime} and status=4");


                                echo '<span style="color:blue;font-weight:bold;"> ' . floatval($y_order[0]['count']) . ' </span>' ?>
                            </td>
                            <td>
                                <?php
                                if (intval($y_order_all[0]['count']) > 0) {
                                    $lv = sprintf("%.2f",intval($y_order[0]['count']) / intval($y_order_all[0]['count'])*100);
                                } else {
                                    $lv = 0;
                                }
                                echo $lv;
                                ?>%
                            </td>
                            <td>
                                <?php

                                $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');
                                $zrTime = strtotime(date("Y-m-d", $nowTime - 86400) . ' 00:00:00'); //昨日的时间
                                $huoli = $mysql->select("select sum(huoli) as huoli from {$fix}agent_huoli_log where agent_id={$em['level_id']} and uid={$em['id']} and time > {$zrTime} and time < {$nowTime}");
                                //echo floatval($huoli[0]['huoli']);
                                echo sprintf("%.2f",floatval($y_order[0]['amount'])*$em['mashang_rebate']/100);
                                ?>
                            </td>
                            <td>


                                <?php
                                $zong_erweima = $mysql->select("select count(id) as count from {$fix}client_paofen_automatic_account where user_id={$em['id']}");
                                if($zong_erweima[0]['count']>0){
                                if($erweima[0]['count']>0){ ?>
                                <button class="layui-btn layui-btn-small"
                                        onclick="off_erweima('<?php echo $em['id']; ?>')">
                                    下线
                                </button>
                                <?php }else{ ?>
                                <button class="layui-btn layui-btn-small"
                                        onclick="open_erweima('<?php echo $em['id']; ?>')">
                                    上线
                                </button>
                                <?php }}else{?>
                                没有收款码
                                <?php }?>
                            </td>
                            <td>
                                <button class="layui-btn layui-btn-small"
                                        onclick="order_view('<?php echo $em['username']; ?>->编辑','/agent/panel/passwordedit.do?id=<?php echo $em['id']; ?>',500,350)">
                                    编辑
                                </button>
                                <button class="layui-btn layui-btn-small"
                                        onclick="del_mashang(this,'<?php echo $em['id']; ?>')">
                                    删除
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
    function del_mashang(obj,uid) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                url: "/agent/panel/delquotient",
                type: 'post',
                data: 'member_id=' + uid,
                success: function (res) {
                    if (res.code == 200) {
                        $(obj).parents("tr").remove();
                        layer.msg(res.msg, {icon: 1, time: 1000});
                    }else{
                        layer.msg(res.msg, {icon: 1, time: 1000});
                    }
                }
            });
        });
    }
    function open_erweima(uid) {
        layer.confirm('确认要上线吗？', function (index) {
            $.ajax({
                url: "/agent/panel/openrobin",
                type: 'post',
                data: 'member_id=' + uid,
                success: function (res) {
                    if (res.code == 200) {
                        layer.msg(res.msg, {icon: 1, time: 1000});
                        window.location.href = "/agent/panel/userlist.do";
                    }
                }
            });
        });
    }

    function off_erweima(uid) {
        layer.confirm('确认要下线吗？', function (index) {
            $.ajax({
                url: "/agent/panel/offrobin",
                type: 'post',
                data: 'member_id=' + uid,
                success: function (res) {
                    if (res.code == 200) {
                        layer.msg(res.msg, {icon: 1, time: 1000});
                        window.location.href = "/agent/panel/userlist.do";
                    }
                }
            });
        });
    }

    /*订单-删除*/
    function order_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                url: "/agent_Order_delOrder.html",
                type: 'post',
                data: 'id=' + id,
                success: function (res) {
                    if (res.status) {
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