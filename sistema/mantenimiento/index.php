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
    <?php  include_once "menuHoteleria.php" ?>
    <br><br><br>  
      <div class="container">
        
        
        <input type="text" value="<?php echo $userr ?>" id= "usuario" hidden>
        <br>
        <div class="row justify-content-md-center">
          <div class="col-md-auto mt-3 mb-3">
              <button type="button" class="btn btn-info" onclick="btnPiso(2)"> Piso Nº 2</button>
          </div>
          <div class="col-md-auto mt-3 mb-3">
              <button type="button" class="btn btn-info" onclick="btnPiso(3)"> Piso Nº 3</button>
          </div>
          <div class="col-md-auto mt-3 mb-3">
              <button type="button" class="btn btn-info" onclick="btnPiso(4)"> Piso Nº 4</button>
          </div>
          <div class="col-md-auto mt-3 mb-3">
              <button type="button" class="btn btn-info" onclick="btnPiso(5)"> Piso Nº 5</button>
          </div>
          <div class="col-md-auto mt-3 mb-3">
              <button type="button" class="btn btn-info" onclick="btnPiso(6)"> Piso Nº 6</button>
          </div>
          <div class="col-md-auto mt-3 mb-3">
              <button type="button" class="btn btn-info" onclick="btnPiso(7)"> Piso Nº 7</button>
          </div>
        </div>
        <div class="row justify-content-md-center">
          <input type="text" class="form" id="idpiso" hidden>
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



<!-- Modal Cambiar Estado -->
<div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="cambiarEstadoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cambiarEstadoLabel">Cambiar Estado</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>        
      </div>
      
      <div class="modal-body">      
        Habitacion: <input type="text" size="2" class="form-control" id="IdH" readonly >
        <br>
            <select class="form-control" name="EstadoSelect" id="EstadoSelect">
                    <?php 
                        while($row=mysqli_fetch_array($estadoHabitacion)) {
                    ?>
                        <option value="<?php echo utf8_encode($row['Id'])?>"> <?php echo utf8_encode($row['Estado'])?> </option>
                    <?php }?>
            </select>
        <br>
        Observación: 
          <div class="form-check">
              <?php 
                  while($row=mysqli_fetch_array($checkmantenimiento)) {
              ?>
                  <input class="form-check-input get_value" type="checkbox" value="<?php echo utf8_encode($row['tipo'])?>" id="id<?php echo utf8_encode($row['id'])?>" />
                  <label class="form-check-label" for="id<?php echo utf8_encode($row['id'])?>"><?php echo utf8_encode($row['tipo'])?></label>
                  <br>
              <?php }?>

          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="GEstadoH()">Guardar Cambios</button> 
      </div>
    </div>
  </div>
</div>
