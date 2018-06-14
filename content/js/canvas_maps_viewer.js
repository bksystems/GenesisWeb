var map;

function initMap() {
    
   map = new google.maps.Map(document.getElementById('map_view'), {
        center: {lat: 23.429709, lng: -102.670939},
        zoom: 4.8
    });
    
}

function PrintMarker(lat, lon, name, type){
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lon),
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP
    });

       
}

function load_json_ubications(type_filter){
        
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../../web_services/web/structure/web_json_get_ubications.php',
        data:{
            'type_filter': type_filter
        },
        success: function(data){
        if(data.result = true){

            $.each(data.data, function(index, value){
                PrintMarker(value.Latitude,value.Longitude,value.name);
            });

        }else{
            alert('Error');
        }
        },
        error:function(data){
            alert(data);
        },
        complete:function(){
           
        }
    });
}

function load_types_offices(){
       
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../../web_services/web/structure/web_json_get_types_offices.php',
        success: function(data){
            if(data.result = true){
                $('#cb_type_offices').html("");
                var toAppend = '<option value="0">Todo</option>';
                $.each(data.data, function(index, value){
                    toAppend += '<option value=' + value.id + '>'+ value.type + '</option>';
                });
                $('#cb_type_offices').append(toAppend);
            }else{
                alert('Error');
            }
        },
        error:function(data){
            alert(data);
        },
        complete:function(){
            $("#cb_type_offices").val(0);
        }
    });
}