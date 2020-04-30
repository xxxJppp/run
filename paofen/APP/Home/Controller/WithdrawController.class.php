<?php
namespace Home\ Controller;
use Think\Controller;
class WithdrawController extends CommonController {

	//提现记录管理
    public function index(){
		$uid = session('userid');
		$welist = M('withdraw')->where(array('uid'=>$uid))->order('id desc')->select();
		$this->assign('welist',$welist);
        $this->display();
    }
	
	//提现页面
	public function tixian(){
      
		$uid = session('userid');
		$ulist = M('user')->where(array('userid'=>$uid))->find();
      $clist = M('system')->where(array('id'=>1))->find();
      //$ylist = M('bankcard')->where(array('uid'=>$uid))->select();
      //if(!$ylist){die("<script>alert('请先绑定银行卡！');history.back(-1);</script>");}
      $ulist['bmoney']=$ulist['money']-$clist['ed'];
		$this->assign('ulist',$ulist);
      $this->assign('clist',$clist);
      
		$this->display();
	}
	
	//提现处理
	public function drawup(){
		if($_POST){
			$uid = session('userid');
			$ulist = M('user')->where(array('userid'=>$uid))->find();
			/*******这里写提现条件********/
			$model = M();
			$model->startTrans();
			$save['uid'] = $uid;
			$save['account'] = trim(I('post.account'));
			$save['name'] = trim(I('post.uname'));
			$save['way'] = trim(I('post.num')).'|'.trim(I('post.way')).'|'.trim(I('post.wangdian'));
			$save['price'] = trim(I('post.price'));
			$save['addtime'] = time();
			$save['status'] = 1;

			$clist = M('system')->where(array('id'=>1))->find();
			
			if($save['price'] < $clist['mix_withdraw']){
				$data['status'] = 0;
				$data['msg'] = '最小提现额度'.$clist['mix_withdraw'].'元';
				$this->ajaxReturn($data);exit;
			}
			
			if($save['price'] > $clist['max_withdraw']){
				
				$data['status'] = 0;
				$data['msg'] = '最大提现额度'.$clist['max_withdraw'].'元';
				$this->ajaxReturn($data);exit;
				
			}
			$pipei_sum_price = M('userrob')->where(array('uid'=>$uid,'status'=>3))->sum('price');
			$rech_sum_price = M('recharge')->where(array('uid'=>$uid,'status'=>3))->sum('price');
			
			$blz = $pipei_sum_price / $rech_sum_price;
			
			$cblz = $clist['tx_yeb'] / 100;
			
			if($blz < $cblz){
				
				$data['status'] = 0;
				$data['msg'] = '您的匹配收款额度不足';
				$this->ajaxReturn($data);exit;
			}

            $maxtx=$ulist['money']-$clist['ed'];
			if($save['price'] > $maxtx){
				$data['status'] = 0;
				$data['msg'] = '您最多能提现'.$maxtx.'元';
				$this->ajaxReturn($data);exit;
			}
			
			$re = M('withdraw')->add($save);
			
			$ure =  M('user')->where(array('userid'=>$uid))->setDec('money',$save['price']);//直接扣除提现金额

            $mxs['uid'] = $uid;
		   $mxs['jl_class'] = 4;
		   $mxs['info'] = '提现';
		   $mxs['addtime'] = time();
		   $mxs['jc_class'] = '-';
		   $mxs['num'] = $save['price'];
		   $up_re = M('somebill')->add($mxs);

			if($re && $ure && $up_re){
				$model->commit();
				$data['status'] = 1;
				$data['msg'] = '提现已提交';
				$this->ajaxReturn($data);exit;
				
			}else{
				$model->rollback();
				$data['status'] = 0;
				$data['msg'] = '非法操作';
				$this->ajaxReturn($data);exit;
				
			}
			
			
		}else{
			$data['status'] = 0;
			$data['msg'] = '非法操作2';
			ajaxReturn($data);exit;
		}
		
	}


}