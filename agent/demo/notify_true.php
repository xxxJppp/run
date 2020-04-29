<?php
	/******************/
	/*	异步通知文件	*/
	/*	版本：V1.0	*/
	/*  By:CO聚合支付	*/
	/******************/
	
	//require_once 'config/config.php';
	header('Access-Control-Allow-Origin:*');
	$shid="shh001";
	$key="PSK3A8AHLP6CP3ES1X63MJN1JQR8R9OF";
	$m=@$_POST['m'];
	$order=@$_POST['order'];
	$md5key=@$_POST['md5key'];
	$status=@$_POST['status'];
	 $keymd5= md5(md5($order.$m.$shid).$key);
	//$yzsign=md5('status='.$status.'&shid='.$shid.'&bb='.$bb.'&zftd='.$zftd.'&ddh='.$ddh.'&je='.$je.'&ddmc='.$ddmc.'&ddbz='.$ddbz.'&ybtz='.$ybtz.'&tbtz='.$tbtz.'&'.$userkey);

	if($keymd5==$md5key){			//验证数据签名
		if($status=3){	//验证成功
		$arr['error'] = 3; 

          	  $arr['price'] = $m;  

          	  $arr['time'] = $order ;
		 echo	json_encode($arr); exit;
		}else{
			$arr['error'] = 0; 

          	  $arr['price'] = $m;  

          	  $arr['time'] = $order ;
		 echo	json_encode($arr); exit;	  		//支付状态fail失败
		}
	}else{						//验证失败
		echo $keymd5.'Sign'.$md5key.'m='.$m.'order='.$order;		
	}
?>
