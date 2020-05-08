<?php
namespace xh\run\index\controller;
use xh\library\model;
use xh\library\mysql;
use xh\library\view;

use xh\library\functions;
use xh\unity\page;
use xh\library\request;
use xh\library\url;


class panel{
    
    private $mysql;
    
    //初始化
    public function __construct(){
        (new model())->load('user', 'session')->check();
        $this->mysql = new mysql();
       $checkuser = $this->mysql->query("client_user","id={$_SESSION['MEMBER']['uid']}")[0];
      if($checkuser['is_agent'] == 1 or $checkuser['is_pankou'] == 1 or $checkuser['is_mashang'] == 1){
         unset($_SESSION['MEMBER']);
        unset($_SESSION);
        url::address(url::s('index/user/login'), '您不是商户，请重新登录!', 0);
    
      }
    }
    
    public function home(){
        
        //查询我的服务订单五条信息
        $service_order = $this->mysql->query("service_order","user_id={$_SESSION['MEMBER']['uid']}",null,"id","desc","0,5");
        //查询提现5条
        $withdrawal = $this->mysql->query("client_withdraw","user_id={$_SESSION['MEMBER']['uid']}",null,"id","desc","0,5");
        
        new view("panel/home",['mysql'=>$this->mysql,'service_order'=>$service_order,'withdrawal'=>$withdrawal]);
    }
    
    public function index(){
        //查询我的服务订单五条信息
        $service_order = $this->mysql->query("service_order","user_id={$_SESSION['MEMBER']['uid']}",null,"id","desc","0,5");
        //查询提现5条
        $withdrawal = $this->mysql->query("client_withdraw","user_id={$_SESSION['MEMBER']['uid']}",null,"id","desc","0,5");

        new view("panel/index",['mysql'=>$this->mysql,'service_order'=>$service_order,'withdrawal'=>$withdrawal]);
    }
}
 