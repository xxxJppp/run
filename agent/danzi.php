<?php 
define('ACC',TRUE);
include('./sys/init.php');
header("Access-Control-Allow-Origin: http://api.zhaozhaowang.cn");
if (ajaxs()) {
	//echo " 11111";
	if ($_REQUEST['act'] == 'select') {

  
   
       $info =  $mysql->select_all('ysk_roborder','*','uid = 0 ');
       
       print_r($info);
      
       ajax_text($info);
	
	} else if($_REQUEST['act'] == 'qx'){

       $id = $_REQUEST['id'];

       $mysql->delete('ysk_roborder','id='.$id);

       $d['error'] = 1;
       ajax_text($d);

	}
}

?>