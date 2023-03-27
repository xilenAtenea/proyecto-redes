<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ESCOJA LA UNIVERSIDAD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    session_start();
    $nombre = $_SESSION["nombre"];
    $metricsUrl = "http://localhost:3002/metrics";
    $metricsCurl = curl_init($metricsUrl);
    curl_setopt($metricsCurl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($metricsCurl, CURLOPT_CUSTOMREQUEST, "GET");
    $metricsResponse = curl_exec($metricsCurl);
    curl_close($metricsCurl);
    $metricsResp = json_decode($metricsResponse);
    if ($metricsResponse === false) {
        // header("Location:index.html");
        echo "No hay nada en la response";
    }
    $aptos_uao = $metricsResp->aptos_uao;
    $aptos_antonio_jose = $metricsResp->aptos_antonio_jose;
    $aptos_san_bue = $metricsResp->aptos_san_bue;
    $aptos_libre = $metricsResp->aptos_libre;
    $aptos_cooperativa = $metricsResp->aptos_cooperativa;
    $aptos_icesi = $metricsResp->aptos_icesi;
    ?>
    <div class="d-flex" id="wrapper">
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">ENIKIO</div>
            <div class="list-group list-group-flush my-3">
                <a href="admin.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-project-diagram me-2" style="color: #10c671;"></i>Dashboard</a>
                <a href="universidadesadmin.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i class="fas fa-university me-2" style="color: #10c671;"></i>Ver apartamentos</a>
                <a href="usuariosadmin.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-user me-2" style="color: #10c671;"></i>Administrar usuarios</a>
                <a href="login.html" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Apartamentos</h2>
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
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $aptos_uao ?></h3>
                                <p class="fs-5">Aptos cerca de <br> la Autonoma</p>
                            </div>
                            <i class="fas fa-building fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $aptos_antonio_jose ?></h3>
                                <p class="fs-5">Aptos cerca de <br> la Antonio Jose</p>
                            </div>
                            <i class="fas fa-building fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $aptos_san_bue ?></h3>
                                <p class="fs-5">Aptos cerca de <br> la San Buenaventura</p>
                            </div>
                            <i class="fas fa-building fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $aptos_libre ?></h3>
                                <p class="fs-5">Aptos cerca de <br> la Libre</p>
                            </div>
                            <i class="fas fa-building fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $aptos_cooperativa ?></h3>
                                <p class="fs-5">Aptos cerca de <br> la Cooperativa</p>
                            </div>
                            <i class="fas fa-building fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $aptos_icesi ?></h3>
                                <p class="fs-5">Aptos cerca de <br> la Icesi</p>
                            </div>
                            <i class="fas fa-building fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                    <div class="mt-5 container-sm">
                        <h1 class="text-center">ESCOJA LA UNIVERSIDAD</h1>
                        <form class="mt-5" action="aptosadmin.php" method="get">
                            <?php
                            $servurl = "http://localhost:3002/universidades";
                            $curl = curl_init($servurl);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
                            $response = curl_exec($curl);
                            curl_close($curl);

                            if ($response === false) {
                                // header("Location:index.html");
                                echo "No hay nada en la response";
                            }
                            $resp = json_decode($response);
                            $long = count($resp);
                            ?>
                            <select name="comp_select" class="form-select form-select-lg mb-3" aria-label="Default select example">
                                <?php
                                for ($i = 0; $i < $long; $i++) {
                                    $dec = $resp[$i];
                                    $universidad = $dec->nombre;

                                ?>
                                    <option value="<?php echo $universidad ?>"><?php echo (str_replace("_", " ", $universidad)) ?></option>
                                <?php
                                }

                                ?>
                            </select>
                            <button class="btn btn-primary" type="submit" style="background-color: #0F843B">BUSCAR</button>
                        </form>
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

</html>