<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		require '../web_connection.php';
		if(isset($_POST['subdirection_id'])){
			$subdirection_id = $_POST['subdirection_id'];
			get_regions($subdirection_id);
		}
	}

	function get_regions($subdirection_id){
		global $connect;
		$query = "select * FROM sys_structure_regions where subdirection_id = '$subdirection_id' and enabled = 1 order by region";
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
