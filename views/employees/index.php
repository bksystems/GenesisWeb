<!DOCTYPE html>
<html>
<head>
   <?php
   	$title_page = "Empleados"; 
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
						<h6>Acciones de empleados</h6>
					</div>
					<div class="card-body">
						<div class="list-group">
							<a href="#" class="list-group-item list-group-item-action">Agregar empleado</a>
							<a href="#" class="list-group-item list-group-item-action">Departamentos</a>
							<a href="#" class="list-group-item list-group-item-action">Posiciones</a>
							<a href="#" class="list-group-item list-group-item-action">Estados de empleado</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-10">
				<div class="card">
						<div class="card-header">
							<h6>Listado de empleados</h6>
						</div>
						<div class="card-body">
							<table id="table_employees" class="table table-hover table-striped table-bordered" style="font-size:13px;">
								<thead>
									<tr>
										<th>Nómina</th>
										<th>Apellido Paterno</th>
										<th>Apellido Materno</th>
										<th>Nombres</th>
										<th>Puesto</th>
										<th>Departamento</th>
										<th>Estatus empleado</th>
										<th>Jefe directo</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
			</div>
		</div>
		<div></div>
	</div>
	<?php
		  include('..//template_plugins//pages_template_footer.php');
  	?>

	
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#table_employees').DataTable({
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
				url: '../../web_services/web/employees/web_json_get_employees.php',
				dataSrc: 'data'
    		},
    		columns: [
				{data: 'roster'},
				{data: 'first_lastname'},
				{data: 'second_lastname'},
				{data: 'names'},
				{data: 'position'},
				{data: 'department'},
				{data: 'status'},
				{data: 'boss'}
			]
		});
	});
</script>
