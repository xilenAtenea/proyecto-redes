<?php
session_start();
$nombre = $_SESSION["nombre"];
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
$body = json_encode(array("coord" => $input));
$ch = curl_init($servurl2);
curl_setopt($ch, CURLOPT_URL, "http://localhost:3002/coords"); // establece la URL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // indica que se debe recibir el resultado como un string
curl_setopt($ch, CURLOPT_POST, true); // indica que se trata de un POST request
curl_setopt($ch, CURLOPT_POSTFIELDS, $body); // establece el contenido del body en formato JSON
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$result = curl_exec($ch);

// cierra la sesión de curl
curl_close($ch);

$resp = json_decode($result)

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ESCOJA SU UNIVERSIDAD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">ENIKIO</div>
            <div class="list-group list-group-flush my-3">
                <a href="admin.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-project-diagram me-2" style="color: #10c671;"></i>Dashboard</a>
                <a href="universidadesadmin.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i class="fas fa-university me-2" style="color: #10c671;"></i>Ver apartamentos</a>
                <a href="usuariosadmin.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-user me-2" style="color: #10c671;"></i>Administrar usuarios</a>
                <a href="universidadesadmin.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-arrow-left fa me-2"  style="color: #10c671;"></i>Volver</a>
                <a href="login.html" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Apartamentos <?php echo (str_replace("_", " ", $universidad)) ?></h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php print_r($nombre) ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="login.html">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid px-4">
                <div class="mt-5 container-sm">
                    <!-- <h1 class="text-center">Apartamentos cerca de <br> <?php //echo (str_replace("_", " ", $universidad)) ?></h1> -->
                    <div class="col">
                        <div style="height: 500px; overflow: auto;">
                            <table class="table bg-white rounded shadow-sm  table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Habitaciones</th>
                                        <th scope="col">Distancia</th>
                                        <th scope="col">Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $long = count($resp);
                                    for ($i = 0; $i < $long; $i++) {
                                        $dec = $resp[$i];
                                        $id_apto = $dec->id_apto;
                                        $precio = $dec->precio;
                                        $cant_h = $dec->cant_h;
                                        $distancia = $dec->distance_km;
                                        $link = $dec->link;
                                    ?>
                                        <tr>
                                            <td><?php echo ($id_apto); ?></td>
                                            <td><?php echo ($precio); ?></td>
                                            <td><?php echo ($cant_h); ?></td>
                                            <td><?php echo ($distancia) . "Km"; ?></td>
                                            <td><a href="<?php echo ($link); ?>">Link</a></td>
                                        <?php
                                    }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>

</body>