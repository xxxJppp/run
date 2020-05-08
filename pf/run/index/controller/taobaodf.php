<?php

namespace xh\run\index\controller;


use GatewayClient\Gateway;
use xh\library\model;
use xh\library\mysql;
use xh\library\view;
use xh\library\functions;
use xh\unity\page;
use xh\library\request;
use xh\unity\sms;
use xh\unity\userCog;
use xh\unity\upload;

class taobaodf{
    
    private $mysql;
    
    //初始化
    public function __construct(){
        (new model())->load('user', 'session')->check();
        $this->mysql = new mysql();
    }
    
    
    //全自动版
    public function automatic(){
        (new model())->load('user', 'group')->review('taobaodf_auto');
        $result = page::conduct('client_taobaodf_automatic_account',request::filter('get.page'),10,"user_id={$_SESSION['MEMBER']['uid']}",null,'id','asc');
         //获取城市
        $areaList = $this->mysql->query('city');
        $areaStr = '';
         foreach($areaList as $bk=>$bv){
             $areaStr .= "<option value='".$bv['cityname']."'>".$bv['cityname']."</option>";
         }
      
        new view('taobaodf/index', [
            'result' => $result,
            'areaStr' => $areaStr,
            'mysql'  => $this->mysql
        ]);
    }
  
    //码库
    public function maku(){
        (new model())->load('user', 'group')->review('taobaodf_auto');
        $result = page::conduct('client_taobaodf_qrcode',request::filter('get.page'),10,"user_id={$_SESSION['MEMBER']['uid']}",null,'id','asc');
         //获取城市
        $areaList = $this->mysql->query('city');
        $areaStr = '';
         foreach($areaList as $bk=>$bv){
             $areaStr .= "<option value='".$bv['cityname']."'>".$bv['cityname']."</option>";
         }
      
        new view('taobaodf/maku', [
            'result' => $result,
            'areaStr' => $areaStr,
            'mysql'  => $this->mysql
        ]);
    }
    
	 //添加账户-视图
    public function viewAdd(){
      
        $group = $this->mysql->query("city");
        new view('taobaodf/add',[
            'mysql'=>$this->mysql,
            'group'=>$group
        ]);
      
       
    }
	
   //添加二维码
    public function upewm(){
      
        $group = $this->mysql->query("city");
        new view('taobaodf/upewm',[
            'mysql'=>$this->mysql,
            'group'=>$group
        ]);
      
       
    }
  
  //添加账户-ajax请求
    public function upewmpost(){
        //账户类型
        
        $ewmjiexi=request::filter('post.ewmjiexi');

        $id = request::filter('post.id');
        $key_id = request::filter('post.key_id');
        //计算keyid
      
      
        //上传二维码
     
      $info = array_filter(explode("_", $_FILES['qrcode']['name']));
           
     //   echo $info[0];
   
      $taobao_orderid=str_replace(".jpg","",$info[1]);
     // var_dump($info);exit;
       $find_order = $this->mysql->query('client_taobaodf_qrcode',"taobao_orderid LIKE '{$taobao_orderid}'")[0];
       if (is_array($find_order)){
            functions::json(300, '当前淘宝订单号已存在，重新添加');
         exit;
        }
   
        $file = (new upload())->run($_FILES['qrcode'], ROOT_PATH . '/download/cache/images/'.$_SESSION['MEMBER']['uid'], ['jpg','png','jpeg'],1000);
   
        if (!is_array($file)) functions::json(-65, '收款码上传失败,文件上传只支持jpg/png/jpeg三种格式');
        //解析二维码
        $qrcode = '/download/cache/images/'.$_SESSION['MEMBER']['uid'].'/'. $file['new'];
      
       
        
        //删除文件
       // unlink(ROOT_PATH . '/download/cache/images/' . $file['new']);
     
    
      
        //添加通道
        $rc = $this->mysql->insert("client_taobaodf_qrcode", [
            'shop_id'=>$id,
            'ewm_url'=>$ewmjiexi,
            'img_url'=>$qrcode,
            'addtime'=>time(),
            'price'=>$info[0],
            'taobao_orderid'=>$taobao_orderid,
            'status'=>1,
            'user_id'=>$_SESSION['MEMBER']['uid'],
			'key_id'=>$key_id
        ]);
        if ($rc > 0) functions::json(200, '添加成功');
        functions::json(-69, '添加失败,请联系客服');
    }
    
	
	 //添加账户-ajax请求
    public function add(){
        //账户类型

		$name = request::filter('post.name');
		$ewmurl = request::filter('post.ewmurl');
        //计算keyid
        $key_id = strtoupper(substr(md5(mt_rand((mt_rand(1000,9999)+mt_rand(1000,9999)),mt_rand(1000000,99999999)) . time()), 0, 18));
        //添加通道
        $rc = $this->mysql->insert("client_taobaodf_automatic_account", [
            'name'=>$name,
            'ewmurl'=>$ewmurl,
            'time'=>time(),
            'status'=>4,
            'user_id'=>$_SESSION['MEMBER']['uid'],
			'key_id'=>$key_id
        ]);
		
        if ($rc > 0) functions::json(200, '添加成功');
        functions::json(-69, '添加失败,请联系客服');
    }
  
  
  
	 //添加账户-ajax请求
    public function automaticAddqrcode(){
        //账户类型

		$ewm_url = request::filter('get.ewm_url');
        $id = request::filter('get.id');
        $key_id = request::filter('get.key_id');
        $price = request::filter('get.price');
        //计算keyid
      
        //添加通道
        $rc = $this->mysql->insert("client_taobaodf_qrcode", [
            'shop_id'=>$id,
            'ewm_url'=>$ewm_url,
            'addtime'=>time(),
           'price'=>$price,
            'status'=>1,
            'user_id'=>$_SESSION['MEMBER']['uid'],
			'key_id'=>$key_id
        ]);
		
        if ($rc > 0) functions::json(200, '添加成功');
        functions::json(-69, '添加失败,请联系客服');
    }
	
  
  
	
    //添加
    public function automaticAdd()
    {
        (new model())->load("taobaodf", "features")->add($this->mysql);
      
      
    }

    //启动automatic轮训
    public function startAutomaticRb()
    {
        (new model())->load("taobaodf", "features")->startRb($this->mysql);
    }

    //启动网关
    public function startAutomaticGateway()
    {
        (new model())->load("taobaodf", "features")->startGateway($this->mysql);
    }

    //安全注销
    public function startAutomaticLogOut()
    {
        (new model())->load("taobaodf", "features")->startLogOut($this->mysql);
    }

    //请求登录
    public function startAutomaticLogin()
    {
        (new model())->load("taobaodf", "features")->startLogin($this->mysql);
    }

    //获取微信状态
    public function getAutomaticStatus()
    {
        (new model())->load("taobaodf", "features")->getStatus($this->mysql);
    }

    //删除微信
    public function automaticDelete()
    {
        (new model())->load("taobaodf", "features")->delete($this->mysql);
    }

   //删除微信
    public function automaticqrcodeDelete()
    {
        (new model())->load("taobaodf", "features")->qrcodedelete($this->mysql);
    }
  
    //修改微信名称
    public function automaticEditName()
    {
        (new model())->load("taobaodf", "features")->editName($this->mysql);
    }

    //全部订单
    public function automaticOrder()
    {
        (new model())->load("taobaodf", "features")->order($this->mysql);
    }

    //订单统计
    public function statisticOrder()
    {
        (new model())->load("taobaodf", "features")->statistic($this->mysql);
    }

    //手动补发
    public function automaticReissue()
    {
        (new model())->load("taobaodf", "features")->reissue($this->mysql);
    }

    //轮训通道测试
    public function robinTest()
    {
        new view('taobaodf/robinTest');
    }

    //单个微信测试
    public function gatewayTest()
    {
        new view('taobaodf/gatewayTest');
    }

    //微信配置
    public function automaticConfig()
    {
        new view('taobaodf/setting');

    }

    //微信配置result
    public function automaticConfigResult()
    {
        unset($_SESSION['automaticConfig']);
        $robin_arr = [1, 2, 3];
        $robin = intval(request::filter('get.robin'));
        if (!in_array($robin, $robin_arr)) functions::json(-1, '微信配置修改失败');
        userCog::update('automaticConfig', [
            'robin' => $robin
        ], $_SESSION['MEMBER']['uid']);
        functions::json(200, '微信配置更新成功!');
    }

    /*-----------------------------*/


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
            $list = $this->mysql->query("client_taobaodf_automatic_orders", "user_id={$_SESSION['MEMBER']['uid']}");
        } else {
            $list = $this->mysql->query("client_taobaodf_automatic_orders", "user_id={$_SESSION['MEMBER']['uid']}" . $where);
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
        $name = '支付宝订单';
        $data_info = array(
            array('id', '订单ID'),
            array('user_id', '商户ID'),
            array('user_name', '商户名称'),
            array('phone', '商户手机号'),
            array('trade_no', '交易订单号'),
            array('taobaodf_id', '微信ID'),
            array('amount', '金额'),
            array('percentage', '抽成'),
            array('status', '交易状态'),
            array('fees', '手续费'),
            array('pay_time', '异步通知时间'),
            array('callback_status', '异步通知状态'),
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
        $mysql->update("client_taobaodf_automatic_account", $update, "id={$id}");
        functions::json(200, '成功');
    }

     public function editMaxdd()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $dd = request::filter('get.dd');
        //检查该微信
        $update['max_dd'] = $dd;
        $mysql->update("client_taobaodf_automatic_account", $update, "id={$id}");
        functions::json(200, '成功');
    }
  
   public function areaAdd()
    {
        $mysql = new mysql();
        $id = intval(request::filter('get.id'));
        $area = request::filter('get.area');
        //检查该微信
        $update['area'] = $area;
        $mysql->update("client_taobaodf_automatic_account", $update, "id={$id}");
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
        $mysql->update("client_taobaodf_automatic_account", $update, "id={$id}");
        functions::json(200, '成功');
    }

    /**
     * 申请提现
     */
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
            $update_id = $mysql->update("client_taobaodf_automatic_account", ['receiving' => 2], "key_id='{$key_id}'");
            if($update_id > 0){
                \xh\library\gateway::withdraw($_SESSION['MEMBER']['uid'], $pwd, $key_id, 0, 'taobaodf');
                functions::json(200, '成功');

            }


        }
        functions::json(-1, '通道关闭失败');

    }
}
