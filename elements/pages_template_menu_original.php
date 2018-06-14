<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <a class="navbar-brand" href="index.php">
            <img src="../../content/images/userlogin.png" width="30" height="29" alt="">
          </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="<?php if (isset($active_sales)){echo $active_sales;}?>"><a href="index.php"><i class='glyphicon glyphicon-home'></i> Home</a></li>
            <li class="<?php if (isset($active_sales)){echo $active_sales;}?>"><a href="views/indicators/index.php"><i class='glyphicon glyphicon-tasks'></i> Indicadores</a></li>
          	<li class="<?php if (isset($active_sales)){echo $active_sales;}?>"><a href="../sales/index.php"><i class='glyphicon glyphicon-barcode'></i> Ventas</a></li>
          	<li class="<?php if (isset($active_sales)){echo $active_sales;}?>"><a href="../sales/index.php"><i class='glyphicon glyphicon-tag'></i> Pedidos</a></li>
          	<li class="<?php if (isset($active_sales)){echo $active_sales;}?>"><a href="../sales/index.php"><i class='glyphicon glyphicon-user'></i> Clientes</a></li>
          	<li class="<?php if (isset($active_sales)){echo $active_sales;}?>"><a href="../sales/index.php"><i class='glyphicon glyphicon-gift'></i> Promociones</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="carnet"></span>Administración</a>
            </li>
            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-cog'></i> Administraci&oacute;n <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Configuración basica para productos</li>
                 <?php 
                  $clave = array_search('products',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                     echo '<li><a href="pages/products/index.php"><i class="glyphicon glyphicon-qrcode"></i> Productos</a></li>';
                  }
                ?>
                <?php 
                  $clave = array_search('categories',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                     echo '<li><a href="pages/categories/index.php"><i class="glyphicon glyphicon-bookmark"></i>  Categoria de productos</a></li>';
                  }
                ?>
                <?php 
                  $clave = array_search('segments',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                     echo '<li><a href="paes/segments/index.php"><i class="glyphicon glyphicon-star-empty"></i> Descuentos</a></li>';
                  }
                ?>
                <?php 
                  $clave = array_search('answers_segments',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                     echo '<li><a href="pages/answers_segments/index.php"><i class="glyphicon glyphicon-th"></i> Inventario</a></li>';
                  }
                ?>
                <?php 
                  $clave = array_search('employees',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                     echo '<li><a href="../employees/index.php"><i class="glyphicon glyphicon-user"></i> Empleados</a></li>';
                  }
                ?>
                
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Configuración avanzada</li>
                 <?php 
                  $clave = array_search('users',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                     echo '<li><a href="../users/index.php">Usuarios</a></li>';
                  }
                ?>
                 <?php 
                  $clave = array_search('rols_permissions',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                     echo '<li><a href="../rols_permissions/index.php">Rol - Permiso</a></li>';
                  }
                ?>
                <?php 
                  $clave = array_search('security',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                     echo '<li><a href="../security/index.php">Seguridad</a></li>';
                  }
                ?>
                <?php 
                  $clave = array_search('rols',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                     echo '<li><a href="../rols/index.php">Roles</a></li>';
                  }
                ?>
                <?php 
                  $clave = array_search('permissions',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                     echo '<li><a href="../permissions/index.php">Permisos</a></li>';
                  }
                ?>
                 <?php 
                  $clave = array_search('type_employees',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                     echo '<li><a href="../type_employees/index.php">Tipo empleado</a></li>';
                  }
                ?>
                <?php 
                  $clave = array_search('status_users',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                    echo '<li><a href="../status_users/index.php">Tipo usuarios</a></li>';
                  }
                ?>
                <?php 
                  $clave = array_search('type_devices',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                    echo '<li><a href="../type_devices/index.php">Tipo dispositivo</a></li>';
                  }
                ?>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Monitoreo de sistema</li>
                <?php 
                  $clave = array_search('sessions',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                     echo '<li><a href="../sessions/index.php">Ingresos</a></li>';
                  }
                ?>
                <?php 
                  $clave = array_search('syncronizes',array_column($_SESSION['permissions'], 'controller')); // $clave = 2;
                  if($_SESSION['permissions'][$clave]['is_index'] == 1){
                     echo '<li><a href="../syncronizes/index.php">Sincronizaciones</a></li>';
                  }
                ?>
              </ul>
            </li>-->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <!--<?php
                echo $_SESSION["employee"][0]['first_lastname'] ." ". $_SESSION["employee"][0]['second_lastname']." ". $_SESSION["employee"][0]['names'];
             ?>-->
             <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../profile/index.php">Perfil</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Configuraciones</li>
                <li><a href="../settings_web/index.php">Configuraci&oacute;n Web</a></li>
                <li><a href="../settings_mobile/index.php">Configuraci&oacute;n M&oacute;vil</a></li>
                 <li role="separator" class="divider"></li>
                 <li><a href="../users/logout.php">Salir</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav><!--/.nav-collapse -->
    </div>
  </nav>