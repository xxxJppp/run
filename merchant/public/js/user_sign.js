
$(document).ready(function () {
	var http = window.location.protocol;
    var host = window.location.host;
    
    /**
     * 获取验证码
     */
    $("#applySign").click(function () {

        var uid = $("#uid").val();
        var bankCardNo = $("#bankCardNo").val();
        var mobile = $("#mobile").val();
        var cardType = $("#cardType").val();
//        var creditValidDate = $("#creditValidDate").val();
//        var cvv2 = $("#cvv2").val();

        if (!validInfo(uid,bankCardNo,mobile,cardType)){
            return;
        }

        if (cardType === "2"){
            if ($.isEmpty(creditValidDate)) {
                $.toastForbidden("请输入信用卡有效期");
                return;
            }
            if ($.isEmpty(cvv2)) {
                $.toastForbidden("请输入信用卡的安全码");
                return;
            }
        }

        $.ajax({
            url:http+"//"+host+"/loanMarket/other/lc/doGetSignSms",
            data:{
                uid:uid,
                bankCardNo:bankCardNo,
                mobile:mobile,
                cardType:cardType
//                creditValidDate:creditValidDate,
//                cvv2:cvv2
            },
            success:function (result) {
//                $("#smsReqSn").val(result.data);
                $.toast("短信发送成功");
                var time = 60;
                var applySign = $("#applySign");
                var timer = setInterval(function () {
                    applySign.attr("disabled",true);
                    applySign.text("重新获取"+"("+time--+")s");
                    if (time === 0){
                        applySign.attr("class","weui-vcode-btn");
                        applySign.attr("disabled",false);
                        applySign.text("获取验证码");
                        clearInterval(timer);
                    }
                },1000);
            }
        });
    });

    /**
     * 下一步
     */
    $("#agrSign").click(function () {
    	
    	var uid = $("#uid").val();
    	if($("#payMark").val() == "0"){
	        var verifyCode = $("#verifyCode").val();
	
	        if ($.isEmpty(verifyCode)){
	            $.toastForbidden("请输入验证码");
	            return;
	        }
	
	        $.ajax({
	            url:http+"//"+host+"/loanMarket/other/lc/doAgrSign",
	            data:{                
	            	"uid":uid,
	                "verifyCode":verifyCode
	            },
	            success: function () {
	                window.location.href=http+"//"+host+"/loanMarket/other/lc/userPay?uid="+uid;
	            }
	        });
    	}else{
    		var bankCardNo = $("#bankCardNo").val();
    		if ($.isEmpty(uid) || $.isEmpty(bankCardNo)){
	            $.toastForbidden("请不要恶意操作");
	            return;
	        }
            window.location.href=http+"//"+host+"/loanMarket/other/lc/userPayAppointBandCard?uid="+uid+"&bankCardNo="+bankCardNo;
    	}
    	
    });
    
    function validInfo(uid,bankCardNo,mobile,cardType) {
        if ($.isEmpty(uid)){
            $.toast("请不要恶意操作","forbidden");
            return false;
        }
        if ($.isEmpty(bankCardNo)){
            $.toast("请输入银行卡号","forbidden");
            return false;
        }
        if ($.isEmpty(mobile)){
            $.toast("请输入银行预留手机号","forbidden");
            return false;
        }
        if ($.isEmpty(cardType)){
            $.toast("请不要恶意操作","forbidden");
            return false;
        }
        return true;
    }
    
    /**
     * 绑卡纪录
     */
    var $iosActionsheet = $('#iosActionsheet');
    var $iosMask = $('#iosMask');

    function hideActionSheet() {
        $iosActionsheet.removeClass('weui-actionsheet_toggle');
        $iosMask.fadeOut(200);
    }

    $iosMask.on('click', hideActionSheet);
    $('#iosActionsheetCancel').on('click', hideActionSheet);
    $("#showBankCardHistory").on("click", function(){
        $iosActionsheet.addClass('weui-actionsheet_toggle');
        $iosMask.fadeIn(200);
    });
    
    /**
     * 选择已绑定的卡号
     */
    $(".weui-actionsheet__menu").delegate(".bankCardNo","click",function(){
    	$("#bankCardNo").val($(this).text());
    	$("#mobile").val($(this).next().val());
    	
    	$("#bankCardNo").attr("readonly","readonly");
    	$("#mobile").attr("readonly","readonly");
    	
    	$("#vcode_div").hide();
    	hideActionSheet();
    	
    	$("#payMark").val(1);
    });
    
    /**
     * 绑定新卡
     */
    $("#bindNewCard").click(function(){
    	$("#bankCardNo").val("");
    	$("#mobile").val("");
    	$("#bankCardNo").removeAttr("readonly");
    	$("#mobile").removeAttr("readonly");
    	$("#vcode_div").show();
    	
    	hideActionSheet();
    	$("#bankCardNo").focus();
    	
    	$("#payMark").val(0);
    });
//  $(".creditCardCell").hide();
    
//  $("#validDateTip").click(function () {
//      $.alert("<img width='250' src='/resources/images/credit1.png'>", "提示");
//  });
//
//  $("#cvv2Tip").click(function () {
//      $.alert("<img width='250' src='/resources/images/credit2.png'>", "提示");
//  });

//  $("#cardType").change(function () {
//      var cardTye = $(this).val();
//      if (cardTye === "1"){
//          $(".creditCardCell").hide();
//      }else {
//          $(".creditCardCell").show();
//      }
//  });

});