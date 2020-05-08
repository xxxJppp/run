<?php
use xh\library\url;
use xh\unity\cog;
use xh\library\model;
$fix = DB_PREFIX;
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable = 0">
	
<title>收款账号列表</title>

<link href="/static/Theme/css/base.css" rel="stylesheet">
<link href="/static/Theme/css/user.css" rel="stylesheet">
  <link href="/static/Theme/css/trade.css" rel="stylesheet">
</head>

<body>
<header class="header">
	<div class="header-return">
	    <a href="/mobile/panel/index.do"></a>
	</div>
	
	<div class="logo">订单日志</div>
</header>

<section class="container tab-container">
   
    <div class="tab-content" style="margin-top: -36px;">
    

	<div class="clr"></div>
	

	</div>
</div>



           <div class="article-box">
 <?php  foreach ($member['result'] as $em){?>
				
		<a href="/mobile/paofen/automaticOrder.do?sorting=trade_no&code=<?php echo $em['trade_no'];?>" class="article-list">
			<h3><?php echo $em['remark'];?></h3>
			<p><?php echo date("Y/m/d H:i:s",$em['time']);?></p>
	
             </a>


			 <?php }?>
	</div>

<div class="clr"></div>
      <link rel="stylesheet" href="/Public/Front/js/plugins/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/Public/Front/iconfont/iconfont.css"/>
 <div class="page">
          <div  class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-0">  
      <!--    <span class="layui-laypage-curr current"><em class="layui-laypage-em"></em><em>1</em></span>
            <a class="num" href="/agent_Order_index.html?p=2">2</a><
            a class="num" href="/agent_Order_index.html?p=3">3</a>
            <a class="next layui-laypage-next" href="/agent_Order_index.html?p=2">下一页</a> </div>       -->      
          <?php (new model())->load('page', 'turn')->auto($member['info']['pageAll'], $member['info']['page'], 6); ?>
        </div> 
      </div>
<div class="clr"></div>
<script src="/static/Theme/js/jquery-1.11.2.min.js"></script>
<script>
	$(function() {
		
		 //公告轮播
		var adtimer;
		var wrap = $(".announce-box ul");
		var len = $(".announce-box ul li").length;
		if(len>1){
			$(".announce-box").hover(function(){
					clearInterval(adtimer);
				},
				function(){
					adtimer = setInterval(function(){
						var first = wrap.find("li:first");
						var HEIGHT = first.height();
						first.animate({
							marginTop:-HEIGHT+'px'
						},500,function(){
							first.css('marginTop',0).appendTo(wrap);
						})
					},2500)
				}).trigger('mouseleave');
		}
		
		//var num = 0;
//		var width = 0;
//		var length = $('.announce-box ul li').length;
//
//		for(var i=0; i<length; i++){
//			width += $('.announce-box ul li').eq(i).width();
//		}
//		
//		function goLeft() {
//
//			if (num == -parseInt(width)) {
//				num = 0;
//			}
//			num -= 1;
//			$(".announce-box ul").css({
//				marginLeft: num
//			})
//		}
//		
//		//设置滚动速度
//		var timer = setInterval(goLeft, 30);
//		
//		//设置鼠标经过时滚动停止
//		$(".announce-box ul").hover(function() {
//			clearInterval(timer);
//		},
//		function() {
//			timer = setInterval(goLeft, 30);
//		});
		
		//顶部滚动效果
		//$(window).scroll(function(){
//			
//			if ($(window).scrollTop() >= 20){
//				$("#fixedBg").addClass('user-header-fixed');
//			}
//			else{
//				$("#fixedBg").removeClass('user-header-fixed');
//			}
//		});
	});

	
	//暂未开放
	$(function(){
		$('.no-open').click(function(){
			$('.popup').fadeIn();	
			
			var h = ($(window).height() - $('.popup-box').height())/2;
			$('.popup-box').css('margin-top',h);
		});	
		
		$('.confirm-btn').click(function(){
			$('.popup').fadeOut();				  
		});
	});
</script>
</body>
</html>
