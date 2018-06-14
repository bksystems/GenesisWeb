<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		require '../web_connection.php';
		if(isset($_POST['year']) && isset($_POST['direction_id'])){
            $year = $_POST['year'];
            $direction_id = $_POST['direction_id'];
			get_request_all($year);
		}
		
	}

	function get_request_all($year){
		global $connect;

		$query = "select 'All' As 'Grupo', mi.letter_month as 'Month', SUM(ai.applicants_prospectos) As 'Prospectos', SUM(ai.applicants_dm) As 'DM', SUM(ai.applicants_papel) As 'Papel' FROM applicants_indicators ai INNER JOIN months_indicators mi ON mi.number_month = ai.mount where ai.year = '$year' GROUP BY mi.letter_month order by mi.number_month ";
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
