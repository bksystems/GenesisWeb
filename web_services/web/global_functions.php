<?php
	function getDateTimeNow(){
		return date("Y-m-d H:i:s");
	}

	function getToken($id){
		return bin2hex(random_bytes(7)) . '_' . $id;
	}
?>
