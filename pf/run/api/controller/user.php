<?php

namespace xh\run\api\controller;

use xh\library\functions;
use xh\library\ip;
use xh\library\jwt;
use xh\library\request;
use xh\unity\cog;
use xh\unity\encrypt;

require_once __DIR__ . '/common.php';

class user extends common
{

    private $userkey = 'pfuser';

    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $username = request::filter('post.username');
        $pwd = request::filter('post.password');

        if (!$username) functions::json(0, '请输入用户名');
        if (strlen($pwd) < 6) functions::json(0, '密码不能小于6位，请重新输入');
        $field = 'id,username,phone,pwd,token,group_id';
        $find_user = $this->mysql->query("client_user", "is_mashang = 1 and username='{$username}'", $field)[0];
        if (!is_array($find_user)) {
            if (!functions::isMobile($username)) {
                functions::json(0, '请输入正确的码商账号');
            }

            $find_user = $this->mysql->query("client_user", "is_mashang = 1 and phone={$username}", $field)[0];
        }

        if (md5($find_user['pwd']) === md5(functions::pwd($pwd, $find_user['token']))) {
            //验证用户组
            $find_group = $this->mysql->query("client_group", "id={$find_user['group_id']}")[0];
            if (!is_array($find_group) || $find_group['authority'] == -1) functions::json(0, '该账号已被禁止登录');
            $this->mysql->update("client_user", ['ip' => ip::get(), 'login_time' => time()], "id={$find_user['id']}");
            $token = jwt::getToken($username);
            unset($find_user['pwd']);
            unset($find_user['token']);
            $find_user['k'] = (new encrypt())->Encode($find_user['username'], $this->userkey);
            functions::json(1, '登录成功!', $find_user, $token);
        } else {
            functions::json(0, '请输入正确的用户名或密码!');
        }
    }


    public function registered()
    {

        $username = request::filter('post.username');
        $pwd = request::filter('post.password');
        $pwd_repeat = request::filter('post.pwd_repeat');
        $phone = request::filter('post.phone');
        $recommend_username = request::filter('post.recommend_username');
        $level_id = 0;
        //检查用户名是否低于4位
        if (strlen($username) < 4) functions::json(0, '会员名不能低于4位');
        //检查用户名是否已经存在
        $find_user_username = $this->mysql->query("client_user", "username='{$username}'", 'id')[0];
        if (is_array($find_user_username)) functions::json(0, '该用户名已经存在');
        //检查密码是否低于6位
        if (strlen($pwd) < 6) functions::json(0, '登录密码不能低于6位');
        //检查重复输入密码是否正确
        if (md5($pwd) !== md5($pwd_repeat)) functions::json(0, '重复密码输入有误');
        //检查手机是否输入正确
        if (!functions::isMobile($phone)) functions::json(0, '手机号码输入有误');
        //检查手机是否已经注册过了
        $find_user_phone = $this->mysql->query("client_user", "phone={$phone}", 'id')[0];
        if (is_array($find_user_phone)) functions::json(0, '该手机号已经注册过了');
        //检测推荐会员名是否存在
        if (cog::read('registerCog')['scale_open'] == 1) {
            if (!empty($recommend_username)) {
                $find_recommend = $this->mysql->query("client_user", "username='{$recommend_username}'", 'id,level_id')[0];
                if (!is_array($find_recommend)) functions::json(0, '您填写的推荐会员没有找到,如果没有推荐会员,可留空');
                $level_id = $find_recommend['id'];
                //检测三级分销
                if ($find_recommend['level_id'] != 0) {
                    $find_recommend_agent = $this->mysql->query("client_user", "id={$find_recommend['level_id']}")[0];
                    if (is_array($find_recommend_agent)) {
                        //检测三级分销是否开启
                        if (cog::read('registerCog')['points_open'] != 1) functions::json(0, '您填写的推荐会员无法让您注册成功,可留空再尝试注册');
                    }
                }
            }
        }

        $token = substr(md5(mt_rand(100000, 999999)), 0, 10);
        $key_id = strtoupper(substr(md5(mt_rand(100000, 999999)), 0, 14));
        //写入数据库
        $userIn = $this->mysql->insert('client_user', [
            'username' => $username,
            'phone' => $phone,
            'pwd' => functions::pwd($pwd, $token),
            'balance' => cog::read('registerCog')['integral'],
            'money' => 0,
            'token' => $token,
            'group_id' => cog::read('registerCog')['group_id'],
            'level_id' => $level_id,
            'key_id' => $key_id,
            'is_mashang' => 1 //注册 即为码商
        ]);
        if ($userIn > 0) {
            //$this->mysql->delete("client_code", "phone={$_SESSION['register_user']['phone']} and typec='register'");
            functions::json(1, '注册成功，请登录');
        }
        functions::json(0, '注册失败');
    }

    public function refreshtoken()
    {

        $k = request::filter('post.k');
        $username = (new encrypt())->Decode($k, $this->userkey);
        if (!$k) {
            functions::json(0, '参数错误');
        }

        $find_user = $this->mysql->query("client_user", "username='{$username}'", 'id')[0];
        if (!$find_user) functions::json(0, '参数错误');

        functions::json(1, '获取成功', [], jwt::getToken($find_user));
    }


    public function userinfo()
    {

        $k = request::filter('post.k');
        $username = (new encrypt())->Decode($k, $this->userkey);
        if ($this->checktoken['sub'] != $username) {
            functions::json(0, '用户信息有误');
        }
        $checkuser = $this->mysql->query('client_user', "username='{$username}' and is_mashang=1 and status=1", 'id,username,phone,money');

        if (!$checkuser) {
            functions::json(0, '用户信息有误');
        }
        $start_time = strtotime(date('ymd' . '00:00:00'));
        $end_time = strtotime(date('ymd' . '23:59:59'));
        $deposit = $this->mysql->query('deposit', "user_id='{$checkuser[0]['id']}'", 'SUM(money) as money');
        $appeal = $this->mysql->query('appeal', "user_id='{$checkuser[0]['id']}'", 'count(id) as count');
        $zfb = $this->mysql->query('client_paofen_automatic_orders', "user_id='{$checkuser[0]['id']}' and pay_time between {$start_time} and {$end_time}", 'SUM(amount) as amount');
        $checkuser[0]['deposit'] = $deposit[0]['money'] ? $deposit[0]['money'] : 0;
        $checkuser[0]['wx'] = 0;
        $checkuser[0]['zfb'] = $zfb[0]['amount'] ? $zfb[0]['amount'] : 0;
        $checkuser[0]['yhk'] = 0;
        $checkuser[0]['yhk'] = 0;
        $checkuser[0]['appeal'] = $appeal[0]['count'] ? $appeal[0]['count'] : 0;
        functions::json(1, '获取成功', $checkuser[0], $this->token);
    }

    public function setBank(){
        $bank_type = request::filter('post.bank_type', '', 'htmlspecialchars');
        if(!$bank_type){
            functions::json(-1, '请选择绑定类型!');
        }
        if ($bank_type == 1) {
            //支付宝
            $alipay_name = request::filter('post.name', '', 'htmlspecialchars');
            //账号
            $alipay_content = request::filter('post.card', '', 'htmlspecialchars');
            if (empty($alipay_name) || empty($alipay_content)) functions::json(-1, '支付宝姓名或账号不能为空!');
            //写入
            $edit['bank'] = json_encode(['type' => 1, 'name' => $alipay_name, 'card' => $alipay_content]);
        }
        if ($bank_type == 2) {
            //姓名
            $bank_name = request::filter('post.name', '', 'htmlspecialchars');
            //银行名称
            $bank = request::filter('post.bank', '', 'htmlspecialchars');
            //账号
            $card = request::filter('post.card', '', 'htmlspecialchars');
            if (empty($bank_name) || empty($bank) || empty($card)) functions::json(-1, '银行卡信息有误,请填写正确!');
            $edit['bank'] = json_encode(['type' => 2, 'name' => $bank_name, 'card' => $card, 'bank' => $bank]);
        }

        $this->mysql->update("client_user", $edit, "id={$this->user['id']}");
        functions::json(1, '银行信息设置成功!');
    }

}