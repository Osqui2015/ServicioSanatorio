<?php
  session_start();
  // echo $_SESSION['tipo'];

  require_once "../../conServicios.php";
  $userr = $_SESSION['NombreApe']; /*VALOR USUARIO*/
  
  if(!isset($_SESSION['active'])){
    echo "<script>
    alert ('Debe iniciar sesión para acceder a esta página');
    window.location = '../../login.php';
    </script>";
  }
    require_once 'conHoteleria.php';
    mysqli_set_charset($conHoteleria, "utf8");
    $hab = mysqli_query($conHoteleria, "SELECT * FROM habitaciones GROUP BY piso;");
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reportes</title>
    <?php require_once "dependencias.php" ?>
  </head>
  <body>
    <?php require_once "menu.php" ?>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio0" autocomplete="off" onclick="ReportePiso(0)">
                <label class="btn btn-outline-primary" for="btnradio0">Todos</label>
                <?php while($Rhab = $hab->fetch_assoc()){ ?>
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio<?php echo $Rhab['Piso']?>" autocomplete="off" onclick="ReportePiso(<?php echo $Rhab['Piso']?>)">
                    <label class="btn btn-outline-primary" for="btnradio<?php echo $Rhab['Piso']?>">Piso <?php echo $Rhab['Piso']?></label>
                <?php } ?>
            </div>
        </div>
    </div>
    <br>    <br>    <br>
    <div class="container">

        <div id="TabReporte"></div>   

    </div>

    <script src="funciones.js"></script>
    
  </body>
</html>

<?php ?> 