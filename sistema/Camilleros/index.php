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
    $Datos = mysqli_query($conServicios, "SELECT * FROM form");


?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <?php  include_once "dependencias.php" ?>
    <title> Camillero </title>

</head>
<body>
    <?php  include_once "menuCamillero.php" ?>
<div class="">    
    <br> <br> <br>   
        

<div class="card container">
  <div class="card-body row justify-content-md-center">
    
    <div class="col-lg-1 text-right">
      <label for="dni">DNI</label>
    </div>
    <div class="col-lg-3">
      <div class="form-group">
        <input type="number" class="form-control" id="dni" name="dni">
      </div>      
    </div>
    <div class="col-lg-1 text-right">
      <label for="registro">Registro</label>
    </div>
    <div class="col-lg-3">
      <div class="form-group">
        <input type="number" class="form-control" id="registro" name="registro">
      </div>      
    </div>
    <div class="col-lg-3 col-12">
      <button class="btn btn-primary" onclick="buscarPaciente()">Buscar Paciente</button>
    </div>
  </div>

</div>
    

<br><br>
    

    
        

</div>


</body>

</html>



