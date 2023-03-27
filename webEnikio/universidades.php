<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ESCOJA SU UNIVERSIDAD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <title>ENIKIO</title>
</head>

<body class="align-items-center d-flex">
    <div class="mt-5 container-sm">
        <h1 class="text-center">ESCOJA SU UNIVERSIDAD</h1>
        <form class="mt-5" action="aptos.php" method="get">
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
</body>

</html>