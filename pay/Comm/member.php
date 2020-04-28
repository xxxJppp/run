<?php 


function is_login($act){

	if ($act != 'login' && $act != 'reg' && $act != 'logins' && $act != 'regs') {
		
		if ($_SESSION['h_name'] == ''  || $_SESSION['h_id'] == '') {
			
			return false;
		}

		return true;

	}  else {

		return true;
	}
}

?>