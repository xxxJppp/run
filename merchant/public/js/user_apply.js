
$(document).ready(function () {
	var http = window.location.protocol;
    var host = window.location.host;
    
    $("#userApplys").click(function () {
        
        var realName = $("#realName").val();
        var idCardNo = $("#idCardNo").val();
        var mobile = $("#mobile").val();
        var staffId = $("#staffId").val();
        var pKey = $("#pKey").val();
        var eval = $("#eval").val();

        
        
        if (!validInfo(realName,idCardNo,mobile,staffId,pKey,eval)){
            return false;
        }

        var zmScore = $("#zmScore").val();
        if (!zmScore.match(/\d+/) || parseInt(zmScore) < 350 || parseInt(zmScore) > 900){
            $.toastForbidden("请输入正确的芝麻分");
            return;
        }

        var hasSecurity = $("#hasSecurity").is(":checked")?1:0;
        var hasFund = $("#hasFund").is(":checked")?1:0;
        var hasCar = $("#hasCar").is(":checked")?1:0;
        var hasHouse = $("#hasHouse").is(":checked")?1:0;
        
        var applyUrl = http+"//"+host+window.location.pathname+"/two";
        
        $.ajax({
            url:http+"//"+host+"/index",
            type: "post",
            data:{
                "staffId":staffId,
                "realName":realName,
                "idCardNo":idCardNo,
                "mobile":mobile,
                "zmScore":zmScore,
                "hasSecurity":hasSecurity,
                "hasFund":hasFund,
                "hasCar":hasCar,
                "hasHouse":hasHouse,
                "pKey":pKey,
                "eval":eval,
                "applyUrl":applyUrl
            },
            
            success: function (result) {
               alert(1);
                
               window.location.href=http+"//"+host+"/index_two";
            }

         
            
        });


    });

    $("#weuiAgreeBank").change(function () {
        var agree = $("#weuiAgreeBank").is(":checked");
        var userApply = $("#userApply");
        if (agree){
            userApply.attr("class","weui-btn weui-btn_primary");
            userApply.attr("disabled",false);
        }else {
            userApply.attr("class","weui-btn weui-btn_disabled weui-btn_primary");
            userApply.attr("disabled",true);
        }
    });

    $("#agreeBank").click(function () {
        var realName = $.formatValue($("#realName").val());
        var mobile = $.formatValue($("#mobile").val());
        window.open(http+"//"+host+"/other?" +realName+"&mobile="+mobile);

    });
    
    $.isEmpty = function(obj){
    	return typeof obj === "undefined" || obj === null || obj === "";
    };

    function validInfo(realName,idCardNo,mobile,staffId,pKey,eval) {
        if ($.isEmpty(realName)){
            $.toast("请输入姓名","forbidden");
            return false;
        }
        var cnPattern = /^[\u4e00-\u9fa5]+(·[\u4e00-\u9fa5]+)*$/;
		if(!cnPattern.test(realName)){
			$.toast("请填写正确的姓名","forbidden");
			return false;
		}
        
        
        if ($.isEmpty(idCardNo)){
            $.toast("请输入身份证号","forbidden");
            return false;
        }
        
        var cP = /^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/;
		if(!cP.test(idCardNo)){
			$.toast("请填正确格式的身份证号","forbidden");
			return false;
		}
        
        if ($.isEmpty(mobile)){
            $.toast("请输入身手机号","forbidden");
            return false;
        }
        
        var mp = /^1[3456789]\d{9}$/;
        if (!mp.test(mobile)){
            $.toast("请输入正确格式的手机号","forbidden");
            return false;
        }
        
        if ($.isEmpty(staffId) || $.isEmpty(pKey) || $.isEmpty(eval)){
            $.toast("请不要恶意操作","forbidden");
            return false;
        }
        return true;
    }
    

});