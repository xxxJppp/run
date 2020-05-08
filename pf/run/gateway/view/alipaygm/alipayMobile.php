<?php
use xh\library\url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0">
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>在线支付</title>
    <!--<meta http-equiv="Access-Control-Allow-Origin" content="*">-->
    <link rel="stylesheet" type="text/css" href="/static/aliscan/base.css">
    <link rel="stylesheet" type="text/css" href="/static/aliscan/save1.css">
    <link rel="stylesheet" type="text/css" href="/static/aliscan/success.css">
    <style type="text/css">
        #index {
            max-width: 750px;
            width: 100%;
            display: block;
            min-height: 100%;
            margin: 0 auto;
        }

        #box1 {
            margin: 0 auto;
        }
        #dlgTop {
            z-index: 100;position: fixed; width: 95%; max-width: 100%; margin: 0 auto;
            left:0; right: 0;bottom: -150px;
            background-color: rgba(0,0,0,.7); color: #fff;
        }


        #dlgTop *{-webkit-box-sizing: content-box; -moz-box-sizing: content-box; box-sizing: content-box;}

        .dlgShade,.dlgMain{position:fixed; left:0; top:0; width:100%; height:100%;}
        .dlgShade{background-color:rgba(0,0,0, .7); pointer-events:auto;}
        .dlgMain{display:table; font-family: Helvetica, arial, sans-serif; pointer-events: none;}
        #dlgBox{display:table-cell; text-align:center;min-width: 320px;padding-top: 10px;}
        .dlgInner{
            position:relative; display:inline-block;
            background-color:#fff;border-radius: 10px; box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            pointer-events:auto;  -webkit-overflow-scrolling: touch;-webkit-animation-fill-mode: both;
            animation-fill-mode: both; -webkit-animation-duration: .2s;animation-duration: .2s;
            width: 90%; max-width: 280px;font-size:14px;text-align:left;
        }
        #dlgCont{padding: 10px 20px; line-height: 26px; font-size: 18px; text-align:center;color: black;}
        #dlgBtn{display: -moz-box; display: -webkit-box; width: 100%; position:relative; height: 50px; line-height: 50px; font-size: 0; text-align:center;  border-top:1px solid #D0D0D0; background-color: #F2F2F2; border-radius: 0 0 10px 10px;}
        #dlgBtn span{position:relative; display: block; -moz-box-flex: 1; box-flex: 1; -webkit-box-flex: 1;  text-align:center; font-size:16px; border-radius: 0 0 10px 10px; cursor:pointer;border-right: 1px solid #D0D0D0; color: #40AFFE;}
        #dlgBtn span:active{background-color: #F6F6F6;}

        #dlgCInfo{text-align: center;color: black;}
    </style>
</head>
<body>
<div id="index">
    <div class=""></div>
        <div class="container">
        <div id="info_box">
            <div>
                <!--<div class="fcTishi hide">
                    <p class='left'>单次收款码<br>禁止多次支付！</p>
                    <img src="/order/image/btn_zdl@2x.png" alt="" style="width:44px">
                </div>	-->
                <div id="state_box2" style="display: block;">
                    <header>
                        <div class="head_box">
                            <img id="icon1" src="/static/aliscan/icon_qqqianbao@2x.png" alt="" hidden="">
                            <img id="icon2" src="/static/aliscan/logo_bank@2x.png" alt="" hidden="">
                            <img id="icon3" src="/static/aliscan/logo_weixin@2x.png" alt="" hidden="">
                            <img id="icon4" src="/static/aliscan/logo_zhifubao@2x.png" hidden="" style="display: inline;">
                            <img id="icon5" src="/static/aliscan/logo_ysf@2x.png" hidden="">
                        </div>
                    </header>
                    <div class="top_info">
                        <span class="left" id="orderState">待付款</span>
                        <span class="right" style="margin-top:13px;">支付倒计时: <span id="js_time"></span></span>
                        <div class="clear"></div>
                    </div>
                    <div id="box">
                        <p class="red_p">请按照本页面金额付款，勿自行修改支付金额，否则无法到账。此二维码仅限本次支付使用，请勿重复支付使用。本次订单有效期为5分钟，过期请勿支付。<span class="red_arrow"></span></p>
                        <div class="zf_p" :class="pay_type==&#39;banktrans&#39;?&#39;wid_p&#39;:&#39;&#39;">
                            <div>
                                <div class="clear"></div>
                            </div>
                            <div>
                                <div id="box1">
                                    <!--<img src="/order/image/icon_qwsm@2x.png" alt="" class='ts_icon'>-->
                                    <p class="money" style="color: black;">请付 <span id="money"><?php echo $amount;?></span> 元 </p>

                                    <button class="copy_button2" id="copy4" data-clipboard-target="#money" style="background: #FFF;font-size: 14px;margin:auto;display: block;height:24px;">复制金额</button>
                                    <p class="order" style="text-align: center">
                                        <span>订单号： </span>
                                        <span>
													<span id="order_id"><?php echo $trade_no;?></span>
												<button class="copy_button2" data-clipboard-target="#order_id" id="copy5" style="background: transparent;margin-left:10px">复制</button>
												</span>
                                    </p>
                                    <div class="ewm_box">
                                        <div class="cancel_div" style="display: none;">
                                            <img id="icon1" src="/static/aliscan/icon_czcg@2x.png" alt="" style="width:160px;position:absolute;left:32.5px;top:20%;display: none;">
                                            <img id="icon2" src="/static/aliscan/icon_ddcs@2x.png" alt="" style="width:160px;position:absolute;left:32.5px;top:20%;display: none;">
                                            <img id="icon3" src="/static/aliscan/icon_ddqx@2x.png" alt="" style="width:160px;position:absolute;left:32.5px;top:20%;display: none;">
                                            <img id="icon4" src="/static/aliscan/icon_ddfk@2x.png" alt="" style="width:160px;position:absolute;left:32.5px;top:20%;display: none;">
                                        </div>
                                                                                <div  style="width: 100%;margin-top: 15px;font-size: 14px;font-weight: 600;color: #ff4255">无法付款时请截图扫码支付</div>
                                                                                <div  id="ewmImg" style="width:100%; margin-top:15px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                                <div style="margin: 10px 5px;text-align: center;background: #50b7f3;padding: 10px;" onclick="dopay()">
                            <a href="javascript:;" style="color: #fff;font-size: 18px;" >立即支付</a>
                        </div>
                                            </div>

                   <!-- <div id="dlgTop">
                        <div class="dlgShade"></div>
                        <div class="dlgMain">
                            <div id="dlgBox" style="padding-top: 160px;">
                                <div class="dlgInner">
                                    <div id="dlgCont">本次交易金额：<br>【<b>300.00</b>】元<br>修改或输错不到账！ </div>
                                    <div id="dlgBtn"><span id="dlgCopy" onclick="P_copy()">复制金额</span></div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <!--<div class="tishi_div">
                        截图扫码或者长按识别二维码付款请按如下示意图操作：
                    </div>

                    <p style="text-align: center;margin-top:14px">
                        <img src="/static/aliscan/jiantou@2x.png" alt="" style="width:30px;">
                    </p>
                    <div id="wx_tishi" style="display: none">
                        <img src="/static/aliscan/tishi_02.jpg" alt="" style="max-width: 335px;margin: 10px auto 0;">
                    </div>
                    <div id="zfb_tishi" style="">
                        <img src="/static/aliscan/tishi_01.jpg" alt="" style="max-width: 335px;margin: 10px auto 0;">
                    </div>-->
                </div>
            </div>
        </div>
    </div>

    <!--<script src="/static/aliscan/jquery-2.2.4.min.js" type="text/javascript" charset="utf-8"></script>-->
    <script src="https://cdn.staticfile.org/jquery/3.3.1/jquery.min.js"></script>
    <script src="/static/aliscan/clipboard.min.js"></script>
    <script src="/static/aliscan/qrcode.min.js" type="text/javascript" charset="utf-8"></script>
 <script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/layer/layer.js"></script>
    <script>

        function isWeixinBrowser() {
            //window.navigator.userAgent属性包含了浏览器类型、版本、操作系统类型、浏览器引擎类型等信息，这个属性可以用来判断浏览器类型
            var ua = window.navigator.userAgent.toLowerCase();
            //通过正则表达式匹配ua中是否含有MicroMessenger字符串
            if(ua.match(/MicroMessenger/i) == 'micromessenger'){
                return true;
            }else{
                return false;
            }
        }
        if(isWeixinBrowser()){
            loadHtml();
        }

        /*function P_copy() {
            var clipboard = new ClipboardJS('#dlgCopy',{
                text: function() {
                    return '300.00';
                }
            });
            clipboard.on('success', function(e) {
                $('#dlgCont').hide();
                $('#dlgBtn').hide();
                $('#dlgTop').hide();
                $("#copy4").html("复制成功")
                $("#copy4").addClass("gray")
                clearTimeout(copy4T);
                copy4T = setTimeout(function() {
                    $("#copy4").html("复制金额")
                    $("#copy4").removeClass("gray")
                }, 2000)
                e.clearSelection()
            });
            clipboard.on('error', function(e) {
                $('#dlgCont').hide();
                $('#dlgBtn').hide();
                $('#dlgTop').hide();
                $("#copy4").html("复制失败,请长按金额手动复制")
                $("#copy4").addClass("gray")
                clearTimeout(copy4T);
                copy4T = setTimeout(function() {
                    $("#copy4").html("复制金额")
                    $("#copy4").removeClass("gray")
                }, 2000)
                e.clearSelection()
            });
        }*/

        function dopay(){
            window.location.href='<?php echo $pid ?>';
        }
        $("#ewmImg").qrcode({
            width: 200, //宽度
            height:200, //高度
            text: "<?php echo $pid ?>" //任意内容
        });
        function loadHtml(){
            var div = document.createElement('div');
            div.id = 'weixin-tip';
            div.innerHTML = '<p style="text-align:right"><img src="__API__/images/live_weixin.png" width="70%" alt="微信打开"/></p>';
            document.body.appendChild(div);
        }

        var leftStr = '<?php echo ($creation_time+300)- time();?>';
        leftTime = parseInt(leftStr);
        var code = '00';
        var sec = 0;
        function countTime() {
            sec ++;
            //获取当前时间
            //时间差
            leftTime -=1;
            //定义变量 d,h,m,s保存倒计时的时间
            var h,m,s;
            if (leftTime>=0) {
                h = Math.floor(leftTime/60/60%24);
                m = Math.floor(leftTime/60%60);
                s = Math.floor(leftTime%60);
            }
            //将倒计时赋值到div中
            if(h<10){
                h = '0'+h;
            }
            if(m<10){
                m = '0'+m;
            }
            if(s<10){
                s = '0'+s;
            }
            $("#js_time").html(h+":"+m+":"+s)
            if(m=='00' && s=='00'){
               daoqi();
                setTimeout(function(){
                    window.location.reload();
                },3000)
            }
            if(sec>3){
                sec = 0;
                //queryOrder();
            }
            //递归每秒调用countTime方法，显示动态时间效果
            if(code=='00'){
                setTimeout(countTime,1000);
            }
        }
        countTime();


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
    	$.get("<?php echo url::s('gateway/pay/automaticalipaygmQuery',"id={$id}");?>", function(result){
        	
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

        var  copy4T, copy5T;
        var clipboard4 = new ClipboardJS('#copy4');
        clipboard4.on('success', function(e) {
            $("#copy4").html("复制成功")
            $("#copy4").addClass("gray")
            clearTimeout(copy4T);
            copy4T = setTimeout(function() {
                $("#copy4").html("复制金额")
                $("#copy4").removeClass("gray")
            }, 2000)
            e.clearSelection()
        });
        var clipboard5 = new ClipboardJS('#copy5');
        clipboard5.on('success', function(e) {
            $("#copy5").html("复制成功")
            $("#copy5").addClass("gray")
            clearTimeout(copy5T);
            copy5T = setTimeout(function() {
                $("#copy5").html("复制")
                $("#copy5").removeClass("gray")
            }, 2000)
            e.clearSelection()
        });

    </script>
    </div>
</body>
</html>