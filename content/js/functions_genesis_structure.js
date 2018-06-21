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
        var toAppend = '';//'<option value="0">Todas</option>';
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



