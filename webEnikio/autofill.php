<?php
// Conectar a la base de datos y hacer una consulta para obtener los datos del usuario correspondientes a la cédula ingresada
$cedula = $_POST["cedula"];
$result= "http://localhost:3001/usuarios/autofill"


// Devolver los datos del usuario en formato JSON
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $data = array("nombre" => $row["nombre"], "email" => $row["email"], "celular" => $row["celular"]);
  echo json_encode($data);
} else {
  echo "{}";
}
?>