<?php
    require_once "../../conServicios.php";
    
/* -----------MUESTRA VALORES EN LA TABLA POR LA FECHA SELECCIONADA------------------ */
if(isset($_POST['fbuscar'])){ 
    $matricula = $_POST['matricula'];
           
    $turnTabla = mysqli_query($conServicios,"SELECT obc.id,
                                                    ob.nombre,
                                                    ob.plan,
                                                    obc.Costo,
                                                    obc.Tipo,
                                                    es.Estudios,
                                                    obc.CostoEstudio
                                                    
                                                    FROM obrascosto AS obc
                                                    
                                                    INNER JOIN profesional AS pr ON pr.Matricula = obc.Matricula
                                                    
                                                    INNER JOIN obrasocial AS ob ON obc.ObraSocial = ob.Id
                                                    
                                                    LEFT JOIN estudios AS es ON obc.Estudio = es.Id
                                                    
                                                    WHERE obc.Matricula = $matricula");

        $docInfo = mysqli_query($conServicios,"SELECT * FROM profesional WHERE Matricula = $matricula;");

            

        $salida = <<<HTML
        <div class="card mb-3" style="max-width: 500px;">
            <div class="row no-gutters">            
                <div class="col">
                    <div class="card-body"> 
        HTML;
                        while($datos = $docInfo->fetch_assoc()){
                            $salida .= <<<HTML
                                        <h5 class="card-title">{$datos['NomApe']}</h5>
                                        <p class="card-text"><small class="text-muted">{$datos['Especialidad']}</small></p>
                                        <p class="card-text"> {$datos['Consultorio']} </p>
                                        <p class="card-text"> {$datos['HorarioAtencion']}</p>
                                        <p class="card-text"><small class="text-muted">Teléfono: {$datos['Telefono']} </small></p>
                                        <p class="card-text"><small class="text-muted">Email: {$datos['Email']} </small></p>
                                        <label for="exampleFormControlTextarea1"> Observaciones </label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled> {$datos['Obs']} </textarea>
                                        HTML;
    
                        }   
                        $salida.=<<<HTML
                            </div>
                        </div>
                        
                    </div>
                </div>
                <br>
                HTML;


       

        $salida .= <<<HTML
        <div class="table-responsive">
            <table class="display compact table table-condensed table-striped table-bordered table-hover" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Obra Social</th>
                        <th>Tipo</th>
                        <th>Costo</th>
                        <th>Estudio</th>
                        <th>Costo Estudio</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Quitar</th>
                    </tr>
                </thead>
                <tbody>
        HTML;
        
        while ($fila = $turnTabla->fetch_assoc()) {
            $salida .= <<<HTML
                <tr>
                    <td>{$fila['id']}</td>
                    <td>{$fila['nombre']}</td>
                    <td>{$fila['plan']}</td>
                    <td>{$fila['Costo']}</td>
                    <td>{$fila['Tipo']}</td>
                    <td>{$fila['Estudios']}</td>
                    <td>{$fila['CostoEstudio']}</td>
                    <td>
                        <button type="button" class="btn btn-warning" onclick="EditarOBS({$fila['id']})" data-toggle="modal" data-target="#editarCostoOBS">Editar</button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="BorrarOBS({$fila['id']})">Borrar</button>
                    </td>
                </tr>
        HTML;
        }
        
        $salida .= <<<HTML
                </tbody>
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
                footer: true
            },
            dom: "Bfrtip",
            buttons: [
                {
                    extend: "excelHtml5",
                    text: "Exportar a Excel",
                    titleAttr: "Exportar a Excel",
                    title: "Título del documento",                    
                },
                {
                    extend: "pdfHtml5",
                    text: "Exportar a PDF",
                    titleAttr: "Exportar a PDF",
                    title: "Título del documento",                    
                }
            ],
            initComplete: function(settings, json) {
                $("#example").wrap("<div style='overflow:auto; width:100%;height:100%;'></div>");
            }
        });
        });
        </script>
        HTML;
    
        echo $salida;
    
}

if(isset($_POST['Tabla'])){ 
    $matricula = $_POST['matricula'];    
    $ObraSocial = $_POST['ObraSocial'];

    
    if (($matricula == 00) && ($ObraSocial != 00)) {

        $infoObraSocial = mysqli_query($conServicios,"SELECT ob.Nombre,
                                                                ob.Plan,
                                                                obs.Costo,
                                                                obs.Tipo,
                                                                pr.Matricula,
                                                                pr.NomApe,
                                                                es.Especialidad
                                                                
                                                                FROM obrascosto AS obs
                                                                
                                                                INNER JOIN obrasocial AS ob
                                                                ON obs.ObraSocial = ob.Id
                                                                
                                                                INNER JOIN profesional AS pr
                                                                ON obs.Matricula = pr.Matricula
                                                                
                                                                INNER JOIN especialidad AS es
                                                                ON pr.Especialidad = es.Id
                                                                
                                                                WHERE obs.ObraSocial = $ObraSocial");
    }
    if (($matricula != 00) && ($ObraSocial == 00)) {

        $infoObraSocial = mysqli_query($conServicios,"SELECT ob.Nombre,
                                                                ob.Plan,
                                                                obs.Costo,
                                                                obs.Tipo,
                                                                pr.Matricula,
                                                                pr.NomApe,
                                                                es.Especialidad
                                                                
                                                                FROM obrascosto AS obs
                                                                
                                                                INNER JOIN obrasocial AS ob
                                                                ON obs.ObraSocial = ob.Id
                                                                
                                                                INNER JOIN profesional AS pr
                                                                ON obs.Matricula = pr.Matricula
                                                                
                                                                INNER JOIN especialidad AS es
                                                                ON pr.Especialidad = es.Id
                                                                
                                                                WHERE obs.Matricula = $matricula");
    }
    if (($matricula != 00) && ($ObraSocial != 00)) {

        $infoObraSocial = mysqli_query($conServicios,"SELECT ob.Nombre,
                                                                ob.Plan,
                                                                obs.Costo,
                                                                obs.Tipo,
                                                                pr.Matricula,
                                                                pr.NomApe,
                                                                es.Especialidad
                                                                
                                                                FROM obrascosto AS obs
                                                                
                                                                INNER JOIN obrasocial AS ob
                                                                ON obs.ObraSocial = ob.Id
                                                                
                                                                INNER JOIN profesional AS pr
                                                                ON obs.Matricula = pr.Matricula
                                                                
                                                                INNER JOIN especialidad AS es
                                                                ON pr.Especialidad = es.Id
                                                                
                                                                WHERE obs.Matricula = $matricula
                                                                AND obs.ObraSocial = $ObraSocial");
    }

        

        $salida = '<br><br>
        <div class="table-responsive">
        <table class="display compact table table-condensed table-striped table-bordered table-hover" id="EspecialidadTabla">
            <thead>
                <tr>
                    <th > Doctor </th>
                    <th > Especialidad </th>
                    <th > Obra Social </th>
                    <th > Plan </th>
                    <th > Costo </th>
                    <th > Tipo</th>
                    <th > Matricula </th>
                    
                    <th > Mas Info </th>                    
                </tr>
            </thead>
       
            
        
            <tbody>';
        while($ObraS = $infoObraSocial->fetch_assoc()){
                    $salida.=
                            '<tr>
                                <td>'.utf8_encode($ObraS['NomApe']).'</td>
                                <td>'.utf8_encode($ObraS['Especialidad']).'</td>
                                <td>'.utf8_encode($ObraS['Nombre']).'</td>
                                <td>'.utf8_encode($ObraS['Plan']).'</td>
                                <td>'.utf8_encode($ObraS['Costo']).'</td>
                                <td>'.utf8_encode($ObraS['Tipo']).'</td>
                                <td>'.utf8_encode($ObraS['Matricula']).'</td>
                                
                                
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#masInfo" onclick="verinfo('.utf8_encode($ObraS['Matricula']).')">
                                        MAS INFO
                                    </button>
                                </td>
                            </tr>';
                } 
                
            $salida.='</tbody>
                    </table> 
                </div>
                
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#EspecialidadTabla").DataTable({ 
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
                                        
                                },
                                {
                                        extend:    "pdfHtml5",
                                        text:      "Exportar a PDF",
                                        titleAttr: "Exportar a PDF",
                                        className: "btn btn-danger",
                                        title:     "Título del documento",
                                                        
                                },
                                {
                                        extend:    "print",
                                        text:      "Imprimir",
                                        titleAttr: "Imprimir",
                                        className: "btn btn-info",
                                        
        
                                }
                            ],                        
                            ordering: true                        
                        });
                    });
                </script>';

   
    

    echo $salida;
    
}

/*--- OBRA SOCIAL GUARDAR ---- */
if(isset($_POST['GuardarObraSocial'])){ 
    $nombreObraSocial = $_POST['nombreObraSocial'];
    $PlanObrasocial = $_POST['PlanObrasocial'];

    $valores = array();
    $valores['existe'] = "1";

    $consulta = "INSERT INTO obrasocial ( Nombre, Plan, Estado )
                    VALUES('$nombreObraSocial', '$PlanObrasocial', 1)";

    $resultadoUno = mysqli_query($conServicios,$consulta);
    if (!$resultadoUno) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;

}
// traer datos para Editar Obra Social
if(isset($_POST['editarOSocial'])){ 
    $idOS = $_POST['idOS'];    
    $valores = array();
    $valores['existe'] = "0";

    $consulta = "SELECT * FROM obrasocial WHERE id = $idOS ;";

    $resultados = mysqli_query($conServicios,$consulta);
    if (!$resultados) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    while($consulta = mysqli_fetch_array($resultados))
    {
        $valores['existe'] = "1"; 
        $valores['Nombre'] = $consulta['Nombre'];
        $valores['Plan'] = $consulta['Plan'];
        $valores['Estado'] = $consulta['Estado'];
    }
    
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;

}

if(isset($_POST['EditarOS'])){

    $idOS = $_POST['idOS'];
    $PlanObrasocial = $_POST['PlanObrasocial'];
    $nombreObraSocial = $_POST['nombreObraSocial'];
    

    $valores = array();
    $valores['existe'] = "1";

    $consulta = "UPDATE obrasocial SET Nombre = '$nombreObraSocial', Plan = '$PlanObrasocial' WHERE id =  $idOS";

    $resultadoUno = mysqli_query($conServicios,$consulta);
    if (!$resultadoUno) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;

}
if(isset($_POST['BorrarOS'])){
    $idOS = $_POST['idOS'];
    $valores = array();
    $valores['existe'] = "1";

    $consulta = "DELETE FROM obrasocial WHERE id =  $idOS";

    $resultadoUno = mysqli_query($conServicios,$consulta);
    if (!$resultadoUno) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;

}

// BORRAR MEDICO
if(isset($_POST['BorrarMedico'])){
    $matricula = $_POST['matricula'];
    $valores = array();
    $valores['existe'] = "1";

    $consulta = "DELETE FROM profesional WHERE Matricula =  $matricula";
    $consultaDos = "DELETE FROM obrascosto WHERE Matricula =  $matricula";

    $resultadoUno = mysqli_query($conServicios,$consulta);
    $resultadoDos = mysqli_query($conServicios,$consultaDos);

    if (!$resultadoUno) {
        echo "Error : ".$conServicios->error;
        $valores['existe'] = "0";
    }
    if (!$resultadoDos) {
        echo "Error : ".$conServicios->error;
        $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;

}
// Lista de Obra Sococial Medico Alta
if (isset($_POST['VerObraMedico'])){

    $matricula = $_POST['matricula'];
    $turnTabla = mysqli_query($conServicios, "SELECT obc.id, ob.nombre, ob.plan, obc.Costo, obc.Tipo, es.Estudios, obc.CostoEstudio FROM obrascosto AS obc INNER JOIN profesional AS pr ON pr.Matricula = obc.Matricula INNER JOIN obrasocial AS ob ON obc.ObraSocial = ob.Id LEFT JOIN estudios AS es ON obc.Estudio = es.Id WHERE obc.Matricula = $matricula ORDER BY nombre");
    
    $salida = <<<HTML
    <div class="table-responsive">
        <table class="display compact table table-condensed table-striped table-bordered table-hover" id="example">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Obra Social</th>
                    <th>Plan</th>
                    <th>Costo</th>
                    <th>Tipo Prestador</th>
                    <th>Estudio</th>
                    <th>Costo</th>
                    <th>Editar</th>
                    <th>Quitar</th>
                </tr>
            </thead>
            <tbody>
    HTML;
    
    while ($fila = $turnTabla->fetch_assoc()) {
        $salida .= <<<HTML
            <tr>
                <td>{$fila['id']}</td>
                <td>{$fila['nombre']}</td>
                <td>{$fila['plan']}</td>
                <td>{$fila['Costo']}</td>
                <td>{$fila['Tipo']}</td>
                <td>{$fila['Estudios']}</td>
                <td>{$fila['CostoEstudio']}</td>
                <td>
                    <button type="button" class="btn btn-warning" onclick="EditarOBS({$fila['id']})" data-toggle="modal" data-target="#editarCostoOBS">Editar</button>
                </td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="BorrarOBS({$fila['id']})">Borrar</button>
                </td>
            </tr>
    HTML;
    }
    
    $salida .= <<<HTML
            </tbody>
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
            footer: true
        },
        dom: "Bfrtip",
        buttons: [
            {
                extend: "excelHtml5",
                text: "Exportar a Excel",
                titleAttr: "Exportar a Excel",
                title: "Título del documento",
                
            },
            {
                extend: "pdfHtml5",
                text: "Exportar a PDF",
                titleAttr: "Exportar a PDF",
                title: "Título del documento",
                
            }
        ],
        initComplete: function(settings, json) {
            $("#example").wrap("<div style='overflow:auto; width:100%;height:100%;'></div>");
        }
    });
    });
    </script>
    HTML;

    echo $salida;

    

}

// Agregar OB a medico en Tabla.
if (isset($_POST["AgregarOBSOC"])){


    $matriculaMedicoAlta = $_POST['matriculaMedicoAlta'];

    $ObraSocialAgregar = $_POST['ObraSocialAgregar'];
    $ObraSocialImporte = $_POST['ObraSocialImporte'];

    $EstudiosAgregar = $_POST['EstudiosAgregar'];
    $EstudiosImporte = $_POST['EstudiosImporte'];
    
    $tipoObraSocial = $_POST['tipoObraSocial'];


    $valores = array();
    $valores['existe'] = "1";

    $consulta = "INSERT INTO obrascosto ( ObraSocial, Matricula, Costo, Tipo, Estado, Estudio, CostoEstudio )
                    VALUES($ObraSocialAgregar, $matriculaMedicoAlta, $ObraSocialImporte, '$tipoObraSocial', 1, $EstudiosAgregar, $EstudiosImporte )";

    $resultadoUno = mysqli_query($conServicios,$consulta);
    if (!$resultadoUno) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;
}


// Guardar Medico
if (isset($_POST["GMedico"])){
    $matricula = $_POST['matricula'];
    $NomApe = $_POST['NomApe'];
    $Espec = $_POST['Espec'];
    $Tatencion = $_POST['Tatencion'];
    $telf = $_POST['telf'];
    $email = $_POST['email'];
    $Hatencion = $_POST['Hatencion'];
    $Consult     = $_POST['Consult'];
    $obs = $_POST['obs'];


    $valores = array();
    $valores['existe'] = "1";

    $consulta = "INSERT INTO profesional ( Matricula, NomApe, Especialidad, TipoAtencion, Telefono, Email, HorarioAtencion, Consultorio, Obs)
                        VALUES($matricula, '$NomApe', '$Espec',$Tatencion,$telf ,'$email' ,'$Hatencion','$Consult', '$obs')";

    $resultadoUno = mysqli_query($conServicios,$consulta);
    if (!$resultadoUno) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;
}
// GUARDAR MEDICO EDITADO
// Guardar Medico
if (isset($_POST["GMedicoEditado"])){
    $matricula = $_POST['matricula'];
    $NomApe = $_POST['NomApe'];
    $Espec = $_POST['Espec'];
    $Tatencion = $_POST['Tatencion'];
    $telf = $_POST['telf'];
    $email = $_POST['email'];
    $Hatencion = $_POST['Hatencion'];
    $Consult     = $_POST['Consult'];
    $obs = $_POST['obs'];

    $valores = array();
    $valores['existe'] = "1";

    $consulta = "UPDATE profesional SET NomApe = '$NomApe', 
                                    Especialidad = $Espec, 
                                    TipoAtencion = $Tatencion,
                                    Telefono = $telf ,
                                    Email = '$email' ,
                                    HorarioAtencion = '$Hatencion' ,
                                    Consultorio = '$Consult',
                                    Obs = '$obs'
                                    WHERE Matricula =  $matricula";



    $resultadoUno = mysqli_query($conServicios,$consulta);
    if (!$resultadoUno) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;
}

// editarMedico
if(isset($_POST['editarMedico'])){ 
    $matricula = $_POST['matricula'];    
    $valores = array();
    $valores['existe'] = "0";

    $consulta = "SELECT * FROM profesional WHERE Matricula = $matricula ;";

    $resultados = mysqli_query($conServicios,$consulta);
    if (!$resultados) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    while($consulta = mysqli_fetch_array($resultados)){
        $valores['existe'] = "1";
        foreach($consulta as $key => &$value) {
            $value = mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1');
        }
        $valores = array_merge($valores, $consulta);
    }
    
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;

}

// GUARDAR MEDICO DEL
if(isset($_POST['TablaUser'])){ 
    $Legajo = $_POST['Legajo'];    
    $Sect = $_POST['Sect'];

    
    if (($Legajo != 00) && ($Sect == 00)) {

        $infoObraSocial = mysqli_query($conServicios,"SELECT * FROM usuario WHERE usuario = $Legajo");
    }
    if (($Legajo == 00) && ($Sect == 00)) {

        $infoObraSocial = mysqli_query($conServicios,"SELECT ob.Nombre,
                                                                ob.Plan,
                                                                obs.Costo,
                                                                obs.Tipo,
                                                                pr.Matricula,
                                                                pr.NomApe,
                                                                es.Especialidad
                                                                
                                                                FROM obrascosto AS obs
                                                                
                                                                INNER JOIN obrasocial AS ob
                                                                ON obs.ObraSocial = ob.Id
                                                                
                                                                INNER JOIN profesional AS pr
                                                                ON obs.Matricula = pr.Matricula
                                                                
                                                                INNER JOIN especialidad AS es
                                                                ON pr.Especialidad = es.Id
                                                                
                                                                WHERE obs.Matricula = $matricula");
    }
    

        $salida = '<div class="table-responsive">
        <table class="display compact table table-condensed table-striped table-bordered table-hover" id="EspecialidadTabla">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Nombre y Apellido</th>
                    <th>Sector</th> <!-- niño adulto ambos -->
                    <th>Estado</th>
                    <th>Telefono</th> 
                    <th> Email </th>
                    <th> </th>                    
                </tr>
            </thead>
       
            
        
            <tbody>';
        while($ObraS = $infoObraSocial->fetch_assoc()){
                    $salida.=
                            '<tr>
                                <td>'.utf8_encode($ObraS['usuario']).'</td>
                                <td>'.utf8_encode($ObraS['contra']).'</td>
                                <td>'.utf8_encode($ObraS['NombreApe']).'</td>
                                <td>'.utf8_encode($ObraS['Sector']).'</td>
                                <td>'.utf8_encode($ObraS['Estado']).'</td>
                                <td>'.utf8_encode($ObraS['Telefono']).'</td>
                                <td>'.utf8_encode($ObraS['Email']).'</td>
                                
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#masInfo" onclick="verinfo('.utf8_encode($ObraS['usuario']).')">
                                        MAS INFO
                                    </button>
                                </td>
                            </tr>';
                } 
                
            $salida.='</tbody>
                    </table> 
                </div>
                
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#EspecialidadTabla").DataTable({ 
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
                            ordering: true                        
                        });
                    });
                </script>';

   
    

    echo $salida;
    
}


if (isset($_POST['GUser'])){
    $Nombre = $_POST['Nombre'];
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
    $Nombre = $_POST['Nombre'];
    $Legajo = $_POST['Legajo'];
    $sector = $_POST['sector'];
    $passw = $_POST['passw'];
    $telf = $_POST['telf'];
    $email = $_POST['email'];

    $valores = array();
    $valores['existe'] = "1";

    $consulta = "UPDATE usuario SET NombreApe = '$Nombre', Telefono = $telf, Email = '$email' WHERE usuario = $Legajo";

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

// editar traer datos costo obra social Medico
if (isset($_POST['editTraerObsMedico'])){
    $nume = $_POST['nume'];
    $valores = array();
    $valores['existe'] = "0";

    $consulta = "SELECT * FROM obrascosto WHERE id = $nume";

    $resultados = mysqli_query($conServicios,$consulta);
    if (!$resultados) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    while($consulta = mysqli_fetch_array($resultados))
    {
        $valores['existe'] = "1";         
        $valores['id'] = $consulta['id'];
        $valores['ObraSocial'] = $consulta['ObraSocial'];
        $valores['Matricula'] = $consulta['Matricula'];
        $valores['Costo'] = $consulta['Costo'];
        $valores['TipoObs'] = $consulta['Tipo'];
        $valores['Estado'] = $consulta['Estado'];
        $valores['Estudio'] = $consulta['Estudio'];
        $valores['CostoEstudio'] = $consulta['CostoEstudio'];
    }
    
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;

}

// guardar editar obs de medico
if(isset($_POST["GuardarEditarOBS"])){
    $id = $_POST['id'];
    $editarCostoO = $_POST['editarCostoO'];
    $editarCostoE = $_POST['editarCostoE'];
    $editarCostoT = $_POST['editarCostoT'];


    $valores = array();
    $valores['existe'] = "1";

    $consulta = "UPDATE obrascosto SET Costo =  $editarCostoO, CostoEstudio = $editarCostoE, Tipo = '$editarCostoT'  WHERE id = $id";

    $resultadoUno = mysqli_query($conServicios,$consulta);
    if (!$resultadoUno) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;
}

// borrarOs
if(isset($_POST["deleteObsMedico"])){
    $id = $_POST['nume'];
    
    $valores = array();
    $valores['existe'] = "1";

    $consulta = "DELETE FROM obrascosto WHERE id = $id ";

    $resultadoUno = mysqli_query($conServicios,$consulta);
    if (!$resultadoUno) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;
}

// Estudios
// guardar estudios 
if (isset($_POST["GuardarEstudio"])){
    $nomEstudio = $_POST["nomEstudio"];

    $valores = array();
    $valores['existe'] = "1";

    $consulta = "INSERT INTO estudios ( Estudios, Estados)
                    VALUES('$nomEstudio', 1)";

    $resultadoUno = mysqli_query($conServicios,$consulta);
    if (!$resultadoUno) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;
}

if(isset($_POST['BorrarEstudio'])){
    $idEs = $_POST['idEs'];
    $valores = array();
    $valores['existe'] = "1";

    $consulta = "DELETE FROM estudios WHERE id =  $idEs";

    $resultadoUno = mysqli_query($conServicios,$consulta);
    if (!$resultadoUno) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;

}

if(isset($_POST['editarVerEstudios'])){ 
    $idEs = $_POST['idEs'];    
    $valores = array();
    $valores['existe'] = "0";

    $consulta = "SELECT * FROM estudios WHERE id = $idEs ;";

    $resultados = mysqli_query($conServicios,$consulta);
    if (!$resultados) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    while($consulta = mysqli_fetch_array($resultados))
    {
        $valores['existe'] = "1"; 
        $valores['Estudios'] = utf8_encode($consulta['Estudios']);
    }
    
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;

}

if (isset($_POST['GuardarEditarEstudio'])){
    $idEs = $_POST['idEs'];
    $nomEs = $_POST['nomEs'];


    $valores = array();
    $valores['existe'] = "1";

    $consulta = "UPDATE estudios SET Estudios =  '$nomEs' WHERE Id = $idEs";

    $resultadoUno = mysqli_query($conServicios,$consulta);
    if (!$resultadoUno) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;
}


// cancelaciones
if (isset($_POST['addCancelacion'])){
    $obsCancelacion = $_POST['obsCancelacion'];
    $NombreM = $_POST['NombreM'];
    $fechaCancelacion = $_POST['fechaCancelacion'];

    $valores = array();
    $valores['existe'] = "1";

    $consulta = "INSERT INTO cancelacionMedico ( Matricula , Fecha, Obs)
                    VALUES($NombreM, '$fechaCancelacion', '$obsCancelacion')";

    $resultadoUno = mysqli_query($conServicios,$consulta);
    if (!$resultadoUno) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;

}

// Lista de Cancelacion
if (isset($_POST['VerTablaCancelar'])){

    $turnTabla = mysqli_query($conServicios,"SELECT cm.Id,
                                                    cm.Matricula,
                                                    pr.NomApe,
                                                    DATE_FORMAT(cm.fechaInicio,'%Y-%m-%d') AS fechaInicio,
                                                    DATE_FORMAT(cm.fechaFin,'%Y-%m-%d') AS fechaFin,
                                                    cm.tipoCancelacion,
                                                    cm.Obs
                                                    FROM cancelacionmedico AS cm
                                                    INNER JOIN profesional AS pr
                                                    ON cm.Matricula = pr.Matricula
                                                    WHERE DATE_FORMAT(cm.fechaInicio, '%Y-%m') >= DATE_FORMAT(NOW(), '%Y-%m')
                                                    ORDER BY cm.fechaInicio");

            $salida = '<div class="table-responsive">
            <table class="display compact table table-condensed table-striped table-bordered table-hover" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Matricula</th>
                        <th>Nombre y Apellido</th>
                        <th>fecha Inicio</th>
                        <th>fecha Fin</th>  
                        <th>tipoCancelacion</th>
                        <th>Obs</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>';
            while($fila = $turnTabla->fetch_assoc()){
                $salida .= '<tr>
                                <td>'.htmlspecialchars($fila['Id'], ENT_QUOTES, 'UTF-8').'</td> 
                                <td>'.htmlspecialchars($fila['Matricula'], ENT_QUOTES, 'UTF-8').'</td> 
                                <td>'.htmlspecialchars($fila['NomApe'], ENT_QUOTES, 'UTF-8').'</td> 
                                <td>'.htmlspecialchars($fila['fechaInicio'], ENT_QUOTES, 'UTF-8').'</td>
                                <td>'.htmlspecialchars($fila['fechaFin'], ENT_QUOTES, 'UTF-8').'</td>
                                <td>'.htmlspecialchars($fila['tipoCancelacion'], ENT_QUOTES, 'UTF-8').'</td>
                                <td>'.htmlspecialchars($fila['Obs'], ENT_QUOTES, 'UTF-8').'</td>
                                <td><button type="button" class="btn btn-dark" onclick="Edit('.$fila['Id'].')" data-toggle="modal" data-target="#EditarCancelacion">Editar</button></td>
                                <td><button type="button" class="btn btn-danger" onclick="Borrar('.$fila['Id'].')">Borrar</button></td>
                            </tr>';
            }  
            $salida .='</tbody>
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
                        footer: true
                      },
                      dom: "Bfrtip",
                      buttons: [
                        {
                          extend: "excelHtml5",
                          text: "Exportar a Excel",
                          titleAttr: "Exportar a Excel",
                          title: "Título del documento"
                        },
                        {
                          extend: "pdfHtml5",
                          text: "Exportar a PDF",
                          titleAttr: "Exportar a PDF",
                          className: "btn btn-danger",
                          title: "Título del documento"
                        },
                        {
                          extend: "print",
                          text: "Imprimir",
                          titleAttr: "Imprimir",
                          className: "btn btn-info"
                        }
                      ],
                      ordering: false
                    });
                  });                  
            </script>';
        echo $salida;

}

if(isset($_POST['deleteCancelacion'])){
    $idCancelar = $_POST['idCancelar'];
    $valores = array();
    $valores['existe'] = "1";

    $consulta = "DELETE FROM cancelacionMedico WHERE id =  $idCancelar";

    $resultadoUno = mysqli_query($conServicios,$consulta);
    if (!$resultadoUno) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;

}

if (isset($_POST['cancelarG'])){

    $nombreDoctor = $_POST["nombreDoctor"];
    $tipoCancelacion = $_POST["tipoCancelacion"];
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFin = $_POST["fechaFin"].' 23:59:00';
    $observacion = $_POST["observacion"];


    $sql = "INSERT INTO cancelacionmedico (Matricula, Obs, fechaInicio, fechaFin, tipoCancelacion)
    VALUES ('$nombreDoctor', '$observacion', '$fechaInicio', '$fechaFin', '$tipoCancelacion')";

    if ($conServicios->query($sql) === true) {
    echo "Record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conServicios->error;
    }

    $conServicios->close();

}

if (isset($_POST["editCancelacion"])){
    $id = $_POST["idCancelar"];

    $resultados = mysqli_query($conServicios,"SELECT cm.Id,
                                                cm.Matricula,
                                                pr.NomApe,
                                                DATE_FORMAT(cm.fechaInicio,'%Y-%m-%d') AS fechaInicio,
                                                DATE_FORMAT(cm.fechaFin,'%Y-%m-%d') AS fechaFin,
                                                cm.tipoCancelacion,
                                                cm.Obs
                                                FROM cancelacionmedico AS cm
                                                INNER JOIN profesional AS pr
                                                ON cm.Matricula = pr.Matricula
                                                WHERE cm.id = $id;");

    $valores = array();
    $valores['existe'] = "0";

   
    if (!$resultados) {
        echo "Error en la inserción Guardar: ".$conServicios->error;
        $valores['existe'] = "0";
    }
    while($consulta = mysqli_fetch_array($resultados))
    {
        $valores['existe'] = "1";         
        $valores['Id'] = $consulta['Id'];
        $valores['Matricula'] = $consulta['Matricula'];
        $valores['NomApe'] = $consulta['NomApe'];
        $valores['fechaInicio'] = $consulta['fechaInicio'];
        $valores['fechaFin'] = $consulta['fechaFin'];
        $valores['tipoCancelacion'] = $consulta['tipoCancelacion'];
        $valores['Obs'] = $consulta['Obs'];
    }
    
    $valores = JSON_encode($valores,JSON_THROW_ON_ERROR);
        echo $valores;                                         


}

if (isset($_POST['EdcancelarG'])){

    $Id = $_POST["Id"];
    $NomApe = $_POST["NomApe"];
    $Matricula = $_POST["Matricula"];
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFin = $_POST["fechaFin"].' 23:59:00';
    $tipoCancelacion = $_POST["tipoCancelacion"];
    $Obs = $_POST["Obs"];

    $sql = "UPDATE cancelacionmedico
            SET Fecha = CURDATE(), Obs = '$Obs' , fechaInicio = '$fechaInicio', fechaFin = '$fechaFin', tipoCancelacion = '$tipoCancelacion' WHERE Id = $Id";

    if ($conServicios->query($sql) === true) {
    echo "Record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conServicios->error;
    }

    $conServicios->close();

}