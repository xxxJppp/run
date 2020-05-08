<?php
use xh\library\url;
use xh\library\model;

$fix = DB_PREFIX;
?>
<?php include_once(PATH_VIEW . 'common/header.php'); ?>
<!-- START CONTENT -->
<section id="content">

    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper">
        <!-- Search for small screen -->
        <div class="header-search-wrapper grey hide-on-large-only">
            <i class="mdi-action-search active"></i>
            <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
        </div>
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title">Automatic <?php echo SYSTEM_VERSION; ?></h5>
                    <ol class="breadcrumbs">
                        <li><a href="#">农信易扫</a></li>
                        <li class="active">Automatic-订单列表</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->
    <!--start container-->
    <div class="container">
        <div class="section">

            <p class="caption">
                <a href="<?php echo url::s("index/nxys/automatic"); ?>" style="font-size: 14px;"
                   class="btn waves-effect waves-light  cyan darken-2"><i class="mdi-editor-border-all left"
                                                                          style="width: 10px;"></i>农信易扫列表</a>
                <a href="#" style="font-size: 14px;" class="btn waves-effect waves-light  cyan darken-2"
                   onclick="resetOrder();">
                    <i class="mdi-editor-border-all left" style="width: 10px;"></i>
                    批量补单
                </a>
                <script>

                    function resetOrder() {
                        layer.prompt({title: "使用,号分割订单号，如1132,5523,3312", formType: 2,area: ['400px', '200px']}, function (text, index) {
                            $.ajax({
                                async : false,
                                cache : false,
                                type : 'POST',
                                url : 'resetOrder',
                                data:{order_ids:text},
                                beforeSend:function(){
                                    layer.msg('补单中，请耐心等候', {
                                        icon: 16
                                        ,shade: 0.2
                                    });
                                },
                                error : function() {
                                    layer.msg('网络错误');
                                    setTimeout(function(){
                                        //location.reload();
                                    }, 2000);
                                },
                                success : function(data) {
                                    layer.close(index);
                                    console.log(data);
                                    layer.msg(data.msg, {time: 100000} );
                                    setTimeout(function(){
                                        location.reload();
                                    }, 10000);
                                }
                            });



                        });
                    }

                </script>
                <span style="font-size: 15px;margin-left:20px;">[ <b>今日收入:</b> <?php //查询今日收入
                    $nowTime = strtotime(date("Y-m-d", time()) . ' 00:00:00');
                    $where_call = "creation_time > {$nowTime} and status=4 and " . $where;
                    $where_call = trim(trim($where_call), 'and');
                    $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_nxys_automatic_orders where {$where_call}");
                    echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  / 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '</span> ';
                    ?>] - [ <b>昨日收入:</b> <?php
                    $zrTime = strtotime(date("Y-m-d", $nowTime - 86400) . ' 00:00:00'); //昨日的时间
                    $where_call = "creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and " . $where;
                    $where_call = trim(trim($where_call), 'and');


                    $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_nxys_automatic_orders where {$where_call}");
                    echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  / 订单数量: <span style="color:green;font-weight:bold;">' . intval($order[0]['count']) . '</span> ';
                    ?> ] - [ <b>全部收入:</b> <?php
                    $where_call = "status=4 and " . $where;
                    $where_call = trim(trim($where_call), 'and');

                    $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_nxys_automatic_orders where {$where_call}");
                    echo '<span style="color:red;font-weight:bold;"> ' . floatval($order[0]['money']) . ' </span> / 手续费: <span style="color:blue;">' . number_format($order[0]['fees'], 3) . '</span>  / 订单数量: <span style="color:green;font-weight:bold;">' . floatval($order[0]['count']) . '</span> ';
                    ?>
                    ] <?php if ($sorting['name'] == 'user' && $_GET['code'] != '' && $_SESSION['ALIPAY']['WHERE'] == '') { ?> [
                        <a href="<?php echo url::s("admin/nxys/automaticOrder", "sorting=user&code={$_GET['code']}&locking=true"); ?>"
                           style="color: green;">锁定该用户查询</a> ]<?php } ?> <?php if ($_SESSION['ALIPAY']['WHERE'] != '') { ?>  [
                        <a href="<?php echo url::s("admin/nxys/automaticOrder", "sorting=user&code={$_GET['code']}&locking=false"); ?>"
                           style="color: red;">查询全部</a> ] <?php } ?></span>
            </p>


            <!--Striped Table-->
            <div id="striped-table">

                <div class="row">

                    <div class="col s12 m12 l12">
                        <table class="striped" style="font-size: 14px;">
                            <thead>
                            <tr>
                                <form action="" method="get">
                                    <th>开始时间: <input type="" style="width:160px" name="start_time" id="start_time" value="<?php if(!empty($_GET['start_time'])){  echo $_GET['start_time']; }  ?>"></th>
                                    <th>结束时间： <input type="" style="width:160px" name="end_time" id="end_time" value="<?php if(!empty($_GET['end_time'])){  echo $_GET['end_time']; } ?>"></th>
                                    <th>金额: <input type="text" name="money" style="width:110px;height: 35px" value="<?php if(!empty($_GET['money'])){  echo $_GET['money']; }?>"></th>
                                    <input type="hidden" name="sorting" value="money">
                                    <th><input style="
                                                    background-color: #4CAF50; /* Green */
                        border: none;
                        color: white;
                        padding: 10px 10px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        line-height: 14px;
                        font-size: 14px;" type="submit" value="查询"></th>
                                </form>
                            </tr>
                            <tr>
                                <th>

                                    <div class="input-field col s6" style="font-weight:normal;width:100%;">
                                        <select multiple id="alipay">
                                            <option value="" disabled selected>选择农信易扫账号</option>
                                            <?php foreach ($wechat as $wx) { ?>
                                                <option value="<?php echo $wx['id']; ?>"><?php echo $wx['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label>选择通道来查看<?php if ($_SESSION['ALIPAY']['ORDER']['WHERE'] == '') { ?>(<a
                                                    href="#" onclick="alipay();">开始查询</a>)<?php } else { ?>(<a
                                                    href="<?php echo url::s('index/nxys/automaticOrder', "sorting=alipay&locking=closed"); ?>">取消锁定</a>)<?php } ?>
                                        </label>
                                    </div>

                                </th>
                                <th>
                                    <div class="input-field col s12"><input onchange="trade_no(this);" id="last_name"
                                                                            type="text" class="validate"
                                                                            value="<?php if ($sorting['name'] == 'trade_no') echo $_GET['code']; ?>">
                                        <label for="last_name">订单号</label></div>
                                </th>
                                <th>
                                    支付信息 <?php if ($sorting['code'] != 0 && $sorting['name'] == 'status') { ?>(<?php if ($sorting['code'] == 1) echo '获取订单中';
                                        if ($sorting['code'] == 2) echo '未支付';
                                        if ($sorting['code'] == 3) echo '订单超时';
                                        if ($sorting['code'] == 4) echo '已支付'; ?>)<?php } ?><a
                                            href='<?php echo url::s('index/nxys/automaticOrder', "sorting=status&code=" . ($sorting['code'] + 1)); ?>'><i
                                                class="mdi-image-healing"></i></a></th>

                                <th>
                                    异步通知 <?php if ($sorting['code'] != -1 && $sorting['name'] == 'callback') { ?>(<?php if ($_GET['code'] == 0) echo '未回调';
                                        if ($_GET['code'] == 1) echo '已回调'; ?>)<?php } ?><a
                                            href='<?php echo url::s('index/nxys/automaticOrder', "sorting=callback&code=" . ($sorting['code'] + 1)); ?>'><i
                                                class="mdi-image-healing"></i></a></th>
                                <th>回调发送次数</th>
                                <th>回调来源</th>
                                <th>回调信息</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="5" style="text-align: center;">暂时没有查询到订单!</td></tr>'; ?>

                            <?php foreach ($result['result'] as $ru) { ?>
                                <tr>
                                    <td>农信易扫账号ID：<a
                                                href='<?php echo url::s("index/nxys/automatic"); ?>'><?php echo $ru['nxys_id']; ?></a>
                                        <br/> 订单ID：<?php echo $ru['id']; ?> ( <a target="_blank"
                                                                                 href="<?php echo url::s('gateway/pay/automaticAlipay', "id={$ru['id']}"); ?>">支付链接</a>
                                        )

                                    </td>

                                    <td>订单号码：<?php echo $ru['out_trade_no']; ?>
                                      </br>
                              系统订单号码：<?php echo $ru['trade_no']; ?>
                                        <br>订单信息：<span style="color:green;">
                            <?php echo $ru['nxys_id']; ?> | <?php echo $ru['id']; ?> </span>
                                        <br>创建时间：<?php echo date('Y/m/d H:i:s', $ru['creation_time']); ?>

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

                                    <td>
                                        <b>异步通知时间：</b> <?php echo $ru['callback_time'] != 0 ? date('Y/m/d H:i:s', $ru['callback_time']) : '无信息'; ?>
                                        <br>
                                        <b>异步通知状态：</b> <?php echo $ru['callback_status'] == 1 ? '<span style="color:green;">已回调</span>' : '<span style="color:red;">未回调</span>'; ?>
                                        <br>
                                    </td>
                                    <td><?php echo $ru['callback_count']; ?></td>
                                    <td><?php echo $ru['callback_from']; ?></td>
                                    <td>单笔接口费用：<?php echo $ru['callback_status'] == 1 ? $ru['fees'] : '暂无信息'; ?>
                                        <br>
                                        接口返回信息：<span
                                                style="color:green;"><?php echo $ru['callback_status'] == 1 ? htmlspecialchars($ru['callback_content']) : '未回调'; ?>
                                            <br>

                            </span>


                                    <td>
                                        <?php if($ru['callback_status'] == 1){?>
                                            <span style="color:green;"> 已补发</span>
                                        <?php }else{?>
                                            <a onclick="reissue('<?php echo $ru['id']; ?>');" style="font-size: 14px;"
                                               class="btn waves-effect waves-light indigo"><i
                                                        class="mdi-action-lock-open left" style="width: 10px;"></i>手动补发</a>
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <ul class="pagination"><?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 10); ?></ul>
                </div>

            </div>


        </div>


    </div>
    <!--end container-->

</section>
<script type="text/javascript" src="<?php echo URL_ROOT;?>/static/js/laydate/laydate.js"></script>
<!-- END CONTENT -->
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
                //开始请求农信易扫登录
                $.get("<?php echo url::s('index/nxys/automaticReissue', "id=");?>" + id, function (result) {
                    if (result.code == '200') {
                        swal("农信易扫提示", result.msg, "success");
                        setTimeout(function () {
                            location.href = '';
                        }, 1000);
                    } else {
                        swal("订单通知", result.msg, "error");
                    }
                });

            });
    }

    laydate.render({
        elem: '#start_time',
        type: 'datetime'
        ,done: function(value, date, endDate){
            console.log(value); //得到日期生成的值，如：2017-08-18
            console.log(date); //得到日期时间对象：{year: 2017, month: 8, date: 18, hours: 0, minutes: 0, seconds: 0}
            console.log(endDate); //得结束的日期时间对象，开启范围选择（range: true）才会返回。对象成员同上。
        }
    });
    laydate.render({
        elem: '#end_time',
        type: 'datetime'
        ,done: function(value, date, endDate){
            console.log(value); //得到日期生成的值，如：2017-08-18
            console.log(date); //得到日期时间对象：{year: 2017, month: 8, date: 18, hours: 0, minutes: 0, seconds: 0}
            console.log(endDate); //得结束的日期时间对象，开启范围选择（range: true）才会返回。对象成员同上。
        }
    });

    function trade_no(obj) {
        location.href = "<?php echo url::s('index/nxys/automaticOrder', "sorting=trade_no&code=");?>" + $(obj).val();
    }

    function alipay() {
        var alipay = $('#alipay').val();
        location.href = "<?php echo url::s('index/nxys/automaticOrder', "sorting=alipay&code=");?>" + alipay;

    }


</script>
<?php include_once(PATH_VIEW . 'common/footer.php'); ?>
   