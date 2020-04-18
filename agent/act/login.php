<?php 


$token = $_SESSION['token'] =
md5(substr('abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
rand(0,2),rand(2,10)));

if (isset($_COOKIE['n'])  && $_COOKIE['n']!='') {
	
	$n = $_COOKIE['n'];

	$info = $mysql->select('fafa_member','*','cookie='."'$n'");

	if (!empty($info)) {
		$_SESSION['h_name'] = $info['name'];

        $_SESSION['h_id'] = $info['id'];

        header("location: index.dos");
	}


}
?>