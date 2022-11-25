<?php
    require_once "../../conServicios.php";
/// carga de habitaciones
    if (isset($_POST["cargaHab"])){
        $piso = $_POST["piso"];
   
           $cargaEstadosHab = mysqli_query($conServicios, "SELECT 
                                                       he.id AS idEstados,
                                                       h.Id,
                                                       h.Habitaciones,
                                                       h.Piso,
                                                       e.Estado,
                                                       e.Clase,
                                                       th.Id AS IdTipoHab,
                                                       th.TipoHab,
                                                       th.img
                                                       FROM 
                                                       habestados AS he
                                                       INNER JOIN habitacion AS h
                                                       ON he.hab = h.Id
                                                       INNER JOIN estados AS e
                                                       ON he.Estado = e.Id
                                                       INNER JOIN tipohabi AS th
                                                       ON he.Tipo = th.Id
                                                       WHERE h.Piso = $piso
                                                       ORDER BY Habitaciones;");
   
           $salida = '<div class="card-columns">';
   
           while($row=mysqli_fetch_array($cargaEstadosHab)) {
                   $salida .= '<div class="col mb-4">
                           <div class="card '.utf8_encode($row['Clase']).' mb-3" style="max-width: 18rem;" id = "1">
                               <div class="card-header">Habitacion '.utf8_encode($row['Habitaciones']).' <br> <p class="font-italic"> '.utf8_encode($row['TipoHab']).' </p> </div>
                               <div class="card-body">
                                   <div class="container">
                                       <div class="row">';
   
                                           if ($row['IdTipoHab'] == '1'){
                                               $salida .= '<div class="col-sm">
                                                           <button type="button"> <img src="./img/camaHabitacion.svg" height ="40" width="50" /></button>
                                                       </div>
                                                       <br>';
                                           }
                                           if ($row['IdTipoHab'] == '2'){
                                               $salida .= '<div class="col-sm">
                                                               <button type="button"> <img src="./img/camaHabitacion.svg" height ="40" width="50" /></button>
                                                           </div>
                                                           <br>';
                                               $salida .= '<div class="col-sm">
                                                   <button type="button"> <img src="./img/camaHabitacion.svg" height ="40" width="50" /></button>
                                               </div>
                                               <br>';
                                           }
                                           if ($row['IdTipoHab'] == 3){
                                               $salida .= '<div class="col-sm">                                                    
                                                               <button type="button"> <img src="./img/suite.svg" height ="40" width="50" /></button>
                                                           </div>
                                                           <br>';
                                           }
                                           if ($row['IdTipoHab'] == 4){
                                               $salida .= '<div class="col-sm">
                                                                   <button type="button"> <img src="./img/camaHabitacion.svg" height ="40" width="50" /></button>
                                                               </div>
                                                               <br>';
                                           }                                                                
   
                                       $salida .= '</div>
                                   </div>
                               </div>
                               <div class="card-footer">
                                   <input type="text" size="2" class="form-control" id="IdPiso" readonly value="'.utf8_encode($row['Piso']).'" hidden>
                                   <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#cambiarEstado" onclick="IdEstado('.utf8_encode($row['Id']).')" >Cambiar Estado</button>
                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detalleHabi" hidden>Detalle</button>
                                   <br><br>
                                   <small>
                                       <p class="text-decoration-none">
                                           Historial de Estado <a href="#" class="text-reset" onclick="HistorialEstado('.utf8_encode($row['idEstados']).')" data-toggle="modal" data-target="#HistorialEstado">Ultimo Estado</a>.
                                       </p>
                                   </small>
                               </div>                            
                           </div>
                       </div>';
           }
               $salida .= '
                           </div>';
   
               echo $salida;
    }

// cambiar estado Habitacion 
    if(isset($_POST["editEstadoHab"])){
            
        $idHab = $_POST["idHab"];
        $idest = $_POST['idest'];
        $obs = $_POST['obs'];
        $user = $_POST['user'];
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $DateAndTime = date('m-d-Y h:i:s a', time());  
        
        $valores = array();
        $valores['existe'] = "1";

        $consulta = "UPDATE habestados SET Estado =  $idest WHERE Hab = $idHab;";

        

        // echo $consulta;

        $consulta2 = "INSERT INTO historialEstado (Hab, Estado, Fecha, Obs, Usuario)
        VALUES ($idHab, $idest, '$DateAndTime', '$obs', '$user');";

        

        $resultadoUno = mysqli_query($conServicios,$consulta);
        $resultadoDos = mysqli_query($conServicios,$consulta2);

        if (!$resultadoUno) {
            echo "Error en la inserción habestados: ".$conServicios->error;
            $valores['existe'] = "0";
        }
        if (!$resultadoDos) {
            echo "Error en la inserción historialEstado: ".$conServicios->error;
            $valores['existe'] = "0";
        }

        $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
            echo $valores;
    }
