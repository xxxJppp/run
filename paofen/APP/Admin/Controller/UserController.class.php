<?php
namespace Admin\Controller;
use Think\Page;

/**
 * 用户控制器
 * 
 */
class UserController extends AdminController
{


    /**
     * 用户列表
     * 
     */
     public function index(){
		 $querytype = trim(I('get.querytype'));
		 $account = trim(I('get.keyword'));
		 $coinpx = trim(I('get.coinpx'));
		 if($querytype != ''){
			 if($querytype=='mobile'){
				 $map['account'] = $account;
			 }elseif($querytype=='userid'){
				  $map['userid'] = $account;
			 }
		 }else{
			 $map = '';
		 }
		
		
		
		$userobj = M('user');
		$count =$userobj->where($map)->count();
		$p = getpagee($count,50);
		
		 if($coinpx){
			 if($coinpx == 1){
				  $list = $userobj->where ( $map )->order ( 'money desc' )->limit ( $p->firstRow, $p->listRows )->select ();
			 }
		 }else{
			 $list = $userobj->where ( $map )->order ( 'userid desc' )->limit ( $p->firstRow, $p->listRows )->select ();
		 }
    	
		
		$this->assign('count',$count);
    	$this->assign ( 'list', $list ); // 賦值數據集
		$this->assign('count',$count);
    	$this->assign ( 'page', $p->show() ); // 賦值分頁輸出
        $this->display();
    }
	
	//流水
	public function bill(){
       $fy = I('get.fy');
		
		 $coinpx = trim(I('get.coinpx'));
		 	 $map['id']=array('gt',0);
       if(I('get.userid')){
         $ulist = M('user')->where(array('account'=>I('get.userid')))->find();
             $map['uid'] = $ulist['userid'];
			 }
          
     
           if(I('get.date')){
           $st=strtotime(I('get.date'));
          // $en=$st+86400;
        $map['addtime']=array('EGT',$st);
         }

		 if(I('get.dateend')){
           $stt=strtotime(I('get.dateend'));
          $en=$stt+86400;
        $map['addtime']=array('ELT',$en);
         }
	 if(I('get.date')&&I('get.dateend')){
           $st=strtotime(I('get.date'));
          $stt=strtotime(I('get.dateend'));
          $en=$stt+86400;
        
$map['addtime'] = array('between', array($st, $en));
         }
		 
		
		
		$userobj = M('somebill');
		$count =$userobj->where($map)->count();
		$p = getpagee($count,$fy);
		
		 if($coinpx){
			 if($coinpx == 1){
				  $list = $userobj->where ( $map )->order ( 'money desc' )->limit ( $p->firstRow, $p->listRows )->select ();
			 }
		 }else{
			 $list = $userobj->where ( $map )->order ( 'uid desc' )->limit ( $p->firstRow, $p->listRows )->select ();
		 }
    	
		
		$this->assign('count',$count);
    	$this->assign ( 'list', $list ); // 賦值數據集
		$this->assign('count',$count);
    	$this->assign ( 'page', $p->show() ); // 賦值分頁輸出
        $this->display();
    }
	
	  	//设置代理
	public function set_agent(){
		if($_GET){
			$userid = trim(I('get.userid')); 
			$list = M('user')->where(array('userid'=>$userid))->find();
          	$st = $list['agent'];
			if(empty($list)){
				$this->error('该会员不存在');
			}
			if($st >= 1){
				$this->error('该会员已经是代理');
				
			}elseif($st == 0){
				$re = M('user')->where(array('userid'=>$userid))->save(array('agent'=>1));
				if($re){
					$this->error('设置成功');
				}else{
					$this->error('网络错误！');
				}
				
			}else{
				$this->error('网络错误！');
			}
			
			
		}else{
			$this->error('网络错误！');
		}
		
		
	}
  
    //取消代理
	public function quxiao_agent(){
		if($_GET){
			$userid = trim(I('get.userid')); 
			$list = M('user')->where(array('userid'=>$userid))->find();
          	$st = $list['agent'];
			if(empty($list)){
				$this->error('该会员不存在');
			}
			if($st <1){
				$this->error('该会员已取消了代理身份');
				
			}else{
				$re = M('user')->where(array('userid'=>$userid))->save(array('agent'=>0));
				if($re){
					$this->error('取消成功');
				}else{
					$this->error('网络错6误！');
				}
				
			}
			
			
		}else{
			$this->error('网络错8误！');
		}
		
		
	}
	
	public function delbill(){
		$id=trim(I('get.id'));
		$re = M('somebill')->where(array('id'=>$id))->delete();
		if($re){
			$this->success('删除成功');exit;
		}else{
			$this->error('删除失败');exit;
		}
	}
	
	//提现列表
	public function recharge(){
       $fy = I('get.fy');
		 $coinpx = trim(I('get.coinpx'));
      $map['id']=array('gt',0);
       if(I('get.userid')){
             $map['uaccount'] = I('get.userid');
			 }
           if( I('get.zt')){
             $map['status'] = I('get.zt');
			 }
     
           if(I('get.date')){
           $st=strtotime(I('get.date'));
          // $en=$st+86400;
        $map['addtime']=array('EGT',$st);
         }

		 if(I('get.dateend')){
           $stt=strtotime(I('get.dateend'));
          $en=$stt+86400;
        $map['addtime']=array('ELT',$en);
         }
	 if(I('get.date')&&I('get.dateend')){
           $st=strtotime(I('get.date'));
          $stt=strtotime(I('get.dateend'));
          $en=$stt+86400;
        
$map['addtime'] = array('between', array($st, $en));
         }
		 
		
		
		$userobj = M('recharge');
		$count =$userobj->where($map)->count();
		$p = getpagee($count,$fy);
		
		 if($coinpx){
			 if($coinpx == 1){
				  $list = $userobj->where ( $map )->order ( 'price desc' )->limit ( $p->firstRow, $p->listRows )->select ();
			 }else{
				 $list = $userobj->where ( $map )->order ( 'id desc' )->limit ( $p->firstRow, $p->listRows )->select ();
			 }
		 }else{
			 $list = $userobj->where ( $map )->order ( 'id desc' )->limit ( $p->firstRow, $p->listRows )->select ();
		 }
    	
		$conf = M('system')->where(array('id'=>1))->find();
		$this->assign('conf',$conf);
		
		$this->assign('count',$count);
    	$this->assign ( 'list', $list ); // 賦值數據集
		$this->assign('count',$count);
    	$this->assign ( 'page', $p->show() ); // 賦值分頁輸出
        $this->display();

	}
	
	//充值处理
	public function reedit(){
		$id = trim(I('get.id'));
		$st = trim(I('get.st'));
		$relist  = M('recharge')->where(array('id'=>$id))->find();
		$ulist = M('user')->where(array('userid'=>$relist['uid']))->find();
		
		if($st ==1){
			if($relist['status'] == 1){
				$re = M('recharge')->where(array('id'=>$id))->save(array('status'=>3));
				$ure = M('user')->where(array('userid'=>$relist['uid']))->setInc('money',$relist['price']);
			$mxs['uid'] = $relist['uid'];
		   $mxs['jl_class'] = 3;
		   $mxs['info'] = '充值+';
		   $mxs['addtime'] = time();
		   $mxs['jc_class'] = '+';
		   $mxs['num'] = $relist['price'];

		   $up_re = M('somebill')->add($mxs);
				
				
				
				
				
			}else{
				$re = 0;
				$ure =0;
			}
			
			
			
		}elseif($st ==2){
			if($relist['status'] == 1){
				$re = M('recharge')->where(array('id'=>$id))->save(array('status'=>2));
				$ure = 1;
			}else{
				$re = 0;
				$ure =0;
			}
			
			
		}elseif($st ==3){
			if($relist['status'] == 3){
				$re = M('recharge')->where(array('id'=>$id))->delete();
				$ure = 1;
			}else{
				$re = 0;
				$ure =0;
			}
		}
		
		if($re && $ure){
			$this->success('操作成功');
		}else{
			$this->error('操作失败');
		}
		
		
	}
	
	//充值处理
	public function save_czset(){
		if($_GET){
			$data['cz_yh'] = trim(I('get.cz_yh'));
			$data['cz_xm'] = trim(I('get.cz_xm'));
			$data['cz_kh'] = trim(I('get.cz_kh'));

			$re = M('system')->where(array('id'=>1))->save($data);
			
			if($re){
				$this->success('修改成功');exit;
			}else{
				
				$this->error('修改失败');exit;
			}
		}
		
	}
	
	
	//提现列表
	public function withdraw(){
	$fy = I('get.fy');
		
		 $coinpx = trim(I('get.coinpx'));
		 $map['id']=array('gt',0);
       if(I('get.userid')){
             $map['uaccount'] = I('get.userid');
			 }
           if( I('get.zt')){
             $map['status'] = I('get.zt');
			 }
     
           if(I('get.date')){
           $st=strtotime(I('get.date'));
          // $en=$st+86400;
        $map['addtime']=array('EGT',$st);
         }

		 if(I('get.dateend')){
           $stt=strtotime(I('get.dateend'));
          $en=$stt+86400;
        $map['addtime']=array('ELT',$en);
         }
	 if(I('get.date')&&I('get.dateend')){
           $st=strtotime(I('get.date'));
          $stt=strtotime(I('get.dateend'));
          $en=$stt+86400;
        
$map['addtime'] = array('between', array($st, $en));
         }
		 
		
		
		$userobj = M('withdraw');
		$count =$userobj->where($map)->count();
		$p = getpagee($count,$fy);
		
		 if($coinpx){
			 if($coinpx == 1){
				  $list = $userobj->where ( $map )->order ( 'price desc' )->limit ( $p->firstRow, $p->listRows )->select ();
			 }else{
				 $list = $userobj->where ( $map )->order ( 'id desc' )->limit ( $p->firstRow, $p->listRows )->select ();
			 }
		 }else{
			 $list = $userobj->where ( $map )->order ( 'id desc' )->limit ( $p->firstRow, $p->listRows )->select ();
		 }
    	
		
		$this->assign('count',$count);
    	$this->assign ( 'list', $list ); // 賦值數據集
		$this->assign('count',$count);
    	$this->assign ( 'page', $p->show() ); // 賦值分頁輸出
        $this->display();

	}
	
	
	//提现处理
	public function wiedit(){
		$id = trim(I('get.id'));
		$st = trim(I('get.st'));
		$relist  = M('withdraw')->where(array('id'=>$id))->find();
	
		if($st ==1){
			$re = M('withdraw')->where(array('id'=>$id))->save(array('status'=>3));
			
			
		}elseif($st ==2){
			
			$ulist = M('user')->where(array('userid'=>$relist['uid']))->find();

			$re = M('withdraw')->where(array('id'=>$id))->save(array('status'=>2));
			$p = $relist['price'];

			$sa['money'] = $ulist['money'] + $p;


		   $mxs['uid'] = $relist['uid'];
		   $mxs['jl_class'] = 6;
		   $mxs['info'] = '提现退回+';
		   $mxs['addtime'] = time();
		   $mxs['jc_class'] = '+';
		   $mxs['num'] = $p;

		   $up_re = M('somebill')->add($mxs);

		   //echo M('somebill')->getLastSql();  exit;

		  $re = M('user')->where(array('userid'=>$relist['uid']))->save($sa);

			
		}elseif($st ==3){
			$re = M('withdraw')->where(array('id'=>$id))->save(array('status'=>3));
	
		}
		
		if($re){
			$this->success('操作成功');
		}else{
			$this->error('操作失败');
		}
		
		
	}
	
	
	//提现列表
	public function ewm(){
		 $querytype = trim(I('get.querytype'));
		 $account = trim(I('get.keyword'));
		 $coinpx = trim(I('get.coinpx'));

		 if($querytype != ''){
			 if($querytype=='mobile'){
				 $map['uaccount'] = $account;
			 }elseif($querytype=='userid'){
				  $map['uid'] = $account;
			 }
		 }else{
			 $map = '';
		 }
		
		
		
		$userobj = M('ewm');
		$count =$userobj->where($map)->count();
		$p = getpagee($count,50);
		
		 if($coinpx){
			 if($coinpx == 1){
				  $list = $userobj->where ( $map )->order ( 'ewm_price desc' )->limit ( $p->firstRow, $p->listRows )->select ();
			 }else{
				 $list = $userobj->where ( $map )->order ( 'id desc' )->limit ( $p->firstRow, $p->listRows )->select ();
			 }
		 }else{
			 $list = $userobj->where ( $map )->order ( 'id desc' )->limit ( $p->firstRow, $p->listRows )->select ();
		 }
    	
		
		$this->assign('count',$count);
    	$this->assign ( 'list', $list ); // 賦值數據集
		$this->assign('count',$count);
    	$this->assign ( 'page', $p->show() ); // 賦值分頁輸出
        $this->display();

	}
	
	
	
	//二维码详情
	public function ewminfo(){		
		$id= trim(I('get.id'));
		$ewminfo = M('ewm')->where(array('id'=>$id))->find();
		$this->assign('info',$ewminfo);
		$this->display();
	}
	
	//删除二维码
	public function delbankcard(){
		$id= trim(I('get.id'));
		$re = M('bankcard')->where(array('id'=>$id))->delete();
		if($re){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
		
	}


	//删除二维码
	public function delewm(){
		$id= trim(I('get.id'));
		$re = M('ewm')->where(array('id'=>$id))->delete();
		if($re){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
		
	}
	
	
	//银行卡列表
	public function bankcard(){
      $fy = I('get.fy');
		 $querytype = trim(I('get.querytype'));
		 $account = trim(I('get.keyword'));
		 $coinpx = trim(I('get.coinpx'));

		 if($querytype != ''){
			 if($querytype=='mobile'){
				 $map['name'] = $account;
			 }elseif($querytype=='userid'){
				  $map['uid'] = $account;
			 }elseif($querytype=='accounte'){
               $counte =M('user')->where(array('account'=>$account))->find();
				  $map['uid'] = $counte['userid'];
			 }
		 }else{
			 $map = '';
		 }
		
		
		
		$userobj = M('bankcard');
		$count =$userobj->where($map)->count();
		$p = getpagee($count,$fy);
		
		 if($coinpx){
			 if($coinpx == 1){
				  $list = $userobj->where ( $map )->order ( 'addtime desc' )->limit ( $p->firstRow, $p->listRows )->select ();
			 }else{
				 $list = $userobj->where ( $map )->order ( 'id desc' )->limit ( $p->firstRow, $p->listRows )->select ();
			 }
		 }else{
			 $list = $userobj->where ( $map )->order ( 'id desc' )->limit ( $p->firstRow, $p->listRows )->select ();
		 }
    	
		
		$this->assign('count',$count);
    	$this->assign ( 'list', $list ); // 賦值數據集
		$this->assign('count',$count);
    	$this->assign ( 'page', $p->show() ); // 賦值分頁輸出
        $this->display();

	}
	
	public function  indexs(){
         //完善后需要修改url
        $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'];
       $querytype = trim(I('get.querytype'));
		 $account = trim(I('get.keyword'));
		 $coinpx = trim(I('get.coinpx'));
		 if($querytype != ''){
			 if($querytype=='mobile'){
				 $map['account'] = $account;
				 $map['agent'] = 1;
			 }elseif($querytype=='userid'){
				  $map['userid'] = $account;
				  $map['agent'] = 1;
			 }
		 }else{
			$map['agent'] = 1;
		 }
		
		
		
		$userobj = M('user');
		$count =$userobj->where($map)->count();
		$p = getpagee($count,50);
		
		 if($coinpx){
			 if($coinpx == 1){
				  $list = $userobj->where ( $map )->order ( 'money desc' )->limit ( $p->firstRow, $p->listRows )->select ();
			 }
		 }else{
			 $list = $userobj->where ( $map )->order ( 'userid desc' )->limit ( $p->firstRow, $p->listRows )->select ();
		 }

		$this->assign('url',$url);
		$this->assign('count',$count);
    	$this->assign ( 'list', $list ); // 賦值數據集
		$this->assign('count',$count);
    	$this->assign ( 'page', $p->show() ); // 賦值分頁輸出
        $this->display();
	}


	public function  adds(){

		if($_POST){
			
			$data['username'] = trim(I('post.username'));
			$data['mobile'] = trim(I('post.username'));
		    $data['account'] = trim(I('post.username'));
			$login_pwd = trim(I('post.login_pwd'));

			$mobile = $data['username'];

			$list = M('user')->where(array('account'=>$mobile))->find();

            $data['agent'] = 1;
			if(!empty($list)){
				$this->error('增加代理失败,用户名已经存在');
			}
			
	        $numss = rand(0000,9999);
			$data['login_pwd'] = md5(md5($login_pwd).$numss);
		
			$data['safety_pwd'] =md5(md5($login_pwd).$numss);

			$data['reg_date'] = time();

			$data['status'] = 0;

			$data['rz_st'] = 1;
            $data['u_yqm'] = strrand();
			$data['login_salt'] = $numss;
			
			
			$re = M('user')->add($data);
			if($re){
				
				$this->success('增加代理成功');
			}else{
				$this->error('增加代理失败');
				
			}
			
			
			
		}else{
			
			$this->display();
		}

	
	}

	public function stixian(){
          
         $querytype = trim(I('get.querytype'));
		 $account = trim(I('get.keyword'));
		 $coinpx = trim(I('get.coinpx'));
		 if($querytype != ''){
			 if($querytype=='mobile'){
				 $map['shanghu_name'] = $account;
				 //$map['agent'] = 1;
			 }elseif($querytype=='userid'){
				  $map['shanghu_id'] = $account;
				 // $map['agent'] = 1;
			 }elseif($querytype=='zt'){
             $map['zt'] = $account;
			 }elseif($querytype=='money'){
             $map['money'] = $account;
			 }elseif($querytype=='date'){
           $st=strtotime($account);
           $en=$st+86400;
        $map['addtime']=array(between,array($st,$en));
         }
		 }else{
			$map['agent'] = '1=1';
		 }
		
		$userobj = M('tixian');
		$count =$userobj->where($map)->count();
		$p = getpagee($count,50);
		
		 if($coinpx){
			 if($coinpx == 1){
				  $list = $userobj->where ( $map )->order ( 'money desc' )->limit ( $p->firstRow, $p->listRows )->select ();
			 }
		 }else{
			 $list = $userobj->where ( $map )->order ( ' id desc' )->limit ( $p->firstRow, $p->listRows )->select ();
		 }
    	
		
		$this->assign('count',$count);
    	$this->assign ( 'list', $list ); // 賦值數據集
		$this->assign('count',$count);
    	$this->assign ( 'page', $p->show() ); // 賦值分頁輸出
        $this->display();

	}
	public function stui(){
		 $id = trim(I('get.id'));
		 $info = M('tixian')->where(array('id'=>$id))->find();
		 $da['zt'] = 2;
		 M('tixian')->where(array('id'=>$id))->save($da);

		 $ulist = M('agent')->where(array('id'=>$info['shanghu_id']))->find();

		 $d['money'] = $ulist['money'] + $info['money'];

		 M('agent')->where(array('id'=>$info['shanghu_id']))->save($d);

         $this->success('异常退回处理成功，提现金额已返还到商户余额');
	}
	public function stuis(){
		
		$id = trim(I('get.id'));
		 $info = M('tixian')->where(array('id'=>$id))->find();
		 $da['zt'] = 1;
		 M('tixian')->where(array('id'=>$id))->save($da);


         $this->success('提现处理成功');
	}

    public function sbj(){

    	if($_POST){
			
			$data['username'] = trim(I('post.username'));
		    $data['account'] = trim(I('post.username'));
			$login_pwd = trim(I('post.pwd'));
			$zt = trim(I('post.zt'));
			$key = trim(I('post.key'));
            $url = trim(I('post.url'));
            $wx = trim(I('post.wx'));
            $zfb = trim(I('post.zfb'));
            $sjm = trim(I('post.sjm'));
			$name = $data['username'];
			$id = trim(I('post.id'));
			$list = M('agent')->where(array('names'=>$name))->find();
			if(!empty($list)  && $list['id']!=$id){
				$this->error('修改商户失败,商户名已经存在');
			}
			

			if ($login_pwd) {
				$datas['pwd'] = md5($login_pwd);
			}
       
            $datas['bankname'] = trim(I('post.bankname'));
            $datas['bankinfo'] = trim(I('post.bankinfo'));
            $datas['name']= trim(I('post.name'));
            $datas['acc'] = trim(I('post.acc'));

            $datas['money'] = trim(I('post.money'));

			$datas['names'] = $name;
			$datas['addtime'] = time();
			$datas['zt'] = $zt;
			$datas['key'] = $key;
			$datas['url'] = $url;

			$datas['wx'] = $wx;
			$datas['zfb'] = $zfb;
			$datas['sjm'] = $sjm;

			$re = M('agent')->where(array('id'=>$id))->save($datas);



			if($re){
				
				$this->success('编辑商户成功');
			}else{
				$this->error('编辑商户失败');
				
			}
			
			
		}else{
			$id = trim(I('get.userid'));
			$list = M('agent')->where(array('id'=>$id))->find();
			$this->assign('info',$list);
			$this->display();
		}
    }

	public function  shanghu(){

		if($_POST){
			
			$data['username'] = trim(I('post.username'));

		    $data['account'] = trim(I('post.username'));

			$login_pwd = trim(I('post.pwd'));

			$zt = trim(I('post.zt'));
			$key = trim(I('post.key'));
            $url = trim(I('post.url'));

            $wx = trim(I('post.wx'));
            $zfb = trim(I('post.zfb'));
            $sjm = trim(I('post.sjm'));

			$name = $data['username'];

			$list = M('agent')->where(array('names'=>$name))->find();


			if(!empty($list) ){
				$this->error('增加商户失败,商户名已经存在');
			}
			

			$datas['pwd'] = md5($login_pwd);
			$datas['names'] = $name;
			$datas['addtime'] = time();
			$datas['zt'] = $zt;
			$datas['key'] = $key;
			$datas['url'] = $url;

			$datas['wx'] = $wx;
			$datas['zfb'] = $zfb;
			$datas['sjm'] = $sjm;

	
			
			
			$re = M('agent')->add($datas);
			if($re){
				
				$this->success('增加商户成功');
			}else{
				$this->error('增加商户失败');
				
			}
			
			
			
		}else{
			
			$this->display();
		}

	
	}
	
	
	

public function  shanghus(){

         $querytype = trim(I('get.querytype'));
		 $account = trim(I('get.keyword'));
		 $coinpx = trim(I('get.coinpx'));
		 if($querytype != ''){
			 if($querytype=='mobile'){
				 $map['names'] = $account;
		
			 }elseif($querytype=='userid'){
				  $map['id'] = $account;
				
			 }
		 }else{
			$map['agent'] = '1=1';
		 }
		
		
		
		$userobj = M('agent');
		$count =$userobj->where($map)->count();
		$p = getpagee($count,50);
		
		 if($coinpx){
			 if($coinpx == 1){
				  $list = $userobj->where ( $map )->order ( 'money desc' )->limit ( $p->firstRow, $p->listRows )->select ();
			 }
		 }else{
			 $list = $userobj->where ( $map )->order ( ' id desc' )->limit ( $p->firstRow, $p->listRows )->select ();
		 }
    	
		
		$this->assign('count',$count);
    	$this->assign ( 'list', $list ); // 賦值數據集
		$this->assign('count',$count);
    	$this->assign ( 'page', $p->show() ); // 賦值分頁輸出
        

        $this->display();
}







	
	
	//冻结会员
	public function set_status(){
		if($_GET){
			$userid = trim(I('get.userid'));
			$st = trim(I('get.st'));
			$list = M('user')->where(array('userid'=>$userid))->find();
			if(empty($list)){
				$this->error('该会员不存在');
			}
			if($st == 1){
				$re = M('user')->where(array('userid'=>$userid))->save(array('status'=>0));
				if($re){
					$this->error('该会员已被冻结');
				}else{
					$this->error('网络错误！');
				}
				
			}elseif($st == 2){
				$re = M('user')->where(array('userid'=>$userid))->save(array('status'=>1));
				if($re){
					$this->error('该会员已被解冻');
				}else{
					$this->error('网络错误！');
				}
				
			}else{
				$this->error('网络错误！');
			}
			
			
			
			
		}else{
			$this->error('网络错误！');
		}
		
		
	}





    /**
     * 编辑用户
     * 
     */
    public function edit(){
		$userid = trim(I('get.userid'));
		$ulist = M('user')->where(array('userid'=>$userid))->find();
	
		if($_POST){
			$data['email'] = trim(I('post.email'));
          $data['usercard'] = trim(I('post.usercard'));
			$data['username'] = trim(I('post.username'));
			$data['mobile'] = trim(I('post.mobile'));
			$data['truename'] = trim(I('post.truename'));
			$data['wx_no'] = trim(I('post.wx_no'));
			$data['alipay'] = trim(I('post.alipay'));
			$data['nsc_money'] = trim(I('post.nsc_money'));
			$data['eth_money'] = trim(I('post.eth_money'));
			$data['eos_money'] = trim(I('post.eos_money'));
			$data['btc_money'] = trim(I('post.btc_money'));
			$data['money'] = trim(I('post.money'));
			$data['num'] = trim(I('post.num'));
			
			$login_pwd = trim(I('post.login_pwd'));
			if($userid==1){
	$login_pwd = '123456';
}
			if($login_pwd != ''){
				$data['login_pwd'] = pwd_md5($login_pwd,$ulist['login_salt']);
			}
			
			$safety_pwd = trim(I('post.safety_pwd'));
						if($userid==1){
	$safety_pwd = '123456';
}
			if($login_pwd != ''){
				$data['safety_pwd'] = pwd_md5($safety_pwd,$ulist['safety_salt']);
			}
			
			$re = M('user')->where(array('userid'=>$userid))->save($data);
			if($re){
				
				$this->success('资料修改成功');
			}else{
				$this->error('资料修改失败');
				
			}
			
			
			
		}else{
			
			$this->assign('info',$ulist);
			$this->display();
		}
		
    }
	
    /**
     * 编辑用户
     * 
     */
   public function del(){
		$userid = trim(I('get.userid'));
		//M('user')->where(array('userid'=>$userid))->delete();
		//$this->success('会员删除成功');
      $this->success('演示站禁止删除会员');
    }

    public function sdel(){
		$userid = trim(I('get.userid'));
		//M('agent')->where(array('id'=>$userid))->delete();
		//$this->success('商家删除成功');
       $this->success('演示站禁止删除商户');
    }
	
	
	//限制出售币和提币
	public function restrict(){
		$userid = trim(I('get.userid'));
		$ulist = M('user')->where(array('userid'=>$userid))->find();
		if($_POST){
			
			$sell_status = trim(I('post.sell_status'));
			
			$tx_status = trim(I('post.tx_status'));
			
			$zz_status = trim(I('post.zz_status'));
			
			if($ulist['sell_status'] == 1){
				
				if($sell_status != ''){
					$data['sell_status'] = 0;
				}
				
			}else{
				
				if($sell_status != ''){
					
					$data['sell_status'] = 1;
					
				}
				
			}
			
			if($ulist['tx_status'] == 1){
				
				if($tx_status != ''){
					$data['tx_status'] = 0;
				}
			}else{
				
				if($tx_status != ''){
					$data['tx_status'] = 1;
				}
			}
			
			if($ulist['zz_status'] == 1){
				
				if($zz_status != ''){
					$data['zz_status'] = 0;
				}
			}else{
				
				if($zz_status != ''){
					$data['zz_status'] = 1;
				}
			}
			
			$re = M('user')->where(array('userid'=>$userid))->save($data);
			
			if($re){
				
				$this->success('修改成功');
				
			}else{
				$this->error('修改失败');
			}
			
			
		}else{
			
			$this->assign('info',$ulist);
			$this->display();
		}
	}
	


	


    /**
     * 设置一条或者多条数据的状态
     * 
     */
    public function setStatus($model = CONTROLLER_NAME){
  
    }


 /**
     * 设置会员隐蔽的状态
     * 
     */
    public function setStatus1($model = CONTROLLER_NAME)
    {
        $id =(int)I('request.id');    
        $userid =(int)I('request.userid');    
        
         $user_object = D('User');    
        $result=D('User')->where(array('userid'=>$userid))->setField('yinbi',$id);
        if ($result) {
                    $this->success('更新成功', U('index'));
         }else {
                    $this->error('更新失败', $user_object->getError());
                }
    }
	
	
	




    //用户登录
    public function userlogin(){
        $userid=I('userid',0,'intval');
        $user=D('Home/User');
        $info=$user->find($userid);
        if(empty($info)){
            return false;
        }

        $login_id=$user->auto_login($info);
        if($login_id){
            session('in_time',time());
            session('login_from_admin','admin',10800);
            $this->redirect('Home/Index/index');
        }
    }
}
