<?php
/******************/
/*	异步通知文件	*/
/*	版本：V1.0	*/
/*  By:CO聚合支付	*/
/******************/

//require_once 'config/config.php';
header('Access-Control-Allow-Origin:*');
$shid = '222';
$key = 'BE47DWAC05N16Y84YR58L88GP2FMJAGF';
$back_url = 'http://agent.com/notify_true.php';///回调地址
$m = @$_POST['m'];
$order = @$_POST['order'];
$md5key = @$_POST['md5key'];
$status = @$_POST['status'];
$keymd5 = md5(md5($order . $m . $shid) . $key);
//$yzsign=md5('status='.$status.'&shid='.$shid.'&bb='.$bb.'&zftd='.$zftd.'&ddh='.$ddh.'&je='.$je.'&ddmc='.$ddmc.'&ddbz='.$ddbz.'&ybtz='.$ybtz.'&tbtz='.$tbtz.'&'.$userkey);

if ($keymd5 == $md5key) {            //验证数据签名
    if ($status = 3) {    //验证成功
        $arr['error'] = 3;

        $arr['price'] = $m;
        $arr['back_url'] = $back_url;

        $arr['time'] = $order;
        echo json_encode($arr);
        exit;
    } else {
        $arr['error'] = 0;
        $arr['price'] = $m;
        $arr['time'] = $order;
        echo json_encode($arr);
        exit;            //支付状态fail失败
    }
} else {                        //验证失败
    echo $keymd5 . 'Sign' . $md5key . 'm=' . $m . 'order=' . $order;
}
?>
