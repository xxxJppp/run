(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2a2c3438"],{"454b":function(t,e,i){},"65b2":function(t,e,i){t.exports=i.p+"img/confirm_pay.8306ae71.png"},"839d":function(t,e,i){"use strict";var n=i("454b"),s=i.n(n);s.a},ba9b:function(t,e,i){"use strict";i.r(e);var n=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticStyle:{"text-align":"center"}},[n("div",{staticClass:"account-info"},[n("div",{staticClass:"pay-money"},[t._v("\n      "+t._s("ALIPAY"===t.strechInfo.outChannel?"支付宝":"WXMQR"===t.strechInfo.outChannel?"微信":"--")+"\n        "),n("span",{staticClass:"fail-color bold",staticStyle:{"font-size":".18rem"}},[t._v(t._s(t.strechInfo.amount||0))])]),n("div",{staticClass:"flexh"},[n("div",{staticClass:"MR20"},[t._v("进行中")]),n("van-button",{staticClass:"strech-btn",attrs:{plain:"",hairline:"",type:"primary",size:"small"},on:{click:function(e){return t.$emit("shrink")}}},[t._v("收起")])],1)]),n("div",{staticClass:"account-no flex1"},[t._v("\n    订单号："+t._s(t.strechInfo.orderNo||"")+"\n  ")]),t.strechInfo.transferImg?n("div",{staticClass:"wx-code"},[n("img",{staticClass:"wx-code-img",attrs:{src:t.imageURL+t.strechInfo.transferImg,alt:"二维码"},on:{click:function(e){t.showOrderImg=!0}}})]):t._e(),n("div",{staticClass:"account-tip"},[n("div",[n("span",{staticClass:"MR20"},[t._v("收款人：\n        "),n("span",{staticClass:"warn-tip"},[t._v(t._s(t.strechInfo.qrCodeNick))])]),n("span",{staticClass:"green font-13",on:{click:function(e){t.showUserCodeImg=!0}}},[t._v("查看收款码")])]),n("div",[t._v("\n      超时时间："),n("span",{staticStyle:{color:"red"}},[t._v(t._s(t._f("timeData")(t.strechInfo.orderOverTime.join("-"))))])])]),n("img",{staticStyle:{width:"2.5rem",height:".3rem"},attrs:{src:i("65b2"),alt:""},on:{click:t.confirmAcceptFn}}),n("van-button",{staticClass:"complain",on:{click:function(e){t.showComplain=!0}}},[t._v("\n    申 诉\n  ")]),n("van-popup",{staticStyle:{width:"90%",heigh:"90%"},model:{value:t.showOrderImg,callback:function(e){t.showOrderImg=e},expression:"showOrderImg"}},[n("img",{staticClass:"code-img",attrs:{src:t.imageURL+t.strechInfo.transferImg,width:"100%"},on:{click:function(e){t.showOrderImg=!1}}})]),n("van-popup",{staticStyle:{width:"90%"},model:{value:t.showUserCodeImg,callback:function(e){t.showUserCodeImg=e},expression:"showUserCodeImg"}},[n("img",{attrs:{src:t.wechatCodeURL+t.strechInfo.qrCodeImg,width:"100%"},on:{click:function(e){t.showUserCodeImg=!1}}})]),n("van-dialog",{attrs:{"show-confirm-button":!(!t.complainInfo||!t.receivablesImg),"show-cancel-button":""},on:{confirm:t.confirmComplain},model:{value:t.showComplain,callback:function(e){t.showComplain=e},expression:"showComplain"}},[n("van-field",{attrs:{placeholder:"请输入申诉信息",clearable:"",rows:"1",autosize:""},model:{value:t.complainInfo,callback:function(e){t.complainInfo=e},expression:"complainInfo"}}),t.receivablesImg?n("img",{staticClass:"upload-img",attrs:{src:t.imageVoucherURL+t.receivablesImg}}):t._e(),n("file-upload",{ref:"upload",staticClass:"input-file",attrs:{"put-action":t.host+"/api/v1/brush/uploadVoucher",accept:"image/*",name:"file",headers:{Authorization:t.token||""},data:{id:t.strechInfo.id}},on:{"input-file":t.inputFile,"input-filter":t.inputFilter},model:{value:t.files,callback:function(e){t.files=e},expression:"files"}},[t.receivablesImg?t._e():n("div",{staticClass:"upload-img"},[n("van-icon",{attrs:{name:"plus"}})],1),n("div",{staticClass:"MB10",staticStyle:{color:"#288837"}},[t._v("上传收款截图")])])],1)],1)},s=[],o=(i("7cfd"),i("0b34")),a=i.n(o),c=i("9efd"),r=i("ca00"),l=i("37b6"),f=i("5d2d"),m=function(){return i.e("chunk-e2d3447a").then(i.bind(null,"cd26"))},u={data:function(){return{host:l["a"],imageURL:l["b"],imageVoucherURL:l["c"],wechatCodeURL:l["e"],showOrderImg:!1,showComplain:!1,receivablesImg:"",complainInfo:"",token:f["a"].getSession("token")||"",files:[],showUserCodeImg:!1}},components:{countDown:m,FileUpload:a.a},props:{strechInfo:{type:Object,default:function(){}}},filters:{timeData:r["c"]},methods:{confirmComplain:function(){var t=this;Object(c["i"])({id:this.strechInfo.id,imgPath:this.receivablesImg,remark:this.complainInfo}).then((function(e){t.$toast("申诉成功,平台会及时处理，请耐心等待，谢谢！"),t.$emit("confirmAccept")})).catch((function(e){t.$notify("".concat(e.message))}))},onClickLeft:function(){this.showComplain=!1},confirmAcceptFn:function(){var t=this;this.$dialog.confirm({message:"确认已经收到款，否则不要点确认，造成损失自己负责"}).then((function(){Object(c["j"])({id:t.strechInfo.id}).then((function(e){t.$emit("confirmAccept"),t.$toast("确认收款成功")})).catch((function(e){t.$notify("".concat(e.message))}))})).catch((function(t){}))},inputFile:function(t,e){if(t&&e&&(t.active,e.active,t.progress,e.progress,t.error,e.error,t.success!==e.success)){var i=t.response;200===i.code?this.receivablesImg=i.data:this.$notify("图片上传失败："+JSON.stringify(i))}!t&&e&&e.success&&e.response.id,Boolean(t)===Boolean(e)&&e.error===t.error||this.$refs.upload.active||(this.$refs.upload.active=!0)},inputFilter:function(t,e,i){if(t&&!e&&!/\.(jpeg|jpe|jpg|gif|png|webp)$/i.test(t.name))return i();t.blob="";var n=window.URL||window.webkitURL;n&&n.createObjectURL&&(t.blob=n.createObjectURL(t.file))}}},d=u,h=(i("839d"),i("6691")),p=Object(h["a"])(d,n,s,!1,null,"fe491b14",null);e["default"]=p.exports}}]);
//# sourceMappingURL=chunk-2a2c3438.65ad57de.js.map