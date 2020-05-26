<?php

namespace xh\run\api\controller;

use xh\library\functions;
use xh\library\ip;
use xh\library\jwt;
use xh\library\model;
use xh\library\request;
use xh\unity\cog;
use xh\unity\encrypt;
use xh\unity\page;

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

    public function resetPassword()
    {
        $old_password = request::filter('post.old_password');
        $pwd = request::filter('post.password');
        $pwd_repeat = request::filter('post.pwd_repeat');

        if (trim($old_password) == trim($pwd)) functions::json(0, '新旧密码相同');
        //检查密码是否低于6位
        if (strlen($pwd) < 6) functions::json(0, '登录密码不能低于6位');
        if (md5($this->user['pwd']) !== md5(functions::pwd($old_password, $this->user['token']))) functions::json(0, '原始密码输入有误');
        //检查重复输入密码是否正确
        if (md5($pwd) !== md5($pwd_repeat)) functions::json(0, '重复密码输入有误');

        //写入数据库
        $userIn = $this->mysql->update('client_user', [
            'pwd' => functions::pwd($pwd, $this->user['token']),
        ]);
        if ($userIn > 0) {
            //$this->mysql->delete("client_code", "phone={$_SESSION['register_user']['phone']} and typec='register'");
            functions::json(1, '重置密码成功');
        }
        functions::json(0, '重置密码失败');
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

        $checkuser = $this->mysql->query('client_user', "username='{$this->checktoken['sub']}' and is_mashang=1 and status=1", 'id,username,phone,money');

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
            functions::json(0, '请选择绑定类型!');
        }
        if ($bank_type == 1) {
            //支付宝
            $alipay_name = request::filter('post.name', '', 'htmlspecialchars');
            //账号
            $alipay_content = request::filter('post.card', '', 'htmlspecialchars');
            if (empty($alipay_name) || empty($alipay_content)) functions::json(0, '支付宝姓名或账号不能为空!');
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
            if (empty($bank_name) || empty($bank) || empty($card)) functions::json(0, '银行卡信息有误,请填写正确!');
            $edit['bank'] = json_encode(['type' => 2, 'name' => $bank_name, 'card' => $card, 'bank' => $bank]);
        }

        $this->mysql->update("client_user", $edit, "id={$this->user['id']}");
        functions::json(1, '银行信息设置成功!');
    }

    public function automaticOrder()
    {

        $uid = $this->user['id'];
        $status = request::filter('post.status');
        $where = "user_id={$uid}";
        if($status){
            $where .= " and status={$status}";
        }
        $result = page::conduct('client_paofen_automatic_orders', request::filter('get.page'), $this->perPage, $where, 'id,trade_no,creation_time,amount,status', 'id', 'desc');

        foreach ($result['result'] as &$v){
            $v['creation_time'] = date('Y-m-d H:i:s',$v['creation_time']);
            $v['status_name'] = $v['status'] == 2 ? '未支付' : ($v['status'] == 3 ? '订单超时' : '已支付');
        }
        functions::json(1, '获取成功',$result);
    }

    public function chargeOrder()
    {

        $where="uid =".$this->user['id'];
        $status = [1=>'充值', 2=>'扣款'];
        $result = page::conduct('user_paylog', request::filter('get.page'), $this->perPage, $where, null, 'id', 'desc');
        foreach ($result['result'] as &$v){
            $v['time'] = date('Y-m-d H:i:s',$v['time']);
            $v['status_name'] = $status[$v['status']];
        }
        functions::json(1, '获取成功',$result);
    }

    public function withdraw()
    {

        $where="uid =".$this->user['id'];
        $status = [1=>'充值', 2=>'扣款'];
        $result = page::conduct('user_paylog', request::filter('get.page'), $this->perPage, $where, null, 'id', 'desc');
        foreach ($result['result'] as &$v){
            $v['time'] = date('Y-m-d H:i:s',$v['time']);
            $v['status_name'] = $status[$v['status']];
        }
        functions::json(1, '获取成功',$result);
    }

    //收款码
    public function automatic(){
        $this->review('paofen_auto');
        $type = request::filter('get.type', '', 'htmlspecialchars');
        //筛选
        $where = '';
            $list = [1, 2, 3, 4, 5, 6, 7, 8];
            if (in_array($type, $list)) {
                $where .= "and type = {$type}";
            } else {
                unset($_SESSION['SERVICE_ACCOUNT']['WHERE']);
            }

        //     $result = page::conduct('service_account', request::filter('get.page'), 10, $where, null, 'id', 'asc');
        $result = page::conduct('client_paofen_automatic_account', request::filter('get.page'), $this->perPage, "user_id={$this->user['id']} " . $where, null, 'id', 'desc');
        //获取城市
        $areaList = $this->mysql->query('city');
        $areaStr = [];
        foreach ($areaList as $bk => $bv) {
            $areaStr[$bv['id']]=$bv['cityname'];
        }

        //获取银行id（简称）
        $bankList = $this->mysql->query('bank_id');
        $bankStr = [];
        foreach ($bankList as $bk => $bv) {
            $bankStr[$bv['bank_id']] = $bv['bank_name'];
        }
        $type= [1=> '支付宝', 2=>'微信', 3=>'其他'];


        $paofen_accounts = $this->mysql->select("select count(id) as count, paofen_id from {$this->prefix}client_paofen_automatic_orders   where status=4 and user_id={$this->user['id']} group by paofen_id");
        $accounts = $this->changeArr($paofen_accounts, 'paofen_id', 'count');

        foreach ($result['result'] as &$v){
            $v['bank_name'] = isset($bankStr[$v['bank_id']]) ? $bankStr[$v['bank_id']] : '';
            $v['city_name'] = isset($bankStr[$v['area']]) ? $bankStr[$v['area']] : '';
            $v['type_name'] = isset($type[$v['type']]) ? $type[$v['type']] : '';
            $v['total_pens'] = isset($accounts[$v['id']]) ? $accounts[$v['id']] : 0;
        }
        functions::json(1, '获取成功',$result);
    }

    //添加收款码
    public function addAutomatic(){
        $name = request::filter('post.name');
        if (empty($name)) functions::json(0, '参数有误');
        if(empty($_FILES['avatar']['tmp_name']))functions::json(0, '参数有误');
        $ewm_url = functions::checkCode($_FILES['avatar']['tmp_name']);
        if ($ewm_url) {
            //添加支付宝通道
            //检测当前拥有多少条通道
            $find_paofen_auto_count = $this->mysql->select("select count(id) as count from " . DB_PREFIX . "client_paofen_automatic_account where user_id={$this->user['id']}")[0]['count'];
            $swrc = $this->review('paofen_auto');
            if ($swrc['quantity'] != 0) {
                if ($find_paofen_auto_count >= $swrc['quantity']) functions::json(0, '您当前只有' . $swrc['quantity'] . '条通道,无法再继续新增!');
            }

            $type = 1;

            if($type == 3){

                $typename = request::filter('get.typename', ' ', 'htmlspecialchars');
            }else{

                $typename = 0;
            }

            if($type == 4){

                $account = request::filter('get.account', ' ', 'htmlspecialchars');
                $pid = request::filter('get.pid', ' ', 'htmlspecialchars');
                $ewm_url = 0;
                $typename = 0;
                $gathering_name=0;
                $cardid=0;
                $bank_id=0;
                $account_no=0;

            }else if($type == 5){
                $gathering_name = request::filter('get.gathering_name', ' ', 'htmlspecialchars');
                $cardid = request::filter('get.cardid', ' ', 'htmlspecialchars');
                $bank_id = request::filter('get.bank_id', ' ', 'htmlspecialchars');
                $account_no = request::filter('get.account_no', ' ', 'htmlspecialchars');

                $ewm_url = 0;
                $typename = 0;
                $account = 0;
                $pid=0;
            }else{
                $account = 0;
                $typename = 0;
                $pid=0;
                $gathering_name=0;
                $cardid=0;
                $bank_id=0;
                $account_no=0;
            }
            $key_id = strtoupper(substr(md5(mt_rand((mt_rand(1000, 9999) + mt_rand(1000, 9999)), mt_rand(1000000, 99999999))), 0, 18));
            $insert = [
                'name'              => $name,
                'status'            => 4,
                'login_time'        => 0,
                'heartbeats'        => 0,
                'active_time'       => 0,
                'user_id'           => $this->user['id'],
                'key_id'            => $key_id,
                'training'          => 1,
                'receiving'         => 1,
                'ewm_url'         => $ewm_url,
                'type'         => $type,
                'typename'         => $typename,
                'account'         => $account,
                'pid'         => $pid,
                'gathering_name'     => $gathering_name,
                'cardid'       => $cardid,
                'bank_id'     => $bank_id,
                'account_no'    => $account_no,
                'account_user_id' => '',
                'app_user' => '',
                'max_dd' => 0,
                'dy_name' => ''
            ];
            $in = $this->mysql->insert("client_paofen_automatic_account", $insert);

            if ($in > 0) {
                functions::json(1, '上传成功');
            }
            functions::json(0, '上传失败!');

        } else {
            functions::json(0, '二维码解析失败，请重新上传!', array('img' => 0));
        }
    }



}