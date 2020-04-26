<?php
namespace Home\Controller;
use Think\Controller;
use Vendor\TTKClient;
use Think\Page;

class UserController extends CommonController
{
   public function index()
    {
		$uid = session('userid');
		$ulist = M('user')->where(array('userid'=>$uid))->find();
    
     
      $start=strtotime(date('Y-m-d'));
		
        $end=$start+86400;
     $map['uid']=$uid;
     $map['class']=2;
     $map['status']=3;
     $map['pipeitime']=array(between,array($start,$end));
     $zfb=M('userrob')->where($map)->sum('price');$zfb=0+$zfb;
      $map2['uid']=$uid;
     $map2['class']=1;
     $map2['status']=3;
     $map2['pipeitime']=array(between,array($start,$end));
     $wx=M('userrob')->where($map2)->sum('price');$wx=0+$wx;
      $mapt['uid']=$uid;
     $mapt['class']=3;
     $mapt['status']=3;
     $mapt['pipeitime']=array(between,array($start,$end));
     $yhk=M('userrob')->where($mapt)->sum('price');$yhk=0+$yhk;
      $map3['uid']=$uid;
     $map3['status']=3;
     $map3['pipeitime']=array(between,array($start,$end));
     $zzz=M('userrob')->where($map3)->sum('price');$zzz=0+$zzz;
      $map4['uid']=$uid;
     $map4['ts']=array('gt',0);
     $ts=M('userrob')->where($map4)->count();$ts=0+$ts;
    $djs = M('dj')->where(array('uid'=>$uid))->sum('money');
     $djs=0+$djs;
			$this->assign('djs',$djs);
     $this->assign('ts',$ts);
		$this->assign('list',$ulist);
     $this->assign('zfb',$zfb);
     $this->assign('yhk',$yhk);
     $this->assign('wx',$wx);
     $this->assign('zzz',$zzz);
        $this->display();
    }
	
	   public function shezhi()
    {
	 
		$ulist = M('system')->where(array('id'=>1))->find();
		$this->assign('list1',$ulist['qd_kf']);
        $this->display();
    }
		//个人信息
	public function xinxi(){
		$uid = session('userid');
		$ulist = M('user')->where(array('userid'=>$uid))->find();
		$this->assign('list',$ulist);
		$this->display();
	}

	//个人信息
	public function bill(){
		$uid = session('userid');
		$userobj = M('somebill');
		
		$count =$userobj->where(array('userid'=>$uid))->count();
		//$p = $this->getpage($count,15);
		
		$list = $userobj->where (array('uid'=>$uid))->order ( 'id desc' )->limit ( $p->firstRow, $p->listRows )->select ();

    	$this->assign ( 'list', $list ); // 賦值數據集
		$this->assign('count',$count);
    	//$this->assign ( 'page', $p->show() ); // 賦值分頁輸出
		$this->display();
	}
	
	//个人信息
	public function yjbill(){
		$uid = session('userid');
		$userobj = M('somebill');
		
		$count =$userobj->where(array('userid'=>$uid))->count();
		//$p = $this->getpage($count,15);
		
		$list = $userobj->where (array('uid'=>$uid,'jl_class'=>5))->order ( 'id desc' )->limit ( $p->firstRow, $p->listRows )->select ();

    	$this->assign ( 'list', $list ); // 賦值數據集
		//print_R($list);
		$this->assign('count',$count);
    	//$this->assign ( 'page', $p->show() ); // 賦值分頁輸出
		$this->display();
	}
	public function getpage(&$m,$where,$pagesize=10){
		$m1=clone $m;//浅复制一个模型
		$count = $m->where($where)->count();//连惯操作后会对join等操作进行重置
		$m=$m1;//为保持在为定的连惯操作，浅复制一个模型
		$p=new Think\Page($count,$pagesize);
		$p->lastSuffix=false;
		$p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$p->setConfig('prev','上一页');
		$p->setConfig('next','下一页');
		$p->setConfig('last','末页');
		$p->setConfig('first','首页');
		
		$p->parameter=I('get.');

		$m->limit($p->firstRow,$p->listRows);

		return $p;
	}
	//修改密码
	public function password(){
		$uid = session('userid');
			
		$ulist = M('user')->where(array('userid'=>$uid))->find();
		$this->assign('info',$ulist);
		$this->display();
	}

	public function upma(){

		$id = trim(I('get.id'));
	    $userobj = M('ewm');

		$info =$userobj->where(array('id'=>$id))->find();
	
    
   
    
		//print_R($list);
		$this->assign('info',$info);
    	//$this->assign ( 'page', $p->show() ); // 賦值分頁輸出
		$this->display();
	}
	
	//资料
	public function zichan(){
		
		
		$uid = session('userid');			
		$ulist = M('user')->where(array('userid'=>$uid))->find();
		$clist = M('system')->where(array('id'=>1))->find();




		$sum_jj = M('somebill')->where(array('uid'=>$uid,'jl_class'=>1))->sum('num');
		$sum_ysk = M('userrob')->where(array('uid'=>$uid,'status'=>3))->sum('price');
		$sum_dsk = M('userrob')->where(array('uid'=>$uid,'status'=>2))->sum('price');
	



		$this->assign('sum_dsk',$sum_dsk); //待收款

		$this->assign('sum_ysk',$sum_ysk);//已收款

		$this->assign('sum_jj',$sum_jj);//奖励

		$this->assign('clist',$clist);

		$this->assign('info',$ulist);
		
		
		$this->display();
	}
	
	//重置密码
	public function set_password(){
		if($_POST){
			$uid = session('userid');
			
			$ulist = M('user')->where(array('userid'=>$uid))->find();
			$salt = $ulist['login_salt'];
			$password = trim(I('post.password'));
			$ymm = trim(I('post.y_password'));
			$ymmjj=pwd_md5($ymm,$salt);
if($ymmjj<>$ulist['login_pwd']){
	$data['status'] = 0;
				$data['msg'] = '原密码验证失败';
				$this->ajaxReturn($data);exit;
}
			
			
			$sava['login_pwd'] = pwd_md5($password,$salt);
			$re = M('user')->where(array('userid'=>$uid))->save($sava);
			if($re){
				$data['status'] = 1;
				$data['msg'] = '设置成功';
				$this->ajaxReturn($data);exit;
			}else{
				$data['status'] = 0;
				$data['msg'] = '密码没变,设置失败';
				$this->ajaxReturn($data);exit;
			}
			
		}else{
			$data['status'] = 0;
			$data['msg'] = '网络错误';
			$this->ajaxReturn($data);exit;
		}
	}

	public function tys(){

		if($_POST){
			$uid = session('userid');
			
			
			$id = trim(I('post.id'));

			

			$sli = M('ewm')->where(array('id'=>$id))->find();
           

            if ($sli['zt'] == 1) {
            	$sava['zt'] = 0;
            	$msg = '已停用';
            } else {
            	$msg = '已启用';
                $sava['zt'] = 1;
				 $sava['gengxintime'] = time();
            }

            $re = M('ewm')->where(array('id'=>$id))->save($sava);
			if($re){
				$data['status'] = 1;
				$data['msg'] = $msg;
				$this->ajaxReturn($data);

				exit;
			}else{
				$data['status'] = 0;
				$data['msg'] = '失败';
				$this->ajaxReturn($data);exit;
			}
			
		}else{
			$data['status'] = 0;
			$data['msg'] = '网络错误';
			$this->ajaxReturn($data);exit;
		}
	}
	
	//个人资料
	public function ziliao(){
		$this->display();
	}
	
	//保存资料
	public function set_info(){
		if($_POST){
			$uid = session('userid');
			$mobile = trim(I('post.mobile'));
			$save['username'] = trim(I('post.username'));
			$save['truename'] = trim(I('post.truename'));
			$save['email'] = trim(I('post.email'));
			$save['userqq'] = trim(I('post.userqq'));
			$save['wx_no'] = trim(I('post.wx_no'));
			$save['alipay'] = trim(I('post.alipay'));
			$save['usercard'] = trim(I('post.usercard'));
			$save['rz_st'] = 1;

			$re = M('user')->where(array('userid'=>$uid))->save($save);
			
			//echo M('user')->getLastSql();  exit;
			if($re){
				$data['status'] = 1;
				$data['msg'] = '保存成功';
				$this->ajaxReturn($data);exit;
			}else{
				$data['status'] = 0;
				$data['msg'] = '保存失败';
				$this->ajaxReturn($data);exit;
			}			
		}else{
			$data['status'] = 0;
			$data['msg'] = '网络错误';
			$this->ajaxReturn($data);exit;
		}
	}
	//银行卡管理

	public function yinhangka(){
		$uid = session('userid');
		$clist = M('bankcard')->where(array('uid'=>$uid))->order('id desc')->select();
		$this->assign("clist",$clist);
		$this->display();
	}
	//添加银行卡处理
	public function tjyhk(){
		
		$this->display();
	}

	//添加银行卡处理
	public function set_addcard(){
		if($_POST){
			$uid = session('userid');
			$save['bankname'] = trim(I('post.bankname'));
			$save['name'] = trim(I('post.name'));
			$save['banknum'] = trim(I('post.banknum'));
			$save['uid'] = $uid ;
			$save['addtime'] = time() ;
			
			$only  = M('bankcard')->where(array('banknum'=>$save['banknum']))->count();
			if($only >=1){
				$data['status'] = 0;
				$data['msg'] = '该银行卡已存在';
				$this->ajaxReturn($data);exit;
			}
			$cnum = M('bankcard')->where(array('uid'=>$uid))->count();
			if($cnum > 10){
				$data['status'] = 0;
				$data['msg'] = '账号已达上限';
				$this->ajaxReturn($data);exit;
			}
			$re = M('bankcard')->add($save);
			if($re){
				$data['status'] = 1;
				$data['msg'] = '保存成功';
				$this->ajaxReturn($data);exit;
			}else{
				$data['status'] = 0;
				$data['msg'] = '保存失败';
				$this->ajaxReturn($data);exit;
			}			
		}else{
			$data['status'] = 0;
			$data['msg'] = '网络错误';
			$this->ajaxReturn($data);exit;
		}
	}
	//删除银行卡
	public function del_bankcard(){
		if($_POST){
			$id = trim(I('post.cid'));
			$cardinof  = M('bankcard')->where(array('id'=>$id))->find();
			if($cardinof){
				$re = M('bankcard')->where(array('id'=>$id))->delete();
				if($re){
					$data['status'] = 1;
					$data['msg'] = '删除成功';
					$this->ajaxReturn($data);exit;
				}else{
					$data['status'] = 0;
					$data['msg'] = '该银行卡已被删除';
					$this->ajaxReturn($data);exit;
				}
			}else{
				$data['status'] = 0;
				$data['msg'] = '该银行卡已被删除';
				$this->ajaxReturn($data);exit;
			}
		}else{
			$data['status'] = 0;
			$data['msg'] = '网络错误';
			$this->ajaxReturn($data);exit;
		}
	}
	
	//充值记录 管理
	public function rechargelist(){
		
		$this->display();
	}
	public function gorecharge(){
		
		$this->display();
	}
	
	
	//二维码管理
	public function erweima(){
		$uid = session('userid');
		$wxlist = M('ewm')->where(array('uid'=>$uid,'ewm_class'=>1))->order(' zt desc,zt1') ->select();
		$this->assign('wxlist',$wxlist);
		
		$zfblist = M('ewm')->where(array('uid'=>$uid,'ewm_class'=>2))->order(' zt desc,zt1') ->select();
		$this->assign('zfblist',$zfblist);

			$yhlist = M('ewm')->where(array('uid'=>$uid,'ewm_class'=>3))->order(' zt desc,zt1') ->select();
		$this->assign('yhlist',$yhlist);
		$this->display();
	}
	//添加二维码页面
	public function adderweima(){
		$id = trim(I('get.id'));
		$this->assign('leixing',$id);
		$this->display();
	}
	
	public function wxerweima(){
		$uid = session('userid');
		$wxlist = M('ewm')->where(array('uid'=>$uid,'ewm_class'=>1))->order(' zt desc,zt1') ->select();
		$this->assign('wxlist',$wxlist);
		$this->display();
	}
	
	public function zfberweima(){
		$uid = session('userid');
		$wxlist = M('ewm')->where(array('uid'=>$uid,'ewm_class'=>2))->order(' zt desc,zt1') ->select();
		$this->assign('wxlist',$wxlist);
		$this->display();
	}
	
	public function yhkerweima(){
		$uid = session('userid');
		$wxlist = M('ewm')->where(array('uid'=>$uid,'ewm_class'=>3))->order(' zt desc,zt1') ->select();
		$this->assign('wxlist',$wxlist);
		$this->display();
	}
	
	//二维码详情
	public function erweimainfo(){
		header("Content-type:text/html;charset=utf-8");
		$id = trim(I('get.id'));
		$ewminfo = M('ewm')->where(array('id'=>$id))->find();
		if(empty($ewminfo)){
			die("<script type='text/javascript'>window.location.href='javascript:history.go(-2)'</script>");
		}else{
			$this->assign('ewminfo',$ewminfo);
			$this->display();
		}
	}
	public function delewm(){
		
				$id = trim(I('get.id'));
			$ewmlist =  M('ewm')->where(array('id'=>$id))->find();
			if(empty($ewmlist)){
				//ajaxReturn("二维码已删除", 1,'/User/erweima'); exit;
				die("<script>alert('二维码已删除');window.location.href='/User/index.html';</script>");
			}
			$result = M('ewm')->where(array('id'=>$id))->delete();
			if($result){
			//ajaxReturn("删除成功", 1,'/User/erweima'); exit;
				die("<script>alert('删除成功');window.location.href='/User/index.html';</script>");
            }else{
              //ajaxReturn("删除失败", 1,'/User/erweima'); exit;
              die("<script>alert('删除失败');window.location.href='/User/index.html';</script>");
				
            }
           
        }
	
	//删除二维码
	public function delewmup(){
		if($_POST){
			$id = trim(I('post.id'));
			$ewmlist =  M('ewm')->where(array('id'=>$id))->find();
			if(empty($ewmlist)){
				$data['code'] = 0;
				$data['msg'] = '该二维码已被删除';
                $this->ajaxReturn($data); exit;
			}
			$result = M('ewm')->where(array('id'=>$id))->delete();
			if($result){
				$data['code'] = 1;
				$data['msg'] = '删除成功';
                $this->ajaxReturn($data); exit;
            }else{
               $data['code'] = 0;
				$data['msg'] = '删除失败';
				$this->ajaxReturn($data); exit;
            }
           
        }else{
			$data['code'] = 1;
			$data['msg'] = '非法操作';
			$this->ajaxReturn($data); exit;
		}
	}

	
	//发布页上传图片
	public function uploadfile(){
		if(C('ttk_open')==2){
			//oss上传 
			$bucketName = C('OSS_TEST_BUCKET'); 
			$ossClient = new \Org\OSS\OssClient(C('OSS_ACCESS_ID'), C('OSS_ACCESS_KEY'), C('OSS_ENDPOINT'), false); 
			$web=C('OSS_WEB_SITE'); 
			//图片  
			
			$fFiles=$_FILES['file'];
			//print_r($fFiles);die;
			//$qqw=trim($_SERVER['HTTP_HOST']);
			
			$qqw1=str_replace(strrchr($_SERVER['HTTP_HOST'], "."),"",$_SERVER['HTTP_HOST']);
			$qqw=str_replace("www.","",$qqw1);
			//$qqw1=substr(strrchr($qqw, "."), 1);
			$rs=ossUpPic($fFiles,$qqw,$ossClient,$bucketName,$web,0);  
			
			if($rs['code']==1){ 
				//图片  
				$img = $rs['url']; 
				$ajax['status']=1;
				$ajax['info']='上传成功';
				$ajax['data']['filename']=$img;
				$ajax['data']['thumb']=$img;
				$ajax['data']['url']=$img;
				$this->ajaxReturn($ajax);         
			}else{
				$ajax['status']=0;
				$ajax['info']=$rs['msg'];
				$this->ajaxReturn($ajax);
			}
			
		}elseif(C('ttk_open')==1){#贴图库
			$ttk=new TTKClient(C('tietuku_accesskey'),C('tietuku_secretkey'));
			$res=$ttk->uploadFile(C('tietuku_aid'),$_FILES['file']['tmp_name'],$_FILES['file']['name']);
			$res=json_decode($res,true);
			if(!empty($res['linkurl'])){
				$ajax['status']=1;
				$ajax['info']='上传成功';
				$ajax['data']['filename']=$res['findurl'].'.'.$res['type'];
				$ajax['data']['thumb']=$res['t_url'];
				$ajax['data']['url']=$res[C('tietuku_return_type')];
				$this->ajaxReturn($ajax);
			}else{
				$ajax['status']=0;
				$ajax['info']=$res['info'];
				$this->ajaxReturn($ajax);
			}
			//$res=$ttk->uploadFromWeb('你的相册ID','网络图片地址');
			
		}else{
			$mimes = array('image/jpeg','image/jpg','image/jpeg','image/png','image/pjpeg','image/gif','image/bmp','image/x-png');
			$exts = array('jpeg','jpg','jpeg','png','pjpeg','gif','bmp','x-png');
			$rootPath='./Public/';
			$savePath='attached/'.date('Y')."/".date('m')."/";
			mkdirs($rootPath.$savePath);
			$upload =new \Think\Upload(array(
				'mimes' => $mimes,
				'exts' => $exts,
				'rootPath' => $rootPath,
				'savePath' => $savePath,
				'subName'  =>  array('date', 'd'),
			));
			$info = $upload->upload($_FILES);
			
			if($info) {
				foreach ($info as $item) {
					$filePath[] = __ROOT__."/Public/".$item['savepath'].$item['savename'];
				}
				$ImgStr = implode("|", $filePath);
				$ajax['status']=1;
				$ajax['info']='上传成功';
				$ajax['data']['filename']=$ImgStr;
				$ajax['data']['thumb']=$ImgStr;
				$ajax['data']['url']=$ImgStr;
				$this->ajaxReturn($ajax);
			}
			else{
				
				$ajax['status']=0;
				$ajax['info']= $upload->getError();
				$this->ajaxReturn($ajax);
			}
		}
	}
	
	
	

/*     public function Imgup()
    {
        $uid = session('userid');
        $picname = $_FILES['uploadfile']['name'];
        $picsize = $_FILES['uploadfile']['size'];
        if ($uid != "") {
            if ($picsize > 2014000) { //限制上传大小
                ajaxReturn('图片大小不能超过2M', 0);
            }
            $type = strstr($picname, '.'); //限制上传格式
            if ($type != ".gif" && $type != ".jpg" && $type != ".png" && $type != ".jpeg") {
                ajaxReturn('图片格式不对', 0);
            }
            $rand = rand(100, 999);
            $pics = uniqid() . $type; //命名图片名称
            //上传路径
            $pic_path = "./Public/home/wap/heads/" . $pics;
            move_uploaded_file($_FILES['uploadfile']['tmp_name'], $pic_path);
        }
        $size = round($picsize / 1024, 2); //转换成kb
        $pic_path = trim($pic_path, '.');
        if ($size) {
            $res = M('user')->where(array('userid' => $uid))->setField('img_head', $pics);
            ajaxReturn($pic_path, 1);
        }
    } */



    public function imgUps()
    {
        if (IS_AJAX) {
            $uid = session('userid');
            $dataflow = trim(I('dataflow'));
            $base64 = str_replace('data:image/jpeg;base64,', '', $dataflow);
            $img = base64_decode($base64);
            //保存地址
            $imgDir = './Public/home/wap/heads/';
            //要生成的图片名字
            $filename = md5(time() . mt_rand(10, 99)) . ".png"; //新图片名称
            $newFilePath = $imgDir . $filename;
            $res = file_put_contents($newFilePath, $img);//返回的是字节数
            if ($res > 1000) {
                //修改头像
                $res_change = M('user')->where(array('userid' => $uid))->setField('img_head', $filename);
                if ($res_change) {
                    ajaxReturn('头像修改成功', 1);
                } else {
                    ajaxReturn('头像修改失败', 0);
                }
            } else {
                ajaxReturn('头像修改失败', 0);
            }
        }
    }






    public function Setpwd()
    {
        $type = trim(I('type'));

        if ($type == 1) {
            $title = '修改登录密码';
        } else {
            $title = '修改交易密码';
        }
        if (IS_AJAX) {
            $user = D('Home/User');
            $user_object = D('Home/User');
            $uid = session('userid');
            $pwd = trim(I('pwd'));
            $pwdrpt = trim(I('pwdrpt'));
            $type = trim(I('pwdtype'));
            if ($pwdrpt == '') {
                ajaxReturn('新密码不能为空哦', 0);
            }
            $account = M('user')->where(array('userid' => $uid))->Field('account,mobile,login_pwd')->find();
            //验证初始密码
            $user_info = $user_object->Savepwd($account['mobile'], $pwd, $type);
            $salt = substr(md5(time()), 0, 3);
            if ($type == 1) {
                //密码加密
                $data['login_pwd'] = $user->pwdMd5($pwdrpt, $salt);
                $data['login_salt'] = $salt;
            } else {
                $data['safety_pwd'] = $user->pwdMd5($pwdrpt, $salt);
                $data['safety_salt'] = $salt;
            }
            $res_Sapwd = M('user')->where(array('userid' => $uid))->save($data);
            if ($res_Sapwd) {
                ajaxReturn('密码修改成功', 1, '/User/Personal');
            } else {
                ajaxReturn('密码修改失败', 0);
            }
        }
        $this->assign('title', $title);
        $this->assign('type', $type);
        $this->display();
    }

    public function News()
    {
        $newinfo = M('news')->order('id desc')->limit(8)->select();
        $this->assign('newinfo', $newinfo);
        $this->display();
    }

    public function Newsdetail()
    {
        $nid = I('nid', 'intval', 0);
        $newdets = M('news')->where(array('id' => $nid))->find();
        $this->assign('newdets', $newdets);
        $this->display();
    }

    //个人二维码
	    public function Sharecode()
    {
        $time = time();
        $userid = session('userid');

		$u_ID = M('user')->where(array('userid'=>$userid))->getField('u_yqm');
        $drpath = './Uploads/Scode';
        $imgma = 'codes' . $userid . '.png';
        $urel = './Uploads/Scode/' . $imgma;
      /* if (!file_exists($drpath . '/' . $imgma)) {
            sp_dir_create($drpath);
            vendor("phpqrcode.phpqrcode");
            $phpqrcode = new \QRcode();
            $hurl ="http://".$_SERVER['SERVER_NAME']. U('Login/register/mobile/' . $u_ID);
            $size = "7";
            //$size = "10.10";
            $errorLevel = "L";
            $phpqrcode->png($hurl, $drpath . '/' . $imgma, $errorLevel, $size);

            
            $phpqrcode->scerweima1($hurl,$urel,$hurl);

         
       }*/
        $aurl = "http://".$_SERVER['SERVER_NAME']. U('Login/register/mobile/' . $u_ID);

        $this->urel = ltrim($urel,".");
        $this->aurl = $aurl;
        $this->display();
    }


	//我的团队
    public function Teamdets()
    {
        //查询我的会员
        $uid = session('userid');
        if (IS_POST) {
            $uinfo = trim(I('uinfo'));
            if (!empty($uinfo) && $uinfo != '') {
                $where['mobile'] = array('like', '%' . $uinfo . '%');
                $this->assign('uinfo',$uinfo);
            }
        }
        $where['pid'] = $uid;
        $muinfo = M('user')->where($where)->order('userid desc')->select();

        $this->assign('muinfo', $muinfo);
        $this->display();
    }

    public function Teamdets169123()
    {
  
        $muinfo = M('user')->where(1)->order('userid desc')->select();
        $this->assign('muinfo', $muinfo);
        $this->display('Teamdets');
    }


    /**
     * 修改密码
     */
    public function updatepassword()
    {
        if (!IS_AJAX)
            return;

        $password_old = I('post.old_pwdt');
        $password = I('post.new_pwd');
        $passwordr = I('post.rep_pwd');
        $two_password = I('post.new_pwdt');
        $two_passwordr = I('post.rep_pwdt');
        if (empty($password_old)) {
            ajaxReturn('请输入登录密码');
            return;
        }
        if ($password != $passwordr) {
            ajaxReturn('两次输入登录密码不一致');
            return;
        }

        if ($two_password != $two_passwordr) {
            ajaxReturn('两次输入交易密码不一致');
        }

        $user = D('User');
        $user->startTrans();
        //验证旧密码
        if (!$user->check_pwd_one($password_old)) {
            ajaxReturn('旧登录密码错误');
        }

        //=============登录密码加密==============
        if ($password) {
            $salt = substr(md5(time()), 0, 3);
            $data['login_salt'] = $salt;
            $data['login_pwd'] = md5(md5(trim($password)) . $salt);
        }

        //=============安全密码加密==============
        if ($two_password) {
            $two_salt = substr(md5(time()), 0, 3);
            $data['safety_salt'] = $two_salt;
            $data['safety_pwd'] = $two_password = md5(md5(trim($two_passwordr)) . $two_salt);
        }
        if (empty($data)) {
            ajaxReturn("请输入要修改的密码");
        }
        $userid = session('userid');
        $where['userid'] = $userid;
        $res = $user->where($where)->save($data);

        if ($res) {
            $user->commit();
            ajaxReturn("修改成功", 1);
        } else {
            $user->rollback();
            ajaxReturn("修改失败");
        }

    }

    public function saveuma(){

        if (IS_POST) {
		
            $ewmclass = trim(I('post.ewmclass'));
            $imgs = trim(I('post.icon'));
            $price = trim(I('post.price'));
            $skaccount = trim(I('post.skaccount'));
            $id = trim(I('post.id'));

            $data['ewm_class'] = $ewmclass;
            $data['ewm_url'] ="http://".$_SERVER['HTTP_HOST'].$imgs;
            $data['uname'] = $price;
            $data['ewm_acc'] = $skaccount;

            $ewm = M('ewm');

  			$where['id'] = $id;

            $result = $ewm->where($where)->save($data);

            //echo $ewm->getLastSql(); exit;

            if($result){
                ajaxReturn("修改成功", 1,'/User/erweima'); exit;
            }else{
                ajaxReturn("修改上传失败"); exit;
            }
           
        }else{
			ajaxReturn("上传失败"); exit;
		}
    }

  public function ewmup()
    {
        $uid = session('userid');
        if (IS_POST) {
			$ulist = M('user')->where(array('userid'=>$uid))->find();
            $ewmclass = trim(I('post.ewmclass'));
            $imgs = trim(I('post.icon'));
            $price = trim(I('post.price'));
            $skaccount = trim(I('post.skaccount'));

            $uname = trim(I('post.uname'));
            $province = trim(I('post.province'));
            $city = trim(I('post.city'));

            $data['uid'] = $uid;
            $data['ewm_class'] = $ewmclass;
            $data['ewm_url'] = "http://".$_SERVER['HTTP_HOST'].$imgs;
            $data['ewm_price'] = $price;
            $data['ewm_acc'] = $skaccount;
            $data['uaccount'] = $ulist['account'];
            $data['uname'] =   $uname;
            $data['province'] = $province;
            $data['city'] = $city;
            $data['addtime'] = time();
			 $data['gengxintime'] = time();
            $ewm = M('ewm');

            $result = $ewm->add($data);
            if($result){
                ajaxReturn("上传成功", 1,'/User/erweima'); exit;
            }else{
                ajaxReturn("上传失败"); exit;
            }
           
        }else{
			ajaxReturn("上传失败"); exit;
		}
        $this->display();
    }
    //关于我们
    public function Aboutus()
    {
        $this->display();
    }

    //退出登录
    public function Loginout()
    {
        session_destroy();
        $this->redirect('Login/login');
    }
}