<?php 

$id_apto = $_POST["id_apto"];


?>


<!DOCTYPE html>
      <html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta http-equiv="X-UA-Compatible" content="ie=edge">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
          <title>Enikio</title>
    
      </head>
      <body>
          <h2>¡POSTÚLATE AQUÍ!</h2>
          <div class="mt-5 container-sm">
            <form action="update.php" method="POST">
                <div class="mb-3">
                    <label for="formInput" class="form-label">Apartamento de Interés</label>
                    <input type="text" class="form-control" id="formInput" name="id_apto" value= "<?php echo $id_apto ?>" readonly/>
                </div>
                <div class="mb-3">
                    <label for="formInput2" class="form-label">Cédula</label>
                    <input type="text" class="form-control" id="cedulaInput" name="cedula" />
                </div>
                <div class="mb-3">
                    <label for="formInput2" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" id="formInput3" name="nombre"/>
                </div>
            
                <div class="mb-3">
                    <label for="formInput4" class="form-label">Email</label>
                    <input type="text" class="form-control" id="formInput4" name="email"/>
                </div>
                <div class="mb-3">
                    <label for="formInput2" class="form-label">Celular</label>
                    <input type="text" class="form-control" id="formInput5" name="celular"/>
                </div>
                <div class="mb-3">
                    <label for="formInput3" class="form-label">Ocupación</label>
                    <select class="form-select" id="ocupacion" name="ocupacion">
                        <option value="">Selecciona una opción</option>
                        <option value="estudiante">Estudiante</option>
                        <option value="docente">Docente</option>
                        <option value="colaborador">Colaborador</option>
                        <option value="otro">Otra</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formInput3" class="form-label">Interés</label>
                    <select class="form-select" id="interes" name="interes">
                        <option value="">Selecciona una opción</option>
                        <option value="Apartamento completo">Apartamento completo</option>
                        <option value="Habitacion">Habitación</option>
                        
                    </select>
                </div>
                <div><p><input type="checkbox" name="aprobacion"/> Acepto el tratamiento de mis datos personales.</p>
                </div>
                
                
                <button class="btn btn-primary" type="submit" style="background-color: #0F843B">Postularse</button>
            </form>
        </div>
        <script>
            document.getElementById("cedulaInput").addEventListener("blur", function() {
            var cedula = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "http://localhost:3001/usuarios/autofill/" + cedula, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                document.getElementById("formInput3").value = data?.nombre||"";
                document.getElementById("formInput4").value = data?.email||"";
                document.getElementById("formInput5").value = data?.celular||"";
                } else {
                console.log("Ha ocurrido un error");
                }
            };
            xhr.send();
            });
            </script>
      </body>

      </html>


-->