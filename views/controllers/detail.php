<?php
    session_start();
    //session_set_cookie_params(1);
    $controller_name = get_controller_name($_SERVER['SCRIPT_FILENAME']);
    $action_name = get_action_name($_SERVER['SCRIPT_FILENAME']);
    if(isset($_SESSION['session']) && isset($_SESSION['employee']) && $_SESSION['state'] == 1){   
        $index_array = array_search($controller_name, array_column($_SESSION['permissions'], 'controller'));    
        //validamos que el permiso se encuentre registrado
        if($index_array != null){
            $type_action_page = null;
            switch ($action_name){
                case 'index':
                    $type_action_page = 'is_index';
                    break;
                case 'add':
                    $type_action_page = 'is_add';
                    break;
                case 'edit':
                    $type_action_page = 'is_edit';
                    break;
                case 'delete':
                    $type_action_page = 'is_delete';
                    break;
                case 'detail':
                    $type_action_page = 'is_details';
                    break;
            }
            //validamos que el tipo no se encuentre vacio
            if($type_action_page != null){

                $is_enabled = null;
                $is_enabled = $_SESSION['permissions'][$index_array][$type_action_page];
                //validamos si tenga permiso
                if($is_enabled != null){
                
                }else{
                    redirect_page($controller_name, false);
                }
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
                header('location: ../../index.php');
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

    function permission_access($controller_name, $action_name){
        $result_access_view = false;
        if(isset($_SESSION['session']) && isset($_SESSION['employee']) && $_SESSION['state'] == 1){   
            $index_array = array_search($controller_name, array_column($_SESSION['permissions'], 'controller'));    
            if($index_array != null){
                $type_action_page = null;
                switch ($action_name){
                    case 'index':
                        $type_action_page = 'is_index';
                        break;
                    case 'add':
                        $type_action_page = 'is_add';
                        break;
                    case 'edit':
                        $type_action_page = 'is_edit';
                        break;
                    case 'delete':
                        $type_action_page = 'is_delete';
                        break;
                    case 'detail':
                        $type_action_page = 'is_details';
                        break;
                }
                if($type_action_page != null){
    
                    $is_enabled = null;
                    $is_enabled = $_SESSION['permissions'][$index_array][$type_action_page];
                    if($is_enabled != null){
                        $result_access_view = true;
                    }else{
                        $result_access_view = false;
                    }
                }else{
                    $result_access_view = false;
                }
            }else{
                $result_access_view = false;
            }
        }else{
            $result_access_view = false;
        }
        return $result_access_view;
    }

?>