<?php
    include('..//controllers//detail.php');
?>
<!DOCTYPE html>
<html>
<head>
   <?php
   	$title_page = "Crear Nueva Estructura"; 
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
				<div class="list-group">
					<a href="#" class="list-group-item active disabled">
						Acciones
					</a>
					<a href="add.php" class="list-group-item list-group-item-action"><span class="glyphicon glyphicon-plus"></span> Agregar nuevo</a>
					<a href="details.php" class="list-group-item list-group-item-action"><span class="glyphicon glyphicon-plus"></span> Ver detalle</a>
					<a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
					<a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
				</div>
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Ingresar datos</div>
                    <div class="card-body">
						<table id="structure_table" class="table table-hover table-striped table-bordered" style="font-size:12px; width:100%">
							<thead>
								<tr>
									<th>Centro Costo</th>
									<th>Nombre</th>
									<th>Tipo</th>
									<th>Organización</th>
									<th>Descripción</th>
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
		$('#structure_table').DataTable({
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
				{data: 'cost_center'},
				{data: 'name'},
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

