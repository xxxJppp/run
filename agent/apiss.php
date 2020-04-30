<?php

define('ACC', TRUE);
define('DEBUG', TRUE);
include('./sys/init.php');

(!isset($_POST['shid']) || empty($_POST['shid'])) && jump('-1', '商户账号不能为空');
(!isset($_POST['url']) || empty($_POST['url']))  && jump('-1', '商户回调地址不能为空');
(!isset($_POST['key']) || empty($_POST['key'])) && jump('-1', '商户秘钥不能为空');
(!isset($_POST['orderid']) || empty($_POST['orderid'])) && jump('-1', '订单号不能为空');
(!isset($_POST['amount']) || empty($_POST['amount'])) && jump('-1', '金额不能为空并且不能为0');


$info = $mysql->select('ysk_agent', '*', 'names=' . "'{$_POST['shid']}'");

if (empty($info) || $info['key'] != $_POST['key']) {
    jump('-1', '效验失败商户账号不正确');
}

$mysql->delete('ysk_roborder', 'status = 1 and ip=' . "'{$_SERVER['REMOTE_ADDR']}'");

if ($_POST['pay'] == 'wx') {

    $img = './demo/images/logo-wxpay.png';

    $title = '微信支付';

    $wxid = 1;
    $class = 'logo wechat';
} else if ($_POST['pay'] == 'zfb') {

    $img = './demo/public/images/logo-wxpay.png';

    $title = '支付宝支付';

    $wxid = 2;

    $class = 'logo alipay';


} else if ($_POST['pay'] == 'yl') {

    $img = './demo/images/logo-wxpay.png';

    $title = '银联支付';
    $wxid = 3;
} else {

    $img = './demo/images/logo-wxpay.png';

    $title = '支付宝支付';

    $class = 'logo alipay';

    $wxid = 2;
}

$check = $mysql->select('ysk_roborder', '*', 'ordernum=' . "'{$_POST['orderid']}'");

if (empty($check)) {
    $p['class'] = $wxid;
    $p['price'] = $_POST['amount'];
    $p['addtime'] = time();
    $p['status'] = 1;
    $p['shanghu_name'] = $_POST['shid'];
    $p['ordernum'] = $_POST['orderid'];
    $p['notify_url'] = $_POST['url'];
    $p['ip'] = $_SERVER['REMOTE_ADDR'];
    $mysql->insert('ysk_roborder', $p);
}

$id = $mysql->insert_id();
$m = $_POST['amount'];
$oid = $_POST['orderid'];

$listss = $mysql->select_all('ysk_roborder', '*', 'status = 1');

foreach ($listss as $k => $v) {

    $a = $v['addtime'];
    $sheng = time() - $a;
    if ($sheng > 50) {

        $mysql->delete('ysk_roborder', 'id=' . $v['id']);
    }
}
?>













<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title>
        收银台
    </title>
    <link rel="stylesheet" href="./demo/css/bootstrap.min.css">
</head>
<style>
    li {
        list-style: none;
    }

    .iap_new img {
        margin-left: 8px;
        float: right;
        margin-top: 1px;
    }

    .list-inline > li {
        margin: 5px;
        padding: 5px;
        width: 300px;
        position: relative;
        font-size: 1.2em;
    }
    h1 {

        font-family: "微软雅黑";

        font-size: 40px;

        margin: 20px 0;

        border-bottom: solid 1px #ccc;

        padding-bottom: 20px;

        letter-spacing: 2px;

    }

    .time-item strong {

        background: #C71C60;
        color: #fff;
        line-height: 49px;
        font-size: 30px;
        font-family: Arial;
        padding: 0 10px;
        margin-right: 2px;
        border-radius: 5px;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);

    }

    #day_show {

        float: left;

        line-height: 49px;

        color: #c71c60;

        font-size: 32px;

        margin: 0 10px;

        font-family: Arial, Helvetica, sans-serif;

    }
</style>
<script src="./public/ui/layer.js"></script>
<script src="./public/ui/layui/layui.all.js" charset="utf-8"></script>
<body style="background-color: #ecedf2;">
<div class="container" style="background-color:#fff;padding:15px; margin-top: 15px;">
    <div class="row">
        <!--交易信息-->
        <div class="col-md-12">
            <ul class="list-inline">
                <li>
                    <strong>
                        订单金额：
                        <span class="text-danger">
                                    <?php echo $_REQUEST['amount']; ?>
                                </span>
                        &nbsp;&nbsp;元
                    </strong>
                </li>
                <li>
                    <strong>
                        商品名称：
                    </strong>
                    在线支付
                </li>
                <li>
                    <strong>
                        订单编号：
                    </strong>
                    <?php echo $_REQUEST['orderid']; ?>
                </li>
                <li>
                    <strong>
                        交易币种：
                    </strong>
                    人民币
                </li>
                <li>
                    <strong>
                        交易时间：
                    </strong>
                    <?=date('Y-m-d H:i:s')?>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <!--交易信息-->
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#weixin" aria-controls="weixin" role="tab" data-toggle="tab">
                        <?=$title?>
                    </a>
                </li>
            </ul>
            <form action="" autocomplete="off" role="form" method="post">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="weixin">
                        <div>
                            <h4 style="    font-weight: 700;">
                                请截图保存相册并输入相同金额进行付款，二维码仅用一次。请勿重复充值！
                            </h4>
                        </div>
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td width="100%" align="center">
                                    <table border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td align="center">
                                                <br>
                                                扫一扫付款（元）
                                            </td>
                                        </tr>
                                        <tr align="center">
                                            <td height="20">
                                                <strong>
                                                    <font style="font-size:30px; color:#F60;">
                                                        <?=$_REQUEST['amount']?>
                                                    </font>
                                                    &nbsp;&nbsp;
                                                </strong>
                                            </td>
                                        </tr>

                                        <tr align="center">
                                            <td>
                                                <table width="100%" border="0" cellspacing="5" cellpadding="0"
                                                       style="border: 1px solid #E7EAEC; ">
                                                    <tbody>
                                                    <tr>
                                                        <td align="center" id="loding" style="display: none">
                                                            <img id="je" src="<?=$erwei['ewm_url']?>"
                                                                 height="230">
                                                        </td>
                                                        <td align="center" id="lodings"
                                                            style="height: 135px;padding: 7px;">
                                                            <div class="time-item">
                                                                                    <span style="display: none">
                                                                                    <span id="day_show">0天</span>
                                                                                    <strong id="hour_show">0时</strong>
                                                                                    <strong id="minute_show">0分</strong>
                                                                                    </span>
                                                                <strong>
                                                                    正在匹配订单
                                                                </strong>
                                                                <strong id="second_show">300</strong>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table width="100%" border="0" cellspacing="0"
                                                                   cellpadding="0">
                                                                <tbody>
                                                                <tr>
                                                                    <td height="30" align="center">
                                                                        <!-- <img src="/Public/images/saoyisao.png" width="14" height="14">-->
                                                                    </td>
                                                                    <td align="center">
                                                                        <font style="font-size:14px; color:#F60;">
                                                                            <strong>
                                                                                <?=$title?>，<span id="nes"></span>扫一扫付款
                                                                            </strong>
                                                                        </font>
                                                                    </td>


                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>

                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a id="zhifu" style="display: none" href="alipays://">点击支付宝支付</a>
        </div>
    </div>
</div>
<div>
</div>
<!--收银台-->
<script src="./demo/js/jquery.min.js">
</script>
<script src="./demo/js/bootstrap.min.js">
</script>
<script>
    $(document).ready(function () {
        var timeoute = false; //启动及关闭按钮
        function dscd() {
            if (timeoute) return;
            $.ajax({
                type: 'POST',
                url: './jiedan.php?act=select',
                data: {
                    m: '<?=$m?>',
                    order: '<?=$oid?>',
                    class: '<?=$wxid?>',
                    key: '<?=$_POST['key']?>',
                    sh: '<?=$_POST['shid']?>'
                },
                dataType: 'json',
                success: function (str) {
                    if (str.error == 0) {
                        $("#lodings").hide();
                        $("#loding").show();
                        $("#je").attr("src", str.msg);
                        if (str.qrurl) {

                            $("#zhifu").show();

                            $("#zhifu").attr('href', 'alipays://platformapi/startapp?appId=20000067&url=' + str.qrurl);

                        }
                        $("#nes").text('收款人:' + str.n);
                        var intDiff = parseInt(1800);//倒计时总秒数量
                        $("#second_show").text(intDiff);
                    } else if (str.error == 4) {
                        alert('此订单已失效，请重新发起支付');
                        location.href = 'pay_true.php';
                    } else if (str.error == 3) {

                        $.ajax({
                            type: 'POST',
                            url: '<?=$_POST['url']?>',
                            data: {m: str.price, order: str.time, md5key: str.md5key, status: str.error},
                            dataType: 'json',
                            success: function (n) {
                                if (n.error == 3) {
                                    //alert('尊敬的用户：'+str.name+' 已确认订单号:'+str.time+',充值成功 '+str.price + '元');
                                    alert('已确认订单号:' + n.time + ',充值成功 ' + n.price + '元');
                                    location.href = 'pay_true.php';
                                    /*
                                    layer.alert(msg, {
                                                    skin: 'layui-layer-lan'
                                                    ,closeBtn: 0
                                                    ,anim: 4 //动画类型
                                                  }); */

                                    //	location.href=n.back_url;
                                } else {

                                    alert('失败订单号:' + n.time + ',失败 ' + n.price + '元');
                                }

                            }
                        });
                        timeoute = true;
                        //location.href='success.php';
                    }
                }
            });
            setTimeout(dscd, 4000); //time是指本身,延时递归调用自己,100为间隔调用时间,单位毫秒
        }

        dscd();
    });

    //使用匿名函数方法
    function countDown() {

        var time = document.getElementById("second_show");
        //alert(time.innerHTML);
        //获取到id为time标签中的内容，现进行判断
        if (time.innerHTML == 0) {
            $.ajax({
                type: 'POST',
                url: './jiedan.php?act=qx',
                data: {id: '<?=$id?>'},
                dataType: 'json',
                success: function (str) {

                    if (str.error) {

                        alert('此订单已失效，请重新发起支付');

                        location.href = 'pay_true.php';
                    }
                }
            });
        } else {
            time.innerHTML = time.innerHTML - 1;
        }
    }

    //1000毫秒调用一次
    window.setInterval("countDown()", 1000);
</script>
</body>
</html>

