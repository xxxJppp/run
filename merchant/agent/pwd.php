<?php 

define('ACC',true);

include('../sys/init.php');
if ($_SESSION['agent_id'] == '') {
	header("location: index.php");
}

if (isset($_POST['sub'])) {
	$agent_info = $mysql->select('ysk_merchant','*','id='.$_SESSION['agent_id']);
	$pwd = $_REQUEST['p'];
	if (md5($pwd)  != $agent_info['pwd']) {
        jump('-1','旧密码不正确');
	}

	if ($_REQUEST['ne'] != $_REQUEST['rne']) {
        jump('-1','两次密码不一致');
	}
	$datas['pwd'] = md5($_REQUEST['ne']);
	$mysql->update('ysk_merchant',$datas,'id='.$agent_info['id']);
	jump('-1','密码修改成功');
}

include('./tpl/pwd.html');


?>