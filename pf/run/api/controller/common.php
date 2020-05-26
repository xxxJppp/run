<?php

namespace xh\run\api\controller;

use xh\init;
use xh\library\functions;
use xh\library\jwt;
use xh\library\mysql;
use xh\library\request;


class common
{
    protected $perPage = 15;
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




    //检查是否支持当前通道
    public function review($check_name){
        $find_group = $this->mysql->query("client_group","id={$this->user['group_id']}")[0];
        $group = json_decode($find_group['authority'], true);
        $authority = $group[$check_name];
        if ($authority['open'] != 1) functions::json('0', '您好,你当前所在的用户组无法使用该通道!');
        $mysql = new mysql();
        //检测通道总开关
        $cog = json_decode($mysql->query("variable","name='costCog'")[0]['value'],true)[$check_name];
        if ($cog['open'] != 1) functions::json('0', '该通道已经关闭或正在升级,请稍后再试!');
        return $authority;
    }


}