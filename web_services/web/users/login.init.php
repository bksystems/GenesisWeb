<?php
	require '../../connection.php';
	global $connect;
	if(isset($_POST['username']) 
		&& isset($_POST['password']) 
		&& isset($_POST['access_type']) 
		&& isset($_POST['access_system']) 
		&& isset($_POST['ip_address']) 
		&& isset($_POST['serial_number']) 
		&& isset($_POST['imei']) 
		&& isset($_POST['sim_card_number'])){

		$username = $_POST['username'];
		$password = $_POST['password'];
		$access_type = $_POST['access_type'];
		$access_system = $_POST['access_system'];
		$ip_address = $_POST['ip_address'];
		$serial_number = $_POST['serial_number'];
		$imei = $_POST['imei'];
		$sim_card_number = $_POST['sim_card_number'];

		$query = "select * from users where username = '$username' and password like '$password' and status_user_id = 1";
		$result = mysqli_query($connect, $query);
		$jsonRequest = array();
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				$jsonData[] = array_map('utf8_encode', $row);

				$user_id = $row['id'];
				$employee_id = $row['employee_id'];
				$rolid = $row['rol_id'];
				//Generar informacion del tocken
				$tocken = getToken($user_id);
				$dt = new DateTime();
				$admission_date = $dt->format('Y-m-d H:i:s');
				$finish_tocken = getDateValidateToken($admission_date);
				
				//$queryDevices = "SELECT * FROM type_devices WHERE user_id = '$user_id' and serie = '$serial_number' and is_active = 1";

				if (mysqli_query($connect, "INSERT INTO sessions (user_id, admission_date, access_type, access_system, ip_address, serial_number, imei, sim_card_number, tocken, finish_tocken) VALUES ('$user_id', '$admission_date', '$access_type', '$access_system', '$ip_address', '$serial_number', '$imei', '$sim_card_number', '$tocken', '$finish_tocken')")) {

					$querySession = "select * from sessions where tocken like '$tocken'";
					$resulSession = mysqli_query($connect, $querySession);
					$jsonSession = array();
					if(mysqli_num_rows($resulSession) > 0){
						while($rowSession = mysqli_fetch_assoc($resulSession)){
							$jsonSession[] = array_map('utf8_encode', $rowSession);
							
						}
					}
					$queryEmployee = "select * from employees where id = '$employee_id'";
					$resultEmployee = mysqli_query($connect, $queryEmployee);
					$jsonEmploye = array();
					if(mysqli_num_rows($resultEmployee) > 0){
						while ($rowEmployee = mysqli_fetch_assoc($resultEmployee)) {
							$jsonEmploye[] = array_map('utf8_encode', $rowEmployee);
						}
					}

					$queryRolsPermissions = "SELECT 
						permissions.id as id
					    , permissions.controller
					    , permissions.permission
					    , rols_permissions.is_index
					    , rols_permissions.is_add
					    , rols_permissions.is_edit
					    , rols_permissions.is_delete 
					 FROM rols_permissions JOIN permissions on permissions.id = rols_permissions.permission_id 
					 WHERE rols_permissions.rol_id = '$rolid'";
					 $resultRolsPermission = mysqli_query($connect, $queryRolsPermissions);
					 $jsonRolsPermissions = array();
					 if(mysqli_num_rows($resultRolsPermission) > 0){
					 	while ($rowsRolsPermissions = mysqli_fetch_assoc($resultRolsPermission)) {
					 		$jsonRolsPermissions[] = array_map('utf8_encode', $rowsRolsPermissions);
					 	}
					 } 

					if($access_type == 'web'){
						session_start();
    					$_SESSION['user'] = $jsonData;
    					$_SESSION['session'] = $jsonData;
    					$_SESSION['employee'] = $jsonEmploye;
    					$_SESSION['permissions'] = $jsonRolsPermissions;
    					$_SESSION['state'] = 'Autenticado';
    				}
					$jsonRequest['success'] = true;
					$jsonRequest['message'] = 'success user';
					$jsonRequest['user'] = $jsonData;
					$jsonRequest['session'] = $jsonSession;
					$jsonRequest['permissions'] = $jsonRolsPermissions;
				}
				
				
			}
		}else{
			$jsonRequest['success'] = false;
			$jsonRequest['message'] = 'user not exist';
			$jsonRequest['user'] = null;
			$jsonRequest['session'] = null;
		}

		header('Content-type: application/json; charset=utf.8');
		$jsonResult['data'][] = $jsonRequest;
		echo json_encode($jsonResult, JSON_PRETTY_PRINT);
		mysqli_free_result($result);
		mysqli_close($connect);
    }
    
?>