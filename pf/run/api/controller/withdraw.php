<?php

namespace xh\run\api\controller;

use xh\library\functions;
use xh\library\request;
use xh\unity\page;
require_once ROOT_PATH."/run/api/controller/common.php";


class withdraw extends common
{

    public function index()
    {
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');

        $where = "user_id={$this->user['id']}";

        //订单号
        if ($sorting == 'flow_no') {
            if ($code != '') {
                $code = trim($code);
                $where .= " and flow_no={$code}";
            }
        }
        $result = page::conduct('client_withdraw', request::filter('get.page'), $this->perPage, $where, null, 'id', 'desc');

        functions::json(1,'提现列表',$result);
    }

    public function apply(){
        $bank = json_decode($this->user['bank'],true);
        if (!in_array($bank['type'], [1, 2])) functions::json(0, '请在个人设置里面添加银行卡或支付宝');
        //计算用户
        //计算提现金额
        $amount = floatval(request::filter('post.amount', '', 'htmlspecialchars'));
        if ($amount < 1) functions::json(0, '提现金额输入不正确,本支付平台最低提现1元人民币');
        //用户组
        $find_group = $this->mysql->query("client_group","id={$this->user['group_id']}")[0];
        $group = json_decode($find_group['authority'], true);
        //手续费
        $fees = isset($group['withdraw']) ? floatval($group['withdraw']['cost']) * $amount : 0;
        //计算减掉的金额
        $user_amount = $this->user['money'] - $amount;
        //判断是否有足够的金额提现
        if ($user_amount < 0) functions::json(0, '余额不足');
        //更新用户账户信息
        try{
            $this->mysql->startThings();

            if ($this->mysql->update("client_user", ['money' => $user_amount], "id={$this->user['id']}") > 0) {
                $in = $this->mysql->insert("client_withdraw", [
                    'user_id'    => $this->user['id'],
                    'old_amount' => $this->user['money'],
                    'amount'     => $amount,
                    'new_amount' => $user_amount,
                    'types'      => 1,
                    'content'    => '提现到账时间为2小时-24小时内到账',
                    'apply_time' => time(),
                    'deal_time'  => 0,
                    'flow_no'    => date("YmdHis") . mt_rand(100000, 999999),
                    'fees'       => $fees
                ]);

            }

            $this->mysql->commit();
            functions::json(1, '您的提现已经提交成功!');
        }catch(\Exception $exception){
            $this->mysql->rollBack();
            functions::json(0, '系统正在维修,请稍后再提现!');
        }
    }

    public function bankInfo(){
        $bank_type = [
            '1' => '支付宝',
            '2' => '银行卡'
        ];
        $bank = json_decode($this->user['bank'],true);
        if($bank){
            $bank['type_name'] = isset($bank_type[$bank['type']]) ? $bank_type[$bank['type']] : '';
        }
        functions::json(1, '账号支付信息!', $bank);
    }

}