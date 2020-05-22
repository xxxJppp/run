<?php

namespace xh\run\api\controller;

use xh\library\functions;
use xh\library\ip;
use xh\library\jwt;
use xh\library\model;
use xh\library\mysql;
use xh\library\request;

class user
{

    private $mysql;

    public function __construct()
    {
        $this->mysql = new mysql();
    }

    public function login()
    {
        $username = request::filter('post.username');
        $pwd = request::filter('post.password');

        if (!$username) functions::json(0, '请输入用户名');
        if (strlen($pwd) < 6) functions::json(0, '密码不能小于6位，请重新输入');
        $find_user = $this->mysql->query("client_user", "is_mashang = 1 and username='{$username}'")[0];
        if (!is_array($find_user)) {
            if (!functions::isMobile($username)) {
                functions::json(0, '请输入正确的码商账号');
            }

            $find_user = $this->mysql->query("client_user", "is_mashang = 1 and phone={$username}")[0];
        }

        if (md5($find_user['pwd']) === md5(functions::pwd($pwd, $find_user['token']))) {
            //验证用户组
            $find_group = $this->mysql->query("client_group", "id={$find_user['group_id']}")[0];
            if (!is_array($find_group) || $find_group['authority'] == -1) functions::json(0, '该账号已被禁止登录');
            $this->mysql->update("client_user", ['ip' => ip::get(), 'login_time' => time()], "id={$find_user['id']}");
            $token = jwt::getToken($username);
            functions::json(1, '登陆成功!', $find_user, $token);
        } else {
            functions::json(0, '请输入正确的用户名或密码!');
        }
    }

}