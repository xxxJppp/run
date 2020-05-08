<?php

include 'config.php';

$mysqli = new Mysqli( DB_HOST, DB_USER, DB_PWD, DB_NAME);


$start_time = time() - 300;




$result = $mysqli->query( " delete from  xh_client_wechatdy_automatic_orders   where status = 2 and creation_time < $start_time " );
$result = $mysqli->query( " delete from  xh_client_alipaygm_automatic_orders   where status = 2 and creation_time < $start_time " );
$result = $mysqli->query( " delete from  xh_client_alipay_automatic_orders   where status = 2 and creation_time < $start_time " );
$result = $mysqli->query( " delete from  xh_client_wechatsj_automatic_orders   where status = 2 and creation_time < $start_time " );


echo '删除成功';



/*

namespace xh\run\index\controller;

$wechat = new wechatdy();
$wechat->delOrderByStatus();
class wechatdy{
    private $mysql;
    //初始
    public function __construct(){
 //   (new model())->load('user', 'session')->check();
        $this->mysql = new mysql();
    }
    //删除订单
    public function delOrderByStatus(){
	    $start_time = time() - 300;
	    $rc = $this->mysql->delete("client_wechatdy_automatic_orders",'status = 2 and user_id = '.$_SESSION['MEMBER']['uid'].' and creation_time < '.$start_time);
        if ($rc >= 0) functions::json(200, '删除成功');
        functions::json(-69, '删除失败,请联系客服');
    }
}
*/