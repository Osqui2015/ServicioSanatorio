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
    
        $consulta = "UPDATE habitacion SET Estado =  $idest WHERE Habitaciones = $idHab;";

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
 
// historial estado habitacion de la
    if (isset($_POST['cargaHistorialEstado'])){
        $idHab = $_POST['idHab'];
        $cargaEstadosHab = mysqli_query($conServicios, "SELECT  hi.Id,
                                                                hi.Fecha,
                                                                hi.Hab,
                                                                e.Estado,
                                                                hi.Obs,
                                                                hi.Usuario
                                                                
                                                                FROM historialestado AS hi
                                                                
                                                                LEFT JOIN estados AS e
                                                                ON hi.Estado = e.Id
                                                                
                                                                WHERE hab = $idHab");
        

        $salida = '<div class="table-responsive">
        <table class="display compact table table-condensed table-striped table-bordered table-hover" id="example">
            <thead>
                <tr>
                    <th > ID </th>
                    <th > Fecha </th>
                    <th > Habitacion </th>
                    <th > Estado </th>
                    <th > Observacion </th>
                    <th > Usuario </th>                
                            
                </tr>
            </thead>
        
            
        
            <tbody>';

            while($fila = $cargaEstadosHab->fetch_assoc()){                                         
                    $salida.= '<tr>
                                    <td>'.utf8_encode($fila['Id']).'</td>
                                    <td>'.utf8_encode($fila['Fecha']).'</td>            
                                    <td>'.utf8_encode($fila['Hab']).'</td>
                                    <td>'.utf8_encode($fila['Estado']).'</td>
                                    <td>'.utf8_encode($fila['Obs']).'</td>
                                    <td>'.utf8_encode($fila['Usuario']).'</td>                            
                                </tr>';
                } 
                
            $salida.='</tbody>
                    </table> 
                </div>
                
                <script type="text/javascript">
                $(document).ready(function() {
                    $("#example").DataTable({ 
                        "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                        },
                        fixedHeader: {
                            header: true,
                            footer: true,
                        },
                        dom: "Bfrtip",
                        buttons:[ 
                            {
                                    extend:    "excelHtml5",
                                    text:      "Exportar a Excel",
                                    titleAttr: "Exportar a Excel",
                                    title:     "Título del documento",
                                    exportOptions: {
                                        columns: [2,3,4,5,6,7]
                                    }
                            },
                            {
                                    extend:    "pdfHtml5",
                                    text:      "Exportar a PDF",
                                    titleAttr: "Exportar a PDF",
                                    className: "btn btn-danger",
                                    title:     "Título del documento",
                                    exportOptions: {
                                        columns: [2,3,4,5,6,7]
                                    }                    
                            },
                            {
                                    extend:    "print",
                                    text:      "Imprimir",
                                    titleAttr: "Imprimir",
                                    className: "btn btn-info",
                                    exportOptions: {
                                        columns: [2,3,4,5,6,7]
                                    }
        
                            }
                        ],                        
                        ordering: false                        
                    });
                });
            </script>';
        echo $salida;                                                  
    }


    // usuario

    if (isset($_POST['GUser'])){
        $Nombre = utf8_encode($_POST['Nombre']);
        $Legajo = $_POST['Legajo'];
        $sector = $_POST['sector'];
        $passw = $_POST['passw'];
        $telf = $_POST['telf'];
        $email = $_POST['email'];
        $tipo = $_POST['tipo'];
    
        $valores = array();
        $valores['existe'] = "1";
    
        $consulta = "INSERT INTO usuario ( usuario, contra, NombreApe, Sector, Estado, Telefono, Email, Tipo )
                        VALUES( $Legajo,
                                md5('$passw'),
                                '$Nombre',
                                $sector,
                                1,
                                $telf,
                                '$email',
                                $tipo)";
    
        $resultadoUno = mysqli_query($conServicios,$consulta);
        if (!$resultadoUno) {
            echo "Error en la inserción Guardar: ".$conServicios->error;
            $valores['existe'] = "0";
        }
        $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
            echo $valores;
    
    }
    
    // traer datos user 
    if(isset($_POST['editarUser'])){ 
        $Legajo = $_POST['Legajo'];    
        $valores = array();
        $valores['existe'] = "0";
    
        $consulta = "SELECT * FROM usuario WHERE usuario = $Legajo ;";
    
        $resultados = mysqli_query($conServicios,$consulta);
        if (!$resultados) {
            echo "Error en la inserción Guardar: ".$conServicios->error;
            $valores['existe'] = "0";
        }
        while($consulta = mysqli_fetch_array($resultados))
        {
            $valores['existe'] = "1";         
            $valores['Usuario'] = $consulta['usuario'];
            $valores['Contra'] = $consulta['contra'];
            $valores['NombreApe'] = $consulta['NombreApe'];
            $valores['Sector'] = $consulta['Sector'];
            $valores['Telefono'] = $consulta['Telefono'];
            $valores['Email'] = $consulta['Email'];
        }
        
        $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
            echo $valores;
    
    }
    
    // editar users
    if (isset($_POST['GEditUser'])){
        $Nombre = utf8_encode($_POST['Nombre']);
        $Legajo = $_POST['Legajo'];
        $sector = $_POST['sector'];
        $passw = $_POST['passw'];
        $telf = $_POST['telf'];
        $email = $_POST['email'];
    
        $valores = array();
        $valores['existe'] = "1";
    
        $consulta = "UPDATE usuario SET contra =  md5('$passw'), NombreApe = '$Nombre', Telefono = $telf, Email = '$email' WHERE usuario = $Legajo";
    
        $resultadoUno = mysqli_query($conServicios,$consulta);
        if (!$resultadoUno) {
            echo "Error en la inserción Guardar: ".$conServicios->error;
            $valores['existe'] = "0";
        }
        $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
            echo $valores;
    
    }
    
    // borrar users
    if(isset($_POST['BorrarUser'])){
        $Legajo = $_POST['Legajo'];
        $valores = array();
        $valores['existe'] = "1";
    
        $consulta = "DELETE FROM usuario WHERE usuario =  $Legajo";
    
        $resultadoUno = mysqli_query($conServicios,$consulta);
        if (!$resultadoUno) {
            echo "Error en la inserción Guardar: ".$conServicios->error;
            $valores['existe'] = "0";
        }
        $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
            echo $valores;
    
    }
    
    // agregar sector
    if(isset($_POST['Gsector'])){ 
        $nomSector = $_POST['nomSector'];    
    
        $valores = array();
        $valores['existe'] = "1";
    
        $consulta = "INSERT INTO sector ( Sector, Estado)
                        VALUES('$nomSector', 1)";
    
        $resultadoUno = mysqli_query($conServicios,$consulta);
        if (!$resultadoUno) {
            echo "Error en la inserción Guardar: ".$conServicios->error;
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