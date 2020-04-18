<?php
	/******************/
	/*	异步通知文件	*/
	/*	版本：V1.0	*/
	/*  By:CO聚合支付	*/
	/******************/
	
	require_once 'config/config.php';
	
	$status=@$_POST['status'];
	$shid=@$_POST['shid'];
	$bb=@$_POST['bb'];
	$zftd=@$_POST['zftd'];
	$ddh=@$_POST['ddh'];
	$ddmc=@$_POST['ddmc'];
	$ddbz=@$_POST['ddbz'];
	$ybtz=@$_POST['ybtz'];
	$tbtz=@$_POST['tbtz'];
	$je=@$_POST['je'];
	$sign=@$_POST['sign'];
	$yzsign=md5('status='.$status.'&shid='.$shid.'&bb='.$bb.'&zftd='.$zftd.'&ddh='.$ddh.'&je='.$je.'&ddmc='.$ddmc.'&ddbz='.$ddbz.'&ybtz='.$ybtz.'&tbtz='.$tbtz.'&'.$userkey);

	if($sign==$yzsign){			//验证数据签名
		if($status=='success'){	//验证成功
			echo 'success';		//支付状态success成功
		}else{
			echo 'fail';	  		//支付状态fail失败
		}
	}else{						//验证失败
		echo 'Sign校验失败';		
	}
?>
