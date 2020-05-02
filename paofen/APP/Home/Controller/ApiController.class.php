<?php

namespace Home\Controller;

use Think\Controller;

class ApiController extends Controller
{

    public function heartbeat(){

        $seretKey = I('get.seretKey');
        $ret = array();
        $ret['success'] = 'true';
        $ret['msg'] = 'success';
        $ret['code'] = 200;
        $ret['total'] = null;
        $ret['timestamp'] = time();
        $ret['data'] = null;
        if(!$seretKey){
            $ret['msg'] = 'error';
        }

        $check = M('agent')->field('id')->where(array('key'=>$seretKey))->find();

        if(!$check){
            $ret['msg'] = 'error';
        }
        echo json_encode($ret);
    }


    public function appConfirmToPaid(){

        $get = I('get.');

        p($get);
        if ($get) {
            $Model = M();
            $Model->startTrans();
            $userid = session('userid');
            //$id = trim(I('get.id'));
            $ulist = M('user')->where(array('userid' => $userid))->find();
            $olist = M('userrob')->where(array('id' => $id))->find();

            //$ewmlist = M('ewm')->where(array('uid' => $userid, 'ewm_price' => $olist['price'], 'ewm_class' => $olist['class'], 'zt' => 1))->find();

            if ($olist['status'] != 2) {
                $this->error('未知错误', U('Index/shoudan'));
            }

            $sxf = M('system')->where(array('id' => 1))->find();
            $wx = $sxf['wxb'];
            $zfb = $sxf['zfbb'];
            $yl = $sxf['ylb'];

            $m = $olist['pay_money'];  //确认充值的金额//
            if ($olist['class'] == 1) {

                $yj = ($m * $wx / 100);

            } else if ($olist['class'] == 2) {

                $yj = ($m * $zfb / 100);

            } else if ($olist['class'] == 3) {

                $yj = ($m * $yl / 100);

            }
            $psaves['status'] = 3;
            $psaves['finishtime'] = time();
            M('userrob')->where(array('id' => $id))->save($psaves);  //完成

            $ewmzt1['zt1'] = 0;
            $ewmzt1['gengxintime'] = time();
            M('ewm')->where(array('id' => $olist['idewm']))->save($ewmzt1);

            $pid = $olist['ppid'];
            $psave['uid'] = $userid;
            $psave['uname'] = $ulist['truename'];
            $psave['umoney'] = $ulist['money'];
            $psave['pipeitime'] = time();
            $psave['status'] = 3;

            $pipei_re = M('roborder')->where(array('id' => $pid))->save($psave);//完成
//商户余额增加
            $shanghu = M('roborder')->where(array('id' => $pid))->find();//完成
            $shanghuxx = M('agent')->where(array('names' => $shanghu['shanghu_name']))->find();//完成
            if ($olist['class'] == 1) {

                $shdz = $m - ($m * $shanghuxx['wx'] / 100);
            } else if ($olist['class'] == 2) {

                $shdz = $m - ($m * $shanghuxx['zfb'] / 100);
            } else if ($olist['class'] == 3) {

                $shdz = $m - ($m * $shanghuxx['sjm'] / 100);
            }


            $shye['money'] = $shanghuxx['money'] + $shdz;
            $pipei_re = M('agent')->where(array('names' => $shanghu['shanghu_name']))->save($shye);//完成

            //总收益
            $newss = $ulist['zsy'] + $yj;
            $xyf = $ulist['xyf'] + 1;
            $usss['zsy'] = $newss;
            $usss['xyf'] = $xyf;
            $usss['money'] = $ulist['money'] + $yj;
            M('user')->where(array('userid' => $userid))->save($usss);//完成
            $mxs['uid'] = $userid;
            $mxs['jl_class'] = 1;
            $mxs['info'] = '佣金收入+';
            $mxs['addtime'] = time();
            $mxs['jc_class'] = '+';
            $mxs['num'] = $yj;
            // $mxs['xjuid'] =$userid;

            $up_re = M('somebill')->add($mxs);


            $mxss['uid'] = $userid;
            $mxss['jl_class'] = 6;
            $mxss['info'] = '充值' . $m . '确认-';
            $mxss['addtime'] = time();
            $mxss['jc_class'] = '-';
            $mxss['num'] = $m;


            $up_re = M('somebill')->add($mxss);


            M('dj')->where(array('ppid' => $pid))->delete();

            $clist = M('system')->where(array('id' => 1))->find();
            $oneuser = M('user')->where(array('userid' => $ulist['pid']))->find();//上一代

            //一代佣金奖励
            if (!empty($oneuser)) {

                $oneyj_money = $yj * $clist['team_oneyj']; //上一代佣金

                $puser_inc_re = M('user')->where(array('userid' => $ulist['pid']))->setInc('money', $oneyj_money);

                if ($puser_inc_re) {
                    $puser_bill['uid'] = $oneuser['userid'];
                    $puser_bill['jl_class'] = 1; //佣金类型
                    $puser_bill['info'] = '直推抢单成功佣金';
                    $puser_bill['addtime'] = time();
                    $puser_bill['jc_class'] = '+';
                    $puser_bill['num'] = $oneyj_money;
                    $puser_bill['xjuid'] = $userid;
                    M('somebill')->add($puser_bill);
                }

                $twouser = M('user')->where(array('userid' => $oneuser['pid']))->find();//上二代

                if (!empty($twouser)) {

                    $twoyj_money = $yj * $clist['team_twoyj']; //二代佣金
                    $twouser_inc_re = M('user')->where(array('userid' => $oneuser['pid']))->setInc('money', $twoyj_money);
                    if ($twouser_inc_re) {
                        $twouser_bill['uid'] = $twouser['userid'];
                        $twouser_bill['jl_class'] = 1; //佣金类型
                        $twouser_bill['info'] = '二代抢单成功佣金';
                        $twouser_bill['addtime'] = time();
                        $twouser_bill['jc_class'] = '+';
                        $twouser_bill['num'] = $twoyj_money;
                        $twouser_bill['xjuid'] = $userid;
                        M('somebill')->add($twouser_bill);
                    }

                    $threeuser = M('user')->where(array('userid' => $twouser['pid']))->find();//上三代
                    if (!empty($threeuser)) {
                        $threeyj_money = $yj * $clist['team_threeyj']; //三代佣金
                        $threeuser_inc_re = M('user')->where(array('userid' => $twouser['pid']))->setInc('money', $threeyj_money);

                        if ($threeuser_inc_re) {
                            $threeuser_bill['uid'] = $threeuser['userid'];
                            $threeuser_bill['jl_class'] = 1; //佣金类型
                            $threeuser_bill['info'] = '三代抢单成功佣金';
                            $threeuser_bill['addtime'] = time();
                            $threeuser_bill['jc_class'] = '+';
                            $threeuser_bill['num'] = $threeyj_money;
                            $threeuser_bill['xjuid'] = $userid;
                            M('somebill')->add($threeuser_bill);
                        }
                    }
                }
            }

            $Model = M()->commit();
            zhifuchenggongtz($id);
            $ret = [];
            $ret['url'] = $shanghu['notify_url'];
            $ret['price'] = $shanghu['price'];
            $ret['time'] = $shanghu['ordernum'];
            $ret['md5key'] =  md5(md5($shanghu['ordernum'] . $shanghu['price'] . $shanghuxx['names']) . $shanghuxx['key']);
            $ret['status'] = $shanghu['status'];

            $this->success(json_encode($ret), U('Index/index'),true);
        }
    }

}