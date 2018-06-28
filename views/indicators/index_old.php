<?php
    include('..//controllers//session_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
   <?php
   	$title_page = "Indicadores Génesis"; 
	   include('..//template_plugins//pages_template_head.php');  
   ?>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
</head>
<body>
	
	<?php
 	 	include('..//template_plugins//pages_template_menu.php');
  	?>

	<div class="container-fluid">
		<!-- Componente de estructura-->
		<div class="row">
			<div class="col-sm-2">
				<div class="form-group">
					<label for="cb_direcction">Dirección</label>
					<select id="cb_direcction" class="form-control form-control-sm">

					</select>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label for="cb_subdirection">Subdirección</label>
					<select id="cb_subdirection" class="form-control form-control-sm">
						<option>Selecciona subdirección</option>
					</select>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label for="cb_region">Región</label>
					<select id="cb_region" class="form-control form-control-sm">
						<option>Selecciona región</option>
					</select>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label for="cb_office">Oficina</label>
					<select id="cb_office" class="form-control form-control-sm">
						<option>Selecciona oficina</option>
					</select>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<label for="cb_year">Año</label>
					<select id="cb_year" class="form-control form-control-sm">
						<option>Selecciona mes</option>
					</select>
				</div>
			</div>
			<div class="col-auto my-2">
				<div class="form-group">
				<label></label>
					<div class="text-right">
						<button id="btn_update_indicators" type="submit" class="btn btn-primary btn-sm">Generar graficas</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Componente donde se encuentran los graficos-->
		<div>
			<div class="row">
				<div class="col-md-4"><h6 id="title_structure_indicators"></h6></div>
			</div>


			<div class="row">
					<div class="col-md-6">
						<div class="card">
							<h6 class="card-header">Solicitantes</h6>
							<div class="card-body">
								<div id="graph_solicitantes" style="height: 200px;"></div>
							</div>
						</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<h6 class="card-header">Retrabajos</h6>
						<div class="card-body">
							<div id="graph_retrabajos" style="height: 200px;"></div>
						</div>
					</div>
				</div>
			</div>
			<p></p>
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<h6 class="card-header">Solicitudes</h6>
						<div class="card-body">
							<div id="graph_solicitudes" style="height: 200px;"></div>
						</div>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="card">
						<h6 class="card-header">Avance a renovaciones</h6>
						<div class="card-body">
							<div id="graph_renovaciones" style="height: 200px;"></div>
						</div>
					</div>
				</div>
			</div>
		
			<p></p>

		
		</div>
	</div>

<?php
	include('..//template_plugins//pages_template_footer.php');
?>

</body>
</html>

<script type="text/javascript">

	var type_report_index = 0;

	$(document).ready(function(){
		$('#cb_subdirection').html("");
		$("#cb_subdirection").prop('disabled', 'disabled');
		$('#cb_region').html("");
		$('#cb_region').prop('disabled', 'disabled');
		$('#cb_office').html("");
		$('#cb_office').prop('disabled', 'disabled');

		$('#new_indicators').hide();
		load_directions();
		load_years();
		init_indicators();

		

		type_report_index = 0;

		$('#btn_update_indicators').click(function(){
			var year = $( "#cb_year option:selected" ).val();
			var dir_id = $( "#cb_direcction option:selected" ).val();
			var sub_id = $( "#cb_subdirection option:selected" ).val();
			var reg_id = $( "#cb_region option:selected" ).val();
			var os_id = $( "#cb_office option:selected" ).val();
			if(year > 0){
					switch(type_report_index){
						case 0:
							update_indicators(year, type_report_index, 0)
							update_search_indicators("Nacional - Año: " + year);
							break;
						case 1:
							update_indicators(year, type_report_index, dir_id)
							update_search_indicators( $( "#cb_direcction option:selected" ).text() + " - " + year);
							break;
						case 2:
							update_indicators(year, type_report_index, sub_id)
							update_search_indicators( $( "#cb_direcction option:selected" ).text() + " - " +$( "#cb_subdirection option:selected" ).text() + " - " + year);
							break;
						case 3:
							update_indicators(year, type_report_index, reg_id)
							update_search_indicators( $( "#cb_direcction option:selected" ).text() + " - " +$( "#cb_subdirection option:selected" ).text() + " - " +$( "#cb_region option:selected" ).text() + " - " + year);
							break;
						case 4:
							update_indicators(year, type_report_index, os_id)
							update_search_indicators( $( "#cb_direcction option:selected" ).text() + " - " +$( "#cb_subdirection option:selected" ).text() + " - " + $( "#cb_region option:selected" ).text() + " - " + $( "#cb_office option:selected" ).text() + " - " + year);
							break;
						default:
							update_indicators(year, 0, 0)
							break;
					}		
			}else{
				alert('Por favor selecione el año de información');
			}
			update_search_indicators();
		});

		$('#cb_direcction').change(function(){
			var id_direction = this.value;
			if(id_direction > 0){
				type_report_index = 1;
				load_subdirections(id_direction);
			}else{
				type_report_index = 0;
				$('#cb_subdirection').html("");
				$('#cb_region').html("");
				$('#cb_office').html("");
				$('#cb_subdirection').prop('disabled', 'disabled');
				$('#cb_region').prop('disabled', 'disabled');
				$('#cb_office').prop('disabled', 'disabled');
			}
		});

		$('#cb_subdirection').change(function(){
			var id_subdirection = this.value;
			if(id_subdirection > 0){
				load_regions(id_subdirection);
				type_report_index = 2;
			}else{
				type_report_index = 1;
				$('#cb_region').html("");
				$('#cb_region').prop('disabled', 'disabled');
				$('#cb_office').html("");
				$('#cb_office').prop('disabled', 'disabled');
			}
		});

		$('#cb_region').change(function(){
			var id_region = this.value;
			if(id_region > 0){
				load_offices(id_region);
				type_report_index = 3;
			}else{
				type_report_index = 2;
				$('#cb_office').html("");
				$('#cb_office').prop('disabled', 'disabled');
			}
		});
		
		$('#cb_office').change(function(){
			var id_office = this.value;
			if(id_office > 0){
				type_report_index = 4;
			}else{
				type_report_index = 3;
			}
		});

	});
</script>
