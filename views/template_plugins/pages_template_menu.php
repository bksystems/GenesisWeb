<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">Génesis</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="../../index.php">Inicio <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="../indicators/index.php">Dashboard <span class="sr-only"></span></a>
      <a class="nav-item nav-link" href="../structures/map_viewer.php">Mapa <span class="sr-only"></span></a>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Seguimiento Génesis
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../activity_teams/index.php">Actividades en campo</a>
          <a class="dropdown-item" href="../employees/shelter_letters.php">Cartas resguardo</a>
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
            <a class="dropdown-item" href="#">Usuarios</a>
            <a class="dropdown-item" href="#">Roles</a>
            <a class="dropdown-item" href="#">Roles - permisos</a>
            <a class="dropdown-item" href="#">Permisos</a>
          <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Bitacora</h6>
            <a class="dropdown-item" href="#">Sesiones</a>
            <a class="dropdown-item" href="#">Logs</a>
        </div>
      </li>
    </div>
  </div>
</nav>
<br>
<br>
<div class="col-md-6">
  <h5 style="padding-top:10px;"><?php echo $title_page; ?></h5>
</div>