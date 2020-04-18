<?php 

define('ACC',true);

include('../sys/init.php');

if ($_SESSION['agent_id'] == '') {
	header("location: index.php");
}
$agent  = $_SESSION['agent_name'];

if (ajaxs()) {

  

} else {
    $a = $_SESSION['agent_id'];

	  $agent = $_SESSION['agent_name'];

   $list = $mysql->select_limitt('z_log','*','agent='."'$agent'" .' order by id desc','10');


   if ($where == '') {
   
      $where = ' status = 3 and  shanghu_name='."'$agent'";
   }


   $wheres = ' status = 3 and  shanghu_name='."'$agent'";
   $start=strtotime(date('Y-m-d'));
		
        $end=$start+86400;
   $start2=strtotime('yesterday');
		
        $end2=$start2+86400;
  $where2= ' status = 3 and  shanghu_name='."'$agent'".'and pipeitime>='."'$start'".'and pipeitime<'."'$end'";
   $where3= ' status = 3 and  shanghu_name='."'$agent'".'and pipeitime>='."'$start2'".'and pipeitime<'."'$end2'";
   $lists = $mysql->select_limitt('ysk_roborder','*',$where.' order by id desc','10');
   
   $sum = $mysql->count('ysk_roborder', $where );
   $summ = $mysql->sum('ysk_roborder','price', $where );
 $todays=$mysql->sum('ysk_roborder','price',$where2);
   $yess=$mysql->sum('ysk_roborder','price',$where3);
   $agent_info = $mysql->select('ysk_agent','*','id='.$_SESSION['agent_id']);
   

 	 include('./tpl/index.html');
}



?>