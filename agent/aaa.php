<?php 
define('ACC',TRUE);
include('./sys/init.php');
//header("Access-Control-Allow-Origin: http://localhost");
header('Access-Control-Allow-Origin:*');//注意！跨域要加这个头 上面那个没有
	if ($_REQUEST['act'] == 'cha') {
$user=$_REQUEST["u"];
    $key=$_REQUEST["key"];
   // echo $key;exit;
 $info =  $mysql->select('ysk_merchant','*','names = '."'$user'");
//$ulist = M('merchant')->where(array('names'=>$user))->find();
   // print_r($ulist);exit;
    if($info['key']<>$key){
      $data['status']=0;
       $data['msg']="无此用户";
     echo  json_encode($data);
      //echo  0;
    }else{
     $data['status']=1;
      $data['shname']=$info['names'];
      $data['msg']=$info['money'];
       $data['id']=$info['id'];
      echo  json_encode($data);
    }}
elseif($_REQUEST['act'] == 'tixianxx')
{
    $user=$_REQUEST["u"];
    $key=$_REQUEST["key"];
 $info =  $mysql->select('ysk_merchant','*','names = '."'$user'");
    if($info['key']<>$key){
      $data['status']=0;
       $data['msg']="无此用户";
     echo  json_encode($data);
      //echo  0;
    }else{
     $data['status']=1;
      $data['shname']=$info['names'];
      $data['yhname']=$info['bankname'];
       $data['kaihuhang']=$info['bankinfo'];
        $data['skname']=$info['name'];
        $data['skaccount']=$info['acc'];
      echo  json_encode($data);
    }
}
elseif($_REQUEST['act'] == 'infocl')
{
    $user=$_REQUEST["u"];
    $key=$_REQUEST["key"];
// echo  json_encode($_REQUEST);
  //print_r($_REQUEST);exit;
$agent_info = $mysql->select('ysk_merchant','*','names = '."'$user'");
	$pwd = $_REQUEST['pwd'];
	if (md5($pwd)  != $agent_info['pwd']||$agent_info['key']<>$key) {
       $data['status']=0;
       $data['msg']="商户验证失败";
     echo  json_encode($data);
        //jump('-1','登录密码不正确');
	}else{
 unset($_REQUEST['pwd']);
      $datas['acc'] = $_REQUEST['acc'];
      $datas['bankname'] = $_REQUEST['bankname'];
       $datas['bankinfo'] = $_REQUEST['bankinfo'];
       $datas['name'] = $_REQUEST['name'];
        
    $mysql->update('ysk_merchant',$datas,'id='.$agent_info['id']);
      $data['status']=1;
       $data['msg']="资料修改成功";
     echo  json_encode($data);
    }

	//

}elseif($_REQUEST['act'] == 'tixiancl'){
   $user=$_REQUEST["u"];
    $key=$_REQUEST["key"];
$agent_info = $mysql->select('ysk_merchant','*','names = '."'$user'");
	$pwd = $_REQUEST['pwd'];
	$money = $_REQUEST['money'];

  
    
    $sql = "update  ysk_merchant set money = money-'$money' where id=".$agent_info['id'];

    $d=$mysql->query($sql);
  
 $data1['shanghu_id'] = $agent_info['id'];
    $data1['shanghu_name'] = $agent_info['names'];
    $data1['shanghu_kahao'] = $agent_info['acc'];
    $data1['shanghu_huming'] = $agent_info['name'];
    $data1['shanghu_yinhang'] = $agent_info['bankname'];
    $data1['shanghu_xinxi'] = $agent_info['bankinfo'];
    $data1['money'] = $money;
    $data1['addtime'] = time();
	$c=$mysql->insert('ysk_tixian',$data1,'id='.$agent_info['id']);
if($c&&$d){
	  $data1['status']=1;
       $data1['msg']="提交成功";
     echo  json_encode($data1);exit;}
	/*if ($money <= 0||$agent_info['money'] < $money ) {
      $data['status']=0;
       $data['msg']="提现余额不足或金额错误";
     echo  json_encode($data);
	}
	if (md5($pwd)  != $agent_info['pwd']||$agent_info['key']<>$key) {
       $data['status']=0;
       $data['msg']="商户验证失败";
     echo  json_encode($data);
        //jump('-1','登录密码不正确');
	}else{
  
    $data['shanghu_id'] = $agent_info['id'];
    $data['shanghu_name'] = $agent_info['names'];
    $data['shanghu_kahao'] = $agent_info['acc'];
    $data['shanghu_huming'] = $agent_info['name'];
    $data['shanghu_yinhang'] = $agent_info['bankname'];
    $data['shanghu_xinxi'] = $agent_info['bankinfo'];
    $data['money'] = $money;
    $data['addtime'] = time();
    
    $sql = "update  ysk_merchant set money = money-'$money' where id=".$agent_info['id'];

    $mysql->query($sql);

	$mysql->insert('ysk_tixian',$data,'id='.$agent_info['id']);

	  $data1['status']=1;
       $data1['msg']="提交成功";
     echo  json_encode($data1);
    }*/

}


?>