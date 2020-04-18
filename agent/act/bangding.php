<?php 



if ($us_info['zname']!='') {
	
	echo json_encode(array('zt'=>1,'n'=>$us_info['zname'],'z'=>$us_info['znum']));
}


?>