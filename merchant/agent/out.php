<?php 

define('ACC', TRUE);

include('../sys/init.php');


unset($_SESSION['agent_id']);
unset($_SESSION['agent_name']);
unset($_SESSION['agent_zhanghu']);

header("location: index.php");

?>