<?php
include "./phpqrcode/qrlib.php";
	
$url = 'alipays://platformapi/startapp?appId=20000123&actionType=scan&biz_data={"s": "money","u": "'.$_GET['pid'].'","a": "'.$_GET['amount'].'","m": "'.$_GET['trade_no'].'"}';


QRcode::png($url,false,QR_ECLEVEL_L,5,2,true);