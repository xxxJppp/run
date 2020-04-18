<?php 

if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){ 
    
    $page = $_REQUEST['page']+0;
   
    $start = $page*15; 

    if ($_REQUEST['acts'] == 'all') {
    	$where = ' uid = '.$_SESSION['h_id'];
    }

	if ($_REQUEST['acts'] == 0) {
	    $where = ' uid = '.$_SESSION['h_id'].' and type = '."'任务奖励'";
	}

	if ($_REQUEST['acts'] == 1) {
	     $where = ' uid = '.$_SESSION['h_id'].' and type = '."'分销奖励'";
	}

	if ($_REQUEST['acts'] == 2) {
	     $where = ' uid = '.$_SESSION['h_id'].' and (type = '."'申请提现'" .' or type = '."'处理提现申请')";
	}





    $arr = $mysql->select_all('fafa_mx','*', $where ." order by id desc limit $start,15");

    
    foreach ($arr as $k => $v) {


          if ($v['type'] == '申请提现'  || $v['type'] == '处理提现申请') {
              if ($v['zt'] == 0) {
               
                 $txt = '处理中.';
                 $money = '<span style="color:Red">您的'.$v['money'].'元申请提现已提交</span>';
              }
              if ($v['zt'] == 1) {
                 $money = '<span style="color:#87d37c">您的'.$v['money'].'元申请提现已到账</span>';
                 $txt = '已到账';
              }
          }
          
          
         $arr[$k]['addtime'] = date('Y-m-d H:i:s',$v['addtime']);





          $arr[$k]['txt'] = $txt;
          $arr[$k]['m'] = $money;
    }
 
    echo   json_encode($arr); //转换为json数据输出 

}




?>