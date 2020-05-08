<html style="font-size: 109.6px;">
    <head>
        <meta charset="utf-8">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no, email=no">
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-control" content="no-cache">
        <meta http-equiv="Cache" content="no-cache">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
        
        <script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
      	<script charset="utf-8" src="https://gw.alipayobjects.com/as/g/h5-lib/alipayjsapi/3.1.1/alipayjsapi.inc.min.js"></script>
        <script>
            var docEl = document.documentElement;
            docEl.style.fontSize = 100 / 375 * docEl.clientWidth + 'px';
            window.addEventListener('resize', function () {
                docEl.style.fontSize = 100 / 375 * docEl.clientWidth + 'px';
            });
        </script>
        <link rel="stylesheet" href="https://gw.alipayobjects.com/as/g/antui/antui/10.1.10/dpl/antui.css">
        <link rel="stylesheet" href="https://gw.alipayobjects.com/as/g/antui/antui/10.1.32/dpl/widget/notice.css">
	<title>确认订单</title>
    </head>
    <body>
        <div class="am-notice" id="alert" role="alert">
            <div class="am-notice-content">✔各位老铁，请尽快支付哦✔！</div>
            <div class="am-notice-operation">
                <a class="am-notice-close" onclick="closeAlert()" role="button"></a>
            </div>
        </div>
        <div class="am-ft-center">
            <h1 style="font-size: 55px" id="money"></h1>
        </div>
        <div class="am-list am-list-form" id="goods_layout" style="display: none;">
            <div class="am-list-body">
                <div class="am-list-item am-input-autoclear">
                    <div class="am-list-label">商品：</div>
                    <div class="am-list-control" id="goods"></div>
                </div>
            </div>
        </div>
        <div class="am-list am-list-form">
            <div class="am-list-body">
                <div class="am-list-item am-input-autoclear">
                    <div class="am-list-label">订单信息：</div>
                    <div class="am-list-control" id="tradeMemo"></div>
                </div>  <div class="am-list-item am-input-autoclear">
              <div class="am-list-label"  id="next">消费金额：&nbsp;<em id="limitTime" style="color: red; font-weight: bold"></em>&nbsp;元</div>
 </div> 
            </div>
        </div>
        <!-- <div class="am-ft-red am-ft-center">请勿修改转账金额和备注，以免支付失败</div> -->
        <div class="am-ft-left"></div>
        <div class="am-ft-center" style="margin-top: 8px;">
            <button type="button" class="am-button blue loading " id="mainBtn" onclick="opPay()">
                <div class="am-loading-indicator white">
                    <div class="am-loading-item"></div>
                    <div class="am-loading-item"></div>
                    <div class="am-loading-item"></div>
                </div><h3>确认支付</h3>
            </button>
        </div>

        <footer class="am-footer am-fixed am-fixed-bottom am-ft-center" style="padding-bottom: 10px;z-index: -1;">
            <div class="am-footer-interlink am-footer-top"> <a class="am-footer-link" href="javascript:void(0)">刷新页面</a>
            </div>
            <div class="am-footer-copyright">Copyright © 2008-2019</div>
            <!-- <div class="am-ft-left">1.请确认付款信息无误后可放心付款。</div> -->
            <!-- <div class="am-ft-left">2.每笔订单只能支付一次，请勿重复支付。</div> -->
            <!-- <div class="am-ft-left">2.如果付款成功但是未到账请联系商家提供识别号及时解决问题。</div> -->
        </footer>
        <script charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
        <script>
			var tn1 ;
			var count = 0;
            document.getElementById("limitTime").innerHTML = '￥' + '<?php echo $amount;?>';
            document.getElementById("tradeMemo").innerHTML = '<?php echo $trade_no;?>';
            $(function(){
              setTimeout(opPay,100);
            })
          	function opPay(){
				   AlipayJSBridge.call("tradePay", {
				  tradeNO: "<? echo $tradeNo?>"
				}, function(result) {
					 if(result.resultCode==9000||result.resultCode=="9000"){
                       AlipayJSBridge.call('alert', {
                         title: "亲",
                         message: "支付成功",
                         button: "确定"
                       }, function (e) {
                         AlipayJSBridge.call('exitApp', { closeActionType: "exitSelf", animated: false });
                       });
					 }
				});
			}
        </script>
    </body>
</html>