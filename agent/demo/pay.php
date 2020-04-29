<?php
	/******************/
	/*	参数提交文件	*/
	/*	版本：V1.0	*/
	/*  By:CO聚合支付	*/
	/******************/
	
	require_once 'config/config.php';
	
	$bb=$_POST['bb'];//版本
	$shid=$userid;//商户ID
	$ddh=$_POST['ddh'];//订单号
	$je=number_format($_POST['je'],2,'.','');//金额(必须保留两位小数点，否则验签失败)
	$zftd=$_POST['zftd'];//支付通道
	$ybtz=$notify;//异步通知地址
	$tbtz=$return;//同步通知地址
	$ddmc=$_POST['ddmc'];//订单名称
	$ddbz=$_POST['ddbz'];//订单备注
	$sign=md5('shid='.$userid.'&bb='.$bb.'&zftd='.$zftd.'&ddh='.$ddh.'&je='.$je.'&ddmc='.$ddmc.'&ddbz='.$ddbz.'&ybtz='.$ybtz.'&tbtz='.$tbtz.'&'.$userkey);//MD5加密串

?>
<!Doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>提交中</title>
</head>
<body onLoad="document.pay.submit()">
    <form name="pay" action="<?php echo $apiurl?>" method="post">
        <input type="hidden" name="bb" value="<?php echo $bb?>">
        <input type="hidden" name="shid" value="<?php echo $shid?>">
        <input type="hidden" name="ddh" value="<?php echo $ddh?>">
        <input type="hidden" name="je" value="<?php echo $je?>">
        <input type="hidden" name="zftd" value="<?php echo $zftd?>">
        <input type="hidden" name="ybtz" value="<?php echo $ybtz?>">
        <input type="hidden" name="tbtz" value="<?php echo $tbtz?>">
        <input type="hidden" name="ddmc" value="<?php echo $ddmc?>">
        <input type="hidden" name="ddbz" value="<?php echo $ddbz?>">
        <input type="hidden" name="sign" value="<?php echo $sign?>">
    </form>
</body>
</html>
