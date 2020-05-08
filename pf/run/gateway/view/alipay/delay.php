<?php
use xh\library\url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">
      <script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/jquery.min.js"></script>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   
	<title>自助充值</title>
</head>
<body>

<div id="main-container">
	<!-- <h1 class="mod-title"> <img class="ico_log"   src="/static/logo_alipay.jpg"> </h1> -->
	<style>
		*{
			margin: 0;
			padding: 0;
			border: 0; 
			font-size: 12px;
		}
		html{
			background: #fc2e2efa;
			color: #fff;
		}
		body{
			width: 90%;
			margin: 0 auto; 
		}
		.list{
			list-style: none;
			line-height: 2em; 
		}
	</style>
	


<style>
	.info{
		text-align: center;
		margin-top: 50px;  
		line-height: 2em;
	}
</style> 
	<div class="info">
	<div>收款人:<?php echo $account;?></div>
	<div>订单号:<?php echo $out_trade_no;?></div>
	<div>如有风险提示，请点继续转账:</div>

	<br>
	<div>充值金额: ￥<strong style="font-size: 30px;"><?php echo $amount;?></strong> </div>
	<br>

	<style>
		.btn{
			width: 200px; 
			background: #efcd9e;
			border-radius: 4px; 
			margin: 0 auto; 
			padding: 2px 0; 
		}
	</style>


	<div class="btn" id="btn">立即支付</div>

	
	<script>
		$(document).ready(function() {
			var s=30
			var timer=setInterval(function(){  
				$('#btn').text(s+"s")
				s--; 
				if (s<=0) {
					clearInterval(timer)
					$('#btn').text("立即支付")
					$('#btn').click(function(event) {
						 go_url = 'alipayqr://platformapi/startapp?appId=20000123&actionType=scan&biz_data={\"s\": \"money\",\"u\": \"<?php echo $pid;?>\",\"a\": \"<?php echo $amount;?>\",\"m\": \"<?php echo $trade_no;?>\"}';
	                      AlipayJSBridge.call('pushWindow', {
	                        url: go_url
	                    });
					});
				}

			},1000)


		});
	</script>


	<div>大额支付,可能会出现"陌生转账"风险提示,请继续转账</div>
	<div>为保证支付成功率,建议等待30秒后付款</div>
</div> 


	<style>
		.lc{
			border-top: 10px #e32c2c solid;  
			margin-top: 10px;
			padding-top: 10px;
		}
	</style>
	<div class="lc">
		<ul class="list">
			<li>1.点击“立即支付按钮”</li>
			<li>2.跳转至手机支付宝支付</li>
			<li>3.支付完成</li>
		</ul>
	</div>

	<style>
		.ts{
			margin-top: 10px ; 
			border-top: 10px #e32c2c solid;  
			padding-top: 10px;
		}
		.ts .small{
			font-size: 12px;
			text-align: center;
		}
	</style>
	<div class="ts">
		<div class="small">温馨提示</div>
		<ul class="list">
			<li>
				1.请确认金额一致,否则导致支付不到账
			</li>
			<li>
				2.若已支付，请勿重复支付，否则订单无效
			</li>
		</ul>
	</div>
</div>
</body>
</html>