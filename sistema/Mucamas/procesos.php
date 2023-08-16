<?php 

    require_once 'conHoteleria.php';
    mysqli_set_charset($conHoteleria, "utf8");

if (isset($_POST['cargaHab'])) {
    $piso = $_POST["piso"];
    $divCard = '';

    $card = mysqli_query($conHoteleria, "SELECT * 
                                                FROM habitaciones AS h
                                                LEFT JOIN estados AS e
                                                ON h.Estado = e.Id
                                                WHERE piso = $piso;");
    $cardOf = mysqli_query($conHoteleria, "SELECT * 
                                                FROM office AS o
                                                LEFT JOIN estados AS eo
                                                ON o.Estado = eo.Id
                                                WHERE piso = $piso;");
    $divCard .= '<div class="card">
                    <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-5 g-5">';

                    while ($fila = $cardOf->fetch_assoc()) {
                        $divCard .= '
                        <!-- CARD Office -->
                            <div class="col">
                                <div class="card text-center">
                                    <div class="card-header">
                                        ' . $fila['Detalle'] . '
                                    </div>
                                        <div class="card-body">
                                            <div class="container text-center">
            
                                                <div class="row justify-content-md-center">';
                                                    switch ($fila['Tipo']) {
                                                        case 5:
                                                            $divCard .= '<div class="col">
                                                                <img src="./img/enfermeria.png" class="img-fluid" style="width: 90px; height: 70px;">
                                                            </div>';
                                                            break;
                                                        case 6:
                                                            $divCard .= '<div class="col">
                                                                <img src="./img/medico.png" class="img-fluid" style="width: 70px; height: 70px;">
                                                            </div>';
                                                            break;
                                                        case 7:
                                                            $divCard .= '<div class="col">
                                                                <img src="./img/mucama.png" class="img-fluid" style="width: 90px; height: 70px;">
                                                            </div>';
                                                            break;
                                                    }
                                    $divCard .= '</div>
                                                <br>
                                                <div class="row justify-content-md-center">                                
                                                    <div class="col">
                                                        <img src="./img/' . $fila['img'] . '" class="img-fluid" style="width: 50px; height: 50px;">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row justify-content-md-center">
                                                    <div class="col">
                                                        <button type="button" class="btn btn-outline-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#EstadoHab" onclick="CamEstado(' . $fila['Habitacion'] . ')" >Estado </button>
                                                    </div>
                                                    <div class="col">
                                                        <button type="button" class="btn btn-info btn-sm" hidden> Detalle </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="card-footer text-body-secondary">
                                        <p class="text-decoration-none">
                                            Historial de Estado <a href="#" class="link-underline-primary" onclick="HHab(' . $fila['Habitacion'] . ')"  data-bs-toggle="modal" data-bs-target="#Hhabitacion">Ultimo Estado</a>.
                                        </p>
                                    </div>
                                </div>
                            </div>    
                        <!--  --> ';
                    }                    

    $divCard .= '</div>
    </div>
                </div>
        <br><br>'
    ;                                            

    $divCard .= '<div class="card">
        <div class="card-body">
    
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4"> ';
        while ($fila = $card->fetch_assoc()) {
            $divCard .= '
            <!-- CARD HABITACION -->
                <div class="col">
                    <div class="card text-center">
                        <div class="card-header">
                            Cama: ' . $fila['Habitacion'] . '
                        </div>
                            <div class="card-body">
                                <div class="container text-center">

                                    <div class="row justify-content-md-center">';
                                        switch ($fila['Tipo']) {
                                            case 1:
                                                $divCard .= '<div class="col">
                                                    <img src="./img/camaHabitacion.svg" class="img-fluid" style="width: 150px; height: 70px;">
                                                </div>';
                                                break;
                                            case 2:
                                                $divCard .= '<div class="col">
                                                    <img src="./img/camaHabitacion.svg" class="img-fluid" style="width: 150px; height: 70px;">
                                                </div>
                                                <div class="col">
                                                    <img src="./img/camaHabitacion.svg" class="img-fluid" style="width: 150px; height: 70px;">
                                                </div>';
                                                break;
                                            case 4:
                                                $divCard .= '<div class="col">
                                                    <img src="./img/camaHabitacion.svg" class="img-fluid" style="width: 150px; height: 70px;">
                                                </div>
                                                <div class="col">
                                                    <img src="./img/sofa.png" class="img-fluid" style="width: 80px; height: 70px;">
                                                </div>';
                                                break;
                                        }
                        $divCard .= '</div>
                        <br>
                                    <div class="row justify-content-md-center">                                
                                        <div class="col">
                                            <img src="./img/' . $fila['img'] . '" class="img-fluid" style="width: 50px; height: 50px;">
                                        </div>
                                        <div class="col">
                                            <img src="./img/' . $fila['imdDos'] . '" class="img-fluid" style="width: 50px; height: 50px;">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row justify-content-md-center">
                                        <div class="col">
                                            <button type="button" class="btn btn-outline-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#EstadoHab" onclick="CamEstado(' . $fila['Habitacion'] . ')" >Estado </button>
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-info btn-sm" hidden> Detalle </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="card-footer text-body-secondary">
                            <p class="text-decoration-none">
                                Historial de Estado <a href="#" class="link-underline-primary" onclick="HHab(' . $fila['Habitacion'] . ')"  data-bs-toggle="modal" data-bs-target="#Hhabitacion">Ultimo Estado</a>.
                            </p>
                        </div>
                    </div>
                </div>    
            <!--  --> ';
        }
    $divCard .= '
        </div>
        </div>
        </div>

    <script src="funciones.js"></script>';
    echo $divCard;
}


if (isset($_POST['EstadoHab'])) {
    $SEstado = $_POST["SEstado"];

    $valorHab = $_POST["valorSpan"];
    $valorHab = intval($valorHab);

    
    

    $ObsHab = $_POST["ObsHab"];

    $user = $_POST["user"];


    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $DateAndTime = date('Y-m-d h:i:s', time());

    $valores['existe'] = 1;
    
    echo $valorHab;
    echo $SEstado;
    echo $ObsHab;
    echo $user;


    if ($valorHab > 0) {
        $consulta = "UPDATE habitaciones SET Estado = $SEstado WHERE Habitacion = $valorHab;";
    } else if ($valorHab < 0) {
        $consulta = "UPDATE office SET Estado = $SEstado WHERE Habitacion = $valorHab;";
    } 

    echo $consulta;

    $resultadoUno = mysqli_query($conHoteleria,$consulta);

    if (!$resultadoUno) {
        echo "Error en la inserción habestados: ".$conHoteleria->error;
        $valores['existe'] = "0";
    }

    $consulta2 = "INSERT INTO historialestado (Hab, Estado, Fecha, Obs, Usuario)
    VALUES ($valorHab, $SEstado, '$DateAndTime', '$ObsHab', '$user')"; 

    $resultadoDos = mysqli_query($conHoteleria,$consulta2);
    if (!$resultadoDos) {
        echo "Error en la inserción historialEstado: ".$conHoteleria->error;
        $valores['existe'] = "0";
    }


    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;
}


if (isset($_POST['cargaHisHab'])) {
    $piso = $_POST["piso"];
    $fechaActual = date('Y-m-d');    

    $divTab = '<div class="container table-responsive-sm">
    <table class="table">
        <caption>Tabla de Estados</caption>
        <thead>
            <tr>
            <th scope="col">Fecha</th>
            <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>';
    $td = "SELECT *
    FROM historialestado AS hh
    
    LEFT JOIN estados AS e
    ON e.Id = hh.Estado
    
    WHERE hh.fecha LIKE '%$fechaActual%'
    AND hh.hab = $piso;";


    $tdatos = mysqli_query($conHoteleria, $td);

                                            
    while ($fila = $tdatos->fetch_assoc()) {
        $divTab .= '
                    <tr>
                        <th scope="row">' . $fila['Fecha'] . '</th>
                        <td>' . $fila['EstadoHab'] . '</td>
                    </tr>';
    }
    $divTab .= '</tbody>
        </table>
    </div>';

    echo $divTab;

} 