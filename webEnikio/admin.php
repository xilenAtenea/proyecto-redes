<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
    <title>ENIKIO</title>
</head>

<body>
    <?php
    session_start();
    $nombre = $_SESSION["nombre"];
    $us = $_SESSION["usuario"];
    $rol = $_SESSION["rol"];
    $cc = $_SESSION["cc"];
    if ($rol == "") {
        header("Location: index.html");
    }
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
    $num_aptos = $metricsResp->num_aptos;
    $num_postu = $metricsResp->num_postu;
    $aptos_icesi = $metricsResp->aptos_icesi;
    $aptos_over_2_hab_dispo = $metricsResp->aptos_over_2_hab_dispo;
    $aptos_uao = $metricsResp->aptos_uao;
    $aptos_antonio_jose = $metricsResp->aptos_antonio_jose;
    $aptos_san_bue = $metricsResp->aptos_san_bue;
    $aptos_libre = $metricsResp->aptos_libre;
    $aptos_cooperativa = $metricsResp->aptos_cooperativa;
    $usuarios = $metricsResp->arrendadores;

    ?>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">ENIKIO</div>
            <div class="list-group list-group-flush my-3">
                <a href="admin.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i class="fas fa-project-diagram me-2" style="color: #10c671;"></i>Dashboard</a>
                <a href="universidadesadmin.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-university me-2" style="color: #10c671;"></i>Ver apartamentos</a>
                <a href="usuariosadmin.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-user me-2" style="color: #10c671;"></i>Administrar usuarios</a>
                <a href="login.html" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
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
                                <h3 class="fs-2"><?php print_r($num_aptos) ?></h3>
                                <p class="fs-5">Total de <br> apartamentos</p>
                            </div>
                            <i class="fas fa-building fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php print_r($num_postu) ?></h3>
                                <p class="fs-5">Postulaciones</p>
                            </div>
                            <i class="fas fa-mail-bulk fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php print_r($aptos_over_2_hab_dispo) ?></h3>
                                <p class="fs-5">aptos con 2<br>habitaciones<br>disponibles</p>
                            </div>
                            <i class="fas fa-check fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php print_r($usuarios) ?></h3>
                                <p class="fs-5">Arrendadores</p>
                            </div>
                            <i class="fas fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Aptos disponibles</h3>
                    <div class="col">
                        <div style="height: 500px; overflow: auto;">
                            <table class="table bg-white rounded shadow-sm  table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Num</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Habitaciones</th>
                                        <th scope="col">Habitaciones<br>disponibles</th>
                                        <th scope="col">LINK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $servurl = "http://localhost:3002/apartamentos";
                                    $curl = curl_init($servurl);
                                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                    $response = curl_exec($curl);
                                    if ($response === false) {
                                        curl_close($curl);
                                        die("Error en la conexion");
                                    }
                                    curl_close($curl);
                                    $resp = json_decode($response);
                                    $long = count($resp);
                                    for ($i = 0; $i < $long; $i++) {
                                        $dec = $resp[$i];
                                        $id_apto = $dec->id_apto;
                                        $precio = $dec->precio;
                                        $cant_h = $dec->cant_h;
                                        $hab_disponibles = $dec->hab_disponibles;
                                        $link = $dec->link;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo ($i); ?></th>
                                            <td><?php echo ($id_apto); ?></td>
                                            <td><?php echo ($precio); ?></td>
                                            <td><?php echo ($cant_h); ?></td>
                                            <td><?php echo ($hab_disponibles); ?></td>
                                            <td><a href="<?php echo ($link); ?>">LINK</a></td>
                                        </tr>
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
    <!-- /#page-content-wrapper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>
</body>