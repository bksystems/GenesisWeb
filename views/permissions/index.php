<?php
    include('..//controllers//detail.php');
?>
<!DOCTYPE html>
<html>
<head>
   <?php
   	$title_page = "Permisos"; 
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
						<h6>Acciones</h6>
					</div>
					<div class="card-body">
						<div class="list-group">
							<a href="add.php" class="list-group-item list-group-item-action">Crear nuevo permiso</a>
							<a href="../rols/index.php" class="list-group-item list-group-item-action">Crear nuevo rol</a>
							<a href="../rols_permissions/index.php" class="list-group-item list-group-item-action">Asignar permiso a rol</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-10">
				<div class="card">
						<div class="card-header">
							<h6>Listado de permisos</h6>
						</div>
						<div class="card-body">
							<table id="table_permissions" class="table table-hover table-striped table-bordered" style="font-size:12px;">
								<thead>
									<tr>
										<th>Permiso</th>
										<th>Descriptción</th>
										<th>Estatus</th>
										<th>Creación</th>
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
		$('#table_permissions').DataTable({
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
				url: '../../web_services/web/permissions/web_json_get_permission.php',
				dataSrc: 'data'
    		},
    		columns: [
				{data: 'controller'},
				{data: 'description'},
				{data: 'enabled'},
				{data: 'created'}
			]
		});
	});
</script>


