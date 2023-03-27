<?php
// session_start();
// $us = $_SESSION["usuario"];
// if ($us == "") {
//     header("Location: index.html");
// } 192.168.100.2

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $name => $value) {
        if (strpos($name, '/') !== false) {
            // Dividir el nombre del parametro en ID e inventario
            $id_apto = explode("/", $name)[0]; // Obtenemos el ID del producto
            $cantidad = $value;
            $cant_h = $_POST[$id_apto . '/cant_h'];
            if ($cantidad != NULL && $cantidad <= $cant_h) {
                $item = array("hab_disponibles" => $cantidad); //Creamos el objecto con el producto y su cantidad
                $json = json_encode($item);
                $url = "http://localhost:3002/aptos/$id_apto";
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($json)
                    )
                );

                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if ($http_status == 200) {
                    echo '<script>alert("Se actualizo exitosamente el inventario!")</script>';
                    header("Location: arrendador.php");
                } else {
                    echo "Hubo un error al crear tu orden, intentalo de nuevo" . $http_status;
                }

                curl_close($ch);
            }
        }
    }
}