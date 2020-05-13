<?php

namespace xh\run\agent\controller;

use xh\library\model;
use xh\library\mysql;
use xh\library\view;
use xh\library\session;
use xh\library\url;
use xh\unity\page;
use xh\library\ip;
use xh\library\request;
use xh\library\functions;

class panel
{

    private $mysql;

    //初始化
    public function __construct()
    {
        (new model())->load('user', 'session')->check();
        $this->mysql = new mysql();

        $checkuser = $this->mysql->query("client_user", "id={$_SESSION['MEMBER']['uid']}")[0];
        if ($checkuser['is_agent'] == 0) {
            unset($_SESSION['MEMBER']);
            unset($_SESSION);
            url::address(url::s('agent/user/login'), '您不是代理，请重新登录!', 0);

        }
    }

    public function home()
    {

        //查询我的服务订单五条信息
        $service_order = $this->mysql->query("service_order", "user_id={$_SESSION['MEMBER']['uid']}", null, "id", "desc", "0,5");
        //查询提现5条
        $withdrawal = $this->mysql->query("client_withdraw", "user_id={$_SESSION['MEMBER']['uid']}", null, "id", "desc", "0,5");

        new view("panel/home", ['mysql' => $this->mysql, 'service_order' => $service_order, 'withdrawal' => $withdrawal]);
    }

    public function index()
    {
        //查询我的服务订单五条信息
        $service_order = $this->mysql->query("service_order", "user_id={$_SESSION['MEMBER']['uid']}", null, "id", "desc", "0,5");
        //查询提现5条
        $withdrawal = $this->mysql->query("client_agentwithdraw", "user_id={$_SESSION['MEMBER']['uid']}", null, "id", "desc", "0,5");

        $where = "agent_id =" . $_SESSION['MEMBER']['uid'];
        $member = page::conduct('agent_huoli_log', request::filter('get.page'), 10, $where, null, 'id', 'desc', "0,10");
        new view('panel/index', [
            'mysql' => $this->mysql,
            'member' => $member
        ]);
    }

    //会员列表
    public function userlist()
    {
        $member_id = request::filter('get.member_id');
        if (!empty($member_id)) $where = "id like '%{$member_id}%' or username like '%{$member_id}%' or phone like '%{$member_id}%' and";
        $where = "level_id =" . $_SESSION['MEMBER']['uid'] . " and is_mashang=1 and status=1";
        $member = page::conduct('client_user', request::filter('get.page'), 10, $where, null, 'id', 'asc');
        $groups = $this->mysql->query("client_group");
        new view('panel/userlist', [
            'mysql' => $this->mysql,
            'member' => $member,
            'groups' => $groups,
            'userid' => $member_id
        ]);
    }

    public function offrobin()
    {
        $member_id = request::filter('post.member_id');
        $off = 2;
        $where = "user_id =" . $member_id;
        $data = ['training' => $off];
        $result = $this->mysql->update('client_paofen_automatic_account', $data, $where);
        if ($result > 0) functions::json(200, '安全下线成功!');
        functions::json(-2, '下线失败!');
    }

    public function openrobin()
    {
        $member_id = request::filter('post.member_id');
        $off = 1;
        $where = "user_id =" . $member_id;
        $data = ['training' => $off];
        $result = $this->mysql->update('client_paofen_automatic_account', $data, $where);
        if ($result > 0) functions::json(200, '安全上线成功!');
        functions::json(-2, '上线失败!');
    }

    public function delquotient()
    {
        $member_id = request::filter('post.member_id');
        $where = "id =" . $member_id;
        $result = $this->mysql->update('client_user', [
            'status' => 2
        ], $where);
        if ($result > 0) functions::json(200, '删除成功!');
        functions::json(-2, '删除失败!');

    }

    public function editdeposit()
    {
        $id = request::filter('get.id');
        $result = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($result)) url::address(url::s('agent/panel/userlist'), '识别会员失败', 1);

        //权限查询
        $groups = $this->mysql->query("client_group");
        //加载视图
        new view('panel/editdeposit', [
            'result' => $result,
            'groups' => $groups
        ]);

    }
    public function editbalance()
    {
        $id = request::filter('get.id');
        $result = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($result)) url::address(url::s('agent/panel/userlist'), '识别会员失败', 1);

        //权限查询
        $groups = $this->mysql->query("client_group");
        //加载视图
        new view('panel/editbalance', [
            'result' => $result,
            'groups' => $groups
        ]);

    }
    public function editbalanceResult()
    {

        $id = intval(request::filter("post.id"));
        $username = strip_tags(request::filter('post.username'));
        $yajin = request::filter('post.balance');

        //判断用户名是否存在
        $user = $this->mysql->query("client_user", "username='{$username}'")[0];
        //判断手机是否存在
        $inArray = ['balance' => $yajin];

        $Insert = $this->mysql->update("client_user", $inArray, "id={$id}");

        // if ($Insert > 0) functions::json(200,'修改成功!自行关闭窗口');
        if ($Insert > 0) {

            functions::json(200, '修改成功');
            exit;
        } else {
            functions::json(100, '当前没有做任何修改');
            exit;
        }
    }
    public function editpositResult()
    {

        $id = intval(request::filter("post.id"));
        $username = strip_tags(request::filter('post.username'));
        $yajin = request::filter('post.yajin');

        //判断用户名是否存在
        $user = $this->mysql->query("client_user", "username='{$username}'")[0];
        //判断手机是否存在
        $inArray = ['yajin' => $yajin];

        $Insert = $this->mysql->update("client_user", $inArray, "id={$id}");

        // if ($Insert > 0) functions::json(200,'修改成功!自行关闭窗口');
        if ($Insert > 0) {

            functions::json(200, '修改成功');
            exit;
        } else {
            functions::json(100, '当前没有做任何修改');
            exit;
        }
    }

    //添加会员
    public function useradd()
    {
        $id = request::filter('get.id');
        $result = $this->mysql->query("client_user", "id={$id}");
        if ($result) $result = $result[0];
        //   if (!is_array($result)) url::address(url::s('agent/panel/userlist'), '识别会员失败', 1);
        //权限查询
        $groups = $this->mysql->query("client_group");
        //加载视图
        new view('panel/useradd', [
            'result' => $result,
            'groups' => $groups
        ]);
    }


    public function userddsave()
    {

        $username = strip_tags(request::filter('post.username'));
        $pwd = request::filter('post.pwd');
        $group_id = $_SESSION['MEMBER']['group']['id'];
        $phone = request::filter('post.phone');
        $level_id = $_SESSION['MEMBER']['uid'];
        $is_mashang = request::filter('post.is_mashang');
        //  $balance = floatval(request::filter('get.balance'));
        //  $yajin = floatval(request::filter('get.yajin'));
        if (strlen($username) < 5) functions::json(-1, '用户名不能为空或小于5位');
        //判断用户名是否存在
        $user = $this->mysql->query("client_user", "username='{$username}'")[0];
        if (is_array($user)) functions::json(-3, '当前用户名已经存在,请更换重试');
        //判断手机是否存在
        $find_phone = $this->mysql->query("client_user", "phone={$phone}")[0];
        if (is_array($find_phone)) functions::json(-3, '当前手机已经存在,请更换重试');
        //判断密码
        if (strlen($pwd) < 6) functions::json(-1, '密码不能为空且不能小于6位');
        //权限组
        $group = $this->mysql->query("client_group", "id={$group_id}")[0];
        if (!is_array($group)) functions::json(-2, '权限组分配失败,请重新选择');
        //手机号
        if (!functions::isMobile($phone)) functions::json(-1, '手机号输入有误,请检查手机号是否输入正确');
        //生成密码盐值
        $token = substr(md5(mt_rand(10000, mt_rand(100000, 9999999))), 0, 9);
        //判断上级ID是否存在
        if ($level_id > 0) {
            $find_level = $this->mysql->query("client_user", "id={$level_id}")[0];
            if (!is_array($find_level)) functions::json(-3, '上级ID填写有误,没有找到该会员ID');
            //检测是否有上级
            if ($find_level['level_id'] != 0) functions::json(-3, '上级ID填写有误,该上级会员不支持直接在后台添加下级');
        }
        $Insert = $this->mysql->insert("client_user", [
            'username' => $username,
            'phone' => $phone,
            'pwd' => functions::pwd($pwd, $token),
            'token' => $token,
            'yajin' => '0',
            'ip' => '8.8.8.8',
            'group_id' => $group_id,
            'level_id' => $level_id,
            'login_time' => 0,
            'key_id' => $key_id = strtoupper(substr(md5(mt_rand(100000, 999999)), 0, 14)),
            'avatar' => 0,
            'is_agent' => 0,
            'is_pankou' => 0,
            'is_mashang' => $is_mashang
        ]);

        if ($Insert > 0) functions::json(200, '添加成功!请到会员列表设置费率');

        functions::json(-3, '添加失败,请检查资料是否有误');
    }

    //余额编辑
    public function moneyedit()
    {
        $id = request::filter('get.id');
        $result = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($result)) url::address(url::s('agent/panel/userlist'), '识别会员失败', 1);

        //权限查询
        $groups = $this->mysql->query("client_group");
        //加载视图
        new view('panel/moneyedit', [
            'result' => $result,
            'groups' => $groups
        ]);
    }

    public function moneyeditResult()
    {

        $id = intval(request::filter("post.id"));
        $username = strip_tags(request::filter('post.username'));
        $money = request::filter('post.money');

        //判断用户名是否存在
        $user = $this->mysql->query("client_user", "username='{$username}'")[0];
        if (is_array($user) && $username != $user['username']) functions::json(-3, '当前用户名已经存在,请更换重试');
        //判断手机是否存在
        $umoney = $user['balance'];
        //判断密码
        if ($money > 0) {
            $smoney = $umoney + $money;
            $inArray['balance'] = $smoney;
        }
        if ($money < 0) {
            $smoney = $umoney - abs($money);
            if ($smoney > 0) {
                $inArray['balance'] = $smoney;
            } else {

                functions::json(300, '用户余额不能为负数');
                exit;
            }
        }

        $Insert = $this->mysql->update("client_user", $inArray, "id={$id}");


        // if ($Insert > 0) functions::json(200,'修改成功!自行关闭窗口');
        if ($Insert > 0) {

            //写到交易记录
            $this->mysql->insert("client_usermoney_log", [
                'user_id' => $id,
                'username' => $username,
                'agent_id' => $_SESSION['MEMBER']['uid'],
                'info' => '[操作金额]：' . $money . '元，操作后用户余额：' . $smoney,
                'addtime' => time(),
                'ip' => ip::get()

            ]);


            functions::json(200, '操作成功');

        } else {


            functions::json(100, '当前没有做任何修改');


        }
    }


    //代理操作客户的余额日志
    public function moneylog()
    {

        $member_id = request::filter('get.member_id');
        $where = '';
        if (!empty($member_id)) $where = "id like '%{$member_id}%' or username like '%{$member_id}%' or phone like '%{$member_id}%'";

        $member = page::conduct('client_usermoney_log', request::filter('get.page'), 10, $where, null, 'id', 'desc');
        new view('panel/moneylog', [
            'mysql' => $this->mysql,
            'member' => $member
        ]);
    }

    //修改密码
    public function passwordedit()
    {
        $id = request::filter('get.id');
        $result = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($result)) url::address(url::s('agent/panel/userlist'), '识别会员失败', 1);

        //权限查询
        $groups = $this->mysql->query("client_group");
        //加载视图
        new view('panel/passwordedit', [
            'result' => $result,
            'groups' => $groups
        ]);
    }

    public function passwordeditResult()
    {

        $id = intval(request::filter("post.id"));
        $username = strip_tags(request::filter('post.username'));
        $pwd = request::filter('post.pwd');
        $rebate = request::filter('post.mashang_rebate');

        //判断用户名是否存在
        $user = $this->mysql->query("client_user", "username='{$username}'")[0];
        if (is_array($user) && $username != $user['username']) functions::json(-3, '当前用户名已经存在,请更换重试');
        //判断手机是否存在

        //判断密码
        if (!empty($pwd)) {
            if (strlen($pwd) < 6) functions::json(-1, '密码不能为空且不能小于6位');
            //生成密码盐值
            $token = substr(md5(mt_rand(10000, mt_rand(100000, 9999999))), 0, 9);
            $inArray['pwd'] = functions::pwd($pwd, $token);
            $inArray['token'] = $token;
        }
        if($rebate != $user['mashang_rebate']){
            if($rebate>=100) functions::json(-1, '码商返点小于100%');
            $inArray['mashang_rebate'] = $rebate;
        }

        $Insert = $this->mysql->update("client_user", $inArray, "id={$id}");

        // if ($Insert > 0) functions::json(200,'修改成功!自行关闭窗口');
        if ($Insert > 0) {

            functions::json(200, '修改成功');
            exit;
        } else {


            functions::json(100, '当前没有做任何修改');
            exit;
        }
    }

    //费率设置
    public function feilv2()
    {
        $id = request::filter('get.id');
        $result = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($result)) url::address(url::s('agent/panel/userlist'), '识别会员失败', 1);

        //权限查询
        $groups = $this->mysql->query("client_group");
        //加载视图
        new view('panel/feilv', [
            'result' => $result,
            'groups' => $groups
        ]);
    }

    public function feilv()
    {
        $id = request::filter('get.id');
        $uid = $_SESSION['MEMBER']['uid'];
        $where = 'uid = ' . $id . ' and parent_id = ' . $uid;
        $info = $this->mysql->query('agent_rate', $where);
        if ($_REQUEST['type'] == 'edit') {
            $group_id = $_SESSION['MEMBER']['group_id'];
            $result = $this->mysql->query("client_group", "id={$group_id}")[0];
            $data = json_decode($result['authority'], true);
            $wechat_cost = $data['wechat_auto']['cost'];
            $wechatdy_cost = $data['wechat_auto']['cost'];
            $wechatsj_cost = $data['wechat_auto']['cost'];
            $alipaygm_cost = $data['wechat_auto']['cost'];
            $alipay_cost = $data['wechat_auto']['cost'];
            $yunshanfu_cost = $data['wechat_auto']['cost'];
            $lakala_cost = $data['wechat_auto']['cost'];
            $taobaodf_cost = $data['wechat_auto']['cost'];
            $shouqianba_cost = $data['wechat_auto']['cost'];
            $pddgm_cost = $data['wechat_auto']['cost'];
            $nxyswx_cost = $data['wechat_auto']['cost'];
            $bank_cost = $data['bank_auto']['cost'];
            $paofen_cost = $data['paofen_auto']['cost'];


            if ($_REQUEST['wechat_auto'] > $wechat_cost) {

                functions::json(100, '微信费率不能大于总平台的费率（总平台费率 ' . $wechat_cost . '）');
                exit;
            }

            if ($_REQUEST['wechatdy_auto'] > $wechatdy_cost) {

                functions::json(100, '微信店员费率不能大于总平台的费率（总平台费率' . $wechatdy_cost . '）');
                exit;
            }

            if ($_REQUEST['wechatsj_auto'] > $wechatsj_cost) {
                functions::json(100, '微信商户费率不能大于总平台的费率（总平台费率 ' . $wechatsj_cost . '）');
                exit;
            }

            if ($_REQUEST['alipaygm_auto'] > $alipaygm_cost) {
                functions::json(100, '支付宝固码费率不能大于总平台的费率（总平台费率{' . $alipaygm_cost . '）');
                exit;

            }


            if ($_REQUEST['alipay_auto'] > $alipay_cost) {

                functions::json(100, '支付宝转账费率不能大于总平台的费率（总平台费率' . $alipay_cost . '）');
                exit;
            }

            if ($_REQUEST['bank_auto'] > $bank_cost) {
                functions::json(100, '微信/支付宝转卡费率不能大于总平台的费率（总平台费率' . $bank_cost . '）');
                exit;

            }

            if ($_REQUEST['yunshanfu_auto'] > $yunshanfu_cost) {
                functions::json(100, '云闪付费率不能大于总平台的费率（总平台费率' . $yunshanfu_cost . '）');
                exit;

            }

            if ($_REQUEST['nxyswx_auto'] > $nxyswx_cost) {
                functions::json(100, '农信易扫费率不能大于总平台的费率（总平台费率' . $nxyswx_cost . '）');
                exit;

            }

            if ($_REQUEST['shouqianba_auto'] > $shouqianba_cost) {
                functions::json(100, '收钱吧费率不能大于总平台的费率（总平台费率' . $shouqianba_cost . '）');
                exit;

            }

            if ($_REQUEST['taobaodf_auto'] > $taobaodf_cost) {
                functions::json(100, '淘宝代付费率不能大于总平台的费率（总平台费率' . $taobaodf_cost . '）');
                exit;

            }

            if ($_REQUEST['pddgm_auto'] > $pddgm_cost) {
                functions::json(100, '拼多多固码费率不能大于总平台的费率（总平台费率' . $pddgm_cost . '）');
                exit;

            }

            if ($_REQUEST['lakala_auto'] > $lakala_cost) {
                functions::json(100, '拉卡拉费率不能大于总平台的费率（总平台费率' . $lakala_cost . '）');
                exit;

            }
            if ($_REQUEST['paofen_auto'] > $paofen_cost) {
                functions::json(100, '跑分费率不能大于总平台的费率（总平台费率' . $paofen_cost . '）');
                exit;

            }


            $insert['wechat_auto'] = $_REQUEST['wechat_auto'];
            $insert['wechatdy_auto'] = $_REQUEST['wechatdy_auto'];
            $insert['wechatsj_auto'] = $_REQUEST['wechatsj_auto'];
            $insert['alipaygm_auto'] = $_REQUEST['alipaygm_auto'];
            $insert['alipay_auto'] = $_REQUEST['alipay_auto'];
            $insert['bank_auto'] = $_REQUEST['bank_auto'];
            $insert['yunshanfu_auto'] = $_REQUEST['yunshanfu_auto'];
            $insert['lakala_auto'] = $_REQUEST['lakala_auto'];
            $insert['nxyswx_auto'] = $_REQUEST['nxyswx_auto'];
            $insert['nxysyl_auto'] = $_REQUEST['nxyswx_auto'];
            $insert['taobaodf_auto'] = $_REQUEST['taobaodf_auto'];
            $insert['shouqianba_auto'] = $_REQUEST['shouqianba_auto'];
            $insert['pddgm_auto'] = $_REQUEST['pddgm_auto'];
            $insert['paofen_auto'] = $_REQUEST['paofen_auto'];
            $json_encode_data = json_encode($insert);
            if (!$info) {
                $insert_data['parent_id'] = $uid;
                $insert_data['uid'] = $_REQUEST['id'];
                $insert_data['authority'] = $json_encode_data;
                $insert_data['create_time'] = time();
                //不存在新建
                $this->mysql->insert('agent_rate', $insert_data);
            } else {
                //存在就更新
                $update_data['authority'] = $json_encode_data;
                $update_data['update_time'] = time();
                $this->mysql->update('agent_rate', $update_data, $where);
            }
            functions::json(200, '修改成功');

            exit;

        }
        $result = json_decode($info[0]['authority'], true);
        //查询所有的交易记录
        new view('panel/feilv', [
            'result' => $result,
            'mysql' => $this->mysql,
        ]);
    }


    //订单列表
    public function order()
    {

        $user = $this->mysql->query("client_user", "level_id='{$_SESSION['MEMBER']['uid']}'");

        $wxIdsArr = array_column($user, 'id');

        //去重
        $wxIds = array_unique($wxIdsArr);
        //将id组转化成字符串
        $userIdInStr = implode(",", $wxIds);
        // var_dump($userIdInStr);


        $where = "status = 4 and user_id in ($userIdInStr) and ";
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');
        $start_time = request::filter('get.start_time', '', 'htmlspecialchars');
        $end_time = request::filter('get.end_time', '', 'htmlspecialchars');

        //wechat
        if ($sorting == 'alipay') {
            if ($code != '' && $_SESSION['ALIPAY']['ORDER']['WHERE'] == '') {
                $code_arr = explode(",", $code);
                if (is_array($code_arr)) {
                    $wecaht_where = '';
                    for ($i = 0; $i < count($code_arr); $i++) {
                        $wecaht_where .= ' or alipay_id=' . $code_arr[$i];
                    }

                    $_SESSION['ALIPAY']['ORDER']['WHERE'] .= '(' . trim(trim($wecaht_where), 'or') . ')';
                }
            }

            if ($_GET['locking'] == 'closed') {
                unset($_SESSION['ALIPAY']['ORDER']['WHERE']);
            }
        }


        $where = $where . (isset($_SESSION['ALIPAY']['ORDER']['WHERE']) ? $_SESSION['ALIPAY']['ORDER']['WHERE'] : '');
        $where = trim(trim($where), 'and');

        //排序
        if ($sorting == 'status') {
            if ($code < 1) $code = 0;
            if ($code <= 4) $where .= ' and status=' . $code;
            if ($code > 4) $code = 0;
        }
        //callback
        if ($sorting == 'callback') {
            if ($code < 0) $code = 0;
            if ($code <= 1) $where .= ' and callback_status=' . $code;
            if ($code > 1) $code = -1;
        }
        //订单号
        if ($sorting == 'trade_no') {
            if ($code != '') {
                $code = trim($code);
                $where .= " and (trade_no like '%{$code}%' or out_trade_no like '%{$code}%')";
            }
        }
        if ($start_time && $end_time) {
            $where .= " and creation_time BETWEEN " . $start_time . " AND " . $end_time;
        }
        //查询自己的所有支付宝

        $tongdao = request::filter('get.tongdao', 'alipaygm', 'htmlspecialchars');
        if ($tongdao) {

            $wechat = $this->mysql->query("client_" . $tongdao . "_automatic_account", "name != '0' and user_id={$_SESSION['MEMBER']['uid']}");

            $result = page::conduct('client_' . $tongdao . '_automatic_orders', request::filter('get.page'), 15, $where, null, 'id', 'desc');

        } else {
            $wechat = $this->mysql->query("client_wechat_automatic_account", "name != '0' and user_id={$_SESSION['MEMBER']['uid']}");

            $result = page::conduct('client_wechat_automatic_orders', request::filter('get.page'), 15, $where, null, 'id', 'desc');
        }

        new view('panel/order', [
            'result' => $result,
            'mysql' => $this->mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ],
            'wechat' => $wechat,
            'where' => $where
        ]);
    }

    //订单列表 没付款
    public function orderweifu()
    {

        $user = $this->mysql->query("client_user", "level_id='{$_SESSION['MEMBER']['uid']}'");

        $wxIdsArr = array_column($user, 'id');

        //去重
        $wxIds = array_unique($wxIdsArr);
        //将id组转化成字符串
        $userIdInStr = implode(",", $wxIds);
        // var_dump($userIdInStr);


        $where = "status != 4 and user_id in ($userIdInStr) and ";
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');
        $start_time = request::filter('get.start_time', '', 'htmlspecialchars');
        $end_time = request::filter('get.end_time', '', 'htmlspecialchars');

        //wechat
        if ($sorting == 'alipay') {
            if ($code != '' && $_SESSION['ALIPAY']['ORDER']['WHERE'] == '') {
                $code_arr = explode(",", $code);
                if (is_array($code_arr)) {
                    $wecaht_where = '';
                    for ($i = 0; $i < count($code_arr); $i++) {
                        $wecaht_where .= ' or alipay_id=' . $code_arr[$i];
                    }

                    $_SESSION['ALIPAY']['ORDER']['WHERE'] .= '(' . trim(trim($wecaht_where), 'or') . ')';
                }
            }

            if ($_GET['locking'] == 'closed') {
                unset($_SESSION['ALIPAY']['ORDER']['WHERE']);
            }
        }


        $where = $where . (isset($_SESSION['ALIPAY']['ORDER']['WHERE']) ? $_SESSION['ALIPAY']['ORDER']['WHERE'] : '');
        $where = trim(trim($where), 'and');

        //排序
        if ($sorting == 'status') {
            if ($code < 1) $code = 0;
            if ($code <= 4) $where .= ' and status=' . $code;
            if ($code > 4) $code = 0;
        }
        //callback
        if ($sorting == 'callback') {
            if ($code < 0) $code = 0;
            if ($code <= 1) $where .= ' and callback_status=' . $code;
            if ($code > 1) $code = -1;
        }
        //订单号
        if ($sorting == 'trade_no') {
            if ($code != '') {
                $code = trim($code);
                $where .= " and (trade_no like '%{$code}%' or out_trade_no like '%{$code}%')";
            }
        }


        if ($start_time && $end_time) {
            $where .= " and creation_time BETWEEN " . $start_time . " AND " . $end_time;
        }
        //查询自己的所有支付宝
        $tongdao = request::filter('get.tongdao', 'alipaygm', 'htmlspecialchars');
        if ($tongdao) {

            $wechat = $this->mysql->query("client_" . $tongdao . "_automatic_account", "name != '0' and user_id={$_SESSION['MEMBER']['uid']}");

            $result = page::conduct('client_' . $tongdao . '_automatic_orders', request::filter('get.page'), 15, $where, null, 'id', 'desc');

        } else {
            $wechat = $this->mysql->query("client_wechat_automatic_account", "name != '0' and user_id={$_SESSION['MEMBER']['uid']}");

            $result = page::conduct('client_wechat_automatic_orders', request::filter('get.page'), 15, $where, null, 'id', 'desc');
        }
        new view('panel/orderweifu', [
            'result' => $result,
            'mysql' => $this->mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ],
            'wechat' => $wechat,
            'where' => $where
        ]);
    }

    //会员列表
    public function dailihuoli()
    {

        $member_id = request::filter('get.member_id');
        if (!empty($member_id)) $where = "id like '%{$member_id}%' or username like '%{$member_id}%' or phone like '%{$member_id}%'";

        $where = "agent_id =" . $_SESSION['MEMBER']['uid'];
        $member = page::conduct('agent_huoli_log', request::filter('get.page'), 10, $where, null, 'id', 'desc');
        $groups = $this->mysql->query("client_group");
        new view('panel/dailihuoli', [
            'mysql' => $this->mysql,
            'member' => $member,
            'groups' => $groups
        ]);
    }


    //修改资料
    public function useredit()
    {
        new view('panel/useredit');
    }

    //修改
    public function editResult()
    {
        //验证码
        $code = intval(request::filter('post.code', '', 'htmlspecialchars'));
        $now_time = time() - 300;
        $find_code = $this->mysql->query("client_code", "phone={$_SESSION['MEMBER']['phone']} and codec={$code} and {$now_time}<get_time and state=1 and typec='edit'")[0];
        // if (!is_array($find_code)) functions::json(-3, '短信验证码不正确');
        //初始化修改参数
        $edit = [];
        $renew = intval(request::filter('post.renew', '', 'htmlspecialchars'));
        if ($renew) {
            $key_id = strtoupper(substr(md5(mt_rand(100000, 999999)), 0, 14));
            $edit['key_id'] = $key_id;
        }
        $pwd = request::filter('post.pwd', '', 'htmlspecialchars');
        if (!empty($pwd)) {
            if (strlen($pwd) < 6) functions::json(-1, '密码不能小于6位');
            $edit['pwd'] = functions::pwd($pwd, $_SESSION['MEMBER']['token']);
        }
        $bank_type = request::filter('post.bank_type', '', 'htmlspecialchars');
        if ($bank_type == 1) {
            //支付宝
            $alipay_name = request::filter('post.alipay_name', '', 'htmlspecialchars');
            //账号
            $alipay_content = request::filter('post.alipay_content', '', 'htmlspecialchars');
            if (empty($alipay_name) || empty($alipay_content)) functions::json(-1, '支付宝姓名或账号不能为空!');
            //写入
            $edit['bank'] = json_encode(['type' => 1, 'name' => $alipay_name, 'card' => $alipay_content]);
        }
        if ($bank_type == 2) {
            //姓名
            $bank_name = request::filter('post.bank_name', '', 'htmlspecialchars');
            //银行名称
            $bank = request::filter('post.bank', '', 'htmlspecialchars');
            //账号
            $card = request::filter('post.card', '', 'htmlspecialchars');
            if (empty($bank_name) || empty($bank) || empty($card)) functions::json(-1, '银行卡信息有误,请填写正确!');
            $edit['bank'] = json_encode(['type' => 2, 'name' => $bank_name, 'card' => $card, 'bank' => $bank]);
        }
        $bind_phone = intval(request::filter('post.bind_phone', '', 'htmlspecialchars'));
        $phone = trim(request::filter('post.phone', '', 'htmlspecialchars'));
        if ($bind_phone == 1 && $phone != $_SESSION['MEMBER']['phone']) {
            if (!functions::isMobile($phone)) functions::json(-1, '手机号码输入有误');
            //检测该手机是否已经绑定过了
            $find_phone = $this->mysql->query('client_user', "phone={$phone}")[0];
            if (is_array($find_phone)) functions::json(-2, '该手机已经被它人绑定,如果是您本人手机,请联系客服解决!');
            $edit['phone'] = $phone;
        }

        if (!is_array($edit)) functions::json(-3, '您没有做任何修改哟!');
        $this->mysql->update("client_user", $edit, "id={$_SESSION['MEMBER']['uid']}");
        $this->mysql->delete('client_code', "id={$find_code['id']}");
        functions::json(200, '您的资料已经修改成功啦!');
    }

    //提现
    public function withdraw()
    {
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');

        $where = "user_id={$_SESSION['MEMBER']['uid']}";

        //订单号
        if ($sorting == 'flow_no') {
            if ($code != '') {
                $code = trim($code);
                $where .= " and flow_no={$code}";
            }
        }
        $result = page::conduct('client_withdraw', request::filter('get.page'), 15, $where, null, 'id', 'desc');
        new view('user/withdraw', [
            'result' => $result,
            'mysql' => $this->mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ]
        ]);
    }

    //申请提现
    public function applyWithdraw()
    {
        if (!in_array($_SESSION['MEMBER']['bank']['type'], [1, 2])) exit('<span style="color:red;">您当前没有填写收款方式,请在个人设置里面添加银行卡或支付宝!</span>');
        new view('user/apply_withdraw', [
            'mysql' => $this->mysql
        ]);
    }

    public function rebateSettlement(){

    }
}
 