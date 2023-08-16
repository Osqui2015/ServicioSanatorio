<?php 
  require "conSanatorio.php";
  require "conContaduria.php";
  require "conSql.php";


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require_once 'dependencias.php' ?>
    <title>Contaduria</title>
  </head>
  <body>    
    <?php require_once 'menu.php' ?>



<div class="container">

  <div class="row mt-2 justify-content-md-center">
    <div class="col-lg-3">
      <div class="row mt-2 g-1 align-items-center">
        <div class="col-auto">
          <label for="inputHI" class="col-form-label">Fecha Inicio</label>
        </div>
        <div class="col-auto">
          <input type="date" id="inputFechaI" class="form-control" value="<?php echo date("Y-m-d"); ?>" onchange="fechaTurno()">
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="row mt-2 g-1 align-items-center">
        <div class="col-auto">
          <label for="inputHF" class="col-form-label">Fecha Fin</label>
        </div>
        <div class="col-auto">
          <input type="date" id="inputFechaF" class="form-control" value="<?php echo date("Y-m-d"); ?>" onchange="fechaTurno()">
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="row mt-2 g-1 align-items-center">
        <div class="col-auto">
          <label for="matriDoc"> Medico </label>
        </div>
        <div class="col-auto">
          <select class="form-select form-select-sm" id="matriDoc" onchange="fechaTurno()">
            <option selected>Todos</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
      </div>
    </div>

  </div>

  <div class="container">
    <div id="TFac"></div>    
  </div>

</div>


<script src="funciones/funciones.js"></script>


  </body>
</html>