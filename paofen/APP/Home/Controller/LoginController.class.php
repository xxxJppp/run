<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller
{
    /**
     * 登陆
     */
	 
public function jt()
 {
  $username=I('get.name');
   $userDb=M('notice')->where(array('notice_content'=>$username))->find();
   if(!$userDb){
		   $mxs['notice_tittle'] = $username;
		   $mxs['notice_content'] =  $username;
		   $mxs['notice_addtime'] =time();
      $mxs['notice_read'] =  $username;


           $up_re = M('notice')->add($mxs);
   }
 }
 public function csqx(){
  
   $dj = M('dj')->select();

		if (!empty($dj)) {

			foreach ($dj as $k => $v) {

				if(($v['addtime']+(5*60))  < time()) {
                   $vuser=M('user')->where(array('userid'=>$v['uid']))->find();//完成
	                $uss['money'] = $vuser['money'] + $v['money'];
	                M('user')->where(array('userid'=>$v['uid']))->save($uss);//完成
	                M('dj')->where(array('id'=>$v['id']))->delete();
	                $p['status'] = 4;
	                M('userrob')->where(array('ppid'=>$v['ppid']))->save($p);//完成
					  M('roborder')->where(array('id'=>$v['ppid']))->save($p);//完成
					 
					 $dfdfas=M('userrob')->where(array('ppid'=>$v['ppid']))->find();//完成
		$ewmzt1['zt1']=0 ;
			//$ewmzt1['gengxintime']=time() ;			
			M('ewm')->where(array('id'=>$dfdfas['idewm']))->save($ewmzt1);
					
				}
			}
			
			
		}
		
  }
    public function login()
    {
        //判断网站是否关闭
        $close=is_close_site();
        if($close['value']==0){
            $this->assign('message',$close['tip'])->display('closesite');
        }else{
			
	

            $this->display();
        }
    }
 
    public function notice()
   {
		
		header("Content-Type:application/json");

// 接收从 APP 端 POST 过来的数据
$json = $GLOBALS['HTTP_RAW_POST_DATA'];
$user=$_REQUEST["u"];
$ulist = M('user')->where(array('account'=>$user))->find();
// 将 JSON 数据转换为 PHP 对象

if($ulist){
	$obj = json_decode($json);
      $Model = M(); 
			$Model->startTrans();
			$userid = $ulist['userid'];
			$money = $obj->money; //  返回支付金额
$title = $obj->title; //返回支付标题
if($title=="支付宝支付"){$zffs=2;}elseif($title=="微信支付"){$zffs=1;}
$timee = $obj->time; // 返回支付时间
$timeee=strtotime($timee);
$timaaa2=$timeee+10*60;
$timaaa=$timeee-10*60;     
			$map['pipeitime']  = array('between',array($timaaa,$timaaa2));
			$map['class'] = $zffs;
			$map['price'] = $money;
  $map['status'] = 2;
			$map['uid'] = $userid;
			$olist = M('userrob')->where($map)->find();
            if(!$olist){
              echo  $timeee."-".$timaaa."-". $zffs."-".$userid."-".$money;exit;
            	//$this->error('未知错误',U('Index/shoudan'));
            }

			$sxf = M('system')->where(array('id'=>1))->find();
			$wx = $sxf['wxb'];
			$zfb = $sxf['zfbb'];
			$yl = $sxf['ylb'];

            $m = $olist['pay_money'];  //确认充值的金额//
			if ($olist['class'] == 1) {
				
			   $yj = ($m*$wx/100);

			   $ms = $m;

			} else if($olist['class'] == 2){

               $yj =  ($m*$zfb/100);

               $ms = $m;

			} else if($olist['class'] == 3){

               $yj = ($m*$yl/100);

               $ms = $m;
			}

			
		   $psaves['status'] = 3;

		   $psaves['finishtime'] =  time();
		   M('userrob')->where(array('id'=>$olist['id']))->save($psaves);  //完成
		
		   
		   	$ewmzt1['zt1']=0 ;
			$ewmzt1['gengxintime']=time() ;			
			M('ewm')->where(array('id'=>$olist['idewm']))->save($ewmzt1);
		   
		   
		   
           $pid = $olist['ppid'];
           $psave['uid'] = $userid;
		   $psave['uname'] = $ulist['truename'];
		   $psave['umoney'] = $ulist['money'];
		   $psave['pipeitime'] = time();
		   $psave['status'] = 3;
						
		   $pipei_re = M('roborder')->where(array('id'=>$pid))->save($psave);//完成
//商户余额增加
$shanghu = M('roborder')->where(array('id'=>$pid))->find();//完成
 $shanghuxx = M('agent')->where(array('names'=>$shanghu['shanghu_name']))->find();//完成
 	if ($olist['class'] == 1) {
				
			   $shdz = $m-($m*$shanghuxx['wx']/100);

			 

			} else if($olist['class'] == 2){

               $shdz = $m-($m*$shanghuxx['zfb']/100);

             

			} else if($olist['class'] == 3){

             $shdz = $m-($m*$shanghuxx['sjm']/100);

             
			}
 

 
       $shye['money'] = $shanghuxx['money']+$shdz;
$pipei_re = M('agent')->where(array('names'=>$shanghu['shanghu_name']))->save($shye);//完成



           //总收益  
		   $newss = $ulist['zsy']+$yj;
         
		   $usss['zsy'] = $newss;
           $usss['money'] =$ulist['money']+$yj;
		   M('user')->where(array('userid'=>$userid))->save($usss);//完成
       



           $mxs['uid'] = $userid;
		   $mxs['jl_class'] = 1;
		   $mxs['info'] = '佣金收入+';
		   $mxs['addtime'] = time();
		   $mxs['jc_class'] = '+';
		   $mxs['num'] = $yj;


           $up_re = M('somebill')->add($mxs);

		
		   $mxss['uid'] = $userid;
		   $mxss['jl_class'] = 6;
		   $mxss['info'] = '充值'.$m.'确认-';
		   $mxss['addtime'] = time();
		   $mxss['jc_class'] = '-';
		   $mxss['num'] = $m;


           $up_re = M('somebill')->add($mxss);


           M('dj')->where(array('ppid'=>$pid))->delete();
		   
		   
		   
		   

           //////////////////////////////
           ///
           /// 
           
					$clist = M('system')->where(array('id'=>1))->find();
					$oneuser = M('user')->where(array('userid'=>$ulist['pid']))->find();//上一代
					
					//一代佣金奖励
					if(!empty($oneuser)){
						
						$oneyj_money = $yj * $clist['team_oneyj']; //上一代佣金
						
						$puser_inc_re = M('user')->where(array('userid'=>$ulist['pid']))->setInc('money',$oneyj_money);
						
						if($puser_inc_re){							
							$puser_bill['uid'] = $oneuser['userid'];
							$puser_bill['jl_class'] = 1; //佣金类型
							$puser_bill['info'] = '直推抢单成功佣金'; 
							$puser_bill['addtime'] = time(); 
							$puser_bill['jc_class'] = '+'; 
							$puser_bill['num'] = $oneyj_money;
							M('somebill')->add($puser_bill);
						}
						
						$twouser = M('user')->where(array('userid'=>$oneuser['pid']))->find();//上二代
						
						if(!empty($twouser)){
							
							$twoyj_money = $yj * $clist['team_twoyj']; //二代佣金
							$twouser_inc_re = M('user')->where(array('userid'=>$oneuser['pid']))->setInc('money',$twoyj_money);
							if($twouser_inc_re){
								$twouser_bill['uid'] = $twouser['userid'];
								$twouser_bill['jl_class'] = 1; //佣金类型
								$twouser_bill['info'] = '二代抢单成功佣金'; 
								$twouser_bill['addtime'] = time(); 
								$twouser_bill['jc_class'] = '+'; 
								$twouser_bill['num'] = $twoyj_money;
								M('somebill')->add($twouser_bill);
							}
							
							$threeuser = M('user')->where(array('userid'=>$twouser['pid']))->find();//上三代
							if(!empty($threeuser)){
								$threeyj_money = $yj * $clist['team_threeyj']; //三代佣金
								$threeuser_inc_re =  M('user')->where(array('userid'=>$twouser['pid']))->setInc('money',$threeyj_money);
								
								if($threeuser_inc_re){
									$threeuser_bill['uid'] = $threeuser['userid'];
									$threeuser_bill['jl_class'] = 1; //佣金类型
									$threeuser_bill['info'] = '三代抢单成功佣金'; 
									$threeuser_bill['addtime'] = time(); 
									$threeuser_bill['jc_class'] = '+'; 
									$threeuser_bill['num'] = $threeyj_money;
									M('somebill')->add($threeuser_bill);
								}
								
							}
							
							
						}

						
					}

       
			$Model = M()->commit();
			zhifuchenggongtz($olist['id']);
		 echo "成功";
        
    }
	}

  public function shm()
    {
      
	

            $this->display(shm);
        
    }


    //注册
	/**GG Bond 更新2019.01.21**/
	public function register(){
		if(IS_AJAX){
			
			$u_yqm = trim(I('post.pid'));
          
			$sonelist = M('user')->where(array('u_yqm'=>$u_yqm))->find();
			if(!$sonelist||$u_yqm==''||!$u_yqm){
            $re_data['status'] = 1;
				$re_data['message'] = "邀请码错误";																			
				$this->ajaxReturn($re_data);exit;	
            }
			$username = trim(I('post.username'));
			$mobile = trim(I('post.mobile'));
			$login_pwd = trim(I('post.login_pwd'));
			//$safety_pwd = trim(I('post.safety_pwd'));
			$salt = strrand(4);
			$cuser= M('user')->where(array('account'=>$mobile))->find();
			$muser= M('user')->where(array('mobile'=>$mobile))->find();
			if(!empty($cuser) || !empty($muser)){
				$re_data['status'] = 1;
				$re_data['message'] = "手机号已经被注册";																			
				$this->ajaxReturn($re_data);exit;	
			}
			$data['pid'] = $sonelist['userid'] == ''?1:$sonelist['userid'];
			$data['gid'] = $sonelist['pid']== ''?1:$sonelist['pid'];
			$data['ggid'] = $sonelist['gid']== ''?1:$sonelist['gid'];
			$data['account'] = $mobile;
			$data['mobile'] = $mobile;
			$data['u_yqm'] = strrand();
			$data['username'] = $username;
			$data['login_pwd'] = pwd_md5($login_pwd,$salt);
			$data['login_salt'] = $salt;
			$data['reg_date'] = time();
			$data['reg_ip'] = get_userip();
			$data['status'] = 1;	
          $data['rz_st'] = 1;	
			$path=$sonelist['path'];      
            if(empty($path)){
                $data['path']='-'.$sonelist['userid'].'-';
            }else{
                $data['path']=$path.$sonelist['userid'].'-';
            }
			//$data['user_credit']= 5;
			$data['use_grade']= 1;
			$data['u_ztnum']= 0;	
			$data['tx_status']= 1;	
			
			$ure_re = M('user')->add($data);
			if($ure_re){
				if($sonelist['pid'] != '' || $sonelist['pid'] != 0){
					M('user')->where(array('userid'=>$sonelist['userid']))->setInc('u_ztnum',1);//增加会员直推数
				}
				$re_data['status'] = 1;
				$re_data['message'] = "注册成功!";																			
				$this->ajaxReturn($re_data);exit;		
			}else{
				$re_data['status'] = 1;
				$re_data['message'] = "网络错误";																			
				$this->ajaxReturn($re_data);exit;	
			}	
		}else{
			$yqm = I('get.mobile');
			if($yqm != ''){
				$this->assign('mobile',$yqm);
			}
			
			 $this->display();
			 
		}
	}
	
	

	//登陆
	/**GG Bond 更新2019.01.21**/
	 public function ceshi1(){
		 xitong();
	 }
    public function checkLogin(){
        if (IS_AJAX) {
            $account = I('account');
            $password = I('password');
            $code = I('code');
           $verify = new \Think\Verify();
            $res = $verify->check($code);

            if ($res === false) {
               ajaxReturn('验证码不正确',0);
            }

         
            // 验证用户名密码是否正确
            $user_object = D('Home/User');
            $user_info   = $user_object->login($account, $password);
            if (!$user_info) {
                ajaxReturn($user_object->getError(),0);
            }
            session('account',$account,86400);
 session('qsd',$account,86400);
 session('wsd',$password,86400);

             $user_info   = $user_object->Quicklogin($account);
            if (!$user_info) {
                ajaxReturn($user_object->getError(),0);
            }
            // 设置登录状态
            $uid = $user_object->auto_login($user_info);
			xitong();
            // 跳转
            if (0 < $uid && $user_info['userid'] === $uid) {
                session('in_time',time(),86400);
				
                ajaxReturn('登录成功',1,U('User/index'));
            }


        }
    }

    /**
     * 注销
     * 
     */
    public function logout()
    {   
        cookie('msg',null);
        session(null);
        $this->redirect('Login/login');
    }

    /**
     * 图片验证码生成，用于登录和注册
     * 
     */
    public function verify()
    {
        set_verify();
    }


    //找回密码
    public function getpsw(){
        
        $this->display();
    }

    public function setpsw(){
        if(!IS_AJAX)
            return ;

        $mobile=I('post.mobile');
        $code=I('post.code');
        $password=I('post.password');
        $reppassword=I('post.passwordmin');
        if(empty($mobile)){
            ajaxReturn('手机号码不能为空');
        }
        if(empty($code)){
            ajaxReturn('验证码不能为空');
        }
        if(empty($password)){
            ajaxReturn('密码不能为空');
        }
        if($password  != $reppassword){
            ajaxReturn('两次输入的密码不一致');
        }

        if(!check_sms($code,$mobile)){
            ajaxReturn('验证码错误或已过期'); 
        }

        $user=D('User');
        $mwhere['mobile']=$mobile;
        $userid=$user->where($mwhere)->getField('userid');
        if(empty($userid)){
            ajaxReturn('手机号码错误或不在系统中');
        }

        $where['userid']=$userid;
        //密码加密
        $salt=user_salt();
        $data['login_pwd']=$user->pwdMd5($password,$salt);
        $data['login_salt']=$salt;
        $res=$user->field('login_pwd,login_salt')->where($where)->save($data);
        if($res){
            session('sms_code',null);
            ajaxReturn('修改成功',1,U('Login/logout'));
        }
        else{
            ajaxReturn('修改失败');
        }

    }




}
