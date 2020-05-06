<?php

namespace Sever\Controller;

use Think\Controller;

class TimingController extends Controller
{

    private $ip = array('127.0.0.1');

    public function _initialize()
    {
        $ip = get_client_ip();
        if (!in_array($ip, $this->ip)) {
            //echo send_http_status(404);
        }
    }

    public function sendNotify()
    {
        $shanghu = M('roborder')->field('shanghu_name,price,ordernum,status,notify_url')
            ->where(array('notify_status' => 0, 'shanghu_name' => array('neq', ''), 'notify_url' => array('neq', ''), 'fail_num' => array('lt', 10)))
            ->select();

        if (!$shanghu) {
            return;
        }
        foreach ($shanghu as $v) {

            $shanghuxx = M('merchant')->field('names,key')->where(array('names' => $v['shanghu_name']))->find();//完成
            $ret = array();
            $ret['m'] = $v['price'];
            $ret['order'] = $v['ordernum'];
            $ret['sh'] = $shanghuxx['names'];
            $ret['key'] = $shanghuxx['key'];
            $ret['md5key'] = $this->getSignature($ret);
            $ret['status'] = $v['status'];
            $curl = self::sendCurl($v['notify_url'], $ret);
            $json_curl = json_decode($curl, true);
            if ($json_curl && $json_curl['error'] && $json_curl['error'] == 3) {
                M('roborder')->where(array('ordernum' => $v['ordernum']))->save(array('notify_status' => 1));
            } else {
                M('roborder')->where('ordernum', $v['ordernum'])->setInc('notify_status');
            }
        }
    }

//订单超时
    public function timeoutOrder()
    {
        $model = M();
        $model->startTrans();
        $listss = M('roborder')->where(array('status' => 2, 'price' => array('neq', 0), 'uid' => 21))->select();
        $system = M('system')->where(array('id' => 1))->find();
        foreach ($listss as $k => $v) {
            $a = $v['pipeitime'];
            $sheng = time() - $a;
            if ($sheng > $system['lose_time']) {
                if ($v['uid'] != 0) {
                    $data = array('uid' => $v['uid'], 'money' => $v['price'], 'addtime' => time(), 'ppid' => $v['id']);
                    $lit = M('dj')->where(array('ppid' => $v['id']))->find();
                    if (empty($lit)) {
                        $dj = M('dj')->add($data);
                    }
                    $order_status = M('roborder')->where(array('id' => $v['id']))->save(array('status' => 4));
                    if ($system['order_num'] > 0) {
                        $user = M('userrob')->where(array('uid' => $v['uid']))->order('addtime desc')->limit($system['order_num'])->select();
                        $i = 0;
                        foreach ($user as $it) {
                            if ($it['status'] == 4) {
                                $i += 1;
                            }
                        }
                        if ($i == $system['order_num']) {
                            M('user')->where(array('userid' => $v['uid']))->save(array('order_status' => 0));
                        }
                    }
                    $user_status = M('userrob')->where(array('uid' => $v['uid'], 'ppid' => $v['id']))->save(array('status' => 4));
                }
            }
        }
        $model->commit();

    }

    //释放冻结金额
    public function releaseBlockedAmount()
    {
        $model = M();
        $model->startTrans();
        $system = M('system')->where(array('id' => 1))->find();
        /*$user_order_dj = M('dj')->select();
        foreach ($user_order_dj as $val) {
            $time = time() - $val['addtime'];
            if ($time > $system['back_money_time']) {
                M('user')->where(array('userid' => $val['uid']))->setInc('money', $val['money']);
                M('dj')->where(array('id' => $val['id']))->delete();
                M('ewm')->where(array('id' => $val['idewm']))->save(array('zt1' => 0));
                $li = M('userrob')->where(array('uid' => $val['uid'], 'ppid' => $val['id'], 'status' => 4))->select();
                print_r($li);
                M('userrob')->where(array('uid' => $val['uid'], 'ppid' => $val['id'], 'status' => 4))->delete();
            }
        }*/
        $model->commit();
    }

    private static function sendCurl($url, $requestString, $timeout = 5)
    {
        if ($url == '' || $requestString == '' || $timeout <= 0) {
            return false;
        }
        $con = curl_init((string)$url);
        curl_setopt($con, CURLOPT_HEADER, false);
        curl_setopt($con, CURLOPT_POST, true);
        curl_setopt($con, CURLOPT_POSTFIELDS, $requestString);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($con, CURLOPT_TIMEOUT, (int)$timeout);
        return curl_exec($con);
    }

    private static function getSignature($params, $secret = 'GoCkn^*poqLyhp5hY(4<|qBR6.55[X$g')
    {
        $str = '';  //待签名字符串
        //先将参数以其参数名的字典序升序进行排序
        ksort($params);
        //遍历排序后的参数数组中的每一个key/value对
        foreach ($params as $k => $v) {
            //为key/value对生成一个key=value格式的字符串，并拼接到待签名字符串后面
            $str .= "$k=$v";
        }
        //将签名密钥拼接到签名字符串最后面
        $str .= $secret;
        //通过md5算法为签名字符串生成一个md5签名，该签名就是我们要追加的sign参数值
        return md5($str);
    }

}
