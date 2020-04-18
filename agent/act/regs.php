<?php 

defined('ACC')||exit('ACC Denied');



if ($_POST['n'] != '' || $_POST['p']!='') {
    $n = trim($_POST['n']);
    $p = trim($_POST['p']);
    $rp = trim($_POST['rp']);
    $code = trim($_POST['code']);
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
	   $data['msg'] = '密码长度必须大于6位';
       ajax_text($data);	 
    }
    if ($p !=$rp ) {
       $data['error'] = 1;
	   $data['msg'] = '两次密码不一致';
       ajax_text($data);	 
    }
  $info = $mysql->select('fafa_member','*','id='.$code);
	$token = $_SESSION['token'] =
	md5(substr('abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
	rand(0,2),rand(2,10)));
    if (empty($info)) {
         $data['error'] = 1;
	       $data['msg'] = '';
	       $data['t'] = $token;
         //ajax_text($data);
    }

    $infos = $mysql->select('fafa_member','*','name='."'$n'");
    if (!empty($infos)) {
         $data['error'] = 1;
	     $data['msg'] = '您输入的手机号已经被注册';
	     $data['t'] = $token;
         ajax_text($data);
    }


    $rand = md5(rand(0000,9999));
    $coo = md5($n.$rand.$info['pwd']);
    if (isset($_POST['open'])  && $_POST['open'] == 'on') {
	   setcookie("n",$coo, time() + 3600 * 24 * 365 );  
	}

	$up['cookie'] = $coo;

	$up['last_time'] = time();

	$up['login_ip'] = get_client_ip();

	$up['shebei'] = getClientMobileBrand();

	$up['name'] = $n;

	$up['pid'] = $code ;

	$up['addtime'] = time() ;

	$up['pwd'] = md5(md5($_POST['p']));

	$mysql->insert('fafa_member',$up);

    $_SESSION['h_name'] = $n;

	$_SESSION['h_id'] = $info['id'];

    $data['error'] = 0;

    ajax_text($data);

}

?>