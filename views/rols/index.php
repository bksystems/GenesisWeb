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
						<h6>Roles del sistema</h6>
					</div>
					<div class="card-body">
						<div class="list-group">
							<a href="add.php" class="list-group-item list-group-item-action">Crear Rol</a>
							<a href="../permissions/index.php" class="list-group-item list-group-item-action">Ir a permisos</a>
							<a href="../rols_permissions/index.php" class="list-group-item list-group-item-action">Rol - permiso</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-10">
				<div class="card">
						<div class="card-header">
							<h6>Listado de roles</h6>
						</div>
						<div class="card-body">
							<table id="table_rols" class="table table-hover table-striped table-bordered" style="font-size:12px;">
								<thead>
									<tr>
										<th>Rol</th>
										<th>Descriptción</th>
										<th>Estatus</th>
										<th>Permisos</th>
									</tr>
								</thead>
							</table>
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
	$(document).ready(function(){
		$('#table_rols').DataTable({
			'language':{
				'search':'Buscar _INPUT_ en la tabla',
				'lengthMenu': 'Mostrar _MENU_ rengistros por pagina',
				'zeroRecords':'No se encontrar registros con la busqueda',
				'info':'Mostrando paguina _PAGE_ de _PAGES_',
				'infoEmpty':'Ningun registro encontrado',
				'infoFiltered':" - filtrando registros de un total de _MAX_",
				'paginate':{
					'next':'Siguiente',
					'previous':'Anterior'
				}
			},
			ajax: {
				url: '../../web_services/web/rols/web_json_get_rols.php',
				dataSrc: 'data'
    		},
    		columns: [
				{data: 'rol'},
				{data: 'description'},
				{data: 'status'},
				{data: 'created'}
			]
		});
	});
</script>


