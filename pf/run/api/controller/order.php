<?php

namespace xh\run\api\controller;

use xh\library\functions;
use xh\library\jwt;
use xh\library\mysql;
use xh\library\request;

class order
{
    protected $token = '';
    protected $user;
    protected $mysql;

    public function __construct()
    {
        $token = request::filter('server.HTTP_TOKEN');
        $checktoken = jwt::verifyToken($token);
        if ($checktoken) {
            $this->token = jwt::getToken($checktoken['sub']);
            $this->mysql = new mysql();
            $this->user = $this->mysql->query("client_user", "username='{$checktoken['sub']}'")[0];
        } else {
            functions::json(-1, '签名验证失败');
        }
    }

    public function orderlist()
    {

        echo $this->token;
    }

}