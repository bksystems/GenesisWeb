<?php
    require '../web_connection.php';
    $rol_exists = $db->prows('SELECT id FROM sys_tb_rols WHERE rol = ? LIMIT 1', 's' , $_GET['rol_name'] );
    if ( $rol_exists ) { echo 'true'; } else { echo 'false'; }
    exit;
?>