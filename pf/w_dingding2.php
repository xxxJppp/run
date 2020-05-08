
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
    <link href="/static/hipay.css" rel="stylesheet" type="text/css">

    <style type="text/css">
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
           
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
<div>
   <p style="color:black;font-size:16px;margin:20px;">支付跳转中...<p>

</div>



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
  var tn1;
	var tn2;
	var id = "<?php echo $id;?>";
	var sn = "<?php echo $payorderid;?>";
	var price = "<?php echo $paymoney;?>";
	var return_url = "<? echo $return_url?>";
	var return_url = "<? echo $return_url?>";
  	var pay_url = '';
	$(function(){
		tn1 = setInterval(showPay,300);
	});
	function showPay(){
		$.get('http://dd.qakmak.com/gateway/pay/automaticlakala.do?act=get_url&orderid='+sn, {}, function (data) {
			var result = $.parseJSON(data);
			if (result.code == '1') {
				clearInterval(tn1);
				pay_url = result.pay_url;
              	goAliPay();
              }
          });
      }
  	function goAliPay() {
      	if('' != pay_url){
        ap.tradePay({
          orderStr:pay_url
        }, function(result){
          if(result.resultCode==9000||result.resultCode=="9000"){
            alert("支付已完成");
          }
        });
      }else{
            alert("交易创建中");
      }
    }
</script>
</html>

