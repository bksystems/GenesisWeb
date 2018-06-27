
<!DOCTYPE html>
<html>
<head>
   <?php
   	$title_page = "Actividades en campo Génesis"; 
   	include('..//template_plugins//pages_template_head.php');
   ?>
</head>
<body>
	
	<?php
 	 	include('..//template_plugins//pages_template_menu.php');
  	?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				
				<div class="card">
					<div class="card-header">
						<h6>Registrar nueva actividad</h6>
					</div>
					<div class="card-body">
						<form>
							<div class="form-group">
								<label for="name_activity">Actividad</label>
								<input type="text" class="form-control" id="name_activity" placeholder="Actividad">
							</div>
							<div class="form-group">
								<label for="activity_description">Descrición</label>
								<textarea type="textarea" class="form-control" id="activity_description" placeholder="Descripción de actividad"></textarea>
							</div>
							<button id="btn-insert-activity" type="submit" class="btn btn-primary">Guardar</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-8">
			<div class="card">
					<div class="card-header">
						<h6>Registros de actividades</h6>
					</div>
					<div class="card-body">
						<table id="activites_table" class="table table-hover table-borderless">
							<thead>
								<tr>
									<th>Tipo de actividad</th>
									<th>Empleado</th>
									<th>Fecha y hora</th>
								</tr>
							</thead>
						</table>
						<div id="content" class="list-group"  style="height: 700px; overflow-y: scroll;">	

						</div>
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

	function update_activitys(){
		$.ajax({
			type: 'GET',
			dataType: 'json',
			url: '../../web_services/web/implement/web_json_get_activityes.php',
			success: function(data){
				if(data.result = true){
					$('#content').html("");
					$.each(data.data, function(index, value){
						$('#content').append('<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">' +
																		'<div class="d-flex w-100 justify-content-between">' +
																		   '<h5 class="mb-1">' + value.activity + '</h5><small>' + value.created  + '</small>' +
																		'</div>' +
																		'<p class="mb-1">' + value.description + '</p>' +
																		'<small>' + value.names + ' ' +  value.first_lastname + ' ' + value.second_lastname + '</small>' +
																	'</a>');
					})
				}else{
					alert('Error');
				}
			},
			error:function(data){
				alert(data);
			}
		});
	}

	$(document).ready(function(){

		$('#activites_table').DataTable();

		setInterval(function() { // Do this
			update_activitys();
		}, 1000);

		update_activitys();

		$('#btn-insert-activity').click(function(e){
			e.preventDefault();
			var name_activity = $("#name_activity").val();
			var activity_description = $("#activity_description").val();
			$.ajax({
				url:'../../web_services/web/implement/web_insert_activityes.php',
				type:'POST',
				data:{
					'id_user': 1,
					'name_activity': name_activity,
					'activity_description': activity_description
				},
				success:function(response) {
					var jsonObj = response.data;
					if(jsonObj[0].success == true){
						update_activitys();
						$("#name_activity").val('');
						$("#activity_description").val('');

					}else{
						alert('Error');
					}
				},
				error:function(response){
					alert(response.responseText);
				}
			});
		});



	});
</script>
