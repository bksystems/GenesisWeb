<?php

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        echo print_r($_FILES['file']);
        //move_uploaded_file($_FILES['file']['tmp_name'], '../../../content/files/shelter_letters/' . $_FILES['file']['name']);
    }

?>