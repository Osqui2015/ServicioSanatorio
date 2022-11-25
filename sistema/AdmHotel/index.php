<?php
  session_start();
  // echo $_SESSION['tipo'];

  require_once "../../conServicios.php";
  $userr = $_SESSION['NombreApe']; /*VALOR USUARIO*/
  


  $infoCard = mysqli_query($conServicios, "SELECT * FROM estados WHERE id = 1;");

  $menuHabitacion = mysqli_query($conServicios, "SELECT * FROM habitacion;");  //order by Orden 

  $menuTipoHabitacion= mysqli_query($conServicios, "SELECT * FROM tipohabi");


  $estadoHabitacion = mysqli_query($conServicios, "SELECT * FROM estados"); 
  $estadoHabitacion2 = mysqli_query($conServicios, "SELECT * FROM estados");

  $cargaEstadosHab = mysqli_query($conServicios, "SELECT 
                                                  he.id,
                                                  h.Habitaciones,
                                                  h.Piso,
                                                  e.Estado,
                                                  e.Clase,
                                                  th.TipoHab,
                                                  th.img
                                                  FROM 
                                                  habestados AS he
                                                  INNER JOIN habitacion AS h
                                                  ON he.hab = h.Id
                                                  INNER JOIN estados AS e
                                                  ON he.Estado = e.Id
                                                  INNER JOIN tipohabi AS th
                                                  ON he.Tipo = th.Id")

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
    <?php  include_once "menuHoteleria.php" ?>
    <br><br><br>  
      <div class="container">
         
        <div class="row justify-content-md-center alert alert-dark" role="alert">
          <div class="col-md-auto mt-3 mb-3">
            <h5 class="card-title">Habitacion</h5>
          </div>
          <div class="col-md-2 mt-3">
            <select class="js-select-MenHab custom-select" name="MenHab" id="MenHab">
                <option value="00">TODOS</option>
                <?php 
                    while($row=mysqli_fetch_array($menuHabitacion)) {
                ?>
                    <option value="<?php echo utf8_encode($row['Id'])?>"> <?php echo utf8_encode($row['Piso'])?> <?php echo utf8_encode($row['Habitaciones'])?></option>
                <?php }?>
            </select>
          </div>
          <div class="col-md-auto mt-3 mb-3">
            <button type="button" class="btn btn-success"  class="btn btn-primary" data-toggle="modal" data-target="#AddHabitacion" onclick="btnAgregarHab()">Agregar</button>
          </div>
          <div class="col-md-auto mt-3 mb-3">
            <button type="button" class="btn btn-info">Editar</button>
          </div>
          <div class="col-md-auto mt-3 mb-3">
            <button type="button" class="btn btn-danger">Borrar</button>
          </div>            
        </div>
         
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






<!-- Agregar Habitacion -->
<div class="modal fade" id="AddHabitacion" tabindex="-1" aria-labelledby="AddHabitacionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddHabitacionLabel">Agregar Habitacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
            <div class="form-group col-md-6">
            <input type="text" size="2" class="form-control" id="IdHab" readonly >
                <label for="inputEmail4">Estado</label>
                <select class="form-control" name="EstadoSelect" id="EstadoSelectAdd">
                    <option value="00">TODOS</option>
                        <?php 
                            while($row=mysqli_fetch_array($estadoHabitacion2)) {
                        ?>
                            <option value="<?php echo utf8_encode($row['Id'])?>"> <?php echo utf8_encode($row['Estado'])?> </option>
                        <?php }?>
                </select>
            </div>
        </div>
 
      <div class="form-row">            
            <div class="form-group col-md-6">
                <label for="inputPassword4">Tipo de Habitacion</label>
                <select class="form-control" name="TipoHabAdd" id="TipoHabAdd">
                    <option value="00">TODOS</option>
                        <?php 
                            while($row=mysqli_fetch_array($menuTipoHabitacion)) {
                        ?>
                            <option value="<?php echo utf8_encode($row['Id'])?>"> <?php echo utf8_encode($row['TipoHab'])?> </option>
                        <?php }?>
                </select>
            </div>
        </div>

 
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="GuardarAñadirHab()">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
 
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
                <option value="00">TODOS</option>
                    <?php 
                        while($row=mysqli_fetch_array($estadoHabitacion)) {
                    ?>
                        <option value="<?php echo utf8_encode($row['Id'])?>"> <?php echo utf8_encode($row['Estado'])?> </option>
                    <?php }?>
            </select>
        <br>
        Observación: 
                        <textarea class="form-control" id="Observacion" rows="3"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="GEstadoH()">Guardar Cambios</button> 
      </div>
    </div>
  </div>
</div>

<!-- Modal Historial Estado -->
<div class="modal fade" id="HistorialEstado" tabindex="-1" aria-labelledby="HistorialEstadoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="HistorialEstadoLabel">Historial de Estados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">            
            <br>
            <div id="HistorialE">

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        
      </div>
    </div>
  </div>
</div>