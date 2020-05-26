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


class config
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

    //配置管理
    //权限ID：20
    public function configList()
    {
        $this->powerLogin(20);
        $cfg_key = trim(request::filter('get.cfg_key'));
        $where = '1 = 1';
        if($cfg_key){
            $where .= " and cfg_key = '{$cfg_key}'";
        }
        $member = page::conduct('config', request::filter('get.page'), 10, $where, null, 'id', 'desc');
        new view('config/configList', [
            'mysql' => $this->mysql,
            'member' => $member,
            'cfg_key'=>$cfg_key
        ]);
    }

    //删除配置
    //ID：20
    public function configDel()
    {
        $this->powerLogin(20);
        $id = intval(request::filter('post.id'));

        //查询当前配置是否存在
        $result = $this->mysql->query("config", "id={$id}")[0];
        if (!is_array($result)) functions::json(-2, '当前配置不存在');
        //删除
        $this->mysql->delete("config", "id={$id}");
        functions::json(200, '删除成功');
    }

    //添加配置
    //ID：20
    public function configAdd()
    {
        $this->powerLogin(20);

        $title = request::filter('post.title');
        $cfg_key = trim(request::filter('post.cfg_key'));
        $cfg_value = rtrim(request::filter('post.cfg_value'));
        $status = intval(request::filter('post.status'));

        if (strlen($title) < 3) functions::json(-1, '标题不能为空或小于3位');

        if (strlen($cfg_key) < 3) functions::json(-1, '键不能为空或小于3位');

        //判断cfg_key是否存在
        $info = $this->mysql->query("config", "cfg_key='{$cfg_key}'")[0];
        if (is_array($info)) functions::json(-3, '当前配置key已经存在');

        //判断cfg_value是否存在
        if (strlen($cfg_value) < 6) functions::json(-1, 'value不能小于6位');

        //判断状态
        if ($status!=1 && $status!=0) functions::json(-1, '状态异常');

        $Insert = $this->mysql->insert("config", [
            'title' => $title,
            'cfg_key' => $cfg_key,
            'cfg_value' => $cfg_value,
            'catelog' => 1,
            'status' => $status,
            'create_time' => time()
        ]);

        if ($Insert > 0) functions::json(200, '添加成功!');

        functions::json(-3, '添加失败');
    }

    //配置查看
    //权限ID：20
    public function configView()
    {
        $this->powerLogin(20);
        $id = base64_decode(str_replace('@', '=', request::filter('get.id')));
        $result = $this->mysql->query("config", "id={$id}")[0];
        if (!is_array($result)) url::address(url::s('admin/member/configList'), '识别会员失败', 1);
        //权限查询
        $groups = $this->mysql->query("client_group");
        //加载视图
        new view('config/configEdit', [
            'result' => $result,
            'groups' => $groups
        ]);
    }

    //配置修改
    //权限ID：20
    public function configEdit()
    {
        $this->powerLogin(20);
        $id = intval(request::filter("get.id"));
        $title = request::filter('post.title');
        $cfg_value = rtrim(request::filter('post.cfg_value'));
        $status = intval(request::filter('post.status'));

        //判断配置是否存在
        $info = $this->mysql->query("config", "id='{$id}'")[0];

        if (!is_array($info)) functions::json(-3, '当前配置不存在');

        if (strlen($title) < 3) functions::json(-1, '标题不能为空或小于3位');

        //判断cfg_value是否存在
        if (strlen($cfg_value) < 6) functions::json(-1, 'value不能小于6位');

        //判断状态
        if ($status!=1 && $status!=0) functions::json(-1, '状态异常');

        $up = [
            'title' => $title,
            'cfg_value' => $cfg_value,
            'status' => $status,
            'edit_time' => time()
        ];

        $re = $this->mysql->update("config", $up, "id={$id}");

        if ($re > 0) functions::json(200, '修改成功!');

        functions::json(-3, '当前没有做任何修改!');
    }

}