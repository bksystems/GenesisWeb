<?php
    include('..//controllers//detail.php');
?>
<!DOCTYPE html>
<html>
<head>
   <?php
   	$title_page = "Agregar nuevo rol"; 
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
							<a href="add.php" class="list-group-item list-group-item-action">Crear usuario</a>
                            <a href="../rols/index.php" class="list-group-item list-group-item-action">Ir a roles</a>
							<a href="../permissions/index.php" class="list-group-item list-group-item-action">Ir a permisos</a>
							<a href="../rols_permissions/index.php" class="list-group-item list-group-item-action">Rol - permiso</a>
						</div>
					</div>
				</div>
			</div>
            <div class="col-md-10">
                <div class="card">
                        <div class="card-header">
                            <h6>Crear nuevo usuario del sistema</h6>
                        </div>
                        <div class="card-body">
                            <form id="add_new_user">
                                <div class="form-group">
                                    <label for="user_employee">Empleado responsable del usuario</label>
                                    <select type="textarea" class="form-control" id="user_employee" required></select>
                                </div>
                                <div class="form-group">
                                    <label for="user_id">ID Usuario</label>
                                    <input name="user_id" type="text" class="form-control" id="user_id" placeholder="Nombre de usuario" required disabled>
                                </div>
                                <div class="form-group">
                                    <label for="rol_name">Contraseña</label>
                                    <input name="rol_name" type="password" class="form-control" id="user_password_confirm" placeholder="Contraseña" required>
                                </div>
                                <div class="form-group">
                                    <label for="rol_name">Confirmar contraseña</label>
                                    <input name="rol_name" type="password" class="form-control" id="user_password_confirm" placeholder="Confirmar contraseña" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_rol">Rol asignado</label>
                                    <select type="textarea" class="form-control" id="user_rol" required></select>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="check_enabled">
                                    <label class="form-check-label" for="check_enabled">Habilitar</label>
                                </div>
                                <button id="btn-insert-rol" type="submit" class="btn btn-primary">Guardar</button>
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
    function load_data(){
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '../../web_services/web/rols/web_json_get_rols.php',
            success: function(data){
            if(data.result = true){
                $('#user_rol').html("");
                var toAppend = '';//;'<option value="0">Todas</option>';
                $.each(data.data, function(index, value){
                    toAppend += '<option value=' + value.id + '>'+ value.rol + '</option>';
                });
                $('#user_rol').append(toAppend);
            }else{
                alert('Error');
            }
            },
            error:function(data){
                alert(data);
            },
            complete:function(){
                $("#user_rol").val(0);
            }
        });

         $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '../../web_services/web/employees/web_json_get_employees_by_user.php',
            success: function(data){
            if(data.result = true){
                $('#user_employee').html("");
                var toAppend = '';//;'<option value="0">Todas</option>';
                $.each(data.data, function(index, value){
                    toAppend += '<option value=' + value.roster + '>' + value.roster +' ' +  value.names +  ' ' + value.first_lastname + ' ' + value.second_lastname + '</option>';
                });
                $('#user_employee').append(toAppend);
            }else{
                alert('Error');
            }
            },
            error:function(data){
                alert(data);
            },
            complete:function(){
                $("#user_employee").val(0);
            }
        });

    }
    $(document).ready(function(){

        load_data();

        $('#user_employee').change(function(){
			var roster_value = this.value;
			if(roster_value > 0){
				$('#user_id').val(roster_value);
			}else{
		
			}

		});

        $('#add_new_user').validate({
            rules:{
                messages:{
                    user_employee:{
                        required: 'Debe seleccionar por favor el usuario',
                    },
                    user_id:{
                        required: 'Debe seleccionar por favor el usuario',
                    }
                },
                onkeyup:true,
                onblur:true
            },
            errorElement: "em",
			errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
				error.addClass( "help-block" );

                if ( element.prop( "type" ) === "checkbox" ) {
                    error.insertAfter( element.parent( "label" ) );
                } else {
                    error.insertAfter( element );
                }
			},
			highlight: function ( element, errorClass, validClass ) {
				$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
			},
			unhighlight: function (element, errorClass, validClass) {
				$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
			}
        });
    });
</script>


