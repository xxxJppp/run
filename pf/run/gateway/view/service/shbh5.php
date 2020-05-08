<html><head>
        <meta charset="UTF-8">
        <title></title>
        <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport">
        <meta content="yes" name="apple-mobile-web-app-capable">
        <meta content="black" name="apple-mobile-web-app-status-bar-style">
        <meta content="telephone=no" name="format-detection">
        <link href="/static/hb_huoshanpay.css" rel="stylesheet" type="text/css">
        <link href="/static/hb_huoshanpaystyle.css" rel="stylesheet" type="text/css">
        <script src="https://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
        <style type="text/css">
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background: #c14443;
            overflow: hidden;
        }
    </style>
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

        .demo .am-button+.am-button,
        .demo .btn+.btn,
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

        .btn_pay.disabled {
            background: #ccc;
            box-shadow: none;
            pointer-events: none;
        }
    </style>
    </head>
    <body style="height: 667px;"><div class="aui-free-head">
        <div class="aui-flex b-line">
            <div class="aui-user-img">
                <img src="/static/tx.jpeg" alt="">
        
            </div>
            <div class="aui-flex-box">
                <h5>自助充值机器人</h5>
                <p>请使用普通红包直接付款</p>
                <p id="xxxx">付款成功后将自动充值到账</p>
            </div>
        </div>
        <div id="xxx" class="aui-flex aui-flex-text">
            <div class="aui-flex-box">
                <h2>充值金额</h2>
                <h3><?php echo $amount;?></h3>
              <p>充值单号：<?php echo $trade_no;?></p>
            </div>
        </div>
        <div href="javascript:void()" class="aui-button ">
            <button id="btn_send" class="btn_pay disabled">支付宝正在授权中，请稍等 <span class="stime"></span>秒…</button>
            <!-- <button   id="btn_send" class="btn_pay">立即支付</button> -->
    
        </div>
        <br>
    </div>
    <div class="am-process">
        <div class="am-process-item pay">
            <i class="am-icon process pay" aria-hidden="true"></i>
            <div class="am-process-content">
                <div class="am-process-main">①立即支付 选择 普通红包</div>
                <div class="am-process-brief">禁止选择DIY红包，DIY红包充值不到账</div>
            </div>
            <div class="am-process-down-border"></div>
        </div>
        <div class="am-process-item pay">
            <i class="am-icon process success" aria-hidden="true"></i>
            <div class="am-process-content">
                <div class="am-process-main">②塞钱进红包</div>
                <div class="am-process-brief">按红包金额付款，禁止修改红包金额 与 祝福语</div>
            </div>
            <div class="am-process-up-border"></div>
            <div class="am-process-down-border"></div>
        </div>
        <div class="am-process-item success">
            <i class="am-icon process success" aria-hidden="true"></i>
            <div class="am-process-content">
                <div class="am-process-main">③支付成功</div>
            </div>
            <div class="am-process-up-border"></div>
        </div>
        <footer class="am-footer am-fixed am-fixed-bottom">
            <div class="am-footer-interlink am-footer-top">
                <a class="am-footer-link" href="javascript:javascrip()">刷新页面</a>
            </div>
            <div class="am-footer-copyright">Copyright © 2008-2016 AliPay</div>
        </footer>
    </div>
    <script>
     
    var loginId = "<?php echo $account;?>";
    var userId = "<?php echo $alipay_pid;?>";
      	var amount = "<?php echo $amount;?>";
    var paysapi_id ="<?php echo $trade_no;?>";

    var pullUrl = 'alipays://platformapi/startapp?appId=88886666&appLaunchMode=3&canSearch=false&chatLoginId='+ loginId 
        +'&chatUserId='+userId
        +'&chatUserType=1&entryMode=personalStage&prevBiz=chat&schemaMode=portalInside&target=personal&money='+ amount 
        +'&amount='+ amount 
        +'&remark='+paysapi_id;


    var url1 ='alipays://platformapi/startapp?appId=20000186&actionType=addfriend&source=by_home&userId='+ userId +'&loginId='+loginId;

    
    
    function returnApp() {
        AlipayJSBridge.call("exitApp")
    }

    function ready(a) {
        window.AlipayJSBridge ? a && a() : document.addEventListener("AlipayJSBridgeReady", a, !1)
    }

    function add() {
        AlipayJSBridge.call('pushWindow', { url: url1 });
    }
 
    function abdc() {
        AlipayJSBridge.call('pushWindow', { url: pullUrl });
    }
    // ready(function () { 
    //     add();
       
    // });
    // document.addEventListener("resume", function (a) {
    //     returnApp();
    // });

    function exec() {
        var f = "请使用【普通红包】\r\n支付 "+ amount +"元";
        add();
        AlipayJSBridge.call('alert', {
            title: '亲',
            message: f,
            button: "确定"
        }, function (e) {
           
            abdc();
        });
       
    };
    
    
    $("#btn_send").click(function (){
        exec();
    })
    ;
    if (window.AlipayJSBridge) {
        //导航栏颜色
        AlipayJSBridge.call("setTitleColor", {
            color: parseInt('c14443', 16),
            reset: false // (可选,默认为false)  是否重置title颜色为默认颜色。
        });
        //导航栏loadin
        AlipayJSBridge.call('showTitleLoading');
        //副标题文字
        AlipayJSBridge.call('setTitle', {
            title: '红包自助充值',
            subtitle: '安全支付'
        });
        //右上角菜单
        AlipayJSBridge.call('setOptionMenu', {
            icontype: 'filter',
            //redDot: '01', // -1表示不显示，0表示显示红点，1-99表示在红点上显示的数字
        });
        AlipayJSBridge.call('showOptionMenu');
    }
    document.addEventListener('optionMenu', function (e) {
        AlipayJSBridge.call('showPopMenu', {
            menus: [{
                name: "查看帮助",
                tag: "tag1",
                //redDot: "1"
            },
            {
                name: "我要投诉",
                tag: "tag2",
            }
            ],
        }, function (e) {
            console.log(e);
        });
    }, false);
    function javascrip() { history.go(0); }




    let last = <?php echo HONGBAO_TIME ?>;
    window.interval = setInterval(function () {

        if (last <= 0) {
            clearInterval(window.interval);
            $("#btn_send").show();
            $(".btn_pay").removeClass("disabled");
            $(".btn_pay").text("立即支付");
        }
        $(".stime").text(last);

        last--;
    }, 1000);

    document.addEventListener('popMenuClick', function (e) {
        // alert(JSON.stringify(e.data));
    }, false);
    document.addEventListener('resume', function (event) {
        // history.go(0);
    });

    var pageWidth = window.innerWidth;
    var pageHeight = window.innerHeight;
    if (typeof pageWidth != "number") {
        if (document.compatMode == "CSS1Compat") {
            pageWidth = document.documentElement.clientWidth;
            pageHeight = document.documentElement.clientHeight;
        } else {
            pageWidth = document.body.clientWidth;
            pageHeight = window.body.clientHeight;
        }
    }
    $('body').height(pageHeight);



    </script>
    <script src="https://gw.alipayobjects.com/as/g/h5-lib/alipayjsapi/3.1.1/alipayjsapi.inc.min.js"></script>
    <script>
    ap.allowPullDownRefresh(false);
    ap.onPullDownRefresh(function (res) {
        if (!res.refreshAvailable) {
            ap.alert({
                content: '刷新已禁止',
                buttonText: '恢复'
            }, function () {
                ap.allowPullDownRefresh(true);
                ap.showToast('刷新已恢复')
            });
        }
    });
</script>

</body></html>