<?php 


define('ACC',TRUE);

include('../sys/init.php');
if (!$_SESSION['admin_uid']&&!$_SESSION['admin_name']) {
  include('./tpl/login/login.html');exit();
}
$act = isset($_REQUEST['act'])?$_REQUEST['act']:'list';


if ($act == 'list') {

   $html_info['title'] = '登录日志';

   if (isset($_REQUEST['key'])) {

   	  $key = $_REQUEST['key']; 

      $where = '   user LIKE '."'%$key%'" .' admin_uid = '.$_SESSION['admin_uid'];
      
      $sql2 = 'SELECT count(id) FROM `z_log` WHERE '.$where;

   } else {


   	 
   }

   if ($where == '') {
       
       $where = ' admin_uid ='.$_SESSION['admin_uid'];

       $sql2 = 'SELECT count(id) FROM `z_log` WHERE '.$where;
   }
   $showrow = 15; 
   
   $curpage = empty($_GET['page']) ? 1 : $_GET['page'];
   $url = "log?page={page}";
   
   $total = $mysql->getOne($sql2);
   $page = new Ptool($total, $showrow, $curpage, $url, 2);

   $sql = "SELECT * FROM `z_log`  WHERE ".$where." ORDER BY id DESC LIMIT ". ($curpage - 1) * $showrow . ",$showrow";
   

   $list = $mysql->getAll($sql);

   include('./tpl/index/log.html');
	
} else if ($act  == 'dele') {
    

    $id = $_REQUEST['id'] + 0;

    $mysql->delete('z_log','id='.$id);

    jump('log','删除成功');
}




