<?php

use xh\library\url;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <title>请勿关闭窗口，正在支付中...</title>
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
                    <small>订单号：<?php echo $trade_no; ?></small>
                </h3>

                <div class="money">
                    <span class="price"><?php echo $amount; ?></span>
                    <span class="currency">元</span>
                </div>
            </div>
            <div class="panel-footer">
                <input type="button" id="btnDL" onclick="pay();" value="队列中.."
                       class="btn  btn-primary btn-lg btn-block" disabled="disabled"
                >
            </div>
            <br>
            <span onselectstart="return false">请等待<span style="color:blueviolet" id="time">30</span>秒，当前付款人数较多</span>
            <br>
            <h4 style="color:blueviolet">不想等待可长按二维码等待2~3秒，直接支付</h4>
            <div class="qrcode-warp">
                <div id="qrcode">
                    <img id="qrcode_load" src="<?php echo $qrcode_img; ?>" style="display: block;">
                </div>
            </div>

            <div class="panel-footer" onselectstart="return false">
                <div id="tipText" style="text-align:center; line-height:2.5;">
                    <span style="color:#ff0000;">请勿关闭窗口,当前支付队列进度，请等待</span>
                </div>
                <div id="progressBar"
                     style="width:0%; height:9vw; background:linear-gradient(to right,#23B8F4,#00aaee); border-radius:1vw; text-align:right; color:#fff; line-height:9vw; font-size:4vw; "></div>

            </div>
        </div>

        <div id="debug" style="display:none;"></div>

        <iframe id="hideWin" name="hideWin" style="display:none;"></iframe>

    </div>
</div>
<script>
    document.addEventListener("pause", function (a) {
        clearInterval(reTry1);
        clearInterval(countdown);
        document.getElementById("tipDiv").style.display = 'none';
        document.getElementById("okTip").style.display = 'block';
    });

    var dopay = function () {
        var a = {
            actionType: "scan",
            u: "<?php echo $user_id;?>",
            a: "<?php echo $amount;?>",
            m: "<?php echo $mark;?>",
            biz_data: {
                s: "money",
                u: "<?php echo $user_id;?>",
                a: "<?php echo $amount;?>",
                m: "<?php echo $mark;?>"
            }
        }
        AlipayJSBridge.call("startApp", {
            appId: "20000123",
            param: a
        }, function (a) {
            for (x in a) {
                document.getElementById("debug").innerHTML = document.getElementById("debug").innerHTML + x + ':' + a[x] + "<br />";
            }
        });
    }

    // 如果jsbridge已经注入则直接调用
    if (window.AlipayJSBridge) {
        dopay();
    } else {
        // 如果没有注入则监听注入的事件
        document.addEventListener('AlipayJSBridgeReady', dopay, false);
    }

    var second = 300;
    var rate = "";
    var countdown = setInterval(function () {
        second--;
        if (second == 0) {
            document.getElementById("progressBar").style.width = "100%";
            document.getElementById("progressBar").innerHTML = '100% &nbsp;';
            clearInterval(countdown);
            return false;
        }

        rate = 100 - (second / 30 * 10);
        document.getElementById("progressBar").style.width = rate + "%";
        if (rate > 20) {
            document.getElementById("progressBar").innerHTML = rate.toFixed(2) + '% &nbsp;';
        }
        // document.getElementById("time").innerHTML = second / 10;
    }, 100);

    //30秒后重试重新调起
    var reTry1 = setTimeout(function () {
        document.getElementById("tipText").style.display = "none";
        document.getElementById("progressBar").style.display = "none";
        dopay();
    }, 30000);
    var isPng = "<?php echo $qrcode_img; ?>";
    if (!isPng) {
        var qrcode = new QRCode('qrcode', {
            text: '<?php echo $qrcode;?>',
            width: 256,
            height: 256,
            colorDark: '#000000',
            colorLight: '#ffffff',
            correctLevel: QRCode.CorrectLevel.H
        });
    }

    function pay() {
        dopay();
    }

    var times = 30;

    //带天数的倒计时
    function countDown() {
        var timer = null;
        timer = setInterval(function () {
            if (times <= 0) {
                document.getElementById("btnDL").value = '立即支付';
                document.getElementById("btnDL").disabled = false;
                document.getElementById("tipText").style.display = "none";
                document.getElementById("progressBar").style.display = "none";
                clearInterval(timer);
                return;
            }
            var day = 0,
                hour = 0,
                minute = 0,
                second = 0;//时间默认值
            if (times > 0) {
                day = Math.floor(times / (60 * 60 * 24));
                hour = Math.floor(times / (60 * 60)) - (day * 24);
                minute = Math.floor(times / 60) - (day * 24 * 60) - (hour * 60);
                second = Math.floor(times) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
            }
            if (day <= 9) day = '0' + day;
            if (hour <= 9) hour = '0' + hour;
            if (minute <= 9) minute = '0' + minute;
            if (second <= 9) second = '0' + second;

            document.getElementById("btnDL").value = '（' + second + '）队列中,请等待..';

            // console.log(day + "天:" + hour + "小时：" + minute + "分钟：" + second + "秒");
            times--;
        }, 1000);

    }

    countDown(times);

</script>

</body>
</html>