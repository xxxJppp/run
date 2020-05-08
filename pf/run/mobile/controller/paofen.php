<?php

namespace xh\run\mobile\controller;


use xh\library\model;
use xh\library\mysql;
use xh\library\view;
use xh\library\functions;
use xh\unity\callbacks;
use xh\unity\page;
use xh\library\request;
use xh\unity\sms;
use xh\unity\userCog;
use xh\unity\upload;

class paofen
{

    private $mysql;

    //初始化
    public function __construct()
    {
        (new model())->load('user', 'session')->check();
        $this->mysql = new mysql();
    }


    //全自动版
    public function automatic()
    {
        (new model())->load('user', 'group')->review('paofen_auto');
       $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
       $code = request::filter('get.code', '', 'htmlspecialchars');
       //筛选
        if ($sorting == 'type') {
            $list = [1, 2,3,4,5,6,7,8];
            if (in_array($code, $list)) {
               $where .= "and type = {$code}";
            } else {
                unset($_SESSION['SERVICE_ACCOUNT']['WHERE']);
            }
        }
      
                   //     $result = page::conduct('service_account', request::filter('get.page'), 10, $where, null, 'id', 'asc');
        $result = page::conduct('client_paofen_automatic_account', request::filter('get.page'), 10, "user_id={$_SESSION['MEMBER']['uid']} " . $where, null, 'id', 'asc');
        //获取城市
        $areaList = $this->mysql->query('city');
        $areaStr = '';
         foreach($areaList as $bk=>$bv){
             $areaStr .= "<option value='".$bv['cityname']."'>".$bv['cityname']."</option>";
         }
      
      //获取银行id（简称）
        $bankList = $this->mysql->query('bank_id');
        //print_r($bankList);die;
        $bankStr = '';
         foreach($bankList as $bk=>$bv){
             $bankStr .= "<option value='".$bv['bank_id']."'>".$bv['bank_name']."</option>";
         }
      
        new view('paofen/index', [
            'result' => $result,
            'areaStr' => $areaStr,
           'bankStr' => $bankStr,
            'mysql'  => $this->mysql
        ]);
    }

  //上传图片解析二维码
   public function jiexiup()
    {
        $id = $_SESSION['MEMBER']['uid'];
        $emp = $this->mysql->query("client_user", "id={$id}")[0];
        if (!is_array($emp)) functions::json(-3, '用户索引失败,请重试!');
        //上传文件到自己的空间
        $path = str_replace('mobile', 'upload', PATH_VIEW) . 'qrcode/';
        $upload = (new upload())->run($_FILES['avatar'], $path, array('jpg', 'png'), 1000);
        if (!is_array($upload)) functions::json(-2, '上传时错误,请选择一张小于1M的图片,注意只能是二维码图片!');
        //$this->mysql->update('client_user', array('avatar' => '/run/upload/view/qrcode/'.$upload['new']), "id={$id}");
     
                   //初始化
                    $curl = curl_init();
                    //设置抓取的url
                    curl_setopt($curl, CURLOPT_URL, 'http://qrcode.erinqak.cn/index.php?imgurl=http://'.DOMAINS_URL.'/run/upload/view/qrcode/'.$upload['new']);
                    //设置头文件的信息作为数据流输出
                    curl_setopt($curl, CURLOPT_HEADER, 1);
                    //设置获取的信息以文件流的形式返回，而不是直接输出。
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_HEADER, FALSE);    //表示需要response header
                   curl_setopt($curl, CURLOPT_NOBODY, FALSE); //表示需要response body

                    //执行命令
                    $data = curl_exec($curl);
                    //关闭URL请求
                    curl_close($curl);
                    //显示获得的数据
   
           $arr = json_decode($data,1); // $str 代表json字符串
     if( $arr['status'] == 1){
     
       functions::json(200, '二维码解析成功!', array('img' => $arr['qrtext']));
     
     }else{
        functions::json(100, '二维码解析失败，请重新上传!', array('img' => 0));
     }
    }
  
  
     //全自动版
    public function search()
    {
        (new model())->load('user', 'group')->review('paofen_auto');
       $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
       $code = request::filter('get.code', '', 'htmlspecialchars');
       //筛选
        if ($sorting == 'type') {

               $where .= "and id = {$code}";
        
        }
      
                   //     $result = page::conduct('service_account', request::filter('get.page'), 10, $where, null, 'id', 'asc');
        $result = page::conduct('client_paofen_automatic_account', request::filter('get.page'), 10, "user_id={$_SESSION['MEMBER']['uid']} " . $where, null, 'id', 'asc');
        //获取城市
        $areaList = $this->mysql->query('city');
        $areaStr = '';
         foreach($areaList as $bk=>$bv){
             $areaStr .= "<option value='".$bv['cityname']."'>".$bv['cityname']."</option>";
         }
      
      //获取银行id（简称）
        $bankList = $this->mysql->query('bank_id');
        //print_r($bankList);die;
        $bankStr = '';
         foreach($bankList as $bk=>$bv){
             $bankStr .= "<option value='".$bv['bank_id']."'>".$bv['bank_name']."</option>";
         }
      
        new view('paofen/search', [
            'result' => $result,
            'areaStr' => $areaStr,
           'bankStr' => $bankStr,
            'mysql'  => $this->mysql
        ]);
    }

  
  
  
   public function addwechat(){

        new view("paofen/addwechat");
    }
  public function addalipay(){

        new view("paofen/addalipay");
    }
  
  public function addalipaypid(){

        new view("paofen/addalipaypid");
    }
  
  public function addbank(){
    
     //获取银行id（简称）
        $bankList = $this->mysql->query('bank_id');
        //print_r($bankList);die;
        $bankStr = '';
         foreach($bankList as $bk=>$bv){
             $bankStr .= "<option value='".$bv['bank_id']."'>".$bv['bank_name']."</option>";
         }
 new view('paofen/addbank', [
           'bankStr' => $bankStr,
            'mysql'  => $this->mysql
        ]);
    
    }
  
  public function addwechatdy(){

        new view("paofen/addwechatdy");
    }
  
   public function type(){
        new view("paofen/type");
    }
  
    public function editdyname()
    {
        $id = intval(request::filter('get.id'));
        $dyname = request::filter('get.dyname');
        //检查该微信
        $update['dy_name'] = $dyname;
        $this->mysql->update("client_paofen_automatic_account", $update, "id={$id}");
        functions::json(200, '成功');
    }

    //添加-->OK
    public function automaticAdd()
    {
        (new model())->load("paofen", "features")->add($this->mysql);
    }

    //启动automatic轮训
    public function startAutomaticRb()
    {
        (new model())->load("paofen", "features")->startRb($this->mysql);
    }

    //启动网关
    public function startAutomaticGateway()
    {
        (new model())->load("paofen", "features")->startGateway($this->mysql);
    }

    //修改名称
    public function automaticEditName()
    {
        (new model())->load("paofen", "features")->editName($this->mysql);
    }

    //安全注销
    public function startAutomaticLogOut()
    {
        (new model())->load("paofen", "features")->startLogOut($this->mysql);
    }

    //请求登录
    public function startAutomaticLogin()
    {
        (new model())->load("paofen", "features")->startLogin($this->mysql);
    }

    //获取跑分状态
    public function getAutomaticStatus()
    {
        (new model())->load("paofen", "features")->getStatus($this->mysql);
    }

    //删除跑分
    public function automaticDelete()
    {
        (new model())->load("paofen", "features")->delete($this->mysql);
    }

    //全部订单
    public function automaticOrder()
    {
        (new model())->load("paofen", "features")->order($this->mysql);
    }

    //订单统计
    public function statisticOrder()
    {
        (new model())->load("paofen", "features")->statistic($this->mysql);
    }

    //手动补发
    public function automaticReissue()
    {
        (new model())->load("paofen", "features")->reissue($this->mysql);
    }

    //轮训通道测试
    public function robinTest()
    {
        new view('paofen/robinTest');
    }

    //单个跑分测试
    public function gatewayTest()
    {
        new view('paofen/gatewayTest');
    }

    //跑分配置
    public function automaticConfig()
    {
        new view('paofen/setting');

    }

    //跑分配置result
    public function automaticConfigResult()
    {
        unset($_SESSION['paofenConfig']);
        $robin_arr = [1, 2, 3];
        $robin = intval(request::filter('get.robin'));
        if (!in_array($robin, $robin_arr)) functions::json(-1, '跑分配置修改失败');
        userCog::update('paofenConfig', [
            'robin' => $robin
        ], $_SESSION['MEMBER']['uid']);
        functions::json(200, '跑分配置更新成功!');
    }


    //后台批量补单
    function resetOrder()
    {

        if (empty($_SESSION['MEMBER']['uid'])) functions::json(500, '用户信息错误，请重新登陆');
        $order_ids = request::filter('post.order_ids');
        $order_ids = explode(",", trim($order_ids));

        if (!is_array($order_ids)) functions::json(500, '订单信息错误');
        $success = '';
        $successCount = 0;
        $error = '';
        $errorCount = 0;
        foreach ($order_ids as $val) {
            if (empty($val)) continue;
            $val = intval($val);

            $find_order = $this->mysql->query('client_paofen_automatic_orders', "id={$val}", 'id,paofen_id,status')[0];

            if (empty($find_order)) {
                $error .= ",{$val}订单不存在";
                $errorCount += 1;
                continue;
            }
            //查看该订单号是否属于该商户下的订单
            $account = $this->mysql->query('client_paofen_automatic_account', "id={$find_order['paofen_id']} AND user_id={$_SESSION['MEMBER']['uid']}", 'id')[0];
            if (empty($account)) {
                $error .= ",{$find_order['id']}不是您的订单ID";
                $errorCount += 1;
                continue;
            }

            if ($find_order['status'] == 4) {
                $success .= ",{$find_order['id']}";
                $successCount += 1;
                continue;
            }

            $id = $find_order['paofen_id'];
            $money = $find_order['money'];
            if (is_array($find_order)) {
                $update = $this->mysql->update("client_paofen_automatic_orders", [
                    'status'        => 4,
                    'pay_time'      => time(),
                    'callback_from' => 'index',
                ], "id={$find_order['id']}");
                $remark = ' - 订单信息：' . $find_order['id'];
                $average = 1;
                if ($update == false) {
                    $error .= ",{$find_order['id']}";
                    $errorCount += 1;
                    continue;
                }
                //查询用户信息
                $find_uid = $this->mysql->query("client_paofen_automatic_account", "id={$id}")[0]['user_id'];
                //写到交易记录
                $this->mysql->insert("client_pay_record", [
                    'pay_time'     => time(),
                    'amount'       => $money,
                    'user_id'      => $find_uid,
                    'pay_note'     => '[后台补单]跑分ID：' . $find_order['id'] . $remark,
                    'types'        => 2,
                    'version_code' => 'paofen_auto',
                    'average'      => $average
                ]);
                callbacks::curl(URL_ROOT . '/server/callback/paofen', http_build_query(['id' => $id]));
                $successCount += 1;
                $success .= ",{$find_order['id']}";
            } else {
                $errorCount += 1;
                $error .= ",找不到订单信息";

            }

        }
        $success = ltrim($success, ',');
        $error = ltrim($error, ',');
        $returnMsg = '';
        if ($successCount > 0) {
            $returnMsg = "成功执行{$successCount}条,成功订单" . $success;
        }
        if ($errorCount > 0) {
            $returnMsg .= "\n失败执行{$errorCount}条，失败信息" . $error;
        }
        functions::json(200, $returnMsg);
    }

    /**
     * @param string $name
     * @param array  $expCellName
     * @param array  $expTableData
     *
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     * 导出
     */
    public function export()
    {
        $code = request::filter('get.code', '', 'htmlspecialchars');
        $start_time = request::filter('get.start_time', '', 'htmlspecialchars');
        $end_time = request::filter('get.end_time', '', 'htmlspecialchars');
        $where = "";
        if ($code) {
            $where .= " and code=" . $code;
        }
        if ($start_time && $end_time) {
            $where .= " and creation_time BETWEEN {$start_time} AND {$end_time}";
        }

        if ($start_time == 'null' && $end_time = 'null' && !$code) {
            $list = $this->mysql->query("client_paofen_automatic_orders", "user_id={$_SESSION['MEMBER']['uid']}");
        } else {
            $list = $this->mysql->query("client_paofen_automatic_orders", "user_id={$_SESSION['MEMBER']['uid']}" . $where);
        }
        foreach ($list as $key => $value) {
            if ($value['status'] == 1) {
                $list[$key]['status'] = '等待下发支付二维码';
            } else if ($value['status'] == 2) {
                $list[$key]['status'] = '未支付';
            } else if ($value['status'] == 3) {
                $list[$key]['status'] = '订单超时';
            } else {
                $list[$key]['status'] = '已支付';
            }
            if ($value['pay_time']) {
                $list[$key]['pay_time'] = date('Y-m-d H:i:s', $value['pay_time']);
            } else {
                $list[$key]['pay_time'] = '无';
            }
            if ($value['callback_status'] == 1) {
                $list[$key]['callback_status'] = '已回调';
            } else {
                $list[$key]['callback_status'] = '未回调';
            }
            $list[$key]['creation_time'] = date('Y-m-d H:i:s', $value['creation_time']);
            $user_info = $this->mysql->query('client_user', 'id = ' . $value['user_id']);
            $list[$key]['user_name'] = $user_info[0]['username'];
            $list[$key]['phone'] = $user_info[0]['phone'];
            $list[$key]['percentage'] = $value['amount'] - $value['fees'];
        }
        $name = '跑分订单';
        $data_info = array(
            array('id', '订单ID'),
            array('user_id', '商户ID'),
            array('user_name', '商户名称'),
            array('phone', '商户手机号'),
            array('trade_no', '交易订单号'),
            array('paofen_id', '跑分ID'),
            array('amount', '金额'),
            array('percentage', '抽成'),
            array('status', '交易状态'),
            array('fees', '手续费'),
            array('pay_time', '异步通知时间'),
            array('callback_status', '异步通知状态'),
            array('callback_from', '异步通知'),
            array('callback_content', '回调信息'),
            array('creation_time', '订单创建时间'),
        );
        functions::commonExport($name, $data_info, $list);
    }

    /**
     * 修改最大金额
     */
    public function editMaxAmount()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $amount = request::filter('get.amount');
        //检查该微信
        $update['max_amount'] = $amount;
        $mysql->update("client_paofen_automatic_account", $update, "id={$id}");
        functions::json(200, '成功');
    }

    public function editMaxdd()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $dd = request::filter('get.dd');
        //检查该微信
        $update['max_dd'] = $dd;
        $mysql->update("client_paofen_automatic_account", $update, "id={$id}");
        functions::json(200, '成功');
    }
  
   public function areaAdd()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $area = request::filter('get.area');
        //检查该微信
        $update['area'] = $area;
        $mysql->update("client_paofen_automatic_account", $update, "id={$id}");
        functions::json(200, '成功');
    }
    /**
     * 修改备注
     */
    public function editNote()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $amount = request::filter('get.note');
        //检查该微信
        $update['note'] = $amount;
        $mysql->update("client_paofen_automatic_account", $update, "id={$id}");
        functions::json(200, '成功');
    }

    public function withdraw()
    {
        $key_id = request::filter('get.key_id');
        $type = request::filter('get.type');
        $pwd = intval(request::filter('get.pwd'));
        //检查该微信
        if ($pwd != '') {
            if (strlen($pwd) != 6) {
                functions::json(-1, '支付密码只能6位数');
            }
            $mysql = new mysql();
            $update_id = $mysql->update("client_paofen_automatic_account", ['receiving' => 2], "key_id='{$key_id}'");
            if ($update_id > 0) {
                \xh\library\gateway::withdraw($_SESSION['MEMBER']['uid'], $pwd, $key_id, 0, 'paofen');
                functions::json(200, '成功');

            }


        }
        functions::json(-1, '通道关闭失败');

    }
}