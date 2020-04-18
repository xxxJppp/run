<?php 

define('ACC',TRUE);

include('../sys/init.php');
if (!$_SESSION['admin_uid']&&!$_SESSION['admin_name']) {
   include('./tpl/login/login.html');exit();
}
$act = isset($_REQUEST['act'])?$_REQUEST['act']:'list';


if($act == 'add' || $act == 'edit'){
  
   if (1) {

    	$name = $_POST['username'];

    	$login_pwd = $_POST['pwd'];

    	$mobile = $_POST['mobile'];

        $list = $mysql->select('ysk_user','*','account='."'$name'" .' or mobile = '.$mobile);
 
     
	    if(!empty($list)){
	    	 $data['txt'] = '增加用户失败,用户名已经存在';
             $data['error'] = 1;
             ajax_text($data);
				
		}
			
	    $numss = rand(0000,9999);
	    $datas['mobile'] = $mobile;
	    $datas['username'] = $name;
        $datas['account'] = $name;
	    $datas['login_pwd'] = md5(md5($login_pwd).$numss);
      $datas['login_salt']= $numss;
		  $datas['reg_date'] = time();
		  $datas['status'] = 0;
		  $datas['rz_st'] = 1;
      $datas['u_yqm'] = substr(str_shuffle('ABCEDDjhsdhfhhhwe454544545SDF1010SAD1'),0,8);
		  $datas['pid'] = $_SESSION['admin_uid'];
        $mysql->insert('ysk_user',$datas);
   	    $data['error'] = 0;

   	    $where = '  pid ='.$_SESSION['admin_uid'] . ' or gid = '.$_SESSION['admin_uid'] . ' or ggid = '.$_SESSION['admin_uid'];


        $pidlist = $mysql->select_all('ysk_user','*', $where);

        foreach ($pidlist as $k => $v) {
        		
        		$pp.= $v['userid'].',';
        }

       $_SESSION['pp'] = substr($pp,0,-1);
	    ajax_text($data);

   } 
   
}else {

      include('./tpl/index/adds.html');
   }




?>