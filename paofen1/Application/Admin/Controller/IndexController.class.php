<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends AdminController {

    public function index(){
		
		
		$this->getUserCount();
		$this->getmoneyCount();
		$this->getorderCount();

        $this->assign('meta_title', "首页");
        $this->display();
    }


   
  public function seeNum()
	{
    $str="您有新的";
		$recharge = M('recharge')->where(array('status'=>1))->count();
    if($recharge>0){
    $str.="充值";
    }
		$cash =  M('withdraw')->where(array('status'=>1))->count();
    if($cash>0){
    $str.="提现";
    }
    $orders =  M('userrob')->where(array('status'=>2))->count();
    if($orders>0){
    $str.="匹配";
    }
$map['ts'] =array('gt',0);
    $map['status'] =array('lt',3);
		$userobj =M('userrob');
		$count =$userobj->where($map)->count();
    if($count>0){
    $str.="投诉";
    }
		$data = array();
    
		if ($count>0||$recharge||$orders||$cash>0) {
			$data['code'] = '001';
			$data['msg'] = $str . '信息，请查看！';
		}else {
					$data['code'] = '000';
					$data['msg'] = '';
					$data['url'] = '';
				}
		/*elseif($cash>0) {
			if (0 < $cash && $recharge == 0) {
				$data['code'] = '002';
				$data['msg'] = '您有' . $cash . '条提现记录，请查看！';
			}
			else {
				if ($cash == 0 && 0 < $recharge) {
					$data['code'] = '003';
					$data['msg'] = '您有' . $recharge . '条充值记录，请查看！';
				}
				else {
					$data['code'] = '000';
					$data['msg'] = '';
					$data['url'] = '';
				}
			}
		}*/

		$data['url'] = '/Public/sy.mp3' ;
		$this->ajaxReturn($data);
	}
	
	    //获取会员数据统计
    public function getUserCount($w=''){
        $user=D('User');
		
        $user_total=$user->count();
		
        $start=strtotime(date('Y-m-d'));
		
        $end=$start+86400;
		
        $where="reg_date BETWEEN {$start} AND {$end}";
		 $where1="pipeitime BETWEEN {$start} AND {$end}";
        $user_count=$user->where($where)->count();
       $user_sum=D('roborder')->where($where1)->sum('price');
      $user_sum1=D('roborder')->where($where1)->count();
			$countmoney = $user->sum('money');
        $this->assign('user_sum', $user_sum);
       $this->assign('user_sum1', $user_sum1);
       $this->assign('countmoney', $countmoney);
        $this->assign('user_total', $user_total);
		
        $this->assign('user_count', $user_count);
		
		
    }
    public function qingli(){

    	 if($_POST){ 
               D('user')->where('1')->delete();
		        D('deal')->where('1')->delete();
		        D('deals')->where('1')->delete();
		        D('crowds')->where('1')->delete();
		        D('tranmoney')->where('1')->delete();        
		        D('crowds_detail')->where('1')->delete();
		        D('store')->where('1')->delete();
		        D('order')->where('1')->delete();
		        D('order_detail')->where('1')->delete();
		        D('trans')->where('1')->delete();
		        D('ubanks')->where('1')->delete();
		        D('ucoins')->where('1')->delete();
		        D('wbao_detail')->where('1')->delete();
		        D('wetrans')->where('1')->delete();
		        $this->success("删除成功");
    	 } else {

    	 	$this->assign('meta_title', "清理数据");
    	    $this->display();
    	 }
        
    }
	
	public function getmoneyCount($w=''){
         $start=strtotime(date('Y-m-d'));
		
        $end=$start+86400;
		
        $where="addtime BETWEEN {$start} AND {$end}";
      $today_chong = M('recharge')->where($where)->sum('price');
		$resum = M('recharge')->sum('price');
		$wisum = M('withdraw')->sum('price');
		 $this->assign('wisum', $wisum);
		 $this->assign('resum', $resum);
	}
	
	public function getorderCount($w=''){
		$sucorder_count = M('userrob')->where(array('status'=>2))->count();
		$nollorder_count = M('userrob')->where(array('status'=>1))->count();
		
		$finishorder_count = M('userrob')->where(array('status'=>3))->count();
		$finishorder_money = M('userrob')->where(array('status'=>3))->sum('price');
		
		$sucorder_money = M('userrob')->where(array('status'=>2))->sum('price');
		$dd_ordern_admin = M('roborder')->where(array('status'=>1))->sum('price');
		$dd_orderm_admin = M('roborder')->where(array('status'=>1))->count();
		
		$sumyj = M('somebill')->where(array('jl_class'=>1))->sum('num');


		$cg = round(($dd_orderm_admin/$finishorder_count )*100);

		 $this->assign('cg',$cg);
		
		 $this->assign('sumyj', $sumyj);
		 $this->assign('finishorder_count', $finishorder_count);
		 $this->assign('finishorder_money', $finishorder_money);
		 $this->assign('dd_ordern_admin', $dd_ordern_admin);
		 $this->assign('dd_orderm_admin', $dd_orderm_admin);
		 $this->assign('sucorder_money', $sucorder_money);
		 $this->assign('sucorder_count', $sucorder_count);
		 $this->assign('nollorder_count', $nollorder_count);
		

	}




    /**
     * 删除缓存
     */
    public function removeRuntime()
    {
        $file   = new \Util\File();
        $result = $file->del_dir(RUNTIME_PATH);
        if ($result) {
            $this->success("缓存清理成功1");
        } else {
            $this->error("缓存清理失败1");
        }
    }
}