<?php

define('ACC',true);

include('../sys/init.php');
include('./Service/GoogleAuthenticator.class.php');

if ($_SESSION['agent_id'] == '') {
	header("location: index.php");
}

if (isset($_GET['change'])) {
    $ga = new GoogleAuthenticator();
    $createSecret = $ga->createSecret(32);
    $qrCodeUrl = $ga->getQRCodeGoogleUrl('paofen_merchant', $createSecret);
    $data = [
        'secret' => $createSecret,
        'qrcode' => $qrCodeUrl
    ];
    $data['status'] = 0;
    if($createSecret && $qrCodeUrl){
        $data['status'] = 1;
    }
    echo json_encode($data);die;
}

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
        $agent_info = $mysql->select('ysk_agent','*','id='.$_SESSION['agent_id']);
        $result = $mysql->update('ysk_agent',['google_auth' => $google],'id='.$agent_info['id']);
        if ($result) {
            echo '设置成功';die;
        } else {
            echo '服務器錯誤';die;
        }
    }else{
        echo '验证码错误，请输入正确的验证码 !';die;
    }
}

if (isset($_POST['is_open_google_auth'])) {
    $is_open_google_auth = $_REQUEST['is_open_google_auth'];

    $agent_info = $mysql->select('ysk_agent','*','id='.$_SESSION['agent_id']);
    if(!$agent_info['google_auth']){
        echo '请先测试认证通过再设置';die;
    }
    $result = $mysql->update('ysk_agent',['is_open_google_auth' => $is_open_google_auth],'id='.$agent_info['id']);
    echo '设置成功';die;
}

$info = $mysql->select('ysk_agent','*','id='.$_SESSION['agent_id']);

$ga = new GoogleAuthenticator();
if ($info['google_auth']){
    $createSecret = $info['google_auth'];
}else{
    $createSecret = $ga->createSecret(32);
}
$qrCodeUrl = $ga->getQRCodeGoogleUrl('paofen_merchant', $createSecret);


include('./tpl/google.html');


?>