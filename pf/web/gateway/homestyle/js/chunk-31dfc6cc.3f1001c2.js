(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-31dfc6cc","chunk-089a5e6c","chunk-5753040b"],{"1e01":function(e,t,i){var a=i("da0b"),o=i("ae6e").set;e.exports=function(e,t,i){var n,c=t.constructor;return c!==i&&"function"==typeof c&&(n=c.prototype)!==i.prototype&&a(n)&&o&&o(e,n),e}},"3a06":function(e,t){e.exports="\t\n\v\f\r   ᠎             　\u2028\u2029\ufeff"},"3fc0":function(e,t,i){e.exports=i.p+"img/alipay_guide.83bbb1a4.jpg"},7130:function(e,t,i){var a=i("2498"),o=i("3038"),n=i("0cc1"),c=i("3a06"),r="["+c+"]",s="​",u=RegExp("^"+r+r+"*"),l=RegExp(r+r+"*$"),d=function(e,t,i){var o={},r=n((function(){return!!c[e]()||s[e]()!=s})),u=o[e]=r?t(f):c[e];i&&(o[i]=u),a(a.P+a.F*r,"String",o)},f=d.trim=function(e,t){return e=String(o(e)),1&t&&(e=e.replace(u,"")),2&t&&(e=e.replace(l,"")),e};e.exports=d},"8d8e":function(e,t,i){"use strict";i.r(t);var a=function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",{staticClass:"upload-code"},[i("van-nav-bar",{staticClass:"MB10",attrs:{"left-text":"返回",title:"收款码","left-arrow":""},on:{"click-left":e.onClickLeft}}),i("div",[e.userCodeWXImg?i("img",{staticClass:"upload-img",attrs:{src:e.wechatCodeURL+e.userCodeWXImg}}):e._e(),i("file-upload",{ref:"upload",staticClass:"input-file",attrs:{"input-id":"wx","post-action":e.host+"/uploadCode",accept:"image/*",data:{codeUserId:e.userId}},on:{"input-file":e.inputFile,"input-filter":e.inputFilter},model:{value:e.files,callback:function(t){e.files=t},expression:"files"}},[i("div",[e.userCodeWXImg?e._e():i("div",{staticClass:"upload-img"},[i("van-icon",{attrs:{name:"plus"}})],1),i("div",{staticClass:"MB10",staticStyle:{color:"#288837"}},[e._v("上传"+e._s(1===e.activeTab?"微信":"支付宝")+"收款码")])])])],1),i("div",{staticClass:"flexh"},[i("van-field",{attrs:{placeholder:"请输入收款码对应的实名认证姓名"},model:{value:e.codeNick,callback:function(t){e.codeNick=t},expression:"codeNick"}}),i("div",{staticClass:"font-14 example-guide",on:{click:function(t){e.showGuide=!0}}},[e._v("示例图")])],1),i("div",{staticClass:"gray font-13 ML20 MR10",staticStyle:{"margin-top":".05rem"}},[e._v("若与收款码对应的实名认证姓名不一致，该收款码将审核不通过")]),i("van-button",{staticClass:"upload-code-btn",attrs:{type:"primary",disabled:!e.userCodeWXImg||!e.codeNick},on:{click:e.onClikRight}},[e._v("\n      确认提交\n    ")]),i("van-popup",{staticStyle:{width:"95%",height:"95%"},on:{click:function(t){e.showGuide=!1}},model:{value:e.showGuide,callback:function(t){e.showGuide=t},expression:"showGuide"}},[i("img",{attrs:{src:1===e.activeTab?e.wxGuide:e.alipayGuide,alt:"guide",width:"100%",height:"100%"}})])],1)},o=[],n=(i("7cfd"),i("8f42"),i("0b34")),c=i.n(n),r=i("5d2d"),s=i("37b6"),u=i("9efd"),l=i("bbb4"),d=i.n(l),f=i("3fc0"),p=i.n(f),g={data:function(){return{host:s["a"],wechatCodeURL:s["e"],imageVoucherURL:s["c"],wxGuide:d.a,alipayGuide:p.a,token:r["a"].getSession("token")||"",files:[],userCodeWXImg:null,alipayCodeImg:null,files2:[],detailList:[],wxStatus:null,alipayStatus:null,wxFailMsg:null,alipayFailMsg:null,codeNick:"",showGuide:!1,userId:""}},props:{activeTab:{type:Number,default:0}},components:{FileUpload:c.a},mounted:function(){this.userId=r["a"].get("userInfo").id||""},methods:{onClikRight:function(){var e=this,t={wechat:this.userCodeWXImg,codeNick:this.codeNick};2===this.activeTab&&(t={alipay:this.userCodeWXImg,codeNick:this.codeNick}),Object(u["b"])(t).then((function(t){e.$toast("上传成功"),e.codeNick="",e.userCodeWXImg=null,e.$emit("goBack",!0)})).catch((function(t){e.$notify("".concat(t.message))}))},onClickLeft:function(){this.$emit("goBack"),this.codeNick="",this.userCodeWXImg=null},getUserCodeList:function(){var e=this;Object(u["q"])().then((function(t){var i=t.data.records;if(e.detailList=t.data.records,i.length>0){var a=i.filter((function(e){return 0===e.codeType&&0===e.codeMoney}))[0],o=i.filter((function(e){return 1===e.codeType&&0===e.codeMoney}))[0];a&&(e.userCodeWXImg=a.codeImgUrl,e.wxStatus=a.status,e.wxFailMsg=a.failMsg),o&&(e.alipayCodeImg=o.codeImgUrl,e.alipayStatus=o.status,e.alipayFailMsg=o.failMsg)}})).catch((function(t){e.$notify("".concat(t.message))}))},inputFile:function(e,t){if(e&&t&&(e.active,t.active,e.progress,t.progress,e.error,t.error,e.success!==t.success)){var i=e.response;200===i.code?this.userCodeWXImg=i.data:this.$notify("图片上传失败："+JSON.stringify(i))}!e&&t&&t.success&&t.response.id,Boolean(e)===Boolean(t)&&t.error===e.error||this.$refs.upload.active||(this.$refs.upload.active=!0)},inputFilter:function(e,t,i){if(e&&!t&&!/\.(jpeg|jpe|jpg|gif|png|webp)$/i.test(e.name))return i();e.blob="";var a=window.URL||window.webkitURL;a&&a.createObjectURL&&(e.blob=a.createObjectURL(e.file))},inputFile2:function(e,t){if(e&&t&&(e.active,t.active,e.progress,t.progress,e.error,t.error,e.success!==t.success)){var i=e.response;200===i.code?this.alipayCodeImg=i.data:this.$notify("图片上传失败："+JSON.stringify(i))}!e&&t&&t.success&&t.response.id,Boolean(e)===Boolean(t)&&t.error===e.error||this.$refs.uploadAlipay.active||(this.$refs.uploadAlipay.active=!0)}}},h=g,b=(i("b4d5"),i("6691")),v=Object(b["a"])(h,a,o,!1,null,"2496acda",null);t["default"]=v.exports},"8f42":function(e,t,i){"use strict";var a=i("3f8b"),o=i("549d"),n=i("6077"),c=i("1e01"),r=i("2ab1"),s=i("0cc1"),u=i("cb2e").f,l=i("e493").f,d=i("d3d8").f,f=i("7130").trim,p="Number",g=a[p],h=g,b=g.prototype,v=n(i("65c3")(b))==p,m="trim"in String.prototype,y=function(e){var t=r(e,!1);if("string"==typeof t&&t.length>2){t=m?t.trim():f(t,3);var i,a,o,n=t.charCodeAt(0);if(43===n||45===n){if(i=t.charCodeAt(2),88===i||120===i)return NaN}else if(48===n){switch(t.charCodeAt(1)){case 66:case 98:a=2,o=49;break;case 79:case 111:a=8,o=55;break;default:return+t}for(var c,s=t.slice(2),u=0,l=s.length;u<l;u++)if(c=s.charCodeAt(u),c<48||c>o)return NaN;return parseInt(s,a)}}return+t};if(!g(" 0o1")||!g("0b1")||g("+0x1")){g=function(e){var t=arguments.length<1?0:e,i=this;return i instanceof g&&(v?s((function(){b.valueOf.call(i)})):n(i)!=p)?c(new h(y(t)),i,g):y(t)};for(var I,w=i("f9a5")?u(h):"MAX_VALUE,MIN_VALUE,NaN,NEGATIVE_INFINITY,POSITIVE_INFINITY,EPSILON,isFinite,isInteger,isNaN,isSafeInteger,MAX_SAFE_INTEGER,MIN_SAFE_INTEGER,parseFloat,parseInt,isInteger".split(","),C=0;w.length>C;C++)o(h,I=w[C])&&!o(g,I)&&d(g,I,l(h,I));g.prototype=b,b.constructor=g,i("a6d5")(a,p,g)}},"996b":function(e,t,i){},ae6e:function(e,t,i){var a=i("da0b"),o=i("8cac"),n=function(e,t){if(o(e),!a(t)&&null!==t)throw TypeError(t+": can't set as prototype!")};e.exports={set:Object.setPrototypeOf||("__proto__"in{}?function(e,t,a){try{a=i("e85e")(Function.call,i("e493").f(Object.prototype,"__proto__").set,2),a(e,[]),t=!(e instanceof Array)}catch(o){t=!0}return function(e,i){return n(e,i),t?e.__proto__=i:a(e,i),e}}({},!1):void 0),check:n}},b4d5:function(e,t,i){"use strict";var a=i("996b"),o=i.n(a);o.a},bbb4:function(e,t,i){e.exports=i.p+"img/wx_guide.34bc1b9b.jpg"},cb2e:function(e,t,i){var a=i("7afe"),o=i("d93f").concat("length","prototype");t.f=Object.getOwnPropertyNames||function(e){return a(e,o)}},e493:function(e,t,i){var a=i("c864"),o=i("0614"),n=i("6117"),c=i("2ab1"),r=i("549d"),s=i("25ae"),u=Object.getOwnPropertyDescriptor;t.f=i("f9a5")?u:function(e,t){if(e=n(e),t=c(t,!0),s)try{return u(e,t)}catch(i){}if(r(e,t))return o(!a.f.call(e,t),e[t])}}}]);
//# sourceMappingURL=chunk-31dfc6cc.3f1001c2.js.map