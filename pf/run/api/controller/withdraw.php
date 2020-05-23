<?php

namespace xh\run\api\controller;

use xh\library\functions;
use xh\library\jwt;
use xh\library\mysql;
use xh\library\request;
use xh\unity\page;


class withdraw
{
    private $token = '';
    private $user;
    private $mysql;

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

    public function index()
    {
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');

        $where = "user_id={$this->user['id']}";

        //订单号
        if ($sorting == 'flow_no') {
            if ($code != '') {
                $code = trim($code);
                $where .= " and flow_no={$code}";
            }
        }
        $result = page::conduct('client_mashangwithdraw', request::filter('get.page'), 15, $where, null, 'id', 'desc');

        functions::json(1,'提现列表',$result, $this->token);
    }

}