<?php 

if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){ 
    
    $page = $_REQUEST['page']+0;
   
    $start = $page*15; 

    if ($_REQUEST['acts'] == 'all') {
    	$where = ' uid = '.$_SESSION['h_id'];
    }

	if ($_REQUEST['acts'] == 0) {
	    $where = ' uid = '.$_SESSION['h_id'].' and zt = 0';
	}

	if ($_REQUEST['acts'] == 1) {
	     $where = ' uid = '.$_SESSION['h_id'].' and zt = 1';
	}

	if ($_REQUEST['acts'] == 2) {
	     $where = ' uid = '.$_SESSION['h_id'].' and zt = 2';
	}

	if ($_REQUEST['acts'] == 3) {
	      $where = ' uid = '.$_SESSION['h_id'].' and zt = 3';
	}



    $arr = $mysql->select_all('fafa_renwu_list','*', $where ." order by id desc limit $start,15");

    
    foreach ($arr as $k => $v) {
          
          if ($v['zt'] == 0) {
          	 
          	 $txt = '未提交审核';
          	 $money = '<span style="color:Red">提交任务，审核通过奖励'.$v['money'].'元</span>';
          }
          if ($v['zt'] == 1) {
          	 $money = '<span style="color:Red">审核通过奖励'.$v['money'].'元</span>';
          	 $txt = '已提交待审核';
          }

          if ($v['zt'] == 2) {
            $money = '<span style="color:#87d37c">任务奖励已到您的账户</span>';
          	 $txt = '审核通过';
          }

          if ($v['zt'] == 3) {
          	$money = '<span style="color:#ccc">很遗憾，任务审核未通过</span>';
          	 $txt = '审核未通过(点击查看原因)';
          }

          $arr[$k]['txt'] = $txt;
          $arr[$k]['m'] = $money;
    }
 
    echo   json_encode($arr); //转换为json数据输出 

}




?>