<?php 

define('ACC', 1);
include('../sys/init.php');
if (!$_SESSION['admin_uid']&&!$_SESSION['admin_name']) {
	include('./tpl/login/login.html');exit();
}



$myde_size = 15; //一页显示的记录数
$myde_page = isset($_GET['page']) ? $_GET['page'] : 1;  //当前页

$a = isset($myde_page) ? ($myde_page-1)*$myde_size : ($myde_page-1)*$myde_size;

// 搜索会员信息
if(isset($_GET['act'])&&$_GET['act']=='select'){

	$where = 'WHERE '.$_POST['name'].' LIKE "%'.$_POST['key'].'%"';

	$sql = "SELECT * FROM `ysk_user` $where order by userid desc  LIMIT $a,$myde_size";
	$user = $mysql->getAll($sql);

	include('./tpl/index/user_list.html');
	exit();
}

$where = 'where  pid ='.$_SESSION['admin_uid'] . ' or gid = '.$_SESSION['admin_uid'] . ' or ggid = '.$_SESSION['admin_uid'];

$sql = "SELECT * FROM `ysk_user` $where  order by userid desc  LIMIT $a,$myde_size";


$user = $mysql->getAll($sql);



$myde_total = $mysql->count('z_user',' where 1');//总记录数

$p = new PTool($myde_total,$myde_size,$myde_page,'user.php?page={page}');


include('./tpl/index/user_list.html');

?>