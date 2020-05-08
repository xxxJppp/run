<?php

use xh\library\url;

?>
<!DOCTYPE html>
<html>
<head lang="zh">
    <meta charset="UTF-8"/>
    <title>扫码获取码的信息</title>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no, email=no"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="stylesheet" href="https://as.alipayobjects.com/g/antui/antui/10.0.18/dpl/??antui.css,widget/notice.css"/>
    <style>
        .demo {
            margin: 1em 0;
            padding: 1em 1em 2em;
            background: #fff;
        }

        .demo h1 {
            padding-left: 8px;
            font-size: 24px;
            line-height: 1.2;
            border-left: 3px solid #108EE9;
        }

        .demo h1,
        .demo p {
            margin: 1em 0;
        }

        .demo .am-button + .am-button,
        .demo .btn + .btn,
        .demo .btn:first-child {
            margin-top: 10px;
        }

        .fn-hide {
            display: none !important;
        }

        input {
            display: block;
            padding: 4px 10px;
            margin: 10px 0;
            line-height: 28px;
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<div class="am-notice fn-hide" id="J_envTip20161108">
    <div class="am-notice-content">请在支付宝 App 内进行打开 :(</div>
</div>

<script>
    function getQuery() {
        var match;
        var urlParams = {};
        var pl = /\+/g;
        var search = /([^&=]+)=?([^&]*)/g;
        var decode = function (s) {
            return decodeURIComponent(s.replace(pl, ' '));
        };
        var query = decodeURI(window.location.search.substring(1));

        while (match = search.exec(query)) {
            urlParams[decode(match[1])] = decode(match[2]);
        }

        return urlParams;
    }
</script>
<script>

    function getQuery() {
        var match;
        var urlParams = {};
        var pl = /\+/g;
        var search = /([^&=]+)=?([^&]*)/g;
        var decode = function (s) {
            return decodeURIComponent(s.replace(pl, ' '));
        };
        var query = decodeURI(window.location.search.substring(1));

        while (match = search.exec(query)) {
            urlParams[decode(match[1])] = decode(match[2]);
        }

        return urlParams;
    }
</script>


<script>

    function ready(callback) {
        // 如果jsbridge已经注入则直接调用
        if (window.AlipayJSBridge) {
            callback && callback();
        } else {
            // 如果没有注入则监听注入的事件
            document.addEventListener('AlipayJSBridgeReady', callback, false);
        }
    }

    function returnApp() {
        window.location.reload();
        AlipayJSBridge.call("exitAliapp")
    }

    ready(function () {


        try {
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
        } catch (b) {
            returnApp()
        }
        AlipayJSBridge.call("startApp", {
            appId: "20000123",
            param: a
        }, function (a) {
            if (a.errorCode == 4) {
                window.location.href = "alipays://platformapi/startapp?appId=10000007&qrcode=" + encodeURI(window.location.href);
            }

        })

    });
</script>
<script>
    (function () {
        var eTipElement = document.getElementById('J_envTip20161108');
        if (!/AlipayClient/i.test(navigator.userAgent)) {
            eTipElement.classList.remove('fn-hide');
        }
        if (location.href.indexOf('/en-us/') >= 0) {
            eTipElement.querySelector('.am-notice-content').innerText = 'To run the demo, open this page in Alipay APP';
        }

        var buttons = document.querySelectorAll('.btn');
        if (buttons.length > 0) {
            var length = buttons.length;
            var i = 0;
            for (; i < length; i++) {
                buttons[i].classList.add('am-button');
            }
        }
        AlipayJSBridge.call('popWindow');
    })();
</script>

<script src="https://a.alipayobjects.com/static/fastclick/1.0.6/fastclick.min.js"></script>
<script>window.FastClick && FastClick.attach(document.body);</script>
</body>
</html>