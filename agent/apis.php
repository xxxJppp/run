<?php 

define('ACC',TRUE);

include('./sys/init.php');


if ($_POST['shid'] == '') {
    
    jump('-1','商户账号不能为空');
}

if ($_POST['key'] == '') {
    
    jump('-1','商户秘钥不能为空');
}
if ($_POST['orderid'] == '') {
    
    jump('-1','订单号不能为空');
}


$nas  = $_POST['shid'];
$info = $mysql->select('ysk_agent','*','names='."'$nas'");

if (empty($info)) {

   jump('-1','效验失败商户账号不正确');

} else {

    if ($info['key'] != $_POST['key']) {
        jump('-1','效验失败商户秘钥不正确');
    }
}

$type = $_POST['pay'];

$ip = $_SERVER['REMOTE_ADDR'];

$mysql->delete('ysk_roborder','status = 1 and ip='."'$ip'");


if ($type == 'wx') {

  $img  = './demo/images/logo-wxpay.png';

  $title = '微信支付';

  $wxid =  1;
  $class= "logo wechat";
} else if($type == 'zfb'){
  
  $img  = './demo/images/logo-wxpay.png';

  $title = '支付宝支付';

  $wxid =  2;

  $class= "logo alipay";

 

} else if($type == 'yl'){

  $img  = './demo/images/logo-wxpay.png';

  $title = '银联支付';
  $wxid =  3;
} else {

  $img  = './demo/images/logo-wxpay.png';

  $title = '支付宝支付';

  $class= "logo alipay";

  $wxid =  2; 
}

if ($_POST['amount']<=0) {
    jump('api.php','充值金额不能为0');
} else {

    $money = $_POST['amount'];
}

$sn = $_POST['orderid'] == ''?'E'.time().rand(0000,9999):$_POST['orderid'];

if ($sn == '') {
    
    jump('api.php','订单异常，请重新发起');
}

$iii = $mysql->select('ysk_roborder','*','ordernum='."'$sn'");

if (empty($iii)) {
    $p['class'] = $wxid;
    $p['price'] = $money;
    $p['addtime'] = time();
    $p['status'] = 1;
    $p['shanghu_name'] = $nas;
    $p['ordernum'] = $_POST['orderid'];
    $p['ip'] = $_SERVER['REMOTE_ADDR'];
    $mysql->insert('ysk_roborder',$p);
}



$id = mysqli_insert_id();


$m = $_POST['amount'];
$oid = $_POST['orderid'];

$listss = $mysql->select_all('ysk_roborder','*','status = 1');

foreach($listss as $k=>$v) {
     
       $a = $v['addtime'];
       $sheng =  time() - $a;
       if ($sheng > 50) {
          
           $mysql->delete('ysk_roborder','id='.$v['id']);
       }
}
?>




















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" name="viewport">

    <title>
        收银台
    </title>
    <link rel="stylesheet" href="./demo/css/bootstrap.min.css">
</head>
<style>
    li{list-style: none;} .header{width:100%; height:60px;background: #fefefe;border-bottom:
        2px solid #f68452;} .header .title{width: 1000px;margin: 0 auto;position:
        relative;} .header .title .scan_code{display:none;width:190px;height:190px;position:
        absolute;right: 0px;top: 52px;background: #ffffff;border: 1px solid #dcdcdc;box-shadow:0
    0 7px rgba(115, 115, 115, .2);-webkit-box-shadow:0 0 7px rgba(115, 115,
    115, .2);-moz-box-shadow:0 0 7px rgba(1115, 115, 115, .2);} .header .title
                                                                .scan_code img{width: 160px;height: 160px;padding: 15px;} .header .title
                                                                                                                          .logo{font-family: "æ–¹æ­£æ­£é»‘ç®€ä½“";font-size:22px;color:#000000;float:left;background:
        url(img/icon_logo.png) no-repeat left center;display:inline-block;height:
        30px;margin-top: 17px;padding-left: 126px;} .header .title .logo span{font-size:
        24px;color: #9f9f9f;font-family: "å¾®è½¯é›…é»‘";background: url(img/syt_03.png)
    no-repeat 8px 4px;display: block;width: 72px;height:30px;} .header .title
                                                               .right{float:right; padding-top:16px;} .header .title .right ul{float:right;
                                                                                                          padding-top:7px;} .header .title .right li{float:left; padding-left:15px;font-size:12px;line-height:
        17px;height: 17px;} .header .title .right li span{display:inline-block;color:#868686;
                                background-repeat:no-repeat; background-image:url(img/icon_header.png);letter-spacing:
            1px;} .icon_info{padding-left:21px; background-position:left top;line-height:
        13px;} .icon_qq{padding-left:22px; background-position:left -13px;} .icon_phone{padding-left:21px;
                                                                                background-position:left -30px;} .login{padding-left: 15px;} .iap_new img{margin-left:
        8px;float: right;margin-top: 1px;} .iap_new:hover .scan_code{display: block;}
    .list-inline > li { margin: 5px; padding:5px; width:300px; position: relative;
        font-size:1.2em; }
</style>


<script>


</script>

<script src="./public/ui/layer.js"></script>
<script src="./public/ui/layui/layui.all.js" charset="utf-8"></script>
<body style="background-color: #ecedf2;">
<div class="container" style="background-color:#fff;padding:15px; margin-top: 15px;">
    <div class="row">
        <!--交易信息-->
        <div class="col-md-12">
            <ul class="list-inline">
                <li>
                    <strong>
                        订单金额：
                        <span class="text-danger">
                                    <?php echo $_REQUEST['amount']; ?>
                                </span>
                        &nbsp;&nbsp;元
                    </strong>
                </li>
                <li>
                    <strong>
                        商品名称：
                    </strong>
                    在线支付
                </li>
                <li>
                    <strong>
                        订单编号：
                    </strong>
                    <?php echo $_REQUEST['orderid']; ?>
                </li>
                <li>
                    <strong>
                        交易币种：
                    </strong>
                    人民币
                </li>
                <li>
                    <strong>
                        交易时间：
                    </strong>
                    <?=date('Y-m-d H:i:s')?>
                </li>
            </ul>
        </div>
    </div>
    <style type="text/css">

        h1 {

            font-family:"微软雅黑";

            font-size:40px;

            margin:20px 0;

            border-bottom:solid 1px #ccc;

            padding-bottom:20px;

            letter-spacing:2px;

        }

        .time-item strong {

               background: #C71C60;
    color: #fff;
    line-height: 49px;
    font-size: 30px;
    font-family: Arial;
    padding: 0 10px;
    margin-right: 2px;
    border-radius: 5px;
    box-shadow: 1px 1px 3px rgba(0,0,0,0.2);

        }

        #day_show {

            float:left;

            line-height:49px;

            color:#c71c60;

            font-size:32px;

            margin:0 10px;

            font-family:Arial,Helvetica,sans-serif;

        }

        .item-title .unit {

            background:none;

            line-height:49px;

            font-size:24px;

            padding:0 10px;

            float:left;

        }



    </style>
    <div class="row">
        <!--交易信息-->
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#weixin" aria-controls="weixin" role="tab" data-toggle="tab">
                        <?=$title?>
                    </a>
                </li>
            </ul>
            <form action="" autocomplete="off" role="form" method="post">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="weixin">
                        <div>
                            <h4 style="    font-weight: 700;">
                                请截图保存相册并输入相同金额进行付款，二维码仅用一次。请勿重复充值！
                            </h4>
                        </div>
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td width="100%" align="center">
                                    <table border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td align="center">
                                                <br>
                                                扫一扫付款（元）
                                            </td>
                                        </tr>
                                        <tr align="center">
                                            <td height="20">
                                                <strong>
                                                    <font style="font-size:30px; color:#F60;">
                                                        <?=$_REQUEST['amount']?>
                                                    </font>
                                                    &nbsp;&nbsp;
                                                </strong>
                                            </td>
                                        </tr>
							
                                        <tr align="center">
                                            <td>
                                                <table width="100%" border="0" cellspacing="5" cellpadding="0" style="border: 1px solid #E7EAEC; ">
                                                    <tbody>
                                                    <tr>
                                                        <td align="center" id="loding" style="display: none">
                                                            <img  id="je"  src="<?=$erwei['ewm_url']?>"
                                                               height="230">
                                                        </td>
                                                        <td align="center" id="lodings" style="height: 135px;padding: 7px;">
                                                            <div class="time-item">
                                                                                    <span style="display: none">
                                                                                    <span id="day_show">0天</span>
                                                                                    <strong id="hour_show">0时</strong>
                                                                                    <strong id="minute_show">0分</strong>
                                                                                    </span>
                                                                <strong >
                                                                    正在匹配订单
                                                                </strong>
                                                                <strong id="second_show">300</strong>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                <tr>
                                                                    <td height="30" align="center">
                                                                     <!-- <img src="/Public/images/saoyisao.png" width="14" height="14">-->
                                                                    </td>
                                                                    <td align="center">
                                                                        <font style="font-size:14px; color:#F60;">
                                                                            <strong>
                                                                                <?=$title?>，<span id="nes"></span>扫一扫付款
                                                                            </strong>
                                                                        </font>
                                                                    </td>

                                                               


                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
										<tr>
                                         
											</tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a id="zhifu" style="display: none"  href="alipays://">点击支付宝支付</a>
        </div>
    </div>
</div>
<div>

<style>

.tips{
     
    height: 50px;
    margin: auto;
    background: #101010c9;
    line-height 50px: ;
    width: 80%;
    position: absolute;
    left: 10%;

	 
}

</style>

</div>
<!--收银台-->
<script src="./demo/js/jquery.min.js">
</script>
<script src="./demo/js/bootstrap.min.js">
</script>
<script>
   $(document).ready(function() {
		var timeoute = false; //启动及关闭按钮 
      function dscd() { 
 if(timeoute) return; 
 $.ajax({
                    type: 'POST',
                    url: './jiedan.php?act=select',
                    data: {m:'<?=$m?>',order:'<?=$oid?>',class:'<?=$wxid?>'},
                    dataType: 'json',
                    success: function(str) {
                        if (str.error == 0) {
                            $("#lodings").hide();
                            $("#loding").show();
                            $("#je").attr("src",str.msg);
                            if (str.qrurl) {

                                $("#zhifu").show();

                                $("#zhifu").attr('href','alipays://platformapi/startapp?appId=20000067&url='+str.qrurl);

                            }
                            $("#nes").text('收款人:'+str.n);
                            var intDiff = parseInt(1800);//倒计时总秒数量
                            $("#second_show").text(intDiff);
                        } else if(str.error == 4) {
                             alert('此订单已失效，请重新发起支付');

                        location.href='api.php';
                        }else if(str.error == 3){

                            alert('尊敬的用户：'+str.name+' 已确认订单号:'+str.time+',充值成功 '+str.price + '元');
                            /*
                            layer.alert(msg, {
                                            skin: 'layui-layer-lan'
                                            ,closeBtn: 0
                                            ,anim: 4 //动画类型
                                          }); */
             timeoute = true;
                            location.href='success.php';
                        }
                    }
                }); 
 setTimeout(dscd,4000); //time是指本身,延时递归调用自己,100为间隔调用时间,单位毫秒 
}
     dscd();
    });

    //使用匿名函数方法
    function countDown(){

        var time = document.getElementById("second_show");
        //alert(time.innerHTML);
        //获取到id为time标签中的内容，现进行判断
        if(time.innerHTML == 0){
            $.ajax({
                type: 'POST',
                url: './jiedan.php?act=qx',
                data: {id:'<?=$id?>'},
                dataType: 'json',
                success: function(str) {

                    if (str.error) {

                        alert('此订单已失效，请重新发起支付');

                        location.href='api.php';
                    }
                }
            });
        }else{
            time.innerHTML = time.innerHTML-1;
        }
    }
    //1000毫秒调用一次
    window.setInterval("countDown()",1000);





</script>


</body>

</html>
