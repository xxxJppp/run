<?php

namespace xh\run\api\controller;

use xh\library\functions;
use xh\library\request;
use xh\unity\page;

require_once __DIR__ . '/common.php';
class order extends common
{

    public function __construct()
    {
        parent::__construct();
    }

    public function automaticOrder()
    {

        $uid = request::filter('post.uid');
        $type = request::filter('post.type');
        $where = "user_id={$uid}";
        if($type){
            $where .= " and status={$type}";
        }
        $result = page::conduct('client_paofen_automatic_orders', request::filter('get.page'), 15, $where, 'id,trade_no,creation_time,amount,status', 'id', 'desc');

        foreach ($result['result'] as &$v){
            $v['creation_time'] = date('Y-m-d H:i:s',$v['creation_time']);
            $v['status_name'] = $v['status'] == 2 ? '未支付' : ($v['status'] == 3 ? '订单超时' : '已支付');
        }
        functions::json(1, '获取成功',$result['result']);
    }

}