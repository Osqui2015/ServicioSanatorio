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
  require_once "conServicios.php";

  mysqli_set_charset($conServicios, "utf8");
  
  $menNombre = mysqli_query($conServicios, "SELECT Matricula, NomApe FROM profesional ORDER BY NomApe;"); // doctor

  $menObraSocial = mysqli_query($conServicios, "SELECT * FROM obrasocial ORDER BY Nombre"); // obra Social

  $menEspecialiadad = mysqli_query($conServicios, "SELECT * FROM especialidad ORDER BY Especialidad;");

  $menEstudios = mysqli_query($conServicios, "SELECT * FROM estudios ORDER BY Estudios"); 

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
    <div class="container text-center">
      <div class="row justify-content-md-center">        
       
        <div class="col col-lg-2"> 
          <select class="form-select select2" id="Especialidad" onchange="SelectCambio()">
            <option value="0" selected>Especialidad</option>
              <?php while ($row = mysqli_fetch_array($menEspecialiadad)) { ?>
                  <option value="<?php echo $row['Id'] ?>"> <?php echo $row['Especialidad'] ?> </option>
              <?php } ?>
          </select>
        </div>

        <div class="col col-lg-2">
          <select class="form-select select2" id="ObraSocial" onchange="SelectCambio()">
            <option value="0" selected>Obra Social</option>
              <?php while ($row = mysqli_fetch_array($menObraSocial)) { ?>
                  <option value="<?php echo $row['Id'] ?>"> <?php echo $row['Nombre'] ?> || <?php echo $row['Plan'] ?> </option>
              <?php } ?>
          </select>          
        </div>

        <div class="col col-lg-2">
          <select class="form-select select2" id="Estudio" onchange="SelectCambio()">
            <option value="0" selected>Estudio</option>
              <?php while ($row = mysqli_fetch_array($menEstudios)) { ?>
                  <option value="<?php echo $row['Id'] ?>"> <?php echo $row['Estudios'] ?> </option>
              <?php } ?>
          </select>          
        </div>

      </div>
    </div>
    <br>
    <div class="container text-center">
      <div class="row justify-content-md-center">
        
        <div class="col-md-auto">
          <select class="form-select select2" name="Nombre" id="Nombre" onchange="MedicSelect()">
              <option value="0" selected>Profesional</option>
              <?php while ($row = mysqli_fetch_array($menNombre)) { ?>
                  <option value="<?php echo utf8_encode($row['Matricula']) ?>"> <?php echo utf8_encode($row['NomApe']) ?> </option>
              <?php } ?>
          </select>

        </div>
        
      </div>
    </div>
    <br>
    <div class="container">
      <div id="Tmedicos"></div>
    </div>
    <br>
    <div class="container">
      <div id="TOBS"></div>
    </div>
    


    <script src="./funciones/funciones.js"></script>
    
  </body>
</html>

<?php ?>



