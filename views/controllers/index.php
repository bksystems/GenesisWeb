<?php
    include('session_controller.php');
?>

<?php

    $controller_name = 'indicators';//get_controller_name($_SERVER['SCRIPT_FILENAME']);
    $action_name = get_action_name($_SERVER['SCRIPT_FILENAME']);

    $index_array = array_search($controller_name, array_column($_SESSION['permissions'], 'controller'));
    if($index_array != null && $index_array != ''){
        $permision_type = '';
        switch($action_name){
            case 'index':
                $permision_type = 'is_index';
                break;
            case 'add':
                $permision_type = 'is_add';
                break;
            case 'edit':
                $permision_type = 'is_edit';
            case 'delete':
            break;
                $permision_type = 'is_delete';
        }
        if($_SESSION['permissions'][$index_array][$permision_type] == 1){
            echo 'Indez_Search[' . $index_array. '] controller => ['.  $controller_name . '], action => [' . $action_name . '] status => [Con permiso]';
        }else{
            echo 'Indez_Search[' . $index_array. '] controller => ['.  $controller_name . '], action => [' . $action_name . '] status => [Sin permiso]';
        }
    }else{
        echo 'Indez_Search[' . $index_array. '] controller => ['.  $controller_name . '], action => [' . $action_name . '] status => [Sin permiso]';
    }
    

?>
