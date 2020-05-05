<?php

define('ACC', TRUE);

include('../sys/init.php');


if ($_POST['shid'] == '') {

    jump('-1', '商户账号不能为空');
}

if ($_POST['key'] == '') {

    jump('-1', '商户秘钥不能为空');
}
if ($_POST['orderid'] == '') {

    jump('-1', '订单号不能为空');
}


$nas = $_POST['shid'];
$info = $mysql->select('ysk_merchant', '*', 'names=' . "'$nas'");

if (empty($info)) {

    jump('-1', '效验失败商户账号不正确');

} else {

    if ($info['key'] != $_POST['key']) {
        jump('-1', '效验失败商户秘钥不正确');
    }
}

$type = $_POST['pay'];

$ip = $_SERVER['REMOTE_ADDR'];

$mysql->delete('ysk_roborder', 'status = 1 and ip=' . "'$ip'");


if ($type == 'wx') {

    $img = './demo/images/logo-wxpay.png';

    $title = '微信支付';

    $wxid = 1;
    $class = "logo wechat";
} else if ($type == 'zfb') {

    $img = './demo/images/logo-wxpay.png';

    $title = '支付宝支付';

    $wxid = 2;

    $class = "logo alipay";


} else if ($type == 'yl') {

    $img = './demo/images/logo-wxpay.png';

    $title = '银联支付';
    $wxid = 3;
} else {

    $img = './demo/images/logo-wxpay.png';

    $title = '支付宝支付';

    $class = "logo alipay";

    $wxid = 2;
}

if ($_POST['amount'] <= 0) {
    jump('api.php', '充值金额不能为0');
} else {

    $money = $_POST['amount'];
}

$sn = $_POST['orderid'] == '' ? 'E' . time() . rand(0000, 9999) : $_POST['orderid'];

if ($sn == '') {

    jump('api.php', '订单异常，请重新发起');
}

$iii = $mysql->select('ysk_roborder', '*', 'ordernum=' . "'$sn'");

if (empty($iii)) {
    $p['class'] = $wxid;
    $p['price'] = $money;
    $p['addtime'] = time();
    $p['status'] = 1;
    $p['shanghu_name'] = $nas;
    $p['ordernum'] = $_POST['orderid'];
    $p['ip'] = $_SERVER['REMOTE_ADDR'];
    //$url = "http://ip-api.com/json/".$_SERVER['REMOTE_ADDR']."?lang=zh-CN";
    //$ip = '114.219.30.42';
    $url = "http://ip.ws.126.net/ipquery?ip=" . $_SERVER['REMOTE_ADDR'];
    $json = file_get_contents($url);
    $json = iconv('gb2312', "utf-8//IGNORE", $json);
    $arr = explode('=', $json);
    $arr[3] = rtrim(trim($arr[3]));
    $arr[3] = str_replace("city", '"city"', $arr[3]);
    $arr[3] = str_replace("province", '"province"', $arr[3]);
    $array = json_decode($arr[3], true);
    $p['city'] = str_replace("市", "", $array['city']);
    $p['province'] = str_replace("省", "", $array['province']);
    $aa = $mysql->insert('ysk_roborder', $p);
}


$id = mysqli_insert_id();


$m = $_POST['amount'];
$oid = $_POST['orderid'];
require_once SYS.'/../tpl/apis.html';