<?php
    include('..//controllers//detail.php');
?>
<!DOCTYPE html>
<html>
<head>
   <?php
   	$title_page = "Roles"; 
   	include('..//template_plugins//pages_template_head.php');
   ?>
</head>
<body>
	
	<?php
 	 	include('..//template_plugins//pages_template_menu.php');
  	?>

	<div class="container-fluid">
    <div class="row">
			<div class="col-md-2">
				<div class="card">
					<div class="card-header">
						<h6>Agregar un nuevo permiso</h6>
					</div>
					<div class="card-body">
						<div class="list-group">
							<a href="index.php" class="list-group-item list-group-item-action">Lista de permisos</a>
							<a href="../permissions/index.php" class="list-group-item list-group-item-action">Ir a permisos</a>
							<a href="../rols_permissions/index.php" class="list-group-item list-group-item-action">Rol - permiso</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-10">
				<div class="card">
						<div class="card-header">
							<h6>Registrar permiso</h6>
						</div>
						<div class="card-body">
                        <form id="new_permission_form">
                                <div class="form-group">
                                    <label for="permission_name">Nombre de Rol</label>
                                    <input name="permission_name" type="text" class="form-control" id="permission_name" placeholder="Nombre de permiso" required>
                                </div>
                                <div class="form-group">
                                    <label for="permission_description">Descrición</label>
                                    <textarea type="textarea" class="form-control" id="permission_description" placeholder="Descripción de permiso" required></textarea>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="check_enabled">
                                    <label class="form-check-label" for="check_enabled">Habilitar</label>
                                </div>
                                <button id="btn-insert-permission" type="submit" class="btn btn-primary">Guardar</button>
                            </form>
						</div>
					</div>
			</div>
		</div>
	</div>

	<?php
		  include('..//template_plugins//pages_template_footer.php');
  	?>

	
</body>
</html>

<script type="text/javascript">
	
</script>


