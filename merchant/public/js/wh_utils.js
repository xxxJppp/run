$(document).ready(function () {
    //首先备份一个原始的jquery.ajax()函数
    var _ajax = $.ajax;
    //重写jquery.ajax()函数
    $.ajax=function(opt){
        opt.type = 'POST';
        opt.dataType = 'json';
        //备份opt中error和success方法
        var fn = {
            error:function(XMLHttpRequest, textStatus, errorThrown){},
            success:function(data, textStatus){},
            bizError:function (data, textStatus) {
            	$.toast(data.msg, "forbidden");
            }
        };
        if(opt.error){
            fn.error=opt.error;
        }
        if(opt.success){
            fn.success=opt.success;
        }
        if(opt.bizError){
            fn.bizError=opt.bizError;
        }

        //扩展增强处理
        var _opt = $.extend(opt,{
            beforeSend:function() {
                $.showLoading();
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){
                location.href="./index_two";
            },
            success:function(data, textStatus){
                $.hideLoading();
                //成功回调方法增强处理
                if (data.code === 1){
                    fn.success(data, textStatus);
                }else {
                    fn.bizError(data,textStatus);
                    if (!$.isEmpty(data.data)){
                        $.toast(data.msg, "forbidden");
                    }
                }
            }
        });
        return _ajax(_opt);
    };

    $.ajaxSlient=function(opt){
        opt.type = 'POST';
        opt.dataType = 'json';
        //备份opt中error和success方法
        var fn = {
            error:function(XMLHttpRequest, textStatus, errorThrown){},
            success:function(data, textStatus){},
            bizError:function (data, textStatus) {}
        };
        if(opt.error){
            fn.error=opt.error;
        }
        if(opt.success){
            fn.success=opt.success;
        }
        if(opt.bizError){
            fn.bizError=opt.bizError;
        }

        //扩展增强处理
        var _opt = $.extend(opt,{
            beforeSend:function() {
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){
                fn.error(XMLHttpRequest, textStatus, errorThrown);
            },
            success:function(data, textStatus){
                //成功回调方法增强处理
                if (data.scode === '0'){
                    fn.success(data, textStatus);
                }else {
                    fn.bizError(data,textStatus);
                }
            }
        });
        return _ajax(_opt);
    };

    $.isEmpty = function(obj){
        return typeof obj === "undefined" || obj === null || obj === "";
    };

    $.toastForbidden = function(smsg){
        $.toast(smsg, "forbidden");
    };

    $.formatValue = function(obj){
        if ($.isEmpty(obj)){
            return "";
        }
        return obj;
    };

    //**dataURL to blob**
    $.dataURLtoFile = function(dataurl, filename) {
        var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
        while(n--){
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new File([u8arr], filename, {type:mime});
    };

    $.photoCompass = function (file,callback) {
        var maxWidth = 1000;
        var fileReader = new FileReader();
        fileReader.readAsDataURL(file);
        fileReader.onload = function(event){
            var result = event.target.result;   //返回的dataURL
            var image = new Image();
            image.src = result;
            image.onload = function(){  //创建一个image对象，给canvas绘制使用
                var cvs = document.createElement('canvas');
                var scale = 1;
                var width = this.width > this.height ? this.height:this.width;
                if(width > maxWidth){  //1000只是示例，可以根据具体的要求去设定
                    scale = parseFloat(maxWidth) / parseFloat(width);
                }
                cvs.width = this.width*scale;
                cvs.height = this.height*scale;     //计算等比缩小后图片宽高
                var ctx = cvs.getContext('2d');
                ctx.drawImage(this, 0, 0, cvs.width, cvs.height);
                callback(cvs.toDataURL(file.type, 1),file.name);
            }
        }
    };

    $.dateFormat = function(date,fmt) { //author: meizz
        var o = {
            "M+" : date.getMonth()+1,                 //月份
            "d+" : date.getDate(),                    //日
            "h+" : date.getHours(),                   //小时
            "m+" : date.getMinutes(),                 //分
            "s+" : date.getSeconds(),                 //秒
            "q+" : Math.floor((date.getMonth()+3)/3), //季度
            "S"  : date.getMilliseconds()             //毫秒
        };
        if(/(y+)/.test(fmt))
            fmt=fmt.replace(RegExp.$1, (date.getFullYear()+"").substr(4 - RegExp.$1.length));
        for(var k in o)
            if(new RegExp("("+ k +")").test(fmt))
                fmt = fmt.replace(RegExp.$1, (RegExp.$1.length === 1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
        return fmt;
    }
});