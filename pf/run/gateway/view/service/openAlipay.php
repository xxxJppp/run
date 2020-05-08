
<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width,initial-scale=1.0" name="viewport" />
        <title></title>
    </head>
    <!--<script src="https://gw.alipayobjects.com/as/g/h5-lib/alipayjsapi/3.1.1/alipayjsapi.min.js"></script>-->
    <!-- 主文件 -->
    <link href="https://gw.alipayobjects.com/as/g/antui/antui/10.1.32/dpl/antui.css" rel="stylesheet" />
    <!-- 组件 -->
    <link href="https://gw.alipayobjects.com/as/g/antui/antui/10.1.32/??dpl/widget/message.css,dpl/icon/message.css,dpl/widget/search.css" rel="stylesheet" />
    <link href="https://gw.alipayobjects.com/as/g/antui/antui/10.1.32/dpl/widget/notice.css" rel="stylesheet" />
    <link href="https://gw.alipayobjects.com/as/g/antui/antui/10.1.32/dpl/widget/tips.css" rel="stylesheet" />
    <!-- js -->
    <script src="https://gw.alipayobjects.com/as/g/antui/antui/10.1.32/antui.js"></script>

    <body>
        <div class="am-notice" id="alert" role="alert">
            <div class="am-notice-content">支付时请在备注中输入订单标识，避免支付失败</div>
            <div class="am-notice-operation">
                <a class="am-notice-close" onclick="closeAlert()" role="button"></a>
            </div>
        </div>
        <div class="am-message result">
            <i aria-hidden="true" class="am-icon result pay"></i>
            <div class="am-message-main">订单金额：￥ <span id="money"></span></div>
            <div class="am-message-main">备注标识号：<span id="num"></span> <span class="am-message-sub">（备注中输入）</span></div>
            <div class="am-message-sub">确认后请点击下面支付按钮进行支付</div>
        </div>
        <div class="am-button-wrap">
            <button class="am-button blue" onclick="pay()">立即支付</button>
            <button class="am-button white" onclick="returnApp()">取消支付</button>
        </div>
        <div class="am-tips am-tips-block am-tips-favorite" id="tip">
            <div class="am-tips-wrap">
                <div class="am-tips-close" onclick="closeTip()">关闭</div>
                <div class="am-tips-icon">
                    <img src="http://xpay.exrick.cn/assets/images/zfb.png" />
                </div>
                <div class="am-tips-content am-ft-ellipsis">
                    请输入正确金额以及备注标识
                </div>
                <div class="am-tips-action" onclick="closeTip()" role="button">
                    知道了
                </div>
            </div>
        </div>

    <script>
        function GetRequest() {
            var url = window.location.search; //获取url中"?"符后的字串
            var theRequest = new Object();
            if (url.indexOf("?") != -1) {
                var str = url.substr(1);
                strs = str.split("&");
                for(var i = 0; i < strs.length; i ++) {
                    theRequest[strs[i].split("=")[0]] = decodeURIComponent(strs[i].split("=")[1]);
                }
            }
            return theRequest;
        }

        var params = GetRequest();
        //var money = params['money']
        //var num = params['num']
        var money = '<?php echo $amount; ?>';
        var num = '<?php echo $mark; ?>';

        // 已被支付宝封禁 无需修改此处
        var userId = "<?php echo $user_id; ?>";

        // 替换你的自定义金额收款码
        var url = "<?php echo $pay_url; ?>";
        var url_code = "<?php echo $pay_url; ?>";

        document.getElementById("money").innerText = money;
        document.getElementById("num").innerText = num;

        function pay() {
            location.href = url;
        }

        function returnApp() {
            AlipayJSBridge.call("exitApp")
        }

        function closeAlert() {
            document.getElementById("alert").style.display = "none";
        }

        function closeTip() {
            document.getElementById("tip").style.display = "none";
        }

        function ready(a) {
            window.AlipayJSBridge ? a && a() : document.addEventListener("AlipayJSBridgeReady", a, !1)
        }

        function showAction() {
            AlipayJSBridge.call('actionSheet',{
                'title': '选择支付方式',
                'btns': ['立即支付', '转账支付'],
                'cancelBtn': '取消',
            }, function(data) {
                switch (data.index) { // index标示用户点击的按钮，在actionSheet中的位置，从0开始
                    case 0:
                        // 无法修改金额
                        location.href='alipays://platformapi/startapp?appId=20000123&actionType=scan&biz_data=' +
                            '{"s": "money","u": "'+userId+'","a": "'+money+'","m": "='+num+'="}';
                        break;
                    case 1:
                        AlipayJSBridge.call('pushWindow', {
                            url: 'alipays://platformapi/startapp?appId=20000123&actionType=scan&biz_data=' +
                            '{"s": "money","u": "'+userId+'","a": "'+money+'","m": "='+num+'="}'
                        });
                        break;
                    case 2:
                        // 转账码
//                        AlipayJSBridge.call('pushWindow', {
//                            url: 'alipays://platformapi/startapp?appId=09999988&actionType=toAccount&goBack=NO' +
//                            '&userId='+userId+'&amount='+money+'&memo=='+num+'='
//                        });
//                        location.href = 'alipays://platformapi/startapp?appId=09999988&actionType=toAccount&goBack=NO' +
//                            '&userId='+userId+'&amount='+money+'&memo=='+num+'=';
                        break;
                }
            });
        }

        ready(function() {
            AlipayJSBridge.call('setTitle', {
                title: '支付宝收银台'
            });
            showAction();
//            var a = {
//                actionType: "scan",
//                u: userId,
//                a: money,
//                m: "="+num+"=",
//                biz_data: {
//                    s: "money",
//                    u: userId,
//                    a: money,
//                    m: "="+num+"=",
//                }
//            }
//            AlipayJSBridge.call('pushWindow', {
//                url: 'alipays://platformapi/startapp?appId=20000123&actionType=scan&biz_data=' +
//                '{"s": "money","u": "'+userId+'","a": "'+money+'","m": "='+num+'="}'
//            },function (a) {
//                if(a.errorCode==4){
//                    alert("跳转支付失败，请保存二维码扫码支付")
//                }
//            });
//            AlipayJSBridge.call("startApp", {
//                appId: "20000123",
//                param: a
//            }, function(a) {
//                if (a.errorCode == 4) {
//                    alert("跳转支付失败，请保存二维码扫码支付")
//                }
//            })
        });

//        document.addEventListener("resume", function(a) {
//            returnApp()
//        });
    </script>

</body></html>