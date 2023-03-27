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
    $id_apto = $_GET["id_apto"];
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
                    <li>
                        <h1 class="navbar-brand" aria-current="page">APTO <?php echo $id_apto; ?></h1>
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
                <th scope="col">Postulante</th>
                <th scope="col">Email</th>
                <th scope="col">Celular</th>
                <th scope="col">CC</th>
                <th scope="col">Fecha</th>
                <th scope="col">Ocupacion</th>
                <th scope="col">Interes</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servurl = "http://localhost:3003/postu/aptos/$id_apto";
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
                $nombre = $dec->nombre;
                $email = $dec->email;
                $celular = $dec->celular;
                $cc_postulado = $dec->cc_postulado;
                $fecha = $dec->fecha;
                $ocupacion = $dec->ocupacion;
                $interes = $dec->interes;
                $estado = $dec->estado;
            ?>
                <tr>
                    <td><?php echo ($nombre); ?></td>
                    <td><?php echo ($email); ?></td>
                    <td><?php echo ($celular); ?></td>
                    <td><?php echo ($cc_postulado); ?></td>
                    <td><?php echo ($fecha); ?></td>
                    <td><?php echo ($ocupacion); ?></td>
                    <td><?php echo ($interes); ?></td>
                    <td><?php echo ($estado); ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>