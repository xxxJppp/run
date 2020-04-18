<?php
defined('ACC')||exit('ACC Denied');

header("Content-type: text/html; charset=utf-8"); 

define('ROOT',str_replace('\\','/',dirname(dirname(__FILE__))) . '/');

date_default_timezone_set('PRC');

define("ROOT_PATH",'http://'.$_SERVER['HTTP_HOST'].'/');

//define('DEBUG',true);

define('PATH','http://'.$_SERVER['SERVER_NAME'].'/');
define('__A_TPL__','http://'.$_SERVER['SERVER_NAME'].'/admin/');
define('__A_CSS__','http://'.$_SERVER['SERVER_NAME'].'/admin/public/css/');
define('__A_JS__','http://'.$_SERVER['SERVER_NAME'].'/admin/public/js/');
define('__A_IMG__','http://'.$_SERVER['SERVER_NAME'].'/admin/public/images/');


require(ROOT . 'sys/lib_base.php');

require(ROOT . 'Comm/fun.php');

require(ROOT . 'Comm/member.php');


function __autoload($class) {
	
    if(strtolower(substr($class,-5)) == 'model') {

        require(ROOT . 'Model/' . $class . '.class.php');

    } else if(strtolower(substr($class,-4)) == 'tool') {

        require(ROOT . 'tool/' . $class . '.class.php');

    } else if(strtolower(substr($class,-3)) == 'sys') {

        require(ROOT . 'zijinpan/' . $class . '.class.php');

    } else{

       require(ROOT . 'sys/' . $class . '.class.php');
    }  
}

$_GET = _addslashes($_GET);

$_POST = _addslashes($_POST);

$_COOKIE = _addslashes($_COOKIE);
 
session_start();

if(defined('DEBUG')) {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

$mysql = mysql::getIns();
if(count($_GET)>0)
{
  
    $_SESSION['HTTP_REFERER']=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:"";
    function CheckURL()
    {
        
        if($_SESSION['HTTP_REFERER']=="")
        {
            
           // exit;
        }
    }
    //CheckURL();
}

if (isset($_SESSION['h_id'])  && $_SESSION['h_id'] > 0) {
   
   $us_info = $mysql->select('fafa_member','*','id='.$_SESSION['h_id']);
}


?>