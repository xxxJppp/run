<?php 

define('ACC',TRUE);

include('../sys/init.php');
if (!$_SESSION['admin_uid']&&!$_SESSION['admin_name']) {
   include('./tpl/login/login.html');exit();
}
$act = isset($_REQUEST['act'])?$_REQUEST['act']:'list';


if ($act == 'list') {
 
	
}else if($act == 'add' || $act == 'edit'){

   $gid = $_SESSION['admin_uid'];

   if ($gid) {
   
      $html_info['title'] = '管理员修改';

      if ($gid != $_SESSION['admin_uid']) {
         
         jump('-1','非法操作');
      }

      $admin = $mysql->select('ysk_user','*','userid='.$gid);

   } 
   if (ajaxs()) {

   	  
   	  $admin_id = $_SESSION['admin_uid'];

      $admin = $mysql->select('ysk_user','*','userid='.$admin_id);


      $pwds = md5(md5($_POST['jpwd']) . $admin['login_salt']);

   	  if ($admin_id == 0) {
   	  	 
   	  } else {

   	  	 $data['txt'] = '修改成功';

          if ($admin['pwd'] != $pwds  ) {
               $data['txt'] = '旧密码错误';

               $data['error'] = 1;
               ajax_text($data);
          }

   	  	 if ($_POST['pwd'] != '') {
   	  	 	 
   	  	 	 if ($_POST['pwd']!=$_POST['repwd']) {
   	  	 	 	 $data['txt'] = '两次密码不一致';

			       $data['error'] = 1;
			       ajax_text($data);

   	  	 	 } else{

   	  	 	   	$datas['pwd'] = md5(md5($_POST['pwd']) . $admin['login_salt']); 
   	  	 	 }

   	  	 }

   	  	 
         $mysql->update('ysk_user',$datas,'userid='.$admin_id);
   	  }

   	    $data['error'] = 0;
	     ajax_text($data);

   } else {

      include('./tpl/index/admins.html');
   }
   
}




?>