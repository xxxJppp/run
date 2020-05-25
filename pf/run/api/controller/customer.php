<?php

namespace xh\run\api\controller;

use xh\init;
use xh\library\Config;
use xh\library\functions;
use xh\library\ip;
use xh\library\jwt;
use xh\library\mysql;
use xh\library\request;
use xh\unity\cog;
require_once __DIR__.'/common.php';
class customer extends  common
{


    public function __construct()
    {
        parent::__construct();
    }

    public function chat(){
       $data = Config::get('customer');
       functions::json(1, '客服',$data);
    }

}