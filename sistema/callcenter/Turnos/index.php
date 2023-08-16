<?php
  session_start();
  // echo $_SESSION['tipo'];


  $userr = $_SESSION['usuario']; 

  if (!isset($_SESSION['active'])) {
    echo "<script>
      alert ('Debe iniciar sesión para acceder a esta página');
      window.location = '../../login.php';
      </script>";
  }
  require_once "../conServicios.php";

  mysqli_set_charset($conServicios, "utf8");
  


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Metricas</title>
    <?php require_once "../dependencias.php" ?>
    <!-- <link rel="icon" href="../../imagen/modelo.jpg"> -->
  </head>
  <body>
  <?php require_once "../menu.php" ?>

    
    <br>


    <script src="./funciones/funciones.js"></script>
    
  </body>
</html>

<?php ?>



