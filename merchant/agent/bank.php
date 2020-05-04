<?php 

define('ACC',true);

include('../sys/init.php');
if ($_SESSION['agent_id'] == '') {
	header("location: index.php");
}

if (isset($_POST['sub'])) {
	$agent_info = $mysql->select('ysk_agent','*','id='.$_SESSION['agent_id']);
	$pwd = $_REQUEST['pwd'];
	if (md5($pwd)  != $agent_info['pwd']) {
        jump('-1','登录密码不正确');
	}
    
    unset($_POST['sub']);
    unset($_POST['pwd']);

	$mysql->update('ysk_agent',$_POST,'id='.$agent_info['id']);
	jump('-1','保存成功');
}
$agent_info = $mysql->select('ysk_agent','*','id='.$_SESSION['agent_id']);
include('./tpl/bank.html');


?>