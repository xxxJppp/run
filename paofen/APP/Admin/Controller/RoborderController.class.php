<?php

namespace Admin\Controller;

use Think\Page;


class RoborderController extends AdminController
{

    /**
     * 后台添加的待匹配记录
     */

    public function index()
    {

        $fy = I('get.fy', 100);

        $map['id'] = array('gt', 0);
        if (I('get.mobile')) {
            $map['class'] = I('get.mobile');
        }
        if (I('get.userid')) {
            $map['ordernum'] = I('get.userid');
        }
        if (I('get.zt')) {
            $map['status'] = I('get.zt');
        }
        if (I('get.money')) {
            $map['price'] = I('get.money');
        }

        if (I('get.date')) {
            $st = strtotime(I('get.date'));
            // $en=$st+86400;
            $map['addtime'] = array('EGT', $st);
        }

        if (I('get.dateend')) {
            $stt = strtotime(I('get.dateend'));
            $en = $stt + 86400;
            $map['addtime'] = array('ELT', $en);
        }
        if (I('get.date') && I('get.dateend')) {
            $st = strtotime(I('get.date'));
            $stt = strtotime(I('get.dateend'));
            $en = $stt + 86400;

            $map['addtime'] = array('between', array($st, $en));
        }
        $userobj = M('roborder');
        $count = $userobj->where($map)->count();
        //echo M()->getlastsql();exit;
        $p = getpagee($count, $fy);

        if ($account <= 3) {
            $list = $userobj->where($map)->order('id desc')->limit($p->firstRow, $p->listRows)->select();

        } elseif ($account > 3) {
            $list = $userobj->where($map)->order('id desc')->limit($p->firstRow, $p->listRows)->select();
        } elseif ($account == '') {
            $list = $userobj->where($map)->order('id desc')->limit($p->firstRow, $p->listRows)->select();
        }


        $this->assign('count', $count);
        $this->assign('info', $list); // 賦值數據集
        $this->assign('count', $count);
        $this->assign('page', $p->show()); // 賦值分頁輸出
        $this->display();
    }

    public function qrs()
    {


        if ($_POST) {
            $Model = M();
            $Model->startTrans();
            $id = I('post.id');
            $status = I('post.status');
            $olist = M('userrob')->where(array('id' => $id))->find();
            if ($status == 0) {
                $userid = $olist['uid'];
                $ulist = M('user')->where(array('userid' => $userid))->find();


                //$ewmlist = M('ewm')->where(array('uid'=>$userid,'ewm_price'=>$olist['price'],'ewm_class'=>$olist['class'],'zt'=>1))->find();

                if ($olist['status'] != 4) {

                    $this->error('已经补单');
                }

                $sxf = M('system')->where(array('id' => 1))->find();
                $wx = $sxf['wxb'];
                $zfb = $sxf['zfbb'];
                $yl = $sxf['ylb'];

                $m = $olist['pay_money'];  //确认充值的金额//
                if ($olist['class'] == 1) {

                    $yj = ($m * $wx / 100);

                    $ms = $m;

                } else if ($olist['class'] == 2) {

                    $yj = ($m * $zfb / 100);

                    $ms = $m;

                } else if ($olist['class'] == 3) {

                    $yj = ($m * $yl / 100);

                    $ms = $m;
                }


                $psaves['status'] = 3;

                $psaves['finishtime'] = time();
                M('userrob')->where(array('id' => $id))->save($psaves);  //完成


                $ewmzt1['zt1'] = 0;
                //$ewmzt1['cgsk']=array('exp','cgsk+1');
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
                $shanghuxx = M('merchant')->where(array('names' => $shanghu['shanghu_name']))->find();//完成
                if ($olist['class'] == 1) {

                    $shdz = $m - ($m * $shanghuxx['wx'] / 100);


                } else if ($olist['class'] == 2) {

                    $shdz = $m - ($m * $shanghuxx['zfb'] / 100);


                } else if ($olist['class'] == 3) {

                    $shdz = $m - ($m * $shanghuxx['sjm'] / 100);


                }


                $shye['money'] = $shanghuxx['money'] + $shdz;
                $pipei_re = M('merchant')->where(array('names' => $shanghu['shanghu_name']))->save($shye);//完成


                //总收益
                $newss = $ulist['zsy'] + $yj;

                $usss['zsy'] = $newss;
                $usss['money'] = $ulist['money'] + $yj - $olist['price'];
                M('user')->where(array('userid' => $userid))->save($usss);//完成


                $mxs['uid'] = $userid;
                $mxs['jl_class'] = 1;
                $mxs['info'] = '佣金收入+';
                $mxs['addtime'] = time();
                $mxs['jc_class'] = '+';
                $mxs['num'] = $yj;


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
                                M('somebill')->add($threeuser_bill);
                            }

                        }
                    }
                }
                $Model->commit();
                //zhifuchenggongtz($id);
                $this->success('确认成功', U('robsucc2'));
            } else {
                //$system = M('system')->where(array('id' => 1))->find();
                $user_order_dj = M('dj')->where(array('ppid'=>$olist['ppid']))->find();
                M('user')->where(array('userid' => $user_order_dj['uid']))->setInc('money', $user_order_dj['money']);
                M('dj')->where(array('id' => $user_order_dj['id']))->delete();
                M('ewm')->where(array('id' => $olist['idewm']))->save(array('zt1' => 0));
                M('userrob')->where(array('id' => $id))->delete();
                $Model->commit();
                $this->success('确认成功', U('robsucc2'));
            }
            // $this->success('确认成功');
        }


    }

    public function userrob()
    {


        $fy = I('get.fy', 100);

        $coinpx = trim(I('get.coinpx'));
        $map['id'] = array('gt', 0);
        if (I('get.class')) {
            $map['class'] = I('get.class');
        }
        if (I('get.mobile')) {
            $map['ordernum'] = I('get.mobile');
        }
        if (I('get.userid')) {
            $map['uaccount'] = I('get.userid');
        }
        if (I('get.zt')) {
            $map['status'] = I('get.zt');
        }
        if (I('get.money')) {
            $map['price'] = I('get.money');
        }

        if (I('get.date')) {
            $st = strtotime(I('get.date'));
            // $en=$st+86400;
            $map['addtime'] = array('EGT', $st);
        }

        if (I('get.dateend')) {
            $stt = strtotime(I('get.dateend'));
            $en = $stt + 86400;
            $map['addtime'] = array('ELT', $en);
        }
        if (I('get.date') && I('get.dateend')) {
            $st = strtotime(I('get.date'));
            $stt = strtotime(I('get.dateend'));
            $en = $stt + 86400;

            $map['addtime'] = array('between', array($st, $en));
        }


        $userobj = M('userrob');
        $count = $userobj->where($map)->count();
        $p = getpagee($count, $fy);

        if (!$coinpx) {
            $list = $userobj->where($map)->order(' id desc')->limit($p->firstRow, $p->listRows)->select();

        } else {

            $list = $userobj->where($map)->order('price desc')->limit($p->firstRow, $p->listRows)->select();
        }
        foreach ($list as $k => $v) {
            $list[$k]['ewmimg'] = $this->getEwmimg($v['idewm']);
        }

        $this->assign('count', $count);
        $this->assign('list', $list); // 賦值數據集
        $this->assign('count', $count);
        $this->assign('page', $p->show()); // 賦值分頁輸出
        $this->display();

    }

    public function robsucc2()
    {

        $fy = I('get.fy', 100);
        $coinpx = trim(I('get.coinpx'));
        $map['id'] = array('gt', 0);
        if (I('get.class')) {
            $map['class'] = I('get.class');
        }
        if (I('get.mobile')) {
            $map['ordernum'] = I('get.mobile');
        }
        if (I('get.userid')) {
            $map['uaccount'] = I('get.userid');
        }
        if (I('get.money')) {
            $map['price'] = I('get.money');
        }

        if (I('get.date')) {
            $st = strtotime(I('get.date'));
            // $en=$st+86400;
            $map['addtime'] = array('EGT', $st);
        }

        if (I('get.dateend')) {
            $stt = strtotime(I('get.dateend'));
            $en = $stt + 86400;
            $map['addtime'] = array('ELT', $en);
        }
        if (I('get.date') && I('get.dateend')) {
            $st = strtotime(I('get.date'));
            $stt = strtotime(I('get.dateend'));
            $en = $stt + 86400;

            $map['addtime'] = array('between', array($st, $en));
        }

        $map['status'] = 4;


        $userobj = M('userrob');
        $count = $userobj->where($map)->count();
        $p = getpagee($count, $fy);

        if ($coinpx == 1) {
            $list = $userobj->where($map)->order('umoney desc')->limit($p->firstRow, $p->listRows)->select();

        } else {

            $list = $userobj->where($map)->order('id desc')->limit($p->firstRow, $p->listRows)->select();
        }

        foreach ($list as $k => $v) {
            $list[$k]['ewmimg'] = $this->getEwmimg($v['idewm']);
        }

        $this->assign('count', $count);
        $this->assign('list', $list); // 賦值數據集
        $this->assign('count', $count);
        $this->assign('page', $p->show()); // 賦值分頁輸出
        $this->display();

    }

    //会员抢单意向列表
    public function tsgl()
    {


        $fy = I('get.fy', 100);

        $coinpx = trim(I('get.coinpx'));
        $map['id'] = array('gt', 0);
        if (I('get.class')) {
            $map['class'] = I('get.class');
        }
        if (I('get.mobile')) {
            $map['ordernum'] = I('get.mobile');
        }
        if (I('get.userid')) {
            $map['uaccount'] = I('get.userid');
        }
        if (I('get.zt')) {
            $map['status'] = I('get.zt');
        } else {
            $map['status'] = array('lt', 3);
        }
        if (I('get.money')) {
            $map['price'] = I('get.money');
        }

        if (I('get.date')) {
            $st = strtotime(I('get.date'));
            // $en=$st+86400;
            $map['addtime'] = array('EGT', $st);
        }

        if (I('get.dateend')) {
            $stt = strtotime(I('get.dateend'));
            $en = $stt + 86400;
            $map['addtime'] = array('ELT', $en);
        }
        if (I('get.date') && I('get.dateend')) {
            $st = strtotime(I('get.date'));
            $stt = strtotime(I('get.dateend'));
            $en = $stt + 86400;

            $map['addtime'] = array('between', array($st, $en));
        }


        $map['ts'] = array('gt', 0);
        $userobj = M('userrob');
        $count = $userobj->where($map)->count();
        $p = getpagee($count, $fy);

        if (1) {
            $list = $userobj->where($map)->order(' id desc')->limit($p->firstRow, $p->listRows)->select();

        } else {

            $list = $userobj->where($map)->order('id desc')->limit($p->firstRow, $p->listRows)->select();
        }
        foreach ($list as $k => $v) {
            $list[$k]['ewmimg'] = $this->getEwmimg($v['idewm']);
        }

        $this->assign('count', $count);
        $this->assign('list', $list); // 賦值數據集
        $this->assign('count', $count);
        $this->assign('page', $p->show()); // 賦值分頁輸出
        $this->display();

    }

//会员抢单成功记录
    public function robsucc()
    {

        $fy = I('get.fy', 100);
        $coinpx = trim(I('get.coinpx'));

        $map['id'] = array('gt', 0);
        if (I('get.class')) {
            $map['class'] = I('get.class');
        }
        if (I('get.mobile')) {
            $map['ordernum'] = I('get.mobile');
        }
        if (I('get.shdd')) {
            $map['pay_sn'] = I('get.shdd');
        }
        if (I('get.userid')) {
            $map['uaccount'] = I('get.userid');
        }
        if (I('get.zt')) {
            $map['status'] = I('get.zt');
        }
        if (I('get.money')) {
            $map['price'] = I('get.money');
        }

        if (I('get.date')) {
            $st = strtotime(I('get.date'));
            // $en=$st+86400;
            $map['addtime'] = array('EGT', $st);
        }

        if (I('get.dateend')) {
            $stt = strtotime(I('get.dateend'));
            $en = $stt + 86400;
            $map['addtime'] = array('ELT', $en);
        }
        if (I('get.date') && I('get.dateend')) {
            $st = strtotime(I('get.date'));
            $stt = strtotime(I('get.dateend'));
            $en = $stt + 86400;

            $map['addtime'] = array('between', array($st, $en));
        }

        $map['status'] = 2;
        $userobj = M('userrob');
        $count = $userobj->where($map)->count();
        $p = getpagee($count, $fy);

        if ($coinpx == 1) {
            $list = $userobj->where($map)->order('umoney desc')->limit($p->firstRow, $p->listRows)->select();

        } else {

            $list = $userobj->where($map)->order('id desc')->limit($p->firstRow, $p->listRows)->select();
        }

        foreach ($list as $k => $v) {
            $list[$k]['ewmimg'] = $this->getEwmimg($v['idewm']);
        }
        $this->assign('count', $count);
        $this->assign('list', $list); // 賦值數據集
        $this->assign('count', $count);
        $this->assign('page', $p->show()); // 賦值分頁輸出
        $this->display();

    }


//交易成功订单
    public function ordersucc()
    {

        $fy = I('get.fy', 100);
        $coinpx = trim(I('get.coinpx'));
        $map['id'] = array('gt', 0);
        if (I('get.class')) {
            $map['class'] = I('get.class');
        }
        if (I('get.mobile')) {
            $map['ordernum'] = I('get.mobile');
        }
        if (I('get.userid')) {
            $map['uaccount'] = I('get.userid');
        }
        if (I('get.money')) {
            $map['price'] = I('get.money');
        }

        if (I('get.date')) {
            $st = strtotime(I('get.date'));
            // $en=$st+86400;
            $map['addtime'] = array('EGT', $st);
        }

        if (I('get.dateend')) {
            $stt = strtotime(I('get.dateend'));
            $en = $stt + 86400;
            $map['addtime'] = array('ELT', $en);
        }
        if (I('get.date') && I('get.dateend')) {
            $st = strtotime(I('get.date'));
            $stt = strtotime(I('get.dateend'));
            $en = $stt + 86400;

            $map['addtime'] = array('between', array($st, $en));
        }

        $map['status'] = 3;


        $userobj = M('userrob');
        $count = $userobj->where($map)->count();
        $p = getpagee($count, $fy);

        if ($coinpx == 1) {
            $list = $userobj->where($map)->order('umoney desc')->limit($p->firstRow, $p->listRows)->select();

        } else {

            $list = $userobj->where($map)->order('id desc')->limit($p->firstRow, $p->listRows)->select();
        }
        foreach ($list as $k => $v) {
            $list[$k]['ewmimg'] = $this->getEwmimg($v['idewm']);
        }

        $this->assign('count', $count);
        $this->assign('list', $list); // 賦值數據集
        $this->assign('count', $count);
        $this->assign('page', $p->show()); // 賦值分頁輸出
        $this->display();

    }


//
    public function delnullorder()
    {
        $id = trim(I('get.id'));
        $re = M('userrob')->where(array('id' => $id))->delete();
        if ($re) {
            $this->success('操作成功');
            exit;
        } else {
            $this->success('操作失败');
            exit;
        }
    }


    public function zdadd()
    {
        if ($_POST) {

            $date['class'] = trim(I('post.class'));
            $date['price'] = trim(I('post.price'));
            $num = trim(I('post.account'));
            $ulist = M('user')->where(array('account' => $num))->find();
            if (!$ulist) {

                $this->error('用户不存在');
            }
            $date['addtime'] = time();
            $date['status'] = 1;
            $date['ordernum'] = getordernum();
            $date['zduid'] = $ulist['userid'];
            $date['uid'] = 0;

            if ($date['price'] == '') {

                $this->error('金额不能为空');
            }


            $re = M('roborder')->add($date);


            if ($re) {
                $this->success('添加成功', U('index'));
            } else {
                $this->error('添加失败');
            }


        } else {


            $this->display();
        }

    }


    public function add()
    {
        if ($_POST) {

            $date['class'] = trim(I('post.class'));
            $date['price'] = trim(I('post.price'));
            $num = trim(I('post.num'));
            $date['addtime'] = time();
            $date['status'] = 1;
            $date['ordernum'] = getordernum();
            if ($num == '') {
                $num = 1;
            }

            if ($date['price'] == '') {

                $this->error('金额不能为空');
            }


            for ($i = 1; $i <= $num; $i++) {
                $re = M('roborder')->add($date);
            }

            if ($re) {
                $this->success('添加成功', U('index'));
            } else {
                $this->error('添加失败');
            }


        } else {


            $this->display();
        }

    }

    //添加订单
    public function tsadd()
    {
        if ($_POST) {

            $id = I('post.id');
            $date['price'] = I('post.price');

            if ($date['price'] == '') {

                $this->error('金额不能为空');
            }
            $Model = M();
            $Model->startTrans();
            $olist1 = M('userrob')->where(array('id' => $id))->find();
            $chae = $olist1['price'] - $date['price'];
            if ($chae > 0) {
                M('user')->where(array('userid' => $olist1['uid']))->setInc('money', $chae);
            } else {
                $chae = $date['price'] - $olist1['price'];
                M('user')->where(array('userid' => $olist1['uid']))->setDec('money', $chae);
            }


            M('userrob')->where(array('id' => $id))->save(array('price' => $date['price'], 'pay_money' => $date['price']));
            $olist = M('userrob')->where(array('id' => $id))->find();
            M('roborder')->where(array('id' => $olist['ppid']))->save(array('price' => $date['price']));
            $userid = $olist['uid'];
            $ulist = M('user')->where(array('userid' => $userid))->find();


            //$ewmlist = M('ewm')->where(array('uid'=>$userid,'ewm_price'=>$olist['price'],'ewm_class'=>$olist['class'],'zt'=>1))->find();

            if ($olist['status'] != 2) {

                $this->error('未知错误');
            }

            $sxf = M('system')->where(array('id' => 1))->find();
            $wx = $sxf['wxb'];
            $zfb = $sxf['zfbb'];
            $yl = $sxf['ylb'];

            $m = $olist['pay_money'];  //确认充值的金额//
            if ($olist['class'] == 1) {

                $yj = ($m * $wx / 100);

                $ms = $m;

            } else if ($olist['class'] == 2) {

                $yj = ($m * $zfb / 100);

                $ms = $m;

            } else if ($olist['class'] == 3) {

                $yj = ($m * $yl / 100);

                $ms = $m;
            }


            $psaves['status'] = 3;

            $psaves['finishtime'] = time();
            M('userrob')->where(array('id' => $id))->save($psaves);  //完成


            $ewmzt1['zt1'] = 0;
            $ewmzt1['cgsk'] = array('exp', 'cgsk+1');
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
            $shanghuxx = M('merchant')->where(array('names' => $shanghu['shanghu_name']))->find();//完成
            if ($olist['class'] == 1) {

                $shdz = $m - ($m * $shanghuxx['wx'] / 100);


            } else if ($olist['class'] == 2) {

                $shdz = $m - ($m * $shanghuxx['zfb'] / 100);


            } else if ($olist['class'] == 3) {

                $shdz = $m - ($m * $shanghuxx['sjm'] / 100);


            }


            $shye['money'] = $shanghuxx['money'] + $shdz;
            $pipei_re = M('merchant')->where(array('names' => $shanghu['shanghu_name']))->save($shye);//完成


            //总收益
            $newss = $ulist['zsy'] + $yj;

            $usss['zsy'] = $newss;
            $usss['money'] = $ulist['money'] + $yj;
            //echo $yj.$chae;exit;
            M('user')->where(array('userid' => $userid))->save($usss);//完成


            $mxs['uid'] = $userid;
            $mxs['jl_class'] = 1;
            $mxs['info'] = '佣金收入+';
            $mxs['addtime'] = time();
            $mxs['jc_class'] = '+';
            $mxs['num'] = $yj;


            $up_re = M('somebill')->add($mxs);


            $mxss['uid'] = $userid;
            $mxss['jl_class'] = 6;
            $mxss['info'] = '充值' . $m . '确认-';
            $mxss['addtime'] = time();
            $mxss['jc_class'] = '-';
            $mxss['num'] = $m;


            $up_re = M('somebill')->add($mxss);


            M('dj')->where(array('ppid' => $pid))->delete();


            //////////////////////////////
            ///
            ///

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
                            M('somebill')->add($threeuser_bill);
                        }

                    }


                }


            }


            $Model = M()->commit();
            //zhifuchenggongtz($id);
            // $this->success('确认成功');
            $this->success('确认成功', U('tsgl'));

        } else {

            $id = trim(I('get.id'));
            $this->assign('id', $id);

            $this->display();
        }

    }

    public function getEwmimg($idewm)
    {
        if (empty($idewm)) {
            return '';
        }

        $ewmObj = M('ewm')->where(array('id' => $idewm))->find();
        if (!empty($ewmObj)) {
            return $ewmObj['ewm_url'];
        } else {
            return '';
        }
    }

    //编辑待匹配订单
    public function edit()
    {
        if ($_GET) {
            $id = trim(I('get.id'));
            $olist = M('roborder')->where(array('id' => $id))->find();
            if (empty($olist)) {
                $this->error('该订单不存在');
            }
            if ($olist['status'] != 1) {
                $this->error('该订单已被匹配');
            }
            $this->assign('olist', $olist);
            $this->display();

        } else {
            $this->error('未知错误');
        }
    }

    //删除订单
    public function delorder()
    {
        if ($_GET) {
            $id = trim(I('get.id'));
            $olist = M('roborder')->where(array('id' => $id))->find();
            if (empty($olist)) {
                $this->error('该订单不存在');
            }
            if ($olist['status'] != 1) {
                //$this->error('该订单已被匹配');
            }
            $re = M('roborder')->where(array('id' => $id))->delete();
            if ($re) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }

        } else {
            $this->error('未知错误');
        }
    }

    //取消订单
    public function cancel()
    {
        if ($_GET) {
            $id = trim(I('get.id'));
            $olist = M('userrob')->where(array('id' => $id))->find();
            if (empty($olist)) {
                $this->error('该订单不存在');
            }

            $re = M('userrob')->where(array('id' => $id))->save(array('status' => 4));
            if ($re) {
                $this->success('取消成功');
            } else {
                $this->error('取消失败');
            }

        } else {
            $this->error('未知错误');
        }
    }

    //删除订单
    public function delsuccess()
    {
        if ($_GET) {
            $id = trim(I('get.id'));
            $olist = M('userrob')->where(array('id' => $id))->find();
            if (empty($olist)) {
                $this->error('该订单不存在');
            }
            if ($olist['status'] != 1) {
                //$this->error('该订单已被匹配');
            }
            $re = M('userrob')->where(array('id' => $id))->delete();

            if ($re) {
                M('roborder')->where(array('id' => $olist['ppid']))->delete();
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }

        } else {
            $this->error('未知错误');
        }
    }

    public function editup()
    {

        if ($_POST) {

            $id = trim(I('post.id'));
            $date['class'] = trim(I('post.class'));
            $date['price'] = trim(I('post.price'));


            if ($date['price'] == '') {

                $this->error('金额不能为空');
            }


            $re = M('roborder')->where(array('id' => $id))->save($date);

            if ($re) {
                $this->success('修改成功', U('index'));
            } else {
                $this->error('修改失败');
            }


        } else {


            $this->error('未知错误');
        }
    }


//匹配会员发布的空匹配订单
    public function putorder()
    {
        if ($_GET) {
            $id = trim(I('get.id'));
            $olist = M('userrob')->where(array('id' => $id))->find();
            $ulist = M('user')->where(array('userid' => $olist['uid']))->find();
            $clist = M('system')->where(array('id' => 1))->find();
            /********匹配的金额是该会员上传的对应的最小收款金额***********/
            if ($ulist['money'] > 0) {
                $max_pipeinone = $ulist['money'] * ($clist['qd_cf'] / 100);
            } else {
                $max_pipeinone = 0;
            }


            $uewm = M('ewm')->where(array('uid' => $olist['uid'], 'ewm_class' => $olist['class'], 'ewm_price' => array('elt', $max_pipeinone)))->order('ewm_price asc')->select();
            if (!$uewm) {
                $this->error('匹配订单生成成功');
                exit;
            }


            $price = $uewm[array_rand($uewm)]['ewm_price'];


            $data['class'] = $olist['class'];
            $data['price'] = $price;
            $data['addtime'] = time();
            $data['status'] = 2;
            $data['uid'] = $olist['uid'];
            $data['uname'] = $olist['uname'];
            $data['umoney'] = $olist['umoney'];
            $data['pipeitime'] = time();
            $data['ordernum'] = $olist['ordernum'];

            $reid = M('roborder')->add($data);
            if ($reid) {

                $save['price'] = $price;
                $save['ppid'] = $reid;
                $save['status'] = 2;
                $save['price'] = $price;
                $save['pipeitime'] = time();
                $save['yjjc'] = $clist['yjjc'];
                $re = M('userrob')->where(array('id' => $id))->save($save);

                if ($re) {

                    $this->success('匹配订单生成成功');
                    exit;

                } else {
                    $this->error('匹配订单生成失败');
                    exit;
                }
            } else {
                $this->error('匹配订单生成失败');
                exit;
            }

        } else {
            $this->error('非法操作');
            exit;
        }
    }


//游戏参数设置页面
    public function asystem()
    {
        if ($_POST) {
            $data['qd_kf'] = trim(I('post.qd_kf'));

            $data['qd_cf'] = trim(I('post.qd_cf'));
            $data['qd_nd'] = trim(I('post.qd_nd'));
            $data['qd_wxyj'] = trim(I('post.qd_wxyj'));
            $data['qd_zfbyj'] = trim(I('post.qd_zfbyj'));
            $data['qd_bkyj'] = trim(I('post.qd_bkyj'));
            $data['qd_ndtime'] = trim(I('post.qd_ndtime'));
            $data['qd_yjjc'] = trim(I('post.qd_yjjc'));
            $data['qd_minmoney'] = trim(I('post.qd_minmoney'));
            $data['min_recharge'] = trim(I('post.min_recharge'));
            $data['mix_withdraw'] = trim(I('post.mix_withdraw'));
            $data['max_withdraw'] = trim(I('post.max_withdraw'));
            $data['tx_yeb'] = trim(I('post.tx_yeb'));
            $data['team_oneyj'] = trim(I('post.team_oneyj'));
            $data['team_twoyj'] = trim(I('post.team_twoyj'));
            $data['team_threeyj'] = trim(I('post.team_threeyj'));
            $data['jdtime'] = trim(I('post.jdtime'));
            $data['ylb'] = trim(I('post.ylb'));
            $data['zfbb'] = trim(I('post.zfbb'));
            $data['wxb'] = trim(I('post.wxb'));
            $data['ed'] = trim(I('post.ed'));
            $data['lose_time'] = trim(I('post.lose_time'));
            $data['back_money_time'] = trim(I('post.back_money_time'));
            $data['order_num'] = trim(I('post.order_num'));
            $re = M('system')->where(array('id' => 1))->save($data);
            //echo M('system')->getLastSql();  exit;

            if ($re) {
                $this->success('修改成功');
                exit;
            } else {

                $this->error('修改失败');
                exit;
            }


        } else {
            $list = M('system')->where(array('id' => 1))->find();
            $this->assign('info', $list);
            $this->display();
        }

    }


//支付金额页面
    public function paypage()
    {
        $id = trim(I('get.id'));
        $list = M('userrob')->where(array('id' => $id))->find();
        $this->assign('info', $list);
        $this->display();
    }

//支付成功处理
    /********业务分析************/
    /*
    *产生佣金，上三代分享佣金
    *扣除会员账户额度
    *更改定单状态（两张表）
    *生成资金日志
    */
    public function payup()
    {
        if ($_POST) {
            $m = M();
            $m->startTrans();
            $id = trim(I('post.id'));
            $list = M('userrob')->where(array('id' => $id))->find();//操作的订单
            $pipeilist = M('roborder')->where(array('id' => $list['ppid']))->find();//被 匹配的订单
            $ulist = M('user')->where(array('userid' => $list['uid']))->find();
            $clist = M('system')->where(array('id' => 1))->find();

            $yjbl = 0; //支付类型佣金比例
            $yjjc = $list['yjjc']; //当前佣金加成
            if ($list['class'] == 1) {
                $yjbl = $clist['wxb'];
                $str = '微信抢单';
            } elseif ($list['class'] == 2) {
                $yjbl = $clist['zfbb'];
                $str = '支付宝抢单';
            } elseif ($list['class'] == 3) {
                $yjbl = $clist['ylb'];
                $str = '银行卡抢单';
            }
            $yjbl = $yjbl + $yjjc;//实际佣金比例

            $dec_price = $list['price'] - $list['price'] * $yjbl; //实际需扣除会员的金额。

            $yj_money = $list['price'] * $yjbl; //实际的佣金金额

            $udec_re = M('user')->where(array('userid' => $list['uid']))->setDec('money', $dec_price); //减去金额
            $zsy_re = M('user')->where(array('userid' => $list['uid']))->setInc('zsy', ($list['price'] + $yj_money)); //记录匹配收款和佣金


//		var_dump(M('user')->where(array('userid'=>$list['uid']))->find(),array('userid'=>$list['uid']),$udec_re , $zsy_re);
            if ($udec_re && $zsy_re) {

                $mdst_re = M('userrob')->where(array('id' => $id))->save(array('status' => 3, 'finishtime' => time())); //修改定单状态

                $rob_mdst = M('roborder')->where(array('id' => $list['ppid']))->save(array('status' => 3, 'finishtime' => time())); //修改后台发布的订单状态

                if ($mdst_re && $rob_mdst) {

                    $billdec['uid'] = $ulist['userid'];
                    $billdec['jl_class'] = 6; //抢单
                    $billdec['info'] = '充值' . $list['price'] . '确认-';
                    $billdec['addtime'] = time();
                    $billdec['jc_class'] = '-';
                    $billdec['num'] = $list['price'];

                    $billdec_re = M('somebill')->add($billdec);

                    $billinc['uid'] = $ulist['userid'];
                    $billinc['jl_class'] = 1; //佣金类型
                    $billinc['info'] = $str . '佣金';
                    $billinc['addtime'] = time();
                    $billinc['jc_class'] = '+';
                    $billinc['num'] = $yj_money;

                    $billinc_re = M('somebill')->add($billinc);
                    if ($billdec_re && $billinc_re) {

                        $oneuser = M('user')->where(array('userid' => $ulist['pid']))->find();//上一代

                        //一代佣金奖励
                        if (!empty($oneuser)) {

                            $oneyj_money = $yj_money * $clist['team_oneyj']; //上一代佣金

                            $puser_inc_re = M('user')->where(array('userid' => $ulist['pid']))->setInc('money', $oneyj_money);

                            if ($puser_inc_re) {
                                $puser_bill['uid'] = $oneuser['userid'];
                                $puser_bill['jl_class'] = 1; //佣金类型
                                $puser_bill['info'] = '直推抢单成功佣金';
                                $puser_bill['addtime'] = time();
                                $puser_bill['jc_class'] = '+';
                                $puser_bill['num'] = $oneyj_money;
                                M('somebill')->add($puser_bill);
                            }

                            $twouser = M('user')->where(array('userid' => $oneuser['pid']))->find();//上二代

                            if (!empty($twouser)) {

                                $twoyj_money = $yj_money * $clist['team_twoyj']; //二代佣金
                                $twouser_inc_re = M('user')->where(array('userid' => $oneuser['pid']))->setInc('money', $twoyj_money);
                                if ($twouser_inc_re) {
                                    $twouser_bill['uid'] = $twouser['userid'];
                                    $twouser_bill['jl_class'] = 1; //佣金类型
                                    $twouser_bill['info'] = '二代抢单成功佣金';
                                    $twouser_bill['addtime'] = time();
                                    $twouser_bill['jc_class'] = '+';
                                    $twouser_bill['num'] = $twoyj_money;
                                    M('somebill')->add($twouser_bill);
                                }

                                $threeuser = M('user')->where(array('userid' => $twouser['pid']))->find();//上三代
                                if (!empty($threeuser)) {
                                    $threeyj_money = $yj_money * $clist['team_threeyj']; //三代佣金
                                    $threeuser_inc_re = M('user')->where(array('userid' => $twouser['pid']))->setInc('money', $threeyj_money);

                                    if ($threeuser_inc_re) {
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


                        /*********************这里添加打款成功短信提示***********************/
                        $m->commit();
                        $this->success('支付成功', U('Roborder/robsucc'));
                        exit;

                    } else {
                        $this->error('支付失败', U('Roborder/robsucc'));
                        exit;
                    }


                }
                $m->rollback();
            } else {
                $this->error('支付失败', U('Roborder/robsucc'));
                exit;
            }


        } else {
            $this->error('支付失败', U('Roborder/robsucc'));
            exit;
        }


    }

//收款二给码管理
    public function skewm()
    {

        if ($_FILES && $_POST) {

            if (!empty($_FILES['wxewm']['name'])) {
                $file = setUpload($_FILES['wxewm']);
                $data['wxewm'] = $file['savepath'] . $file['savename'];
            }

            if (!empty($_FILES['zfbewm']['name'])) {
                $file = setUpload($_FILES['zfbewm']);
                $data['zfbewm'] = $file['savepath'] . $file['savename'];
            }
            if (!empty($_FILES['bankewm']['name'])) {
                $file = setUpload($_FILES['bankewm']);
                $data['bankewm'] = $file['savepath'] . $file['savename'];
            }

            $re = M('skm')->where(array('id' => 1))->save($data);

            if ($re) {
                $this->success('修改成功');
                exit;
            } else {
                $this->error('修改失败');
                exit;
            }


        } else {

            $skmlist = M('skm')->where(array('id' => 1))->find();
            $this->assign('skmlist', $skmlist);
            $this->display();
        }

    }

    public function skyhk()
    {
        if ($_POST) {
            $data['cz_yh'] = trim(I('post.cz_yh'));
            $data['cz_xm'] = trim(I('post.cz_xm'));
            $data['cz_kh'] = trim(I('post.cz_kh'));
            $result = M('system')->where(array('id' => 1))->save($data);
            if ($result) {
                $this->success('修改成功');
                exit;
            } else {
                $this->error('修改失败');
                exit;
            }
        } else {
            $skmlist = M('system')->where(array('id' => 1))->find();
            $this->assign('skmlist', $skmlist);
            $this->display();
        }
    }


}
