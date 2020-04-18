<?php 


defined('ACC')||exit('ACC Denied');

class ActTool {

      public static  function  Go($act,$tpl,$acc='ACC'){
             include($_SERVER['DOCUMENT_ROOT'].'/sys/init.php');   
      	     include($_SERVER['DOCUMENT_ROOT'].'/act/'.$act.'.php');
      	     include($_SERVER['DOCUMENT_ROOT'].'/templates/'.$tpl.'.html');
      }

}



?>