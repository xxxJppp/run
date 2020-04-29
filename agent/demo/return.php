<?php
	/******************/
	/*	同步跳转文件	*/
	/*	版本：V1.0	*/
	/*  By:CO聚合支付	*/
	/******************/

	require_once 'config/config.php';

	$status=@$_GET['status'];
	$shid=@$_GET['shid'];
	$bb=@$_GET['bb'];
	$zftd=@$_GET['zftd'];
	$ddh=@$_GET['ddh'];
	$ddmc=@$_GET['ddmc'];
	$ddbz=@$_GET['ddbz'];
	$ybtz=@$_GET['ybtz'];
	$tbtz=@$_GET['tbtz'];
	$je=@$_GET['je'];
	$sign=@$_GET['sign'];
	
	$yzsign=md5('status='.$status.'&shid='.$shid.'&bb='.$bb.'&zftd='.$zftd.'&ddh='.$ddh.'&je='.$je.'&ddmc='.$ddmc.'&ddbz='.$ddbz.'&ybtz='.$ybtz.'&tbtz='.$tbtz.'&'.$userkey);

	if($sign==$yzsign){			//验证数据签名
		if($status=='success'){	//验证成功
			echo '付款成功';		//支付状态成功
		}else{
			echo 'fail';			//支付状态失败
		}
	}else{						//验证失败
		echo 'Sign校验失败';
	}
?>
