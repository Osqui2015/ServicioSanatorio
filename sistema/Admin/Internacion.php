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
    <?php  include_once "menuAdmin.php" ?>
    <br><br><br> 
    
    <div class="container d-flex justify-content-center">
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



    <br>
    <div class="container">
        <div class="row">
            <div class="col-md border-right border-top border-secondary border-bottom">
                <br>
                    <h4>CAMA A</h4>
                <br>
                    <label for="dniA">DNI</label>
                    <input class="form-control" type="text" id="dniA">
                <br>
                    <label for="nomapeA">Nombre y Apellido</label>
                    <input class="form-control" type="text" id="nomapeA">
                <br>
                    <label for="telA">Telefono</label>
                    <input class="form-control" type="text" id="telA">
                <br>
                <form id="form">
                    <label>
                    <input type="radio" name="Acomp" id="AcompA" value="1">
                    Acompañante
                    </label>
                    <label>
                    <input type="radio" name="Acomp" id="AcompA" value="0" checked>
                    Paciente
                    </label>
                </form>
                <br>
                    <button type="button" class="btn btn-info mb-3" id="button-a" >Guardar</button>
            </div>
            <!--- ------------------------------------------------------------------- --->
            <div class="col-md border-top border-secondary border-bottom">
                <br>
                    <h4>CAMA B</h4>
                <br>
                    <label for="dniB">DNI</label>
                    <input class="form-control" type="text" id="dniB">
                <br>
                <label for="nomapeB">Nombre y Apellido</label>
                    <input class="form-control" type="text" id="nomapeB">
                <br>
                    <label for="telB">Telefono</label>
                    <input class="form-control" type="text" id="telB">
                <br>
                <form id="form">
                    <label>
                    <input type="radio" name="Acomp" id="AcompB" value="1">
                    Acompañante
                    </label>
                    <label>
                    <input type="radio" name="Acomp" id="AcompB" value="0" checked>
                    Paciente
                    </label>
                </form>
                <br>
                    <button type="button" class="btn btn-info" id="button-b" >Guardar</button>
            </div>

        </div>
    </div>
    
    <script>
      $(document).ready(function(){
          
      });
    
    </script>
  </body>
</html>