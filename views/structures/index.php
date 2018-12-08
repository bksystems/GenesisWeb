<?php
    include('..//controllers//detail.php');
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
        <div class="row">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">Acciones</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="add.php"><span class="glyphicon glyphicon-plus"></span> Crear nuevo</a></li>
                            <li class="list-group-item"><a href="#"><span class="glyphicon glyphicon-list"></span> Listado tipos</a></li>
                             <li class="list-group-item">Vestibulum at eros</li>
                        </ul>
                </div>
            </div>
            <div class="col-md-10">
                 <div class="card">
                    <div class="card-header">Listado de sucursales</div>
                    <div class="card-body">
                        <table id="table_direction" 
                                class="table table-hover table-striped" 
                                style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Dirección</th>
                                    <th>Subdirección</th>
                                    <th>Región</th>
                                    <th>Oficina</th>
                                    <th>Tipo</th>
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
