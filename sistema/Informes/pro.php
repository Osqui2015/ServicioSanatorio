<?php
include '../../conServicios.php';

if (isset($_POST['mEstado'])) {

    $Ingreso = $_POST['nIngreso'];    
    $Es = $_POST['Es'];

    $sql = "UPDATE 
                informes
            SET 
                Estado = $Es
            WHERE 
                Id = $Ingreso";

    $Info = mysqli_query($conServicios,$sql);

    if ($Info) {
        echo "La Modificacion. se realizó correctamente.";
    } else {
        echo "Error al realizar la modificación: " . mysqli_error($conServicios);
    }

}


if (isset($_POST['mEstadoH'])) {

    $Ingreso = $_POST['nIngreso'];    
    $Es = $_POST['Es'];

    $sql = "UPDATE 
                informes
            SET 
                Internado = $Es
            WHERE 
                Id = $Ingreso";

    $Info = mysqli_query($conServicios,$sql);

    if ($Info) {
        echo "La modificación se realizó correctamente.";
    } else {
        echo "Error al realizar la modificación: " . mysqli_error($conServicios);
    }

}



if (isset($_POST['mEstadoSector'])) {

    $Ingreso = $_POST['nIngreso'];    
    $sector = $_POST['sector'];

    $sql = "UPDATE 
                informes
            SET 
                Habitacion = $sector
            WHERE 
                NIngreso = $Ingreso";

    $Info = mysqli_query($conServicios,$sql);

    if ($Info) {
        echo "La modificación se realizó correctamente.";
    } else {
        echo "Error al realizar la modificación: " . mysqli_error($conServicios);
    }

}


if (isset($_POST['verT'])) {
    $estado = $_POST['estado']; 

    if ($estado == '3') {
        $sql = "SELECT * 
        FROM informes AS fr
        LEFT JOIN sectores AS sec
        ON fr.Habitacion = sec.id";
    }else{
        $sql = "SELECT * 
        FROM informes AS fr
        LEFT JOIN sectores AS sec
        ON fr.Habitacion = sec.id
        WHERE fr.Estado = $estado";
    }    
    
    $tTablaEstado = mysqli_query($conServicios, $sql);

    if ($tTablaEstado) {
        $numRegistros = mysqli_num_rows($tTablaEstado);
        // echo "Número de registros encontrados: $numRegistros";
    } else {
        // echo "Error en la consulta: " . mysqli_error($conServicios);
    }

    $salida = '';  // Inicializar la variable $salida antes del bucle
    
        $salida .= '
        <table class="table table-striped table-hover table-bordered table-sm" id="TInformes">
            <thead>
                <tr>
                    <th scope="col">DNI</th>
                    <th scope="col">N° Ingreso</th>
                    <th scope="col">Nombre Apellido</th>
                    <th scope="col">N° Afiliado</th>
                    <th scope="col">N° OIS</th>
                    <th scope="col">Fecha Ingreso</th>
                    <th scope="col">Estado</th>
                    <th></th>
                    <th>Sector</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>';

        // Use el nombre de la variable correcto, $tTablaEstado en lugar de $Info
        while ($fila = $tTablaEstado->fetch_assoc()) {

            $salida .= '
                <tr>
                    <th scope="row">' . $fila['NDni'] . '</th>
                    <td>' . $fila['NIngreso'] . '</td>
                    <td>' . $fila['NombreApellido'] . '</td>
                    <td>' . $fila['NAfiliado'] . '</td>
                    <td>' . $fila['NOIS'] . '</td>
                    <td>' . $fila['FIngreso'] . '</td>
                    <td>';

            $estado = $fila['Estado'];
            $texto = $estado == 1 ? 'Activo' : 'Desac';
            $btnClass = $estado == 1 ? 'btn-success' : 'btn-danger';
            $btnAction = $estado == 1 ? 'estadoAct' : 'estadoDes';

            $salida .= '
                    <button type="button" class="btn btn-sm ' . $btnClass . '" onclick="' . $btnAction . '(' . $fila['Id'] . ')">' . $texto . '</button>
                </td>

                <td>';

                        $estados = $fila['Internado'];
                        $textos = $estados == 1 ? 'Internado' : 'Alta';
                        $btnClasss = $estados == 1 ? 'btn-info' : 'btn-dark';
                        $btnActions = $estados == 1 ? 'estadoActInter' : 'estadoDesAlta';
    
                $salida .= '
                        <button type="button" class="btn btn-sm ' . $btnClasss . '" onclick="' . $btnActions . '(' . $fila['Id'] . ')">' . $textos . '</button>
                    </td>

                <td>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="camSe(' . $fila['NIngreso'] . ')"  data-bs-toggle="modal" data-bs-target="#camSector">' . $fila['Corto'] . '</button>
                </td>


                <td>
                    <button type="button" class="btn btn-primary btn-sm" onclick="ver(' . $fila['Id'] . ')">Ver</button>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="Delete(' . $fila['Id'] . ', ' . $fila['NIngreso'] . ')">Elim</button>
                </td>
            </tr>';
        }

        $salida .= '
            </tbody>
        </table>
        <script>
        $(document).ready(function() {
            $("#TInformes").DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                },
                    fixedHeader: {
                    header: true,
                    footer: true
                },
                responsive: true,
                dom: "Bfrtip",
                buttons: [                        
                            {
                                extend: "pdfHtml5",
                                text: "PDF",
                                titleAttr: "Exportar a PDF",
                                title: "Título del documento",                    
                            }
                ]                        
            });
    
        });       
      </script>
        
        
        ';    

    echo $salida;
}

if (isset($_POST['verf'])) {
    $NIngreso = $_POST['NIngreso'];   
    $NOIS = $_POST['NOIS'];

    $sql = "SELECT * FROM informes WHERE NIngreso = $NIngreso OR NOIS = $NOIS";    

    $tVerificacion = mysqli_query($conServicios, $sql);

    $response = array();

    if ($tVerificacion) {
        $numRegistros = mysqli_num_rows($tVerificacion);
        $numRegistros = json_encode($numRegistros);
        echo $numRegistros;
    } else {
        $numRegistros = 100;
        $numRegistros = json_encode($numRegistros);
        echo $numRegistros;
    }
    
}


if (isset($_POST['mDelete'])) {
    // Evitar inyección de SQL usando prepared statements
    $nId = $_POST['nId'];

    // Consulta preparada para eliminar informes por su ID
    $sql = "DELETE FROM informes WHERE Id = ?";
    $stmt = mysqli_prepare($conServicios, $sql);
    mysqli_stmt_bind_param($stmt, "i", $nId);
    
    // Ejecutar la consulta
    $Info = mysqli_stmt_execute($stmt);

    if ($Info) {
        // Eliminación exitosa, eliminar carpeta de archivos
        $Ingreso = $_POST['nIngreso'];
        $carpeta = "../uploads/$Ingreso";        

        if (is_dir($carpeta)) {
            eliminarCarpetaRecursiva($carpeta);
        }

        if (is_dir($carpeta)) {
            echo "La carpeta existe."; // Agrega este mensaje para depurar
            eliminarCarpetaRecursiva($carpeta);
        } else {
            echo "La carpeta no existe."; // Agrega este mensaje para depurar
        }

        echo "La eliminación se realizó correctamente.";
    } else {
        echo "Error al realizar la eliminación: " . mysqli_error($conServicios);
    }

}

    // Función para eliminar una carpeta y su contenido de manera recursiva
    function eliminarCarpetaRecursiva($carpeta) {
        $archivos = glob($carpeta . '/*');

        foreach ($archivos as $archivo) {
            if (is_dir($archivo)) {
                eliminarCarpetaRecursiva($archivo);
            } else {
                unlink($archivo);
            }
        }

        rmdir($carpeta);
    }



