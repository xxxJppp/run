<?php
use xh\library\url;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="keywords" content="订单状态详情">
    <meta name="description" content="订单状态详情">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>订单状态详情</title>

    <!-- 引入页面公用的css和js -->
    <link rel="stylesheet" type="text/css" href="/static/bank_pay/common.v2.css" />
    <script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo URL_VIEW;?>static/js/layer/layer.js"></script>

    <!-- 引入该页面单独需要的css和js -->
    <link rel="stylesheet" type="text/css" href="/static/bank_pay/orderDetailPay.v3.css" />
    <script type="text/javascript" src="/static/bank_pay/rem.js?v=2"></script>
    <style id="rootFontSize">html{font-size: 10px !important;}</style>
</head>

<body>
  <style>
     .remainseconds {
  width: 140px;
  margin: 0 auto;
  height: 64px;
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
  </style>
<div class="layout_container">
    <!-- header -->
    <div class="layout_header">
        <div class="header_bar">
            
            <span class="header_bar_logo" ></span>
            <span class="header_bar_title">支付订单</span>
        </div>
    </div>
    <!-- body -->
    <div class="layout_body">
        <!-- 支付方式 -->
        <!-- 订单超时取消 -->
        <div class="container_box paytype_box gac-flex">
            <div class="paytype_label flex-item">
                    <span id="alipay">
                        <!--待优化,cardType可移除-->
 
               <img src="/static/bank_pay/detail_alipay.png" />
 
                        <span>支付宝转银行卡</span>
                    </span>
              
               <img src="/static/bank_pay/detail_wechat.png" style="margin-left:30px" />
 
                        <span>微信转银行卡</span>
                    </span>
            </div>
          
        </div>

        <!-- 详情部分 -->
        <div class="container_box">
            <div class="detail_lisorderMoneyBtnt list-money detail_list">
                <div class="list_label">金额：</div>
                <div class="list_content line-money">

                    <div class="amountRadmon amountRmb btn-copy" data-clipboard-target="#orderAmountRmb" id="orderAmountBtn" onclick="copyAmountClick()" style="display: none;">
                        点击复制金额<span class="radmonFont">(已随机生成小数)</span>
                    </div>
                    <span style="font-size:2.5rem;color:#303133;">￥</span>
                    <span class="order_money has_gac_copy_tips"  >
                            <span style="border: dashed 0.1rem #808695;display: inline-block;height: 3rem; font-size:2.5rem;color:#303133;" data-clipboard-target="#orderAmountRmb" id="orderAmountRmb"><?php echo $amount;?></span>
                            <!--<span id="orderMoneyBtn"  class="btn-copy" style="font-size: 1.2rem;color: #a8a8a8;">复制</span>-->
                         <span id="orderMoneyBtn" data-clipboard-target="#orderAmountRmb" class="btn-copy" style="font-size: 1.2rem;color: #a8a8a8;">复制</span>
                        <!-- 要想弹出复制的tips浮动框，点击的元素的class必须要有has_gac_copy_tips-->
                            <div class="gac-copy-tips">
                                <div class="copy-tips-arrow"></div>
                                <div class="copy-tips-content copy_click" >点击复制</div>
                            </div>
                        </span>
                    <!--
                    <img class="line-img" src="hand.jpg" />
                    <span class="line-tip">客服会按此金额为您充值，请放心转账</span>
                    -->

                    <!--
                    </span>
                    -->
                </div>


            </div>
            <!-- 要想弹出复制的tips浮动框，点击的元素的class必须要有has_gac_copy_tips-->
            <div class="detail_list">
                <div class="list_label">姓名：</div>
                <div class="list_content">
                        <span class="order_name has_gac_copy_tips"  >
                            <span id="orderName" style="border-bottom: dashed 0.1rem #808695" data-clipboard-target="#orderName" ><?php echo $gathering_name;?></span>
                            <span data-clipboard-target="#orderName" class="btn-copy" style="font-size: 1.2rem;color: #a8a8a8;">复制</span>
                            <!-- 要想弹出复制的tips浮动框，点击的元素的class必须要有has_gac_copy_tips-->
                            <div class="gac-copy-tips">
                                <div class="copy-tips-arrow"></div>
                                <!-- 复制需要指定data-clipboard-targrt对应元素的id或者class -->
                                <div class="copy-tips-content copy_click">点击复制</div>
                            </div>
                        </span>
                </div>
            </div>
            <div class="detail_list">
                <div class="list_label">卡号：</div>
                <div class="list_content">
                    <div class="amountRadmon amountCardNo btn-copy" id="amountCardNo" data-clipboard-target="#orderBankNo" onclick="copyCardNoClick()" style="display: none">
                        点击复制卡号<span class="radmonFont">(每次下单随机匹配卡号)</span>
                    </div>
                        <span class="order_bank_no has_gac_copy_tips"  >
                            <span id="orderBankNo" style="font-weight:bold;font-size:1.6rem;border-bottom: dashed 0.1rem #808695"
                                  data-clipboard-target="#orderBankNo"><?php echo $account_no;?></span>
                            <span data-clipboard-target="#orderBankNo" class="btn-copy" style="font-size: 1.2rem;color: #a8a8a8;">复制</span>
                            <!-- 要想弹出复制的tips浮动框，点击的元素的class必须要有has_gac_copy_tips-->
                            <div class="gac-copy-tips">
                                <div class="copy-tips-arrow"></div>
                                <!-- 复制需要指定data-clipboard-targrt对应元素的id或者class -->
                                <div class="copy-tips-content copy_click">点击复制</div>
                            </div>
                        </span>
                </div>
            </div>
          
            <div class="detail_list">
                <div class="list_label">银行：</div>
                <div class="list_content">
                    <span class="order_bank_name has_gac_copy_tips"  >
                        <span id="orderBankName" style="border-bottom: dashed 0.1rem #808695" data-clipboard-target="#orderBankName" ><?php echo $bank_name;?></span>
                        <span data-clipboard-target="#orderBankName" class="btn-copy" style="font-size: 1.2rem;color: #a8a8a8;">复制</span>
                        <!-- 要想弹出复制的tips浮动框，点击的元素的class必须要有has_gac_copy_tips-->
                        <div class="gac-copy-tips">
                            <div class="copy-tips-arrow"></div>
                            <!-- 复制需要指定data-clipboard-targrt对应元素的id或者class -->
                            <div class="copy-tips-content copy_click">点击复制</div>
                        </div>
                    </span>
                </div>
            </div>
           
          
            <!-- 转账提示 -->
            <div class="container_box">
                <div class="status_tips" style="padding: 1rem 0">转账金额和银行卡号必须与订单完全一致，<div>否则无法充值，造成损失自负！</div></div>
            </div>
			
			<p style="text-align:center">  <button class="btn-success" onclick="showImage()">支付宝如何转账</button> <button class="btn-success" onclick="showImage2()">微信如何转账</button></p>
          
   
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
            <p style="text-align:center;font-size:16px">订单号：<?php echo $trade_no;?></p>
        
          
          <p style="font-size:18px;color:red"><span id="Span1" class="warning"><t style="color:#FF5722;font-weight: bold;font-size: 13px;">如果手机已经安装以下任一APP，请点击对应的立即支付接口，或者请下载安装以下任一APP,然后点击立即支付即可</t></span> 
</p>
 
          
            <p style="text-align:center" id="ioskoubei"> 
                          <a style="background: #009fe9;
                                    display: inline-block;
                                    width: 80%;
                                    line-height: 3.2rem;
                                    font-size: 1.6rem;
                                    text-align: center;
                                    vertical-align: bottom;
                                    border-radius: 5px 5px;
                                    position: relative;
                                   text-decoration: none;
    margin: 1% 2.5%;" class="btn-success" href="koubei://platformapi/startapp?appId=68687256&url=https%3a%2f%2fds.alipay.com%2f%3ffrom%3dmobilecodec%26scheme%3dalipays%253a%252f%252fplatformapi%252fstartapp%253fappId%253d09999988%2526actionType%253dtoCard%2526sourceId%253dbill%2526cardNo%253d*%25e8%25af%25b7%25e5%258b%25bf%25e4%25bf%25ae%25e6%2594%25b9%25e9%2587%2591%25e9%25a2%259d*%2526bankAccount%253d<?php echo $gathering_namee;?>%2526money%253d<?php echo $amount;?>%2526amount%253d<?php echo $amount;?>%2526bankMark%253d<?php echo $bank_id;?>%2526bankName%253d%2526cardIndex%253d<?php echo $cardid;?>%2526cardNoHidden%253dtrue%2526cardChannel%253dHISTORY_CARD%2526orderSource%253dfrom">口碑跳转支付</a></p>
          
 
          
           <p style="text-align:center" id="aeleme"> 
                          <a style="background: #009fe9;
                                    display: inline-block;
                                    width: 80%;
                                    line-height: 3.2rem;
                                    font-size: 1.6rem;
                                    text-align: center;
                                    vertical-align: bottom;
                                    border-radius: 5px 5px;
                                    position: relative;
                                   text-decoration: none;
    margin: 1% 2.5%;" class="btn-success" href="eleme://web_overlay?url=https%3A%2F%2Fds.alipay.com%2F%3Ffrom%3Dmobilecodec%26scheme%3Dalipays%253A%252F%252Fplatformapi%252Fstartapp%253FappId%253D20000200%2526actionType%253DtoCard%2526sourceId%253Dbill%2526cardNo%253D<?php echo $account_no;?>%2526bankAccount%253D<?php echo $gathering_name;?>%2526money%253D<?php echo $amount;?>%2526amount%253D<?php echo $amount;?>%2526bankMark%253D<?php echo $bank_id;?>%2526bankName%253D%2526ap_framework_sceneId%253D20000200%2526REALLY_STARTAPP%253Dtrue%2526startFromExternal%253Dfalse%2526orderSource%253Dfrom">饿了么跳转支付</a></p>
          
           <p style="text-align:center" id="axianyu"> 
                          <a style="background: #009fe9;
                                    display: inline-block;
                                    width: 80%;
                                    line-height: 3.2rem;
                                    font-size: 1.6rem;
                                    text-align: center;
                                    vertical-align: bottom;
                                    border-radius: 5px 5px;
                                    position: relative;
                                   text-decoration: none;
    margin: 1% 2.5%;" class="btn-success" href="fleamarket://home?_from__=qrcapture&amp;forward_url=https%3A%2F%2Fds.alipay.com%2F%3Ffrom%3Dmobilecodec%26scheme%3Dalipays%253A%252F%252Fplatformapi%252Fstartapp%253FappId%253D20000200%2526actionType%253DtoCard%2526sourceId%253Dbill%2526cardNo%253D<?php echo $account_no;?>%2526bankAccount%253D<?php echo $gathering_name;?>%2526money%253D<?php echo $amount;?>%2526amount%253D<?php echo $amount;?>%2526bankMark%253D<?php echo $bank_id;?>%2526bankName%253D%2526ap_framework_sceneId%253D20000200%2526REALLY_STARTAPP%253Dtrue%2526startFromExternal%253Dfalse%2526orderSource%253Dfrom">闲鱼跳转支付</a></p>
           
           <p style="text-align:center" id="aalibaba"> 
                          <a style="background: #009fe9;
                                    display: inline-block;
                                    width: 80%;
                                    line-height: 3.2rem;
                                    font-size: 1.6rem;
                                    text-align: center;
                                    vertical-align: bottom;
                                    border-radius: 5px 5px;
                                    position: relative;
                                   text-decoration: none;
    margin: 1% 2.5%;" class="btn-success" href="wireless1688://ma.m.1688.com/fromwap?tonative=alipays%3A%2F%2Fplatformapi%2Fstartapp%3FappId%3D20000200%2526actionType%253DtoCard%2526sourceId%253Dbill%2526cardNo%253D<?php echo $account_no;?>%2526bankAccount%253D<?php echo $gathering_name;?>%2526money%253D<?php echo $amount;?>%2526amount%253D<?php echo $amount;?>%2526bankMark%253D<?php echo $bank_id;?>%2526bankName%253D%2526ap_framework_sceneId%253D20000200%2526REALLY_STARTAPP%253Dtrue%2526startFromExternal%253Dfalse%2526orderSource%253Dfrom">阿里巴巴跳转支付</a></p>
           
         
          
          <p style="text-align:center"> 
                          <a style="background: #009fe9;
                                    display: inline-block;
                                    width: 80%;
                                    line-height: 3.2rem;
                                    font-size: 1.6rem;
                                    text-align: center;
                                    vertical-align: bottom;
                                    border-radius: 5px 5px;
                                    position: relative;
                                   text-decoration: none;
    margin: 6% 2.5%;" class="btn-success" href="alipays://platformapi/startapp?saId=20000067&amp;url=http%3a%2f%2f<?php echo DOMAINS_URL;?>%2fgateway%2fpay%2ftobank.do%3fid%3d<?php echo $id;?>">点击打开支付宝支付(飞行模式)</a></p>

          
               
       
            
        </div>

  
        <!-- 引导提示部分 -->
        <!-- 引导提示的遮罩层 -->


        <div class="gac-modal guide_modal" style="display:none;" id="guide_modal"> </div>


        <!-- 银行卡引导提示 -->

        <div class="guide_money_box" id="guide_money_box" style="display: none;">
            <img id="group1Img" class="guide_content1" border="0" src="group1.png"  onclick="guideStep1()"/>
            <!--
            <map id="group1" name="group1">
                <area shape="rectangle" coords="0,0,456,202.22" nohref="nohref" >
            </map>
        -->
        </div>

        <!-- 银行卡引导提示 -->
        <div class="guide_bank_box" id="guide_bank_box" style="display: none;">
            <!--usemap="#group2"-->
            <img id="group2Img" class="guide_content2" src="group2.png" border="0"  onclick="guideStep2()"/>
            <map id="group2" name="group2">
                <area shape="rectangle" coords="0,0,456,202.22" nohref="nohref" >
            </map>
            <!--<img class="guide_arrow2" src="guide_arrow2.png" />-->
            <!--<img class="guide_desc2" src="guide_desc2.png" onclick="guideStep2()"/>-->
            <!--<img class="guide_hand2" src="guide_hand.png" onclick="guideStep2()"/>-->
        </div>

    </div>
 
   
</div>




<!-- 温馨提示弹框 -->
<div class="gac-modal" style="display:none;" id="reminder_modal">
    <div class="modal-container">
        <div class="container-body">
            <div>1.请务必按照下单金额真实转账，否则无法充值成功</div>
            <div>2.转账成功后，如未充值到账，请联系平台客服</div>
            <div>3.再次充值，请务必先下单，并按照订单的收款账户转账</div>
        </div>
        <div class="container-footer">
            <button class="btn-success" onclick="hideReminderModal()">知道了</button>
        </div>
    </div>
</div>



<!-- 支付操作引导 -->
<div id="image-modal" class="image-modal" style="display:none;">
    <div class="btn-close" onclick="showImage(true)">X</div>
    <img src="/static/bank_pay/ALIPAY_BANK_BOOT.png">
    
    
    
    <button class="btn-know" onclick="showImage(true)">知道了</button>
</div>
  
  <div id="image-modal2" class="image-modal" style="display:none;">
    <div class="btn-close" onclick="showImage2(true)">X</div>
    <img src="/static/bank_pay/WECHAT_BANK_BOOT.png">
    
    
    
    <button class="btn-know" onclick="showImage2(true)">知道了</button>
</div>

<!-- 全局的toast提示 -->
<div class="gac-toast">
    复制成功
</div>
<!--金额复制弹出提示-->
<div class="gac-toastRMB">
    <div>
        金额复制成功
    </div>
    <div>
        系统会按此金额为您充值请放心转账
    </div>
</div>
<!--卡号复制弹出提示-->
<div class="gac-toastCardNo">
    <div>
        卡号复制成功
    </div>
    <div>
        请放心向该账户转账
    </div>
</div>





<!--  -->

<!--<script src="https://code.jquery.com/jquery-1.12.4.min.js"-->
        <!--integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="-->
        <!--crossorigin="anonymous"></script>-->
<!--<script>window.jQuery || document.write(unescape("%3Cscript src='/fast-pay-v2/libs/jquery.min.js?v=1' type='text/javascript'%3E%3C/script%3E"))</script>-->
<script type="text/javascript" src="/static/bank_pay/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/static/bank_pay/clipboard.min.js"></script>
<script type="text/javascript" src="/static/bank_pay/common.js?v=2"></script>
<script type="text/javascript" src="/static/bank_pay/config.js?v=2"></script>
<script type="text/javascript" src="/static/bank_pay/ajax.js?v=2"></script>
<script type="text/javascript" src="/static/bank_pay/detail.js?v=2"></script>
<script type="text/javascript" src="/static/bank_pay/chat.js?v=2"></script>
<!-- 页面的js操作 -->
<script>
  if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) { //判断iPhone|iPad|iPod|iOS
  $(aeleme).hide();
  $(axianyu).hide();
  $(aalibaba).hide();

} else if (/(Android)/i.test(navigator.userAgent)) {  //判断Android
 $(ioskoubei).hide();
} 
  
  tishi();
  function tishi(){
  
 var index = layer.confirm("系统推荐手动转卡：<br>" +
                            "1.&nbsp;复制姓名,卡号 手动转卡大约需要20s<br>" +
                            "2.&nbsp;支付宝自动跳转需要开关飞行模式<br>" +
                         "点击下方的 '点击启动支付宝支付' 按钮"  , {
    			  icon: 1,
    			  title: '提醒',
  				  btn: ['确认'] //按钮
  				}, function(){
  					 layer.close(index);
  				});
    
  }
  
  	$(function () {
    var timer, minutes, seconds, ci, qi;
	//var intDiff = parseInt('<?php echo ($creation_time+300) - time();?>');//倒计时总秒数量
    timer = parseInt('<?php echo ($creation_time+300)- time();?>') - 1;
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
	
  
  
   /**
     * 复制文字的方法
     */
    var copyTimer = null;

    /**
     * 订单时间倒计时方法
     */
    var countdownTimer = null;
    var merchantName;
    var tradeId;
    var preFlag;
    var fastSubName;
    var buyVo = {"tradeStatus":2,"tradeId":"19070620435160147","createTime":"2019-07-06 20:43:51","amountGac":1009000,"fundPrice":1.0,"amountRmb":1009000,"acptName":"dh11111","fundCharge":30300,"cardInfo":{"cardType":"BANK_CARD","cardUq":"6230 2005 3052 3625","bankName":"\u534E\u590F\u94F6\u884C","bankSubName":"\u798F\u5EFA\u7701\u664B\u6C5F\u5E02\u652F\u884C","img":null,"bankAccName":"\u9093\u6B22","bankShort":null,"cardId":null,"alipayPid":null},"payReferNo":"662189","payOvertime":"2019-07-06 20:53:51","acptBzzGac":100000000,"fastFlag":null,"appendInfo":null,"paramCardType":"ALIPAY_BANK","historySuccCount":0,"matchFailReason":null,"dischargeTime":null,"cancelTime":null,"cancelType":0,"realTradeId":null,"merchantAccount":"caz123","fastSubName":"1","userInputRmb":1000000,"afterTradeUq":null,"reboot":null};
    console.log(buyVo);
    // alert("由于您所选支付通道当前订单量过大，为保证您能快速完成充值，已为您切换至其他通道，请放心转账")
    var cardInfo = {"cardType":"BANK_CARD","cardUq":"6230 2005 3052 3625","bankName":"\u534E\u590F\u94F6\u884C","bankSubName":"\u798F\u5EFA\u7701\u664B\u6C5F\u5E02\u652F\u884C","img":null,"bankAccName":"\u9093\u6B22","bankShort":null,"cardId":null,"alipayPid":null};
    var userCardType = "\u652F\u4ED8\u5B9D\u8F6C\u94F6\u884C\u5361";
    var cardTypeName = "\u94F6\u884C\u5361";

    merchantName = "caz123";
    tradeId = "19070620435160147";
    preFlag = "N";
    fastSubName = "1";
    // cardInfo.cardType: ("卡类型=={\"BANK_CARD\":\"银行卡\",\"ALIPAY\":\"支付宝\",\"WECHAT\":\"微信\",\"QUICKPASS\":\"云闪付\"}")
    // 倒计时开始
    var time= "2019-07-06 20:53:51"
    //  服务器时间
    var nowTime= 1562417031837
    var amountRmb = 1009000;
    /**
     * 打开转账引导图片
     * WECHAT( 3000000,19990000L,"WECHAT", "微信扫码"),
     ALIPAY(1000000,99990000L,"ALIPAY", "支付宝扫码"),
     BANK_CARD(100000,499990000L,"BANK_CARD", "银行卡"),
     QUICKPASS(100000,49990000L,"QUICKPASS", "云闪付"),
     ALIPAY_BANK(100000,499990000L,"ALIPAY_BANK", "支付宝转银行卡"),
     WECHAT_BANK(100000,499990000L,"WECHAT_BANK", "微信转银行卡"),
     BUSINESS_ALIPAY(1000000,499990000L,"BUSINESS_ALIPAY", "支付宝快捷支付"),
     BUSINESS_ALIPAY_BANK(100000,499990000L,"BUSINESS_ALIPAY_BANK", "支付宝扫码转银行卡");
     */
    var showImage = function(isHide) {
        if (isHide) {
            $("#image-modal").hide(100);
        } else {
            $("#image-modal").show(100);
        }
    }
 var showImage2 = function(isHide) {
        if (isHide) {
            $("#image-modal2").hide(100);
        } else {
            $("#image-modal2").show(100);
        }
    }
    /**
     * 点击右下角反馈按钮，通过反馈状态来判断是添加反馈还是查看反馈记录
     */
    function showFeedbackOrDetailModal(){
        showFeedbackModal();
    }
    /**
     * 立即咨询反馈
     */
    function showFeedbackModal() {
        $("#feedback_modal").show();
    }
    function hideFeedbackModal() {
        $("#feedback_modal").hide();
    }
    function sureFeedbackModal() {
        $("#feedback_modal").hide();
    }
    /**
     * 咨询查看记录
     */
    function showFeedbackDetailModal() {
        $("#feedback_detail_modal").show();
    }
    function hideFeedbackDetailModal() {
        $("#feedback_detail_modal").hide();
    }
    function sureFeedbackDetailModal() {
        $("#feedback_detail_modal").hide();
    }


    // ready
    $(document).ready(function(){
        countdownTime(time,nowTime)
        qryOrderStatus(tradeId,merchantName);
        alertPayType();
        // 引导提示
        var ifDecimals = true;
        console.log("ifDecimals:" + ifDecimals);
        if (ifDecimals)
            showGuide();

        // 点击除tips外的页面关闭tips提示
        $(document).click(function (e) {
            if (!$(e.target).closest(".has_gac_copy_tips,.gac-modal,.guide_money_box,.guide_bank_box").length) {
                $(".gac-copy-tips").hide();
            }
        })

        //  小数分离显示，因为没有第三位小数，所以直接四舍五入取两位小数
        /*
        var amountRmbStr = Number(amountRmb/10000).toFixed(2) + '';
         var amountRmbList = amountRmbStr.split(".");
         amountRmbList[1] = amountRmbList[1].substr(0, 2);
         $('#orderMoney').text(amountRmbList[0] + '.');
         $('#orderMoney').attr('data-clipboard-text', amountRmbList[0] + '.' + amountRmbList[1]);
         $('#orderMoneyDecimal').text(amountRmbList[1]);
         $('#orderMoneyDecimal').attr('data-clipboard-text', amountRmbList[0] + '.' + amountRmbList[1]);
         */
        //$('#orderMoneyBtn').attr('data-clipboard-text', amountRmbStr);
        //$('#orderAmountBtn').attr('data-clipboard-text',amountRmbStr);

        if (ClipboardJS.isSupported()) {
            //  @tip: 可以用.class全局初始化，但节点可能不存在
           // $('.btn-copyBankNo').length && new ClipboardJS('.btn-copyBankNo').on("success", window.common.copyeSuccessFun).on("error", window.common.copyeSuccessFun);
            $('.btn-copy').length && new ClipboardJS('.btn-copy').on("success", window.common.copyeSuccessFun).on("error", window.common.copyeSuccessFun);
            //  @tip: 手机浏览器成功会进入error回调
            $("#orderAmountRmb").length && new ClipboardJS('#orderAmountRmb').on("success", window.common.copyeSuccessFun).on("error", window.common.copyeSuccessFun);
            $('#orderMoney').length && new ClipboardJS('#orderMoney').on("success", window.common.copyeSuccessFun).on("error", window.common.copyeSuccessFun);
            $('#orderMoneyDecimal').length && new ClipboardJS('#orderMoneyDecimal').on("success", window.common.copyeSuccessFun).on("error", window.common.copyeSuccessFun);
            $('#orderName').length && new ClipboardJS('#orderName').on("success", window.common.copyeSuccessFun).on("error", window.common.copyeSuccessFun);
            $('#orderBankNo').length && new ClipboardJS('#orderBankNo').on("success", window.common.copyeSuccessFun).on("error", window.common.copyeSuccessFun);
            $('#orderBankName').length && new ClipboardJS('#orderBankName').on("success", window.common.copyeSuccessFun).on("error", window.common.copyeSuccessFun);
            $('#orderBankDesc').length && new ClipboardJS('#orderBankDesc').on("success", window.common.copyeSuccessFun).on("error", window.common.copyeSuccessFun);
        } else {
            if (window.utils.isMobile()) {
                $(".copy-tips-content").text('长按复制');
            } else {
                $(".copy-tips-content").text('右键复制');
            }
        }
        if (!utils.isMobile()) {
            // 鼠标移入移出事件
            $('.has_gac_copy_tips').hover(function() {
                // 鼠标移入时添加hover类
                onShowCopyTips(this)
            }, function() {
                // 鼠标移出时移出hover类
                onShowCopyTips(this, true)
            });
        }
    })

    /*点击复制金额*/
    function  copyAmountClick() {
     //   $('#orderAmountBtn').hide();

       /* if (ClipboardJS.isSupported()) {
            $("#orderAmountRmb").length && new ClipboardJS('#orderAmountRmb').on("success", window.common.copyeSuccessFun).on("error", window.common.copyeSuccessFun);
        }*/
    }
    /*点击复制卡号*/
    function copyCardNoClick() {
      //  $('#amountCardNo').hide();

      /*  if (ClipboardJS.isSupported()) {
            $("#orderBankNo").length && new ClipboardJS('#orderBankNo').on("success", window.common.copyeSuccessFun).on("error", window.common.copyeSuccessFun);
        }*/
    }


    function hideAlipayBankModal(){
        $("#alipay_bank_modal").hide();
    }
    function hideWechatBankModal(){
        $("#wechat_bank_modal").hide();
    }
    function alertPayType() {
        var paramCardType = buyVo.paramCardType //用户选的方式
        var realCardType = buyVo.cardInfo.cardType;//实际匹配的方式
        if (
            (paramCardType =='ALIPAY' || paramCardType == 'BUSINESS_ALIPAY'|| paramCardType == 'BUSINESS_ALIPAY_BANK')
                && realCardType == 'BANK_CARD'){
            $("#alipay_bank_modal").show();
            //支付宝匹配到银行卡
            // alert("由于您所选支付通道当前订单量过大，为保证您能快速完成充值，已为您切换至其他通道，请放心转账！");
        }
        else if (paramCardType =='WECHAT' && realCardType == 'BANK_CARD'){
            $("#wechat_bank_modal").show();
            //微信匹配到银行卡
            // alert("由于您所选支付通道当前订单量过大，为保证您能快速完成充值，已为您切换至其他通道，请放心转账！");
        }
    }
</script>
 
</html>
