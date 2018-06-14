<?php
  session_start();

  if(isset($_SESSION['user']) and isset($_SESSION['session']) and $_SESSION['state'] == 'Autenticado') {
      $_SESSION['timeout'] = time();
      if((time() - $_SESSION['timeout']) > 10) {
          session_destroy();
          header('location:. .//..//views//users//login.php');
          exit;
      }else{
          $_SESSION['timeout'] = time();
      }
  } else {
     header('location: ../users/login.php'); 
     exit;
  }
  
?>
