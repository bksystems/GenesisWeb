function load_directions(){
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: '../../web_services/web/structure/web_json_get_directions.php',
    success: function(data){
      if(data.result = true){
        $('#cb_direcction').html("");
        var toAppend = '<option value="0">Todas</option>';
        $.each(data.data, function(index, value){
          toAppend += '<option value=' + value.id + '>'+ value.direction + '</option>';
        });
        $('#cb_direcction').append(toAppend);
      }else{
        alert('Error');
      }
    },
    error:function(data){
      alert(data);
    },
    complete:function(){
      $("#cb_direcction").val(0);
    }
  });
}

function load_subdirections(id_dir){
  $('#cb_subdirection').removeAttr("disabled");
  $('#cb_region').html("");
  $('#cb_region').prop('disabled', 'disabled');
  $('#cb_office').html("");
  $('#cb_office').prop('disabled', 'disabled');
  $.ajax({
    type: 'POST',
    dataType: 'json',
    data:{
      'direction_id': id_dir
    },
    url: '../../web_services/web/structure/web_json_get_subdirections_by_direction.php',
    success: function(data){
      if(data.result = true){
        $('#cb_subdirection').html("");
        var toAppend = '<option value="0">Todas</option>';
        $.each(data.data, function(index, value){
          toAppend += '<option value=' + value.id + '>'+ value.subdirection + '</option>';
        });
        $('#cb_subdirection').append(toAppend);
      }else{
        alert('Error');
      }
    },
    error:function(data){
      alert(data);
    },
    complete:function(){
      $("#cb_subdirection").val(0);
    }
  });
}

function load_regions(id_subdir){
  $('#cb_region').removeAttr("disabled");
  $('#cb_office').html("");
  $('#cb_office').prop('disabled', 'disabled');
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: '../../web_services/web/structure/web_json_get_regions_by_subdirection.php',
    data:{
      'subdirection_id': id_subdir
    },
    success: function(data){
      if(data.result = true){
        $('#cb_region').html("");
        var toAppend = '<option value="0">Todas</option>';
        $.each(data.data, function(index, value){
          toAppend += '<option value=' + value.id + '>'+ value.region + '</option>';
        });
        $('#cb_region').append(toAppend);
      }else{
        alert('Error');
      }
    },
    error:function(data){
      alert(data);
    },
    complete:function(){
      $("#cb_region").val(0);
    }
  });
}

function load_offices(id_region){
  $('#cb_office').removeAttr("disabled");
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: '../../web_services/web/structure/web_json_get_offices_by_region.php',
    data:{
      'region_id': id_region
    },
    success: function(data){
      if(data.result = true){
        $('#cb_office').html("");
        var toAppend = '<option value="0">Todas</option>';
        $.each(data.data, function(index, value){
          toAppend += '<option value=' + value.id + '>'+ value.name + '</option>';
        });
        $('#cb_office').append(toAppend);
      }else{
        alert('Error');
      }
    },
    error:function(data){
      alert(data);
    },
    complete:function(){
      $("#cb_office").val(0);
    }
  });
}

function load_years(){
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: '../../web_services/web/structure/web_json_get_years.php',
    success: function(data){
      if(data.result = true){
        $('#cb_year').html("");
        var toAppend = '<option value="0">Todas</option>';
        $.each(data.data, function(index, value){
          toAppend += '<option value=' + value.number_year + '>'+ value.number_year + '</option>';
        });
        $('#cb_year').append(toAppend);
      }else{
        alert('Error');
      }
    },
    error:function(data){
      alert(data);
    },
    complete:function(){
      var currentYear = (new Date).getFullYear();  
		  $("#cb_year").val(currentYear);
    }
  });
}

 var chart_solicitantes;
 var chart_solicitudes;
 var chart_retrabajos;

function update_search_indicators($update_text){
  $('#title_structure_indicators').html($update_text);
}

function init_indicators(){

  var elements_solicitantes = [];   
  var elements_solicitudes = [];   
  var elements_retrabajos = [];   

  var year = (new Date).getFullYear();  

  update_indicators(year, 0, 0);
  update_search_indicators("Nacional - " + year);

  chart_solicitantes= Morris.Bar({
      element: 'graph_solicitantes',
      axes: true,
      data: [{ y: '', a:0, z:0, x:0}],
      barColors: ["#1AB244", "#1531B2" , "#B21516"],
      xkey: 'y',
      ykeys: ['a', 'z', 'x'],
      labels: ['Prospectos', 'DM', 'Papel'],
      xLabelAngle: 35,        
  });

  chart_solicitudes = Morris.Bar({
      element: 'graph_solicitudes',
      axes: true,
      data: [{ y: '', a:0, z:0, x:0}],
      barColors: ["#1AB244", "#1531B2", "#B21516"],
      xkey: 'y',
      ykeys: ['a', 'z', 'x'],
      labels: ['DM', 'Hibridos', 'Papel'],
      xLabelAngle: 35,
  });

  chart_retrabajos = Morris.Line({
      element: 'graph_retrabajos',
      data: [{ year: '', value: 0 }],
      xkey: 'year',
      ykeys: ['value'],
      labels: ['Retrabajos'],
      xLabels: ['month']
  });

  Morris.Donut({
      element: 'graph_renovaciones',
      data: [
      {value: 70, label: 'foo', formatted: 'at least 70%' },
      {value: 15, label: 'bar', formatted: 'approx. 15%' },
      {value: 10, label: 'baz', formatted: 'approx. 10%' },
      {value: 5, label: 'A really really long label', formatted: 'at most 5%' }
      ],
      formatter: function (x, data) { return data.formatted; }
    });
}

function update_indicators(year_consult, type_report, index_consult){

  var elements_solicitantes = [];   
  var elements_solicitudes = [];   
  var elements_retrabajos = [];   

  $.ajax({
    type: 'POST',
    dataType: 'json',
    data:{
      'year': year_consult,
      'type_index': type_report,
      'index_consult': index_consult
    },
    url: '../../web_services/web/indicators/web_get_indicators_json.php',
    success: function(data){
      if(data.result = true){
        var i = 0;
        $.each(data.data.applicants, function(index, value){
          elements_solicitantes[i] = {y: value.Month, a: value.Prospectos, z: value.DM, x: value.Papel};
          i = i + 1;
        });

        var i = 0;
        $.each(data.data.reworks, function(index, value){
          elements_retrabajos[i] = elements_retrabajos[i] = {year: value.year, value: value.value};
          i = i + 1;
        });

        var i = 0;
        $.each(data.data.requests, function(index, value){
          elements_solicitudes[i] = {y: value.Month, a: value.DM, z: value.DM_OS, x: value.Papel};
          i = i + 1;
        });

        chart_solicitantes.setData(elements_solicitantes);
        chart_retrabajos.setData(elements_retrabajos);
        chart_solicitudes.setData(elements_solicitudes);

      }else{
        alert('Error');
      }
    },
    error:function(data){
      alert(data);
    }
  });
  
}