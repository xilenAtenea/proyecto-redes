<?php 

$universidad = $_GET["comp_select"];
$servurl = "http://localhost:3002/aptos/coords/$universidad";
$servurl2 = "http://localhost:3002/coords";

$curl = curl_init($servurl);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
$response = curl_exec($curl);
curl_close($curl);

if ($response === false) {
    // header("Location:index.html");
    echo "No hay nada en la response";
}


$coords = json_decode($response, true)['coord']; 
$input = "POINT({$coords['x']} {$coords['y']})";
$body = json_encode(array("coord" => $input)); //{["coord": "POINT({$coords['x']} {$coords['y']})" ]}
$ch = curl_init($servurl2);
curl_setopt($ch, CURLOPT_URL, "http://localhost:3002/coords"); // establece la URL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // indica que se debe recibir el resultado como un string
curl_setopt($ch, CURLOPT_POST, true); // indica que se trata de un POST request
curl_setopt($ch, CURLOPT_POSTFIELDS, $body); // establece el contenido del body en formato JSON
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$result = curl_exec($ch); //Toda la info de los aptos cercanos a la u

// cierra la sesión de curl
curl_close($ch);

$resp = json_decode($result); // { "coord": x: 76678 , y: 76786876}

$latU = $coords['x'];
$longU = $coords['y'];


foreach ($resp as $item) {
  $lat = $item->coord->x;
  $long = $item->coord->y;
  
}


?>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.awesome-markers/2.1.0/leaflet.awesome-markers.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.awesome-markers/2.1.0/leaflet.awesome-markers.min.js"></script>
    <title>Maps</title>
  </head>
  <body>
    <div id='map' style="width: 100%; height: 100vh;"></div>
    <script type="text/javascript"> 
      var map = L.map('map').setView([<?php echo $latU ?>, <?php echo $longU ?>], 13); //setView coordenadas de la universidad escogida.
      L.tileLayer('https://api.maptiler.com/maps/basic/256/{z}/{x}/{y}.png?key=dVhthbXQs3EHCi0XzzkL',{
        attribution:
        '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
      }).addTo(map);

      var redIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      var markerU = L.marker([<?php echo $latU ?>, <?php echo $longU ?>], { icon: redIcon }).addTo(map);
      markerU.bindPopup("<?php echo(str_replace("_", " ", $universidad)) ?>");

      <?php foreach ($resp as $item) { ?>
        var lat = <?php echo $item->coord->x ?>;
        var long = <?php echo $item->coord->y ?>;
        var marker = L.marker([lat, long]).addTo(map);
        marker.bindPopup("<?php 
        echo "<a href='$item->link'> Ir a FincaRaiz </a><br>";
        echo "Precio: $item->precio<br>";
        echo "Habitaciones disponibles: $item->hab_disponibles / $item->cant_h<br>";
        echo "<form action='forms.php' method='post'>";
        echo "<input type='hidden' name='id_apto' value='$item->id_apto'>";
        echo "<input type='submit' value='POSTULARME'>";
        echo "</form>";
        ?>");
      <?php } 
      
      ?>


          
    </script>
  </body>
</html>






