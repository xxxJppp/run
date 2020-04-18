<?php 

define('ACC',true);

include('../sys/init.php');
if ($_SESSION['agent_id'] == '') {
	header("location: index.php");
}

$a = $_SESSION['agent_id'];

$list = $mysql->select_all('ip','*',' agent_id = '.$a);

include('./tpl/request.html');


?>