<?php
    $controller_name = get_controller_name($_SERVER['SCRIPT_FILENAME']);
    $action_name = get_action_name($_SERVER['SCRIPT_FILENAME']);
    session_set_cookie_params(0);
    session_start();
    if(isset($_SESSION['session']) && isset($_SESSION['employee']) &&$_SESSION['state'] == true){

        //header('location: ../'. $controller_name . '/'. $action_name . '.php');      
  
    }else{
        if($controller_name == "GenesisWeb"){
            header('location: views/users/login.php');
        }else{
            header('location: ../users/login.php');
        }
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