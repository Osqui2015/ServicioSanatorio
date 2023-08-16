<?php
session_start();
// echo $_SESSION['tipo'];

require_once "../../conServicios.php";
$userr = $_SESSION['usuario']; /*VALOR USUARIO*/

if (!isset($_SESSION['active'])) {
  echo "<script>
    alert ('Debe iniciar sesión para acceder a esta página');
    window.location = '../../login.php';
    </script>";
}

$menObraSocial = mysqli_query($conServicios, "SELECT * FROM obrasocial ORDER BY Nombre;");  //order by Orden 

$menEstudios = mysqli_query($conServicios, "SELECT * FROM estudios");  //order by Orden 

$menEspecialidad = mysqli_query($conServicios, "SELECT * FROM Especialidad ORDER BY Especialidad");

?>


<html class=" ">

<head>
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php require_once "dependencia.php" ?>
  <title>Call Center</title>
</head>

<body onload="tdoc('1')">
  <?php require_once "menu.php" ?>

  <br>
  <div class="container text-center">
    <div class="row justify-content-md-center">
      <div class="col col-lg-2">
        Especialidad
      </div>
      <div class="col col-lg-4">
        <select id="select-especialidad" name="especialidad" class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="tdoc(2)">
          <option value="00">TODOS</option>
          <?php while ($row = mysqli_fetch_array($menEspecialidad)) { ?>
            <option value="<?php echo utf8_encode($row['Id']) ?>"><?php echo utf8_encode($row['Especialidad']) ?> </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="row justify-content-md-center mt-2">
      <div class="col col-lg-2">
        Obra Social
      </div>
      <div class="col col-lg-4">
        <select id="select-os" name="os" class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="tdoc(2)">
          <option value="00">TODOS</option>
          <?php while ($row = mysqli_fetch_array($menObraSocial)) { ?>
            <option value="<?php echo utf8_encode($row['Id']) ?>">
              <?php echo utf8_encode($row['Nombre']) ?>ㅤㅤㅤㅤ<?php echo utf8_encode($row['Plan']) ?>
            </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="row justify-content-md-center mt-2">
      <div class="col col-lg-2">
        Estudios
      </div>
      <div class="col col-lg-4">
        <select id="select-estudios" name="estudios" class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="tdoc(2)">
          <option value="00">TODOS</option>
          <?php while ($row = mysqli_fetch_array($menEstudios)) { ?>
            <option value="<?php echo utf8_encode($row['Id']) ?>"><?php echo utf8_encode($row['Estudios']) ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <br>
  <div class="container text-center">
    <a href='/servicios/sistema/CallCenter/index.php' class="btn btn-primary">Borrar Filtro</a>
  </div>
  <br>
  <div class="container table-responsive" id="tablaDoc">
  </div>
  <br><br>
</body>

</html>


<!-- Modal -->
<div class="modal fade" id="infoDoc" tabindex="-1" aria-labelledby="infoDocLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="infoDocLabel">Informacion de Doctor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div id="tablaInfo"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar </button>
        <button type="button" class="btn btn-primary"> Guardar </button>
      </div>
    </div>
  </div>
</div>