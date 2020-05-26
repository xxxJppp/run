<?php

namespace xh\run\api\controller;

use xh\init;
use xh\library\functions;
use xh\library\jwt;
use xh\library\mysql;
use xh\library\request;


class common
{
    protected $token = '';
    protected $user;
    protected $mysql;
    protected $checktoken;
    protected $pass = ['login', 'registered', 'refreshtoken'];//不需要签名验证的方法

    public function __construct()
    {
        $this->mysql = new mysql();
        if (!in_array(init::$action[2], $this->pass)) {
            $token = request::filter('server.HTTP_TOKEN');
            $this->checktoken = jwt::verifyToken($token);
            if ($this->checktoken) {
                $this->token = jwt::getToken($this->checktoken['sub']);
                $this->user = $this->mysql->query("client_user", "username='{$this->checktoken['sub']}'")[0];
            } else {
                functions::json(-1, '签名验证失败');
            }
        }
    }
}