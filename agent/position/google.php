<?php 

define('ACC',TRUE);

include('../sys/init.php');
if (!$_SESSION['admin_uid']&&!$_SESSION['admin_name']) {
   include('./tpl/login/login.html');exit();
}

require_once('./Service/GoogleAuthenticator.class.php');
if (isset($_POST['onecode'])) {
    $ga = new GoogleAuthenticator();
    $onecode = $_REQUEST['onecode'];
    if (empty($onecode) && strlen($onecode) != 6)
    {
        echo '请正确输入手机上google验证码 !';die;
    }
    // google密钥，绑定的时候为生成的密钥；如果是绑定后登录，从数据库取以前绑定的密钥
    $google = $_REQUEST['google'];

    // 验证验证码和密钥是否相同
    $checkResult = $ga->verifyCode($google, $onecode, 1);
    if ($checkResult) {
        $agent_info = $mysql->select('ysk_user','*','userid='.$_SESSION['admin_uid']);
        $result = $mysql->update('ysk_user',['google_auth' => $google],'userid='.$agent_info['userid']);
        if ($result) {
            echo '认证成功';die;
        } else {
            echo '服務器錯誤';die;
        }
    }else{
        echo '验证码错误，请输入正确的验证码 !';die;
    }
}

if (isset($_POST['is_open_google_auth'])) {
    $is_open_google_auth = $_REQUEST['is_open_google_auth'];
    $agent_info = $mysql->select('ysk_user','*','userid='.$_SESSION['admin_uid']);
    if(!$agent_info['google_auth']){
        echo '请先测试认证通过再设置';die;
    }
    $result = $mysql->update('ysk_user',['is_open_google_auth' => $is_open_google_auth],'userid='.$agent_info['userid']);
    echo '设置成功';die;
}

$info = $mysql->select('ysk_user','*','userid='.$_SESSION['admin_uid']);

$ga = new GoogleAuthenticator();
if ($info['google_auth']){
    $createSecret = $info['google_auth'];
}else{
    $createSecret = $ga->createSecret(32);
}
$qrCodeUrl = $ga->getQRCodeGoogleUrl('paofen_agent', $createSecret);


include('./tpl/index/google.html');
  



?>