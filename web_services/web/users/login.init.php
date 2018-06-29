<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		require '../web_connection.php';
		require '../global_functions.php';
		if(isset($_POST['user_username']) && isset($_POST['user_password'])){
			$user_username = $_POST['user_username'];
			$user_password = $_POST['user_password'];
			user_login_validate($user_username, $user_password);
		}
	}

	function user_login_validate($user_username, $user_password){
		global $connect;
		$json_result = array();
		
		$query_user_validate = "SELECT * FROM sys_tb_users WHERE user_name = '$user_username' AND user_password = '$user_password' ";
		$result_user_validate = mysqli_query($connect, $query_user_validate);
		if(mysqli_num_rows($result_user_validate) > 0){
			$array_data_result = array();
			$employee_id = 0;
			$user_rol_id = 0;
			while($row_user = mysqli_fetch_assoc($result_user_validate)){
				$user_rol_id = $row_user['rol_id'];
				$employee_id = $row_user['employee_id'];
				$array_data_result['id'] = $row_user['id'];
				$array_data_result['user_name'] = $row_user['user_name'];
				$array_data_result['user_status'] = $row_user['user_status_id'];
			}
			if($array_data_result['user_status'] == 1 && $employee_id > 0){
				$employee_array = array();
				$query_employee = "SELECT * FROM sys_tb_employees WHERE id = '$employee_id' ";
				$result_employee = mysqli_query($connect, $query_employee);
				while($row = mysqli_fetch_assoc($result_employee)){
					$employee_array = array_map('utf8_encode', $row);
				}

				$array_data_result['user_employee'] = $employee_array;

				if($user_rol_id > 0){
					$user_rol = array();
					$query_get_rol = "SELECT * FROM `sys_tb_rols` WHERE ID = '$user_rol_id';";
					$result_get_role = mysqli_query($connect, $query_get_rol);
					while($row_rol = mysqli_fetch_assoc($result_get_role)){
						$user_rol = array_map('utf8_encode', $row_rol);
					}
					$array_data_result['rol'] = $user_rol;
					$user_permission = array();
				    $query_get_permisions = "SELECT
									rp.rol_id as 'rol_id'
									, tp.controller
									, rp.is_index
									, rp.is_add
									, rp.is_edit
									, rp.is_delete
									FROM sys_tb_rols_permissions rp INNER JOIN sys_tb_permissions tp ON tp.id = rp.permission_id 
								WHERE rp.rol_id = '$user_rol_id';";
					$result_get_permissions = mysqli_query($connect, $query_get_permisions);
					if(mysqli_num_rows($result_get_permissions) > 0){
						while($row_permission = mysqli_fetch_assoc($result_get_permissions)){
							$user_permission[] = array_map('utf8_encode', $row_permission);
						}
						$array_data_result['user_permissions'] = $user_permission;

						$end_date_tocken = date('Y-m-d', strtotime(getDateTimeNow() . ' + 2 days'));
						$user_id = $array_data_result['id'];
						$tocken = getToken($user_id);
						$admission_date = getDateTimeNow();

						if (mysqli_query($connect, "INSERT INTO sys_tb_sessions (user_id, admission_date, tocken, finish_tocken) VALUES ('$user_id', '$admission_date', '$tocken', '$end_date_tocken')")) {

							$querySession = "select * from sys_tb_sessions where tocken like '$tocken' and user_id = '$user_id';";
							$resulSession = mysqli_query($connect, $querySession);
							$jsonSession = array();
							if(mysqli_num_rows($resulSession) > 0){
								while($rowSession = mysqli_fetch_assoc($resulSession)){
									$jsonSession = array_map('utf8_encode', $rowSession);	
								}
								$array_data_result['session_result'] = $jsonSession;

								$json_result['data'] = 'correct';
								$json_result['result'] = true;
								$json_result['error'] = '';
								$json_result['message'] = 'success';

								session_start();
								$_SESSION['session'] = $jsonSession;
								$_SESSION['employee'] = $employee_array;
								$_SESSION['permissions'] = $user_permission;
								$_SESSION['state'] = true;

							}else{
								$json_result['data'] = null;
								$json_result['result'] = false;
								$json_result['error'] = 'error session';
								$json_result['message'] = 'No se pudo generar la session para el usuario';
							}
						}else{
							$json_result['data'] = $array_data_result;
							$json_result['result'] = true;
							$json_result['error'] = '';
							$json_result['message'] = 'success';
						}

					}else{
						$json_result['data'] = null;
						$json_result['result'] = false;
						$json_result['error'] = 'user not permission';
						$json_result['message'] = 'Usuario no cuenta con permisos asignados';
					}
				}else{
					$json_result['data'] = null;
					$json_result['result'] = false;
					$json_result['error'] = 'user not rol';
					$json_result['message'] = 'Usuario no cuenta con permisos asignados';
				}

			}else{
				$json_result['data'] = null;
				$json_result['result'] = false;
				$json_result['error'] = 'user disabled';
				$json_result['message'] = 'Usuario desabilitado o sin asignar';
			}
		}else{
			$json_result['data'] = null;
			$json_result['result'] = false;
			$json_result['error'] = 'user error login';
			$json_result['message'] = 'Usuario y/o contraseña incorrecta';
		}
		
		header('Content-type: application/json; charset=utf.8');
		echo json_encode($json_result, JSON_PRETTY_PRINT);
		mysqli_close($connect);
	}
?>

