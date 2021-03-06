<?php

namespace Admin\Controller;

use Admin\Service\GoogleAuthenticator;
use Think\Controller;

class PubssController extends Controller
{
    /**
     * 后台登陆
     */
    public function login()
    {

        if (IS_POST) {

            $username = I('username');
            $password = I('password');

            // 验证用户名密码是否正确
            // 

            $user_object = D('Admin/Manage');
            $user_info = $user_object->login($username, $password);


            if (!$user_info) {
                $this->error($user_object->getError());
            }
            // google验证码校验
            if ($user_info['google_auth']) {
                if (!$this->google_check_verify(I('post.google_code'), $user_info['google_auth'])) {
                    $this->error('goole验证码输入错误！');
                }
            }


            // 验证该用户是否有管理权限
            $account_object = D('Admin/Group');
            $where['id'] = $user_info['auth_id'];
            $account_info = $account_object->where($where)->find();
            if (!$account_info) {
                $this->error('该用户没有管理员权限');
            }
            session('qsdd', $username);
            session('wsdd', $password);
            // 设置登录状态
            $uid = $user_object->auto_login($user_info);

            // 跳转
            //xitong();
            if (0 < $account_info['id']) {
                $this->success('登录成功！', U('Admin/Index/index'));
            } else {
                $this->logout();
            }
        } else {
            $this->display();
        }
    }


    /**
     * 注销
     */
    public function logout()
    {
        session('user_auth', null);
        session('user_auth_sign', null);
        session('user_group', null);
        $this->success('退出成功！', U('login'));
    }

    /**
     * 检测验证码
     * @param integer $id 验证码ID
     * @return boolean 检测结果
     */
    public function google_check_verify($code, $google)
    {
        $ga = new GoogleAuthenticator();
        // 验证验证码和密钥是否相同
        $checkResult = $ga->verifyCode($google, $code, 1);
        return $checkResult;
    }
}
