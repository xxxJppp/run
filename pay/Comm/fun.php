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

function ajax_text($arr){

    echo  json_encode($arr); exit;
}

function template($tpl){
    require_once SYS.'/../tpl/'.$tpl.'.php';
}