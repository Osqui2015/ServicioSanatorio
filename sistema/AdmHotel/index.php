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
  $estado = mysqli_query($conHoteleria, "SELECT * FROM estados WHERE EstadoHab != '' AND Estado = 1");
  $estadoDos = mysqli_query($conHoteleria, "SELECT * FROM estados WHERE EstadoHab != '' AND Estado = 2");

?> 

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adm Hoteleria</title>
    <?php require_once "dependencias.php" ?>
    <link rel="icon" href="../../imagen/modelo.jpg">
  </head>
  <body>
    <?php require_once "menu.php" ?>
    <p id="pContent" hidden><?php echo $_SESSION['NombreApe'] ?></p>

    <div class="container">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <?php while($Rhab = $hab->fetch_assoc()){ ?>
                <input type="radio" class="btn-check" name="btnradio" id="btnradio<?php echo $Rhab['Piso']?>" autocomplete="off" onclick="piso(<?php echo $Rhab['Piso']?>)">
                <label class="btn btn-outline-primary" for="btnradio<?php echo $Rhab['Piso']?>">Piso <?php echo $Rhab['Piso']?></label>
            <?php } ?>
        </div>
    </div>
    <br>


    <div>
        <div class="container">
            
                <div id="cardHab">
 
                </div>                   
            
        </div>

    </div>

    <script src="funciones.js"></script>
    
  </body>
</html>

<?php ?>



<!-- Modal -->
<div class="modal fade" id="EstadoHab" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EstadoHabLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="EstadoHabLabel">Cambiar de Estado </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="text-center fs-4">
                Habitacion: <span  id="NumHab"></span>
            </div>
        <br>
            <div class="row justify-content-md-center">
                <div class="col-6">
                <div id="salidaPositiva" hidden>
                  <select class="form-select" aria-label="Default" id="selectEstado" >
                      <option selected></option>
                      <?php while($ReEstado = $estadoDos->fetch_assoc()): ?>
                          <option value="<?php echo $ReEstado['Id']; ?>">                            
                              <?php echo $ReEstado['EstadoHab']; ?>
                          </option>
                      <?php endwhile; ?>
                  </select>
                </div>
                <div id="salidaNegativa" hidden>
                  <select class="form-select" aria-label="Default" id="selectEstadoNeg">
                      <option selected></option>
                      <?php while($ReEstado = $estado->fetch_assoc()): ?>
                          <option value="<?php echo $ReEstado['Id']; ?>">                            
                              <?php echo $ReEstado['EstadoHab']; ?>
                          </option>
                      <?php endwhile; ?>
                  </select>
                </div>



               </div>
            </div>
            <br>
            <div class="row justify-content-md-center">
                <div class="col-6">
                    <label for="ObsHab" class="form-label">Observaciones</label>
                    <textarea class="form-control" id="ObsHab" rows="4"></textarea>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="GEstadosHab()" id="PositivoG">Guardar Piso</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="GEstadosHabOffice()" id="NegativoG">Guardar Office</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="Hhabitacion" tabindex="-1" aria-labelledby="HhabitacionLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="HhabitacionLabel">Historial de Habitacion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="tablaHabi">

         

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>        
      </div>
    </div>
  </div>
</div>