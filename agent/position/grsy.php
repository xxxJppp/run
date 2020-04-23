<?php 

define('ACC',TRUE);

include('../sys/init.php');
if (!$_SESSION['admin_uid']&&!$_SESSION['admin_name']) {
   include('./tpl/login/login.html');exit();
}
$act = isset($_REQUEST['act'])?$_REQUEST['act']:'list';

$auid = $_SESSION['pp'];

if ($act == 'list') {

   $html_info['title'] = '个人收益';

   if (isset($_REQUEST['key'])) {

   	    $key = $_REQUEST['key']; 

        $uid = $mysql->SELECT('ysk_user','userid','mobile ='."'$key'");

        $where = 'WHERE uid = '.$uid.' and  uid in (' .$auid. ')';

        //$where = 'WHERE z_user.name LIKE "%'.$key.'%"';


        $sql2 = 'SELECT count(id) FROM `z_mx`'. $where;

   } else {

        $where = 'WHERE uid in (' .$_SESSION['admin_uid']. ') and jl_class=1';
        $sql2 = 'SELECT count(id) FROM `ysk_somebill`' . $where;
   }

  
   $showrow = 15; 
   $curpage = empty($_GET['page']) ? 1 : $_GET['page'];
   $url = "grsy?page={page}";
   
   $total = $mysql->getOne($sql2);
   $page = new PTool($total, $showrow, $curpage, $url, 2);

   $sql = "SELECT * FROM `ysk_somebill` ".$where." ORDER BY id DESC LIMIT ". ($curpage - 1) * $showrow . ",$showrow";


   $list = $mysql->getAll($sql);

   include('./tpl/index/grsy.html');
	
}


?>