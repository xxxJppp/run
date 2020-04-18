<?php
    
            if(stripos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false ) {
	if(stripos($_SERVER['HTTP_USER_AGENT'], 'android')) {
	/*	header("Content-type:text/plain;charset=UTF-8");
		header("Accept-Ranges:bytes 0-1/1");
		header("Content-Range:");
		header("Content-Disposition:attachment;filename=" . time() . ".apk");
		header("status:206");*/
		//header("Location:./apk.html");
			include('apk.html');
	} else {
		
		include('ios.html');
	}
} else {
	header("Location:./xz.html");
}
?>