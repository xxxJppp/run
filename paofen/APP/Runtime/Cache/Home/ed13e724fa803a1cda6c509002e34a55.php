<?php if (!defined('THINK_PATH')) exit();?><html lang="en" style="font-size: 100px;"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0"><link rel="icon" href="/favicon.ico"><title>h8pay</title><style>body {
        background: #f2f2f2;
      }
      @media screen and (min-width: 767px) {
        #app {
          width: 540px;
          margin: 0 auto;
          min-height: 100vh;
          box-sizing: border-box;
          border: 1px solid #999;
          /* overflow-y: hidden; */
        }
        .van-popup--top {
          width: 540px;
          margin: 0 auto;
        }
      }</style><link href="/css/chunk-02960128.d8e4678b.css" rel="prefetch"><link href="/css/chunk-03d19c5b.da3b4d7d.css" rel="prefetch"><link href="/css/chunk-12ee7e7e.be873f85.css" rel="prefetch"><link href="/css/chunk-16db521b.9f656bd8.css" rel="prefetch"><link href="/css/chunk-24229c8f.122b5dbc.css" rel="prefetch"><link href="/css/chunk-260b9ee0.d82954b0.css" rel="prefetch"><link href="/css/chunk-28327744.848026e7.css" rel="prefetch"><link href="/css/chunk-290088a4.e0e1dd88.css" rel="prefetch"><link href="/css/chunk-293e36ce.b6fe070f.css" rel="prefetch"><link href="/css/chunk-2a2c3438.3a05a371.css" rel="prefetch"><link href="/css/chunk-30530650.83ef8890.css" rel="prefetch"><link href="/css/chunk-31dfc6cc.49d996f2.css" rel="prefetch"><link href="/css/chunk-38d9c4e3.72558616.css" rel="prefetch"><link href="/css/chunk-3e56bb55.eded3812.css" rel="prefetch"><link href="/css/chunk-41206b58.2fe3c40b.css" rel="prefetch"><link href="/css/chunk-43155bdd.7506223a.css" rel="prefetch"><link href="/css/chunk-45fabb50.f6fb2ae2.css" rel="prefetch"><link href="/css/chunk-4dbebf52.c3310d55.css" rel="prefetch"><link href="/css/chunk-501ca340.bb40b437.css" rel="prefetch"><link href="/css/chunk-5753040b.49d996f2.css" rel="prefetch"><link href="/css/chunk-57d8499b.96222562.css" rel="prefetch"><link href="/css/chunk-58705b64.1442bd8d.css" rel="prefetch"><link href="/css/chunk-5ea3ec15.30d377cf.css" rel="prefetch"><link href="/css/chunk-5f1d8bc4.25eff320.css" rel="prefetch"><link href="/css/chunk-6731c9f2.5b48773c.css" rel="prefetch"><link href="/css/chunk-6a2440bf.15a728eb.css" rel="prefetch"><link href="/css/chunk-6de0daa4.5391e009.css" rel="prefetch"><link href="/css/chunk-731cdd2b.a9740232.css" rel="prefetch"><link href="/css/chunk-9fea3c5c.531c8116.css" rel="prefetch"><link href="/css/chunk-ae7bdc24.38e0efd9.css" rel="prefetch"><link href="/css/chunk-d08caeb6.b385e467.css" rel="prefetch"><link href="/css/chunk-dee820da.cfa2c36a.css" rel="prefetch"><link href="/css/chunk-e1f1707a.079dd8a4.css" rel="prefetch"><link href="/css/chunk-e911781e.d87f005c.css" rel="prefetch"><link href="/css/chunk-edede612.b1bc4af4.css" rel="prefetch"><link href="/css/chunk-fde07e7a.adc0509a.css" rel="prefetch"><link href="/js/chunk-02960128.e3c7e508.js" rel="prefetch"><link href="/js/chunk-03d19c5b.27befa25.js" rel="prefetch"><link href="/js/chunk-071b2878.ae2fec1b.js" rel="prefetch"><link href="/js/chunk-089a5e6c.989dbb83.js" rel="prefetch"><link href="/js/chunk-12ee7e7e.307cd1dc.js" rel="prefetch"><link href="/js/chunk-16db521b.7109f654.js" rel="prefetch"><link href="/js/chunk-170f8e40.69f62aae.js" rel="prefetch"><link href="/js/chunk-24229c8f.46929d5e.js" rel="prefetch"><link href="/js/chunk-260b9ee0.1a81655c.js" rel="prefetch"><link href="/js/chunk-28327744.4a11f784.js" rel="prefetch"><link href="/js/chunk-290088a4.e862636e.js" rel="prefetch"><link href="/js/chunk-293e36ce.1420743f.js" rel="prefetch"><link href="/js/chunk-2a2c3438.65ad57de.js" rel="prefetch"><link href="/js/chunk-2c41e510.2c195371.js" rel="prefetch"><link href="/js/chunk-2d0f0c02.2926760c.js" rel="prefetch"><link href="/js/chunk-2d209530.b5cf094b.js" rel="prefetch"><link href="/js/chunk-30530650.c54c1d46.js" rel="prefetch"><link href="/js/chunk-31dfc6cc.3f1001c2.js" rel="prefetch"><link href="/js/chunk-38d9c4e3.8ea2ebe4.js" rel="prefetch"><link href="/js/chunk-3e56bb55.719e241b.js" rel="prefetch"><link href="/js/chunk-41206b58.9330140e.js" rel="prefetch"><link href="/js/chunk-43155bdd.e84d6a1d.js" rel="prefetch"><link href="/js/chunk-45fabb50.f76bd21f.js" rel="prefetch"><link href="/js/chunk-4dbebf52.4e82767b.js" rel="prefetch"><link href="/js/chunk-501ca340.0957cc55.js" rel="prefetch"><link href="/js/chunk-5753040b.b03c4f33.js" rel="prefetch"><link href="/js/chunk-57d8499b.a72ea326.js" rel="prefetch"><link href="/js/chunk-58705b64.3dc71b78.js" rel="prefetch"><link href="/js/chunk-5ea3ec15.3c920ba3.js" rel="prefetch"><link href="/js/chunk-5f1d8bc4.231bcb0e.js" rel="prefetch"><link href="/js/chunk-6731c9f2.10291975.js" rel="prefetch"><link href="/js/chunk-6a2440bf.68deef23.js" rel="prefetch"><link href="/js/chunk-6de0daa4.ea9e4c1a.js" rel="prefetch"><link href="/js/chunk-731cdd2b.fd165dc0.js" rel="prefetch"><link href="/js/chunk-9fea3c5c.ffde5972.js" rel="prefetch"><link href="/js/chunk-ae7bdc24.95a06cff.js" rel="prefetch"><link href="/js/chunk-d08caeb6.4d2b8171.js" rel="prefetch"><link href="/js/chunk-dee820da.c9a3f55b.js" rel="prefetch"><link href="/js/chunk-e1f1707a.6a487118.js" rel="prefetch"><link href="/js/chunk-e2d3447a.df0751b6.js" rel="prefetch"><link href="/js/chunk-e911781e.429fdb74.js" rel="prefetch"><link href="/js/chunk-edede612.c01c3641.js" rel="prefetch"><link href="/js/chunk-fde07e7a.d481bd8c.js" rel="prefetch"><link href="/css/app.2150f8cc.css" rel="preload" as="style"><link href="/css/chunk-vendors.e9f6096e.css" rel="preload" as="style"><link href="/js/app.7b6aaa54.js" rel="preload" as="script"><link href="/js/chunk-vendors.9dc788ca.js" rel="preload" as="script"><link href="/css/chunk-vendors.e9f6096e.css" rel="stylesheet"><link href="/css/app.2150f8cc.css" rel="stylesheet"><link rel="stylesheet" type="text/css" href="/css/chunk-fde07e7a.adc0509a.css"><script charset="utf-8" src="/js/chunk-fde07e7a.d481bd8c.js"></script><link rel="stylesheet" type="text/css" href="/css/chunk-ae7bdc24.38e0efd9.css"><script charset="utf-8" src="/js/chunk-ae7bdc24.95a06cff.js"></script><script charset="utf-8" src="/js/chunk-089a5e6c.989dbb83.js"></script><link rel="stylesheet" type="text/css" href="/css/chunk-57d8499b.96222562.css"><script charset="utf-8" src="/js/chunk-57d8499b.a72ea326.js"></script><script charset="utf-8" src="/js/chunk-2d0f0c02.2926760c.js"></script>
     <script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<script type="text/javascript" src="/Public/home/common/js/index.js" ></script>
      <script>
if(('standalone' in window.navigator)&&window.navigator.standalone){
var noddy,remotes=false;
document.addEventListener('click',function(event){
noddy=event.target;
while(noddy.nodeName!=='A'&&noddy.nodeName!=='HTML') noddy=noddy.parentNode;
if('href' in noddy&&noddy.href.indexOf('http')!==-1&&(noddy.href.indexOf(document.location.host)!==-1||remotes)){
event.preventDefault();
document.location.href=noddy.href;
}
},false);
}
</script></head><body class="">

<div id="app"><div data-v-41371306 class="home"><!--span data-v-41371306 class="online-status">
    离线
  </span--><div data-v-e8eda342=""  class="information" carryorderlist=""><header data-v-e8eda342="">我的</header><section data-v-e8eda342="" class="info-main"><div data-v-e8eda342="" class="flexh flex-between info-header"><div data-v-e8eda342=""><div data-v-e8eda342="" class="user-name">
          <?php echo ($list["username"]); ?>
          <span data-v-e8eda342="" style="font-weight: normal; font-size: 0.13rem;"><img data-v-e8eda342="" src="/img/dengji.png" alt="等级图片" class="rank-img">
           
            <span data-v-e8eda342="" style="color: rgb(153, 153, 153);">
             <?php if($list['agent'] == 1 ): ?>代理<?php else: ?>会员<?php endif; ?>
            </span></span></div><div data-v-e8eda342="" style="color: rgb(89, 89, 89);">账号：<?php echo ($list["account"]); ?></div><div  class="font-13 success-color">
          <a href="<?php echo U('User/password');?>">重置密码</a>
  <?php if($list['agent'] == 1 ): ?><span style="margin-left:6%;color: #000;" onclick="copyUrl();">邀请码:<?php echo ($list["u_yqm"]); ?></span>
  <span hidden id="txt"><?php echo ($list["u_yqm"]); ?></span>
   <script type="text/javascript">
        function copyUrl()
        {
            var txt=$("#txt").text();
            copy(txt);
        }

        function copy(message) {
            var input = document.createElement("input");
            input.value = message;
            document.body.appendChild(input);
            input.select();
            input.setSelectionRange(0, input.value.length), document.execCommand('Copy');
            document.body.removeChild(input);
            msg_alert("复制成功");
        }
    </script><?php endif; ?>
        </div></div><div data-v-e8eda342="" class="center"><div data-v-e8eda342="" class="believe-score">
          <?php echo ($list["xyf"]); ?>
        </div><div data-v-e8eda342="" class="font-12 green" style="text-decoration: underline; line-height: 0.2rem;">信誉积分&gt;</div></div></div><section data-v-e8eda342="">
  <div data-v-e8eda342="" class="user-info"><div data-v-e8eda342="" class="flexh flex-between"><div data-v-e8eda342="" class="lineHeight-30 center flex1"><div data-v-e8eda342=""><?php echo ($list["money"]); ?></div>
    <div data-v-e8eda342="" class="font-13">账户余额</div></div><div data-v-e8eda342="" class="lineHeight-30 center flex1"><div data-v-e8eda342=""><?php echo ($djs); ?></div>
    <div data-v-e8eda342="" class="font-13">冻结金额</div></div></div></div><div data-v-e8eda342="" class="info-detail flexh flex-wrap flex-align-center">
  <div data-v-e8eda342="" class="user-main"><div data-v-e8eda342=""><?php echo ($list["zsy"]); ?></div>
    <div data-v-e8eda342="" class="font-13 gray">总收益</div></div><!---->
  <div data-v-e8eda342="" class="user-main"><div data-v-e8eda342=""><?php echo ($wx); ?></div>
    <div data-v-e8eda342="" class="font-13 gray">今日微信收款</div></div>
  <div data-v-e8eda342="" class="user-main" style="border-bottom: 0.01rem solid rgb(245, 242, 242);">
    <div data-v-e8eda342=""><?php echo ($zfb); ?></div>
    <div data-v-e8eda342="" class="font-13 gray">今日支付宝收款</div></div>
    
    <div data-v-e8eda342="" class="user-main" style="border-bottom: 0.01rem solid rgb(245, 242, 242);">
    <div data-v-e8eda342=""><?php echo ($yhk); ?></div>
    <div data-v-e8eda342="" class="font-13 gray">今日银行卡收款</div></div>
    
  <div data-v-e8eda342="" class="user-main" style="border-bottom: none;">
  <div data-v-e8eda342=""><?php echo ($zzz); ?></div><div data-v-e8eda342="" class="font-13 gray">总收款金额</div></div>
  <div data-v-e8eda342="" class="user-main" style="border-bottom: none;">
  <div data-v-e8eda342="" style="color: rgb(241, 117, 123);"><?php echo ($ts); ?></div>
    <div data-v-e8eda342="" class="font-13 gray">申诉次数</div></div>
  </div><div data-v-e8eda342="" class="operation-chunk font-15">
		
		<div data-v-e8eda342="" class="flexh flex-between user-operation" onclick="location='<?php echo U('User/bill');?>'"><div data-v-e8eda342=""><img data-v-e8eda342="" src="/img/liushui.png" alt="" class="icon"><span data-v-e8eda342="">流水明细</span></div>
		<img  src="/img/you.png" alt="" class="icon2" style="margin-top: 0.18rem;"></div>
		<div data-v-e8eda342="" class="flexh flex-between user-operation" onclick="location='<?php echo U('Index/shoudan');?>'"><div data-v-e8eda342=""><img data-v-e8eda342="" src="/img/lishi.png" alt="" class="icon"><span data-v-e8eda342="">历史抢单</span></div>
<img  src="/img/you.png" alt="" class="icon2" style="margin-top: 0.18rem;"></div>
		<div data-v-e8eda342="" class="flexh flex-between user-operation" onclick="location='<?php echo U('/Recharge/chongzhijilu');?>'"><div data-v-e8eda342=""><img data-v-e8eda342="" src="/img/czdd.png" alt="" class="icon"><span data-v-e8eda342="">充值订单</span></div>
		<img  src="/img/you.png" alt="" class="icon2" style="margin-top: 0.18rem;"></div>
		<div data-v-e8eda342="" class="flexh flex-between user-operation" onclick="location='<?php echo U('/Withdraw/index');?>'"><div data-v-e8eda342=""><img data-v-e8eda342="" src="/img/txjl.png" alt="" class="icon"><span data-v-e8eda342="">提现记录</span></div>
		<img  src="/img/you.png" alt="" class="icon2" style="margin-top: 0.18rem;"></div>
		<div data-v-e8eda342="" class="flexh flex-between user-operation" onclick="location='<?php echo U('/User/erweima');?>'"><div data-v-e8eda342=""><img data-v-e8eda342="" src="/img/skm.png" alt="" class="icon"><span data-v-e8eda342="">收款码</span></div>
		<img  src="/img/you.png" alt="" class="icon2" style="margin-top: 0.18rem;"></div>
		
		<!----><!----></div><button data-v-e8eda342="" onclick="window.location.href='/Login/logout.html'" class="login-out van-button van-button--default van-button--normal"><span data-v-e8eda342="" class="van-button__text">退出登录</span></button></section></section></div>
		
		
		<div data-v-41371306="" class="van-hairline--top-bottom van-tabbar van-tabbar--fixed" style="z-index: 1;"><div data-v-41371306="" class="van-tabbar-item">
		<div class="van-tabbar-item__icon"><!----></div><a href="<?php echo U('Index/index');?>"><div class="van-tabbar-item__text">
		<img data-v-41371306="" src="/img/home1.png" alt="" class="home-icons"></div></a></div><div data-v-41371306="" class="van-tabbar-item"><div class="van-tabbar-item__icon"><!----></div>
		<a href="<?php echo U('Recharge/chongzhi');?>"><div class="van-tabbar-item__text"><img data-v-41371306="" src="/img/chongzhi1.png" alt="" class="home-icons"></div></a>
		</div><div data-v-41371306="" class="van-tabbar-item"><div class="van-tabbar-item__icon"><!----></div>
		<a href="<?php echo U('Withdraw/tixian');?>">
		<div class="van-tabbar-item__text"><img data-v-41371306="" src="/img/tixian1.png" alt="" class="home-icons"></div></a></div><div data-v-41371306="" class="van-tabbar-item van-tabbar-item--active"><div class="van-tabbar-item__icon"><!----></div>
		<a href="<?php echo U('User/index');?>">
		<div class="van-tabbar-item__text"><img data-v-41371306="" src="/img/center.png" alt="" class="home-icons"></div></a></div></div>
		
		</div></div>
  
  
 </body></html>