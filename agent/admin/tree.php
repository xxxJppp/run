<?php 

define('ACC',TRUE);

include('../sys/init.php');
if (!$_SESSION['admin_uid']&&!$_SESSION['admin_name']) {
  include('./tpl/login/login.html');exit();
}
$act = isset($_REQUEST['act'])?$_REQUEST['act']:'list';


if ($act == 'list') {
   $html_info['title'] = '会员级别';

   if (isset($_REQUEST['key'])) {
   	  
   	  $name = $_REQUEST['key'];

   	  $uid = $mysql->select('ysk_user','id','name='."'$name'". ' or tel ='."'$name'" );
   }else{
   	  $uid = $_SESSION['admin_uid'];
   }
  
   $list =cts2($uid) ;


   include('./tpl/index/tree.html');
	
}





?>