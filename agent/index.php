<?php 
define('ACC',TRUE);
include('./sys/init.php');
 $user=$_SESSION['admin_name'];
  //  $key=$_REQUEST["key"];
$agent_info = $mysql->select('ysk_agent','*','names = '."'$user'");
	/*$pwd = $_REQUEST['pwd'];
	$money = $_REQUEST['money'];

  
    
    $sql = "update  ysk_agent set money = money-'$money' where id=".$agent_info['id'];

    $d=$mysql->query($sql);*/
  
 /*$data1['shanghu_id'] = $agent_info['id'];
    $data1['shanghu_name'] = $agent_info['names'];
    $data1['shanghu_kahao'] = $agent_info['acc'];
    $data1['shanghu_huming'] = $agent_info['name'];
    $data1['shanghu_yinhang'] = $agent_info['bankname'];
    $data1['shanghu_xinxi'] = $agent_info['bankinfo'];
    $data1['money'] = $money;
    $data1['addtime'] = time();
	$c=$mysql->insert('ysk_tixian',$data1,'id='.$agent_info['id']);
if($c&&$d){
	  $data2['status']=1;
       $data2['msg']="提交成功";
     echo  json_encode($data2);exit;}*/
?>
