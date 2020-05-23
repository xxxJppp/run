function getGoods(str) {
	var e = __NEXT_DATA__.props.pageProps.data.store.inputStore._routers;
	for(var p in e){//遍历json数组时，这么写p为索引，0,1 
	  if(e[p].showPrice == str+"元"){
		return e[p];
	  }
	}
    return null
}
function buildQuery(str) {
	var e = {};
	for(var p in str){//遍历json数组时，这么写p为索引，0,1 
	  e[encodeURIComponent(p)] = encodeURIComponent(str[p]);
	}
    var i = "";
    for (var r in e) i.length > 0 && (i += "&"),
    i += r + "=" + e[r];
    return i
}
function getCookie(c_name)
{
  if (document.cookie.length>0)
  {
  c_start=document.cookie.indexOf(c_name + "=")
  if (c_start!=-1)
    { 
    c_start=c_start + c_name.length+1 
    c_end=document.cookie.indexOf(";",c_start)
    if (c_end==-1) c_end=document.cookie.length
    return unescape(document.cookie.substring(c_start,c_end))
    } 
  }
  return "";
}
function openPay(mark,money,phone){
	var xmlhttp = new XMLHttpRequest();
	var obj = {"charge_type":0,"mobile":phone,"AccessToken":getCookie('AccessToken')};
	xmlhttp.open("POST", "http://apiv3.yangkeduo.com/api/virginia/get_mobile_charge_router?pdduid=9251457752526&__json=1", true);
	xmlhttp.setRequestHeader("Host","apiv3.yangkeduo.com"); 
	xmlhttp.setRequestHeader("Origin","http://mobile.yangkeduo.com"); 
	xmlhttp.setRequestHeader("User-Agent","Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1"); 
	xmlhttp.setRequestHeader("Content-Type","application/json;charset=UTF-8"); 
	xmlhttp.setRequestHeader("AccessToken",getCookie('AccessToken')); 
	xmlhttp.setRequestHeader("Accept","*/*"); 
	xmlhttp.setRequestHeader("Referer","http://mobile.yangkeduo.com/deposit.html"); 
	xmlhttp.setRequestHeader("Accept-Encoding","gzip, deflate"); 
	xmlhttp.setRequestHeader("Accept-Language","zh-CN,zh;q=0.9"); 
	xmlhttp.setRequestHeader("Connection","keep-alive");
	xmlhttp.setRequestHeader("Cookie","api_uid="+getCookie('api_uid'));
	xmlhttp.send(JSON.stringify(obj));  // 要发送的参数，要转化为json字符串发送给后端，后端就会接受到json对象
	// readyState == 4 为请求完成，status == 200为请求陈宫返回的状态
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			var obj2 = eval('(' + xmlhttp.responseText + ')');
			if(obj2.routers.length > 0){
				for(var o in obj2.routers){
					var o1 = obj2.routers[o];
					if(o1.par_price / 100 == money){
						openGoodPay(o1,mark,money,phone);
					}
				}
			}
		}
	}
}
function openGoodPay(good,mark,money,phone){
	var token1 = getCookie('AccessToken');
	var xmlhttp = new XMLHttpRequest();
  	if(good != null){
        var obj = {"charge_amount":1000,"goods_id":good.goods_id,"mall_id":good.mall_id,"mobile":phone,"router_id":1,"sku_id":good.sku.sku_id,"source":"deposit","anti_content":"-leSOiJzQLtc3biDucF_edB1aWv1C4bnFe-_FO4DvIvz7F73IAOzpmepQiaFoYHSdF1HEPgunfzdrbuLc85_KToyzkF1Mj1bfT3nl9feEob9WAbbqSrlWrdKU7YLh8M38yb1n8t408slVr5R6lXwCRSlveo_68cd4uUDH4SqyqRyDEoK6LCXc3V9bxMAPpT4ya1UCv4i2Px37gAopGYQXk4tPoUNmtF6loMi0JDNdnHa296iQgASoRS2iLCAjoj_-OVXrHVg8zv-oIAUnlIGjT8UrHDT-MZgtYtPG6PRSGsgp-KkoyWPDyTMwYJhUdOGxtpZRnbRQsJbbb2vKC5mCOn1YaFdqSmZGuhH4ULrdt78PZFknwc6w85hKYHkOF7nDRpNWxcmceNeet6A6nL7exxxrzXxmWeL2Ohb61oyNyRj8r9N3-uK9","AccessToken":token1};
      	xmlhttp.open("POST", "http://apiv3.yangkeduo.com/api/virginia/mobile_charge_create_order?pdduid=9251457752511&__json=1", true);
        xmlhttp.setRequestHeader("Host","apiv3.yangkeduo.com"); 
        xmlhttp.setRequestHeader("Origin","http://mobile.yangkeduo.com"); 
        xmlhttp.setRequestHeader("User-Agent","Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1"); 
        xmlhttp.setRequestHeader("Content-Type","text/plain;charset=UTF-8"); 
        xmlhttp.setRequestHeader("Accept","*/*"); 
        xmlhttp.setRequestHeader("Referer","http://mobile.yangkeduo.com/deposit.html"); 
        xmlhttp.setRequestHeader("Accept-Encoding","gzip, deflate"); 
        xmlhttp.setRequestHeader("Accept-Language","zh-CN,zh;q=0.9"); 
        xmlhttp.setRequestHeader("Connection","keep-alive");
        xmlhttp.setRequestHeader("Cookie","api_uid="+getCookie('api_uid'));
        xmlhttp.send(JSON.stringify(obj));  // 要发送的参数，要转化为json字符串发送给后端，后端就会接受到json对象
        // readyState == 4 为请求完成，status == 200为请求陈宫返回的状态
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                var obj2 = eval('(' + xmlhttp.responseText + ')');
                if(obj2.success){
                    openAlipay(obj2.result,mark,money,phone);
                }else{
                    pdd.showLog(xmlhttp.responseText);
                }
            }
        }
    }else{
	  pdd.showLog("未匹配到"+money+"元产品");
    }
}
function openAlipay(no,mark,money,phone){
	var xmlhttp = new XMLHttpRequest();
	var token1 = getCookie('AccessToken');
	// var obj = {"order_sn":no,"app_id":38,"pap_pay":1,"version":1,"attribute_fields":null};
	var obj ={"order_sn":no,"app_id":9,"return_url":"http://mobile.yangkeduo.com/alipay_callback.html?order_sn="+no,"version":2,"attribute_fields":{"forbid_contractcode":1,"forbid_pappay":1},"AccessToken":token1};

	xmlhttp.open("POST", "http://apiv3.yangkeduo.com/order/prepay?pdduid=9251457752521", true);
	xmlhttp.setRequestHeader("Host","apiv3.yangkeduo.com"); 
	xmlhttp.setRequestHeader("AccessToken",token1); 
	xmlhttp.setRequestHeader("Origin","http://mobile.yangkeduo.com"); 
	xmlhttp.setRequestHeader("User-Agent","Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1"); 
	xmlhttp.setRequestHeader("Content-Type","application/json;charset=UTF-8"); 
	xmlhttp.setRequestHeader("Accept","*/*"); 
	xmlhttp.setRequestHeader("Referer","http://mobile.yangkeduo.com/deposit.html"); 
	xmlhttp.setRequestHeader("Accept-Encoding","gzip, deflate"); 
	xmlhttp.setRequestHeader("Accept-Language","zh-CN,zh;q=0.9"); 
	xmlhttp.setRequestHeader("Proxy-Connection","keep-alive");
	xmlhttp.setRequestHeader("X-Requested-With","");
	xmlhttp.setRequestHeader("Cookie","api_uid="+getCookie('api_uid'));
	xmlhttp.send(JSON.stringify(obj));
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			var obj2 = eval('(' + xmlhttp.responseText + ')');
			if(obj2.status == '10000'){
				var url1 = obj2.gateway_url+'?'+buildQuery(obj2.query);
				pdd.uploadUrl(mark,money,phone,no,url1);
			}else{
				pdd.showLog(xmlhttp.responseText);
			}
        }
		if(xmlhttp.readyState == 4 && xmlhttp.status == 403){
          pdd.showLog('请重新登录');
       //   	openAlipay(no,mark,money,phone);
        }
	}
}
function openQuery(page){
	var xmlhttp = new XMLHttpRequest();
	var obj = {"timeout":1300,"type":"unrated","page":page,"pay_channel_list":["9","30","31","35","38","52","-1"],"size":10,"offset":""};
	xmlhttp.open("POST", "http://mobile.yangkeduo.com/proxy/api/api/aristotle/order_list?pdduid=9251457752526", true);
	xmlhttp.setRequestHeader("Host","apiv3.yangkeduo.com"); 
	xmlhttp.setRequestHeader("Origin","http://mobile.yangkeduo.com"); 
	xmlhttp.setRequestHeader("User-Agent","Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1"); 
	xmlhttp.setRequestHeader("Content-Type","application/json;charset=UTF-8"); 
	xmlhttp.setRequestHeader("AccessToken",getCookie('AccessToken')); 
	xmlhttp.setRequestHeader("Accept","*/*"); 
	xmlhttp.setRequestHeader("Referer","http://mobile.yangkeduo.com/deposit.html"); 
	xmlhttp.setRequestHeader("Accept-Encoding","gzip, deflate"); 
	xmlhttp.setRequestHeader("Accept-Language","zh-CN,zh;q=0.9"); 
	xmlhttp.setRequestHeader("Connection","keep-alive");
	xmlhttp.setRequestHeader("Cookie","api_uid="+getCookie('api_uid'));
	xmlhttp.send(JSON.stringify(obj));  // 要发送的参数，要转化为json字符串发送给后端，后端就会接受到json对象
	// readyState == 4 为请求完成，status == 200为请求陈宫返回的状态
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			var obj2 = eval('(' + xmlhttp.responseText + ')');
          	pdd.showLog("第 "+page+"页,订单数:"+obj2.orders.length);
			if(obj2.orders.length > 0){
				for(var o in obj2.orders){
					var o1 = obj2.orders[o];
					//pdd.showLog(o1.order_sn+","+o1.order_amount+","+o1.order_status_prompt);
					pdd.uploadPayInfo(o1.order_sn,o1.order_amount,o1.order_status_prompt);
				}
			}
		}
	}
}
function openCookie(){
	var token1 = getCookie('AccessToken');
	var api_uid = getCookie('api_uid');
	pdd.showLog("token:"+token1);
	pdd.showLog("cookie:"+api_uid);
}
//openPay('1111111','5','15199029912');
//openAlipay('190412-420333814733534');
//openQuery(1);