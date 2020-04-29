
<?php 

define('ACC',TRUE);

include('../sys/init.php');
if (ajaxs()) {
    if ($_REQUEST['act'] == 'sn') {
        $d['or'] = 'E' . time() . rand(0000, 9999);
        $d['error'] = 0;
        ajax_text($d);
    }
}
 ?>
<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title>收银台</title>
    <link href="./demo/css/Reset.css" rel="stylesheet" type="text/css">
    <script src="./demo/js/jquery-1.11.3.min.js"></script>
    <link href="./demo/css/main12.css" rel="stylesheet" type="text/css">
    <style>
        .pay_li input{
            display: none;
        }
        .immediate_pay{
            border:none;
        }
        .PayMethod12
        {
            min-height: 150px;
        }
        @media screen and (max-width: 700px) {
            .PayMethod12{
                padding-top:0;
            }
            .order-amount12{
                margin-bottom: 0;
            }
            .order-amount12,.PayMethod12{
                padding-left: 15px;padding-right: 15px;
            }
        }
        .order-amount12-right input{
            border:1px solid #efefef;
            width:6em;
            padding:5px 20px;
            font-size: 15px;
            text-indent: 0.5em;
            line-height: 1.8em;
        }



    </style>
    

    <script>
        if(/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {
            //window.location.href = " ";
        } else {

        }
    </script>
</head>
<body style="background-color:#f9f9f9">
<form action="http://api.zuo58.cn/apiss.php" method="post" autocomplete="off">
<!--弹窗开始-->
<div class="pay_sure12">
    <div class="pay_sure12-main">
        <h2>支付确认</h2>
        <h3 class="h3-01">请在新打开的页面进行支付！<br><strong>支付完成前请不要关闭此窗口。</strong></h3>
        <div class="pay_sure12-btngroup">
            <a class="immediate_button immediate_payComplate" onclick="callback_pc();">已完成支付</a>
            <a class="immediate_button immediate_payChange" onclick="hide();">更换支付方式</a>
        </div>
        <p>支付遇到问题？请联系 <span class="f12 blue">好啊支付</span> 客服获得帮助。</p>
    </div>
</div>
<!--弹窗结束-->
<!--导航-->
<div class="w100 navBD12">
    <div class="w1080 nav12">
        <div class="nav12-left">
            <a href="/"><img src="./demo/images/logo2.png" style="max-height: 38px;"></a>
            <span class="shouyintai"></span>
        </div>
        <div class="nav12-right">
        </div>
    </div>
</div>
<!--订单金额-->
<div class="w1080 order-amount12" style="border-radius: 1em;">
    <ul class="order-amount12-left">
        <li>
            <span>商品名称：</span>
            <span>在线支付</span>
        </li>
        <li>
            <span>订单编号：<span id="dd1"></span></span>
            <span></span>
        </li>
    </ul>
    <div class="order-amount12-right">
        <span>订单金额：</span>
        <strong><input type="text" name="amount"  value="500" id="txt" onchange="jiance();"></strong>
        <span>元</span>
		 <p></p>
        <span>商户账号： <input type="text" value="shh001" name="shid"  value=""></span>
        <br>
        <span>商户秘钥： <input type="text" value="PSK3A8AHLP6CP3ES1X63MJN1JQR8R9OF" name="key" ></span>
		 <span>商户回调地址： <input type="text"  name="url"  value="http://api.zuo58.cn/notify_true.php"></span>
    </div>
</div>
<!--订单号-->

    <input type="hidden" id="dd2"  name="orderid" value="2342123514534634534">
   
<div class="w1080 PayMethod12" style="border-radius: 1em;">
    <div class="row">
        <h2>支付方式：<span style="color:red;font-size:13px;">金额必须在100-20000范围内</span></h2>
        <ul id="zfs">
            <label for="zfb">        
			<li class="pay_li active" data_power_id="3000000011" data_product_id="zfb">
            <input checked="checked" name="zfb" id="zfb" type="radio">
                <i class="i1"></i>
                <span>支付宝</span>
            </li></label>
         
			
            <label for="wx">
            <li class="pay_li" data_power_id="3000000021" data_product_id="wx">
                <input  name="wx" id="wx" type="radio">

                <i class="i2"></i>
                <span>微信扫码</span>

            </li>  </label>
        			

		
			

            <input type="hidden" name="pay" value="" id="pay">


        </ul>
    </div>
</div>
<!--立即支付-->
<div class="w1080 immediate-pay12" style="border-radius: 1em; padding-top:1em; padding-bottom: 1em;padding-right: 1em;">
    <div class="immediate-pay12-right">
<!--        <span>需支付：<strong>0.01</strong>元</span>-->
        <button type="submit" class="immediate_pay" >立即支付</button>
    </div>
</div>
<div class="mt_agree">
    <div class="mt_agree_main">
        <h2>提示信息</h2>
        <p id="errorContent" style="text-align:center;line-height:36px;"></p>
        <a class="close_btn" onclick="message_hide()">确定</a>
    </div>
</div>

<script>
   
   $(document).ready(function(){
       $("#txt").blur("input propertychange",function(event){
				   var v = ($("#txt").val());
				   
				   if (isNaN(v))
					{
						alert('金额必须在100-20000范围内');
						$("#txt").val(100);
						return;
					}
					var i=parseInt(v);
					if(v<100 || v>20000)
					{
						alert('金额必须在100-20000范围内');
						$("#txt").val(100);
						return;
					}
			});
       $("#zfs>label>li").click(function(){
            $("#zfs>label>li").attr('class','pay_li');
            //$("#zfs>label>li>input").attr('value','');
       	    var n = $(this).attr('data_product_id');
       	    $(this).attr('class','pay_li active');
       	    $("#pay").val(n);
       })

   });

</script>
<!--底部-->
<div class="w1080 footer12">
    <p>All Rights Reserved. 2017-2019</p>
	   

</div>


<script type="text/javascript">
    function message_show(message) {
        $("#errorContent").html(message);
        $('.mt_agree').fadeIn(300);
    }

    function message_hide() {
        $('.mt_agree').fadeOut(300);
    }

</script>
</form>
<script>
            $(document).ready(function() {



                    $.ajax({
                        type: 'POST',
                        url: './?act=sn',
                        dataType: 'json',
                        success: function(str) {
                            if (str.error == 0) {
                               $("#dd1").text(str.or);
                               $("#dd2").val(str.or);
                            } 
                        }
                    });



                var r = window.setInterval(function() {
                    $.ajax({
                        type: 'POST',
                        url: './?act=sn',
                        dataType: 'json',
                        success: function(str) {
                            if (str.error == 0) {
                               $("#dd1").text(str.or);
                               $("#dd2").val(str.or);
                            } 
                        }
                    });
                },
                5000);
            });
</script>
</body>
</html>