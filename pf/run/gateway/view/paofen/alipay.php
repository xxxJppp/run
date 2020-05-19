<?php
use xh\library\url;
$content_type = 'json';
//商户ID->到平台首页自行复制粘贴
$account_id = $data['pankou_id'];
//S_KEY->商户KEY，到平台首页自行复制粘贴，该参数无需上传，用来做签名验证和回调验证，请勿泄露
//$s_key = 'B83205253588C1';
//订单号码->这个是四方网站发起订单时带的订单信息，一般为用户名，交易号，等字段信息
$out_trade_no = $data['out_trade_no'];
//支付通道：支付宝（公开版）：alipay_auto、微信（公开版）：wechat_auto、服务版（免登陆/免APP）：service_auto
$type = intval($data['type'])?intval($data['type']):1;
//通道
$thoroughfare = 'paofen_auto';


//支付金额
$amount = floatval($data['amount']);
//生成签名
$sign = $data['sign'];
    //sign($s_key, ['amount'=>$amount,'out_trade_no'=>$out_trade_no]);
//轮训状态，是否开启轮训，状态 1 为关闭   2为开启
$robin = 2;
$use_city = 2;
//微信设备KEY，新增加一条支付通道，会自动生成一个device Key，可在平台的公开版下看见，如果为轮训状态无需附带此参数，如果$robin参数为1的话，就必须附带设备KEY，进行单通道支付
$device_key = '';
//异步通知接口url->用作于接收成功支付后回调请求
$callback_url = $data['callback_url'];
//支付成功后自动跳转url
$success_url = $data['success_url'];
//支付失败或者超时后跳转url
$error_url = $data['error_url'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title>
        收银台
    </title>
    <link rel="stylesheet" href="/Public/theme/view4/css/bootstrap.min.css">
</head>
<style>
    li {
        list-style: none;
    }

    .iap_new img {
        margin-left: 8px;
        float: right;
        margin-top: 1px;
    }

    .list-inline > li {
        margin: 5px;
        padding: 5px;
        width: 300px;
        position: relative;
        font-size: 1.2em;
    }

    h1 {
        font-family: "微软雅黑";
        font-size: 40px;
        margin: 20px 0;
        border-bottom: solid 1px #ccc;
        padding-bottom: 20px;
        letter-spacing: 2px;
    }

    .immediate_pay {
        display: block;
        width: 165px;
        height: 54px;
        line-height: 54px;
        background: #1a8ae1;
        border: none;
        font-size: 18px;
        color: #fff;
        cursor: pointer;
        margin: 2rem auto;
        text-align: center;
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
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);

    }

    #day_show {
        float: left;
        line-height: 49px;
        color: #c71c60;
        font-size: 32px;
        margin: 0 10px;
        font-family: Arial, Helvetica, sans-serif;
    }

    #div {
        width: 100%;
        display: block;
        text-align: center;
    }
</style>
<script src="/Public/theme/view4/ui/layer.js"></script>
<script src="/Public/theme/view4/ui/layui/layui.all.js" charset="utf-8"></script>
<body style="background-color: #ecedf2;">
<div class="container" style="background-color:#fff;padding:15px; margin-top: 15px;">
    <div class="row">
        <!--交易信息-->
        <div class="col-md-12">
            <ul class="list-inline">
                <li>
                    <strong>
                        订单金额：
                        <span class="text-danger" id="amot">
                                    <?php echo $amount; ?>
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
                    <?php echo $out_trade_no; ?>
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
                    <?php echo date('Y-m-d H:i:s') ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <!--交易信息-->
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#weixin" aria-controls="weixin" role="tab" data-toggle="tab">
                        支付宝支付
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="weixin">
                    <div>
                        <h4 style="    font-weight: 700;">
                            请按照本页面金额付款，请勿自行修改支付金额，否则无法到账。此二维码仅限本次支付使用，请勿重复支付使用。本次定胆有效期为5分钟，过期请勿支付
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
                                                <font style="font-size:30px; color:#F60;" id="amt">
                                                    <?php echo $amount; ?>
                                                </font>
                                                &nbsp;&nbsp;
                                            </strong>
                                        </td>
                                    </tr>

                                    <tr align="center">
                                        <td>
                                            <table width="100%" border="0" cellspacing="5" cellpadding="0"
                                                   style="border: 1px solid #E7EAEC; ">
                                                <tbody>
                                                <tr>
                                                    <td align="center" id="loding" style="display: none">
                                                        <img style="width: 300px" id="je" src="" height="230">
                                                    </td>
                                                    <td align="center" id="lodings"
                                                        style="height: 135px;padding: 7px;">
                                                        <div class="time-item">
                                                            <strong>
                                                                正在匹配订单
                                                            </strong>
                                                            <strong id="second_show">300</strong>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table width="100%" border="0" cellspacing="0"
                                                               cellpadding="0">
                                                            <tbody>
                                                            <tr>
                                                                <td height="30" align="center">
                                                                    <!-- <img src="/Public/images/saoyisao.png" width="14" height="14">-->
                                                                </td>
                                                                <td align="center">
                                                                    <font style="font-size:14px; color:#F60;">
                                                                        <strong>
                                                                            支付宝支付，<span id="nes"></span>扫一扫付款
                                                                        </strong>
                                                                    </font>
                                                                </td>
                                                                <strong id="div" style="margin-left:30%;display: none;">
                                                                   <span class="time minutes" style="float: left">
                                                                            <b></b>
                                                                            <span>分</span>
                                                                        </span>
                                                                    <span class="time seconds" style="float: left">
                                                                            <b></b>
                                                                            <span>秒</span>
                                                                        </span>

                                                                </strong>

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

            <button id="zhifu" style="display: none" class="immediate_pay">点击支付宝支付</button>
            <input type="hidden" id="nyr" value="">
            <input type="hidden" id="sign" value="<?php echo $sign;?>">
            <input type="hidden" id="time" value="">
            <input type="hidden" id="orderid" value="<?php echo $data['id']?>">
        </div>
    </div>
</div>
<div>
</div>
<!--收银台-->
<script src="/Public/theme/view4/js/jquery.min.js">
</script>
<script src="/Public/theme/view4/js/bootstrap.min.js">
</script>
<script>
    $("#zhifu").click(function () {
        var url = $(this).data('url');
        if(url){
            window.location.href = url;
        }
    });
    //使用匿名函数方法
    function countDown() {
        var time = document.getElementById("second_show");
        var id = $("#orderid").val();
        if (time.innerHTML == 0) {
            $.get("http://pf.zhiyungk.com/gateway/index/automaticpaofenDel?id="+id, function(result){
                //成功
                if(result.code == '200'){
                    //回调页面
                    layer.msg(result.msg, {
                        icon: 1,
                        time:1500,
                        end:function(){
                            location.href="<?php echo $success_url;?>";
                        }});
                }

            });
        } else {
            time.innerHTML = time.innerHTML - 1;
        }
    }
    //1000毫秒调用一次
    window.setInterval("countDown()", 1000);
    function timi() {

        var id = $("#orderid").val();
        var timer, minutes, seconds, ci, qi,time=$("#time").val()+300;
        timer = parseInt(300) - 1;
        if(timer>0){
            ci = setInterval(function () {
                minutes = parseInt(timer / 60, 10)
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                $(".minutes b").text(minutes);
                $(".seconds b").text(seconds);
                if (--timer < 0) {
                    $(".qrcode .expired").removeClass("hidden");
                    $(".minutes b").text('00');
                    $(".seconds b").text('00');
                    $(".help").html('订单已过期,请重新提交');
                    daoqi(id);
                    clearInterval(ci);

                }
            }, 1000);
        }
    }
    function daoqi(id){

        layer.confirm("订单已过期,请重新提交", {
            icon: 2,
            title: '支付失败',
            btn: ['确认'] //按钮
        }, function(){
            $.get("http://pf.zhiyungk.com/gateway/index/automaticpaofenTimeout?id="+id, function(result){
                //成功
                if(result.code == '200'){
                    location.href="<?php echo $error_url;?>";
                }

            });

        });
        setTimeout(function(){
            $.get("http://pf.zhiyungk.com/gateway/index/automaticpaofenTimeout?id="+id, function(result){
                //成功
                if(result.code == '200'){
                    location.href="<?php echo $error_url;?>";
                }

            });
            //location.href="<?php echo $error_url;?>";
        },5000);

    }

    function updateorder(){
        $.ajax({
            type: 'POST',
            url: 'http://pf.zhiyungk.com/gateway/index/addorder.do',
            data: {
                account_id: '<?= $account_id;?>',
                content_type: '<?= $content_type;?>',
                thoroughfare: '<?= $thoroughfare?>',
                out_trade_no: '<?= $out_trade_no;?>',
                sign:$('#sign').val(),
                robin: '<?php echo $robin;?>',
                use_city: '<?php echo $use_city;?>',
                callback_url: '<?php echo $callback_url?>',
                success_url: '<?php echo $success_url;?>',
                error_url:'<?php echo $error_url;?>',
                amount: '<?php echo $amount?>',
                type: '<?php echo $type;?>',
                device_key:'<?php echo $device_key;?>',},
            dataType: 'json',
            success: function (n) {
                if(n.code==200){
                    $("#lodings").hide();
                    $("#loding").show();
                    $("#je").attr("src", n.data.qrcode);
                    //$("#nyr").val(str.pipeitime);
                    if (n.data.qrurl) {
                        $("#zhifu").show();
                        $("#zhifu").attr('data-url', 'alipays://platformapi/startapp?appId=20000067&url=' + n.data.qrurl);
                    }
                    $("#nes").text('收款人:' + n.data.n);
                    var intDiff = parseInt(1800);//倒计时总秒数量
                    $("#second_show").text(intDiff);
                    $("#time").val(n.data.time);
                    $("#div").show();
                    timi();
                    clearInterval(dscd_time);

                }
            }
        });
    }
    var dscd_time = setInterval(updateorder, 4000);
</script>
<script>

    function order(){
        var id = $("#orderid").val();
        if(id!=''){
            $.get("http://pf.zhiyungk.com/gateway/pay/automaticpaofenQuery?id="+id, function(result){

                //成功
                if(result.code == '200'){
                    //回调页面
                    window.clearInterval(orderlst);
                    layer.confirm(result.msg, {
                        icon: 1,
                        title: '支付成功',
                        btn: ['我知道了'] //按钮
                    }, function(){
                        location.href="<?php echo $success_url;?>";
                    });
                    setTimeout(function(){location.href="<?php echo $success_url;?>";},5000);
                }

            });
        }
    }
    //周期监听
    var orderlst = setInterval("order()",1000);
</script>
</body>
</html>