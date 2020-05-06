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

function getSignature($params, $secret='GoCkn^*poqLyhp5hY(4<|qBR6.55[X$g'){
    $str = '';  //待签名字符串
    //先将参数以其参数名的字典序升序进行排序
    ksort($params);
    //遍历排序后的参数数组中的每一个key/value对
    foreach ($params as $k => $v) {
        //为key/value对生成一个key=value格式的字符串，并拼接到待签名字符串后面
        $str .= "$k=$v";
    }
    //将签名密钥拼接到签名字符串最后面
    $str .= $secret;
    //通过md5算法为签名字符串生成一个md5签名，该签名就是我们要追加的sign参数值
    return md5($str);
}
