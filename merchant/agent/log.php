<?php 

define('ACC',true);

include('../sys/init.php');
if ($_SESSION['agent_id'] == '') {
	header("location: index.php");
}

$agent = $_SESSION['agent_name'];
 $where = 'WHERE agent='."'$agent'" .'';
        $sql2 = 'SELECT count(id) FROM `z_log`' . $where;
 $showrow = 10; 
   $curpage = empty($_GET['page']) ? 1 : $_GET['page'];
   $url = "log.php?page={page}";
   
   $total = $mysql->getOne($sql2);
   $page = new PTool($total, $showrow, $curpage, $url, 2);

   $sql = "SELECT * FROM `z_log` ".$where." ORDER BY id DESC LIMIT ". ($curpage - 1) * $showrow . ",$showrow";


   $list = $mysql->getAll($sql);

//$list = $mysql->select_all('z_log','*','agent='."'$agent'" .' order by id desc');
include('./tpl/log.html');


?>