<?php
  session_start();

  $userr = $_SESSION['usuario']; 


  if (!isset($_SESSION['active'])) {
    echo "<script>
      alert ('Debe iniciar sesión para acceder a esta página');
      window.location = '../../login.php';
      </script>";
  }
  require_once "../conServicios.php";

  mysqli_set_charset($conServicios, "utf8");

  $usuarioInfoMenu = mysqli_query($conServicios, "SELECT * FROM usuario WHERE Sector = 3 AND usuario = $userr;");
  


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios</title>
    <?php require_once "../dependencias.php" ?>
    <!-- <link rel="icon" href="../../imagen/modelo.jpg"> -->
  </head>
  <body>
    <?php require_once "../menu.php" ?>

    <div class="container">
      
      <br>
      <div class="row">
        <div class="col">
        <div class="table-responsive">
            <table id="TUser" class="table compact table-striped">
              <thead>
                <tr>
                  <th scope="col"> Legajo / Usuario </th>
                  <th scope="col"> Dni </th>
                  <th scope="col"> Nombre y Apellido </th>
                  <th scope="col"> Telefono </th>
                                   
                </tr>
              </thead>
              <tbody>
                <?php while ($fila = $usuarioInfoMenu->fetch_assoc()) { ?>
                  <tr>
                    <td> <?php echo $fila['usuario'] ?> </td>
                    <td> <?php echo $fila['Dni'] ?> </td>
                    <td> <?php echo $fila['NombreApe'] ?> </td>
                    <td> <?php echo $fila['Telefono'] ?> </td>
                  </tr>
                <?php }  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <br>
    <script src="./funciones/funciones.js"></script>
    
  </body>
</html>

<?php ?>



<!-- Modal -->
<div class="modal fade" id="agregarUsuario" tabindex="-1" aria-labelledby="agregarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="agregarUsuarioLabel">Agregar Usuario Call Center</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="container">
            <div class="row mt-2">
              <div class="col">
                <p>Nombre y Apellido :</p>
              </div>
              <div class="col">
                <input class="form-control" type="text" id="">
              </div>
            </div>
            <div class="row mt-2">
              <div class="col">
                <p>DNI :</p>
              </div>
              <div class="col">
                <input class="form-control" type="text" id="">
              </div>
            </div>
            <div class="row mt-2">
              <div class="col">
                <p>Legajo :</p>
              </div>
              <div class="col">
                <input class="form-control" type="text" id="">
              </div>              
            </div>
            <div class="row mt-2">
              <div class="col">
                <p>Contraseña :</p>
              </div>
              <div class="col">
                <input class="form-control" type="text" id="">
              </div>
            </div>
            <div class="row mt-2">
              <div class="col">
                <p>Confirmar Contraseña :</p>
              </div>
              <div class="col">
                <input class="form-control" type="text" id="">
              </div>
            </div>
            <div class="row mt-2">
              <div class="col">
                <p>Email :</p>
              </div>
              <div class="col">
                <input class="form-control" type="text" id="">
              </div>              
            </div>
            <div class="row mt-2">
              <div class="col">
                <p>Telefono :</p>
              </div>
              <div class="col">
                <input class="form-control" type="text" id="">
              </div>              
            </div>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>