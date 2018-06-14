<!DOCTYPE html>
<html>
<head>
   <?php
   	$title_page = "Actividades en campo Génesis"; 
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Mapa</div>
                    <div class="card-body">
                        <div style="height: 550px; width: 100%;" id="map_view"></div>
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
    });

    $('#cb_type_offices').change(function(){
        var type_filter = this.value;
        load_json_ubications(type_filter);
    });

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByZvvvF1hsx3_URbjDFflPvkKkUZ8UYAc&callback=initMap" async defer>
</script>
   

