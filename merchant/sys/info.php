<?php
define('HOME_CSS_PATH', 'http://'.$_SERVER['SERVER_NAME'].'/public');
define('HOME_JS_PATH', 'http://'.$_SERVER['SERVER_NAME'].'/public');
define('URL', 'http://'.$_SERVER['SERVER_NAME'].'/');
define('HOME_IMG_PATH', 'http://'.$_SERVER['SERVER_NAME'].'/public/images/');

$web = $mysql->select('webset','logo,name,miaoshu,banquan,keyword,tel,miao,e');
$hn =  $mysql->select_all('home_nav','*',' weizhi='."'头部'" .' order by lev desc limit 6');
$dn =  $mysql->select_all('home_nav','*',' weizhi='."'底部'" .' order by lev desc limit 7');
$ji  = $mysql->select('jineng','*','usid='.$_SESSION['id']);
?>