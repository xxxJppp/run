<?php
namespace xh\run\index\model;
use xh\library\model;
use xh\library\functions;
use xh\library\request;
use xh\library\view;
use xh\unity\page;
use xh\unity\callbacks;
use xh\library\url;

class features{
    
    //自动验证
    public function __construct(){
        (new model())->load('user', 'group')->review('wechatphone_auto');
    }

    public function add($mysql){
        //添加微信通道
        //检测当前拥有多少条通道
        $find_wechatphone_auto_count = $mysql->select("select count(id) as count from " . DB_PREFIX . "client_wechatphone_automatic_account where user_id={$_SESSION['MEMBER']['uid']}")[0]['count'];
        $swrc = (new model())->load('user', 'group')->check('wechatphone_auto');
        
        if (!is_array($swrc)) functions::json(-3, '您暂时还不能添加通道,请稍后再试!');
        if ($swrc['quantity'] != 0){
            if ($find_wechatphone_auto_count >= $swrc['quantity']) functions::json(-2, '您当前只有'.$swrc['quantity'].'条通道,无法再继续新增!');
        }
        //开始添加通道
        $key_id = strtoupper(substr(md5(mt_rand((mt_rand(1000,9999)+mt_rand(1000,9999)),mt_rand(1000000,99999999))), 0, 18));
        $in = $mysql->insert("client_wechatphone_automatic_account", [
            'name'=>0,
            'status'=>1,
            'login_time'=>0,
            'heartbeats'=>0,
            'active_time'=>0,
            'user_id'=>$_SESSION['MEMBER']['uid'],
            'key_id'=>$key_id,
            'training'=>2,
            'receiving'=>2,
            'android_heartbeat'=>0
        ]);
        
        if ($in>0) {
            $_SESSION['ADD_GATEWAY'] = 2;
            functions::json(200, '恭喜您新增了一条微信Automatic通道');
        }
        
        functions::json(-3, '新增微信Automatic通道失败,请联系客服!');
    }
    
    
   public function editName($mysql)
    {
        
        $id = intval(request::filter('get.id'));
        $app_user = request::filter('get.app_user');
        //检查该微信
        $update['app_user'] = $app_user;
        $mysql->update("client_wechatphone_automatic_account", $update, "id={$id}");
        functions::json(200, '成功');
    }
  
  
    public function startRb($mysql){
        $id = intval(request::filter('get.id'));
        //检查该微信
        $find_wechatphone = $mysql->query("client_wechatphone_automatic_account","id={$id} and user_id={$_SESSION['MEMBER']['uid']}")[0];
      //  if (!is_array($find_wechatphone)) functions::json(-3, '更改异常,请联系客服!');
        $training = 2;
        if ($find_wechatphone['training'] == 2) {
            //开启状态
            $training = 1;
            //检测账号是否异常
          //  if ($find_wechatphone['status'] != 1) functions::json(-3, '更改失败,当前微信没有在线!');
        }
        $update = $mysql->update("client_wechatphone_automatic_account", [
            'training'=>$training
        ],"id={$id}");
        if ($update > 0) functions::json(200, '更改轮训成功!');
        functions::json(-2, '更改失败,请联系客服!');
    }
    
    
    public function startGateway($mysql){
        $id = intval(request::filter('get.id'));
        //检查该微信
        $find_wechatphone = $mysql->query("client_wechatphone_automatic_account","id={$id} and user_id={$_SESSION['MEMBER']['uid']}")[0];
    //    if (!is_array($find_wechatphone)) functions::json(-3, '更改异常,请联系客服!');
        $receiving = 2;
        if ($find_wechatphone['receiving'] == 2) {
            //开启状态
            $receiving = 1;
            //检测账号是否异常
         //   if ($find_wechatphone['status'] != 1) functions::json(-3, '更改失败,当前微信没有在线!');
        }
        $update = $mysql->update("client_wechatphone_automatic_account", [
            'receiving'=>$receiving
        ],"id={$id}");
        if ($update > 0) functions::json(200, '更改网关成功!');
        functions::json(-2, '更改失败,请联系客服!');
    }
    
    public function startLogOut($mysql){
        $id = intval(request::filter('get.id'));
        //检查该微信
        $find_wechatphone = $mysql->query("client_wechatphone_automatic_account","id={$id} and user_id={$_SESSION['MEMBER']['uid']}")[0];
        if (!is_array($find_wechatphone)) functions::json(-3, '当前微信出现异常,请联系客服!');
        if ($find_wechatphone['status'] == 6 || $find_wechatphone['status'] == 1) functions::json(-3, '当前微信账号已经安全注销过了!');
        $update = $mysql->update("client_wechatphone_automatic_account", [
            'status'=>6
        ],"id={$id}");
        if ($update > 0) functions::json(200, '安全注销成功!');
        functions::json(-2, '注销失败,请联系客服!');
    }
    
    public function startLogin($mysql){
        $id = intval(request::filter('get.id'));
        //检查该微信
        $find_wechatphone = $mysql->query("client_wechatphone_automatic_account","id={$id} and user_id={$_SESSION['MEMBER']['uid']}")[0];
        if (!is_array($find_wechatphone)) functions::json(-3, '当前微信出现异常,请联系客服!');
        if ($find_wechatphone['status'] == 4 || $find_wechatphone['status'] == 6) functions::json(-3, '当前微信账号状态无法进行登录,请稍后重试!');
        $update = $mysql->update("client_wechatphone_automatic_account", [
            'status'=>2,
            'login_time'=>time()
        ],"id={$id}");
        functions::json(200, '正在获取登录信息..');
    }
    
    public function getStatus($mysql){
        $id = intval(request::filter('get.id'));
        //检查该微信
        $find_wechatphone = $mysql->query("client_wechatphone_automatic_account","id={$id} and user_id={$_SESSION['MEMBER']['uid']}")[0];
        //判断微信登录时间
        if ($find_wechatphone['login_time'] + 120 < time() || $find_wechatphone['status'] == 6 || $find_wechatphone['status'] == 5 || $find_wechatphone['status'] == 1) {
            $mysql->update("client_wechatphone_automatic_account", ['status'=>1],"id={$id}");
            functions::json(-2, '微信登录超时!');
        }
        if ($find_wechatphone['status'] == 2) functions::json(2, '正在获取登录信息..');
        if ($find_wechatphone['status'] == 3) functions::json(3, '登录信息获取成功,准备登录..');
        if ($find_wechatphone['status'] == 7) functions::json(7, '请扫码登录',['img'=>$find_wechatphone['login_img']]);
        if ($find_wechatphone['status'] == 4) {
            $_SESSION['GATEWAY_LOGIN'] = 2;
            functions::json(4, '登录成功');
        }
    }
    
    public function delete($mysql){
        $id = intval(request::filter('get.id'));
        $pwd = functions::pwd(request::filter('get.pwd'), $_SESSION['MEMBER']['token']);
        //查询用户信息
        $pwd_server = $mysql->query("client_user","id={$_SESSION['MEMBER']['uid']}")[0]['pwd'];
        if ($pwd != $pwd_server) functions::json(-1, '您的密码输入有误!');
        //检查该微信
        $find_wechatphone = $mysql->query("client_wechatphone_automatic_account","id={$id} and user_id={$_SESSION['MEMBER']['uid']}")[0];
      //  if (!is_array($find_wechatphone)) functions::json(-2, '删除该微信号时出现一个错误,请及时联系客服!');
      //  if ($find_wechatphone['status'] == 6) functions::json(-2, '当前微信正在进行安全注销,请耐心等待注销完成后再进行删除!');
       // if ($find_wechatphone['status'] != 1) functions::json(-2, '请将微信安全下线后再进行删除!');
        $mysql->delete("client_wechatphone_automatic_account", "id={$id} and user_id={$_SESSION['MEMBER']['uid']}");
        functions::json(200, '您成功的删除了该微信!');
    }
    
    public function order($mysql){
        $where = "user_id={$_SESSION['MEMBER']['uid']} and ";
        $sorting = request::filter('get.sorting','','htmlspecialchars');
        $code = request::filter('get.code','','htmlspecialchars');
        
        //wechatphone
        if ($sorting == 'wechatphone'){
            if ($code != '' && $_SESSION['wechatphone']['ORDER']['WHERE'] == ''){
                $code_arr = explode(",", $code);
                if (is_array($code_arr)){
                    $wecaht_where = '';
                    for ($i=0;$i<count($code_arr);$i++){
                        $wecaht_where .= ' or wechatphone_id=' . $code_arr[$i];
                    }
                    
                    $_SESSION['wechatphone']['ORDER']['WHERE'] .= '(' . trim(trim($wecaht_where),'or') . ')';
                }
            }
            
            if ($_GET['locking'] == 'closed'){
                unset($_SESSION['wechatphone']['ORDER']['WHERE']);
            }
        }
        
        
        
        $where = $where . $_SESSION['wechatphone']['ORDER']['WHERE'];
        $where = trim(trim($where),'and');
        
        //排序
        if ($sorting == 'status'){
            if ($code < 1) $code = 0;
            if ($code <= 4) $where .= ' and status=' . $code;
            if ($code > 4) $code = 0;
        }
        //callback
        if ($sorting == 'callback'){
            if ($code < 0) $code = 0;
            if ($code <= 1) $where .= ' and callback_status=' . $code;
            if ($code > 1) $code = -1;
        }
        //订单号
        if ($sorting == 'trade_no'){
            if ($code != '') {
                $code = trim($code);
               $where .= " and (trade_no like '%{$code}%' or out_trade_no like '%{$code}%')";
            }
        }
        
        //查询自己的所有微信
        $wechatphone = $mysql->query("client_wechatphone_automatic_account","name != '0' and user_id={$_SESSION['MEMBER']['uid']}");
        
        $result = page::conduct('client_wechatphone_automatic_orders',request::filter('get.page'),15,$where,null,'id','desc');
        
        new view('wechatphone/order',[
            'result'=>$result,
            'mysql'=>$mysql,
            'sorting'=>[
                'code'=>$code,
                'name'=>$sorting
            ],
            'wechatphone' => $wechatphone,
            'where' => $where
        ]);
    }
  
    public function statistic($mysql)
    {
        $where = "user_id={$_SESSION['MEMBER']['uid']} and ";
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');
//        $start_time = request::filter('get.start_time','','htmlspecialchars');
//        $end_time = request::filter('get.end_time','','htmlspecialchars');
        $start_time = strtotime($_GET['start_time']);;
        $end_time = strtotime($_GET['end_time']);
        //wechatphone
        if ($sorting == 'wechatphone') {
            if ($code != '' && $_SESSION['wechatphone']['ORDER']['WHERE'] == '') {
                $code_arr = explode(",", $code);
                if (is_array($code_arr)) {
                    $wecaht_where = '';
                    for ($i = 0; $i < count($code_arr); $i++) {
                        $wecaht_where .= ' or wechatphone_id=' . $code_arr[$i];
                    }

                    $_SESSION['wechatphone']['ORDER']['WHERE'] .= '(' . trim(trim($wecaht_where), 'or') . ')';
                }
            }

            if ($_GET['locking'] == 'closed') {
                unset($_SESSION['wechatphone']['ORDER']['WHERE']);
            }
        }


        $where = $where . $_SESSION['wechatphone']['ORDER']['WHERE'];
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
        //查询自己的所有微信
        $wechatphone = $mysql->query("client_wechatphone_automatic_account", "name != '0' and user_id={$_SESSION['MEMBER']['uid']}");

        $result = page::conduct('client_wechatphone_automatic_orders', request::filter('get.page'), 15, $where, null, 'id', 'desc');

        new view('wechatphone/statistic', [
            'result'  => $result,
            'mysql'   => $mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ],
            'wechatphone'  => $wechatphone,
            'where'   => $where
        ]);
    }
    
   public function reissue($mysql)
    {
        $module_name = 'wechatphone_auto';
        $order_id = request::filter('get.id');
        if (empty($order_id)) functions::json(-1, '订单ID错误');
        $order = $mysql->query('client_wechatphone_automatic_orders', "id={$order_id} and user_id={$_SESSION['MEMBER']['uid']}")[0];
        if (!is_array($order)) functions::json(-2, '当前订单不存在');

        //得到用户组
        $group = $mysql->query('client_group', "id={$_SESSION['MEMBER']['group_id']}")[0];
        $agent_group = $mysql->query('agent_rate',"uid={$_SESSION['MEMBER']['uid']}")[0];
      
        //解析数据
        $authority = json_decode($group['authority'], true)[$module_name];
        if (!is_array($group) || $group['authority'] == -1 || $authority['open'] != 1) functions::json(-1, '用户组错误');

        $user = $mysql->query("client_user", "id={$_SESSION['MEMBER']['uid']}")[0];
        if (!is_array($user)) functions::json(-1, '商户错误');

      //获取上级用户组
        $shangji=$user['level_id'];
       if($shangji !== '0' ){
        $duser = $mysql->query("client_user", "id={$shangji}")[0];
        $dailigroup = $mysql->query('client_group', "id={$duser['group_id']}")[0];
        //解析数据
        $dailiauthority = json_decode($dailigroup['authority'], true)[$module_name];
          //获取代理给商户的费率
        $shanghuauthority = json_decode($agent_group['authority'], true);
      
           //代理的获利    给商户的费率-代理的费率
        $fess2= $shanghuauthority{$module_name}- $dailiauthority['cost'];
    
      //系统对代理的费率
       $dailifees = $order['amount'] * $dailiauthority['cost'];
      
       $dailihuoli = $order['amount'] * $fess2;


       $shanghufees = $order['amount'] * $shanghuauthority{$module_name};
     

      
        $isCallback = 0;

        if ($order['reached'] == 1) {
            $isCallback = 1;
        } else {
          
             $shanghu_balance = $user['balance'] -  $shanghufees; // 用户最终余额
            $user_balance = floatval($shanghu_balance);
          
                $daili_balance = $duser['balance'] +  $dailihuoli; // 代理最终余额
                $daili_balance = floatval($daili_balance);
          
            if ($user_balance >= 0) {
                $isCallback = 1;

                $updateStatus = $mysql->update("client_user", ['balance' => $user_balance], "id={$user['id']}");
                $updateStatus_daili =$mysql->update("client_user", ['balance' => $daili_balance], "id={$duser['id']}");
              
                        //写代理获利记录
                     $mysql->insert("agent_huoli_log", [
                          'uid' => $_SESSION['MEMBER']['uid'],
                          'agent_id' =>$duser['id'],
                          'orderid' => $order_id,
                          'amount'    => $order['amount'],
                          'huoli'  => $dailihuoli,
                          'trade_no' =>$order['trade_no'],
                          'daili_balance' =>$daili_balance,
                         'shanghu_fees' =>$shanghufees,
                        'type' =>'微信商家',
                         'time' => time()
                  ]);
          
             
              
                if ($updateStatus !== false) {
                    $_SESSION['MEMBER']['balance'] = $user_balance;
                    $mysql->update("client_wechatphone_automatic_orders", ['reached' => 1], "id={$order['id']}");
                }
            } else {
                functions::json(-1, '账户余额不足，回调失败');
            }
        }
       }else {
          
         
          $fees = $order['amount'] * $authority['cost'];
          
             $dailifees = 0;
              $shanghufees = $fees;
              $dailihuoli = 0;
              
          
        
        $isCallback = 0;

        if ($order['reached'] == 1) {
            $isCallback = 1;
        } else {
            $user_balance = $user['balance'] - $fees; // 用户最终余额
            $user_balance = floatval($user_balance);

          
          
            if ($user_balance >= 0) {
                $isCallback = 1;
                
                $updateStatus = $mysql->update("client_user", ['balance' => $user_balance], "id={$user['id']}");

              
              
                if ($updateStatus !== false) {
                    $_SESSION['MEMBER']['balance'] = $user_balance;
                    $mysql->update("client_wechatphone_automatic_orders", ['reached' => 1], "id={$order['id']}");
                }
            } else {
                functions::json(-1, '账户余额不足，回调失败');
            }
        }

        
        
        }
    

        //检测订单是否为未支付
        if ($order['status'] != 4) {
            $mysql->update("client_wechatphone_automatic_orders", [
                'pay_time'         => time(),
                'status'           => 4,
                'callback_time'    => time(),
                'callback_status'  => 1,
                'callback_content' => '商户后台回调',
            ], "id={$order['id']}");
        } else {
            $mysql->update("client_wechatphone_automatic_orders", [
                'callback_time'    => time(),
                'callback_status'  => 1,
                'callback_content' => '商户后台回调',
            ], "id={$order['id']}");
        }

        if ($isCallback == 1) {
            $pay_time = $order['pay_time'] == 0 ? time() : $order['pay_time'];

            $result = callbacks::curl($order['callback_url'], http_build_query([
                'account_name'  => $_SESSION['MEMBER']['username'],
                'pay_time'      => $pay_time,
                'status'        => 'success',
                'amount'        => $order['amount'],
                'out_trade_no'  => $order['out_trade_no'],
                'trade_no'      => $order['trade_no'],
                'fees'          => $shanghufees,
                'sign'          => functions::sign($_SESSION['MEMBER']['key_id'], [
                    'amount'       => $order['amount'],
                    'out_trade_no' => $order['out_trade_no']
                ]),
                'callback_time' => time(),
                'type'          => 1,
                'account_key'   => $_SESSION['MEMBER']['key_id']
            ]));
            $mysql->update("client_wechatphone_automatic_orders", [
                'fees' => $shanghufees,
               'xitong_fees'   => $dailifees,
               'agent_rate'     => $dailihuoli,
            ], "id={$order['id']}");
        }


        functions::json(200, ' [' . date("Y/m/d H:i:s", time()) . ']: 订单号->' . $order['trade_no'] . ' 异步通知任务下发成功!');
        //-----------------------------
    }
    
}