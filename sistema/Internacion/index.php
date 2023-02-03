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
    <br><br><br> 
    
    <div class="container">
      <div class="row justify-content-md-center">        
        <div class="col-md-auto">
          <select class="form-control" id="idPiso" onchange="pisoSelect()">
            <option value="00">Piso</option>
            <?php 
                while($row=mysqli_fetch_array($menuPiso)) {
            ?> 
                <option value="<?php echo utf8_encode($row['Piso'])?>"> <?php echo utf8_encode($row['Piso'])?> </option>
            <?php }?>
          </select>
        </div>
        <div class="col-md-auto">
          <div id="habSelc">
            <select class="form-control" id="idHabitacion" >
                <option>Habitacion</option>
            </select>
          </div>
         
        </div>
      </div>
    </div>


    <br>
    <div class="container">
      <div class="row">
        
        <div class="col-md border-right border-top border-secondary border-bottom">
          <br>
          <!--- CAMA A-->
          <label for="staticEmail" class="col-sm-2 col-form-label">CAMA A</label>
          <br>
          <label for="staticEmail" class="col-sm-2 col-form-label">DNI</label>
          <div class="col-sm-10">
             <input class="form-control" type="text"  id="dniA" >
          </div>
          <label for="staticEmail" class="col-sm-6 col-form-label">Nombre y Apellido</label>
          <div class="col-sm-10">
             <input class="form-control" type="text"  id="nomapeA" >
          </div>
          <label for="staticEmail" class="col-sm-6 col-form-label">Telefono</label>
          <div class="col-sm-10">
             <input class="form-control" type="text"  id="telA" >
          </div>
          <br>
          <div class="col-md-auto">
            <form id="form">		
              <label class="mx-3">
                <input type="radio" name="Acomp" id="AcompA" value="1" >
                Acompañante
              </label>
              <label class="mx-3">
                <input type="radio" name="Acomp" id="AcompA" value="0" checked>
                Paciente
              </label>
            </form>
          </div>
          <br>
          <div class="col-sm-10">
            <button type="button" class="btn btn-info" onclick="GuardarA()">Guardar</button>
          </div>
          <br><br>
        </div>
    <!--- ------------------------------------------------------------------- --->
        <div class="col-md border-top border-secondary border-bottom">
          <br>
          <!--- CAMA b-->
          <label for="staticEmail" class="col-sm-2 col-form-label">CAMA B</label>
          <br>
          <label for="staticEmail" class="col-sm-2 col-form-label">DNI</label>
          <div class="col-sm-10">
             <input class="form-control" type="text"  id="dniB" >
          </div>
          <label for="staticEmail" class="col-sm-6 col-form-label">Nombre y Apellido</label>
          <div class="col-sm-10">
             <input class="form-control" type="text"  id="nomapeB" >
          </div>
          <label for="staticEmail" class="col-sm-6 col-form-label">Telefono</label>
          <div class="col-sm-10">
             <input class="form-control" type="text"  id="telB" >
          </div>
          <br>
          <div class="col-md-auto">
            <form id="form">		
              <label class="mx-3">
                <input type="radio" name="Acomp" id="AcompB" value="1" >
                Acompañante
              </label>
              <label class="mx-3">
                <input type="radio" name="Acomp" id="AcompB" value="0" checked>
                Paciente
              </label>
            </form>
          </div>
          <br>
          <div class="col-sm-10">
            <button type="button" class="btn btn-info" onclick="GuardarB()">Guardar</button>
          </div>
          <br><br>
        </div>
      </div>
    </div>

    <!--  
      <div class="container">
          <div class="row">
              <div class="col-md-2 ">Dni</div>
              <div class="col-md-4 ">
                  <input class="form-control" type="number" id="numDNIP">
              </div>
          </div>
          <br>
          <div class="row">
              <div class="col-md-2 ">Apellido</div>
              <div class="col-md-4 ">
                   <input class="form-control" type="text"  id=""id="ApellidoP">
              </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-2 ">Nombre</div>
              <div class="col-md-4 ">
                   <input class="form-control" type="text"  id=""id="NombreP">
              </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-2">Acompañante</div>
              <div class="col-md-4 ">
                <div class="col-md-auto">
                  <form id="form">		
                    <label>
                      <input type="radio" name="Acomp" id="Acomp" value="1" >
                      Si
                    </label>
                    <label>
                      <input type="radio" name="Acomp" id="Acomp" value="0" checked>
                      No
                    </label>
                  </form>
                </div>
              </div>
          </div>
          
          <br>
          <div class="row">
            <div class="col-md">
              <button type="button" class="btn btn-success" onclick="GuardarPaciente()">Guardar</button>
            </div>
            <div class="col-md">
              <button type="button" class="btn btn-danger">Danger</button>
            </div>
          </div>            
      </div>
                      -->

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