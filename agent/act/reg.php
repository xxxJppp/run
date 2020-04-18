<?php 


$token = $_SESSION['token'] =
md5(substr('abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
rand(0,2),rand(2,10)));



?>