<?php
    require_once "../../conServicios.php";
/// carga de habitaciones
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
                           <div class="card-body">
                               <div class="container">
                                   <div class="row">';

                                      // Obtener la información de todos los pacientes de la habitación
                                       $cargaPac = mysqli_query($conServicios, "SELECT * FROM habconsulta WHERE piso = $piso AND hab = $hab AND estado = 1");

                                       // Crear arreglos para almacenar la información de cada cama
                                       $camaUno = array();
                                       $camaDos = array();

                                       // Iterar sobre los resultados de la consulta
                                       while($row=mysqli_fetch_array($cargaPac)) {
                                           // Separar la información en función de la cama
                                           if ($row['Cama'] == 1) {
                                               $camaUno[] = $row;
                                           }
                                           else {
                                               $camaDos[] = $row;
                                           }
                                       }

                                       // Verificar si hay pacientes en la cama 1
                                       if (count($camaUno) == 0){
                                           $salida .= '<div class="col-sm">
                                                           <button type="button" class="border-0" > <img src="../../imagen/camav.png" height ="40" width="50" /></button>
                                                       </div>
                                                       <br>';
                                       }else {
                                           foreach ($camaUno as $row) {
                                               $salida .= '<div class="col-sm">
                                                               <button type="button" class="border-0" data-toggle="modal" data-target="#datosPaciente" onclick="datosPaciente('.utf8_encode($row['Dni']).')"> <img src="../../imagen/camao.png" height ="40" width="50" /></button>
                                                           </div>
                                                           <br>';
                                           }
                                       }

                                       // Verificar si hay pacientes en la cama 2
                                       if (count($camaDos) == 0){
                                           $salida .= '<div class="col-sm">
                                                           <button type="button" class="border-0" > <img src="../../imagen/camav.png" height ="40" width="50" /></button>
                                                       </div>
                                                       <br>';
                                       }else {
                                           foreach ($camaDos as $row) {
                                               $salida .= '<div class="col-sm">
                                                               <button type="button" class="border-0" data-toggle="modal" data-target="#datosPaciente" onclick="datosPaciente('.utf8_encode($row['Dni']).')"> <img src="../../imagen/camao.png" height ="40" width="50" /></button>
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
                               <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detalleHabi">Detalle</button>
                               <br><br>
                               <small>
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
    $obs = $_POST['obs'];
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $DateAndTime = date('m-d-Y h:i:s a', time());  
    
    $valores = array();
    $valores['existe'] = "1";

    $consulta = "UPDATE habitacion SET Estado =  $idest WHERE Habitaciones = $idHab";    

   // echo $consulta;

    $consulta2 = "INSERT INTO historialEstado (Hab, Estado, Fecha, Obs, Usuario)
    VALUES ($idHab, $idest, '$DateAndTime', '$obs', 'prueba')";

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

// datos paciente
if (isset($_POST['dniPaciente'])){
    $dni = $_POST['dni'];
    $valores = array();
    $valores['existe'] = "0";

    $consulta = "SELECT * FROM paciente WHERE Dni = $dni;";

    $resultados = mysqli_query($conServicios,$consulta);
    if (!$resultados) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    while($consulta = mysqli_fetch_array($resultados))
    {
        $valores['existe'] = "1";         
        $valores['id'] = $consulta['Id'];
        $valores['Dni'] = $consulta['Dni'];
        $valores['NomApe'] = $consulta['NomApe'];
        $valores['Tel'] = $consulta['Tel'];
        $valores['Tipo'] = $consulta['Tipo'];
    }
    
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;


}

// dar de Alta
if (isset($_POST['AltaPaciente'])){
    $dni = $_POST['dni'];

    $consulta = "UPDATE habconsulta
                SET Estado = 0
                WHERE Dni = $dni AND Estado = 1
                ORDER BY id DESC LIMIT 1;";
}