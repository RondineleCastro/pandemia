// Geolocation API
var frm_search = $("#localizacao");
var frm_lat = $('#ocorrencia-latitude');
var frm_long = $('#ocorrencia-longitude');
// let my_local = { lat: -5.0317177, lng: -42.8143447 };
var my_local = { lat: -5.0928564, lng: -42.8150236 };

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        frm_search.val("Geolocation não é suportado por este navegador.");
    }
}

function showPosition(position) {

    my_local.lat = position.coords.latitude;
    my_local.lng = position.coords.longitude;

    // $("[for='localizacao']").addClass('active');

    frm_lat.val(my_local.lat);
    frm_long.val(my_local.lng);
    
    
    // desenhar o marcador no maps
    let point = new google.maps.LatLng(my_local.lat, my_local.lng);
    deleteMarkers();
    addMarker(point);
    map.setCenter(point);
    cityByLatLng(my_local.lat, my_local.lng);
}



$(document).ready( function(){
    //Verificar posição atual qndo carregar a página
    getLocation();
    
    $("#btn-my-local").click(function(){
        getLocation();
    });
});

//Mapa Google
var map = '';
var markers = [];


function initMap() {
    // lat: -5.0928564000000005, lng: -42.815023599999996
    map = new google.maps.Map(document.getElementById("map-canvas"), {
        zoom: 15,
        center: my_local, //{ lat: -5.0928564, lng: -42.8150236 }
        // mapTypeId: google.maps.MapTypeId.HYBRID,
        mapTypeId:'roadmap',
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: false,
        zoomControl: false,
    });
    // Criar marcador na inicialização do Map
    // var point = new google.maps.LatLng(-5.0928564000000005, -42.815023599999996);
    let point = new google.maps.LatLng(my_local.lat, my_local.lng);
    
    addMarker(point);
    // var marker = new google.maps.Marker({
    //     map: map,
    //     position: point,
    //     // icon: icones[iconindex].icon,
    //     // label: {text: labelacoes, fontWeight: "bold", fontSize: "12px", color:"#03f"}
    //     //icon: icons[type].icon
    // });
    
    // Pesquisar no mapa o endereço passado no input
    const geocoder = new google.maps.Geocoder();
    $("#btn-search").click(function(){
        geocodeAddress(geocoder, map);

    });
    // Desabilitar o ENTER key para click no btn-search
    frm_search.keypress(function(e) {
        var keyCode = (e.keyCode ? e.keyCode : e.which);
        if (keyCode === 13) {
            e.preventDefault();
            $("#btn-search").click();
        }

        // $(this).val().length === 0 ? $('#btn-clear-srch').hide() : $('#btn-clear-srch').show();
    });
    frm_search.change(function(e){
        $("#btn-search").click();
    });


    // frm_search.on('change', function(){ console.log($(this).val()) });

    //função que "ouve" o click no mapa e adiciona o marcador
    map.addListener('click', function(event) { 

        deleteMarkers();
        addMarker(event.latLng);
        
        my_local.lat = event.latLng.lat();
        my_local.lng = event.latLng.lng();

        cityByLatLng(my_local.lat, my_local.lng);
        
        frm_lat.val(my_local.lat);
        frm_long.val(my_local.lng);
        
        // $("[for='localizacao']").addClass('active');
    });
    
}

//google.maps.event.addDomListener(window, 'load', initialize);
function cityByLatLng(latitude, longitude) {
    var geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(latitude, longitude);
    geocoder.geocode({'location': latlng}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                frm_search.val(results[0].formatted_address);
                // $("[for='localizacao']").addClass('active');
                //document.getElementById('BAIRRO').value = results[0].address_components[2].long_name;
            } else {
                frm_search.val("[" + status + "]  Opsss... não encontramos resultado para esta pesquisa :(");
                // window.alert('No results found');
            }
        } else {
            frm_search.val("[" + status + "]  Opsss... não encontramos resultado para esta pesquisa :(");
            // window.alert('Geocoder failed due to: ' + status);
        }
    });
}

// Função que adiciona o marcador no mapa
function addMarker(location) {
    var marker = new google.maps.Marker({
        map: map,
        position: location
    });
    markers.push(marker);
}

// função que seta os marcadores no mapa
function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
}

// Remove os marcadores do mapa, mas ficam guardados no array
function clearMarkers() {
    setMapOnAll(null);
}

// Deleta todos os marcadores do array e a referencia deles
function deleteMarkers() {
    clearMarkers();
    markers = [];
}

    
    // console.log("markers"+marker.toString());
    // marcadores.push(marker);
    // marker.addListener('click', function() {
    //     infoWindow.setContent(infowincontent);
    //     infoWindow.open(map, marker);
    // });


function geocodeAddress(geocoder, resultsMap) {
    const address = $("#localizacao").val();
    
    if (address != "") {
        geocoder.geocode({ address: address }, (results, status) => {
            if (status === "OK") {
                
                resultsMap.setCenter(results[0].geometry.location);

                for (let i = 0; i < markers.length; i++) {
                    markers[i].setMap(null);
                }
                // console.log(results[0].geometry.location);
                // Marcador.
                marker = new google.maps.Marker({
                    position: results[0].geometry.location,
                    title: address,
                    map: resultsMap
                });
                markers.push(marker);
                    
                var infowindow = new google.maps.InfoWindow(), marker;
                //Conteúdo da caixa de informações exibida com o click.
                var contentString =
                    '<div id="content">' +
                    '<div id="siteNotice">' +
                    "</div>" +
                    '<h5 id="firstHeading" class="firstHeading"><span style="background: blue; color: white; padding: 2px;">Endereço pesquisado</span></h5>' +
                    '<div id="bodyContent">' +
                    "<p>"+ address +"</p>" +
                    "</div>" +
                    "</div>";
                
                infowindow.setContent(contentString);
                
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    
                    return function(contentString) {
                        infowindow.open(map, marker);
                    }
                    
                })(marker))
                map.zoom = 15;

                // Modificar
                geocoder.geocode({'location': results[0].geometry.location}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            frm_lat.val(results[0].geometry.location.lat());
                            frm_long.val(results[0].geometry.location.lng());
                            frm_search.val(results[0].formatted_address);
                            //document.getElementById('BAIRRO').value = results[0].address_components[2].long_name;
                        }
                    }
                });
              
            } else {
                frm_search.val("[" + status + "]  Opsss... não encontramos resultado para esta pesquisa :(");
            }
        }); 
    } 
}
// End Mapa Google