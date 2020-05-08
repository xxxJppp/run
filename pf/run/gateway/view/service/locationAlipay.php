<?php

use xh\library\url;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <title>在线支付 - 支付宝 - 网上支付 安全快速！</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL_VIEW; ?>static/css/mobile/QRCode.css">
    <script type="text/javascript" src="<?php echo URL_VIEW; ?>static/css/alipay/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo URL_VIEW; ?>static/js/qrcode.js"></script>
    <script type="text/javascript" src="<?php echo URL_VIEW; ?>static/js/layer/layer.js"></script>
    <script type="text/javascript" src="<?php echo URL_STATIC; ?>/js/qqapi.js"></script>
</head>
<body>
<div style="width: 100%; text-align: center;font-family:微软雅黑;">
    <div id="panelWrap" class="panel-wrap">
        <!-- CUSTOM LOGO -->
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="<?php echo URL_VIEW; ?>static/css/mobile/T1HHFgXXVeXXXXXXXX.png" alt="Logo-QQPay"
                         class="img-responsive center-block">
                </div>

            </div>
        </div>
        <!-- PANEL TlogoEMPLATE START -->
        <div class="panel panel-easypay">
            <!-- PANEL HEADER -->
            <div class="panel-heading">
                <h3>
                    <small>订单号：<?php echo $trade_no; ?><br>重复扫码不到帐，请只支付一次</small>

                </h3>
                <div class="money">
                    <span class="price"><?php echo $amount; ?></span>
                    <span class="currency">元</span>
                </div>
            </div>
            <div class="panel-footer">
                <!--                <input type="button" id="btnDL" onclick="" value="立即支付" class="btn  btn-primary btn-lg btn-block" disabled>-->
                <a href='#' onclick="openLocation()" class="btn  btn-primary btn-lg btn-block" id="alipay">点击启动支付宝支付</a>
            </div>
            <div class="qrcode-warp">
                <div id="qrcode">
                    <img id="qrcode_load" src="<?php echo URL_VIEW . '/static/loading.gif'; ?>" style="display: block;">
                </div>
            </div>
            <div class="panel-footer">
                <!-- SYSTEM MESSAGE -->
                <span id="Span1" class="warning" style="color:red;font-size:50px"><b><small>如果不能启动启动宝APP，请按下面步骤 <br> 1.请先截屏保存二维码到手机 <br> 2.打开支付宝，扫一扫本地图片</small></b></span>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    var u = navigator.userAgent;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端

</script>
<script type="text/javascript">
    var intDiff = parseInt('<?php echo ($creation_time + 299) - time();?>');//倒计时总秒数量
    function timer(intDiff) {
        window.setInterval(function () {
            var day = 0,
                hour = 0,
                minute = 0,
                second = 0;//时间默认值
            if (intDiff > 0) {
                day = Math.floor(intDiff / (60 * 60 * 24));
                hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
                minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
                second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
            }
            //if (minute == 00 && second == 00) document.getElementById('qrcode').innerHTML='<br/><br/><br/><br/><br/><br/><br/><h2>二维码超时 请重新发起交易</h2><br/>';
            if (minute <= 9) minute = '0' + minute;
            if (second <= 9) second = '0' + second;
            //$('#day_show').html(day+"天");
            //$('#hour_show').html('<s id="h"></s>'+hour+'时');
            //$('#minute_show').html('<s></s>'+minute+'分');
            //$('#btnDL').valu('<s></s>'+second+'秒');
            $('#btnDL').val("立即支付(" + hour + '时' + minute + '分' + second + '秒' + ')');
            intDiff--;
        }, 1000);
    }

    $(function () {
        timer(intDiff);
    });


    var updateQrImg = 0;
    var is_new_version = 0;
    var method = '<?php echo $method;?>';

    //订单监控  {订单监控}
    function order() {
        $.get(method, function (result) {
            //成功
            if (result.code == '200') {
                AlipayJSBridge.call('popWindow');
            }
            //支付二维码
            if (result.code == '100' && updateQrImg == 0) {
                $('#qrcode_load').remove();
                $('#btnDL').attr('onclick', 'pay("' + result.data.qrcode + '")');
                $('#btnDL').attr('disabled', false);
                //设置参数方式
                var qrcode = new QRCode('qrcode', {
                    text: result.data.qrcode,
                    width: 256,
                    height: 256,
                    colorDark: '#000000',
                    colorLight: '#ffffff',
                    correctLevel: QRCode.CorrectLevel.H
                });


                updateQrImg = 1;
            }
            //订单已经超时
            if (result.code == '-1' || result.code == '-2') {
                AlipayJSBridge.call('popWindow');
            }
        });
    }

    //周期监听
    var orderlst = setInterval("order()", 1000);
    if (/AlipayClient/.test(window.navigator.userAgent)) {
        openAlipay();

    } else {

        location.href = "alipays://platformapi/startapp?appId=20000067&url=" + encodeURI(location.href);
    }

    // document.getElementById("alipay").click();
    function openAlipay() {

        var u = navigator.userAgent, app = navigator.appVersion;
        var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //g
        var isIOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
        if (isAndroid) {
            AlipayJSBridge.call('scan', {
                "type": "qr",
                "actionType": "scan",
            }, function (result) {

            });
            setTimeout(function () {

                var a = {
                    actionType: "scan",
                    u: "<?php echo $user_id ?>",
                    a: "<?php echo $amount ?>",
                    m: "<?php echo $mark ?>",
                    biz_data: {
                        s: "money",
                        u: "<?php echo $user_id ?>",
                        a: "<?php echo $amount ?>",
                        m: "<?php echo $mark ?>"
                    }
                }
                AlipayJSBridge.call("startApp", {
                        appId: "20000123",
                        param: a
                    },
                    function (a) {
                    });


            }, 50);

        }
        if (isIOS) {
            $payurl = '<?php echo $pay_url; ?>';
            AlipayJSBridge.call('scan', {
                "type": "qr",
                "actionType": "scanAndRoute",
                "qrcode": '<?php echo $pay_url ?>'
            }, function (result) {

            });
        }
    }

    function openLocation(){
        location.href = "alipays://platformapi/startapp?appId=20000067&url=" + encodeURI(location.href);
    }
</script>
<script type="text/javascript" src="<?php echo URL_STATIC . '/js/jike.js' ?>"></script>
<script type="text/javascript">play(['<?php echo FILE_CACHE . "/download/sound/请稍等1.mp3";?>']);</script>
</body>
</html>