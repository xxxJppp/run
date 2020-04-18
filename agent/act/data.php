<?php 
  
  $where = ' zt = 1';

  $arr = $mysql->select_all('fafa_renwu','*', $where ." order by id desc ");


 
  echo   json_encode($arr); //转换为json数据输出 


?>