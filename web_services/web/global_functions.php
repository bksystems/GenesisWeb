<?php
	function getDateTimeNow(){
		return date("Y-m-d H:i:s");
	}

	function getToken($id){
		return bin2hex(random_bytes(7)) . '_' . $id;
	}

	function logs_controller($user_id_log, $type_log, $event_log, $function_log, $action_log,  $description_details_log, $access_type_log){
		require '../web_connection.php';
		$event_now = getDateTimeNow();
		$query_log_insert = "INSERT INTO `sys_tb_logs`(`user_id`, `type_log`, `event_log`, `function_log`, `action_log`, `description_details_log`, `access_type_log`, `created`) VALUES ('$user_id_log', '$type_log', '$event_log', '$function_log', '$action_log', '$description_details_log', '$access_type_log', '$event_now');";
		if (mysqli_query($connect, $query_log_insert)){
			
		}
	}
?>
