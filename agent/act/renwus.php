<?php 


$id = ($_REQUEST['id']+0);

$jiance = $mysql->select('fafa_renwu_list','*','renwu_id='.$id.' and uid = '.$us_info['id']);


if (!empty($jiance)) {
	$data['error'] = 1;
	$data['msg'] = '此任务您已经参与过了。';
    ajax_text($data);
}


$rinfo = $mysql->select('fafa_renwu','*','id = '.$id);


if ($rinfo['zt'] == 0) {
	
	$data['error'] = 1;
	$data['msg'] = '来晚了，此任务已经结束了';
    ajax_text($data);
}


if ($rinfo['num'] == $rinfo['snum'] ) {
	
	$data['error'] = 1;
	$data['msg'] = '来晚了，此任务已经结束了';
    ajax_text($data);
}


$sql="update  fafa_renwu set snum = snum + 1 where id=".$rinfo['id'];

$mysql->query($sql);

$data['renwu_id'] = $id;

$data['uid'] = $us_info['id'];

$data['addtime'] = date('Y-m-d H:i:s',time());

$data['jztime'] = date('Y-m-d H:i:s',time()+($rinfo['xianshi']*3600));

$data['money'] = $rinfo['money'];
$mysql->insert('fafa_renwu_list',$data);

$data['error'] = 0;

ajax_text($data);

?>