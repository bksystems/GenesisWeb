<?php
    require '../web_connection.php';
    require '../global_functions.php';
    global $connect;
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $_FILES['file']['name']);
        $query_get_id = "SELECT id FROM sys_tb_shelter_letters_employees WHERE number = '$withoutExt'; ";
        $result_employee = mysqli_query($connect, $query_get_id);
        if(mysqli_num_rows($result_employee) > 0){
			while($row_user = mysqli_fetch_assoc($result_employee)){
                $employee_id= $row_user['id'];
                if($employee_id > 0){
                    $path = 'content/docs/shelters/' . $_FILES['file']['name'];
                    $query_delete_exist = "DELETE FROM sys_tb_shelter_letters_employees_files WHERE employee_id = '$employee_id';";
                    $result_delete = mysqli_query($connect, $query_delete_exist);
                    $query_insert = "INSERT INTO sys_tb_shelter_letters_employees_files (employee_id, employee_number, path_file) VALUES ('$employee_id', '$withoutExt', '$path');";
                    if (mysqli_query($connect, $query_insert)){
                        unlink($_FILES['file']['tmp_name'], '../../../' . $path);
                        move_uploaded_file($_FILES['file']['tmp_name'], '../../../' . $path);
                        echo 'Se guardo correctamente la carta del usuario';
                        //logs_controller(1,'succes', 'file_upload', 'employee', 'shelter upload', 'Se guardo correctamente la carta del usuario', 'empty');
                    }else{
                        echo 'No se inserto en la tabla' . $query_insert;
                    }
                }else{
                    echo 'No se encontro el usuario en la BD';
                }
            }
        }else{
            echo 'No se encontro el usuario';
        }
       
    }

?>