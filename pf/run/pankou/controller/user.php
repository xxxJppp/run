<?php
namespace xh\run\pankou\controller;

use xh\library\mysql;
use xh\library\view;
use xh\library\request;
use xh\library\functions;
use xh\library\url;
use xh\unity\cog;
use xh\library\ip;
use xh\unity\sms;
use xh\library\model;

class user{
    
    private $mysql;
    
    public function __construct(){
        $this->mysql = new mysql();
    }
    
   
    
    //登录界面
    public function login(){
        (new model())->load('user', 'session')->loginCheck();
        unset($_SESSION['login']);
        new view('user/login');
    }
    
    //检测会员名是否正确
    public function checkUsername(){
        (new model())->load('user', 'session')->loginCheck('json');
        $username = request::filter('get.member_id','','htmlspecialchars');
        $find_user = $this->mysql->query("client_user","username='{$username}'")[0];
        if (is_array($find_user)) {
            $_SESSION['login']['username'] = $username;
            functions::json(200, 'success',['uid'=>$find_user['id'],'avatar'=>$find_user['avatar']]);
        }
        //如果没找到用户名，检测是否为手机号
        if (!functions::isMobile($username)) functions::json('-12', '会员名输入有误');
        //检测手机号码
        $find_phone = $this->mysql->query("client_user","phone={$username}")[0];
        if (is_array($find_phone)) {
            $_SESSION['login']['phone'] = $username;
            functions::json(200, 'success',['uid'=>$find_phone['id'],'avatar'=>$find_phone['avatar']]);
        }
        functions::json(-11, '手机号码输入有误');
    }
    
    //检测密码
    public function checkPwd(){
        (new model())->load('user', 'session')->loginCheck('json');
        if (!is_array($_SESSION['login'])) functions::json(-3, '校验失败,请刷新网页');
        $pwd = request::filter('get.pwd','','htmlspecialchars');
        $member_id = request::filter('get.member_id','','htmlspecialchars');
        if (strlen($pwd) < 6) functions::json(-2, '密码输入有误');
        $hook = ['username','phone'];
        //检测密码是否与缓存中的账号匹配
        for ($c=0;$c<count($hook);$c++){
            $hookName = $hook[$c];
            if (!empty($_SESSION['login'][$hook[$c]]) && $member_id == $_SESSION['login'][$hook[$c]]) $find_user = $this->mysql->query("client_user","{$hook[$c]}='{$_SESSION['login'][$hook[$c]]}'")[0];
            if (md5($find_user['pwd']) === md5(functions::pwd($pwd, $find_user['token']))) {
                //验证用户组
                $find_group = $this->mysql->query("client_group","id={$find_user['group_id']}")[0];
                if (!is_array($find_group) || $find_group['authority'] == -1) functions::json(-2, '该账号已被禁止登录');
                $this->mysql->update("client_user", ['ip'=>ip::get(),'login_time'=>time()],"id={$find_user['id']}");
                (new model())->load('user', 'session')->set($find_user);
                functions::json(200, '登录成功');
            }
        }
        functions::json(-3, '密码错误');
    }
    
    //找回密码-view视图
    public function forget(){
        (new model())->load('user', 'session')->loginCheck();
        new view('user/forget');
    }
    
    //找回密码-发送短信-result
    public function forgetGetSms(){
        (new model())->load('user', 'session')->loginCheck('json');
        $username = request::filter('get.member_id','','htmlspecialchars');
        $find_user = $this->mysql->query("client_user","username='{$username}'")[0];
        if (is_array($find_user)) {
            $_SESSION['forget']['phone'] = $find_user['phone'];
            $this->send($find_user);
            functions::json(200, 'success',['uid'=>$find_user['id'],'avatar'=>$find_user['avatar']]);
        }
        //如果没找到用户名，检测是否为手机号
        if (!functions::isMobile($username)) functions::json('-19', '会员名输入有误');
        //检测手机号码
        $find_phone = $this->mysql->query("client_user","phone={$username}")[0];
        if (is_array($find_phone)) {
            $_SESSION['forget']['phone'] = $find_phone['phone'];
            $this->send($find_phone);
            functions::json(200, 'success',['uid'=>$find_phone['id'],'avatar'=>$find_phone['avatar']]);
        }
        functions::json(-18, '手机号码输入有误');
    }
    
    protected function send($user){
        //验证码
        $code = mt_rand(100000,999999);
        //检测是否已经有存活在线的验证码
        $now_time = time()-90;
        $find_code = $this->mysql->query("client_code","phone={$user['phone']} and {$now_time}<get_time and state=1 and typec='forget'");
        if (is_array($find_code[0])) functions::json(-1, '验证码获取太频繁!');
        $this->mysql->delete("client_code", "phone={$user['phone']} and typec='forget'");
        $in = $this->mysql->insert("client_code", [
            'phone'=>$user['phone'],
            'codec'=>$code,
            'get_time'=>time(),
            'state'=>1,
            'typec'=>'forget',
            'ip'=>ip::get()
        ]);
        if ($in == 0) functions::json(-2, '短信发送失败');
        (new sms())->send($user['phone'], $code);
    }

    //验证短信验证码是否正确
    public function checkForgetCode(){
        (new model())->load('user', 'session')->loginCheck('json');
        $code = intval(request::filter('get.code','','htmlspecialchars'));
        $now_time = time()-300;
        $find_code = $this->mysql->query("client_code","phone={$_SESSION['forget']['phone']} and codec={$code} and {$now_time}<get_time and state=1 and typec='forget'")[0];
        //print_r($find_code);
        if (!is_array($find_code)) functions::json(-17, '短信验证码不正确');
        $_SESSION['forget']['code'] = $find_code['codec'];
        functions::json(200, '验证码输入正确');
    }
        
	//api登录接口
	public function apilogin(){
      
		$username = request::filter('post.username');
		$pwd = request::filter('post.pwd');
		
		$find_user = $this->mysql->query("client_user","username='{$username}'")[0];
        if (is_array($find_user)) {
            $_SESSION['login']['username'] = $username;
            if (strlen($pwd) < 6) functions::json(-2, '密码输入有误');
			$hook = ['username','phone'];
			//检测密码是否与缓存中的账号匹配
			for ($c=0;$c<count($hook);$c++){
				$hookName = $hook[$c];
				if (!empty($_SESSION['login'][$hook[$c]]) && $member_id == $_SESSION['login'][$hook[$c]]) $find_user = $this->mysql->query("client_user","{$hook[$c]}='{$_SESSION['login'][$hook[$c]]}'")[0];
				if (md5($find_user['pwd']) === md5(functions::pwd($pwd, $find_user['token']))) {
					//验证用户组
					$find_group = $this->mysql->query("client_group","id={$find_user['group_id']}")[0];
					if (!is_array($find_group) || $find_group['authority'] == -1) functions::json(-2, '该账号已被禁止登录');
					$this->mysql->update("client_user", ['ip'=>ip::get(),'login_time'=>time()],"id={$find_user['id']}");
					(new model())->load('user', 'session')->set($find_user);
					functions::json(200, $_SESSION['MEMBER']['uid'] , $_SESSION['MEMBER']['key_id']);
				}
			}
			functions::json(-3, '密码错误');
        }
        //如果没找到用户名，检测是否为手机号
        if (!functions::isMobile($username)) functions::json('-12', '会员名输入有误');
        //检测手机号码
        $find_phone = $this->mysql->query("client_user","phone={$username}")[0];
        if (is_array($find_phone)) {
            $_SESSION['login']['phone'] = $username;
            functions::json(200, 'success',['uid'=>$find_phone['id'],'avatar'=>$find_phone['avatar']]);
        }
        functions::json(-11, '手机号码输入有误');
	}
    //立即设置密码
    public function pwdSet(){
        (new model())->load('user', 'session')->loginCheck('json');
        $now_time = time()-300;
        $find_code = $this->mysql->query("client_code","phone={$_SESSION['forget']['phone']} and codec={$_SESSION['forget']['code']} and {$now_time}<get_time and state=1 and typec='forget'")[0];
        if (!is_array($find_code)) functions::json(-13, '短信验证码不正确或已经失效!');
        //开始设置密码
        $pwd = request::filter('get.pwd','','htmlspecialchars');
        if (strlen($pwd) < 6) functions::json(-14, '新密码不能小于6位');
        $token = substr(md5(mt_rand(100000,999999)), 0,10);
        $in = $this->mysql->update("client_user", array(
            "pwd"=>functions::pwd($pwd, $token),
            "token"=>$token
        ),"phone={$_SESSION['forget']['phone']}");
        if ($in > 0) functions::json(200, '密码设置成功');
        functions::json(-1, '密码设置失败,请重新尝试');
    }
    public function dologin()
    {


        $username = request::filter('post.member_id','','htmlspecialchars');

        $pwd = request::filter('post.pwd','','htmlspecialchars');

        if (strlen($pwd) < 6) functions::json(99, '密码不能小于6位，请重新输入');
        $find_user = $this->mysql->query("client_user","is_pankou = 1 and username='{$username}'")[0];
        if (is_array($find_user)){
            $_SESSION['login']['username'] = $username;
        }else{
            if (!functions::isMobile($username)){
               functions::json(98, '请输入正确的盘口账号');
            }

            $find_user = $this->mysql->query("client_user","is_pankou = 1 and phone={$username}")[0];
            if (is_array($find_user)) {
                $_SESSION['login']['phone'] = $username;

            }

        }
        if (md5($find_user['pwd']) === md5(functions::pwd($pwd, $find_user['token']))) {
            //验证用户组
            $find_group = $this->mysql->query("client_group","id={$find_user['group_id']}")[0];
            if (!is_array($find_group) || $find_group['authority'] == -1) functions::json(-2, '该账号已被禁止登录');
            $this->mysql->update("client_user", ['ip'=>ip::get(),'login_time'=>time()],"id={$find_user['id']}");
            (new model())->load('user', 'session')->set($find_user);

           functions::json(200, '登陆成功!');
        }else{
         functions::json(97, '请输入正确的用户名或密码!');
        }
    }
}
