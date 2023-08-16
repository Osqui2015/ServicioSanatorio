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
    <title>Internacion</title>
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
      });
    
    </script>
  </body>
</html>