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
                       
                        <li><a href="#">支付宝</a></li>
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
                <a href="<?php echo url::s("index/lakala/automatic"); ?>" style="font-size: 14px;" class="btn waves-effect waves-light  cyan darken-2"><i class="mdi-editor-border-all left" style="width: 10px;"></i>无匹配订单列表</a>
            </p>


            <!--Striped Table-->
            <div id="striped-table">

                <div class="row">

                    <div class="col s12 m12 l12">
                        <table class="striped" style="font-size: 14px;">
                            <thead>
                            <tr>
                                <th>

                                    <div class="input-field col s6" style="font-weight:normal;width:100%;">
                                        <select multiple id="alipay">
                                            <option value="" disabled selected>选择银行卡账号</option>
                                            <?php foreach ($wechat as $wx) { ?>
                                                <option value="<?php echo $wx['id']; ?>"><?php echo $wx['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <label>选择通道来查看<?php if ($_SESSION['ALIPAY']['ORDER']['WHERE'] == '') { ?>(<a
                                                    href="#" onclick="alipay();">开始查询</a>)<?php } else { ?>(<a
                                                    href="<?php echo url::s('index/lakala/automaticOrder', "sorting=alipay&locking=closed"); ?>">取消锁定</a>)<?php } ?>
                                        </label>
                                    </div>

                                </th>
                                <th>

                                        订单号
                                </th>
                                <th>
                                    支付信息 <?php if ($sorting['code'] != 0 && $sorting['name'] == 'status') { ?>(<?php if ($sorting['code'] == 1) echo '获取订单中';
                                        if ($sorting['code'] == 2) echo '未支付';
                                        if ($sorting['code'] == 3) echo '订单超时';
                                        if ($sorting['code'] == 4) echo '已支付'; ?>)<?php } ?><a
                                            href='<?php echo url::s('index/lakala/automaticOrder', "sorting=status&code=" . ($sorting['code'] + 1)); ?>'><i
                                                class="mdi-image-healing"></i></a></th>

                                <th>
                                    异步通知 <?php if ($sorting['code'] != -1 && $sorting['name'] == 'callback') { ?>(<?php if ($_GET['code'] == 0) echo '未回调';
                                        if ($_GET['code'] == 1) echo '已回调'; ?>)<?php } ?><a
                                            href='<?php echo url::s('index/lakala/automaticOrder', "sorting=callback&code=" . ($sorting['code'] + 1)); ?>'><i
                                                class="mdi-image-healing"></i></a></th>
                                <th>回调信息</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if (!is_array($result)) echo '<tr><td colspan="5" style="text-align: center;">暂时没有查询到订单!</td></tr>'; ?>

                            <?php foreach ($result as $k=>$ru) { ?>
                                <tr>
                                    <td>银行卡账号：<a href='<?php echo url::s("index/lakala/automatic"); ?>'><?php echo $ru['lakala_acount']; ?></a></td>

                                    <td>支付金额：<?php echo $ru['amount_true']; ?></td>

                                    <td>时间：<?php echo date('Y-m-d H:i:s',$ru['time']); ?></td>

                                    <td>
                                        <b>异步通知时间：</b> <?php echo $ru['pay_time'] != 0 ? date('Y/m/d H:i:s', $ru['pay_time']) : '无信息'; ?>
                                        <br>
                                        <b>异步通知状态：</b> <?php echo $ru['status'] == 1 ? '<span style="color:green;">已回调</span>' : '<span style="color:red;">未回调</span>'; ?>
                                        <br>
                                    </td>
                                    <td>单笔接口费用：<?php echo $ru['status'] == 1 ? $ru['fees'] : '暂无信息';?></td>

                            </span>


                                    <td>
                                        <?php if($ru['status'] == 1){?>
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
                //开始请求支付宝登录
                $.get("<?php echo url::s('index/lakala/notOrderReissue', "id=");?>" + id, function (result) {
                    if (result.code == '200') {
                        swal("支付宝提示", result.msg, "success");
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
        location.href = "<?php echo url::s('index/lakala/notOrder', "sorting=trade_no&code=");?>" + $(obj).val();
    }

    function alipay() {
        var alipay = $('#alipay').val();
        location.href = "<?php echo url::s('index/lakala/notOrder', "sorting=alipay&code=");?>" + alipay;

    }


</script>
<?php include_once(PATH_VIEW . 'common/footer.php'); ?>
   