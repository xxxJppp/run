<?php
define('ACC', TRUE);
include('./sys/init.php');
require_once './lib/QrReader.php';
if (ajaxs()) {
    if ($_REQUEST['act'] == 'select') {
        $data = array();
        $data['order'] = $_POST['order'];
        $data['m'] = $_POST['m'];
        $data['sh'] = $_POST['sh'];
        $data['key'] = $_POST['key'];

        $keymd5 = getSignature($data);
        if($keymd5 != $_POST['keymd5']){
            $d['error'] = 2;
        }else{
            $info = $mysql->select('ysk_roborder', '*', 'ordernum=' . "'{$_REQUEST['order']}'");

            if ($info['uid'] > 0) {
                $class = $info['class'];
                $er = $mysql->select('ysk_ewm','*',' uid='.$info['uid']. ' and zt = 1  and ewm_class='.$class.' and id='.$info['idewm']);
                $er = $mysql->select('ysk_ewm', '*', ' id=' . $info['idewm']);
                $d['error'] = 0;
                $d['msg'] = $er['ewm_url'];
                $d['n'] = $er['uname'];
                $time = $mysql->select('ysk_system','lose_time','id=1');
                $d['pipeitime'] = date('Y-m-d H:i:s',$info['pipeitime']+$time);
                if ($class == 2) {
                    $qrcode = new QrReader($er['ewm_url']);
                    $d['qrurl'] = $qrcode->text();
                }

                if ($info['status'] == 4) {

                    $d['error'] = 4;


                } elseif ($info['status'] == 3) {

                    $d['error'] = 3;

                    $d['name'] = $info['uname'];

                    $d['time'] = $info['ordernum'];


                    $d['price'] = intval($info['price']);
                    $d['md5key'] = $keymd5;

                }

                ajax_text($d);

            } else {

                $d['error'] = 1;
                ajax_text($d);
            }
        }
    } else if ($_REQUEST['act'] == 'qx') {

        $id = $_REQUEST['id'];

        $mysql->delete('ysk_roborder', 'id=' . $id);

        $d['error'] = 1;
        ajax_text($d);

    } else if ($_REQUEST['act'] == 'sn') {
        $d['or'] = 'E' . time() . rand(0000, 9999);
        $d['error'] = 0;
        ajax_text($d);
    }else if ($_REQUEST['act'] == 'sx') {
        $info = $mysql->select('ysk_roborder', '*', 'ordernum=' . "'{$_REQUEST['order']}'");
        $data = array('uid' => $info['uid'], 'money' => $info['price'], 'addtime' => time(), 'ppid' => $info['id']);
        $lis = $mysql->select('ysk_dj','*','ppid='.$info['id']);

        $order_status = $mysql->update('ysk_roborder',array('status' => 4),'id='.$info['id']);
        $user_status = $mysql->update('ysk_userrob',array('status' => 4),'uid='.$info['uid'].' and ppid='.$info['id']);
        $d['error'] = 1;
        ajax_text($d);
    }
}
