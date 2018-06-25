<?php
    $controller_name = get_controller_name($_SERVER['SCRIPT_FILENAME']);
    $action_name = get_action_name($_SERVER['SCRIPT_FILENAME']);
    session_start();
    if(isset($_SESSION['session_user']) && isset($_SESSION['session_state']) && isset($_SESSION['session_date'])){

    }else{
        header('location: ../users/login.php');
        exit();
    }

    function get_controller_name($string_base_uri){
        $split_string = array();
        $split_string = explode('/', $_SERVER['SCRIPT_FILENAME']);
        $max = sizeof($split_string);
        return $split_string[$max - 2];
    }

    function get_action_name($string_base_uri){
        $split_string = array();
        $split_string = explode('/', $_SERVER['SCRIPT_FILENAME']);
        $max = sizeof($split_string);
        $without_extension = basename($split_string[$max - 1], '.php');
        return $without_extension;
    }

?>