<?php
   

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        require '../web_connection.php';
        require '../global_functions.php';
        get_shelter_letters();
    }

    function get_shelter_letters(){
        global $connect;
        $query = "SELECT 
                        dir.direction
                    , sub.subdirection
                    , reg.region
                    , ofi.name
                    , sl.number
                    , CONCAT(sl.first_last_name, ' - ', sl.second_last_name, ', ', sl.names) as 'employee_name'
                    , sl.position
                    , CASE WHEN sl.status = 1 THEN 'Activo' ELSE 'Inactivo' END as status_employee
                    , CASE WHEN sl.require_shelter = 1 THEN 'SI' ELSE 'NO' END as require_shelter
                    , slf.path_file AS path_file
                    , CASE WHEN slf.path_file is null THEN 'Sin Carta' ELSE 'Con Carta' END as status_shelter
                FROM sys_tb_shelter_letters_employees sl 
                LEFT JOIN sys_tb_shelter_letters_employees_files slf ON slf.employee_id = sl.id
                INNER JOIN sys_structure_offices ofi ON ofi.id = sl.id_os
                INNER JOIN sys_structure_regions reg ON reg.id = ofi.region_id
                INNER JOIN sys_structure_subdirections sub ON sub.id = reg.subdirection_id
                INNER JOIN sys_structure_directions dir ON dir.id = sub.direction_id";
        
        $result_data = mysqli_query($connect, $query);

        $json_request = array();

		if($result_data){
            $json_result_data = array();
			while($row = mysqli_fetch_assoc($result_data)){
				$json_result_data[] = array_map('utf8_encode', $row);
            }
            $json_request['result'] = true;
            $json_request['message'] = 'Success';
            $json_request['data'] = $json_result_data;
            logs_controller(1,'succes', 'get shelter employees', 'employees', 'read shelter employees', 'se consultaron los registros de las cartas', 'empty');
        }else{
			$json_request['result'] = false;
			$json_request['message'] = 'Error';
			$json_request['data'] = array();
		}

		header('Content-type: application/json; charset=utf.8');

		echo json_encode($json_request, JSON_PRETTY_PRINT);

        mysqli_close($connect);
        
    }

?>