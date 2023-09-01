<?php
    session_start();
    //echo $_SESSION['tipo'];
    if(!empty($_SESSION['active'])){
        
    }else{
        header('location: ../../index.php');
    }
    $userr = $_SESSION['usuario']; /*VALOR USUARIO*/

    require_once "../../../conSanatorio.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultas</title>
  <style>
    .card-body .row {
        margin-bottom: -5px;
    }
  </style>
    <?php require_once '../dependencias.php' ?>
  </head>
  <body >
    <?php require_once '../menu.php'?>
    
      <div class="container">

        <fieldset>
          <legend class="fs-2 text-white fw-semibold">Información de Ingreso</legend>
          <div class="row align-items-center">
            <div class="col-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="nIngreso">N de Ingreso</label>
                <input type="number" id="nIngreso" class="form-control" aria-describedby="basic-addon1" required>
              </div>
            </div>
            <div class="col-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="nOIS">OIS</label>
                <input type="number" id="nOIS" class="form-control" aria-describedby="basic-addon1" required>
              </div>
            </div>
            <div class="col-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="fechaIngreso">Fecha de Ingreso</label>
                <input type="date" id="fechaIngreso" class="form-control" aria-describedby="basic-addon1" required>
              </div>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend class="fs-3 text-white fw-semibold">Información Personal</legend>
          <div class="row justify-content-start">
            <div class="col-md-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="dni">DNI</label>
                <input type="number" id="dni" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
              </div>            
            </div>
            <div class="col-md-8">
              <div class="input-group mb-3">
                <label class="input-group-text" for="nombreApellido">Nombre y Apellido</label>
                <input type="text" id="nombreApellido" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
              </div>
            </div>
          </div>

          <div class="row justify-content-start">
            <div class="col-md-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="numAfiliado">N° de Afiliado</label>
                <input type="number" id="numAfiliado" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
              </div>            
            </div>
            <div class="col-md-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="habitacion">Habitación</label>
                <input type="number" id="habitacion" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
              </div>
            </div>
            <div class="col-md-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="estado">Estado</label>
                <select id="estado" class="form-select" aria-label="Default select example">
                  <option value="1">Activo</option>
                  <option value="2">Desactivado</option>
                </select>
              </div>
            </div>
          </div>
        </fieldset>


        <fieldset>
          <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <label class="input-group-text" for="fechaCarga">Fecha de Carga</label>
                      <input type="date" id="fechaCarga" class="form-control" aria-describedby="basic-addon1" required>
                    </div>
                  </div>
                </div>
            <br>                
              <form enctype="multipart/form-data">
                <!-- Guardia -->
                  <div>
                    <div class="row justify-content-start">
                      <div class="col-2">
                        <p class="font-monospace fw-semibold">Guardia</p>
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Evolucion</p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Evolucion" type="file" accept=".pdf">
                      </div>
                    </div>              
                  </div>
                  <br>
                <!-- Cirugia -->
                  <div>
                    <div class="row justify-content-start">
                      <div class="col-2">
                        <p class="font-monospace fw-semibold">Cirugia</p>
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Protocolo Quirurgico</p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Quirurgico" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Protocolo Anestesico</p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Anestesico" type="file" accept=".pdf">
                      </div>
                    </div>                
                  </div>
                  <br>
                <!-- Internacion -->
                  <div>
                    <div class="row justify-content-start">
                      <div class="col-2">
                        <p class="font-monospace fw-semibold">Internacion</p>
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Piso</p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Piso" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">UTI</p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="UTI" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">UCO</p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="UCO" type="file" accept=".pdf">
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">NEO</p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="NEO" type="file" accept=".pdf">
                      </div>
                    </div> 
                  </div>
                  <br>
                <!-- Enfermeria -->
                  <div>
                    <div class="row justify-content-start">
                      <div class="col-2">
                        <p class="font-monospace fw-semibold">Enfermeria</p>
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Hoja Enfermeria </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="HEnfermeria" type="file" accept=".pdf">
                      </div>
                    </div>              
                  </div>
                  <br>
                <!-- Indicaciones  -->
                  <div>
                    <div class="row justify-content-start">
                      <div class="col-2">
                        <p class="font-monospace fw-semibold">Indicaciones</p>
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Procedimientos </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Procedimientos" type="file" accept=".pdf">
                      </div>
                    </div>              
                  </div>
                  <br>
                <!-- Interconsultas  Apoyo Diagnostico-->
                  <div>
                    <div class="row justify-content-start">
                      <div class="col-2">
                        <p class="font-monospace fw-semibold">Apoyo Diagnostico</p>
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Laboratorio </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Laboratorio" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Ecografia </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Ecografia" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Radiologia </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Radiologia" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Tomografia </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Tomografia" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Otros </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Otros" type="file" accept=".pdf">
                      </div>
                    </div>
                  </div>
                  <br>
                <!-- Interconsultas  Apoyo Terapeutico-->
                  <div>
                    <div class="row justify-content-start">
                      <div class="col-2">
                        <p class="font-monospace fw-semibold">Apoyo Terapeutico</p>
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Kinesiologia </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Kinesiologia" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Fonoaudiologia </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Fonoaudiologia" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Hemoterapia </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Hemoterapia" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Otros </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="OtrosDos" type="file" accept=".pdf">
                      </div>
                    </div>
                  </div>
              </form>

                <div class="row justify-content-center">
                  <div class="col-md-4">
                    <button type="button" class="btn btn-primary" onclick="CargarDatos()">Cargar Datos </button>
                  </div>
                </div>
            </div>
          </div>          
        </fieldset>

        

      </div>

  </body>
  <script>
   
  </script>
  <script src="funciones/funciones.js"></script>
</html>

<?php ?> 