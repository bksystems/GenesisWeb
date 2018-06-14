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
    <div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Direcciones
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
      <table id="table_direction" class="table tble-hover table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Dirección</th>
            </tr>
        </thead>
       </table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Subdirecciones
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
         Regiones
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingOffice">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOffice" aria-expanded="false" aria-controls="collapseOffice">
         Oficinas
        </button>
      </h5>
    </div>
    <div id="collapseOffice" class="collapse" aria-labelledby="headingOffice" data-parent="#accordionExample">
      <div class="card-body">
       
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
              url: '../../web_services/web/structure/web_json_get_directions.php',
              dataSrc: 'data'
              },
              columns: [
                {data: 'id'},
                {data: 'direction'}
            ]
        });
    } );
</script>
