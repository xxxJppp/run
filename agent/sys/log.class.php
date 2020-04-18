<?php
defined('ACC')||exit('ACC Denied');
class Log {

    const LOGFILE = 'curr.log'; 


    public static function write($cont) {
        $cont .= "\r\n";

        $log = self::isBak(); 
        
        $fh = fopen($log,'ab');
        fwrite($fh,$cont);
        fclose($fh); 
    }


    public static function bak() {
     

        $log = ROOT . 'data/log/' . self::LOGFILE;
        $bak = ROOT . 'data/log/' . date('ymd') . mt_rand(10000,99999) . '.bak';
        return rename($log,$bak);
    }

 
    public static function isBak() {
        $log = ROOT . 'data/log/' . self::LOGFILE;
        
        if(!file_exists($log)) { 
            touch($log);    
            return $log;
        }

 
        clearstatcache(true,$log);
        $size = filesize($log);
        if($size <= 1024 * 1024) { 
            return $log;
        }
        
  
        if(!self::Bak()) {
            return $log;
        } else {
            touch($log);
            return $log;
        }
    }
}




