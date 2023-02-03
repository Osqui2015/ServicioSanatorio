<?php
  session_start();
  // echo $_SESSION['tipo'];

  require_once "../../conServicios.php";

  $estadoHabitacion = mysqli_query($conServicios, "SELECT * FROM estados WHERE id IN(1,2,3,8,10);");
  $checkmantenimiento = mysqli_query($conServicios, "SELECT * FROM mantenimiento");
  $userr = $_SESSION['NombreApe']; /*VALOR USUARIO*/
 

?>
<!doctype html>
<html lang="es-ES">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <?php  include_once "dependencias.php" ?>
    <title>Hoteleria Adm</title>
  </head>
  <body>
    <?php  include_once "menuAdmin.php" ?>
    <br><br><br>  
      <div class="container">
        
        
        <input type="text" value="<?php echo $userr ?>" id= "usuario" hidden>
        <br>
        <div class="row justify-content-md-center">
          <div class="col-md-auto mt-3 mb-3">
              <a href="Usuario.php" class="btn btn-info">Usuarios</a>                
          </div>
          <div class="col-md-auto mt-3 mb-3">
            <a href="Habitaciones.php" class="btn btn-info">Habitaciones</a>
          </div>
          <div class="col-md-auto mt-3 mb-3">              
              <a href="Internacion.php" class="btn btn-info"> Carga de Pacientes  </a>
          </div>
          <div class="col-md-auto mt-3 mb-3">
              <button type="button" class="btn btn-info"> <a href=".php"> Vista Mucamas </a></button>
          </div>
          <div class="col-md-auto mt-3 mb-3">
              <button type="button" class="btn btn-info"> <a href=".php"> Vista Mantenimiento </a></button>
          </div>
          <div class="col-md-auto mt-3 mb-3">
            <a href="prueba.php" class="btn btn-info"> Carga </a>
          </div>
        </div>
        <div class="row justify-content-md-center">
          <div class="col-md-auto mt-3 mb-3">
            <a href="Formulario.php" class="btn btn-info"> Formulario </a>
          </div>
        </div>
      </div>


    <br><br><br> 
    
    <div class="card">
      <div class="card-body">
        <div id="CargarDatos">

        </div>
      </div>
    </div>
    




    <script>
      $(document).ready(function(){
          $('#reporteTurno').DataTable({

              "language": {
                  "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                  },
                  fixedHeader: {
                  header: true,
                  footer: true,
                  },
                  ordering: false
          });
          
         /* $('.js-select-MenHab').select2();
          $('.js-select-Especialidad').select2();
          $('.js-select-Nombre').select2();
          $('.js-select-TipoHabAdd').select2(); */
      });
    </script>
  </body>
</html>