<?php 



function postData($url, $data) {
    $ch = curl_init($url);
    $body = json_encode($data);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

$id_apto = $_POST["id_apto"];
$nombre = $_POST["nombre"];
$cedula = $_POST["cedula"];
$email = $_POST["email"];
$celular = $_POST["celular"];
$ocupacion = $_POST["ocupacion"];
$interes = $_POST["interes"];

// Primera ruta
$url1 = "http://localhost:3001/usuarios/crearpostulado";
$data1 = array(
    "nombre" => $nombre,
    "cc" => $cedula,
    "email" => $email,
    "celular" => $celular
);

$response1= postData($url1, $data1);


//echo $response1;


// Segunda ruta
$url2 = "http://localhost:3003/postu/crearpostulacion";
$data2 = array(
    "id_apto" => $id_apto,
    "cc_postulado" => $cedula,
    "ocupacion" => $ocupacion,
    "interes" => $interes
);
$response2 = postData($url2, $data2);

header("Location:universidades2.php")

// ... Código restante
?>