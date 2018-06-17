var map;
var markers = [];

function initMap() {
    var haightAshbury = {lat: 23.429709, lng: -102.670939};

   map = new google.maps.Map(document.getElementById('map_view'), {
        center: haightAshbury,
        zoom: 4.9,
        //mapTypeId: 'terrain'
    });

    map.addListener('click', function(){
        addMarker(event.LatLng);
    });
    
}

function addMarker(location, type, name, status, open_operation, close_operation){
    var tipo_nombre = "";
    var image =  "";
    if(type == 1){
        tipo_nombre = "Oficina de servicio";
        image = "../../content/images/icons_maps/os_pin_1.png"
    }else if(type == 2){
        tipo_nombre = "Sucursal dentro de OS";
        if(status == 0){
            image = "../../content/images/icons_maps/os_pin_2.png"
        }else{
            image = "../../content/images/icons_maps/os_pin_3.png"
        }
    } else if(type == 3){
        tipo_nombre = "Sucursal bancaria";
        if(status == 0){
            image = "../../content/images/icons_maps/os_pin_2.png"
        }else{
            image = "../../content/images/icons_maps/os_pin_3.png"
        }
    }  

    var marker = new google.maps.Marker({
        position: location,
        map: map,
        draggable: false,
        icon: image,
        //animation: google.maps.Animation.BOUNCE 
        animation: google.maps.Animation.DROP 
    });
   
    var contente_string = '<div class="card"><div class="card-header"><strong>' + tipo_nombre 
                        + '</strong></div><div class="card-body">Nombre: '+ name+ '<p></p>D/H Apertura: ' + open_operation 
                        + '<p></p>D/H Apertura: ' + close_operation + '</div></div>';
    var infoWindow = new google.maps.InfoWindow({
        content: contente_string
    });

    marker.addListener('click', function(){
        infoWindow.open(map, marker);
    });

    markers.push(marker);
}

function setMapOnAll(map){
    for(var i = 0; i < markers.length; i++){
        markers[i].setMap(map);
    }
}

function clearMarkers(){
    setMapOnAll(null);
}

function deleteMarkers(){
    clearMarkers();
    markers = [];
}



function load_json_ubications(type_filter){
        
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../../web_services/web/structure/web_json_get_ubications.php',
        data:{
            'type_filter': type_filter,
            'operation_date': '2018-06-15'
        },
        success: function(data){
        if(data.result = true){
            deleteMarkers();
            $.each(data.data, function(index, value){
                //PrintMarker(value.Latitude,value.Longitude,value.name);
                addMarker(new google.maps.LatLng(value.Latitude, value.Longitude), value.type_office, value.name, value.status, value.open_operation, value.close_operation);
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