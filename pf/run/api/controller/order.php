<?php

namespace xh\run\api\controller;

use xh\library\functions;
use xh\library\jwt;
use xh\library\request;

class order
{

    private $token = '';

    public function __construct()
    {
        $token = request::filter('server.HTTP_TOKEN');
        $checktoken = jwt::verifyToken($token);
        if ($checktoken) {
            $this->token = jwt::getToken($checktoken['sub']);
        } else {
            functions::json(-1, '签名验证失败');
        }
    }

    public function orderlist()
    {

        echo $this->token;
    }

}