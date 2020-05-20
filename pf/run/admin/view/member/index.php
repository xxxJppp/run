<?php

use xh\library\url;
use xh\library\model;
use xh\library\ip;

include_once(PATH_VIEW . 'common/header.php'); //头部
$fix = DB_PREFIX;
?>

<!-- START CONTENT -->

<!-- Start Page Header -->
<div class="page-header">

    <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home'); ?>">控制台</a></li>
        <li class="active">会员管理</li>
    </ol>

    <!-- Start Page Header Right Div -->
    <div class="right">
        <div class="btn-group" role="group" aria-label="...">
            <a data-toggle="modal" data-target="#add" class="btn btn-light">添加会员</a>
            <a href="?verification=<?php echo mt_rand(1000, 9999); ?>" class="btn btn-light"><i
                        class="fa fa-refresh"></i></a>
            <a data-toggle="modal" data-target="#search" class="btn btn-light"><i class="fa fa-search"></i></a>

        </div>
    </div>
    <!-- End Page Header Right Div -->
</div>
<!-- End Page Header -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START CONTAINER -->
<div class="container-padding">


    <!-- Start Row -->
    <div class="row">

        <!-- Start Panel -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-title">
                    会员管理<?php if (!empty($_GET['member_id'])) { ?> -> [ <a style="color:green;"
                                                                           href="<?php echo url::s("admin/member/index"); ?>">返回查看全部会员</a> ]<?php } ?>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <td></td>
                            <td><input onchange="user_query(this);" style="width: 80%;" type="text"
                                       class="form-control form-control-line" placeholder="手机号/会员名/商户ID"
                                       value="<?php echo $_GET['member_id']; ?>"></td>
                            <td>通讯方式</td>
                            <td>账户详细</td>
                            <td>支付宝盈利</td>
                            <td>微信盈利</td>
                            <td>操作
                                <div class="checkbox checkbox-warning"
                                     style="display:inline-block;margin:0 0 0 25px;padding:0;position:relative;top:6px;">
                                    <input id="checkboxAll" type="checkbox">
                                    <label for="checkboxAll">
                                    </label>

                                    <button type="button" id="deletes" onclick="deletes();"
                                            class="btn btn-option1 btn-xs"
                                            style="display:none;position:relative;top:-8px;"><i
                                                class="fa fa-trash-o"></i>删除
                                    </button>

                                </div>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($member['result'] as $em) { ?>
                            <tr>
                                <td style="width: 86px;">
                                    <img id="<?php echo 'imgCode_' . $em['id']; ?>"
                                         onclick="imgSelect('<?php echo 'img_' . $em['id']; ?>');"
                                         style="width: 86px;border-radius:50%;" alt="<?php echo $em['username']; ?>"
                                         src="<?php echo strlen($em['avatar']) > 2 ? str_replace("admin", 'index', URL_VIEW) . 'upload/avatar/' . $em['id'] . '/' . $em['avatar'] : str_replace("admin", 'index', URL_VIEW) . 'static/images/avatar.png'; ?>">
                                </td>
                                <input type="file" name="avatar" id="<?php echo 'img_' . $em['id']; ?>"
                                       style="display:none;"
                                       onchange="uploadPic('#<?php echo 'img_' . $em['id']; ?>','<?php echo $em['id']; ?>');">
                                <td>
                                    <p><b>会员ID：</b><?php echo $em['id']; ?> [ <a
                                                href='<?php echo url::s('admin/wechat/automaticOrder', 'sorting=user&locking=true&code=' . $em['id']); ?>'>微信订单</a>
                                        /
                                        <a href='<?php echo url::s('admin/alipay/automaticOrder', 'sorting=user&locking=true&code=' . $em['id']); ?>'>支付宝订单</a>
                                        /
                                        <a href='<?php echo url::s('admin/service/order', 'sorting=user&code=' . $em['id']); ?>'>服务订单</a>
                                        ]</p>
                                    <p><b>会员名：</b><span style="color:red;"><?php echo $em['username']; ?></span></p>
                                    <p>
                                        <b>用户组：</b><?php $group = $mysql->query("client_group", "id={$em['group_id']}")[0];
                                        echo is_array($group) ? '<span style="color:orange;"><b>' . $group['name'] . '</b></span>' : '<span style="color:red;">未分配</span>'; ?>
                                        [
                                        <a href='<?php echo url::s('admin/wechat/automatic', 'userid=' . $em['id']); ?>'>微信</a>
                                        /
                                        <a href='<?php echo url::s('admin/alipay/automatic', 'userid=' . $em['id']); ?>'>支付宝</a>]
                                    </p>
                                </td>

                                <td>
                                    <p><b>手机号：</b><?php echo $em['phone']; ?> ( <a
                                                onclick="copy('<?php echo $em['phone']; ?>');" href="#"
                                                style="color: black;">复制</a> )</p>
                                    <p><b>上级ID：</b><?php

                                        if ($em['level_id'] != 0) {
                                            $find_level = $mysql->query("client_user", "id={$em['level_id']}")[0];
                                            if (is_array($find_level)) {
                                                echo '<a href="" style="color: blue;">' . $find_level['username'] . ' ( level ) </a>';
                                                //检测该上级是否还有上级
                                                if ($find_level['level_id'] != 0) {
                                                    $find_level_there = $mysql->query("client_user", "id={$find_level['level_id']}")[0];
                                                    if (is_array($find_level_there)) {
                                                        echo ' -- <a href="" style="color: green;">' . $find_level_there['username'] . ' ( top-level )</a>';
                                                    }
                                                }
                                            } else {
                                                echo '上级异常';
                                            }
                                        } else {
                                            echo '无上级';
                                        }

                                        ?> </p>
                                    <p><b>IP地址：</b><?php echo $em['ip']; ?> ( <a href="#"
                                                                                 onclick="ipGet('<?php echo $em['ip']; ?>',this);"
                                                                                 style="color: green;">显示归属地</a> )</p>
                                </td>
                                <td>
                                    <p><b>账户余额：</b><?php echo $em['balance']; ?>（消费）</p>
                                    <p><b>账户金额：</b><span style="color: green;"><?php echo $em['money']; ?></span>（盈利）
                                    </p>
                                    <p><b>登录时间：</b><?php echo date("Y/m/d H:i:s", $em['login_time']); ?> ( 上次 )</p>
                                </td>
                                <td>
                                    <p><b>今日收入:</b> <?php //查询今日收入

                                        $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');
                                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_alipay_automatic_orders where user_id={$em['id']} and creation_time > {$nowTime} and status=4");
                                        $today_order_all = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_alipay_automatic_orders where user_id={$em['id']} and creation_time > {$nowTime}");
                                        if ($order[0]['count'] != 0) {
                                            $today_rate = round($order[0]['count'] / $today_order_all[0]['count'] * 100, 2) . '%';
                                        } else {
                                            $today_rate = '0%';
                                        }

                                        echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  ( 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '/' . $today_order_all[0]['count'] . '&nbsp;成功率&nbsp;' . $today_rate . '</span> )';
                                        ?></p>
                                    <p><b>昨日收入:</b> <?php
                                        $zrTime = strtotime(date("Y-m-d", $nowTime - 86400) . ' 00:00:00'); //昨日的时间
                                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_alipay_automatic_orders where user_id={$em['id']} and creation_time > {$zrTime} and creation_time<{$nowTime} and status=4");
                                        $yesterday_order_all = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_alipay_automatic_orders where user_id={$em['id']} and creation_time > {$zrTime} and creation_time<{$nowTime}");
                                        if ($order[0]['count'] != 0) {
                                            $yesterday_rate = round($order[0]['count'] / $yesterday_order_all[0]['count'] * 100, 2) . '%';
                                        } else {
                                            $yesterday_rate = '0%';
                                        }
                                        echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  ( 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '/' . $yesterday_order_all[0]['count'] . '&nbsp;成功率&nbsp;' . $yesterday_rate . '</span> )';
                                        ?></p>
                                    <p><b>全部收入:</b> <?php
                                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_alipay_automatic_orders where user_id={$em['id']} and status=4");
                                        echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  ( 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '</span> )';
                                        ?></p>
                                </td>
                                <td>
                                    <p><b>今日收入:</b> <?php //查询今日收入

                                        $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');
                                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_wecaht_automatic_orders where user_id={$em['id']} and creation_time > {$nowTime} and status=4");
                                        echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  ( 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '</span> )';
                                        ?></p>
                                    <p><b>昨日收入:</b> <?php
                                        $zrTime = strtotime(date("Y-m-d", $nowTime - 86400) . ' 00:00:00'); //昨日的时间

                                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_wechat_automatic_orders where user_id={$em['id']} and creation_time > {$zrTime} and creation_time<{$nowTime} and status=4");
                                        echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  ( 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '</span> )';
                                        ?></p>
                                    <p><b>全部收入:</b> <?php
                                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_wechat_automatic_orders where user_id={$em['id']} and status=4");
                                        echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  ( 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '</span> )';
                                        ?></p>
                                </td>

                                <td>
                                    <p style="margin-top: -15px;">
                                    <div class="checkbox checkbox-danger checkbox-circle">
                                        <input onclick="showBtn()" name="items" value="<?php echo $em['id']; ?>"
                                               id="checkbox<?php echo $em['id']; ?>" type="checkbox">
                                        <label for="checkbox<?php echo $em['id']; ?>">
                                            勾选,准备移除该会员!
                                        </label>
                                    </div>
                                    </p>
                                    <p>
                                        <a href="<?php echo url::s('admin/member/edit', "id=" . str_replace('=', '@', base64_encode($em['id']))); ?>"
                                           class="btn btn-default btn-xs"><i class="fa fa-edit"></i>更改资料</a></p>
                                    <p><a href="#" onclick="deletec('<?php echo $em['id']; ?>')"
                                          class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>移除会员</a></p>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                    <div style="float:right;">
                        <?php (new model())->load('page', 'turn')->auto($member['info']['pageAll'], $member['info']['page'], 10); ?>
                    </div>
                    <div style="clear: both"></div>

                </div>

            </div>
        </div>
        <!-- End Panel -->


        <!-- Modal -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <form class="form-horizontal" id="from" method="post" action="#">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">添加会员</h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="col-sm-2 control-label form-label">用户名</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-line" name="username"
                                           placeholder="登录用户名">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label form-label">密码</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-line" name="pwd"
                                           placeholder="登录密码">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label form-label">权限组</label>
                                <div class="col-sm-10">
                                    <select class="selectpicker" name="group_id">
                                        <?php foreach ($groups as $gp) { ?>
                                            <option value="<?php echo $gp['id']; ?>"><?php echo $gp['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label form-label">手机号</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-line" name="phone"
                                           placeholder="手机号码">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label form-label">上级ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-line" name="level_id"
                                           placeholder="0">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label form-label">账户余额</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-line" name="balance"
                                           placeholder="0.00">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label form-label">账户金额</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-line" name="money"
                                           placeholder="0.00">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label form-label">是否代理</label>
                                <div class="col-sm-10">
                                    <span style="float:left;width:60px">不是 <input style="width:20px;" type="radio"
                                                                                  class="form-control" name="is_agent"
                                                                                  value="0"></span>
                                    <span style="float:left;width:60px">  是  <input style="width:20px;" type="radio"
                                                                                    class="form-control "
                                                                                    name="is_agent" value="1"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label form-label">是否盘口</label>
                                <div class="col-sm-10">
                                    <span style="float:left;width:60px">不是 <input style="width:20px;" type="radio"
                                                                                  class="form-control" name="is_pankou"
                                                                                  value="0"></span>
                                    <span style="float:left;width:60px">  是  <input style="width:20px;" type="radio"
                                                                                    class="form-control "
                                                                                    name="is_pankou" value="1"></span>
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

        <script type="text/javascript">
            //查询ip归属地
            function ipGet(ip, obj) {
                $.get("<?php echo url::s('admin/employee/ipGet', 'ip=');?>" + ip, function (result) {
                    if (result.code == '200') {
                        $(obj).html(result.data.city);
                    } else {
                        layer.msg("查询失败,请重试", {icon: 2, time: 1000})
                    }

                });
            }

            //复制文本到粘贴板
            function copy(str) {
                var save = function (e) {
                    e.clipboardData.setData('text/plain', str);//下面会说到clipboardData对象
                    e.preventDefault();//阻止默认行为
                }
                document.addEventListener('copy', save);
                document.execCommand("copy");//使文档处于可编辑状态，否则无效
                layer.msg("复制成功！", {icon: 1, time: 1000})
            }

            //添加用户
            function add() {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo url::s('admin/member/add');?>",
                    data: $('#from').serialize(),
                    success: function (data) {
                        console.log(data);
                        if (data.code == '200') {
                            layer.msg(data.msg, {icon:1,time:1000,end:function () {
                                    window.location.reload();
                                }});
                        } else {
                            layer.msg(data.msg, {icon: 2, time: 1000})
                        }
                    },
                    error: function (data) {
                        alert("error:" + data.responseText);
                    }
                });
            }

            //选择头像
            function imgSelect(id) {
                document.getElementById(id).click();
            }

            //上传头像
            function uploadPic(bid, id) {
                var pic = $(bid)[0].files[0];
                var fd = new FormData();
                fd.append('avatar', pic);
                $.ajax({
                    url: "<?php echo url::s('admin/member/avatarUpload', 'id=');?>" + id,
                    type: "post",
                    // Form数据
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.code == '200') {
                            $('#imgCode_' + id).attr('src', '<?php echo str_replace('admin', 'index', URL_VIEW) . '/upload/avatar/';?>' + id + '/' + data.data.img);
                            layer.msg(data.msg, {icon: 1, time: 1000})
                        } else {
                            layer.msg(data.msg, {icon: 2, time: 1000})
                        }
                    }
                });

            }

            function deletec(id) {

                layer.confirm('你确定要删除该会员吗？', function (index) {
                    $.get("<?php echo url::s('admin/member/delete', 'id=');?>" + id, function (result) {

                        if (result.code == '200') {
                            layer.msg(result.msg, {icon:1,time:1000,end:function () {
                                    window.location.reload();
                                }});
                        } else {
                            layer.msg(result.msg, {icon:2,time:1000})
                        }

                    });
                });
            }

            function deletes() {
                layer.confirm('你确定要批量删除已选中的会员吗？', function (index) {
                    $("input[name='items']:checked").each(function () {
                        $.get("<?php echo url::s('admin/member/delete', 'id=');?>" + $(this).val(), function (result) {
                            layer.msg(result.msg, {
                                icon: 1, time: 1000, end: function () {
                                    window.location.reload();
                                }
                            });
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


        <!-- End Moda Code -->


        <!-- Modal -->
        <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <form class="form-horizontal" id="from" method="get"
                      action="<?php echo url::s('admin/member/index'); ?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">搜索用户</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label form-label">关键词</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-line" name="member_id"
                                           placeholder="会员名/手机号">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-default">搜索</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- End Moda Code -->

    </div>
    <!-- End Row -->

</div>

<script>
    function user_query(obj) {
        location.href = "<?php echo url::s('admin/member/index', "member_id=");?>" + $(obj).val();
    }

    $(function () {
        //实现全选与反选
        $("#checkboxAll").click(function () {
            if (this.checked) {
                $("input[name='items']:checkbox").each(function () {
                    $(this).prop("checked", true);
                });
                showBtn();
            } else {
                $("input[name='items']:checkbox").each(function () {
                    $(this).prop("checked", false);
                });
                showBtn();
            }
        });
    });
</script>