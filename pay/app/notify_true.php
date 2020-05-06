<?php
/******************/
/*	异步通知文件	*/
/*	版本：V1.0	*/
/*  By:CO聚合支付	*/
/******************/

//require_once 'config/config.php';
define('ACC', TRUE);
include('../sys/init.php');
header('Access-Control-Allow-Origin:*');
$shid = '222';
$key = 'BE47DWAC05N16Y84YR58L88GP2FMJAGF';
$back_url = 'http://pay.com/notify_true.php';///回调地址

$data = array();
$data['order'] = @$_POST['order'];
$data['m'] = @$_POST['m'];
$data['sh'] = $shid;
$data['key'] = $key;
$keymd5 = getSignature($data);
$status = @$_POST['status'];
//$yzsign=md5('status='.$status.'&shid='.$shid.'&bb='.$bb.'&zftd='.$zftd.'&ddh='.$ddh.'&je='.$je.'&ddmc='.$ddmc.'&ddbz='.$ddbz.'&ybtz='.$ybtz.'&tbtz='.$tbtz.'&'.$userkey);
if ($keymd5 == @$_POST['md5key']) {
    if ($status = 3) {    //验证成功
        $arr['error'] = 3;

        $arr['price'] = $data['m'];
        $arr['back_url'] = $back_url;

        $arr['time'] = $data['order'];
        echo json_encode($arr);
        exit;
    } else {
        $arr['error'] = 0;
        $arr['price'] = $data['m'];
        $arr['time'] = $data['order'];
        echo json_encode($arr);
        exit;            //支付状态fail失败
    }
} else {                        //验证失败
    echo $keymd5 . 'Sign' . $md5key . 'm=' . $m . 'order=' . $data['order'];
}

