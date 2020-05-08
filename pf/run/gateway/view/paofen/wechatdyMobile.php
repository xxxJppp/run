<?php
use xh\library\url;
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
        <title>在线支付 - 微信安全支付</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL_VIEW;?>static/css/mobile/QRCode.css">
        <script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/jquery.min.js"></script>
     <script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/board.js"></script>
 		<script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/qrcode.js"></script>
 		<script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/layer/layer.js"></script>
 		<link href="<?php echo URL_VIEW;?>static/css/wechat/wechat_pay.css" rel="stylesheet" media="screen">
    </head>
    <body>
    <div style="width: 100%; text-align: center;font-family:微软雅黑;">
        <div id="panelWrap" class="panel-wrap">
            <!-- CUSTOM LOGO -->
            <div class="panel-heading">
                <div class="row">
             	<div class="col-md-12 text-center">
                  <h1 class="mod-title">
<span class="ico-wechat"></span><span class="text">微信支付</span>
</h1>
             </div>
              
                </div>
            </div>
            <!-- PANEL TlogoEMPLATE START -->
            <div class="panel panel-easypay">
                <!-- PANEL HEADER -->
                <div class="panel-heading">
                    <h3>
                        <small>订单号：<?php echo $trade_no;?></small>
 
                    </h3>
                    <div class="money">
                        <span class="price"><?php echo $amount;?></span>
                        <span class="currency">元</span>
                    </div>
                </div>
                <div class="qrcode-warp">
                    <div id="qrcode">
                    <img id="qrcode_load" src="<?php echo URL_VIEW . '/static/loading.gif';?>" style="display: block;"></div></div>
                <div class="panel-footer">
                    <!-- SYSTEM MESSAGE -->
                    <span id="Span1" class="warning" style="color:red;"><small>1.手机截屏 <br> 2.打开微信扫一扫，右上角从相册选择图片(查看) <br> 3.完成支付</small></span>
                </div>
                <div class="panel-footer">
                    <input type="button" id="copy" data-clipboard-text="<?php echo $amount;?>" value="点击复制金额" class="btn  btn-primary btn-lg btn-block">
                </div>
              
               <div class="panel-footer">
                    <input type="button" onclick="tiao()"  value="跳转到微信" class="btn  btn-primary btn-lg btn-block">
                </div>
              
                            </div>
 
        </div>
    </div>
  <script type="text/javascript">

 
$(function(){

var clipboard = new Clipboard('#copy',{  
       text: function(trigger) { 
alert("复制成功！长安识别二维码粘贴金额付款吧！");
   return trigger.getAttribute('data-clipboard-text');  
       }
   });

});

    
    
   qrcode ="<?php echo $ewm_url;?>"
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
    timer = parseInt('<?php echo ($creation_time+300)- time();?>') - 1;
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

     function tiao(){
  window.location.href="weixin://dl";
  }

    
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
    	$.get("<?php echo url::s('gateway/pay/automaticpaofenQuery',"id={$id}");?>", function(result){
        	
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