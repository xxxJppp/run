<?php 

define('ACC',true);

include('../sys/init.php');
if ($_SESSION['agent_id'] == '') {
	header("location: index.php");
}

if (isset($_POST['sub'])) {
	$agent_info = $mysql->select('ysk_merchant','*','id='.$_SESSION['agent_id']);
	$pwd = $_REQUEST['pwd'];
	$money = $_REQUEST['money'];
	if ($money <= 0 ) {
		jump('-1','提现金额不能为0或小于0');
	}
	if (md5($pwd)  != $agent_info['pwd']) {
        jump('-1','登录密码不正确');
	}
    
    unset($_POST['sub']);
    unset($_POST['pwd']);

    if ($agent_info['money'] < $money) {
    	jump('-1','提现金额不能大于可提现金额：'.$agent_info['money'].'元');
    }
    $data['shanghu_id'] = $agent_info['id'];
    $data['shanghu_name'] = $agent_info['names'];
    $data['shanghu_kahao'] = $agent_info['acc'];
    $data['shanghu_huming'] = $agent_info['name'];
    $data['shanghu_yinhang'] = $agent_info['bankname'];
    $data['shanghu_xinxi'] = $agent_info['bankinfo'];
    $data['money'] = $money;
    $data['addtime'] = time();
    
    $sql = "update  ysk_merchant set money = money-'$money' where id=".$_SESSION['agent_id'];

    $mysql->query($sql);

	$mysql->insert('ysk_tixian',$data,'id='.$agent_info['id']);

	jump('link.php','申请成功，请等待审核');

}
$agent_info = $mysql->select('ysk_merchant','*','id='.$_SESSION['agent_id']);
include('./tpl/tixian.html');


?>