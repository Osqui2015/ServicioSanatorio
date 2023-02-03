<?php
    require_once "../../conServicios.php";
/// carga de habitaciones
if (isset($_POST["cargaHabi"])){
    $piso = $_POST["piso"];

       $cargaHab = mysqli_query($conServicios, "SELECT * FROM habitacion WHERE piso = $piso ");

       $salida = '<div class="row row-cols-1 row-cols-md-4">';

       while($row=mysqli_fetch_array($cargaHab)) {
           
           $hab = $row['Habitaciones'];

               $estadoHabitacion = mysqli_query($conServicios, "SELECT ha.Id,
                                                                       ha.Piso,
                                                                       ha.Habitaciones,
                                                                       ha.Estado,
                                                                       e.Estado AS Detalle,
                                                                       e.imgUno,
                                                                       e.imgDos
                                                                       FROM habitacion AS ha
                                                                       
                                                                       LEFT JOIN estados AS e
                                                                       ON ha.Estado = e.Id
                                                                       WHERE ha.habitaciones = $hab");

               $salida .= '<div class="col mb-2"> 
                       <div class="card h-80 " style="max-width: 15rem;" id = "1">
                           <div class="card-header">
                               Habitacion '.utf8_encode($row['Habitaciones']).' 
                               <button type="button" class="border-0" > <img src="../../imagen/vacio.png" height ="40" width="50" /></button>
                           </div>
                           <div class="card-body" style="background-color:#f8f4f4;">
                               <div class="container">
                                   <div class="row">';

                                       $cargaPacUno = mysqli_query($conServicios, "SELECT * FROM habconsulta WHERE piso = $piso AND hab = $hab AND estado = 1 AND cama = 1");
                                           
                                           if (mysqli_num_rows($cargaPacUno) == 0){
                                               $salida .= '<div class="col-sm">
                                                           <button type="button" class="border-0" > <img src="../../imagen/camav.png" height ="40" width="50" /></button>
                                                       </div>
                                                       <br>';
                                           }else {
                                               while($row=mysqli_fetch_array($cargaPacUno)) {
                                                   $salida .= '<div class="col-sm">
                                                           <button type="button" class="border-0" > <img src="../../imagen/camao.png" height ="40" width="50" /></button>
                                                       </div>
                                                       <br>';
                                               }
                                           }
                                           


                                       $cargaPacDos = mysqli_query($conServicios, "SELECT * FROM habconsulta WHERE piso = $piso AND hab = $hab AND estado = 1 AND cama = 2");
                                           
                                       if (mysqli_num_rows($cargaPacDos) == 0){
                                           $salida .= '<div class="col-sm">
                                                       <button type="button" class="border-0" > <img src="../../imagen/camav.png" height ="40" width="50" /></button>
                                                   </div>
                                                   <br>';
                                       }else {
                                           while($row=mysqli_fetch_array($cargaPacDos)) {
                                               $salida .= '<div class="col-sm">
                                                       <button type="button" class="border-0" > <img src="../../imagen/camao.png" height ="40" width="50" /></button>
                                                   </div>
                                                   <br>';
                                           }
                                       }
                                                                                               

                                   $salida .= '</div>
                                   <br>
                                   <div class="row justify-content-center">';                                    
                                       
                                       if (mysqli_num_rows($estadoHabitacion) == 0){
                                           $salida .= '<div class="col-sm">
                                                       <button type="button" class="border-0" > <img src="../../imagen/camav.png" height ="40" width="50" /></button>
                                                   </div>
                                                   <br>';
                                       }else {
                                           while($row=mysqli_fetch_array($estadoHabitacion)) {
                                               $salida .= '<div class="col-sm">
                                                               <button type="button" class="border-0" > <img src="../../imagen/'.utf8_encode($row['imgUno']).'.png" height ="40" width="50" data-toggle="tooltip" data-placement="top" title="'.utf8_encode($row['imgUno']).'"/></button>
                                                           </div>
                                                           <div class="col-sm">
                                                               <button type="button" class="border-0" > <img src="../../imagen/'.utf8_encode($row['imgDos']).'.png" height ="40" width="50" data-toggle="tooltip" data-placement="top" title="'.utf8_encode($row['imgDos']).'"/></button>
                                                           </div>';
                                           }
                                       }                                            
                                           $salida .= '</div>
                               </div>
                           </div>
                           <div class="card-footer">                                
                               <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#cambiarEstado" onclick="IdEstado('.$hab.')" >Cambiar Estado</button>
                               <button hidden type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detalleHabi">Detalle</button>
                               <br><br>
                               <small hidden>
                                   <p class="text-decoration-none">
                                       Historial de Estado <a href="#" class="text-reset" onclick="HistorialEstado('.$hab.')" data-toggle="modal" data-target="#HistorialEstado">Ultimo Estado</a>.
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

if (isset($_POST["cargaHab"])){
    $piso = $_POST["piso"];

       $cargaHab = mysqli_query($conServicios, "SELECT * FROM habitacion WHERE piso = $piso ");

       $salida = '<div class="row row-cols-1 row-cols-md-4">';

       while($row=mysqli_fetch_array($cargaHab)) {
           
           $hab = $row['Habitaciones'];

               $estadoHabitacion = mysqli_query($conServicios, "SELECT ha.Id,
                                                                       ha.Piso,
                                                                       ha.Habitaciones,
                                                                       ha.Estado,
                                                                       e.Estado AS Detalle,
                                                                       e.imgUno,
                                                                       e.imgDos
                                                                       FROM habitacion AS ha
                                                                       
                                                                       LEFT JOIN estados AS e
                                                                       ON ha.Estado = e.Id
                                                                       WHERE ha.habitaciones = $hab");

               $salida .= '<div class="col mb-2"> 
                       <div class="card h-80 " style="max-width: 15rem;" id = "1">
                           <div class="card-header">
                               Habitacion '.utf8_encode($row['Habitaciones']).' 
                               <button type="button" class="border-0" > <img src="../../imagen/vacio.png" height ="40" width="50" /></button>
                           </div>
                           <div class="card-body" style="background-color:#f8f4f4;">
                               <div class="container">
                                   <div class="row">';

                                   $salida .= '<div class="row">';
                                   for ($i = 1; $i <= 2; $i++) {
                                     $query = "SELECT * FROM habconsulta WHERE piso = $piso AND hab = $hab AND estado = 1 AND cama = $i";
                                     $resultado = mysqli_query($conServicios, $query);
                                     if (mysqli_num_rows($resultado) == 0){
                                       $salida .= '<div class="col-sm">
                                                   <button type="button" class="border-0" > <img src="../../imagen/camav.png" height ="40" width="50" /></button>
                                                 </div>
                                                 <br>';
                                     } else {
                                       $salida .= '<div class="col-sm">
                                                   <button type="button" class="border-0" > <img src="../../imagen/camao.png" height ="40" width="50" /></button>
                                                 </div>
                                                 <br>';
                                     }
                                   }
                                   $salida .= '</div>';                                                    

                                   $salida .= '</div>
                                                    <br>
                                                    <div class="row justify-content-center">';

                                                    if (mysqli_num_rows($estadoHabitacion) == 0) {
                                                    $salida .= '<div class="col-sm">
                                                        <button type="button" class="border-0" > <img src="../../imagen/camav.png" height ="40" width="50" /></button>
                                                    </div>
                                                    <br>';
                                                    } else {
                                                    while($row = mysqli_fetch_array($estadoHabitacion)) {
                                                        $salida .= '<div class="col-sm">
                                                        <button type="button" class="border-0" > <img src="../../imagen/'.utf8_encode($row['imgUno']).'.png" height ="40" width="50" data-toggle="tooltip" data-placement="top" title="'.utf8_encode($row['imgUno']).'"/></button>
                                                        </div>
                                                        <div class="col-sm">
                                                        <button type="button" class="border-0" > <img src="../../imagen/'.utf8_encode($row['imgDos']).'.png" height ="40" width="50" data-toggle="tooltip" data-placement="top" title="'.utf8_encode($row['imgDos']).'"/></button>
                                                        </div>';
                                                    }
                                                    }
                                           $salida .= '</div>
                               </div>
                           </div>
                           <div class="card-footer">                                
                               <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#cambiarEstado" onclick="IdEstado('.$hab.')" >Cambiar Estado</button>
                               <button hidden type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detalleHabi">Detalle</button>
                               <br><br>
                               <small hidden>
                                   <p class="text-decoration-none">
                                       Historial de Estado <a href="#" class="text-reset" onclick="HistorialEstado('.$hab.')" data-toggle="modal" data-target="#HistorialEstado">Ultimo Estado</a>.
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
    $valores = array();
    $valores['existe'] = "1";
    $obs = addslashes(implode(", ", $_POST['obs']));

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $DateAndTime = date('m-d-Y h:i:s a', time());  

    $consulta = "UPDATE habitacion SET Estado = $idest WHERE Habitaciones = $idHab";
    $resultadoUno = mysqli_query($conServicios, $consulta);

    $consulta2 = "INSERT INTO historialestado (Hab, Estado, Fecha, Obs, Usuario)
    VALUES ($idHab, $idest, '$DateAndTime', '$obs', 'prueba')";
    $resultadoDos = mysqli_query($conServicios, $consulta2);

    if (!$resultadoUno || !$resultadoDos) {
        echo "Error en la consulta: " . $conServicios->error;
        $valores['existe'] = "0";
    }

    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;
}


