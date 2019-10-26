<?php $hola = "L.latLng(9.919785, -84.054508),
                L.latLng(9.919347, -84.054671),
                L.latLng(9.918914, -84.055176) "; ?>
                
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
  <title>Geolocalizacion</title>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
   <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
   integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
   crossorigin=""></script>
   
  
    <!--estos links son importantes para poder dibujar -->
    <link rel="stylesheet" href="leaflet-routing-machine-3.2.12\dist\leaflet-routing-machine.css">
    
    <script type="text/javascript" src="leaflet-routing-machine-3.2.12\dist\leaflet-routing-machine.js">
    </script>
    
    
    <style>
                #mapid { 
                    height:500px;
                    width: 500px;
                }
    </style>
       
</head>

   <body>
       <div>
           
           
       </div>
       
        <div id="mapid">
        
        <!--poner el script dentro del div obligatoriamente-->
        <script type="text/javascript">
            //muestro el mapa con su respectivo zoom
            var mymap = L.map('mapid').setView([9.9198 , -84.0527], 15);
            
            //pongo las caracteristicas del mapa que importé
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
	            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a  href="https://www.mapbox.com/">Mapbox</a>',
	            maxZoom: 18,
                id: 'mapbox.streets', //utilizo vista de calles
                accessToken: 'pk.eyJ1IjoiYWJlcnRvenppIiwiYSI6ImNrMHBpYjZjdTA2bTgzbm10ODZmZG5wd2gifQ.DHV3hXMsfTP_IqD5kzPMaA'
            }).addTo(mymap);
            
            //esta es para calcular la ruta y le doy mi token
            L.Routing.control({
                router: L.Routing.mapbox('pk.eyJ1IjoiYWJlcnRvenppIiwiYSI6ImNrMHBpYjZjdTA2bTgzbm10ODZmZG5wd2gifQ.DHV3hXMsfTP_IqD5kzPMaA')
            }).addTo(mymap);
            
        
            
            
            var popup = L.popup();
            var PuntosLatLn = [];
            var popup = L.popup();
            
            
            
            L.Routing.control({
                    waypoints: [<?php   echo $hola ;?>
                    ],routeWhileDragging: true
                }).addTo(mymap);
            
           
            function onMapClick(e) {
                popup
                    .setLatLng(e.latlng)
                    .setContent("You clicked the map at " + e.latlng.toString())
                    .openOn(mymap);
                
            }
            //llamada a la funcion de onclick
            mymap.on('click', onMapClick);
            
            
            
            function dibujarRuta(){
                
                /*
                L.Routing.control({
                    waypoints: PuntosLatLn,
                    routeWhileDragging: true
                }).addTo(mymap);*/
            }
            
                
        </script>
        
       </div>
   
   
    
   


    </body>
</html>
