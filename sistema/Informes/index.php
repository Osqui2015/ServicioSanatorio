<?php
    session_start();
    //echo $_SESSION['tipo'];
    if(!empty($_SESSION['active'])){
        
    }else{
        header('location: ../../index.php');
    }
    $userr = $_SESSION['usuario']; /*VALOR USUARIO*/

    require_once "../../conSanatorio.php";    
    require_once "../../conServicios.php";

    $sql = "SELECT * FROM informes";


    $Info = mysqli_query($conServicios,$sql);

    
    $numRows = mysqli_num_rows($Info);                   

    

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultas</title>

    <?php require_once 'dependencias.php' ?>
  </head>
  <body onload="cTabla()">
    <?php require_once 'menu.php'?>


    <div class="container table-responsive-sm">
      <div class="card">
        <div class="card-body">    
                <div class="row justify-content-center">
                  <div class="col-md-6 text-center">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPaciente">
                        Carga de Paciente
                    </button>
                  </div>
                  <div class="col-md-2">
                    <select class="form-select form-select-sm" aria-label="Small select example" onchange="tabEstado()" id="tEstado">
                      <option value="3" selected>Ver Todos</option>
                      <option value="1">Activo</option>
                      <option value="0">Desactivado</option>
                    </select>
                  </div>
                </div>
                <br><br>
                <!--Tabla-->
                <div id="TablaEstados"></div>              
        </div>
      </div>
    </div> 

  </body>
 
  <script src="funciones.js"></script>
</html>

<?php ?>



<!-- Button trigger modal -->


<!-- Modal -->

<div class="modal fade" id="addPaciente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addPaciente" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cargas de Paciente</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
          <?php
            $fields = array(
              'NIngreso' => 'N de Ingreso',
              'NOIS' => 'OIS',
              'FechaIngreso' => 'Fecha de Ingreso',
              'NDni' => 'DNI',
              'NombreApellido' => 'Apellido y Nombre',
              'NAfiliado' => 'N° de Afiliado'
            );

            foreach ($fields as $field => $label) {
              echo '<div class="row">';
              echo '<label class="col-sm-4 col-form-label fst-italic fw-semibold" >' . $label . '</label>';
              echo '<div class="col-sm-8">';
              
              if ($field === 'FechaIngreso') {
                echo '<input type="date" class="form-control" name="' . $field . '" id="' . $field . '">';
              } else if ($field === 'NAfiliado') {                
                echo '
                
                        <div class="row">
                          <div class="col-2">
                            <input type="number" class="form-control" name="' . $field . 'uno" id="' . $field . 'uno">
                          </div>
                          <div class="col-1">
                                <p class="fw-bold"> - </p>
                          </div>
                          <div class="col-4">
                            <input type="number" class="form-control" name="' . $field . 'dos" id="' . $field . 'dos">
                          </div>
                          <div class="col-1">
                                <p class="fw-bold"> - </p>
                          </div>
                          <div class="col-2">
                            <input type="number" class="form-control" name="' . $field . 'tres" id="' . $field . 'tres">
                          </div>
                        </div>
                
                
                ';
              } else if ($field === 'NombreApellido') {
                echo '<input type="text" class="form-control" name="' . $field . '" id="' . $field . '">';
              } else {
                echo '<input type="number" class="form-control" name="' . $field . '" id="' . $field . '">';
              }
              
              echo '</div>';
              echo '</div><br>';
            }

            $sqlSec = "SELECT * FROM sectores WHERE EstadoSec = 1";            
            $InfoSec = mysqli_query($conServicios, $sqlSec);
            
            echo '<div class="row">';
            echo '<label class="col-sm-4 col-form-label fst-italic fw-semibold"> Sector </label>';
            echo '<div class="col-sm-8">';
            echo '<select class="form-select form-select-sm" aria-label="Small select example" id="Habitacion" name="Habitacion"> 
                  <option value=""></option>';
            while ($fila = $InfoSec->fetch_assoc()) {
                echo '<option value="' . $fila['id'] . '">' . $fila['Descripcion'] . '</option>';
            }
            echo '</select>';
            echo '</div>';
            echo '</div><br>';
            
          ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="VerificarDatos()">Guardar</button> 
      </div>
    </div>
  </div>
</div>



<!-- Button trigger modal -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="camSector" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="camSector" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="camSector">Cambio de Sector</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="form-floating mb-3">
            <input type="number" class="form-control form-control-sm" id="camNIngreso" disabled>
            <label for="camNIngreso">Numero Ingreso</label>
          </div>

          <?php

            $sqlSecc = "SELECT * FROM sectores WHERE EstadoSec = 1";
            $InfoSecc = mysqli_query($conServicios, $sqlSecc);
            
            echo '<div class="row">';
            echo '<label class="col-sm-4 col-form-label fst-italic fw-semibold"> Sector </label>';
            echo '<div class="col-sm-8">';
            echo '<select class="form-select form-select-sm" aria-label="Small select example" id="Sector">
                  <option value=""></option>';
            while ($fila = $InfoSecc->fetch_assoc()) {
                echo '<option value="' . $fila['id'] . '">' . $fila['Descripcion'] . '</option>';
            }
            echo '</select>';
            echo '</div>';
            echo '</div><br>';
            
          ?>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="CamEstadoIngreso()">Guardar</button>
      </div>
    </div>
  </div>
</div>


