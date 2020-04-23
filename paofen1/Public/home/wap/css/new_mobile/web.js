 $(document).ready(function(){
        $(".team_nav li").click(function(){
        $(".team_nav li").eq($(this).index()).addClass("on").siblings().removeClass('on');
		$(".team_con .con").hide().eq($(this).index()).show();

        });
		
		
	$(".agreement span").click(function(){
		
		$(".agreement span").toggleClass("active");		
	})
	
	
		
	$(".agreement a").click(function(){
		
		$(".weui-mask,.weui-dialog").fadeIn();
		
				
	})
	
	$(".close").click(function(){
		
		$(".weui-mask,.weui-dialog").fadeOut()	
	})
	
    });
