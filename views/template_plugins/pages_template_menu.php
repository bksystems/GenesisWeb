
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">Génesis</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <ul class="navbar-nav mr-auto">
      <a class="nav-item nav-link" href="../../index.php"><span class="glyphicon glyphicon-home"></span> Inicio<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="../indicators/index.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard<span class="sr-only"></span></a>
      <a class="nav-item nav-link" href="../maps/index.php"> <span class="glyphicon glyphicon-screenshot"></span> Mapa<span class="sr-only"></span></a>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Seguimiento Génesis
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../activity_teams/index.php">Actividades en campo</a>
          <a class="dropdown-item" href="../shelter_letters/index.php">Cartas resguardo</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Matríz de operaciones</a>
          <a class="dropdown-item" href="#">Matríz de ventas</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Mantenimiento
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <h6 class="dropdown-header">Catalogos de sistema</h6>
            <a class="dropdown-item" href="../structures/index.php">Estructura</a>
            <a class="dropdown-item" href="../employees/index.php">Empleados</a>
          <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Mantenimiento de indicadores</h6>
            <a class="dropdown-item" href="#">Solicitantes</a>
            <a class="dropdown-item" href="#">Solicitudes</a>
            <a class="dropdown-item" href="#">Retrabajos</a>
            <a class="dropdown-item" href="#">Bitacora</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Administración
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <h6 class="dropdown-header">Acceso</h6>
            <a class="dropdown-item" href="../users/index.php">Usuarios</a>
            <a class="dropdown-item" href="../rols/index.php">Roles</a>
            <a class="dropdown-item" href="../permissions/index.php">Permisos</a>
            <a class="dropdown-item" href="../rols_permissions/index.php">Roles - permisos</a>
          <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Bitacora</h6>
            <a class="dropdown-item" href="../sessions/index.php">Sesiones</a>
            <a class="dropdown-item" href="#">Logs</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['employee']['names'] . ' ' . $_SESSION['employee']['first_lastname'] . ' ' . $_SESSION['employee']['second_lastname'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="../../web_services/web/users/logout_end.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a>
                <a class="dropdown-item" href="#">Another action</a>
            </div>
        </li>
      </ul>
  </div>
</nav>
<br>
<br>
<div class="col-md-6">
  <h5 style="padding-top:10px;"><?php echo $title_page; ?></h5>
</div>