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
            <div class="col-md-15">
                <div class="panel panel-default">
                    <div class="panel-title">
                        交易订单 [ <b>统计:</b> <?php //查询今日收入
                        $where_call =  $where;
                        $where_call = trim(trim($where_call), 'and');
                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_paofen_automatic_orders where {$where_call}");
                        echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  / 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '</span> ';
                        ?>]
                    </div>

                    <style>
                        input {
                            width: 80px;
                        }
                    </style>
                    <div class="panel-body table-responsive">
                        <table>  <tr>
                                <form action="" method="get">
                                    <th>开始时间: <input type="date" style="width:150px" name="start_time" value="<?php if(!empty($_GET['start_time'])){  echo $_GET['start_time']; }  ?>"></th>
                                    <th>结束时间： <input type="date" style="width:150px" name="end_time" value="<?php if(!empty($_GET['end_time'])){  echo $_GET['end_time']; } ?>"></th>
                                    <th>跑分ID：<input type="text" name="paofen_id" value="<?php if(!empty($_GET['paofen_id'])){  echo $_GET['paofen_id']; }?>"></th>
                                    <th>商户ID: <input type="text" name="user_id" value="<?php if(!empty($_GET['user_id'])){  echo $_GET['user_id']; }?>"></th>
                                    <th>支付状态
                                        <select name="status">
                                            <option value="0" <?php if($_GET['status'] != 4){ echo 'selected';} ?>>全部</option>
                                            <option value="4" <?php if($_GET['status'] == 4){ echo 'selected';} ?>>已支付</option>
                                        </select>
                                    </th>
                                    <th><input type="submit" value="查询"></th>
                                </form>
                            </table>
                        <table class="table table-hover" style="width:  1600px;">
                            <thead>
                            <tr>
                                <button style="
                                background-color: #4CAF50; /* Green */border: none;color: white;padding: 10px 12px;text-align: center;text-decoration: none;
display: inline-block;
    font-size: 14px;" onclick="exportDoc()">导出表格</button>
                            </tr>

                            <tr>
                                <th style="color: black">订单号</th>

                                <th style="color: black">跑分ID</th>
                                <th style="color: black">商户ID</th>

                                <th style="color: black">支付金额（利）</th>


                                <th style="color: black">商户名</th>
                                <th style="color: black">盘口ID</th>
                                <th style="color: black">上级ID</th>
                                <th style="color: black">手机号码</th>

                                <th style="color: black">支付状态</th>
                                <th style="color: black">异步通知时间</th>
                                <th style="color: black">异步通知状态</th>

                                <th style="color: black">单笔接口费用</th>
                                <th style="color: black">接口返回</th>

                                <th style="color: black">创建时间</th>
                                <th style="color: black">支付时间</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="7" style="text-align: center;">暂时没有查询到订单!</td></tr>'; ?>

                            <?php foreach ($result['result'] as $ru) { ?>

                                    <td><?php echo $ru['trade_no']; ?></td>

                                    <td><a href='<?php echo url::s("admin/paofen/automatic", "id={$ru['paofen_id']}"); ?>'><?php echo $ru['paofen_id']; ?></a></td>

                                    <td><?php echo $userInfo['id'];?></td>

                                    <td><span style="color: green;"><b><?php echo $ru['amount']; ?></b> <?php echo $ru['callback_status'] == 1 ? " ( " . ($ru['amount'] - $ru['fees']) . " )" : ''; ?></span></td>

                                    <td><?php
                                        $userInfo = $mysql->query("client_user", "id={$ru['user_id']}")[0];
                                        $level_id = $mysql->query('client_user','id='.$ru['pankou_id'],'level_id');
                                        echo is_array($userInfo) ? '<a href="' . url::s("admin/paofen/automaticOrder", "sorting=user&code={$userInfo[id]}&locking=true") . '"><span style="color:green;font-size:14px;font-weight:bold;">' . $userInfo['username'] . '</span></a>' : '<span style="color:red;font-size:8px;">会员不存在</span>'; ?>
                                    </td>

                                    <td><?php echo $ru['pankou_id']; ?></td>

                                    <td>
                                        <?php
                                        $level_id = $mysql->query('client_user','id='.$ru['user_id'],'level_id'); ?><span style="color:green;font-size:14px;font-weight:bold;"><?php if(isset($level_id[0]['level_id']) || $level_id[0]['level_id']==0){?><a href="/admin/member/daili.do?id=<?php echo $level_id[0]['level_id'];?>"><?php echo $level_id[0]['level_id'];?></a><?php }else{echo '无';}?></span>
                                    </td>

                                    <td><span style="color:green;"><?php echo is_array($userInfo) ? $userInfo['phone'] : '无'; ?></span></td>
                                    <td><?php
                                        if ($ru['status'] == 1) echo '<span style="color:#039be5;">任务下发中..</span>';
                                        if ($ru['status'] == 2) echo '<span style="color:red;">未支付</span>';
                                        if ($ru['status'] == 3) echo '<span style="color:#bdbdbd;">订单超时</span>';
                                        if ($ru['status'] == 4) echo '<span style="color:green;"><b>已支付</b></span>';
                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $ru['callback_time'] != 0 ? date('Y/m/d H:i:s', $ru['callback_time']) : '无'; ?></td>


                                    <td>
                                        <?php echo $ru['callback_status'] == 1 ? '<span style="color:green;">已</span>' : '<span style="color:red;">未</span>'; ?>
                                    </td>

                                    <td><?php echo $ru['callback_status'] == 1 ? $ru['fees'] : '0.000'; ?></td>

                                    <td><span style="color:green;"><?php echo $ru['callback_status'] == 1 ? '成功' : '失败'; ?></span></td>

                                    <td><?php echo date('Y/m/d H:i:s', $ru['creation_time']); ?></td>
                                    <td><?php echo $ru['status'] == 4?date("Y/m/d H:i:s", $ru['pay_time']):"无"; ?></td>


                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>



                    </div>
                    <div style="float:right;">
                        <?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 10); ?>
                    </div>
                    <div style="clear: both"></div>

                </div>
            </div>
            <!-- End Panel -->


            <script type="text/javascript">

                function reissue(id) {
                    swal({
                            title: "订单通知",
                            text: "手动补发也是需要扣除手续费,您是否要继续?",
                            type: "info", showCancelButton: true,
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true,
                            confirmButtonText: "是的,我愿意承担手续费!"
                        },
                        function () {
                            //开始请求跑分登录
                            $.get("<?php echo url::s('admin/paofen/automaticReissue', "id=");?>" + id, function (result) {
                                if (result.code == '200') {
                                    swal("跑分提示", result.msg, "success");
                                    setTimeout(function () {
                                        location.href = '';
                                    }, 1000);
                                } else {
                                    swal("订单通知", result.msg, "error");
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
                    console.log(wechat);
                    location.href = "<?php echo url::s('admin/paofen/automaticOrder', "sorting=paofen&code=");?>" + wechat;

                }

                function exportDoc () {
                    var paofen_id = GetQueryString('paofen_id');
                    var user_id = GetQueryString('user_id');
                    var status = GetQueryString('status');
                    var start_time = GetQueryString('start_time');
                    var end_time = GetQueryString('end_time');
                    location.href = "<?php echo url::s('admin/paofen/export', "user_id=");?>" + user_id+ '&start_time='+start_time + '&end_time=' + end_time + '&status=' + status + 'paofen_id=' + paofen_id;
                }
                function GetQueryString(name)
                {
                    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                    var r = window.location.search.substr(1).match(reg);
                    if(r!=null)return  unescape(r[2]); return null;
                }
                function del(id) {
                    swal({
                            title: "跑分提醒",
                            text: "你确定要删除该订单吗？",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "是的,我要删除该订单!",
                            closeOnConfirm: false
                        },
                        function () {
                            $.get("<?php echo url::s('admin/paofen/automaticOrderDelete', 'id=');?>" + id, function (result) {

                                if (result.code == '200') {
                                    swal("操作提示", result.msg, "success");
                                    setTimeout(function () {
                                        location.href = '';
                                    }, 1500);
                                } else {
                                    swal("操作提示", result.msg, "error");
                                }
                            });


                        });
                }


                function deletes() {
                    swal({
                            title: "非常危险",
                            text: "你确定要批量删除已选中的订单吗？",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "是的,我要删除这些订单!",
                            closeOnConfirm: false
                        },
                        function () {
                            $("input[name='items']:checked").each(function () {
                                $.get("<?php echo url::s('admin/paofen/automaticOrderDelete', 'id=');?>" + $(this).val(), function (result) {
                                    swal("操作提示", '当前操作已经执行完毕!', "success");
                                    setTimeout(function () {
                                        location.href = '';
                                    }, 1500);
                                });
                            });

                        });

                }


                function callback() {
                    swal({
                            title: "危险操作",
                            text: "你确定你要以管理员的方式回调已勾选过的订单？",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "是的,我要帮助这些订单回调!",
                            closeOnConfirm: false
                        },
                        function () {
                            $("input[name='items']:checked").each(function () {
                                $.get("<?php echo url::s('admin/paofen/callback', 'id=');?>" + $(this).val(), function (result) {
                                    swal("操作提示", '当前操作已经执行完毕!', "success");
                                    setTimeout(function () {
                                        location.href = '';
                                    }, 1000);
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

    <?php include_once(PATH_VIEW . 'common/footer.php'); ?>

</div>
<!-- End Content -->