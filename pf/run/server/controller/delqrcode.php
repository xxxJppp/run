<?php
namespace xh\run\server\controller;
use xh\library\request;
use xh\library\mysql;
use xh\unity\cog;
use xh\library\functions;
use xh\unity\sms;
use xh\unity\encrypt;
use xh\unity\callbacks;
use xh\library\url;



//支付宝-全自动版-服务端
class delqrcode{
    
    private $mysql;
    
    public function __construct(){
        $this->mysql = new mysql();
    }
    
    public function del(){
  

       $path="/www/wwwroot/".DOMAINS_URL."/run/upload/view/qrcode/";
    	if(is_dir($path)){
    		//扫描一个文件夹内的所有文件夹和文件并返回数组
    		$p = scandir($path);

    		foreach($p as $val){
    			//排除目录中的.和..
    			if($val !="." && $val !=".."){
    				//如果是目录则递归子目录，继续操作
    				if(is_dir($path.$val)){
    					//子目录中操作删除文件夹和文件
    					$this->delqrcode($path.$val.'/');
    					//目录清空后删除空文件夹
    					@rmdir($path.$val.'/');
    				}else{
    					//如果是文件直接删除
    					unlink($path.$val);
    				}
    			}
    		}
    	}
    echo '删除成功';
    }


    /**%E5%BC%80%E5%8F%91%E8%80%85%EF%BC%9AMardan%20QQ:3823903%20%E4%BA%92%E7%AB%99%E5%BA%97%E9%93%BA%20%EF%BC%9Ahttps://www.huzhan.com/ishop8502/%20%20%20%E7%81%AB%E5%B1%B1%E7%BD%91%E7%BB%9C%E7%A7%91%E6%8A%80*/
   
    
}
