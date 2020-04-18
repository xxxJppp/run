<?php 




if ($_POST['m'] > $us_info['money']) {
	$data['error'] = 1;
	$data['msg'] = '您申请的金额不能大于您账户可提现金额';
    ajax_text($data);	
}
if ( md5(md5($_POST['p']))!= $us_info['pwd']) {
	$data['error'] = 1;
	$data['msg'] = '您输入的登陆密码不正确';
    ajax_text($data);	
}

if ($_POST['code']!=$_SESSION['helloweba_math']) {
	$data['error'] = 1;
	$data['msg'] = '您输入验证码不正确';
    ajax_text($data);	
}

$m = $_POST['m'];

$sql = 'update fafa_member set money = money - $m where id = '.$us_info['id'];

$mysql->query($sql);

$log['uid'] = $us_info['id'];
$log['name'] = $us_info['name'];
$log['addtime'] = time();
$log['money'] = $m;
$log['zt'] = 0;
$log['type'] = '申请提现';

$mysql->insert('fafa_mx',$log);

$data['error'] = 0;
ajax_text($data);	

?>