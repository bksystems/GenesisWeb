<?php
    include('..//controllers//session_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
   <?php
   	$title_page = "Estructura Sucrusales"; 
   	include('..//template_plugins//pages_template_head.php');
   ?>
</head>
<body>
	
	<?php
 	 	include('..//template_plugins//pages_template_menu.php');
  	?>

	<div class="container-fluid">
    <div class="card">
        <div class="card-header">Listado de sucursales</div>
        <div class="card-body">
            <table id="table_direction" class="table table-hover table-striped" style="font-size: 10px;">
                <thead>
                    <tr>
                        <th>Dirección</th>
                        <th>Subdirección</th>
                        <th>Región</th>
                        <th>Oficina</th>
                        <th>Tipo Oficina</th>
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
    $(document).ready(function() {
        $('#table_direction').DataTable({
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
                url: '../../web_services/web/structure/web_json_get_structure.php',
                dataSrc: 'data',
                type: 'POST'
              },
              columns: [
                {data: 'direction'},
                {data: 'subdirection'},
                {data: 'region'},
                {data: 'office'},
                {data: 'type'}
            ]
        });
    });
</script>
