(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-57d8499b"],{"02c4":function(e,t,n){"use strict";n.r(t);var a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"carry-order"},[n("header",[e._v("首页")]),n("section",[n("van-tabs",{model:{value:e.activeTab,callback:function(t){e.activeTab=t},expression:"activeTab"}},[n("van-tab",{attrs:{title:"手册",name:0}}),e.type?n("van-tab",{attrs:{title:"抢单",name:1}}):e._e(),e.type?n("van-tab",{attrs:{title:"进行中",name:2}}):e._e(),e.type?e._e():n("van-tab",{attrs:{title:"进行中",name:3}}),n("van-tab",{attrs:{title:"客服",name:4}})],1),n(e.viewMap[e.activeTab],{tag:"component",attrs:{carryOrderList:e.carryOrderList},on:{openGrabOrder:e.openGrabOrder,closeGrabOrder:e.closeGrabOrder}})],1)])},r=[],c=n("5d2d"),i=n("c821"),u=n("9efd"),s=function(){return Promise.all([n.e("chunk-2c41e510"),n.e("chunk-071b2878"),n.e("chunk-41206b58")]).then(n.bind(null,"188c"))},o=function(){return Promise.all([n.e("chunk-2c41e510"),n.e("chunk-071b2878"),n.e("chunk-290088a4")]).then(n.bind(null,"a6fe"))},l=function(){return n.e("chunk-38d9c4e3").then(n.bind(null,"5bc6"))},b=function(){return Promise.all([n.e("chunk-2c41e510"),n.e("chunk-9fea3c5c")]).then(n.bind(null,"c2fa"))},d=function(){return n.e("chunk-24229c8f").then(n.bind(null,"b670"))},f={name:"carryOrder",data:function(){return{times1:c["a"].times1,type:!1,activeTab:0,viewMap:[l,s,b,o,d]}},watch:{activeTab:function(e){c["a"].set("activeTab",e)}},props:{carryOrderList:{type:Array,default:function(){return[]}}},mounted:function(){this.activeTab=c["a"].get("activeTab")||0},methods:{openGrabOrder:function(){this.$emit("openGrabOrder")},closeGrabOrder:function(){this.$emit("closeGrabOrder")},getQueryIsOpenPai:function(){var e=this;Object(u["C"])().then((function(t){e.type=0!==t.data,e.$emit("setIsOnlineShow",e.type),e.times1=setTimeout((function(){e.getQueryIsOpenPai(),clearTimeout(e.times1)}),5e3)})).catch((function(t){e.$notify("".concat(t.message)),e.times1=setTimeout((function(){e.getQueryIsOpenPai(),clearTimeout(e.times1)}),5e3)}))},clearTime:function(){clearTimeout(this.times1)}},created:function(){this.getQueryIsOpenPai(),i["a"].$on("clearTime",this.clearTime)}},m=f,h=(n("18dd"),n("6691")),p=Object(h["a"])(m,a,r,!1,null,"728c631b",null);t["default"]=p.exports},"18dd":function(e,t,n){"use strict";var a=n("5c32"),r=n.n(a);r.a},"5c32":function(e,t,n){},c821:function(e,t,n){"use strict";var a=n("6e6d");t["a"]=new a["a"]}}]);
//# sourceMappingURL=chunk-57d8499b.a72ea326.js.map