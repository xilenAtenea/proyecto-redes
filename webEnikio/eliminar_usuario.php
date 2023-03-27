<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cc = $_POST["cc"];


    // Realiza la eliminación del usuario
    $url = "http://localhost:3001/usuarios/" . $cc;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    $response = curl_exec($curl);
    curl_close($curl);

    // Redirige a la página de administración de usuarios
    header("Location: usuariosadmin.php");
}
