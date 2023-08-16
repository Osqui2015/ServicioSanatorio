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

?>


<html class=" ">

<head>
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php require_once "dependencia.php" ?>
  <title>RRHH</title>
</head>

<body>
  <?php require_once "menu.php" ?>
  <br>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="container text-center">
          <div class="row justify-content-md-center">
            <div class="col col-lg-2">
              Puesto:
            </div>
            <div class="col col-lg-2">
              <select class="form-select" aria-label="Default select example" onchange="Puesto()">
                <option selected value="0">Todos</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div id="tablaPostulante"></div>
    <br><br>
  </div>
</body>


</html>