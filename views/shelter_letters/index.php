<?php
    include('..//controllers//detail.php');
?>
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
				<table id="employee_details" style="font-size:12px;" class="table table-hover table-striped">
					<thead>
						<tr>
							<th>Dirección</th>
							<th>Subdirección</th>
							<th>Región</th>
							<th>Oficina</th>
							<th>Nómina</th>
							<th>Colaborador</th>
							<th>Puesto</th>
							<th>Documento</th>
							<th>Acción</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

	<?php
		  include('..//template_plugins//pages_template_footer.php');
  	?>

	<input type="file" id="load_shelter" style="display:none"/> 
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		var data_number = 0;
		var table = $('#employee_details').DataTable({
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
				{data: 'employee_name'},
				{data: 'position'},
				{ data: "path_file", render: function ( data, type, row ) {
                if ( type === 'display' ) {
                    var numberRenderer = $.fn.dataTable.render.number( ',', '.', 0, '$' ).display;
					$print_result = '';
					if(data != ''){
						$print_result = '<a class="text-success" href=../../' + data +' target="_blank">Descargar</a>';
					}else{
						$print_result = '<p class="text-danger">Sin carta</p>';
					}
                    return  $print_result;
                }
                return data;
            	}},
				{"defaultContent": "<button class='btn btn-primary btn-sm'>Cargar</button>"},
			]
		});

		$('#employee_details tbody').on( 'click', 'button', function () {
			var data = table.row( $(this).parents('tr') ).data();
			data_number = data['number'] + '.pdf';
			if(data['status_shelter'] == 'Con Carta'){
				alert('El usuario: ' + data['employee_name'] + ' ya cuenta con carta\nEsta a punto de remplazarla.')
			}
				$('#load_shelter').trigger('click', function(){
			});
		});

		$('#load_shelter').on( 'change', function() {
			myfile = $( this ).val();
			var ext = myfile.split('.').pop();
			if(ext=="pdf"){
				var file_data = $('#load_shelter').prop('files')[0];  
				var form_data = new FormData();              
				form_data.append('file', file_data, data_number);                         
				$.ajax({
					url: '../../web_services/web/employees/controller_file_upload.php',
					dataType: 'text', 
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                   
					type: 'post',
					success: function(php_script_response){
						alert(php_script_response); 
						table.ajax.reload();
				}
			});
			} else{
				alert('Solo se pueden cargar documentos extensión PDF');
			}
		});
	});
</script>

