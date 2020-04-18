<?php
function is_weixin_visit()
{
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        return true;
    } else {
        return false;
    }
}
function is_QQ_visit()
{
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'QQ') !== false) {
        return true;
    } else {
        return false;
    }
}
 
 
if(is_weixin_visit()){
	header('Location: 2.php');
exit;
}else if(is_QQ_visit()){
  	header('Location: qq');
exit;
  }else{
		header('Location:  2.php');
exit;
}
?>