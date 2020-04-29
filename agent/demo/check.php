<?php
	/******************/
	/*	参数提交文件	*/
	/*	版本：V1.0	*/
	/*  By:CO聚合支付	*/
	/******************/
	
	require_once 'config/config.php';
	
	$shid=$userid;//商户ID
	$ddh=$_POST['ddh'];//订单号
	$sign=md5('shid='.$userid.'&ddh='.$ddh.'&'.$userkey);//MD5加密串

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>提交中</title>
</head>
<body onLoad="document.check.submit()">
    <form name="check" action="<?php echo $checkurl?>" method="post">
        <input type="hidden" name="shid" value="<?php echo $shid?>">
        <input type="hidden" name="ddh" value="<?php echo $ddh?>">
        <input type="hidden" name="sign" value="<?php echo $sign?>">
    </form>
</body>
</html>
