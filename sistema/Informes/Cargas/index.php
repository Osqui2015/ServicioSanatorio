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

    <?php require_once '../dependencias.php' ?>
  </head>
  <body >
    <?php require_once '../menu.php'?>
    
      <div class="container text-center">

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
          <legend class="fs-3 text-white fw-semibold">Archivos Adjuntos</legend>
          <br>
            <div class="col-md-8">
              <div class="input-group mb-3">
                <label class="input-group-text" for="fechaIngreso">Fecha</label>
                <input type="date" id="fechaC" class="form-control" aria-describedby="basic-addon1" required>
              </div>
            </div>
            <div class="col-md-8">
              <div class="input-group mb-3">
                <label class="input-group-text" for="historiaClinica">Historia Clínica</label>
                <input type="file" id="historiaClinica" class="form-control" accept=".pdf, .doc, .docx">
              </div>
            </div>
            <div class="col-md-8">
              <div class="input-group mb-3">
                <label class="input-group-text" for="evolucion">Evolución</label>
                <input type="file" id="evolucion" class="form-control" accept=".pdf, .doc, .docx">
              </div>
            </div>
            <div class="col-md-8">
              <div class="input-group mb-3">
                <label class="input-group-text" for="apoyoDiagnostico">Apoyo Diagnóstico</label>
                <input type="file" id="apoyoDiagnostico" class="form-control" accept=".pdf, .doc, .docx">
              </div>
            </div>
            <div class="col-md-8">
              <div class="input-group mb-3">
                <label class="input-group-text" for="interconsulta">Interconsulta</label>
                <input type="file" id="interconsulta" class="form-control" accept=".pdf, .doc, .docx">
              </div>
            </div>
          
        </fieldset>

        <button type="button" class="btn btn-primary" onclick="CargarDatos()">Cargar Datos </button>

      </div>

  </body>
  <script>
   
  </script>
  <script src="funciones/funciones.js"></script>
</html>

<?php ?> 