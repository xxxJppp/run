<?php

namespace Sever\Controller;

use Think\Controller;

class TimingController extends Controller
{

    private $ip = array('127.0.0.1');
    public function _initialize()
    {
        $ip = get_client_ip();
        if(!in_array($ip,$this->ip)){
            //echo send_http_status(404);
        }
    }

    public function sendNotify()
    {
        $shanghu = M('roborder')->field('shanghu_name,price,ordernum,status,notify_url')
            ->where(array('notify_status' => 0,'shanghu_name'=>array('neq',''),'notify_url'=>array('neq',''),'fail_num'=>array('lt',10)))
            ->select();

        if(!$shanghu){
            return;
        }
        foreach ($shanghu as $v){

            $shanghuxx = M('agent')->field('names,key')->where(array('names' => $v['shanghu_name']))->find();//完成
            $ret = array();
            $ret['m'] = $v['price'];
            $ret['order'] = $v['ordernum'];
            $ret['md5key'] =  md5(md5($v['ordernum'] . $v['price'] . $shanghuxx['names']) . $shanghuxx['key']);
            $ret['status'] = $v['status'];
            $curl = self::sendCurl($v['notify_url'],$ret);
            $json_curl = json_decode($curl,true);
            if($json_curl && $json_curl['error'] && $json_curl['error'] == 3){
                M('roborder')->where(array('ordernum'=>$v['ordernum']))->save(array('notify_status'=>1));
            }else{
                M('roborder')->where('ordernum',$v['ordernum'])->setInc('notify_status');
            }
        }
    }

    public function timeoutOrder(){
//        pipeitime

    }


    private static function sendCurl($url,$requestString,$timeout = 5){
        if($url == '' || $requestString == '' || $timeout <=0){
            return false;
        }
        $con = curl_init((string)$url);
        curl_setopt($con, CURLOPT_HEADER, false);
        curl_setopt($con, CURLOPT_POST,true);
        curl_setopt($con, CURLOPT_POSTFIELDS, $requestString);
        curl_setopt($con, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($con, CURLOPT_TIMEOUT,(int)$timeout);
        return curl_exec($con);
    }

}
