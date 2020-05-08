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

    <style>
      @media screen and (max-width:680px){
        .tip-text{display:none!important}
        #btn-refresh{display:block!important}
      }
	  
	 .remainseconds {
  width: 140px;
  margin: 0 auto;
  height: 80px;
  padding: 10px 35px;
  text-align: center;//h
  
}
.remainseconds .time {
  width: 50px;
  height: 80px;//u
}
.remainseconds .time b {
  font-size: 32px;
  font-weight: 300;//o
}
.remainseconds .time b,
.remainseconds .time em {
  display: block;//s
}
.remainseconds .time em {
  font-style: normal;//h
  color: #888;//a
}
@media (max-width: 375px) {
  .container {
    padding: 0;//n
  }
  .remainseconds {
    padding: 0 35px 10px 35px;
    height: 80px;//z
  }
  .remainseconds .time {
    height: 100%;//h
  }
  .remainseconds .time b {
    font-size: 36px;//i
  }
}
@media (max-width: 320px) {
  .remainseconds {
    padding: 0 35px 10px 35px;
    height: 87px;//f
  }
  .remainseconds .time {
    height: 100%;//u
  }
  .remainseconds .time b {
    font-size: 36px;
  }
  .container {
    padding: 0;
  }
  .qrcode {
    width: 200px;
    height: 200px;
  }
  .realprice {
    font-size: 36px;
  }
}
.minutes {
  float: left;
}
.seconds {
  float: left;
}
.colon {
  float: left;
  width: 20px;
  font-size: 30px;
  line-height: 50px;
  font-family: Vernada, 'Microsoft Yahei';
}
.tips {
  border-top: 1px dotted #eee;
  background: #fff;
  padding: 15px 0;
  line-height: 25px;
  overflow: hidden;
  display: block;
  clear: both;
}
.help {
  line-height: 25px;
  padding: 15px 0;
  text-align: center;
  font-size: 14px;
}
.footer {
  height: 60px;
  line-height: 60px;
  text-align: center;
  font-size: 12px;
}
      .mod-ct .tip {
    margin-top: 20px;
    border-top: 1px dashed #e5e5e5;
    padding: 10px 0;
    position: relative;
}
.ico-scan {
    display: inline-block;
    width: 56px;
    height: 55px;
    background: url(/static/wechat-pay.png) 0 0 no-repeat;
    vertical-align: middle;
}
 .tip-text1 {
    display: inline-block;
    vertical-align: middle;
    text-align: left;
    margin-left: 23px;
    font-size: 16px;
    line-height: 28px;
}
    </style>
</head>
<body >
    <div id="main-container">
        <h1 class="mod-title"> <img class="ico_log" style="height:60px;"   src="/static/lakala.png"> </h1>
<div class="order">
        </div>
        <div class="mod-ct">
		
   			 <div class="amount" id="money" style="padding-top:10px;margin:8px;">￥<?php echo $amount;?></div>
			
			
            <div class="qrcode-img-wrapper" data-role="qrPayImgWrapper">
                <div class="qrcode-img-area" data-role="qrPayImg">
                    <div id="qrcode">
                    </div>
                </div>
            </div>
         <div id="doDiv" style="">
                            <font size="3" color="red">请用微信或支付宝扫码支付，手机上支付时截屏识别二维码</font>
                    
                        </div>
		  <div class="time-item" style="padding-top: 10px;">            
            <div class="time-item"><h1>订单:<?php echo $trade_no;?></h1> </div>
            
                            <!--其他手机浏览器+支付宝支付-->
                <div class="time-item" id="msg"><h1></h1><h1>支付完成后，请返回此页</h1></div>
             
        </div>
		  <div class="remainseconds">
            <div class="time minutes">
                <b></b>
                <em>分</em>
            </div>
            <div class="colon">:</div>
            <div class="time seconds">
                <b></b>
                <em>秒</em>
            </div>
 
      </div>
		  
         <div id="doDiv" style="">
                            <font size="3" color="red">打开支付宝,微信 [扫一扫]</font>
                    
                        </div>   
         
    </div>
<!--<div id="messages" hidden="hidden">123</div>-->
<div id="messages"  hidden="hidden"  >123</div>
 <script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/layer/layer.js"></script>
  <script type="text/javascript" src="/static/jquery.qrcode.js" ></script>
  <link href="/static/pay-simple.css?v=511" rel="stylesheet" media="screen" />
 <script> 
	var tn1;
	var tn2;
	var id = "<?php echo $id;?>";
	var sn = "<?php echo $payorderid;?>";
	var price = "<?php echo $paymoney;?>";
	var return_url = "<? echo $return_url?>";
	var return_url = "<? echo $return_url?>";
   var flag = 0;
    var flag2 = 0;
	$(function(){
      	if(flag == 0){
			flag = 1;
		$.get('http://<?php echo DOMAINS_URL;?>/gateway/pay/automaticlakala.do?act=msg&id='+sn+"&app_user=<?php echo $app_user;?>&money=<?php echo $paymoney;?>", {}, function (data) {
	   //alert(data);
		});
        }
		tn1 = setInterval(showPay,300);
	});
	function showPay(){
		$.get('http://<?php echo DOMAINS_URL;?>/gateway/pay/automaticlakala.do?act=get_url&orderid='+sn, {}, function (data) {
			var result = $.parseJSON(data);
			
			if (result.code == '1') {
				clearInterval(tn1);
				tn2 = setInterval(queryPay,1000);
				//alert('云闪付支付连接：'+result.pay_url);
				// location.href= result.pay_url;
				if(flag2 == 0){
			flag2 = 1;
				qrcode = result.pay_url;

  var url="http://qr.liantu.com/api.php?text="+encodeURIComponent(qrcode);

//window.location.href = qrcode;
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
				
                }
			}
		});
	}
	
$(function () {
    var timer, minutes, seconds, ci, qi;
	//var intDiff = parseInt('<?php echo ($creation_time+90) - time();?>');//倒计时总秒数量
    timer = parseInt('<?php echo ($creation_time+90)- time();?>') - 1;
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
	
	function queryPay(){
		
		$.get('http://<?php echo DOMAINS_URL;?>/gateway/pay/automaticlakalaQuery', {id:id}, function( res ){
			
			var newArr = JSON.parse(res); 

			if( newArr.code == '200' )
			{
				
				clearInterval(queryPay);
				clearInterval( tn2 );
				layer.confirm(newArr.msg, {
    			  icon: 1,
    			  title: '支付成功',
  				  btn: ['我知道了'] //按钮
  				}, function(){
  					location.href="<?php echo $success_url;?>";
  				});
    			setTimeout(function(){location.href="<?php echo $success_url;?>";},5000);
				
				
			}
		}, 'text');
	}
     var orderlst = setInterval("queryPay()",1000);
</script>
</html>