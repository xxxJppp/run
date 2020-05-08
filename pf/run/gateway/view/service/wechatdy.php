<?php
use xh\library\url;
?>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta http-equiv="Content-Language" content="zh-cn">
<meta name="renderer" content="webkit">
<title>在线支付 - 微信安全支付</title>
<script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/qrcode.js"></script>
<script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/layer/layer.js"></script>
    <script type="text/javascript" src="/run/gateway/view/static/js/jquery.min.js"></script>
 <script type="text/javascript" src="/run/gateway/view/static/js/layer/layer.js"></script>
  <script type="text/javascript" src="/static/jquery.qrcode1.js" ></script>
<link href="<?php echo URL_VIEW;?>static/css/wechat/wechat_pay.css" rel="stylesheet" media="screen">
<style>
.switch-tip-icon-img {
    position: absolute;
    left: 70px;
    top: 70px;
    z-index: 11;

}
.shadow{  
   -webkit-box-shadow: #666 0px 0px 10px;  
   -moz-box-shadow: #666 0px 0px 10px;  
   box-shadow: #666 0px 0px 10px;  
    padding-top: 15px;
    padding-right: 5px;
    padding-bottom: 1px;
    padding-left: 5px;
   background: #FFFFFF; 
   width:240px;
  height:240px;
} 
.time-item strong {
    background:#13A500;
    color:#fff;
    line-height:30px;
    font-size:20px;
    font-family:Arial;
    padding:0 10px;
    margin-right:10px;
    border-radius:5px;
    box-shadow:1px 1px 3px rgba(0,0,0,0.2);
}
h2 {
	line-height:50px;
    font-family:"微软雅黑";
    font-size:16px;
    letter-spacing:2px;
}
</style>
</head>
<body>
<div class="body">
<h1 class="mod-title">
<span class="ico-wechat"></span><span class="text">微信支付</span>
</h1>
<div class="mod-ct">
<div class="order">
</div>
<div class="amount" style="color: red;">￥<b><?php echo $amount;?></b></div>
<br>
<div align="center">
<div class="shadow"><div align="center">
 <div class="qrcode-warp">
                    <div id="qrcode">
                    <img id="qrcode_load" src="<?php echo URL_VIEW . '/static/loading.gif';?>" style="display: block;"></div></div>
</font>
</div></div>
<h2>距离该订单过期还有</h2>
  <h4>订单号：<?php echo $trade_no;?></h4>
<div class="time-item">

  <strong id="minute_show"><s></s></strong><span style="font-size:18px">分</span>
    <strong id="second_show"><s></s></strong><span style="font-size:18px">秒</span>
</div>

</div>




<div class="tip">
<span class="dec dec-left"></span>
<span class="dec dec-right"></span>
<div class="ico-scan"></div>
<div class="tip-text">
<p>请使用微信扫一扫</p>
<p>扫描二维码完成支付</p>
</div>
</div>
<div class="tip-text">
</div>
</div>
<div class="foot">
<div class="inner">

<p>本站为第三方辅助软件服务商，与QQ财付通和腾讯网无任何关系</p>
<p>在付款前请确认收款人账户信息，转账后将立即到达对方账户</p>

</div>
</div>
</div>
  <script type="text/javascript">

   qrcode ="<?php echo $ewmurl;?>"
  var url="http://qr.liantu.com/api.php?text="+encodeURIComponent(qrcode);
  

  $('#qrcode_load').remove();
				//设置参数方式 
				var qrcode = new QRCode('qrcode', {
				  text:qrcode, 
				  width: 230, 
				  height: 230, 
				  colorDark : '#000000', 
				  colorLight : '#ffffff', 
				  correctLevel : QRCode.CorrectLevel.H 
				});
				updateQrImg = 1;
	
	$(function () {
    var timer, minutes, seconds, ci, qi;
	//var intDiff = parseInt('<?php echo ($creation_time+600) - time();?>');//倒计时总秒数量
    timer = parseInt('<?php echo ($creation_time+90)- time();?>') - 1;
    ci = setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        $("#minute_show").text(minutes);
        $("#second_show").text(seconds);
        if (--timer < 0) {
            $(".qrcode .expired").removeClass("hidden");
            $("#minute_show").text('00');
            $("#second_show").text('00');
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


</body></html>