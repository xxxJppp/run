<?php 

define('ACC',true);

include('../sys/init.php');
if ($_SESSION['agent_id'] == '') {
	header("location: index.php");
}
$agent = $_SESSION['agent_name'];
if ($_GET['gh']!='' || $_GET['m']!=''  || $_GET['k']!='' || $_GET['e']!='') {
	
	if ($_GET['gh'] != '') {
		$gh = $_GET['gh'];
		$where = 'where shanghu_name='."'$agent'" .' and zt='.$gh;
      //echo $where;exit;
	} else {

		$where = 'where shanghu_name='."'$agent'";
	}


    $_GET['e'] == ''?date('Y-m-d ',time()):$_GET['e'] ;

	if ($_GET['k'] != '' && $_GET['e']!='') {

		$k = $_GET['k'];
		$sj = strtotime($_GET['k']);
		$ej = strtotime($_GET['e']);
		$where.= " and addtime >= $sj and  addtime <=$ej";
	} 


}else{
	
	$where = 'where shanghu_name='."'$agent'";
}

  $sql2 = 'SELECT count(id) FROM `ysk_tixian`' . $where;
$showrow = 10; 
   $curpage = empty($_GET['page']) ? 1 : $_GET['page'];
   $url = "link.php?page={page}";
   
   $total = $mysql->getOne($sql2);
   $page = new PTool($total, $showrow, $curpage, $url, 2);

   $sql = "SELECT * FROM `ysk_tixian`  ".$where." ORDER BY id DESC LIMIT ". ($curpage - 1) * $showrow . ",$showrow";


   $list = $mysql->getAll($sql);
//$list = $mysql->select_all('ysk_tixian','*','shanghu_name='."'$agent'" .' order by id desc');

include('./tpl/link.html');


?>