<?php 

    require_once '../conHoteleria.php';
    mysqli_set_charset($conHoteleria, "utf8");

    if (isset($_POST['cargaReporteHab'])) {
        $piso = $_POST["piso"];
    
    
        if ($piso == 0) {
            $consulta = "SELECT he.Id,
                                h.Piso AS H,
                                o.Piso AS O,
                                o.Detalle AS t,
                                he.Hab,
                                e.EstadoHab,
                                DATE_FORMAT(he.Fecha, '%d-%m-%Y %H:%i') AS fecha,
                                he.Obs,
                                he.Usuario
                                
                                FROM historialestado AS he
                                
                                LEFT JOIN estados AS e
                                ON he.Estado = e.Id
                                
                                LEFT JOIN habitaciones AS h
                                ON he.Hab = h.Habitacion
                                
                                LEFT JOIN office AS o
                                ON he.Hab = o.Habitacion";
        } else {
            $consulta = "SELECT he.Id,
                                h.Piso AS H,
                                o.Piso AS O,
                                o.Detalle AS t,
                                he.Hab,
                                e.EstadoHab,
                                DATE_FORMAT(he.Fecha, '%d-%m-%Y %H:%i') AS fecha,
                                he.Obs,
                                he.Usuario
                                
                                FROM historialestado AS he
                                
                                LEFT JOIN estados AS e
                                ON he.Estado = e.Id
                                
                                LEFT JOIN habitaciones AS h
                                ON he.Hab = h.Habitacion
                                
                                LEFT JOIN office AS o
                                ON he.Hab = o.Habitacion
                                                        
                                WHERE h.piso = $piso OR o.Piso = $piso";
        }


        $card = mysqli_query($conHoteleria,$consulta);
    
        $divCard = '';
    
        $divCard .= '
        <table id="tablaHab" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Piso</th>
                    <th>Habitacion</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Observacion</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>';
    while ($fila = $card->fetch_assoc()) {
        $divCard .= '
            <tr>
                <td>' . $fila['Id'] . '</td>
                <td>' . (!empty($fila['H']) ? $fila['H'] : $fila['O']) . '</td>
                <td>' . ($fila['Hab'] > 0 ? $fila['Hab'] : $fila['t']) . '</td>
                <td>' . $fila['EstadoHab'] . '</td>
                <td>' . $fila['fecha'] . '</td>
                <td>' . $fila['Obs'] . '</td>
                <td>' . $fila['Usuario'] . '</td>
            </tr>
        ';
    }
    $divCard .= '
            </tbody>
        </table> 
    ';
    
        $divCard .= '</div>
        <script src="funciones.js"></script>';
        echo $divCard;
    
    }