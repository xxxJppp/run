<?php 

$web_set = $mysql->select('z_webset','*','id=1');
foreach($web_set as $k => $v){


	 define(strtoupper($k),$web_set[$k]);
}

?>