<?php 

define('ACC',TRUE);

include('../sys/init.php');
if (!$_SESSION['admin_uid']&&!$_SESSION['admin_name']) {
   include('./tpl/login/login.html');exit();
}
$auid = $_SESSION['pp'];
$start=strtotime(date('Y-m-d'));
		
        $end=$start+86400;
$act = isset($_REQUEST['act'])?$_REQUEST['act']:'list';

$user_total = $mysql->count('ysk_user','pid ='.$_SESSION['admin_uid']);
$resumto = $mysql->sum('ysk_recharge','price','addtime>= '.$start.' and addtime< '.$end.'and status = 3 and uid in (' .$auid. ')');
$resum = $mysql->sum('ysk_recharge','price','status = 3 and uid in (' .$auid. ')');
$gr_chong = $mysql->sum('ysk_recharge','price','status = 3 and uid='.$_SESSION['admin_uid']);
$gr_ti = $mysql->sum('ysk_withdraw','price','status = 3 and uid='.$_SESSION['admin_uid']);
$wisumto = $mysql->sum('ysk_withdraw','price','addtime>= '.$start.' and addtime< '.$end.'and status = 3 and uid in (' .$auid. ')');
$wisum = $mysql->sum('ysk_withdraw','price','status = 3 and uid in (' .$auid. ')');
 $admin6 = $mysql->select('ysk_user','*','userid='.$_SESSION['admin_uid']);

$countmoney = $mysql->sum('ysk_user','money','pid ='.$_SESSION['admin_uid']);

$countmoney = $mysql->sum('ysk_user','money','pid ='.$_SESSION['admin_uid']);
//$sumyj = $mysql->sum('ysk_user','zsy','pid ='.$_SESSION['admin_uid']);

		
$where="  and reg_date BETWEEN {$start} AND {$end} ";

$user_count =  $mysql->count('ysk_user','pid ='.$_SESSION['admin_uid'] . $where);


$finishorder_count = $mysql->count('ysk_userrob',' status = 3 and uid in (' .$auid. ')');
$tod_sy = $mysql->sum('ysk_somebill','num','addtime>= '.$start.' and addtime< '.$end.' and uid in (' .$auid. ')');
$finishorder_count_to = $mysql->count('ysk_userrob','addtime>= '.$start.' and addtime< '.$end.'and status = 3 and uid in (' .$auid. ')');
$finishorder_money_to = $mysql->sum('ysk_userrob','price','addtime>= '.$start.' and addtime< '.$end.'and status = 3 and uid in (' .$auid. ')');
$finishorder_money = $mysql->sum('ysk_userrob','price',' status = 3 and uid in (' .$auid. ')');
$finishorder_zjmoney = $mysql->sum('ysk_userrob','price',' status = 3 and uid='.$_SESSION['admin_uid']);
$cjze=$finishorder_money+$finishorder_zjmoney;
$xj_yj = $mysql->sum('ysk_somebill','num','xjuid>0 and  uid = '.$_SESSION['admin_uid']);
$sucorder_count = $mysql->count('ysk_userrob',' status = 2 and uid in (' .$auid. ')');

$sucorder_money = $mysql->sum('ysk_userrob','price',' status = 2 and uid in (' .$auid. ')');

$q = $mysql->sum('ysk_userrob','price',' status = 1 and uid in (' .$auid. ')');


if($finishorder_count!=0){
    $cg = (($q/$finishorder_count )*100);
}else{
    $cg = 0;
}


include('./tpl/index/tongji.html');
  




?>