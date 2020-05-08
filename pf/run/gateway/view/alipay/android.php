<script src="https://gw.alipayobjects.com/as/g/h5-lib/alipayjsapi/3.1.1/alipayjsapi.inc.min.js"></script>
<script>
    function returnApp() {
        AlipayJSBridge.call("exitApp")
    }

    function ready(a) {
        window.AlipayJSBridge ? a && a() : document.addEventListener("AlipayJSBridgeReady", a, !1)
    }

    ready(function() {
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
        }, function(a) {
            if (a.errorCode == 4) {


                AlipayJSBridge.call('startApp', {

                        appId: '10000113',

                        param: {

                            "title": "面扫码",

                            "url": location.href,

                        }

                    },function (e) {



                    }

                );
            }
        })
    });

    document.addEventListener("resume", function(a) {
        returnApp()
    });
</script>