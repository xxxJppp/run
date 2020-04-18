<?php 



if ($_POST['n'] == '') {
     $data['error'] = 1;
	 $data['msg'] = '支付宝名字不能为空';
     ajax_text($data);	 
}

if ($_POST['z'] == '') {
     $data['error'] = 1;
	 $data['msg'] = '支付宝账号不能为空';
     ajax_text($data);	 
}


$data['zname'] = $_POST['n'];
$data['znum'] = $_POST['z'];

$mysql->update('fafa_member',$data,'id='.$us_info['id']);

$data['error'] = 0;

ajax_text($data);
?>