<?php 

define('ACC',TRUE);

include('../sys/init.php');
if (!$_SESSION['admin_uid']&&!$_SESSION['admin_name']) {
   include('./tpl/login/login.html');exit();
}
$act = isset($_REQUEST['act'])?$_REQUEST['act']:'list';

$auid = $_SESSION['pp'];

if ($act == 'list') {

   $html_info['title'] = '账变明细';

   if (isset($_REQUEST['key'])) {

        $key = $_REQUEST['key']; 

        $uid = $mysql->SELECT('ysk_user','userid','mobile ='."'$key'");

        $where = 'WHERE uid = '.$uid.' and  uid in (' .$auid. ')';

        $sql2 = 'SELECT count(id) FROM `z_mx`'. $where;

   } else {

        $where = 'WHERE uid in (' .$auid. ')';
        $sql2 = 'SELECT count(id) FROM `ysk_userrob`' . $where;
   }

  
   $showrow = 15; 
   $curpage = empty($_GET['page']) ? 1 : $_GET['page'];
   $url = "mingxi?page={page}";
   
   $total = $mysql->getOne($sql2);
   $page = new Ptool($total, $showrow, $curpage, $url, 2);

   $sql = "SELECT * FROM `ysk_userrob` ".$where." ORDER BY id DESC LIMIT ". ($curpage - 1) * $showrow . ",$showrow";


   $list = $mysql->getAll($sql);



   include('./tpl/index/mingxi.html');
  
}


?>