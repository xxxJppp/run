<?php 

defined('ACC')||exit('ACC Denied');
/*
if ($_SESSION['token']!== $_POST['token']) {
	$data['error'] = 1;
	$data['msg'] = '您当前网络情况较差，请稍候再试。';
    ajax_text($data);	
} else {

	unset($_SESSION['token']);
}*/



if ($_POST['n'] != '' || $_POST['p']!='') {
    $n = trim($_POST['n']);
    $p = trim($_POST['p']);
    if (strlen($n) < 11 || strlen($n) > 11) {
       $data['error'] = 1;
	     $data['msg'] = '您输入的用户名格式不正确';
       ajax_text($data);	 
    }
    if ($n == '') {
       $data['error'] = 1;
	   $data['msg'] = '用户名不能为空';
       ajax_text($data);	 
    }
    if (strlen($p) < 6 ) {
       $data['error'] = 1;
	   $data['msg'] = '您的账号或者密码不正确';
       ajax_text($data);	 
    }
  $info = $mysql->select('fafa_member','*','name='."'$n'");
	$token = $_SESSION['token'] =
	md5(substr('abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
	rand(0,2),rand(2,10)));
    if (empty($info)) {

       $data['error'] = 1;
	     $data['msg'] = '您的账号或者密码不正确1';
	     $data['t'] = $token;
       ajax_text($data);
    }

    if ($info['pwd'] === md5(md5($p))) {
        $rand = md5(rand(0000,9999));
        $coo = md5($n.$rand.$info['pwd']);
        if (isset($_POST['open'])  && $_POST['open'] == 'on') {
	    	    setcookie("n",$coo, time() + 3600 * 24 * 365 );  
	      }

	    $up['cookie'] = $coo;

	    $up['last_time'] = time();

	    $up['login_ip'] = get_client_ip();

	    $up['shebei'] = getClientMobileBrand();

	    $mysql->update('fafa_member',$up,'id='.$info['id']);

    	$sql = "update fafa_member set login_num = login_num+1 where id=".$info['id'];

    	$mysql->query($sql);

    	$_SESSION['h_name'] = $n;

		  $_SESSION['h_id'] = $info['id'];

      $data['error'] = 0;

      ajax_text($data);

    } else {
       $data['error'] = 1;
	     $data['msg'] = '您的账号或者密码不正确2';
	     $data['t'] = $token;
       ajax_text($data);
    }


   
 
} else {

	exit('ACC Denied');
}


?>