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
function script($str){
    return '<script language="javascript" type="text/javascript">'.$str.'</script>';
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