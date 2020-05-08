<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;

require_once __DIR__.'/../../vendor/Connection.php';
//require_once __DIR__.'/../../vendor/workerman/MYSQL/src/Connection.php';
/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{

    public static $db = null;

    public static function onWorkerStart($worker)
    {
        //self::$db = new \Workerman\MySQL\Connection('127.0.0.1', '3306', '数据库用户名', '数据库密码', '数据库名');
    }
    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     *
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {

        // Gateway::sendToAll(json_encode(array('account'=>$client_id,'cmd'=>'login')));
       Gateway::sendToClient($client_id,json_encode(array('account'=>$client_id,'cmd'=>'login')));

    }

    /**
     * 当客户端发来消息时触发
     * @param int $client_id 连接id
     * @param mixed $message 具体消息
     */
    public static function onMessage($client_id, $message)
    {
      
        file_put_contents('./req22.txt', "【".date('Y-m-d H:i:s')."】\r\n".$message."\r\n\r\n",FILE_APPEND);
        $data = json_decode($message,true);
        if($data['type']=="login"){
           // Gateway::sendToClient($client_id,$message);
           if($data['params']['alipay_id']){
                Gateway::bindUid($client_id,$data['params']['alipay_id']);
           }elseif($data['deveice']){
                file_put_contents('./req.txt', "【".date('Y-m-d H:i:s')."】\r\n".$message."\r\n\r\n",FILE_APPEND);
                Gateway::bindUid($client_id,$data['deveice']);
           }elseif($data['account']){
              Gateway::bindUid($client_id,$data['account']);
           }elseif($data['client_id']){
              Gateway::bindUid($client_id,$data['client_id']);
           }else{
              Gateway::bindUid($client_id,$data['uid']);
              Gateway::sendToClient($client_id,'{"status":"ok"}');
           }
 
        }
        
        
      
        switch ($data['cmd']){
            //如果来路类型是支付申请，将根据该支付申请涉及到的用户 直接返回
            case 'req':
             Gateway::sendToUid($data['account'],$message);
             file_put_contents('./req.txt', "【".date('Y-m-d H:i:s')."】\r\n".$message."\r\n\r\n",FILE_APPEND);
                break;
            case 'hd':
            // Gateway::sendToAll($message);
              $orderid=$data['remark'];
              $row_count = self::$db->update('pay_order')->cols(array('qrurl'=>$data['payUrl']))->where("id = '$orderid'")->query();
                break;
            case 'login':
                Gateway::sendToClient($client_id,$message);
                Gateway::bindUid($client_id,$data['account']);
                file_put_contents('./bind.txt', "【".date('Y-m-d H:i:s')."】\r\n".$client_id."|".$data['params']['alipay_id']."\r\n\r\n",FILE_APPEND);

                break;
            case 'Taobao':
                $notify="http://120.79.231.25/bank/tb11.php";
                if($data['code']==8){
                  $param=$data;
                  ksort($param);
                  $md5str = "";
                  foreach ($param as $key => $val) {
                      $md5str = $md5str . $key . "=" . $val . "&";
                  }
                  $param['sign'] = strtoupper(md5($md5str . "key=cfepay123456"));
                  $url = $notify."?".http_build_query($param);
                  file_get_contents($url);
                }
                
                break;


            case 'pong':
                return;
                break;

            case 'ping':
                return;
                break;



        }
    }



    /**
     * 当用户断开连接时触发
     * @param int $client_id 连接id
     */
    public static function onClose($client_id)
    {
        // 向所有人发送
        // GateWay::sendToAll("$client_id logout\r\n");
    }
}
