<?php 


$up = new Uptool();

$root = $up->up('file');

echo json_encode(array('root'=>$root));


?>