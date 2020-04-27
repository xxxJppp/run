<?php

define('ACC', 1);
include('../sys/init.php');

$part = isset($_GET['part']) ? $_GET['part'] : '';
if ($part == 'out') {

    // $_SESSION['admin_uid']='';
    // $_SESSION['admin_name']='';
    unset($_SESSION['admin_uid']);
    unset($_SESSION['admin_name']);
    session_destroy();//销毁session文件；
    jump('index.php', '已安全退出');
}

if (isset($_REQUEST['mx'])) {

    $id = $_REQUEST['mx'];

    $info = $info = $mysql->select('ysk_user', '*', 'userid=' . $id);

    $_SESSION['admin_uid'] = $info['userid'];
    $_SESSION['admin_name'] = $info['mobile'];

    $where = '  pid =' . $_SESSION['admin_uid'] . ' or gid = ' . $_SESSION['admin_uid'] . ' or ggid = ' . $_SESSION['admin_uid'];


    $pidlist = $mysql->select_all('ysk_user', '*', $where);

    foreach ($pidlist as $k => $v) {

        $pp .= $v['userid'] . ',';
    }

    $_SESSION['pp'] = substr($pp, 0, -1);

    header("location: ./user");
}

if ($_REQUEST['act'] == 'dd') {
    $_SESSION['admin_uid'] = $_REQUEST['id'];
    $_SESSION['admin_name'] = $_REQUEST['name'];

    header("location: ./home");
}

if (ajaxs()) {

    $name = $_POST['user'];

    $pwd = $_POST['pwd'];

    if ($name == '') {
        $data['txt'] = '账号不能为空';
        $data['error'] = 1;
        ajax_text($data);
    }
    if ($pwd == '') {
        $data['txt'] = '密码不能为空';
        $data['error'] = 1;
        ajax_text($data);
    }

    $info = $mysql->select('ysk_user', '*', 'mobile=' . "'$name'");


    $pwds = md5(md5($pwd) . $info['login_salt']);


    //echo $pwds;exit;
    if (empty($info)) {
        $data['txt'] = '您输入的账号或者密码不正确';
        $data['error'] = 1;
        ajax_text($data);
    } else {

        if ($pwds == $info['login_pwd']) {
            //google验证
            if ($info['google_auth']) {
                require_once('./Service/GoogleAuthenticator.class.php');
                $ga = new GoogleAuthenticator();
                // 验证验证码和密钥是否相同
                $checkResult = $ga->verifyCode($info['google_auth'], $_POST['g_code'], 1);
                if (!$checkResult) {
                    $data['txt'] = '谷歌验证码不正确';
                    $data['error'] = 1;
                    ajax_text($data);
                }
            }

            $data['error'] = 0;
            $_SESSION['admin_uid'] = $info['userid'];
            $_SESSION['admin_name'] = $info['mobile'];
            $_SESSION['u_yqm'] = $info['u_yqm'];
            $where = '  pid =' . $_SESSION['admin_uid'] . ' or gid = ' . $_SESSION['admin_uid'] . ' or ggid = ' . $_SESSION['admin_uid'];


            $pidlist = $mysql->select_all('ysk_user', '*', $where);

            foreach ($pidlist as $k => $v) {

                $pp .= $v['userid'] . ',';
            }

            $_SESSION['pp'] = substr($pp, 0, -1);

            ajax_text($data);
        } else {
            $data['txt'] = '您输入的账号或者密码不正确';
            $data['error'] = 1;
            ajax_text($data);
        }

    }
}


include('./tpl/login/login.html');
?>