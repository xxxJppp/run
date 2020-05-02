<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends CommonController
{

    public function index()
    {
        $userid = session('userid');
        M()->startTrans();
        $ulist = M('user')->where(array('userid' => $userid))->find();
        $dj = M('dj')->where(array('uid' => $userid))->select();
        //echo M('dj')->getLastSql();  exit;
        $clist = M('system')->where(array('id' => 1))->find();
        $slist = M('skm')->where(array('id' => 1))->find();
        $imgkf = '/Uploads/payimg/' . $slist['bankewm'];
        $this->assign('imgkf', $imgkf);
        if ($ulist['money'] > 0) {
            $max_pipeinone = $ulist['money'] * ($clist['qd_cf'] / 100) - $clist['ed'];
        } else {
            $max_pipeinone = 0;
        }
        if (!empty($dj)) {

            foreach ($dj as $k => $v) {

                if (($v['addtime'] + (5 * 60)) < time()) {
                    $uss['money'] = $ulist['money'] + $v['money'];
                    M('user')->where(array('userid' => $userid))->save($uss);//完成
                    M('dj')->where(array('id' => $v['id']))->delete();
                    $p['status'] = 4;
                    M('userrob')->where(array('ppid' => $v['ppid']))->save($p);//完成


                    $dfdfas = M('userrob')->where(array('ppid' => $v['ppid']))->find();//完成
                    $ewmzt1['zt1'] = 0;
                    //$ewmzt1['gengxintime']=time() ;
                    M('ewm')->where(array('id' => $dfdfas['idewm']))->save($ewmzt1);

                }
            }
        }
        $nlist = M('news')->where(array('sort' => 0))->order('id desc')->limit(5)->select();
        $slist = M('userrob')->where(array('uid' => $userid, 'status' => 2))->order('id desc')->select();
        $this->assign('slist', $slist);
        $this->assign('list', $nlist);
        $this->assign('max_pipeinone', $max_pipeinone);
        $this->assign('ulist', $ulist);
        $this->assign('clist', $clist);
        $this->display();
    }


    public function loading()
    {
        $userid = session('userid');
        $data = M('userrob')->where(array('uid' => $userid, 'status' => 2))->order('id desc')->select();
        foreach ($data as $k => $v) {


            if ($v['class'] == 1) {
                $data[$k]['t'] = '微信';
            }
            if ($v['class'] == 2) {
                $data[$k]['t'] = '支付宝';
            }
            if ($v['class'] == 3) {
                $data[$k]['t'] = '银行卡';
            }
            $data[$k]['add'] = date('Y-m-d H:i:s', $v['addtime']);


        }


        $this->ajaxReturn($data);
        exit;

    }


    public function shouquanjc()
    {
        $_var_1 = $_SERVER['HTTP_HOST'];
        if ($_var_1 <> "www.ceshi.bendi") {
            if ($_var_1 <> "localhost") {
                if ($_var_1 <> "127.0.0.1") {
                    preg_match('/[\\w][\\w-]*\\.(?:com\\.cn|com|cn|co|net|org|gov|cc|biz|info|wang|xyz|xin|site|shop|ltd|top|win|online|tech|club|cc|ren|vip|lol|help|date|me|pw|group|link|red|ink|pro|biz|mobi|kim|name|tv)(\\/|$)/isU', $_var_1, $_var_2);
                    $_var_3 = rtrim($_var_2[0], '/');
                    if ($_var_1 == $_var_3) {
                        $_var_1 = "www." . $_var_3;
                    }

                    $_var_4 = array('cailiaofanabcscbvv', $_var_1);
                    sort($_var_4, SORT_STRING);
                    $_var_5 = strtoupper(substr(sha1(implode($_var_4)), 4, 32));
                    $list = M('system')->where(array('id' => 1))->find();
                    if ($list['qd_sq'] != $_var_5) {
                        return false;
                        //return true;
                    }
                }
            }
        }
        return true;
    }


    public function shouquan($fdf)
    {
//$_var_1= trim($_SERVER['HTTP_HOST']);
        //$_var_11 =trim($_SERVER['SERVER_NAME']);

        $_var_1 = $fdf;
        preg_match('/[\\w][\\w-]*\\.(?:com\\.cn|com|cn|co|net|org|gov|cc|biz|info|wang|xyz|xin|site|shop|ltd|top|win|online|tech|club|cc|ren|vip|lol|help|date|me|pw|group|link|red|ink|pro|biz|mobi|kim|name|tv)(\\/|$)/isU', $_var_1, $_var_2);
        $_var_3 = rtrim($_var_2[0], '/');
        if ($_var_1 == $_var_3) {
            $_var_1 = "www." . $_var_3;
        }

        $_var_4 = array('cailiaofanabcscbvv', $_var_1);
        sort($_var_4, SORT_STRING);
        $_var_5 = strtoupper(substr(sha1(implode($_var_4)), 4, 32));

        return $_var_5;
    }


    public function substr_cut($user_name)
    {
        $strlen = mb_strlen($user_name, 'utf-8');
        $firstStr = mb_substr($user_name, 0, 2, 'utf-8');
        $lastStr = mb_substr($user_name, -2, 2, 'utf-8');
        return $strlen == 2 ? mb_substr($user_name, 0, 1, 'utf-8') . str_repeat('*', mb_strlen($user_name, 'utf-8') - 1) : $firstStr . "**" . $lastStr;
    }

    public function ts()
    {
        if ($_GET) {
            $id = trim(I('get.id'));
            $olist = M('userrob')->where(array('id' => $id))->find();
            $this->assign('olist', $olist);
            $this->display();
        }

    }

    public function qrs()
    {
        if ($_GET) {
            $Model = M();
            $Model->startTrans();
            $userid = session('userid');
            $id = trim(I('get.id'));
            $ulist = M('user')->where(array('userid' => $userid))->find();

            $olist = M('userrob')->where(array('id' => $id,'uid'=>$userid))->find();

            //$ewmlist = M('ewm')->where(array('uid' => $userid, 'ewm_price' => $olist['price'], 'ewm_class' => $olist['class'], 'zt' => 1))->find();

            if ($olist['status'] != 2) {
                $this->error('订单超时联系管理员', U('Index/shoudan'));
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
            $ret = array();
            $ret['url'] = $shanghu['notify_url'];
            $ret['price'] = $shanghu['price'];
            $ret['time'] = $shanghu['ordernum'];
            $ret['md5key'] =  md5(md5($shanghu['ordernum'] . $shanghu['price'] . $shanghuxx['names']) . $shanghuxx['key']);
            $ret['status'] = $shanghu['status'];

            $this->success(json_encode($ret), U('Index/index'),true);
        }


    }

    public function zidong()
    {
        $userid = session('userid');
        $ulist = M('user')->where(array('userid' => $userid))->find();
        if($ulist['order_status']==0){
            $data['status'] = 0;
            $data['msg'] = '订单连续超时次数太多，暂时无法抢单';
            $this->ajaxReturn($data);
            exit;
        }
        if ($ulist['zdopention'] == 0) {
            $data['status'] = 0;
            $data['msg'] = '没有开启自动抢单';
            $this->ajaxReturn($data);
            exit;

        }
        $user_order = M('roborder')->where(array('uid'=>$userid))->order('pipeitime desc')->select();
        $tm = time()-30;
        if($user_order && $user_order[0]['pipeitime']>$tm){
            $data['status'] = 0;
            $data['msg'] = '抢单时间间隔不能少于30S';
            $this->ajaxReturn($data);
            exit;
        }
        $clist = M('system')->where(array('id' => 1))->find();
        if ($ulist['money'] > 0) {
            $max_pipeinone = $ulist['money'] * ($clist['qd_cf'] / 100) - $clist['ed'];
        } else {
            $max_pipeinone = 0;
        }
        $money = $max_pipeinone;
        /****需要添加一个未完成订单限制*******/
        $where3['zduid'] = $userid;
        $where3['price'] = array('lt', $money);
        $where3['status'] = 1;
        $orderlist = M('roborder')->where($where3)->order('id asc')->select();
        if (!$orderlist) {
            $where['zduid'] = array('exp', 'is null');
            $where['price'] = array('lt', $money);
            $where['status'] = 1;
            $orderlist = M('roborder')->where($where)->order('id asc')->select();
        }
        //echo M('roborder')->getLastSql();
//print_r($orderlist);exit;
        ///////////////////////////////////////////////////////////////////////
        $daymax = M('userrob')->where(array('uid' => $userid))->count();
        if ($daymax && $daymax >= $ulist['num']) {
            $data['status'] = 0;
            $data['msg'] = '您每天最多抢单' . $ulist['num'] . '次';
            $this->ajaxReturn($data);
            exit;
        }
        // $id = trim(I('post.id'));
        // $qdclass = trim(I('post.qdclass'));

        if ($clist['ed'] >= $money) {
            $data['status'] = 0;
            $data['msg'] = '预留额度不足';
            $this->ajaxReturn($data);
            exit;
        }
        if ($ulist['rz_st'] != 1) {
            $data['status'] = 0;
            $data['msg'] = '请先完善资料';
            $this->ajaxReturn($data);
            exit;
        }
        if ($ulist['tx_status'] != 1) {
            $data['status'] = 0;
            $data['msg'] = '您的账号被管理员禁止抢单';
            $this->ajaxReturn($data);
            exit;
        }

        if ($max_pipeinone < $clist['qd_minmoney']) {
            $data['status'] = 0;
            $data['msg'] = '小于最小抢单金额';
            $this->ajaxReturn($data);
            exit;
        }

        /****需要添加一个未完成订单限制*******/
        $where['status'] = array('not in', '3,4');
        $where['uid'] = $userid;
        $no_count = M('userrob')->where($where)->count();
        if ($no_count) {
            $data['status'] = 0;
            $data['msg'] = '您有一条匹配订单未完成';
            //$this->ajaxReturn($data);exit;
            //return false;
        }

        /*********这里需要区分直接匹配成功，和后台没有发布订单时的排队匹配两种情况********/

        if (!empty($orderlist)) {//后台有符合条件的待匹配订单，生成一条直接匹配好的记录。
            foreach ($orderlist as $k => $v) {
                $dtime = time();
                $sk = $dtime - $clist['jdtime'] * 60;
                $where11['uid'] = $userid;
                $where11['ewm_class'] = $v['class'];
                $where11['zt'] = 1;
                $where11['zt1'] = 0;
                $where11['jdtime'] = array('elt', $sk);
                $where11['audit_status'] = 1;
                $where11['uid'] = $userid;
                $ewm = M('ewm')->where($where11)->select();
                foreach ($ewm as $val) {
                    $where11 = array();
                    if ($val['city'] == $v['city']) {

                        $where11['id'] = $val['id'];
                        break;
                    } elseif ($val['province'] == $v['province']) {
                        $where11['id'] = $val['id'];
                        break;
                    } else {
                        $where11['id'] = $val['id'];
                        break;
                    }
                }
                $where11['uid'] = $userid;

                $keyongppewm = M('ewm')->where($where11)->find();
                //
                $qdclass = $v['class'];

                if ($keyongppewm) {
                    $model = M();
                    $model->startTrans();
                    $psave['uid'] = $userid;
                    $psave['uname'] = $ulist['username'];
                    $psave['umoney'] = $ulist['money'];
                    $psave['pipeitime'] = time();
                    $psave['status'] = 2;
                    $id = $v['id'];
                    $psave['idewm'] = $keyongppewm['id'];
                    $pipei_re = M('roborder')->where(array('id' => $id))->save($psave);


                    $ewmzt1['zt1'] = 1;
                    $ewmzt1['jdtime'] = time();
                    $ewm_status = M('ewm')->where(array('id' => $keyongppewm['id']))->save($ewmzt1);


                    $updata['idewm'] = $keyongppewm['id'];

                    $updata['uid'] = $userid;
                    $updata['class'] = $qdclass;
                    $updata['price'] = $v['price'];
                    $updata['yjjc'] = $clist['qd_yjjc'];
                    $updata['umoney'] = $ulist['money'];
                    $updata['uaccount'] = $ulist['account'];
                    $updata['uname'] = $ulist['username'];
                    $updata['ppid'] = $id;
                    $updata['status'] = 2;
                    $updata['addtime'] = time();
                    $updata['pipeitime'] = time();
                    $updata['ordernum'] = getordernum();
                    $updata['pay_sn'] = $v['ordernum'];;
                    $updata['pay_money'] = $v['price'];

                    /****************************************************************/
                    //$dj = M('dj')->where(array('uid'=>$userid))->find();

                    $dj['addtime'] = time();
                    $dj['uid'] = $userid;
                    $dj['money'] = $v['price'];
                    $dj['ppid'] = $id;
                    $dj_status = M('dj')->add($dj);

                    $uss['money'] = $ulist['money'] - $v['price'];

                    $user_status = M('user')->where(array('userid' => $userid))->save($uss);//完成
                    /*****************************************************************/

                    $up_re = M('userrob')->add($updata);
                    if ($up_re && $pipei_re && $ewm_status && $user_status && $dj_status) {
                        $model->commit();
                        $data['status'] = 1;
                        $data['msg'] = '自动匹配成功';
                        $this->ajaxReturn($data);
                        exit;
                    } else {
                        $model->rollback();
                        $data['status'] = 0;
                        $data['msg'] = '未知错误';
                        $this->ajaxReturn($data);
                        exit;
                    }

                } else {
                    $data['status'] = 0;
                    $data['msg'] = '没有满足条件的二维码！';
                    $this->ajaxReturn($data);
                    exit;
                }
            }

        }

        ////////////////////////////////////////////////////////////////////////
    }

    public function qdgame169()
    {


        $wz = trim(I('get.sq'));
        //$wz = $this->_get('sq', 'trim');
        if ($wz <> "") {
            $shouquan = $this->shouquan($wz);
            echo $shouquan;
            die;
        }
    }

    public function news()
    {
        $wz = trim(I('get.id'));
        $newinfo = M('news')->where(array('id' => $wz))->find();
        $this->assign('newinfo', $newinfo);
        $this->display();
    }

    public function qdgame()
    {


        $wz = trim(I('get.sq'));
        //$wz = $this->_get('sq', 'trim');
        if ($wz <> "") {
            $shouquan = $this->shouquan($wz);
            $this->assign('sq', $shouquan);
        }
        $userid = session('userid');
        $ulist = M('user')->where(array('userid' => $userid))->find();
        $dj = M('dj')->where(array('uid' => $userid))->select();
        //echo M('dj')->getLastSql();  exit;
        $clist = M('system')->where(array('id' => 1))->find();
        if ($ulist['money'] > 0) {
            $max_pipeinone = $ulist['money'] * ($clist['qd_cf'] / 100);
        } else {
            $max_pipeinone = 0;
        }


        if (!empty($dj)) {

            foreach ($dj as $k => $v) {

                if (($v['addtime'] + (5 * 60)) < time()) {
                    $uss['money'] = $ulist['money'] + $v['money'];
                    M('user')->where(array('userid' => $userid))->save($uss);//完成
                    M('dj')->where(array('id' => $v['id']))->delete();
                    $p['status'] = 4;
                    M('userrob')->where(array('ppid' => $v['ppid']))->save($p);//完成

                    $dfdfas = M('userrob')->where(array('ppid' => $v['ppid']))->find();//完成
                    $ewmzt1['zt1'] = 0;
                    //$ewmzt1['gengxintime']=time() ;
                    M('ewm')->where(array('id' => $dfdfas['idewm']))->save($ewmzt1);
                }
            }


        }

        $newinfo = M('news')->order('id desc')->limit(3)->select();
        $this->assign('newinfo', $newinfo);

        $tarr = explode(',', $clist['qd_ndtime']);

        /******只能手动后台更改了*****/
        $clist = M('system')->where(array('id' => 1))->find();
        $this->assign('clist', $clist);
        $this->assign('tarr', $tarr);
        $this->assign('qd_nd', $clist['qd_nd']);
        $this->assign('qd_yjjc', $clist['qd_yjjc']);

        $this->assign('max_pipeinone', $max_pipeinone);
        $this->assign('ulist', $ulist);
        $this->display();
    }

    public function tscl()
    {
        if ($_POST) {
            $tszt = I('post.ewmclass');
            $tspic = trim(I('post.icon'));
            $tsnum = trim(I('post.ordernum'));
            $slist = M('userrob')->where(array('ordernum' => $tsnum))->find();
            if (!$slist) {
                $data['status'] = 0;
                $data['message'] = '订单不存在！';
                $this->ajaxReturn($data);
                exit;
            } elseif (!$tspic) {
                $data['status'] = 0;
                $data['message'] = '请上传投诉凭证！';
                $this->ajaxReturn($data);
                exit;
            } elseif ($slist['ts'] > 0) {
                $data['status'] = 0;
                $data['message'] = '该订单已经投诉过了！';
                $data['url'] = '/Index/shoudan';
                $this->ajaxReturn($data);
                exit;
            } else {
                $psave['ts'] = $tszt;
                $psave['tspic'] = $tspic;
                M('userrob')->where(array('ordernum' => $tsnum))->save($psave);
                M('dj')->where(array('ppid' => $slist['ppid']))->delete();////不会自动返保证金
                $data['status'] = 1;
                $data['message'] = '投诉成功！';
                $data['url'] = '/Index/shoudan';
                $this->ajaxReturn($data);
                exit;
            }

        }
    }

    public function shoudan()
    {
        $userid = session('userid');
        $slist = M('userrob')->where(array('uid' => $userid, 'status' => 2))->order('id desc')->select();
        $flist = M('userrob')->where(array('uid' => $userid, 'status' => 3))->order('id desc')->select();
        $dlist = M('userrob')->where(array('uid' => $userid, 'status' => 4))->order('id desc')->select();
        $this->assign('slist', $slist);
        $this->assign('flist', $flist);
        $this->assign('dlist', $dlist);


        $this->display();
    }

    //会员抢单详请
    public function qiangdanxq()
    {
        if ($_GET) {

            $userid = session('userid');
            $ulist = M('user')->where(array('userid' => $userid))->find();
            $id = trim(I('get.id'));
            $olist = M('userrob')->where(array('id' => $id))->find();
            //$ewmlist = M('ewm')->where(array('uid'=>$userid,'ewm_class'=>$olist['class'],'zt'=>1))->find();
            $ewmlist = M('ewm')->where(array('id' => $olist['idewm']))->find();
            $this->assign('olist', $olist);
            $this->assign('ewmlist', $ewmlist);
            $this->display();

        } else {
            $this->error('未知错误', U('Index/shoudan'));
        }

    }

    public function qdoption()
    {

        if (1) {
            $uid = session('userid');
            $ulist = M('user')->where(array('userid' => $uid))->find();


            if ($ulist['zdopention'] == 1) {
                $sava['zdopention'] = 0;
                $msgs = '自动抢单已关闭';
                $msg = '启用自动抢单';
                $zr = 0;
            } else {
                $msg = '停止自动抢单';
                $msgs = '自动抢单已开启';
                $sava['zdopention'] = 1;
                $zr = 1;
            }


            $re = M('user')->where(array('userid' => $uid))->save($sava);
            if ($re) {
                $data['status'] = 1;
                $data['msg'] = $msg;
                $data['msgs'] = $msgs;
                $data['zr'] = $zr;
                $this->ajaxReturn($data);
                exit;
            } else {
                $data['status'] = 0;
                $data['msg'] = '设置失败';
                $this->ajaxReturn($data);
                exit;
            }

        }


    }

    //生成抢单订单(此处代码是二维码带有金额的时候可以打开使用)
    public function pipeiorder()
    {
        if ($_POST) {
            exit;
            $qdclass = trim(I('post.qdclass'));

            $qdclass2 = trim(I('post.qdclass2'));


            $userid = session('userid');
            $ulist = M('user')->where(array('userid' => $userid))->find();
            $clist = M('system')->where(array('id' => 1))->find();
            if ($ulist['rz_st'] != 1) {
                $data['status'] = 0;
                $data['msg'] = '请先完善资料';
                $this->ajaxReturn($data);
                exit;
            }
            if ($ulist['tx_status'] != 1) {
                $data['status'] = 0;
                $data['msg'] = '您的账号被管理员禁止抢单';
                $this->ajaxReturn($data);
                exit;
            }
            if ($ulist['money'] > 0) {
                $max_pipeinone = $ulist['money'] * ($clist['qd_cf'] / 100);
            } else {
                $max_pipeinone = 0;
            }

            if ($max_pipeinone < $clist['qd_minmoney']) {
                $data['status'] = 0;
                $data['msg'] = '最低抢单额度为' . $clist['qd_minmoney'];
                $this->ajaxReturn($data);
                exit;
            }

            /****需要添加一个未完成订单限制*******/
            $where['status'] = array('not in', '3,4');
            $where['uid'] = $userid;
            $no_count = M('userrob')->where($where)->count();
            if ($no_count) {
                $data['status'] = 0;
                $data['msg'] = '您有一条匹配订单未完成';
                $this->ajaxReturn($data);
                exit;
            }
            /********************/

            $count_qrnum = M('ewm')->where(array('uid' => $userid, 'ewm_class' => $qdclass, 'zt' => 1, 'audit_status' => 1))->count();

            if ($qdclass == 1) {
                $str = '微信收款二维码';
            } elseif ($qdclass == 2) {
                $str = '支付宝收款二维码';
            } elseif ($qdclass == 3) {
                $str = '商家码';
            }
            if ($qdclass2 == 1) {
                $str = '微信收款二维码';
            } elseif ($qdclass2 == 2) {
                $str = '支付宝收款二维码';
            } elseif ($qdclass2 == 3) {
                $str = '商家码';
            }

            if ($count_qrnum < 1) {
                $data['status'] = 0;
                $data['msg'] = '您没有上传' . $str . '或者全部停用，请至少开启一个';
                $this->ajaxReturn($data);
                exit;
            }


            /*********这里需要区分直接匹配成功，和后台没有发布订单时的排队匹配两种情况********/
            $orderlist = M('roborder')->where(array('class' => $qdclass, 'status' => 1))->order('price asc')->select();

            if (!empty($orderlist)) {//后台有符合条件的待匹配订单，生成一条直接匹配好的记录。
                //符合条件的最小额度的记录为$orderlist[0],所以直接匹配最小的这一条，如果最小金额的都不够匹配，同样也生成一条匹配记录，提示等待(不采用)
                //这里写业务
                //循环匹配收款二维类型及金额都符合则匹配成功
                $ewmlist = M('ewm')->where(array('uid' => $userid, 'ewm_class' => $qdclass, 'zt' => 1, 'audit_status' => 1))->select();
                foreach ($orderlist as $k => $v) {
                    foreach ($ewmlist as $val) {
                        if ($v['price'] == $val['ewm_price']) {
                            $st = 1;
                            $pid = $v['id'];
                            break;
                        }
                    }
                }
                if ($st == '' || $st == 0) {
                    $pipeist = 0;
                } elseif ($st == 1) {
                    $pipeist = 1;
                }

                if ($pipeist == 1) {//匹配成功更新后台发布的订单/生成一条匹配成功的会员匹配记录  同时减去会员账号余额，且加上佣金'qd_yjjc' 生成日录(确认后做这些操作)


                    $tolist = M('roborder')->where(array('id' => $pid))->find();//被匹配的这一条记录

                    if ($tolist['status'] == 1) {

                        $psave['uid'] = $userid;
                        $psave['uname'] = $ulist['truename'];
                        $psave['umoney'] = $ulist['money'];
                        $psave['pipeitime'] = time();
                        $psave['status'] = 2;

                        $pipei_re = M('roborder')->where(array('id' => $pid))->save($psave);

                        if ($pipei_re) {

                            $updata['uid'] = $userid;
                            $updata['class'] = $qdclass;
                            $updata['price'] = $tolist['price'] == '' ? 1000 : $tolist['price'];
                            $updata['yjjc'] = $clist['qd_yjjc'];
                            $updata['umoney'] = $ulist['money'];
                            $updata['uaccount'] = $ulist['account'];
                            $updata['uname'] = $ulist['truename'];
                            $updata['ppid'] = $pid;
                            $updata['status'] = 2;
                            $updata['class2'] = $qdclass2;
                            $updata['addtime'] = time();
                            $updata['pipeitime'] = time();
                            $updata['ordernum'] = getordernum();

                            $up_re = M('userrob')->add($updata);
                            if ($up_re) {
                                $data['status'] = 1;
                                $data['msg'] = '匹配成功';
                                $this->ajaxReturn($data);
                                exit;
                            } else {
                                $data['status'] = 0;
                                $data['msg'] = '未知错误';
                                $this->ajaxReturn($data);
                                exit;
                            }
                        } else {
                            $data['status'] = 0;
                            $data['msg'] = '未知错误';
                            $this->ajaxReturn($data);
                            exit;
                        }
                    } else {

                        $updata['uid'] = $userid;
                        $updata['class'] = $qdclass;
                        $updata['price'] = '10000';
                        $updata['yjjc'] = '';
                        $updata['umoney'] = $ulist['money'];
                        $updata['uaccount'] = $ulist['account'];
                        $updata['uname'] = $ulist['truename'];
                        $updata['ppid'] = '';
                        $updata['status'] = 1;
                        $updata['addtime'] = time();

                        $updata['ordernum'] = getordernum();
                        $up_re = M('userrob')->add($updata);

                        if ($up_re) {

                            $data['status'] = 1;
                            $data['msg'] = '已生成订单等待自动匹配';
                            $this->ajaxReturn($data);
                            exit;
                        } else {

                            $data['status'] = 0;
                            $data['msg'] = '未知错误';
                            $this->ajaxReturn($data);
                            exit;
                        }

                    }


                } else {


                    $erm = M('ewm')->where(array('uid' => $userid, 'zt' => 1, 'ewm_price' => array('elt', $max_pipeinone)))->order('ewm_price asc')->select();
                    if (!$erm) {
                        $data['status'] = 0;
                        $data['msg'] = '抢单额度不足';
                        //$this->ajaxReturn($data);exit;
                    }

                    $updata['uid'] = $userid;
                    $updata['class'] = $qdclass;
                    $updata['price'] = '10000';
                    $updata['yjjc'] = '';
                    $updata['umoney'] = $ulist['money'];
                    $updata['uaccount'] = $ulist['account'];
                    $updata['uname'] = $ulist['truename'];
                    $updata['ppid'] = '';
                    $updata['status'] = 1;
                    $updata['addtime'] = time();
                    $updata['ordernum'] = getordernum();
                    $up_re = M('userrob')->add($updata);

                    if ($up_re) {

                        $data['status'] = 1;
                        $data['msg'] = '已生成订单等待自动匹配';
                        $this->ajaxReturn($data);
                        exit;
                    } else {

                        $data['status'] = 0;
                        $data['msg'] = '未知错误';
                        $this->ajaxReturn($data);
                        exit;
                    }
                }


            } else {//后台没有符合条件的单则生成一条记录，提示等待

                $updata['uid'] = $userid;
                $updata['class'] = $qdclass;
                $updata['price'] = 10000;
                $updata['yjjc'] = '';
                $updata['umoney'] = $ulist['money'];
                $updata['uaccount'] = $ulist['account'];
                $updata['uname'] = $ulist['truename'];
                $updata['ppid'] = '';
                $updata['status'] = 1;
                $updata['addtime'] = time();
                $updata['ordernum'] = getordernum();
                $up_re = M('userrob')->add($updata);

                if ($up_re) {

                    $data['status'] = 1;
                    $data['msg'] = '已生成订单等待自动匹配';
                    $this->ajaxReturn($data);
                    exit;
                } else {

                    $data['status'] = 0;
                    $data['msg'] = '未知错误';
                    $this->ajaxReturn($data);
                    exit;
                }

            }

        } else {
            $data['status'] = 0;
            $data['msg'] = '非法操作';
            $this->ajaxReturn($data);
            exit;

        }


    }

    public function jygc()
    {
        $userid = session('userid');
        $data = M('userrob')->where(array('uid' => $userid, 'status' => 2))->order('id desc')->select();

        foreach ($data as $k => $v) {


            if ($v['class'] == 1) {
                $data[$k]['t'] = '微信';
            }
            if ($v['class'] == 2) {
                $data[$k]['t'] = '支付宝';
            }
            if ($v['class'] == 3) {
                $data[$k]['t'] = '银联';
            }
            $data[$k]['add'] = date('Y-m-d H:i:s', $v['pipeitime']);

            $data[$k]['ztai'] = getstatus($v['status']);
            $data[$k]['url'] = "/Index/qiangdan/xq/id/" . $v['id'] . ".html";
        }


        $this->ajaxReturn($data);
        exit;
    }

    public function sds()
    {
        $userid = session('userid');
        $data = M('roborder')->where(array('status' => 1, 'zduid' => $userid))->order(' id desc')->select();
        if (!$data) {
            $data = M('roborder')->where(array('status' => 1))->order(' id desc')->select();
        }


        foreach ($data as $k => $v) {


            if ($v['class'] == 1) {
                $data[$k]['t'] = '微信';
            }
            if ($v['class'] == 2) {
                $data[$k]['t'] = '支付宝';
            }
            if ($v['class'] == 3) {
                $data[$k]['t'] = '银联';
            }
            $data[$k]['add'] = date('H:i:s', $v['addtime']);


        }


        $this->ajaxReturn($data);
        exit;
    }


    public function pipeiauto()
    {
        if ($_POST) {
            $data['status'] = 0;
            $data['msg'] = '抢单业务繁忙！';
            $this->ajaxReturn($data);
            exit;
        } else {
            $data['status'] = 0;
            $data['msg'] = '非法操作';
            $this->ajaxReturn($data);
            exit;
        }
    }


    public function sdq()
    {
        if ($_POST) {

            $id = trim(I('post.id'));
            $qdclass = trim(I('post.qdclass'));
            $userid = session('userid');
            $ulist = M('user')->where(array('userid' => $userid))->find();
            if($ulist['order_status']==0){
                $data['status'] = 0;
                $data['msg'] = '订单连续超时次数太多，暂时无法抢单';
                $this->ajaxReturn($data);
                exit;
            }
            $user_order = M('roborder')->where(array('uid'=>$userid))->order('pipeitime desc')->select();
            $tm = time()-30;
            if($user_order && $user_order[0]['pipeitime']>$tm){
                $data['status'] = 0;
                $data['msg'] = '抢单时间间隔不能少于30S';
                $this->ajaxReturn($data);
                exit;
            }
            $clist = M('system')->where(array('id' => 1))->find();
            if ($ulist['rz_st'] != 1) {
                $data['status'] = 0;
                $data['msg'] = '请先完善资料';
                $this->ajaxReturn($data);
                exit;
            }
            if ($ulist['tx_status'] != 1) {
                $data['status'] = 0;
                $data['msg'] = '您的账号被管理员禁止抢单';
                $this->ajaxReturn($data);
                exit;
            }
            if ($ulist['money'] > 0) {
                $max_pipeinone = $ulist['money'] * $clist['qd_cf'] * 0.01 - $clist['ed'];
            } else {
                $max_pipeinone = 0;
            }
            $daymax = M('userrob')->where(array('uid' => $userid))->count();
            if ($daymax >= $ulist['num'] && $daymax) {
                $data['status'] = 0;
                $data['msg'] = '您每天最多抢单' . $ulist['num'] . '次';
                $this->ajaxReturn($data);
                exit;
            }
            if ($max_pipeinone < $clist['qd_minmoney']) {
                $data['status'] = 0;
                $data['msg'] = '最低抢单额度为' . $clist['qd_minmoney'];
                $this->ajaxReturn($data);
                exit;
            }

            /****需要添加一个未完成订单限制*******/
            $where['status'] = array('not in', '3,4');
            $where['uid'] = $userid;
            $no_count = M('userrob')->where($where)->count();
            if ($no_count) {
                $data['status'] = 0;
                $data['msg'] = '您有一条匹配订单未完成';
                //$this->ajaxReturn($data);exit;
            }
            /********************/

            $count_qrnum = M('ewm')->where(array('uid' => $userid, 'ewm_class' => $qdclass, 'zt' => 1, 'audit_status' => 1))->count();


            if ($qdclass == 1) {

                $str = '微信收款二维码';
            } elseif ($qdclass == 2) {

                $str = '支付宝收款二维码';

            } elseif ($qdclass == 3) {

                $str = '商家码';
            }

            if ($count_qrnum < 1) {
                $data['status'] = 0;
                $data['msg'] = '您没有上传' . $str . '    或者全部停用了，请开启至少一个';
                $this->ajaxReturn($data);
                exit;
            }

            $dtime = time();
            $sk = $dtime - $clist['jdtime'] * 60;
            $where1['uid'] = $userid;
            $where1['ewm_class'] = $qdclass;
            $where1['zt'] = array('eq', 1);
            $where1['zt1'] = array('eq', 0);
            $where1['jdtime'] = array('elt', $sk);
            $where1['audit_status'] = 1;
            $count_qrnumww = M('ewm')->where($where1)->count();

            if ($count_qrnumww < 1) {
                $data['status'] = 0;
                $data['msg'] = '您开启的' . $str . '都处于收款/待审核状态，或者间隔收款时间不满足！';
                $this->ajaxReturn($data);
                exit;
            }

            /*********这里需要区分直接匹配成功，和后台没有发布订单时的排队匹配两种情况********/
            $tolist = M('roborder')->where(array('id' => $id))->find();
            $ewm = M('ewm')->where($where1)->select();
            foreach ($ewm as $val) {
                if ($val['city'] == $tolist['city']) {
                    $where11['id'] = $val['id'];
                    break;
                } elseif ($val['province'] == $tolist['province']) {
                    $where11['id'] = $val['id'];
                    break;
                } else {
                    $where11['id'] = $val['id'];
                    break;
                }
            }
            $where11['uid'] = $userid;
            $keyongppewm = M('ewm')->where($where11)->find();
            if ($tolist['price'] > $max_pipeinone) {
                $data['status'] = 0;
                $data['msg'] = '您最高抢单额度为' . $max_pipeinone;
                $this->ajaxReturn($data);
                exit;
            }

            if (!empty($tolist)) {//后台有符合条件的待匹配订单，生成一条直接匹配好的记录。
                //符合条件的最小额度的记录为$orderlist[0],所以直接匹配最小的这一条，如果最小金额的都不够匹配，同样也生成一条匹配记录，提示等待(不采用)
                //这里写业务
                //循环匹配收款二维类型及金额都符合则匹配成功

                if ($tolist['zduid'] && $tolist['zduid'] <> $userid) {
                    $data['status'] = 0;
                    $data['msg'] = '该订单为指定单';
                    $this->ajaxReturn($data);
                    exit;
                }
                $model = M();
                $model->startTrans();
                if ($tolist['status'] == 1) {

                    $psave['uid'] = $userid;
                    $psave['uname'] = $ulist['username'];
                    $psave['umoney'] = $ulist['money'];
                    $psave['pipeitime'] = time();
                    $psave['status'] = 2;
                    $psave['idewm'] = $keyongppewm['id'];

                    $pipei_re = M('roborder')->where(array('id' => $id))->save($psave);


                    $ewmzt1['zt1'] = 1;
                    $ewmzt1['jdtime'] = time();
                    $ewm_status = M('ewm')->where(array('id' => $keyongppewm['id'], 'uid' => $userid))->save($ewmzt1);


                    $updata['idewm'] = $keyongppewm['id'];
                    $updata['uid'] = $userid;
                    $updata['class'] = $qdclass;
                    $updata['price'] = $tolist['price'];
                    $updata['yjjc'] = $clist['qd_yjjc'];
                    $updata['umoney'] = $ulist['money'];
                    $updata['uaccount'] = $ulist['account'];
                    $updata['uname'] = $ulist['username'];
                    $updata['ppid'] = $id;
                    $updata['status'] = 2;
                    $updata['addtime'] = time();
                    $updata['pipeitime'] = time();
                    $updata['ordernum'] = getordernum();
                    $updata['pay_sn'] = $tolist['ordernum'];
                    $updata['pay_money'] = $tolist['price'];

                    /****************************************************************/
                    //$dj = M('dj')->where(array('uid'=>$userid))->find();

                    /****************************************************************/

                    $dj['addtime'] = time();
                    $dj['uid'] = $userid;
                    $dj['money'] = $tolist['price'];
                    $dj['ppid'] = $id;
                    $dj_result = M('dj')->add($dj);

                    $uss['money'] = $ulist['money'] - $tolist['price'];

                    $user_price = M('user')->where(array('userid' => $userid))->save($uss);//完成
                    $up_re = M('userrob')->add($updata);

                    if ($pipei_re && $ewm_status && $dj_result && $user_price && $up_re) {
                        $model->commit();
                        $data['status'] = 1;
                        $data['msg'] = '抢单成功..';
                        $this->ajaxReturn($data);
                        exit;
                    } else {
                        $model->rollback();
                        $data['status'] = 0;
                        $data['msg'] = '未知错误1';
                        $this->ajaxReturn($data);
                        exit;
                    }

                }


            }

        } else {
            $data['status'] = 0;
            $data['msg'] = '非法操作';
            $this->ajaxReturn($data);
            exit;

        }


    }


}