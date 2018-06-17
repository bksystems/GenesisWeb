<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		require '../web_connection.php';
		get_structure();
	
	}

	function get_structure(){
		global $connect;
        $query = "SELECT dir.id as id_direction, dir.direction
                         , sub.id as id_subdirection, sub.subdirection
                         , reg.id as id_region, reg.region
                         , ofi.id as id_office, ofi.name as office
                         , sst.type
                    FROM sys_structure_directions dir 
                        JOIN sys_structure_subdirections sub on sub.direction_id = dir.id 
                        JOIN sys_structure_regions reg on sub.id = reg.subdirection_id
                        JOIN sys_structure_offices ofi on reg.id = ofi.region_id
                        JOIN sys_structure_types sst on ofi.type_office = sst.id";
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
