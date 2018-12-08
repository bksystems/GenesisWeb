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
						<h6>Roles del sistema</h6>
					</div>
					<div class="card-body">
						<div class="list-group">
							<a href="index.php" class="list-group-item list-group-item-action">Estructura</a>
							<a href="../organization_structures_types/index.php" class="list-group-item list-group-item-action">Tipos de organización</a>
						</div>
					</div>
				</div>
            </div>
            <div class="col-md-10">
                <div class="card">
                        <div class="card-header">
                            <h6>Registrar nuevo rol</h6>
                        </div>
                        <div class="card-body">
                            <form id="new_add_structure_form">
                                <div class="form-group">
                                    <label for="rol_name">Centro de Costo</label>
                                    <input name="rol_name" type="text" class="form-control" id="rol_name" placeholder="Nombre del rol" required>
                                </div>
                                <div class="form-group">
                                    <label for="rol_name">Nombre</label>
                                    <input name="rol_name" type="text" class="form-control" id="rol_name" placeholder="Nombre del rol" required>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="check_enabled">
                                    <label class="form-check-label" for="check_enabled">Habilitar</label>
                                </div>
                                <div class="form-group">
                                    <label for="rol_description">Tipo de estructura</label>
                                    <select type="textarea" class="form-control" id="rol_description" placeholder="Descripción de actividad" required></select>
                                </div>
                                <div class="form-group">
                                    <label for="rol_description">Descrición</label>
                                    <textarea type="textarea" class="form-control" id="rol_description" placeholder="Descripción de actividad" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="rol_name">Responsable</label>
                                    <input name="rol_name" type="text" class="form-control" id="rol_name" placeholder="Nombre del rol" required>
                                </div>
                                <div class="form-group">
                                    <label for="rol_name">Contacto - Email</label>
                                    <input name="rol_name" type="text" class="form-control" id="rol_name" placeholder="Nombre del rol" required>
                                </div>
                                <div class="form-group">
                                    <label for="rol_description">Asignadao a</label>
                                    <select type="textarea" class="form-control" id="rol_description" placeholder="Descripción de actividad" required></select>
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
    $(document).ready(function(){
        $('#new_rol_form').validate({
            rules:{
                rol_name:{
                    required: true,
                    remote: '../../web_services/web/rols/validation_rol_name.php'
                },
                messages:{
                    rol_name:{
                        required: 'Por favor ingresa el nombre del rol',
                        remote: 'El rol ya se encuentra registrado'
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


