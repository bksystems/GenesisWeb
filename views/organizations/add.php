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
                <div class="card">
                    <div class="card-header">Acciones</div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Ingresar datos</div>
                    <div class="card-body">
                        <div class="container">
                            <form id="form-organization">
                                <div class="form-group row">
                                    <label for="structure_cost_center" class="col-sm-2 col-form-label col-form-label-sm">Centro Costo</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" id="structure_cost_center" placeholder="Centro de costos" disabled>
                                    </div>    
                                </div>
                                <div class="form-group row">
                                    <label for="structure_name" class="col-sm-2 col-form-label col-form-label-sm">Nombre</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="structure_name" class="form-control form-control-sm" id="structure_name" placeholder="Nombre">
                                    </div>    
                                </div>
                                <div class="form-group row">
                                    <label for="structure_organization_father" class="col-sm-2 col-form-label col-form-label-sm">Organización padre</label>
                                    <div class="col-sm-10">
                                        <select class="form-control form-control-sm"  id="structure_organization_father">
                                        </select>
                                    </div>    
                                </div>
                                <div class="form-group row">
                                    <label for="structure_type" class="col-sm-2 col-form-label col-form-label-sm">Tipo estructura</label>
                                    <div class="col-sm-10">
                                        <select class="form-control form-control-sm"  id="structure_type">
                                            
                                        </select>
                                    </div>    
                                </div>
                                <div class="form-group row">
                                    <label for="structure_description" class="col-sm-2 col-form-label col-form-label-sm">Descripción</label>
                                    <div class="col-sm-10">
                                        <textarea type="text"  name="structure_description" class="form-control form-control-sm" id="structure_description"></textarea>
                                    </div>    
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm">Habilitar</label>
                                    <div class="col-sm-10">
                                        <div class="form-check form-control-sm">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox"> Habilitar estrucura
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                                    </div>
                                </div>
                            </form>
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
    $(document).ready(function(){
        $('#form-organization').validate({
            rules:{
                structure_name:{
                    required:true
                },
                structure_description:{
                    required:true
                }
            },
            messages:{
                structure_name:{
                    required: 'Ingresa el nombre de la estructura'
                },
                structure_description:{
                    required:'Ingresa la descripción de la estructura'
                }
            },
			errorElement: "em",
            errorPlacement: function ( error, element ) {
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

        $.ajax({
            url: '../../web_services/web/organizations/web_get_type_organization.php',
            dataType: 'json', 
            cache: false,
            contentType: false,
            processData: false,             
            type: 'GET',
            success: function(data){
                if(data.result = true){
                    $('#structure_type').html("");
                    var toAppend = '';
                    $.each(data.data, function(index, value){
                        toAppend += '<option value=' + value.id + '>'+ value.type + '</option>';
                    });
                    $('#structure_type').append(toAppend);
                }else{
                    alert('Error');
                }        
            },
            error:function(data){
                alert(data);
            }
        })

         $.ajax({
            url: '../../web_services/web/organizations/web_get_organizations_structure.php',
            dataType: 'json', 
            cache: false,
            contentType: false,
            processData: false,             
            type: 'GET',
            success: function(data){
                if(data.result = true){
                    $('#structure_organization_father').html("");
                    var toAppend = '';
                    $.each(data.data, function(index, value){
                        toAppend += '<option value=' + value.id + '>'+ value.cost_center + ' - ' + value.structure_name + '</option>';
                    });
                    $('#structure_organization_father').append(toAppend);
                }else{
                    alert('Error');
                }        
            },
            error:function(data){
                alert(data);
            }
        })

         $.ajax({
            url: '../../web_services/web/organizations/web_services_organizations.php',
            dataType: 'json', 
            cache: false,
            contentType: false,
            processData: false,             
            type: 'GET',
            data:{method: 'get_next_costo_center'},
            success: function(data){
                if(data.result = true){
                    $('#structure_cost_center').val('S' + data.data[0].next);
                }else{
                    alert('Error');
                }        
            },
            error:function(data){
                alert(data);
            }
        })

    });
</script>

