<!DOCTYPE html>
<html>
<head>
   <?php
   	$title_page = "Consolidación cartas resguardo"; 
   	include('..//template_plugins//pages_template_head.php');
   ?>
</head>
<body>
	
	<?php
 	 	include('..//template_plugins//pages_template_menu.php');
  	?>

	<div class="container-fluid">
		<div class="card">
			<div class="card-header">Cartas resguardo</div>
			<div class="card-body">
				<table id="employee_details" style="font-size:11px;" class="table table-hover table-striped">
					<thead>
						<tr>
							<th>Dirección</th>
							<th>Subdirección</th>
							<th>Región</th>
							<th>Oficina</th>
							<th>Nómina</th>
							<th>Apellido Paterno</th>
							<th>Apellido Materno</th>
							<th>Nombre(s)</th>
							<th>Puesto</th>
							<th>Estatus</th>
							<th>Requiere Carta</th>
						</tr>
					</thead>
				</table>
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
		$('#employee_details').DataTable({
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
				url: '../../web_services/web/employees/web_json_get_shelter_letters.php',
				dataSrc: 'data'
    		},
    		columns: [
				{data: 'direction'},
				{data: 'subdirection'},
				{data: 'region'},
				{data: 'name'},
				{data: 'number'},
				{data: 'first_last_name'},
				{data: 'second_last_name'},
				{data: 'names'},
				{data: 'position'},
				{data: 'status_employee'},
				{data: 'require_shelter'}
			]
		});
	});
</script>

