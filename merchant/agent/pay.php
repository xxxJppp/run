<?php 

define('ACC',true);

include('../sys/init.php');
if ($_SESSION['agent_id'] == '') {
	header("location: index.php");
}

$agent  = $_SESSION['agent_name'];



if ($_GET['gh']!='' || $_GET['m']!=''  || $_GET['k']!='' || $_GET['e']!='') {
	
	if ($_GET['gh'] != '') {
		$gh = $_GET['gh'];
		$where = 'status = 3 and shanghu_name='."'$agent'" .' and ordernum = '."'$gh'";
	} else {

		$where = 'status = 3 and shanghu_name='."'$agent'";
	}


    $_GET['e'] == ''?date('Y-m-d ',time()):$_GET['e'] ;

	if ($_GET['k'] != '' && $_GET['e']!='') {

		$k = $_GET['k'];
		$sj = strtotime($_GET['k']);
		$ej = strtotime($_GET['e']);
		$where.= " and pipeitime >= $sj and  pipeitime <=$ej";
	} 


}

if ($where == '') {
	
	$where = 'status = 3 and  shanghu_name='."'$agent'";
}
 $sql2 = 'SELECT count(id) FROM `ysk_roborder` where ' . $where;
 $showrow = 10; 
   $curpage = empty($_GET['page']) ? 1 : $_GET['page'];
   $url = "pay.php?page={page}";
   
   $total = $mysql->getOne($sql2);
   $page = new PTool($total, $showrow, $curpage, $url, 2);

   $sql = "SELECT * FROM `ysk_roborder` where ".$where." ORDER BY id DESC LIMIT ". ($curpage - 1) * $showrow . ",$showrow";


   $list = $mysql->getAll($sql);
//$list = $mysql->select_all('ysk_roborder','*',$where .' order by id desc');



$agent_info = $mysql->select('ysk_merchant','*','id='.$_SESSION['agent_id']);
   

$wx = $mysql->sum('ysk_roborder','price',$where .' and class = 1');

$zfb = $mysql->sum('ysk_roborder','price',$where.' and class = 2');

$sjm = $mysql->sum('ysk_roborder','price',$where.' and class = 3');

include('./tpl/pay.html');


?>