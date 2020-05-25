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
	
<title>首页</title>

<link href="/static/Theme/css/base.css" rel="stylesheet">
<link href="/static/Theme/css/user.css" rel="stylesheet">
  <link href="/static/Theme/css/trade.css" rel="stylesheet">


</head>

<body>
<div class="user-top">
	<div class="header user-header">
		
	</div>
	
	<div class="user-info">
		<a href="#">
			<div class="user-photo">
				<img src="/static/Theme/images/member.png">
			</div>

			<h3><?php echo $_SESSION['MEMBER']['username'];?></h3>
          <p style="text-align:center">商户ID：<?php echo $_SESSION['MEMBER']['uid'];?></p>

			
		</a>
	</div>
	 <?php //查询全部提现 
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}withdraw where user_id={$_SESSION['MEMBER']['uid']} and types=2 and catalog=3");
                      
                      
                        ?>

	<div class="user-wallet">
	    <ul>
			<li>
				<a href="/mobile/member/pay">
					<h3><?php echo $_SESSION['MEMBER']['balance'];?> </h3>
					<span>余额</span>					
				</a>
			</li>

			<li>
				<a href="/mobile/member/withdraw">
					<h3><?php echo floatval($order[0]['money']); ?> </h3>	
					<span>已提现</span>				
				</a>
			</li>
		</ul>
	</div>
</div>

<div class="trade-order" style="margin-top: 40px;">
		<ul>
			<li>
				<a href="/mobile/paofen/type.do" class="trade-order-1">
					<i></i>
					<span>添加账号</span>
				</a>
			</li>
			
			<li>
				<a href="/mobile/paofen/automatic.do" class="trade-order-2">
					<i></i>
					<span>账号管理</span>
				</a>
			</li>
			
			<li>
				<a href="/mobile/paofen/automaticOrder.do" class="trade-order-3">
					<i></i>
					<span>全部订单</span>
				</a>
			</li>
			
			<li>
				<a href="/mobile/panel/orderlog" class="trade-order-4">
					<i></i>
					<span>交易记录</span>
				</a>
			</li>
		</ul>
	</div>

	<div class="clr"></div>
	
	<div class="index-menu">
			<ul>
				
				<li class="no-open" style="    background-color: white;
    margin-bottom: 8px;">
					<a href="javascript:;" class="index-menu-3">
						<i></i>
						<span>订单日志（最新10条）</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>



           <div class="article-box">
 <?php  foreach ($member['result'] as $em){?>
				
		<a href="#" class="article-list">
			<h3><?php echo $em['remark'];?></h3>
			<p><?php echo date("Y/m/d H:i:s",$em['time']);?></p>
	
             </a>


			 <?php }?>
	</div>

<div class="clr"></div><div class="clr"></div><div class="clr"></div><div class="clr"></div>

<div class="nav">
	<ul>
		<li>
			<a href="/mobile/panel/index.do" class="nav-assets">
				<i></i>
				<span>首页</span>
			</a>
		</li>
		<li>
			<a href="/mobile/member/pay" class="nav-pay">
				<i></i>
				<span>充值</span>
			</a>
		</li>
		<li>
			<a href="/mobile/panel/my" class="nav-shop">
				<i></i>
				<span>我的</span>
			</a>
		</li>
	</ul>
</div>

<!--暂未开放弹窗-->
<div class="popup">
    <div class="popup-box coming-soon">
        <div class="popup-box-content">
            <div class="coming-soon-content">
				<img src="/static/Theme/images/coming_soon.png">
				<p>此功能暂未开放，敬请期待</p>
			</div>
        </div>
        
        <div class="popup-submit">
			<button type="submit" class="confirm-btn">确认</button>
        </div>
    </div>
</div>


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
