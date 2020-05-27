<?php

namespace xh\run\cmd\controller;

use xh\library\functions;
use xh\library\request;
use xh\unity\callbacks;
use xh\unity\page;
use xh\unity\upload;


class order extends common
{

    public function __construct()
    {
        parent::__construct();
    }

    function test(){
        echo 'this is a test';
    }
}