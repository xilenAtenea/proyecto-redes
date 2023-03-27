<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-
1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min
.js" integrity="sha384-
ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
    ?>
    <nav class="navbar navbar-expand-lg custom-nav">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">ENIKIO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="arrendador.php">Mis propiedades</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <?php echo $nombre; ?>
                </span>
            </div>
        </div>
    </nav>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Precio</th>
                <th scope="col">Habitaciones</th>
                <th scope="col">Habitaciones<br>disponibles</th>
                <th scope="col">LINK</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servurl = "http://localhost:3002/aptos/usuarios/$cc";
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
                    <td><?php echo ($id_apto); ?></td>
                    <td><?php echo ($precio); ?></td>
                    <td><?php echo ($cant_h); ?></td>
                    <td><?php echo ($hab_disponibles); ?></td>
                    <td><a href="<?php echo ($link); ?>">LINK</a></td>
                    <td>
                        <a href="postulaciones.php?id_apto=<?php echo $id_apto ?>" class="btn btn-primary" style="background-color: #0F843B">
                            Ver postulaciones
                        </a>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pModal<?php echo $id_apto ?>" style="background-color: #0F843B">
                            Actualizar habitaciones disponibles
                        </button>
                        <div class="modal" id="pModal<?php echo $id_apto ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?php echo $id_apto ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="actualizarHabitaciones.php" method="post">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="formlabel">Habitaciones disponibles</label>
                                                <input type="number" name="cant_h" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly value="<?php echo $cant_h ?>">
                                                <input type="hidden" name="<?php echo $id_apto ?>/cant_h" value="<?php echo $cant_h ?>">
                                                <input type="number" name="<?php echo $id_apto ?>/hab_disponibles" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" max="<?php echo $cant_h ?>" min="0">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

</body>