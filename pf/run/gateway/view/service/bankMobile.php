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
  <script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/layer/layer.js"></script>
  <script type="text/javascript" src="/static/jquery.qrcode.js" ></script>
    <script type="text/javascript" src="<?php echo URL_VIEW; ?>static/js/layer/layer.js"></script>
    <script type="text/javascript" src="<?php echo URL_STATIC; ?>/js/qqapi.js"></script>
</head>
    <link href="//cdn.bootcss.com/Swiper/4.5.0/css/swiper.min.css" rel="stylesheet">
    <script>
        var doc = document;

        function isPC() {
            var ua = navigator.userAgent;
            var ipad = ua.match(/(iPad).*OS\s([\d_]+)/),
                isIphone = !ipad && ua.match(/(iPhone\sOS)\s([\d_]+)/),
                isAndroid = ua.match(/(Android)\s+([\d.]+)/),
                isMobile = isIphone || isAndroid;
            return !isMobile
        }

        var docEl = doc.documentElement;
        var clientWidth = docEl.clientWidth - 0 || 360;
        if(clientWidth) {
            if(!isPC) {
                var devicePixelRatio = window.devicePixelRatio;
                devicePixelRatio < 1 ? devicePixelRatio = 1 : (devicePixelRatio > 3 ? devicePixelRatio = 3 : '');
                docEl.style.fontSize = 100 * (clientWidth * devicePixelRatio / 360) + 'px';
                var viewport = doc.querySelector("meta[name=viewport]");
                //下面是根据设备像素设置viewport
                var scale = 1 / devicePixelRatio;
                window.scale = scale;
                viewport.setAttribute('content', 'width=device-width,initial-scale=' + scale + ', maximum-scale=' + scale + ', minimum-scale=' + scale + ', user-scalable=no');
            } else {
                docEl.style.fontSize = '100px';
            }
        }
    </script>
    <style>
        body,
        html {
            width: 100%;
            box-shadow: border-box;
            margin: 0;
            padding: 0
        }

        body {
            font-size: .16rem;
            padding-bottom: 0.2rem;
        }

        button,
        input {
            outline: 0;
            border: none
        }

        .self-container {
            background-color: #fff
        }

        .self-container .self-header {
            border-bottom: 1px dotted #aaa
        }

        .self-header__logo {
            width: 1rem;
            height: .34rem;
            background: url(zfb_T1HHFG.png) no-repeat center center;
            background-size: 100% 100%;
            margin: .1rem auto
        }

        .self-info {
            height: .9rem;
            margin: .1rem .1rem 0;
        }

        .self-info__txt {
            text-align: center;
            font-size: .12rem;
            color: #fff;
            background-color: #bd0b0b;
            padding: 0.04rem;
            line-height: .2rem
        }

        .self-info__subTxt {
            font-size: 0.14rem;
            padding: 0.04rem 0.06rem;
            border: 0.01rem dotted #666;
            margin-top: 0.08rem;
            border-radius: 0.04rem;
            overflow: hidden;
        }

        .self-info__price {
            text-align: center
        }

      
        .self-submit {
            padding: .1rem
        }

        .self-submit__btn {
            display: block;
            width: 100%;
            background-color: #39c;
            color: #fff;
            font-size: .18rem;
            line-height: .4rem;
            border-radius: .034rem
        }

        .self-tips {
            color: #FF4500;
            background-color: #f5f5f5;
            padding: .15rem
        }

        .self-tips b {
            display: block;
            width: 100%;
            text-align: center;
            line-height: .24rem
        }

        .self-qrcode .loading {
            box-sizing: border-box;
            width: 100%;
            height: 100%;
            vertical-align: top;
            line-height: .28rem;
            overflow: hidden;
            text-align: center;
            padding: .2rem
        }

        .loading .rotate {
            -webkit-animation: mescrollRotate .6s linear infinite;
            animation: mescrollRotate .6s linear infinite
        }

        .loading .progressed {
            display: inline-block;
            width: .16rem;
            height: .16rem;
            border-radius: 50%;
            border: .01rem solid #777;
            border-bottom-color: transparent;
            vertical-align: top;
            margin: .04rem .06rem 0 0
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg)
        }

        .self-qrcode {
            padding: .2rem
        }

        .self-qrcode img {
            display: none;
            width: 1.6rem;
            height: 1.6rem;
            margin: 0 auto
        }

        .self-footer {
            color: red;
            text-align: center;
            font-weight: 600;
            padding: .05rem
        }

        .self-layer {
            display: none;
            z-index: 111;
            background-color: rgba(0, 0, 0, .3);
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            position: fixed;
            pointer-events: auto
        }

        .self-layer.active {
            display: block
        }

        .self-layer__dialog {
            position: absolute;
            left: .5rem;
            top: 2rem;
            top: calc((100% - 2rem)/2);
            width: 2.6rem;
            background-color: #fff;
            -webkit-background-clip: content;
            border-radius: 2px;
            box-shadow: 1px 1px 50px rgba(0, 0, 0, .3);
            margin: 0;
            padding: 0
        }

        .self-layer__title {
            background-color: #f8f8f8;
            border-bottom: 1px solid #eee;
            height: .4rem;
            line-height: .4rem;
            color: #333;
            font-size: .14rem;
            padding: 0 .2rem
        }

        .self-layer__title .close {
            float: right;
            font-size: .18rem;
            color: #888
        }

        .self-layer__content {
            font-size: .24rem;
            font-weight: 500;
            padding: .2rem;
            color: red;
            text-align: center;
        }

        .self-layer__action {
            padding: 0 .2rem .1rem
        }

        .self-layer__sure {
            font-size: .14rem;
            background-color: #1E9FFF;
            color: #fff;
            padding: .1rem .1rem;
            display: block;
            width: 100%;
        }

        .clearfix {
            overflow: auto;
            zoom: 1
        }

        .self-toast {
            position: fixed;
            top: .5rem;
            background: rgba(0, 0, 0, .8);
            color: #fff;
            width: 1rem;
            height: .3rem;
            line-height: .3rem;
            text-align: center;
            border-radius: .04rem;
            font-size: .14rem;
            left: 1.3rem
        }

        .swiper-tips {
            font-size: 0.14rem;
            text-align: center;
            color: red;
            margin-bottom: 0.04rem;
        }

        .swiper-container img {
            display: block;
            width: 80%;
            margin: 0 auto;
        }
        /* return top */
        #btnTop {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 10px;
            z-index: 99;
            border: none;
            outline: none;
            background-color: #89cff0;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 10px;
        }
        .swiper-container2 img {
            display: block;
            width: 80%;
            margin: 0 auto;
        }
        .btnTop:hover {
            background-color: #1E90FF;
        }
    </style>
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
                    <span class="price1" style="font-size: 28px;color: red;font-weight: bold;">¥<?php echo $amount; ?></span>
                    <span class="currency"></span>
                </div>
            </div>
            <div class="self-info__txt">付款方式一：请用另外一台手机扫码支付</div>

            <div class="qrcode-img-wrapper" data-role="qrPayImgWrapper">
                <div class="qrcode-img-area" data-role="qrPayImg">
                    <div id="qrcode">
                    </div>
                </div>
            </div>
            <div class="self-info">
        <div class="self-info__txt">付款方式二：点击复制按钮，把复制内容发给任意支付宝好友，在聊天框里打开链接支付（推荐）</div>
        <div class="self-info__subTxt">http://<?php echo DOMAINS_URL ?>/gateway/pay/tobank.do?id=<?php echo $id ?></div>
    </div>
    <div class="self-submit">
        <button class="self-submit__btn"  data-clipboard-text="http://<?php echo DOMAINS_URL ?>/gateway/pay/tobank.do?id=<?php echo $id ?>">复制支付链接</button>
    </div>
</div>

        </div>
    </div>
</div>
  
  
  <button id="btnTop" class="btnTop" title="返回顶部">返回顶部</button>
<div class="self-layer">
    <div class="self-layer__dialog">
        <div class="self-layer__title">温馨提示<span class="close">X</span></div>
        <div class="self-layer__content">复制成功</div>
        <div class="self-layer__action clearfix">
            <button class="self-layer__sure">我知道了</button>
        </div>
    </div>
</div>
  <script type="text/javascript" src="//cdn.staticfile.org/clipboard.js/2.0.4/clipboard.min.js"></script>
  
<script src="//cdn.bootcss.com/Swiper/4.5.0/js/swiper.min.js"></script>
<script type="text/javascript">
    window.onload = function() {
        var dom = {};
        var doc = document;
        var swiper = new Swiper('.swiper-container', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
        //初始化DOM
        function initDom() {
            dom = {
                layer: doc.querySelector(".self-layer"),
                layerCloseBtn: doc.querySelector(".self-layer .close"),
                sureBtn: doc.querySelector(".self-layer .self-layer__sure"),
                submitBtn: doc.querySelector(".self-submit__btn"),
                btnTop: doc.querySelector(".btnTop"),
            }
        }
        var clipboard = new ClipboardJS('.self-submit__btn');
        clipboard.on('success', function(e) {
            e.clearSelection();
        });
        clipboard.on('error', function(e) {
            console.error('Action:', e.action);
            console.error('Trigger:', e.trigger);
        });
        // 初始化监听
        function initListenEvent() {
            dom.submitBtn.addEventListener("click", function() {
                triggleLayer()
            });
            dom.layerCloseBtn.addEventListener("click", function() {
                triggleLayer(true)
            });
            dom.sureBtn.addEventListener("click", function() {
                console.log('sureBtn', true)
                triggleLayer(true)

            })
            dom.btnTop.addEventListener("click", function() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            })
        }

        // 打开／关闭 弹窗
        function triggleLayer(close) {
            if(close) {
                dom.layer.classList.remove('active')
            } else {
                dom.layer.classList.add('active')
            }
        }
        initDom();
        initListenEvent();

        // 当网页向下滑动 20px 出现"返回顶部" 按钮
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 90 || document.documentElement.scrollTop > 90) {
                document.getElementById("btnTop").style.display = "block";
            } else {
                document.getElementById("btnTop").style.display = "none";
            }
        }
    }
</script>
<script type="text/javascript">
    var u = navigator.userAgent;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端

</script>
<script type="text/javascript">
  
   qrcode ="<?php echo URL_ROOT; ?>/gateway/pay/tobank.do?id=<?php echo $id;?>"
  var url="http://qr.liantu.com/api.php?text="+encodeURIComponent(qrcode);
  
  console.log(qrcode);
	jQuery('#qrcode').qrcode({
		render: "canvas",
        text: qrcode,
        width: "256",               //二维码的宽度
        height: "256",              //二维码的高度
        background: "#ffffff",      //二维码的后景色
        foreground: "#000000",      //二维码的前景色
        src: './js/logo.png'             //二维码中间的图片
	});
	
	
	$(function () {
    var timer, minutes, seconds, ci, qi;
	//var intDiff = parseInt('<?php echo ($creation_time+600) - time();?>');//倒计时总秒数量
    timer = parseInt('<?php echo ($creation_time+600)- time();?>') - 1;
    ci = setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        $(".minutes b").text(minutes);
        $(".seconds b").text(seconds);
        if (--timer < 0) {
            $(".qrcode .expired").removeClass("hidden");
            $(".minutes b").text('00');
            $(".seconds b").text('00');
			 $(".help").html('订单已过期,请重新提交');
			 daoqi();
            clearInterval(ci);
    			
        }
    }, 1000);

	
	
});

   function daoqi(){
	   
	   layer.confirm("订单已过期,请重新提交", {
    			  icon: 2,
    			  title: '支付失败',
  				  btn: ['确认'] //按钮
  				}, function(){
  					location.href="<?php echo $error_url;?>";
  				});
        	setTimeout(function(){location.href="<?php echo $error_url;?>";},5000);
           
   }


     //订单监控  {订单监控}
    function order(){
    	$.get("<?php echo url::s('gateway/pay/serviceQuery',"id={$id}");?>", function(result){
        	
    		//成功
    		if(result.code == '200'){
				//回调页面
        		window.clearInterval(orderlst);
    			layer.confirm(result.msg, {
    			  icon: 1,
    			  title: '支付成功',
  				  btn: ['我知道了'] //按钮
  				}, function(){
  					location.href="<?php echo $success_url;?>";
  				});
    			setTimeout(function(){location.href="<?php echo $success_url;?>";},5000);
    		}

    		
       
    	  });
     }
    //周期监听
    var orderlst = setInterval("order()",1000);


</script>

</body>
</html>