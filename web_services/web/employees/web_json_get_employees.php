<?php
   

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        require '../web_connection.php';
        get_employees();
    }

    function get_employees(){
        global $connect;
        $query = "SELECT
                                        emp.id
                                        , emp.roster
                                        , emp.first_lastname
                                        , emp.second_lastname
                                        , emp.names
                                        , emp.email
                                        , demp.department
                                        , pemp.position
                                        , semp.status
                                        , CONCAT(bemp.first_lastname, ' - ', bemp.second_lastname, ', ', bemp.names) AS 'boss'
                                    FROM sys_tb_employees emp 
                                    INNER JOIN sys_tb_status_employees semp ON emp.status_employee_id = semp.id
                                    INNER JOIN sys_tb_departments demp ON demp.id = emp.department_id
                                    INNER JOIN sys_tb_position_employees pemp ON emp.position_employee_id = pemp.id
                                    INNER JOIN sys_tb_employees bemp ON emp.employee_id = bemp.id";
        
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
        }else{
			$json_request['result'] = false;
			$json_request['message'] = 'Error';
			$json_request['data'] = array();
		}

		header('Content-type: application/json; charset=utf.8');
		//$json['result'][] = $json_result;
		echo json_encode($json_request, JSON_PRETTY_PRINT);

		//mysqli_free_result($result);

		mysqli_close($connect);

       


    }

?>