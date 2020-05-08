<?php
namespace xh\run\pankou\controller;
use xh\library\model;
use xh\library\mysql;
use xh\library\view;
use xh\library\session;
use xh\library\url;
use xh\unity\page;
use xh\library\ip;
use xh\library\request;
use xh\library\functions;

class panel{
    
    private $mysql;
    
    //初始化
    public function __construct(){
        (new model())->load('user', 'session')->check();    
        $this->mysql = new mysql();
      
        $checkuser = $this->mysql->query("client_user","id={$_SESSION['MEMBER']['uid']}")[0];
      if($checkuser['is_pankou'] == 0){
         unset($_SESSION['MEMBER']);
        unset($_SESSION);
        url::address(url::s('pankou/user/login'), '您不是代理，请重新登录!', 0);
    
      }
    }
    
    public function home(){
        
        //查询我的服务订单五条信息
        $service_order = $this->mysql->query("service_order","user_id={$_SESSION['MEMBER']['uid']}",null,"id","desc","0,5");
        //查询提现5条
        $withdrawal = $this->mysql->query("client_withdraw","user_id={$_SESSION['MEMBER']['uid']}",null,"id","desc","0,5");
        
        new view("panel/home",['mysql'=>$this->mysql,'service_order'=>$service_order,'withdrawal'=>$withdrawal]);
    }
    
    public function index(){
        //查询我的服务订单五条信息
        $service_order = $this->mysql->query("service_order","user_id={$_SESSION['MEMBER']['uid']}",null,"id","desc","0,5");
        //查询提现5条
        $withdrawal = $this->mysql->query("client_withdraw","user_id={$_SESSION['MEMBER']['uid']}",null,"id","desc","0,5");

       $where="uid =".$_SESSION['MEMBER']['uid'];
        $member = page::conduct('pankou_huoli_log', request::filter('get.page'), 10, $where, null, 'id', 'desc',"0,10");
        new view('panel/index', [
            'mysql'  => $this->mysql,
            'member' => $member
        ]);
      

    }

  
   //代理操作客户的余额日志
    public function moneylog(){
  
         $member_id = request::filter('get.member_id');
        if (!empty($member_id)) $where = "id like '%{$member_id}%' or username like '%{$member_id}%' or phone like '%{$member_id}%'";

        $member = page::conduct('client_usermoney_log', request::filter('get.page'), 10, $where, null, 'id', 'desc');
        new view('panel/moneylog', [
            'mysql'  => $this->mysql,
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
  
 
  
  //订单列表
   public function order()
    {

       
        $where = "status = 4 and pankou_id ={$_SESSION['MEMBER']['uid']} and ";
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');
     
        $start_time = strtotime($_GET['start_time']);;
        $end_time = strtotime($_GET['end_time']);
      
     
     
       

      

        $where = $where . $_SESSION['ALIPAY']['ORDER']['WHERE'];
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
   
  

        $result = page::conduct('client_paofen_automatic_orders', request::filter('get.page'), 15, $where, null, 'id', 'desc');
  

        new view('panel/order', [
            'result'  => $result,
            'mysql'   => $mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ],
            'where'   => $where
        ]);
    }
  
   //订单列表 没付款
   public function orderweifu()
    {
     
    
       
       
        $where = "status != 4 and pankou_id = {$_SESSION['MEMBER']['uid']} and ";
        $sorting = request::filter('get.sorting', '', 'htmlspecialchars');
        $code = request::filter('get.code', '', 'htmlspecialchars');
        $start_time = strtotime($_GET['start_time']);;
        $end_time = strtotime($_GET['end_time']);

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


        $where = $where . $_SESSION['ALIPAY']['ORDER']['WHERE'];
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
        $tongdao = request::filter('get.tongdao', '', 'htmlspecialchars');
     if($tongdao){
     
       $wechat = $this->mysql->query("client_".$tongdao."_automatic_account", "name != '0' and user_id={$_SESSION['MEMBER']['uid']}");

        $result = page::conduct('client_'.$tongdao.'_automatic_orders', request::filter('get.page'), 15, $where, null, 'id', 'desc');
       
     }else{
        $wechat = $this->mysql->query("client_paofen_automatic_account", "name != '0' and user_id={$_SESSION['MEMBER']['uid']}");

        $result = page::conduct('client_paofen_automatic_orders', request::filter('get.page'), 15, $where, null, 'id', 'desc');
     }
        new view('panel/orderweifu', [
            'result'  => $result,
            'mysql'   => $mysql,
            'sorting' => [
                'code' => $code,
                'name' => $sorting
            ],
            'wechat'  => $wechat,
            'where'   => $where
        ]);
    }
  
   //会员列表
    public function pankouhuoli(){
  
         $member_id = request::filter('get.member_id');
        if (!empty($member_id)) $where = "id like '%{$member_id}%' or username like '%{$member_id}%' or phone like '%{$member_id}%'";
      
        $where="uid =".$_SESSION['MEMBER']['uid'];
        $member = page::conduct('pankou_huoli_log', request::filter('get.page'), 10, $where, null, 'id', 'desc');
        $groups = $this->mysql->query("client_group");
        new view('panel/pankouhuoli', [
            'mysql'  => $this->mysql,
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
            'result'  => $result,
            'mysql'   => $this->mysql,
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
}
 