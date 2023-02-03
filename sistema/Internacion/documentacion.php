<?php
  session_start();
  // echo $_SESSION['tipo'];

  require_once "../../conServicios.php";
  $userr = $_SESSION['NombreApe']; /*VALOR USUARIO*/
  

  
  $menuPiso = mysqli_query($conServicios, "SELECT * FROM habitacion GROUP BY piso;");
  $menuHabitacion = mysqli_query($conServicios, "SELECT * FROM habitacion GROUP BY piso;");


?>
<!doctype html>
<html lang="es-ES">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
   
    <?php  include_once "dependencias.php" ?>

    

    <title>Hoteleria Adm</title>
  </head>
  <body >
    <?php  include_once "menuInter.php" ?>
    <br>
    


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
          
          /*$('.js-select-MenHab').select2();
           $('.js-select-Especialidad').select2();
          $('.js-select-Nombre').select2();
          $('.js-select-TipoHabAdd').select2(); */
      });
    
    </script>
  </body>
</html>


