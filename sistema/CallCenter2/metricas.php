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
$Consultasql = "SELECT * FROM tabla_metricas WHERE Legajo = $userr";

$metricas = mysqli_query($conServicios, $Consultasql);

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

<body>
  <?php require_once "menu.php" ?>
  <br>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="Tdoc" class="table compact table-striped">
            <thead>
              <tr>
                <th scope="col"> Fecha </th>
                <th scope="col"> N° Caso </th>
                <th scope="col"> Puntaje </th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>

              <?php while ($fila = $metricas->fetch_assoc()) { ?>
                <tr>
                  <td> <?php echo $fila['Fecha'] ?> </td>
                  <td> <?php echo $fila['Num_Caso'] ?> </td>
                  <td> <?php echo $fila['Puntaje'] ?> </td>
                  <td> <button type="button" class="btn btn-info btn-sm" onclick="idMetrica(<?php echo $fila['Num_Caso'] ?>)"> Ver </button> </td>
                </tr>
              <?php }  ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>


    <br><br>
    <div class="card">
      <div class="card-body">
        <div id="card1">

        </div>
      </div>

    </div>


    <br>
    <div class="card">
      <div class="card-body">
        <div id='preguntas'>

        </div>
      </div>
    </div>

  </div>
  <br><br>
</body>

</html>