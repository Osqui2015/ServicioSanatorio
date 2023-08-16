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
$Consultasql = "SELECT tm.*,
                  us.NombreApe 

                  FROM tabla_metricas AS tm

                  LEFT JOIN usuario AS us
                  ON tm.Legajo = us.usuario";

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
  <?php require_once "menuSecretaria.php" ?>
  <br><br><br><br>
  <div class="d-flex justify-content-center">
    <a href='/servicios/sistema/AdmCall/Cmetricas.php' class="btn btn-success">Cargar Metricas</a>
  </div>
  <br>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="Tdoc" class="table compact table-striped">
            <thead>
              <tr>
                <th scope="col"> Legajo </th>
                <th scope="col"> Nombre </th>
                <th scope="col"> Fecha </th>
                <th scope="col"> N° Caso </th>
                <th scope="col"> Puntaje </th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>

              <?php while ($fila = $metricas->fetch_assoc()) { ?>
                <tr>
                  <td> <?php echo $fila['Legajo'] ?> </td>
                  <td> <?php echo $fila['NombreApe'] ?> </td>
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

  </div>
  <br><br>
  <script>
    function idMetrica(x) {
      carduno(x)
    }

    function carduno(x) {
      var parametros = {
        "Tcard": "1",
        "x": x
      };
      console.log(parametros)
      $.ajax({
        data: parametros,
        url: '/servicios/sistema/AdmCall/codPHP.php',
        type: 'POST',
        success: function(r) {
          $('#card1').html(r)
        }
      })
    }
  </script>
</body>

</html>