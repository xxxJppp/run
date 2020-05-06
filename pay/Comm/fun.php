<?php

function p($text)
{

    echo '<pre>' . print_r($text, true) . '</pre>';
    exit;
}


function ajaxs()
{

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return 1;
    } else {
        return 0;
    }
}

function ajax_text($arr)
{

    echo json_encode($arr);
    exit;
}

function script($str)
{
    return '<script language="javascript" type="text/javascript">' . $str . '</script>';
}

function jump($url = '', $word = '')
{
    if (defined('AJAX') && AJAX == 1) {
        if ($word != '') {
            $arr = array('s' => 0, 'id' => $word);
        } else {
            $arr = array('s' => 1);
        }
        echo json_encode($arr);
        exit();
    } else {
        if ($word != '') {
            if (is_numeric($word)) {
                global $errorData;
                $alert = "alert('" . $errorData[$word] . "');";
            } else {
                $alert = "alert('" . $word . "');";
            }
        } else {
            $alert = '';
        }

        if ($url == -1) {
            $url = $_SERVER['HTTP_REFERER'];
        }

        if ($url == -2 && $_GET['from_url'] != '') {
            $url = $_GET['from_url'];
        }
        if (is_numeric($url) && $url != -1) {
            echo script($alert . 'history.go(' . $url . ');');
        } else {
            echo script($alert . 'window.location.href="' . $url . '";');
        }
        exit();
    }
}

function getSignature($params, $secret = 'GoCkn^*poqLyhp5hY(4<|qBR6.55[X$g')
{
    $str = '';  //待签名字符串
    //先将参数以其参数名的字典序升序进行排序
    ksort($params);
    //遍历排序后的参数数组中的每一个key/value对
    foreach ($params as $k => $v) {
        //为key/value对生成一个key=value格式的字符串，并拼接到待签名字符串后面
        $str .= "$k=$v";
    }
    //将签名密钥拼接到签名字符串最后面
    $str .= $secret;
    //通过md5算法为签名字符串生成一个md5签名，该签名就是我们要追加的sign参数值
    return md5($str);
}