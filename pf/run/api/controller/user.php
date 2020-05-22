<?php

namespace xh\run\api\controller;

use xh\library\functions;
use xh\library\ip;
use xh\library\jwt;
use xh\library\model;
use xh\library\mysql;
use xh\library\request;
use xh\unity\cog;

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
            functions::json(1, '登录成功!', $find_user, $token);
        } else {
            functions::json(0, '请输入正确的用户名或密码!');
        }
    }


    public function registered(){


        $username = request::filter('post.username');
        $pwd = request::filter('post.password');
        $pwd_repeat = request::filter('post.pwd_repeat');
        $phone = request::filter('post.phone');
        $recommend_username = request::filter('post.recommend_username');
        $level_id = 0;
        //检查用户名是否低于4位
        if (strlen($username) < 4) functions::json(0, '会员名不能低于4位');
        //检查用户名是否已经存在
        $find_user_username = $this->mysql->query("client_user","username='{$username}'",'id')[0];
        if (is_array($find_user_username)) functions::json(0, '该用户名已经存在');
        //检查密码是否低于6位
        if (strlen($pwd) <6) functions::json(0, '登录密码不能低于6位');
        //检查重复输入密码是否正确
        if (md5($pwd) !== md5($pwd_repeat)) functions::json(0, '重复密码输入有误');
        //检查手机是否输入正确
        if (!functions::isMobile($phone)) functions::json(0, '手机号码输入有误');
        //检查手机是否已经注册过了
        $find_user_phone = $this->mysql->query("client_user","phone={$phone}",'id')[0];
        if (is_array($find_user_phone)) functions::json(0, '该手机号已经注册过了');
        //检测推荐会员名是否存在
        if (cog::read('registerCog')['scale_open'] == 1){
            if (!empty($recommend_username)){
                $find_recommend = $this->mysql->query("client_user","username='{$recommend_username}'",'id,level_id')[0];
                if (!is_array($find_recommend)) functions::json(0, '您填写的推荐会员没有找到,如果没有推荐会员,可留空');
                $level_id = $find_recommend['id'];
                //检测三级分销
                if ($find_recommend['level_id'] != 0){
                    $find_recommend_agent = $this->mysql->query("client_user","id={$find_recommend['level_id']}")[0];
                    if (is_array($find_recommend_agent)){
                        //检测三级分销是否开启
                        if (cog::read('registerCog')['points_open'] != 1) functions::json(0, '您填写的推荐会员无法让您注册成功,可留空再尝试注册');
                    }
                }
            }
        }

        $token = substr(md5(mt_rand(100000,999999)), 0,10);
        $key_id = strtoupper(substr(md5(mt_rand(100000,999999)), 0,14));
        //写入数据库
        $userIn = $this->mysql->insert('client_user', [
            'username'=>$username,
            'phone'=>$phone,
            'pwd'=>functions::pwd($pwd, $token),
            'balance'=> cog::read('registerCog')['integral'],
            'money'=>0,
            'token'=>$token,
            'group_id' => cog::read('registerCog')['group_id'],
            'level_id'=>$level_id,
            'key_id'=>$key_id
        ]);
        if ($userIn > 0){
            //$this->mysql->delete("client_code", "phone={$_SESSION['register_user']['phone']} and typec='register'");
            functions::json(1, '注册成功，请登录');
        }
        functions::json(0, '注册失败');
    }

}