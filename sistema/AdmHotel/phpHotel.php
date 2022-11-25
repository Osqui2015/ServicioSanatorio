<?php
    require_once "../../conServicios.php";

 
/// carga de habitaciones
    if (isset($_POST["cargaHab"])){
     $piso = $_POST["piso"];

        $cargaEstadosHab = mysqli_query($conServicios, "SELECT hd.Id,
                                                                hd.Dni,
                                                                h.Piso,
                                                                h.Hab,
                                                                h.Cama,
                                                                h.Ocupado,
                                                                e.Estado,
                                                                e.Clase,
                                                                hd.DniDos,
                                                                hd.IdCamaDos
                                                                FROM habdesg AS hd
                                                                
                                                                INNER JOIN hab AS h
                                                                ON hd.IdCama = h.Id
                                                                
                                                                INNER JOIN estados AS e
                                                                ON h.Estado = e.Id
                                                                
                                                                WHERE h.Piso = $piso");

        $salida = '<div class="row row-cols-1 row-cols-md-4">';

        while($row=mysqli_fetch_array($cargaEstadosHab)) {
                $salida .= '<div class="col mb-2">
                        <div class="card h-80 '.utf8_encode($row['Clase']).'" style="max-width: 15rem;" id = "1">
                            <div class="card-header">Habitacion '.utf8_encode($row['Hab']).' <br> <p class="font-italic">  </p> </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">';



                                       /* if ($row['IdTipoHab'] == '1'){
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
                                        }   */                                                             

                                    $salida .= '</div>
                                    <br>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm">
                                                <button type="button"> <img src="./img/persona.svg" height ="40" width="50" /></button>
                                            
                                                <button type="button"> <img src="./img/persona.svg" height ="40" width="50" /></button>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="text" size="2" class="form-control" id="IdPiso" readonly value="'.utf8_encode($row['Piso']).'" hidden>
                                <button type="button" class="btn btn-outline-light btn-sm" data-toggle="modal" data-target="#cambiarEstado" onclick="IdEstado('.utf8_encode($row['Id']).')" >Cambiar Estado</button>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detalleHabi">Detalle</button>
                                <br><br>
                                <small>
                                    <p class="text-decoration-none">
                                        Historial de Estado <a href="#" class="text-reset" onclick="HistorialEstado('.utf8_encode($row['Id']).')" data-toggle="modal" data-target="#HistorialEstado">Ultimo Estado</a>.
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
    
        $consulta = "UPDATE habestados SET Estado =  $idest WHERE Hab = $idHab;";

       // echo $consulta;

        $consulta2 = "INSERT INTO historialEstado (Hab, Estado, Fecha, Obs, Usuario)
        VALUES ($idHab, $idest, '$DateAndTime', '$obs', 'prueba');";
    
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
        $cargaEstadosHab = mysqli_query($conServicios, "SELECT HE.Id,
                                                        HE.Fecha,
                                                        H.Habitaciones,
                                                        E.Estado,
                                                        HE.Obs,
                                                        HE.Usuario
                                                        
                                                        FROM historialEstado AS HE
                                                        INNER JOIN habitacion AS H
                                                        ON HE.Hab = H.Id
                                                        
                                                        INNER JOIN estados AS E
                                                        ON HE.Estado = E.Id
                                                        
                                                        WHERE HE.Hab = $idHab
                                                        ORDER BY HE.Id DESC");
        

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
                                    <td>'.utf8_encode($fila['Habitaciones']).'</td>
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

// Agregar Habitaciones al Listado.
    if (isset($_POST['AddHabitacion'])){
        $habitacion = $_POST['habitacion'];
        $estado = $_POST['estado'];
        $tipo = $_POST['tipo'];
        $valores = array();
        $valores['existe'] = "1";
    
        $consulta2 = "INSERT INTO habestados (Hab, Estado, Tipo, E)
        VALUES ($habitacion,
                $estado,
                $tipo,
                1);";
    
        $resultadoDos = mysqli_query($conServicios,$consulta2);

        if (!$resultadoDos) {
            echo "Error en la inserción historialEstado: ".$conServicios->error;
            $valores['existe'] = "0";
        }

        $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
            echo $valores;
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