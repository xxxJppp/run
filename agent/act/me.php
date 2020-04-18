<?php 





$da['n'] = $us_info['name'];

$da['m'] = $us_info['money'];

$count = $mysql->count('fafa_mx','type='."申请提现".'  and uid='.$_SESSION['h_id']);

$da['c'] = $count;

function get_parent_id($cid){
    global $mysql;
    $pids = '';
    $parent_id = $mysql->select('fafa_member','id','pid ='.$cid);
    if($parent_id != '' ){
        $pids .= $parent_id;
        $npids = get_parent_id($parent_id);
        if(isset($npids))
            $pids .= ','.$npids;
    }
   
    return rtrim($pids,",");
}

function shangji($a){
     global $mysql;
	 $list = $mysql->select_all('fafa_member','id,name',' id in ('.$a.')');
     return $list;
}



$shangji = shangji(get_parent_id($_SESSION['h_id']));


$da['f'] = count($shangji);


echo json_encode($da);

?>