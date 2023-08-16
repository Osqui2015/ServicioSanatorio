<?php
  session_start();
  // echo $_SESSION['tipo'];


  $userr = $_SESSION['usuario'];  

  if (!isset($_SESSION['active'])) {
    echo "<script>
      alert ('Debe iniciar sesión para acceder a esta página');
      window.location = '../../login.php';
      </script>";
  }
  require_once "conServicios.php";

  mysqli_set_charset($conServicios, "utf8");
  
  $Consultasql = "SELECT tm.*,
                    us.NombreApe 

                    FROM tabla_metricas AS tm

                    LEFT JOIN usuario AS us
                    ON tm.Legajo = us.usuario
                    WHERE Legajo = $userr ";

  $metricas = mysqli_query($conServicios, $Consultasql);

?>
 
  
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Metricas</title>
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
            <table id="Tdoc" class="table compact table-striped">
              <thead>
                <tr>
                  <th scope="col"> Legajo </th>
                  <th scope="col"> Fecha de Carga </th>
                  <th scope="col"> Nombre </th>
                  <th scope="col"> Fecha </th>
                  <th scope="col"> N° Caso </th>
                  <th scope="col"> Puntaje </th>
                  <th scope="col"> Estado </th>
                  <th scope="col"></th>                                    
                </tr>
              </thead>
              <tbody>
                <?php while ($fila = $metricas->fetch_assoc()) { ?>
                  <tr>
                    <td> <?php echo $fila['Legajo'] ?> </td>
                    <td> <?php echo $fila['Fecha_Carga'] ?> </td>
                    <td> <p class="fw-medium"> <?php echo $fila['NombreApe'] ?> </p> </td>
                    <td> <?php echo $fila['Fecha'] ?> </td>
                    <td> <?php echo $fila['Num_Caso'] ?> </td>
                    <td> <?php echo $fila['Puntaje'] ?> </td>
                    <td>
                        <?php $estado = $fila['EstadoCarg'];
                            if ($estado == 0) {
                                echo "Pendiente";
                            } elseif ($estado == 1) {
                                echo "Aceptado";
                            } elseif ($estado == 2) {
                                echo "Rechazado";
                            } else {
                                echo "Estado desconocido";
                            } 
                        ?> 
                    </td>
                    <td> <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#infoMetricas" onclick="idMetrica(<?php echo $fila['Num_Caso'] ?>)"> Ver </button> </td>
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
<div class="modal fade" id="infoMetricas" tabindex="-1" aria-labelledby="infoMetricasLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="infoMetricasLabel">Resultados Metricas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div id="respuesta"></div>
        </div>


        


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>