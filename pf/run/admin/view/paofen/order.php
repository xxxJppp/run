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
        <li class="active">跑分订单</li>
    </ol>
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
                    交易订单 [ <b>今日收入:</b> <?php //查询今日收入
                    $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');
                    $where_call = "creation_time > {$nowTime} and status=4 and " . $where;
                    $where_call = trim(trim($where_call), 'and');
                    $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_paofen_automatic_orders where {$where_call}");
                    echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  / 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '</span> ';
                    ?>] - [ <b>昨日收入:</b> <?php
                    $zrTime = strtotime(date("Y-m-d", $nowTime - 86400) . ' 00:00:00'); //昨日的时间
                    $where_call = "creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and " . $where;
                    $where_call = trim(trim($where_call), 'and');

                    $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_paofen_automatic_orders where {$where_call}");
                    echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  / 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '</span> ';
                    ?> ] - [ <b>全部收入:</b> <?php
                    $where_call = "status=4 and " . $where;
                    $where_call = trim(trim($where_call), 'and');

                    $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_paofen_automatic_orders where {$where_call}");
                    echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  / 订单数量: <span style="color:green;font-weight:bold;">' . floatval($order[0]['count']) . '</span> ';
                    ?> ]
                </div>
                <div class="panel-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>

                                <input onchange="trade_no(this);" style="width: 80%;" type="text"
                                       class="form-control form-control-line" placeholder="订单号"
                                       value="<?php if ($sorting['name'] == 'trade_no') echo $_GET['code']; ?>">

                            </th>

                            <th>
                                支付信息 <?php if ($sorting['code'] != 0 && $sorting['name'] == 'status') { ?>(<?php if ($sorting['code'] == 1) echo '获取订单中';
                                    if ($sorting['code'] == 2) echo '未支付';
                                    if ($sorting['code'] == 3) echo '订单超时';
                                    if ($sorting['code'] == 4) echo '已支付'; ?>)<?php } ?><a
                                        href='<?php echo url::s('admin/paofen/automaticOrder', "sorting=status&code=" . ($sorting['code'] + 1)); ?>'>
                                    <i class="fa fa-unsorted"></i></a></th>
                            <th>
                                <input onchange="member(this);" style="width: 30%;" type="text"
                                       class="form-control-line" placeholder="商户ID"
                                       value="<?php if ($sorting['name'] == 'user') echo $_GET['code']; ?>"> [ <a
                                        href="<?php echo url::s('admin/paofen/automaticOrder', 'sorting=user&code=&locking=false'); ?>">全部</a>
                                ]
                            </th>
                            <th>
                                异步通知 <?php if ($sorting['code'] != -1 && $sorting['name'] == 'callback') { ?>(<?php if ($_GET['code'] == 0) echo '未回调';
                                    if ($_GET['code'] == 1) echo '已回调'; ?>)<?php } ?><a
                                        href='<?php echo url::s('admin/paofen/automaticOrder', "sorting=callback&code=" . ($sorting['code'] + 1)); ?>'>
                                    <i class="fa fa-unsorted"></i></a></th>
                            <th>回调信息</th>
                            <th>创建时间</th>
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
                                    <button type="button" id="callback" onclick="callback();"
                                            class="btn btn-success btn-xs"
                                            style="display:none;position:relative;top:-8px;"><i
                                                class="fa fa-trash-o"></i>回调
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="7" style="text-align: center;">暂时没有查询到订单!</td></tr>'; ?>

                        <?php foreach ($result['result'] as $ru) { ?>
                            <tr>
                                <td><a target="_blank"
                                       href="<?php echo url::s('gateway/pay/automaticpaofen', "id={$ru['id']}"); ?>"><?php echo $ru['trade_no']; ?> </a>
                                </td>


                                <td>支付金额：<span
                                            style="color: green;"><b><?php echo $ru['amount']; ?></b> <?php echo $ru['callback_status'] == 1 ? " ( 利: " . ($ru['amount'] - $ru['fees']) . " )" : ''; ?></span>
                                    <br>支付状态：<?php
                                    if ($ru['status'] == 1) echo '<span style="color:#039be5;">任务下发中..</span>';
                                    if ($ru['status'] == 2) echo '<span style="color:red;">未支付</span>';
                                    if ($ru['status'] == 3) echo '<span style="color:#bdbdbd;">订单超时</span>';
                                    if ($ru['status'] == 4) echo '<span style="color:green;"><b>已支付</b></span>';
                                    ?><?php if ($ru['status'] == 4) echo ' (' . date("Y/m/d H:i:s", $ru['pay_time']) . ')'; ?>
                                </td>

                                <td>商户信息：<?php $userInfo = $mysql->query("client_user", "id={$ru['user_id']}")[0];
                                    echo is_array($userInfo) ? '<a href="' . url::s("admin/paofen/automaticOrder", "sorting=user&code={$userInfo[id]}&locking=true") . '"><span style="color:green;font-size:14px;font-weight:bold;">' . $userInfo['username'] . '</span></a>' . ' ( 商户ID: ' . $userInfo['id'] . ' ) ' : '<span style="color:red;font-size:8px;">会员不存在</span>'; ?>
                                    <?php
                                    $level_id = $mysql->query('client_user', 'id=' . $ru['user_id'], 'level_id');
                                    ?>
                                    <br> 上级id：<span
                                            style="color:green;font-size:14px;font-weight:bold;"><?php if (isset($level_id[0]['level_id']) || $level_id[0]['level_id'] == 0) { ?>
                                            <a
                                            href="/admin/member/daili.do?id=<?php echo $level_id[0]['level_id']; ?>"><?php echo $level_id[0]['level_id']; ?></a><?php } else {
                                            echo '无';
                                        } ?></span>
                                    <br> 盘口id：<?php echo $ru['pankou_id']; ?>
                                    <br>手机号码：<span
                                            style="color:green;"><?php echo is_array($userInfo) ? $userInfo['phone'] : '无'; ?></span>
                                </td>

                                <td>
                                    <b>异步通知时间：</b> <?php echo $ru['callback_time'] != 0 ? date('Y/m/d H:i:s', $ru['callback_time']) : '无信息'; ?>
                                    <br>
                                    <b>异步通知状态：</b> <?php echo $ru['callback_status'] == 1 ? '<span style="color:green;">已回调</span>' : '<span style="color:red;">未回调</span>'; ?>
                                    <br>
                                </td>

                                <td>单笔接口费用：<?php echo $ru['callback_status'] == 1 ? $ru['fees'] : '暂无信息'; ?>
                                    <br>接口返回信息：<span
                                            style="color:green;"><?php echo $ru['callback_status'] == 1 ? htmlspecialchars($ru['callback_content']) : '未回调'; ?></span>

                                <td><?php echo date('Y/m/d H:i:s', $ru['creation_time']); ?></td>

                                <td>
                                    <p style="margin-top: -15px;">
                                    <div class="checkbox checkbox-danger checkbox-circle">
                                        <input onclick="showBtn()" name="items" value="<?php echo $ru['id']; ?>"
                                               id="checkbox<?php echo $ru['id']; ?>" type="checkbox">
                                        <label for="checkbox<?php echo $ru['id']; ?>">
                                            勾选订单!
                                        </label>
                                    </div>
                                    </p>
                                    <p><a href="#" onclick="del('<?php echo $ru['id']; ?>')"
                                          class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>移除该订单</a></p>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                    <div style="float:right;">
                        <?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 10); ?>
                    </div>
                    <div style="clear: both"></div>

                </div>

            </div>
        </div>
        <!-- End Panel -->

        <script type="text/javascript">

            function reissue(id) {
                layer.confirm('手动补发也是需要扣除手续费,您是否要继续?', function (index) {
                    $.get("<?php echo url::s('admin/paofen/automaticReissue', "id=");?>" + id, function (result) {

                        if (result.code == '200') {
                            layer.msg(result.msg, {
                                icon: 1, time: 1000, end: function () {
                                    window.location.reload();
                                }
                            });
                        } else {
                            layer.msg(result.msg, {icon: 2, time: 1000})
                        }

                    });
                });
            }

            function trade_no(obj) {
                location.href = "<?php echo url::s('admin/paofen/automaticOrder', "sorting=trade_no&code=");?>" + $(obj).val();
            }

            function member(obj) {
                location.href = "<?php echo url::s('admin/paofen/automaticOrder', "sorting=user&locking=true&code=");?>" + $(obj).val();
            }

            function wechat() {
                var wechat = $('#wechat').val();
                location.href = "<?php echo url::s('admin/paofen/automaticOrder', "sorting=paofen&code=");?>" + wechat;

            }

            function del(id) {
                layer.confirm('你确定要删除该订单吗？', function (index) {
                    $.get("<?php echo url::s('admin/paofen/automaticOrderDelete', 'id=');?>" + id, function (result) {

                        if (result.code == '200') {
                            layer.msg(result.msg, {
                                icon: 1, time: 1000, end: function () {
                                    window.location.reload();
                                }
                            });
                        } else {
                            layer.msg(result.msg, {icon: 2, time: 1000})
                        }

                    });
                });
            }


            function deletes() {
                layer.confirm('你确定要批量删除已选中的订单吗？', function (index) {
                    $("input[name='items']:checked").each(function () {
                        $.get("<?php echo url::s('admin/paofen/automaticOrderDelete', 'id=');?>" + $(this).val(), function (result) {
                            if (result.code != '200') {
                                layer.msg(result.msg, {icon: 2, time: 1000})
                                return;
                            }
                        });
                    });
                    layer.msg("删除成功", {
                        icon: 1, time: 1000, end: function () {
                            window.location.reload();
                        }
                    });
                });
            }


            function callback() {
                layer.confirm('你确定你要以管理员的方式回调已勾选过的订单？', function (index) {
                    $("input[name='items']:checked").each(function () {
                        $("input[name='items']:checked").each(function () {
                            $.get("<?php echo url::s('admin/paofen/callback', 'id=');?>" + $(this).val(), function (result) {
                                layer.msg("当前操作已经执行完毕!", {
                                    icon: 1, time: 1000, end: function () {
                                        window.location.reload();
                                    }
                                });
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
                        $('#callback').show();
                        return true;
                    }
                    Inc++;
                });
                if ($("input[name='items']:checkbox").length == Inc) {
                    $('#deletes').hide();
                    $('#callback').hide();
                }
            }

        </script>


        <!-- End Moda Code -->


    </div>
    <!-- End Row -->

</div>
<!-- END CONTAINER -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
