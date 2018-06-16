<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		require '../web_connection.php';
        if(isset($_POST['type_filter']) && isset($_POST['operation_date'])){
			$type_filter = $_POST['type_filter'];
			$operation_date = $_POST['operation_date'];
			get_ubications($type_filter, $operation_date);
		}
	}

	function get_ubications($type_filter, $operation_date){
        global $connect;
        $query = "";

        if($type_filter == 0){
            $query = "SELECT os.id, os.cc, os.name, os.type_office, osu.Latitude, osu.Longitude, sto.type, ssoo.open_operation, ssoo.close_operation, ssoo.status, CASE WHEN ssoo.status = 1 THEN 'Abierto' ELSE 'Cerrado' END As status_name
						FROM sys_structure_offices os 
						JOIN sys_structure_ubications osu on osu.id_office = os.id 
						JOIN sys_structure_operation_offices ssoo on ssoo.id_office = os.id
						JOIN sys_structure_types  sto on sto.id = os.type_office where os.enabled = 1 and operation_date = '$operation_date'";
        }else{
            $query = "SELECT os.id, os.cc, os.name, os.type_office, osu.Latitude, osu.Longitude, sto.type, ssoo.open_operation, ssoo.close_operation, ssoo.status, CASE WHEN ssoo.status = 1 THEN 'Abierto' ELSE 'Cerrado' END As status_name
						FROM sys_structure_offices os 
						JOIN sys_structure_ubications osu on osu.id_office = os.id 
						JOIN sys_structure_types  sto on sto.id = os.type_office
						JOIN sys_structure_operation_offices ssoo on ssoo.id_office = os.id
						where os.type_office = '$type_filter' and os.enabled = 1 and operation_date = '$operation_date'";
        }
		$result = mysqli_query($connect, $query);
		$json_result = array();

		if($result){
			$json_data = array();
			while($row = mysqli_fetch_assoc($result)){
				$json_data[] = array_map('utf8_encode', $row);
			}
			$json_result['result'] = true;
			$json_result['message'] = 'Success';
			$json_result['data'] = $json_data;
		}else{
			$json_result['result'] = false;
			$json_result['message'] = 'Error';
			$json_result['data'] = array();
		}

		header('Content-type: application/json; charset=utf.8');
		//$json['result'][] = $json_result;
		echo json_encode($json_result, JSON_PRETTY_PRINT);

		//mysqli_free_result($result);

		mysqli_close($connect);
	}
?>