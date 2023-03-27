<?php
$user = $_POST["email"];
$pass = $_POST["password"];
$servurl = "http://localhost:3001/usuarios/$user/$pass";
$curl = curl_init($servurl);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

if ($response === false) {
    // header("Location:index.html");
    echo "No hay nada en la response";
}
$resp = json_decode($response);

// print_r($resp);
if (count($resp) != 0) {
    session_start();
    $dec = $resp[0];
    $nombre = $dec -> nombre;
    $rol = $dec -> rol;
    $cc = $dec -> cc;
    $_SESSION["usuario"] = $user;
    $_SESSION["rol"] = $rol;
    $_SESSION["cc"] = $cc;
    $_SESSION["nombre"] = $nombre;
    if ($rol == "arrendador") {
        echo "arrendador";
        header("Location:arrendador.php");
    } else if ($rol == "admin"){
        echo "admin";
        header("Location:admin.php");
    }
} else {
    // header("Location:index.html");
    echo $response;
    echo "response fallida";
}
