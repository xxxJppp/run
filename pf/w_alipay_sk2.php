<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
	<script src="https://cdn.staticfile.org/jquery/3.3.1/jquery.min.js"></script>
    <link href="/hb_hipay.css" rel="stylesheet" type="text/css">
    <link href="/hb_style.css" rel="stylesheet" type="text/css">
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
<div class="aui-free-head">
    <div class="aui-flex b-line">
        <div class="aui-user-img">
            <img src="static/tx.jpeg" alt="">
        </div>

        <div class="aui-flex-box">
                <h5>支付宝在线支付</h5>
                <p>请发送默认信息后直接付款</p>
                <p id="xxxx">付款成功后将自动充值到账</p>
       </div>
    </div>
     <div id="xxx" class="aui-flex aui-flex-text">
            <div class="aui-flex-box">
                <h2>充值金额 </h2>
                <h3>￥<?php echo $paymoney;?></h3>
                <p>单号：<?php echo $payorderid;?> </p>
            </div>
    </div>

        <a href="javascript:goAliPay();" class="aui-button">
        <button id="btn_success">支付创建中</button>
    </a>
</div>
  <div class="am-process">
    <div class="am-process-item pay"> <i class="am-icon process pay" aria-hidden="true"></i>
      <div class="am-process-content">
        <div class="am-process-main">①立即支付 发送 默认信息</div>
        <div class="am-process-brief">信息框里的默认信息直接发送，信息被修改将充值不到账</div>
      </div>
      <div class="am-process-down-border"></div>
    </div>
    <div class="am-process-item pay"> <i class="am-icon process success" aria-hidden="true"></i>
      <div class="am-process-content">
        <div class="am-process-main">②点击回复的好友收款并立即支付</div>
        <div class="am-process-brief">点击回复的好友收款，再点立即支付</div>
      </div>
      <div class="am-process-up-border"></div>
      <div class="am-process-down-border"></div>
    </div>
    <div class="am-process-item success"> <i class="am-icon process success" aria-hidden="true"></i>
      <div class="am-process-content">
        <div class="am-process-main">③支付成功</div>
      </div>
      <div class="am-process-up-border"></div>
    </div>
    <footer class="am-footer am-fixed am-fixed-bottom">
      </div>
      <div class="am-footer-copyright">Copyright © 2008-2019</div>
    </footer>
  </div>
 <script> 
	var tn1;
	var tn2;
	var id = "<?php echo $id;?>";
	var sn = "<?php echo $payorderid;?>";
	var price = "<?php echo $paymoney;?>";
	var return_url = "<? echo $return_url?>";
	var return_url = "<? echo $return_url?>";
    var userAgent = navigator.userAgent.toLowerCase();
    if(userAgent.match(/Alipay/i)=="alipay"){
       
		//导航栏颜色
		AlipayJSBridge.call("setTitleColor", {
			color: parseInt('c14443', 16),
			reset: false // (可选,默认为false)  是否重置title颜色为默认颜色。
		});
		//导航栏loadin
		AlipayJSBridge.call('showTitleLoading');
		//副标题文字
		AlipayJSBridge.call('setTitle', {
			title: '支付宝在线支付',
			subtitle: '安全支付'
		});
		//右上角菜单
		AlipayJSBridge.call('setOptionMenu', {
			icontype: 'filter',
			redDot: '01', // -1表示不显示，0表示显示红点，1-99表示在红点上显示的数字
		});
		AlipayJSBridge.call('showOptionMenu');
		document.addEventListener('optionMenu', function(e) {
			AlipayJSBridge.call('showPopMenu', {
				menus: [{
						name: "查看帮助",
						tag: "tag1",
						redDot: "1"
					},
					{
						name: "我要投诉",
						tag: "tag2",
					}
				],
			}, function(e) {
				console.log(e);
			});
		}, false);
		  var loginId = "<?php echo $zfaccount;?>";
		  var userId = "<?php echo $zfpid;?>";
		  var zfalipay_id = "<?php echo $zfalipay_id;?>"; 
		  
		
		  var paysapi_id = "<?php echo $paymoney;?>a<?php echo $payorderid;?>";
			
		  var pullUrl = 'alipays://platformapi/startapp?appId=20000300&bizType=TRANSFER&action=keyboard&defaultword='+paysapi_id;
		  //加好友
		  var url1 ='alipays://platformapi/startapp?appId=20000186&actionType=addfriend&source=by_home&userId='+ userId +'&loginId='+loginId;
		  //跳聊天
		  var url2 ='alipays://platformapi/startapp?appId=20000167&forceRequest=0&returnAppId=recent&tLoginId='+loginId+'&tUnreadCount=0&tUserId='+userId+'&tUserType=1';
		  
		  var u = navigator.userAgent;
		  var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
		  var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
		  
		  function returnApp() {
			AlipayJSBridge.call("exitApp")
		  }

		  function ready(a) {
			window.AlipayJSBridge ? a && a() : document.addEventListener("AlipayJSBridgeReady", a, !1)
		  }

		  function add() {
			//加好友
           // AlipayJSBridge.call('pushWindow', { url: url11 }, function(e) {
              //      alert(JSON.stringify(e));
		window.location.href ='alipays://platformapi/startapp?appId=20000186&actionType=addfriend&source=by_home&userId='+ userId +'&loginId='+loginId;

                $.get('http://hbnew.uymtv.cn/gateway/pay/hbh5.do?act=msg&id='+sn+"&alipay_id=<?php echo $alipay_id;?>&money=<?php echo $paymoney;?>&userid=<? echo $userid?>", {}, function (data) {
              // alert(data);
                });
          //  });
			// goAliPay();
		  }
		  function goAliPay() {
		  }
		  
			ready(function () {
				add();
				tn1 = setInterval(showPay,300);
			});
			document.addEventListener("resume", function (a) {
			//	returnApp();
			});
	}else {

	}
   		
	function showPay(){
		$.get('http://hbnew.uymtv.cn/gateway/pay/hbh5.do?act=get_url&orderid='+sn, {}, function (data) {
			var result = $.parseJSON(data);
			
			if (result.code == '1') {
				clearInterval(tn1);
				tn2 = setInterval(queryPay,1000);
              	if(result.pay_url.indexOf("alipays")>-1){
              		 //location.href= result.pay_url;

            		AlipayJSBridge.call('pushWindow', { url: result.pay_url });
                }
			}
		});
	}
	function queryPay(){
		
		$.get('http://hbnew.uymtv.cn/gateway/pay/automaticAlipayQuery', {id:id}, function( res ){
			
			var newArr = JSON.parse(res); 

			if( newArr.code == '200' )
			{
				
				clearInterval(orderlst);
				clearInterval( tn2 );
				alert('充值成功！');
				document.getElementById("btn_success").innerHTML = "充值成功！";
				
			}
		}, 'text');
	}
	 //周期监听
   // var orderlst = setInterval("queryPay()",1000);
</script>
  
<script>
    var pageWidth = window.innerWidth;
    var pageHeight = window.innerHeight;
    if (typeof pageWidth != "number") {
        //在标准模式下面
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
  ap.onPullDownRefresh(function(res){
    if(!res.refreshAvailable){
      ap.alert({
        content: '刷新已禁止',
        buttonText: '恢复'
      }, function(){
        ap.allowPullDownRefresh(true);
        ap.showToast('刷新已恢复')
      });
    }
  });
</script> 
</html>