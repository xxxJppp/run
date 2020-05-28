<?php
use xh\library\url;
use xh\library\model;
use xh\unity\cog;
include_once (PATH_VIEW . 'common/header.php'); //头部
$fix = DB_PREFIX;
?>
<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <!--条件查询-->
                <div class="ibox-title">
                    <h5>代理管理</h5>
                    
                    <div class="ibox-tools">
                        <a data-toggle="modal" data-target="#add1" class="btn btn-light">添加代理</a>
                        <i class="layui-icon" onclick="location.replace(location.href);" title="刷新"
                           style="cursor:pointer;">ဂ</i>
                    </div>
                </div>
                
                <div>
                    <form action="" style="margin-top: 20px">
                        <input type="text" name="username" placeholder="用户名" value="<?php echo $username;?>">
                        <input type="submit" style="border:0px" value="查询" class="btn btn-success">
                    </form>

                </div>

                <table class="layui-table" lay-data="{width:'100%',limit:15,id:'userData'}">
                    <thead>
                    <tr>
                        <th lay-data="{field:'check',width:80,checkbox:true}"></th>
                        <th lay-data="{field:'key',width:90}">ID</th>
                        <th lay-data="{field:'key1',width:130}">用户名</th>
                        <th lay-data="{field:'out_trade_id', width:100,style:'color:#060;'}">用户组</th>
                        <th lay-data="{field:'memberid', width:140}">用户余额</th>
                        <th lay-data="{field:'amount', width:100,style:'color:#060;'}">IP地址</th>
                        <th lay-data="{field:'rate', width:100}">今日跑量</th>
                        <!--<th lay-data="{field:'bbb', width:100,style:'color:#C00;'}">今日下发金额</th>
                        <th lay-data="{field:'aaa', width:120,style:'color:#C00;'}">未下发金额</th>-->
                        <th lay-data="{field:'ccc', width:120,style:'color:#C00;'}">今日订单数</th>
                        <th lay-data="{field:'ddd', width:120,style:'color:#C00;'}">今日成功数</th>
                        <th lay-data="{field:'eee', width:120,style:'color:#C00;'}">今日成功率</th>
                        <th lay-data="{field:'fff', width:130,style:'color:#C00;'}">今日代理佣金</th>
                        <th lay-data="{field:'ggg', width:120,style:'color:#C00;'}">在线码数</th>
                        <th lay-data="{field:'zzz', width:120,style:'color:#C00;'}">昨日订单数</th>
                        <th lay-data="{field:'xxx', width:120,style:'color:#C00;'}">昨日成功数</th>
                        <th lay-data="{field:'haha', width:120,style:'color:#C00;'}">昨日成功率</th>
                        <th lay-data="{field:'zxc', width:120,style:'color:#C00;'}">昨日代理佣金</th>
                        <th lay-data="{field:'dfs', width:120,style:'color:#C00;'}">所有码上下线</th>
                        <th lay-data="{field:'mas', width:180,style:'color:#C00;'}">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($member['result'] as $em) { ?>
                        <tr id="user_<?php echo $em['id']; ?>">
                            <td></td>
                            <td style="text-align:center; color:#090;"><?php echo $em['id']; ?> </td>
                            <td><a href="/admin/member/mashang.do?agent_id=<?php echo $em['id']?>"><?php echo $em['username']; ?></a> </td>
                            <td style="text-align:center; color:#090;">
                                <?php $group = $mysql->query("client_group", "id={$em['group_id']}")[0];
                                echo is_array($group) ? '<span style="color:orange;"><b>' . $group['name'] . '</b></span>' : '<span style="color:red;">未分配</span>'; ?>
                            </td>
                            <td style="text-align:center;"><?php echo $em['balance']; ?></td>
                            <td style="text-align:center; color:#060"><?php echo $em['ip']; ?> </td>
                            <td style="text-align:center; color:#666">
                                <?php //查询今日收入
                                $ids = $mysql->select("select id from {$fix}client_user where level_id={$em['id']}");
                                $ids = implode(',',array_column($ids,'id'));
                                $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');

                                $order = $mysql->select("select sum(huoli) as money,count(id) as count,sum(amount) as amount from {$fix}agent_huoli_log where agent_id = {$em['id']} and time > {$nowTime}  ");

                                echo '<span style="color:blue;font-weight:bold;"> ' . floatval($order[0]['amount']) . ' </span>' ?>
                            </td>
                            <!--<td style="text-align:center;">
                                <a href="#" onclick="order_view('<?php /*echo $em['username']; */?>->设置押金','/admin/member/editdeposit.do?id=<?php /*echo $em['id']; */?>',500,350)" class="btn btn-danger btn-xs">
                                    <?php /*echo $em['yajin'];*/?>
                                </a>
                            </td>
                            <td>
                                <?php
/*                                $tody = $em['yajin']-floatval($order[0]['amount']);
                                if($tody>0){
                                    echo $tody;
                                }else{
                                    echo 0;
                                }
                                */?>
                            </td>-->
                            <td>
                                <?php
                                $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');

                                $order_all = $mysql->select("select sum(fees) as fees,count(id) as count,sum(amount) as amount from {$fix}client_paofen_automatic_orders where user_id in ({$ids}) and creation_time > {$nowTime}");

                                echo '<span style="color:blue;font-weight:bold;"> '.floatval($order_all[0]['count']) .' </span>' ?>
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
                                echo floatval($order[0]['money']);
                                ?>
                            </td>
                            <td>
                                <?php
                                $erweima = $mysql->select("select count(id) as count from {$fix}client_paofen_automatic_account where user_id in ({$ids}) and training=1");
                                echo $erweima[0]['count'];
                                ?>
                            </td>
                            <td>
                                <?php //查询今日收入

                                $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');
                                $zrTime = strtotime(date("Y-m-d", $nowTime - 86400) . ' 00:00:00'); //昨日的时间

                                $y_order_all = $mysql->select("select sum(fees) as fees,count(id) as count,sum(amount) as amount from {$fix}client_paofen_automatic_orders where user_id in ({$ids}) and creation_time > {$zrTime} and creation_time<{$nowTime}");


                                echo '<span style="color:blue;font-weight:bold;"> ' . floatval($y_order_all[0]['count']) . ' </span>' ?>
                            </td>
                            <td>
                                <?php //查询今日收入

                                $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');
                                $zrTime = strtotime(date("Y-m-d", $nowTime - 86400) . ' 00:00:00'); //昨日的时间

                                $y_order = $mysql->select("select sum(fees) as fees,count(id) as count,sum(amount) as amount from {$fix}client_paofen_automatic_orders where user_id in ({$ids}) and creation_time > {$zrTime} and creation_time<{$nowTime} and status=4");


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
                                $huoli = $mysql->select("select sum(huoli) as huoli from {$fix}agent_huoli_log where agent_id={$em['id']} and time > {$zrTime} and time < {$nowTime}");
                                //echo floatval($huoli[0]['huoli']);
                                echo floatval($huoli[0]['huoli']);
                                ?>
                            </td>
                            <td>
                                <?php
                                $zong_erweima = $mysql->select("select count(id) as count from {$fix}client_paofen_automatic_account where user_id in ({$ids})");
                                if($zong_erweima[0]['count']>0){
                                    if($erweima[0]['count']>0){ ?>
                                        <button class="layui-btn layui-btn-small"
                                                onclick="off_erweima('<?php echo $ids; ?>')">
                                            下线
                                        </button>
                                    <?php }else{ ?>
                                        <button class="layui-btn layui-btn-small"
                                                onclick="open_erweima('<?php echo $ids; ?>')">
                                            上线
                                        </button>
                                    <?php }}?>
                            </td>
                            <td>

                                <a class="layui-btn layui-btn-small"
                                        href="<?php echo url::s('admin/member/edit',"type=daili&id=" . str_replace('=', '@', base64_encode($em['id'])));?>">
                                    修改资料
                                </a>
                                <button class="layui-btn layui-btn-small"
                                        onclick="order_del(this,'<?php echo $em['id']; ?>')">
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
<!-- Modal -->
<div class="modal fade" id="add1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form class="form-horizontal" id="from" method="post" action="#">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加代理</h4>
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
                                    <option value="<?php echo $gp['id'];?>" <?php if ($gp['id'] == cog::read('registerCog')['group_id']) echo 'selected';?>><?php echo $gp['name'];?></option>
                                <?php }?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label form-label">手机号</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-line" name="phone"  placeholder="手机号码(选填)">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label form-label">上级ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-line" name="level_id"  placeholder="0">
                        </div>
                    </div>

<!--                    <div class="form-group">-->
<!--                        <label class="col-sm-2 control-label form-label">账户余额</label>-->
<!--                        <div class="col-sm-10">-->
<!--                            <input type="text" class="form-control form-control-line" name="balance"  placeholder="0.00">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label class="col-sm-2 control-label form-label">账户金额</label>-->
<!--                        <div class="col-sm-10">-->
<!--                            <input type="text" class="form-control form-control-line" name="money"  placeholder="0.00">-->
<!--                        </div>-->
<!--                    </div>-->

                 <input type="hidden" name="is_agent" value="1">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                    <button type="button" onclick="add()" class="btn btn-success">确认添加</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>

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
    //添加用户
    function add(){
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo url::s('admin/member/add');?>",
            data: $('#from').serialize(),
            success: function (data) {
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
