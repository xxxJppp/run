<?php 

/*

Array
(
    [t] => 2
    [ins] => 2222222
    [im] => Array
        (
            [0] => /data/images/201901/08/536qkm.gif
            [1] => /data/images/201901/08/kj74vc.gif
        )

)
*/

if (ajaxs()) {

	$id = $_POST['id'] + 0;

	$infos = $mysql->select('fafa_renwu_list','*','id='.$id);



	if ($_POST['ins'] == '') {
		 $data['error'] = 1;
	     $data['msg'] = '请按照下面要请，填写任务信息';
         ajax_text($data);	 
	}

	if ($_POST['im'][0] == '') {
		 $data['error'] = 1;
	     $data['msg'] = '截图凭据不能为空,至少需要上传一张';
         ajax_text($data);	 
	}

	$data['txt'] = $_POST['ins'];

	$data['title'] = $_POST['t'];

	$data['zt'] = 1;

	$data['taddtime'] = date('Y-m-d H:i:s',time());

	$data['zhengju'] = implode('|', $_POST['im']);

	$mysql->update('fafa_renwu_list',$data,'id='.$id);

	$data['error'] = 0;

    ajax_text($data);	 
}

?>