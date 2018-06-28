<?php
    $controller_name = get_controller_name($_SERVER['SCRIPT_FILENAME']);
    $action_name = get_action_name($_SERVER['SCRIPT_FILENAME']);
    session_set_cookie_params(0);
    session_start(); 
    if(isset($_SESSION['session']) && isset($_SESSION['employee']) && $_SESSION['state'] == true){    
        $index_array = array_search($controller_name, array_column($_SESSION['permissions'], 'controller'));
        if($index_array != null){
            
            $inde_array_integer = intval($index_array);
            $permision_type = '';
            switch ($action_name) {
                case "index":
                    $permision_type = "is_index";
                    break;
                case "add":
                    $permision_type = "is_add";
                    break;
                case "edit":
                    $permision_type = "is_edit";
                    break;
                case "delete":
                    $permision_type = "is_delete";
                    break;
            }
            
            if($_SESSION['permissions'][$inde_array_integer][$permision_type] == 1){
                
            }else{
               redirect_page($controller_name, false);  
            }
        }else{
            redirect_page($controller_name, false);
        }
        
    }else{
        redirect_page($controller_name, true);
    }

    function redirect_page($controller_name, $is_login){
        if($is_login == true){
            if($controller_name == "GenesisWeb"){
                header('location: views/users/login.php');
            }else{
                header('location: ../users/login.php');
            }
            
        }else{
            if($controller_name == "GenesisWeb"){
                //header('location: index.php');
            }else{
               //header('location: index.php');
            }
           
        }
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