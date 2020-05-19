<?php
include 'config.php';

$mysqli = new Mysqli( DB_HOST, DB_USER, DB_PWD, DB_NAME);


$start_time = time() - 300;


$result = $mysqli->query( " delete from  xh_client_paofen_automatic_orders   where status = 2 and creation_time < $start_time" );


echo '删除成功';