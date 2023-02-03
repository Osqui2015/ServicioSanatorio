<?php
    require_once "../../conServicios.php";
    

// USUARIO
    //traer datos usuario
        if (isset($_POST["traerDato"])){
            $legajo = $_POST["legajo"];
            $valores = array();

            $resultados = mysqli_query($conServicios, "SELECT * FROM usuario WHERE usuario = $legajo");
            if (!$resultados) {
            $valores['existe'] = "0";
            } else {
            while($consulta = mysqli_fetch_array($resultados)) {
                $valores = [
                'existe' => "1",
                'Usuario' => $consulta['usuario'],
                'Contra' => $consulta['contra'],
                'NombreApe' => $consulta['NombreApe'],
                'Sector' => $consulta['Sector'],
                'Telefono' => $consulta['Telefono'],
                'Email' => $consulta['Email'],
                ];
            }
            }

            echo json_encode($valores, JSON_THROW_ON_ERROR);            

        }
    //Modificar y Agregar Usuario
        if (isset($_POST['GEditUser'])){
            $Nombre = $_POST['Nombre'];
            $Legajo = $_POST['Legajo'];
            $sector = $_POST['sector'];
            $passw = $_POST['passw'];
            $telf = $_POST['telf'];
            $email = $_POST['email'];
            $agr = $_POST['agr'];            
        
            $valores = array();
            $valores['existe'] = "1";
        
                if ($agr === '0'){
                    $consulta = "INSERT INTO usuario ( usuario, contra, NombreApe, Sector, Estado, Telefono, Email, Tipo )
                                    VALUES( $Legajo,
                                            md5('$passw'),
                                            '$Nombre',
                                            $sector,
                                            1,
                                            $telf,
                                            '$email',
                                            1)";
                    
                }else{                    
                    $consulta = $passw != 0 ? "UPDATE usuario SET NombreApe = '$Nombre', Telefono = $telf, Sector = $sector, contra = $passw, Email = '$email' WHERE usuario = $Legajo" 
                    : "UPDATE usuario SET NombreApe = '$Nombre', Telefono = $telf, Sector = $sector, Email = '$email' WHERE usuario = $Legajo";
                }
            $resultadoUno = mysqli_query($conServicios,$consulta);
            if (!$resultadoUno) {
                echo "Error en la inserción Guardar: ".$conServicios->error;
                $valores['existe'] = "0";
            }
            $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
                echo $valores;
        }
    // dar de Baja o Alta
        if (isset($_POST['altaUser']) || isset($_POST['bajaUser'])) {
            $parameter = isset($_POST['altaUser']) ? 'altaUser' : 'bajaUser';
            $Legajo = $_POST['Legajo'];
            $estado = $parameter === 'altaUser' ? 1 : 0;
        
            $valores = array();
            $valores['existe'] = "1";
        
            $consulta = "UPDATE usuario SET Estado = $estado WHERE usuario = $Legajo";
            $resultadoUno = mysqli_query($conServicios, $consulta);
            if (!$resultadoUno) {
                echo "Error en la inserción Guardar: ".$conServicios->error;
                $valores['existe'] = "0";
            }
            $valores = JSON_encode($valores, JSON_THROW_ON_ERROR);
            echo $valores;
        }
    // Agregar Usuario
    
// SECTOR
    //traer dato
        if (isset($_POST['traerDatoSector'])){
            $id = $_POST['id'];
            $valores = array();
            $valores['existe'] = "1";
            $resultados = mysqli_query($conServicios, "SELECT * FROM sector WHERE id = $id");
            if (!$resultados) {
                $valores['existe'] = "0";
            } else {
                while($consulta = mysqli_fetch_array($resultados)) {
                    $valores = [
                    'existe' => "1",
                    'id' => $consulta['id'],
                    'Sector' => $consulta['Sector'],
                    ];
                }
            }

            echo json_encode($valores, JSON_THROW_ON_ERROR); 
        }
    //borrar
        if (isset($_POST['borrarSector'])){
            $id = $_POST['id'];
            $valores = array();
            $valores['existe'] = "1";
        
            $consulta = "DELETE FROM sector WHERE id = $id;";
            $resultadoUno = mysqli_query($conServicios, $consulta);
            if (!$resultadoUno) {
                echo "Error en la inserción Guardar: ".$conServicios->error;
                $valores['existe'] = "0";
            }
            $valores = JSON_encode($valores, JSON_THROW_ON_ERROR);
            echo $valores;
        }
    //guardar
        if (isset($_POST['GSector'])){
            $id = $_POST['id'];
            $nom = $_POST['Nom'];

            $valores = array();
            $valores['existe'] = "1";

            if (empty($id)) {
                $consulta = "INSERT INTO sector (Sector, Estado) VALUES ('$nom', 1)";
            }else{
                $consulta = "UPDATE sector SET Sector = '$nom' WHERE id = $id";
            }

            $resultadoUno = mysqli_query($conServicios, $consulta);
            if (!$resultadoUno) {
                echo "Error en la inserción/actualización: " . mysqli_error($conServicios);
                $valores['existe'] = "0";
            }
            $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
                echo $valores;

        }

//HABITACIONES
        //carga de pantalla
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
        
                                                $cama1Ocupada = mysqli_query($conServicios, "SELECT * FROM habconsulta WHERE piso = $piso AND hab = $hab AND estado = 1 AND cama = 1");
                                                $cama2Ocupada = mysqli_query($conServicios, "SELECT * FROM habconsulta WHERE piso = $piso AND hab = $hab AND estado = 1 AND cama = 2");
                                                
                                                $salida .= '<div class="col-sm">
                                                            <button type="button" class="border-0" > <img src="../../imagen/' . (mysqli_num_rows($cama1Ocupada) == 0 ? 'camav' : 'camao') . '.png" height ="40" width="50" /></button>
                                                        </div>
                                                        <br>';
                                                
                                                $salida .= '<div class="col-sm">
                                                            <button type="button" class="border-0" > <img src="../../imagen/' . (mysqli_num_rows($cama2Ocupada) == 0 ? 'camav' : 'camao') . '.png" height ="40" width="50" /></button>
                                                        </div>
                                                        <br>';
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
        // cambiar estado 
            if(isset($_POST["editEstadoHab"])){
                    
                $idHab = $_POST["idHab"];
                $idest = $_POST['idest'];
                $obs = $_POST['obs'];

                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $DateAndTime = date('m-d-Y h:i:s a', time());  
                
                $valores = array();
                $valores['existe'] = "1";

                $consulta = "UPDATE habitacion SET Estado =  $idest WHERE Habitaciones = $idHab;
                                INSERT INTO historialestado (Hab, Estado, Fecha, Obs, Usuario)
                                VALUES ($idHab, $idest, '$DateAndTime', '$obs', 'prueba')";

                if (mysqli_multi_query($conServicios,$consulta)) {
                    $valores['existe'] = "1";
                } else {
                    echo "Error en la inserción: ".$conServicios->error;
                    $valores['existe'] = "0";
                }

                $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
                    echo $valores;
            }
        // historial
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

//PASIENTE
            //carga
                if (isset($_POST['cargarHabitacion'])){
                    $dni = $_POST['dni'];
                    $nomape = $_POST['nomape'];
                    $tel = $_POST['tel'];
                    $cama = $_POST['cama'];
                    $idPiso = $_POST['idPiso'];
                    $idHabitacion = $_POST['idHabitacion'];
            
                    date_default_timezone_set('America/Argentina/Buenos_Aires');
                    $DateAndTime = date('Y-m-d h:i:s', time());
            
                    $valores = array();
                    $valores['existe'] = "1";
            
                    $consultaUna = "INSERT INTO habconsulta ( Piso, Hab, Cama, Estado, Fecha, Dni)
                    VALUES($idPiso, $idHabitacion, $cama, 1, '$DateAndTime', $dni )";
            
                    $resultadoUno = mysqli_query($conServicios,$consultaUna);
                    if (!$resultadoUno) {
                        echo "Error en la resultadoUno Guardar: ".$conServicios->error;
                        $valores['existe'] = "0";
                    }
            
                    $consultaDos = "INSERT INTO paciente ( Dni, NomApe, Tel, Tipo)
                    VALUES($dni, $nomape, $tel, 1)";
            
                    $resultadoDos = mysqli_query($conServicios,$consultaDos);
                    if (!$resultadoDos) {
                        echo "Error en la resultadoDos Guardar: ".$conServicios->error;
                        $valores['existe'] = "0";
                    }
            
                    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
                    echo $valores;
                }












////////////////////////////////

// Verifica que se haya enviado la foto, el título y el texto

//$página_inicio = file_get_contents('http://www.example.com/');
$imagenCodificada = file_get_contents("php://input"); //Obtener la imagen
if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
//La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
$imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
//Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
//todo el contenido lo guardamos en un archivo
$imagenDecodificada = base64_decode($imagenCodificadaLimpia);
//Calcular un nombre único
$nombreImagenGuardada = "./foto_capturada/nombre_" ."aca pongo el nombre xxxx". uniqid() . ".png";
//Escribir el archivo
/*                    "./foto_capturada/foto_" . uniqid() . ".png";
$fichero = 'gente.txt';
// Abre el fichero para obtener el contenido existente
$actual = file_get_contents($fichero);
// Añade una nueva persona al fichero
$actual .= "John Smith\n";
// Escribe el contenido al fichero
file_put_contents($fichero, $actual);
*/
file_put_contents($nombreImagenGuardada, $imagenDecodificada);
//Terminar y regresar el nombre de la foto
exit($nombreImagenGuardada);
