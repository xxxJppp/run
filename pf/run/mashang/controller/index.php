<?php

namespace xh\run\mashang\controller;


use xh\library\functions;
use xh\library\mysql;
use xh\library\redis;
use xh\library\request;
use xh\library\view;
use xh\unity\callbacks;

class index
{


    public function home()
    {

        new view("index/index");
    }

 

    function callback()
    {
        echo 'success';
        exit;
    }


   
}
