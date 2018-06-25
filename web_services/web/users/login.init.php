<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		require '../web_connection.php';
		if(isset($_GET['user_username'])){
			$user_username = $_GET['user_username'];
			$user_password = $_GET['user_password'];
			user_login_validate($user_username, $user_password);
		}
	}
	function user_login_validate($user_username, $user_password){
		global $connect;
		$query_user_validate = "SELECT * FROM sys_tb_users WHERE user_name = '$user_username' AND user_password = '$user_password' ";
		$result_user_validate = mysqli_query($connect, $query_user_validate);
		$json_result = array();
		$user_array = array();
		$employee_array = array();
		$employee_id = 0;
		if(mysqli_num_rows($result_user_validate) > 0){
			while($row_user = mysqli_fetch_assoc($result_user_validate)){
				$user_array['id'] = $row_user['id'];
				$user_array['user_name'] = $row_user['user_name'];
				$user_array['user_status'] = $row_user['user_status_id'];
				$employee_id = $row_user['employee_id'];
			}
			if($user_array['user_status'] == 1 && $employee_id > 0){
				$query_employee = "SELECT * FROM sys_tb_employees WHERE id = '$employee_id' ";
				$result_employee = mysqli_query($connect, $query_employee);
				while($row = mysqli_fetch_assoc($result_employee)){
					$employee_array = array_map('utf8_encode', $row);
				}
				$user_array['user_employee'] = $employee_array;
			}
		}
		header('Content-type: application/json; charset=utf.8');
		$json_result['data'] = $user_array;
		echo json_encode($json_result, JSON_PRETTY_PRINT);
		mysqli_close($connect);
	}
?>

