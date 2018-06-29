<?php
    include('..//controllers//detail.php');
?>
<!DOCTYPE html>
<html>
<head>
   <?php
   	$title_page = "Ubicación de sucursales"; 
   	include('..//template_plugins//pages_template_head.php');
   ?>
   <script type="text/javascript" src="../../content/js/canvas_maps_viewer.js"></script>
</head>
<body>
	
	<?php
 	 	include('..//template_plugins//pages_template_menu.php');
  	?>

	<div class="container-fluid">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cb_type_offices">Mostra por tipo: </label>
                    <select id="cb_type_offices" class="form-control form-control-sm"></select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Mapa</div>
                    <div class="card-body">
                        <div style="height: 550px; width: 100%;" id="map_view"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Listado de sucursales</div>
                    <div class="card-body">
                        <table id="table_sucursales" class="table table-hover table-striped" style="font-size: 11px;">
                            <thead>
                                <tr>
                                    <th>Sucursal</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th>Inicio de operación</th>
                                    <th>Cierre de operacion</th>
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
        load_types_offices();
        load_json_ubications(0);
        $('#table_sucursales').DataTable({
            ajax:{
                url: '../../web_services/web/structure/web_json_get_ubications.php',
                dataSrc: 'data',
                data:{'type_filter': 0, 'operation_date': '2018-06-15'},
                type: 'POST'
            },
            columns:[
                {data: 'name'},
                {data: 'type'},
                {data: 'status_name'},
                {data: 'open_operation'},
                {data: 'close_operation'}

            ]
        });
    });

    

    $('#cb_type_offices').change(function(){
        var type_filter = this.value;
        load_json_ubications(type_filter);
    });

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByZvvvF1hsx3_URbjDFflPvkKkUZ8UYAc&callback=initMap" async defer>
</script>
   

