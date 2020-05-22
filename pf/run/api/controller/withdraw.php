<?php

namespace xh\run\api\controller;

use xh\library\functions;
use xh\library\jwt;
use xh\library\request;
use xh\library\view;
use xh\unity\page;

require_once "./run/api/controller/order.php";

class withdraw extends order
{

    public function __construct()
    {
        parent::__construct();
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