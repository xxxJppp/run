<?php

namespace xh\run\admin\controller;

use xh\library\session;
use xh\library\model;
use xh\library\url;
use xh\library\mysql;
use xh\library\view;
use xh\unity\page;
use xh\library\request;
use xh\library\functions;
use xh\unity\upload;
use xh\unity\sms;


class member
{
    //构造一个mysql请求
    private $mysql;

    //权限验证
    protected function powerLogin($Mid)
    {
        session::check();
        if (!(new model())->load('user', 'authority')->moduleValidate($Mid)) {
            url::address(url::s('admin/index/home'), '您没有权限访问', 3);
        }
        $this->mysql = new mysql();

    }

    //用户列表
    //权限ID：20
    public function index()
    {
        $this->powerLogin(20);
        $member_id = request::filter('get.member_id');
        if (!empty($member_id)) $where = "id like '%{$member_id}%' or username like '%{$member_id}%' or phone like '%{$member_id}%'";
        $where .= "is_agent = 0 and is_pankou=0";
        $member = page::conduct('client_user', request::filter('get.page'), 10, $where, null, 'id', 'asc');
        $groups = $this->mysql->query("client_group");
        new view('member/index', [
            'mysql' => $this->mysql,
            'member' => $member,
            'groups' => $groups
        ]);
    }

    public function daili()
    {
        $this->powerLogin(20);

        $username = trim(request::filter('get.username'));
        $where = 'is_agent = 1';
        if ($username) {
            $where .= " and username = '{$username}'";
        }
        $member = page::conduct('client_user', request::filter('get.page'), 10, $where, null, 'id', 'desc');
        $groups = $this->mysql->query("client_group");
        new view('member/daili', [
            'mysql' => $this->mysql,
            'member' => $member,
            'groups' => $groups,
            'username' => $username
        ]);
    }

    public function offrobin()
    {
        $this->powerLogin(20);
        $member_id = request::filter('post.member_id');
        $off = 2;
        $where = "user_id in (" . $member_id . ")";
        $data = ['training' => $off];
        $result = $this->mysql->update('client_paofen_automatic_account', $data, $where);
        if ($result > 0) functions::json(200, '安全下线成功!');
        functions::json(-2, '下线失败!');
    }

    public function openrobin()
    {
        $this->powerLogin(20);
        $member_id = request::filter('post.member_id');
        $off = 1;
        $where = "user_id in (" . $member_id . ")";
        $data = ['training' => $off];
        $result = $this->mysql->update('client_paofen_automatic_account', $data, $where);
        if ($result > 0) functions::json(200, '安全上线成功!');
        functions::json(-2, '上线失败!');
    }

    public function daili2()
    {
        $this->powerLogin(20);

        $member_id = request::filter('get.member_id');

        if (!empty($member_id)) $where = "id like '%{$member_id}%' or username like '%{$member_id}%' or phone like '%{$member_id}%' and";
        $where .= " is_agent = 1";
        $member = page::conduct('client_user', request::filter('get.page'), 10, $where, null, 'id', 'asc');
        $groups = $this->mysql->query("client_group");
        new view('member/daili2', [
            'mysql' => $this->mysql,
            'member' => $member,
            'groups' => $groups
        ]);
    }

    public function mashang()
    {
        $this->powerLogin(20);

        $username = trim(request::filter('get.username'));
        $agent_id = trim(request::filter('get.agent_id'));

        $where = 'is_mashang = 1 and status=1';

        if ($username) {
            $where .= " and username = '{$username}'";
        }

        if ($agent_id) {
            $where .= " and level_id = '{$agent_id}'";
        }

        $member = page::conduct('client_user', request::filter('get.page'), 10, $where, null, 'id', 'desc');
        $groups = $this->mysql->query("client_group");
        new view('member/mashang', [
            'mysql' => $this->mysql,
            'member' => $member,
            'groups' => $groups,
            'username' => $username
        ]);
    }

    public function mashang2()
    {
        $this->powerLogin(20);

        $member_id = request::filter('get.member_id');

        if (!empty($member_id)) $where = "id like '%{$member_id}%' or username like '%{$member_id}%' or phone like '%{$member_id}%' and";
        $where .= " is_mashang = 1";
        $member = page::conduct('client_user', request::filter('get.page'), 10, $where, null, 'id', 'asc');
        $groups = $this->mysql->query("client_group");
        new view('member/mashang2', [
            'mysql' => $this->mysql,
            'member' => $member,
            'groups' => $groups
        ]);
    }

    public function pankou()
    {
        $this->powerLogin(20);

        $username = trim(request::filter('get.username'));

        $where = " is_pankou = 1";
        if ($username) {
            $where .= " and username = '{$username}'";
        }
        $member = page::conduct('client_user', request::filter('get.page'), 10, $where, null, 'id', 'desc');
        $groups = $this->mysql->query("client_group");
        new view('member/pankou', [
            'mysql' => $this->mysql,
            'member' => $member,
            'groups' => $groups,
            'username' => $username
        ]);
    }


    public function editdeposit()
    {
        $this->powerLogin(20);
        $id = request::filter('get.id');
        $type = request::filter('get.type');
        $result = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($result)) url::address(url::s('agent/panel/userlist'), '识别会员失败', 1);

        //权限查询
        $groups = $this->mysql->query("client_group");
        //加载视图
        new view('member/editdeposit', [
            'result' => $result,
            'groups' => $groups
        ]);

    }

    public function editpositResult()
    {
        $this->powerLogin(20);
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

    //修改密码
    public function passwordedit()
    {
        $this->powerLogin(20);
        $id = request::filter('get.id');
        $result = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($result)) url::address(url::s('agent/panel/userlist'), '识别会员失败', 1);

        //权限查询
        $groups = $this->mysql->query("client_group");
        //加载视图
        new view('member/passwordedit', [
            'result' => $result,
            'groups' => $groups
        ]);
    }

    public function passwordeditResult()
    {

        $this->powerLogin(20);
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
        if ($rebate != $user['mashang_rebate']) {
            if ($rebate >= 100) functions::json(-1, '码商返点小于100%');
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


    //权限ID：20
    public function add()
    {
        $this->powerLogin(20);
        $username = strip_tags(request::filter('post.username'));
        $pwd = request::filter('post.pwd');
        $group_id = request::filter('post.group_id');
        $phone = trim(request::filter('post.phone'));
        $level_id = intval(request::filter('post.level_id'));

        $is_agent = intval(request::filter('post.is_agent'));
        $is_pankou = intval(request::filter('post.is_pankou'));
        $is_mashang = intval(request::filter('post.is_mashang'));

        if (strlen($username) < 6) functions::json(-1, '用户名不能为空或小于6位');

        if (!preg_match("/^[a-zA-Z0-9_]{0,}$/", $username)) functions::json(-1, '用户名不能有汉字');

        //判断用户名是否存在
        $user = $this->mysql->query("client_user", "username='{$username}'")[0];
        if (is_array($user)) functions::json(-3, '当前用户名已经存在,请更换重试');

        if ($phone == '') {
            $phone = 0;
        } else {
            //手机号规则
            if (!functions::isMobile($phone)) functions::json(-1, '手机号输入有误,请检查手机号是否输入正确');
            //判断手机是否存在
            $find_phone = $this->mysql->query("client_user", "phone={$phone}")[0];
            if (is_array($find_phone)) functions::json(-3, '当前手机已经存在,请更换重试');
        }

        //判断密码
        if (strlen($pwd) < 6) functions::json(-1, '密码不能为空且不能小于6位');
        //权限组
        $group = $this->mysql->query("client_group", "id={$group_id}")[0];
        if (!is_array($group)) functions::json(-2, '权限组分配失败,请重新选择');

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
            'balance' => 0,
            'money' => 0,
            'yajin' => 0,
            'token' => $token,
            'ip' => '8.8.8.8',
            'group_id' => $group_id,
            'is_agent' => $is_agent,
            'is_pankou' => $is_pankou,
            'is_mashang' => $is_mashang,
            'level_id' => $level_id,
            'login_time' => 0,
            'key_id' => $key_id = strtoupper(substr(md5(mt_rand(100000, 999999)), 0, 14)),
            'avatar' => 0
        ]);

        if ($Insert > 0) functions::json(200, '添加成功!');

        functions::json(-3, '添加失败,请检查资料是否有误');
    }

    //上传头像
    //头像
    //权限ID：20
    public function avatarUpload()
    {
        $this->powerLogin(20);
        $id = intval(request::filter('get.id'));
        $type = intval(request::filter('get.type'));
        $emp = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($emp)) functions::json(-3, '用户索引失败,请重试!');
        //上传文件到自己的空间
        $path = str_replace('admin', 'index', PATH_VIEW) . 'upload/avatar/' . $id;
        $upload = (new upload())->run($_FILES['avatar'], $path, array('jpg', 'png'), 1000);
        if (!is_array($upload)) functions::json(-2, '上传时错误,请选择一张小于1M的图片,注意只能是图片!');
        $this->mysql->update('client_user', array('avatar' => $upload['new']), "id={$id}");
        functions::json(200, '头像更换成功!', array('img' => $upload['new']));
    }

    //权限ID：20
    public function edit()
    {
        $this->powerLogin(20);
        $id = base64_decode(str_replace('@', '=', request::filter('get.id')));
        $type = $_GET['type'];
        $result = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($result)) url::address(url::s('admin/member/index'), '识别会员失败', 1);
        //权限查询
        $groups = $this->mysql->query("client_group");
        //加载视图
        new view('member/edit', [
            'result' => $result,
            'groups' => $groups,
            'callback_type' => $type,

        ]);
    }

    //权限ID：20
    public function editResult()
    {
        $this->powerLogin(20);
        $id = intval(request::filter("get.id"));
        $username = strip_tags(request::filter('post.username'));
        $pwd = request::filter('post.pwd');
        $group_id = request::filter('post.group_id');
        $phone = request::filter('post.phone');
        $is_agent = intval(request::filter('post.is_agent'));
        $is_pankou = intval(request::filter('post.is_pankou'));
        $is_mashang = intval(request::filter('post.is_mashang'));
        $level_id = intval(request::filter('post.level_id'));

        if ($phone == '') {
            $phone = 0;
        } else {
            //手机号规则
            if (!functions::isMobile($phone)) functions::json(-1, '手机号输入有误,请检查手机号是否输入正确');
            //判断手机是否存在
            $find_phone = $this->mysql->query("client_user", "phone={$phone}")[0];
            if (is_array($find_phone) && $find_phone['phone'] != $phone) functions::json(-3, '当前手机已经存在,请更换重试');

        }

        //权限组
        $group = $this->mysql->query("client_group", "id={$group_id}")[0];
        if (!is_array($group)) functions::json(-2, '权限组分配失败,请重新选择');

        //判断上级ID是否存在
        if ($level_id > 0) {
            $find_level = $this->mysql->query("client_user", "id={$level_id}")[0];
            if (!is_array($find_level)) functions::json(-3, '上级ID填写有误,没有找到该会员ID');
        }

        $inArray = [
            'username' => $username,
            'phone' => $phone,
            'is_agent' => $is_agent,
            'is_mashang' => $is_mashang,
            'is_pankou' => $is_pankou,
            'group_id' => $group_id,
            'level_id' => $level_id,
        ];

        //判断密码
        if (!empty($pwd)) {
            if (strlen($pwd) < 6) functions::json(-1, '密码不能为空且不能小于6位');
            //生成密码盐值
            $token = substr(md5(mt_rand(10000, mt_rand(100000, 9999999))), 0, 9);
            $inArray['pwd'] = functions::pwd($pwd, $token);
            $inArray['token'] = $token;
        }

        $Insert = $this->mysql->update("client_user", $inArray, "id={$id}");

        if ($Insert > 0) functions::json(200, '修改成功!');

        functions::json(-3, '当前没有做任何修改!');
    }

    //删除会员
    //ID：20
    public function delete()
    {
        $this->powerLogin(20);
        $id = intval(request::filter('post.id'));
        //查询当前用户组是否存在
        $result = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前会员不存在');
        //删除
        $this->mysql->delete("client_user", "id={$id}");
        functions::json(200, '操作完成,您已经将该会员成功移除!');
    }

//下线码商通道
    public function xiaxian()
    {
        $this->powerLogin(20);
        $id = intval(request::filter('get.id'));
        //查询当前用户组是否存在
        $result = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前会员不存在');
        //查询
        $order = $this->mysql->query("client_paofen_automatic_account", "user_id = {$id}");
        if (!empty($order)) {
            foreach ($order as $k => $v) {
                $this->mysql->update("client_paofen_automatic_account", ['training' => 2, 'receiving' => 2], "id = {$v['id']}");

            }
        }
        functions::json(200, '操作完成,您已经下线了该码商的所有通道!');


    }

    //下线码商通道
    public function shangxian()
    {
        $this->powerLogin(20);
        $id = intval(request::filter('get.id'));
        //查询当前用户组是否存在
        $result = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前会员不存在');
        //查询
        $order = $this->mysql->query("client_paofen_automatic_account", "user_id = {$id}");
        if (!empty($order)) {
            foreach ($order as $k => $v) {
                $this->mysql->update("client_paofen_automatic_account", ['training' => 1, 'receiving' => 1], "id = {$v['id']}");

            }
        }
        functions::json(200, '操作完成,您已经上线了该码商的所有通道!');


    }
    //提现管理
    //权限ID：28
    public function withdraw()
    {
        $this->powerLogin(28);
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');

        //订单号
        if ($sorting == 'flow_no') {
            if ($code != '') {
                $code = trim($code);
                $where = "flow_no={$code}";
            }
        }

        //未处理
        if ($sorting == 'type') {
            if ($code != '') {
                $code = trim($code);
                $where = "types={$code}";
            }
        }


        $result = page::conduct('client_withdraw', request::filter('get.page'), 15, $where, null, 'id', 'desc');
        new view('member/withdraw', [
            'result' => $result,
            'mysql' => $this->mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ]
        ]);
    }

    //更新状态
    //权限ID：28
    public function updateWithdraw()
    {
        $this->powerLogin(28);
        $id = intval(request::filter('get.id'));
        $type = request::filter('get.type', '', 'htmlspecialchars');
        $type_arr = [2, 3, 4];
        if (!in_array($type, $type_arr)) functions::json(-1, '当前更新的状态有误!');
        $msg = $type == 2 ? '提现已到账' : request::filter('get.msg', '', 'htmlspecialchars');
        // 开启事务
        $this->mysql->startThings();
        // 查询订单并且加上悲观锁
        $result = $this->mysql->query("client_withdraw", "id={$id}", null, null, 'desc', null, 'for update')[0];
        if (!is_array($result)) functions::json(-2, '当前订单不存在');
        // 判断订单状态
        if ($result['status'] != 0) {
            functions::json(-2, '当前订单状态有误！');
        }
        $width_result = $this->mysql->update("client_withdraw", [
            'types' => $type,
            'is_notice' => 1,
            'content' => $msg,
            'status' => 1,
            'deal_time' => time()
        ], "id={$id}");
        if (!$width_result) {
            $this->mysql->rollback();
            functions::json(-2, '提现失败1');
        }
        //钱款驳回
        if ($type == 3) {
            //将钱款退款给用户
            $find_user = $this->mysql->query("client_user", "id={$result['user_id']}")[0];
            if (is_array($find_user)) {
                $user_result = functions::user_balance($find_user['id'], $result['amount']);
                $change = functions::user_balance_record($find_user['id'], $result['amount'], 4, $result['id'], '代理提现驳回', $find_user['balance']);

                if (!$user_result || !$change) {
                    $this->mysql->rollback();
                    functions::json(-2, '提现失败2！');
                }
            }
        }
        $this->mysql->commit();
        functions::json(200, '处理成功');
    }
    /*
        //删除提现
        public function deleteWithdraw()
        {
            $this->powerLogin(28);
            $id = intval(request::filter('get.id'));
            //查询当前用户组是否存在
            $result = $this->mysql->query("client_withdraw", "id={$id}")[0];
            if (!is_array($result)) functions::json(-2, '当前记录不存在');
            //删除
            $this->mysql->delete("client_withdraw", "id={$id}");
            functions::json(200, '操作完成,您已经将记录成功移除!');
        }*/

//盘口提现

    //提现管理
    //权限ID：28
    public function pankouwithdraw()
    {
        $this->powerLogin(28);
        $flow_no = trim(request::filter('get.flow_no', '', 'htmlspecialchars'));
        $username = trim(request::filter('get.username', '', 'htmlspecialchars'));
        $types = trim(request::filter('get.types', 0, 'intval'));

        //订单号
        $where = 'catalog = 1';
        if ($flow_no) {
            $where .= " and flow_no = '{$flow_no}'";
        }

        //用户名
        if ($username) {
            $user = $this->mysql->query("client_user", "username='{$username}'")[0];
            if (!empty($user)) {
                $where .= " and user_id = '{$user['id']}'";
            }
        }

        //体现状态
        if ($types != 0) {
            $where .= " and types = '{$types}'";
        }

        $result = page::conduct('withdraw', request::filter('get.page'), 15, $where, null, 'id', 'desc');
        new view('member/pankouwithdraw', [
            'result' => $result,
            'mysql' => $this->mysql,
            'flow_no' => $flow_no,
            'username' => $username,
            'types' => $types,
        ]);
    }

    //更新状态
    //权限ID：28
    public function updatepankouWithdraw()
    {
        $this->powerLogin(28);
        $id = intval(request::filter('get.id'));
        $type = request::filter('get.type', '', 'htmlspecialchars');
        $type_arr = [2, 3, 4];
        if (!in_array($type, $type_arr)) functions::json(-1, '当前更新的状态有误!');
        $msg = $type == 2 ? '提现已到账' : request::filter('get.msg', '', 'htmlspecialchars');
        // 开启事务
        $this->mysql->startThings();
        // 查询订单并且加上悲观锁
        $result = $this->mysql->query("withdraw", "id={$id}", null, null, 'desc', null, 'for update')[0];
        if (!is_array($result)) functions::json(-2, '当前订单不存在');
        // 判断订单状态
        if ($result['status'] != 0) {
            functions::json(-2, '当前订单状态有误！');
        }
        $width_result = $this->mysql->update("withdraw", [
            'types' => $type,
            'is_notice' => 1,
            'content' => $msg,
            'status' => 1,
            'deal_time' => time()
        ], "id={$id}");
        if (!$width_result) {
            $this->mysql->rollBack();
            functions::json(-3, '提现失败1');
        }
        //钱款驳回
        if ($type == 3) {
            //将钱款退款给用户
            $find_user = $this->mysql->query("client_user", "id={$result['user_id']}")[0];
            if (is_array($find_user)) {
                $user_result = functions::user_balance($find_user['id'], $result['amount']);
                $change = functions::user_balance_record($find_user['id'], $result['amount'], 4, $result['id'], '代理提现驳回', $find_user['balance']);

                if (!$user_result || !$change) {
                    $this->mysql->rollback();
                    functions::json(-2, '提现失败2！');
                }
            }
        }
        $this->mysql->commit();
        functions::json(200, '处理成功');
    }
    /*
        //删除提现
        public function deletepankouWithdraw()
        {
            $this->powerLogin(28);
            $id = intval(request::filter('get.id'));
            //查询当前用户组是否存在
            $result = $this->mysql->query("withdraw", "id={$id}")[0];
            if (!is_array($result)) functions::json(-2, '当前记录不存在');
            //删除
            $this->mysql->delete("withdraw", "id={$id}");
            functions::json(200, '操作完成,您已经将记录成功移除!');
        }*/

    //码商提现

    //提现管理
    //权限ID：28
    public function mashangwithdraw()
    {
        $this->powerLogin(28);

        $flow_no = trim(request::filter('get.flow_no', '', 'htmlspecialchars'));
        $username = trim(request::filter('get.username', '', 'htmlspecialchars'));
        $types = trim(request::filter('get.types', 0, 'intval'));

        //订单号
        $where = 'catalog = 3';
        if ($flow_no) {
            $where .= " and flow_no = '{$flow_no}'";
        }

        //用户名
        if ($username) {
            $user = $this->mysql->query("client_user", "username='{$username}'")[0];
            if (!empty($user)) {
                $where .= " and user_id = '{$user['id']}'";
            }
        }

        //体现状态
        if ($types != 0) {
            $where .= " and types = '{$types}'";
        }

        $result = page::conduct('withdraw', request::filter('get.page'), 15, $where, null, 'id', 'desc');
        new view('member/mashangwithdraw', [
            'result' => $result,
            'mysql' => $this->mysql,
            'flow_no' => $flow_no,
            'username' => $username,
            'types' => $types
        ]);
    }

    //更新状态
    //权限ID：28
    public function updatemashangWithdraw()
    {
        $this->powerLogin(28);
        $id = intval(request::filter('get.id'));
        $type = request::filter('get.type', '', 'htmlspecialchars');
        $type_arr = [2, 3, 4];
        if (!in_array($type, $type_arr)) functions::json(-1, '当前更新的状态有误!');
        $msg = $type == 2 ? '提现已到账' : request::filter('get.msg', '', 'htmlspecialchars');
        // 开启事务
        $this->mysql->startThings();
        // 查询订单并且加上悲观锁
        $result = $this->mysql->query("withdraw", "id={$id}", null, null, 'desc', null, 'for update')[0];
        if (!is_array($result)) functions::json(-2, '当前订单不存在');
        // 判断订单状态
        if ($result['status'] != 0) {
            functions::json(-2, '当前订单状态有误！');
        }
        $result = $this->mysql->update("withdraw", [
            'types' => $type,
            'is_notice' => 1,
            'content' => $msg,
            'status' => 1,
            'deal_time' => time()
        ], "id={$id}");
        if (!$result) {
            $this->mysql->rollBack();
            functions::json(-3, '提现失败1');
        }
        //钱款驳回
        if ($type == 3) {
            //将钱款退款给用户
            $find_user = $this->mysql->query("client_user", "id={$result['user_id']}")[0];
            if (is_array($find_user)) {
                $user_result = functions::user_balance($find_user['id'], $result['amount']);
                $change = functions::user_balance_record($find_user['id'], $result['amount'], 4, $result['id'], '代理提现驳回', $find_user['balance']);

                if (!$user_result || !$change) {
                    $this->mysql->rollback();
                    functions::json(-2, '提现失败2！');
                }
            }
        }
        $this->mysql->commit();
        functions::json(200, '处理成功');

    }

    /* //删除提现
     public function deletemashangWithdraw()
     {
         $this->powerLogin(28);
         $id = intval(request::filter('get.id'));
         //查询当前用户组是否存在
         $result = $this->mysql->query("withdraw", "id={$id}")[0];
         if (!is_array($result)) functions::json(-2, '当前记录不存在');
         //删除
         $this->mysql->delete("withdraw", "id={$id}");
         functions::json(200, '操作完成,您已经将记录成功移除!');
     }*/


    //盘口提现

    //提现管理
    //权限ID：28
    public function agentwithdraw()
    {
        $this->powerLogin(28);

        $flow_no = trim(request::filter('get.flow_no', '', 'htmlspecialchars'));
        $username = trim(request::filter('get.username', '', 'htmlspecialchars'));
        $types = trim(request::filter('get.types', 0, 'intval'));

        //订单号
        $where = 'catalog = 2';
        if ($flow_no) {
            $where .= " and flow_no = '{$flow_no}'";
        }

        //用户名
        if ($username) {
            $user = $this->mysql->query("client_user", "username='{$username}'")[0];
            if (!empty($user)) {
                $where .= " and user_id = '{$user['id']}'";
            }
        }

        //体现状态
        if ($types != 0) {
            $where .= " and types = '{$types}'";
        }

        $result = page::conduct('withdraw', request::filter('get.page'), 15, $where, null, 'id', 'desc');
        new view('member/agentwithdraw', [
            'result' => $result,
            'mysql' => $this->mysql,
            'flow_no' => $flow_no,
            'username' => $username,
            'types' => $types,
        ]);
    }

    //更新状态
    //权限ID：28
    public function updateagentWithdraw()
    {
        $this->powerLogin(28);
        $id = intval(request::filter('get.id'));
        $type = request::filter('get.type', '', 'htmlspecialchars');
        $type_arr = [2, 3, 4];
        if (!in_array($type, $type_arr)) functions::json(-1, '当前更新的状态有误!');
        $msg = $type == 2 ? '提现已到账' : request::filter('get.msg', '', 'htmlspecialchars');
        // 开启事务
        $this->mysql->startThings();
        // 查询订单并且加上悲观锁
        $result = $this->mysql->query("withdraw", "id={$id}", null, null, 'desc', null, 'for update')[0];
        if (!is_array($result)) functions::json(-2, '当前订单不存在');
        // 判断订单状态
        if ($result['status'] != 0) {
            functions::json(-2, '当前订单状态有误！');
        }
        $withdraw_result = $this->mysql->update("withdraw", [
            'types' => $type,
            'is_notice' => 1,
            'content' => $msg,
            'status' => 1,
            'deal_time' => time()
        ], "id={$id}");
        if (!$withdraw_result) {
            $this->mysql->rollback();
            functions::json(-2, '提现失败1！');
        }
        //钱款驳回
        if ($type == 3) {
            //将钱款退款给用户
            $find_user = $this->mysql->query("client_user", "id={$result['user_id']}")[0];
            if (is_array($find_user)) {
                $user_result = functions::user_balance($find_user['id'], $result['amount']);
                $change = functions::user_balance_record($find_user['id'], $result['amount'], 4, $result['id'], '代理提现驳回', $find_user['balance']);

                if (!$user_result || !$change) {
                    $this->mysql->rollback();
                    functions::json(-2, '提现失败2！');
                }
            }
        }
        $this->mysql->commit();
        functions::json(200, '处理成功');
    }

    public function manualrecharge()
    {
        $this->powerLogin(92);
        $m_username = trim(request::filter('get.m_username'));
        $where = '';
        if ($m_username) {
            $user = $this->mysql->query('client_user', "username='{$m_username}'")[0];

            if ($user) {
                $where .= 'uid = ' . $user['id'];
            }
        }

        //TODO 查询充值列表
        //$this->powerLogin(20);

        $member = page::conduct('user_paylog', request::filter('get.page'), 10, $where, null, 'id', 'desc');

        new view('member/manualrecharge', [
            'mysql' => $this->mysql,
            'member' => $member,
            'm_username' => $m_username
        ]);

    }

    /**
     * 人工充值提交操作
     */
    public function manualRechargeResult()
    {
        $this->powerLogin(92);
        $name = trim(request::filter('post.username'));
        $money = trim(request::filter('post.money'));
        $status = trim(request::filter('post.open'));
        $remark = trim(request::filter('post.remark'));
        $yajin = 0;
        $this->mysql->startThings();
        $user = $this->mysql->query('client_user', "username='{$name}' and is_mashang=1")[0];
        if (!is_array($user)) functions::json(-1, '此码商不存在');
        if ($status == 2 && $money > $user['balance']) functions::json(-1, '码商余额不足，无法扣除');
        if (empty($remark)) functions::json(-1, '备注不能为空');
        if ($status == 2) {
            $new_money = '-' . $money;
            $remark = '扣款';
        } else {
            $new_money = $money;
            $remark = '充值';
            $yajin = $user['yajin'] + $new_money;
            /*$this->mysql->update("client_user", [
                'yajin' => $zyj
            ], "id={$user['id']}");*/
        }
        $data = [
            'uid' => $user['id'],
            'money' => $money,
            'old_money' => $user['balance'],
            'new_money' => $user['balance'] + $new_money,
            'remark' => $remark,
            'time' => time(),
            'op_user' => $_SESSION['USER_MGT']['uid'] . "|" . $_SESSION['USER_MGT']['username'],
            'status' => $status
        ];
        $st = $this->mysql->insert('user_paylog', $data);
        if (!$st) {
            $this->mysql->rollBack();
            functions::json(-1, 'user_paylog失败');
        }

        $up = functions::user_balance($user['id'], $new_money,0,$yajin);
        if (!$up) {

            $this->mysql->rollBack();
            functions::json(-1, '更新余额失败');
        }
        $change = functions::user_balance_record($user['id'], $new_money, 6, $st, $remark, $user['balance']);

        if (!$change) {
            $this->mysql->rollBack();
            functions::json(-1, '账变记录失败');
        }
        $this->mysql->commit();
        functions::json(200, '操作成功');

    }
        /*
            //删除提现
            public function deleteagentWithdraw()
            {
                $this->powerLogin(28);
                $id = intval(request::filter('get.id'));
                //查询当前用户组是否存在
                $result = $this->mysql->query("withdraw", "id={$id}")[0];
                if (!is_array($result)) functions::json(-2, '当前记录不存在');
                //删除
                $this->mysql->delete("withdraw", "id={$id}");
                functions::json(200, '操作完成,您已经将记录成功移除!');
            }*/

        //发送平台更新通知给用户
        public
        function notice()
        {
            $this->powerLogin(30);
            new view('member/notice');
        }

        //发送通知
        public
        function sendNotice()
        {
            $this->powerLogin(30);
            //检测安全令牌是否正确
            $pwd = request::filter('post.pwd');
            $user = $this->mysql->query('mgt', "id={$_SESSION['USER_MGT']['uid']}")[0];
            if (!is_array($user)) functions::json(-3, '管理员信息校验失败!');
            //验证pwd
            if (functions::pwd($pwd, $user['token']) != $user['pwd_safe']) functions::json(-6, '安全令牌输入错误');
            //$time
            $time = request::filter('post.time');
            //$name
            $name = request::filter('post.update_name');
            //restore
            $restore = request::filter('post.restore');
            //content
            $content = request::filter('post.content');
            if ($content == '') functions::json(-2, '更新内容不能为空');
            //开始发送通知
            $result = $this->mysql->query("client_user");
            $sms = new sms();
            foreach ($result as $ru) {
                $sms->sendDefend($ru['phone'], $time, $name, $restore, $content);
            }
            functions::json(200, '短信通知发送完毕,共计发送:' . count($result) . '个');
        }


    }