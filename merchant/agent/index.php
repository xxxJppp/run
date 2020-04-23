<?php 

define('ACC',true);

include('../sys/init.php');



if (ajaxs()) {

   $name = $_POST['n'];
   $pwd  = $_POST['p'];
   if ($name == '') {
   	 	$data['e'] = 1;
        $data['msg'] = '用户名不能为空';
        ajax_text($data);
   }

   if ($pwd == '') {
   	 	$data['e'] = 1;
        $data['msg'] = '密码不能为空';
        ajax_text($data);
   }

   $info = $mysql->select('ysk_agent','*','names='."'$name'");


   if (empty($info)) {
   	  
   	   	$data['e'] = 1;
        $data['msg'] = '用户名或者密码不正确';
        ajax_text($data);
   }


   if ($info['zt'] == 0) {
        $data['e'] = 1;
        $data['msg'] = '账户已被停用';
        ajax_text($data);
   }

   if ($info['pwd'] != md5($pwd)) {
   	  
   	   	$data['e'] = 1;
        $data['msg'] = '用户名或者密码不正确';
        ajax_text($data);
   } else {
       //google验证
       if ($info['is_open_google_auth']) {
           require_once('./Service/GoogleAuthenticator.class.php');
           $ga = new GoogleAuthenticator();
           // 验证验证码和密钥是否相同
           $checkResult = $ga->verifyCode($info['google_auth'], $_POST['g_code'], 1);
           if(!$checkResult){
               $data['e'] = 1;
               $data['msg'] = '谷歌验证码不正确';
               ajax_text($data);
           }
       }

   	    $_SESSION['agent_id'] = $info['id'];

   	    $_SESSION['agent_name'] = $info['names'];

   	    $_SESSION['agent_zhanghu'] = $info['names'];

   	    $t = time();

        $ip = get_client_ip();

        $sql = "update ysk_agent set login_num = login_num +1,last_time= '$t',ip='$ip' where id=".$info['id'];

   	    $mysql->query($sql);

        $lo['agent'] = $info['names'];

        $lo['addtime'] = time();

        $lo['ip'] = $ip;

        $mysql->insert('z_log',$lo);

   	$data['e'] = 0;
        $data['msg'] = '';
	
	$json = json_encode($data);
	echo $json;
	
   }



} else {

  include('./tpl/login.html');

}
?>