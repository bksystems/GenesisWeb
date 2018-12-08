<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        require '../web_connection.php';
        get_next_costo_center();
    }

    function get_next_costo_center(){
        global $connect;
        $query = "SELECT MAX(SUBSTR(cost_center,2)) + 1 as 'next' FROM `tbl_sys_organizations_structures`";
        
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
            //logs_controller(1,'succes', 'get employees', 'employees', 'read employees', 'se obtubieron los empleados', 'empty');
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
