<?php
	require '../web_connection.php';
	require '../global_functions.php';

	global $connect;
	if(isset($_POST['id_user']) && isset($_POST['name_activity']) && isset($_POST['activity_description'])){
		mysqli_set_charset($connect,"utf8");
		$id_user = $_POST['id_user'];
		$name_activity = $_POST['name_activity'];
 		$activity_description = $_POST['activity_description'];
 		$created = getDateTimeNow();
		$modified = getDateTimeNow();
		$json_result = array();
		$jsonRequest = array();
		$query = "insert into tb_implement_activities (id_user, activity, description, created, modified) values ('$id_user', '$name_activity', '$activity_description', '$created', '$modified')";
		if (mysqli_query($connect, $query)) {
			$data_insert = 'insert into tb_implement_activities (id_user, activity, description, created, modified) values (' . $id_user . ',' . $name_activity . ',' . $activity_description . ',' . $created . ',' . $modified . ');';
			$query_log = "insert into logs (page, log_type, log_description, user_id, web_app, created) values ('implement/index', 'insert', '$data_insert', '$id_user', 'web', '$created')";
			mysqli_query($connect, $query_log);
			$jsonRequest['success'] = true;
			$jsonRequest['message'] = $created;
		}else{
			$data_insert = 'insert into tb_implement_activities (id_user, activity, description, created, modified) values (' . $id_user . ',' . $name_activity . ',' . $activity_description . ',' . $created . ',' . $modified . ');';
			$query_log = "insert into logs (page, log_type, log_description, user_id, web_app, created) values ('implement - index', 'error insert', '$data_insert', '$id_user', 'web', '$created')";
			mysqli_query($connect, $query_log);
			$jsonRequest['success'] = $query;
			$jsonRequest['message'] = 'not insert';
		}
		header('Content-type: application/json; charset=utf.8');
		$json_result['data'][] = $jsonRequest;
		echo json_encode($json_result, JSON_PRETTY_PRINT);
		mysqli_close($connect);
	}
?>
