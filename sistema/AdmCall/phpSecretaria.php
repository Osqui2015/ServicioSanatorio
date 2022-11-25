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


            $salida = '<div class="card mb-3" style="max-width: 500px;">
            <div class="row no-gutters">            
                <div class="col">
                    <div class="card-body">';
                    while($datos = $docInfo->fetch_assoc()){
                        $salida.=
                                '<h5 class="card-title">'.utf8_encode($datos['NomApe']).'</h5>
                                <p class="card-text"><small class="text-muted">'.utf8_encode($datos['Especialidad']).'</small></p>
                                <p class="card-text"> '.utf8_encode($datos['Consultorio']).' </p>
                                <p class="card-text"> '.utf8_encode($datos['HorarioAtencion']).' </p>                                
                                <p class="card-text"><small class="text-muted">Teléfono: '.utf8_encode($datos['Telefono']).' </small></p>
                                <p class="card-text"><small class="text-muted">Email: </small></p>
                                <label for="exampleFormControlTextarea1">Example textarea</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly > '.utf8_encode($datos['Obs']).' </textarea>';

                    } 

                        
                    $salida.='</div>
                </div>
                
            </div>
        </div>
        <br><br>
        <div>
            <div class="form-group">
                
            </div>
        </div>
        <br><br>';
        

       

    $salida .= '<div class="table-responsive">
        <table class="display compact table table-condensed table-striped table-bordered table-hover" id="example">
            <thead>
                <tr>
                    <th > ID </th>
                    <th > Obra Social </th>
                    <th > Tipo </th>
                    <th > Costo </th>
                    <th > Estudio </th>
                    <th > Costo Estudio</th>
                    <th > Estado </th>
                    <th > Editar </th>
                    <th > Quitar </th>
                         
                </tr>
            </thead>
       
            
        
            <tbody>';

        while($fila = $turnTabla->fetch_assoc()){
                    $salida.= '<td>'.utf8_encode($fila['id']).'</td> 
                                <td>'.utf8_encode($fila['nombre']).'</td> 
                                <td>'.utf8_encode($fila['plan']).'</td> 
                                <td>'.utf8_encode($fila['Costo']).'</td> 

                                <td>'.utf8_encode($fila['Tipo']).'</td>            
                                <td>'.utf8_encode($fila['Estudios']).'</td>

                                <td>'.utf8_encode($fila['CostoEstudio']).'</td>

                                <td> <button type="button" class="btn btn-warning" onclick="EditarOBS('.utf8_encode($fila['id']).')" data-toggle="modal" data-target="#editarCostoOBS" > Editar </button> </td>
                                <td> <button type="button" class="btn btn-danger" onclick="BorrarOBS('.utf8_encode($fila['id']).')"> Borrar </button> </td>
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
                        ordering: true                        
                    });
                });
            </script>';
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
                    <th > Obra Social </th>
                    <th > Plan </th>
                    <th > Costo </th>
                    <th > Tipo</th>
                    <th > Matricula </th>
                    <th > Doctor </th>
                    <th > Especialidad </th>
                    <th > Mas Info </th>                    
                </tr>
            </thead>
       
            
        
            <tbody>';
        while($ObraS = $infoObraSocial->fetch_assoc()){
                    $salida.=
                            '<tr>
                                <td>'.utf8_encode($ObraS['Nombre']).'</td>
                                <td>'.utf8_encode($ObraS['Plan']).'</td>
                                <td>'.utf8_encode($ObraS['Costo']).'</td>
                                <td>'.utf8_encode($ObraS['Tipo']).'</td>
                                <td>'.utf8_encode($ObraS['Matricula']).'</td>
                                <td>'.utf8_encode($ObraS['NomApe']).'</td>
                                <td>'.utf8_encode($ObraS['Especialidad']).'</td>
                                
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
                                        exportOptions: {
                                            columns: [0,2,3,4,5,6,7]
                                        }
                                },
                                {
                                        extend:    "pdfHtml5",
                                        text:      "Exportar a PDF",
                                        titleAttr: "Exportar a PDF",
                                        className: "btn btn-danger",
                                        title:     "Título del documento",
                                        exportOptions: {
                                            columns: [0,2,3,4,5,6,7]
                                        }                    
                                },
                                {
                                        extend:    "print",
                                        text:      "Imprimir",
                                        titleAttr: "Imprimir",
                                        className: "btn btn-info",
                                        exportOptions: {
                                            columns: [0,2,3,4,5,6,7]
                                        }
        
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
    $Habilitado = $_POST['Habilitado'];

    $valores = array();
    $valores['existe'] = "1";

    $consulta = "UPDATE obrasocial SET Estado = $Habilitado, Nombre = '$nombreObraSocial', Plan = '$PlanObrasocial' WHERE id =  $idOS";

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

    $consulta = "DELETE FROM obrasocial1 WHERE id =  $idOS";

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
    // echo $matricula;

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

    $salida = '<div class="table-responsive">
        <table class="display compact table table-condensed table-striped table-bordered table-hover" id="example">
            <thead>
                <tr>
                    <th > ID </th>
                    <th > Obra Social </th>
                    <th > Tipo </th>
                    <th > Costo </th>
                    <th > Estudio </th>
                    <th > Costo Estudio</th>
                    <th > Estado </th>
                    <th > Editar </th>
                    <th > Quitar </th>
                         
                </tr>
            </thead>
       
            
        
            <tbody>';

        while($fila = $turnTabla->fetch_assoc()){
                    $salida.= '<td>'.utf8_encode($fila['id']).'</td> 
                                <td>'.utf8_encode($fila['nombre']).'</td> 
                                <td>'.utf8_encode($fila['plan']).'</td> 
                                <td>'.utf8_encode($fila['Costo']).'</td> 

                                <td>'.utf8_encode($fila['Tipo']).'</td>            
                                <td>'.utf8_encode($fila['Estudios']).'</td>

                                <td>'.utf8_encode($fila['CostoEstudio']).'</td>

                                <td> <button type="button" class="btn btn-warning" onclick="EditarOBS('.utf8_encode($fila['id']).')" data-toggle="modal" data-target="#editarCostoOBS" > Editar </button> </td>
                                <td> <button type="button" class="btn btn-danger" onclick="BorrarOBS('.utf8_encode($fila['id']).')"> Borrar </button> </td>
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
                        ordering: true                        
                    });
                });
            </script>';
        echo $salida;

}

// Agregar OB a medico en Tabla.
if (isset($_POST["AgregarOBSOC"])){
    $Importe = $_POST['Importe'];
    $OBSocSelect = $_POST['OBSocSelect'];
    $matriculaMedicoAlta = $_POST['matriculaMedicoAlta'];
    $tipoObraSocial = $_POST['tipoObraSocial'];
    $EstudiosAgregar = $_POST['EstudiosAgregar'];
    $EstudiosImporte = $_POST['EstudiosImporte'];

    $valores = array();
    $valores['existe'] = "1";

    $consulta = "INSERT INTO obrascosto ( ObraSocial, Matricula, Costo, Tipo, Estado, Estudio, CostoEstudio )
                    VALUES($OBSocSelect, $matriculaMedicoAlta, $Importe, '$tipoObraSocial', 1, $EstudiosAgregar, $EstudiosImporte )";

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
    while($consulta = mysqli_fetch_array($resultados))
    {
        $valores['existe'] = "1";         
        $valores['Matricula'] = $consulta['Matricula'];
        $valores['NomApe'] = $consulta['NomApe'];
        $valores['Especialidad'] = $consulta['Especialidad'];
        $valores['TipoAtencion'] = $consulta['TipoAtencion'];
        $valores['Telefono'] = $consulta['Telefono'];
        $valores['Email'] = $consulta['Email'];
        $valores['HorarioAtencion'] = $consulta['HorarioAtencion'];
        $valores['Consultorio'] = $consulta['Consultorio'];
        $valores['Obs'] = $consulta['Obs'];

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
        $valores['Tipo'] = $consulta['Tipo'];
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


    $valores = array();
    $valores['existe'] = "1";

    $consulta = "UPDATE obrascosto SET Costo =  $editarCostoO, CostoEstudio = $editarCostoE WHERE id = $id";

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
                                                    cm.Fecha,
                                                    cm.Obs
                                                    FROM cancelacionmedico AS cm
                                                    INNER JOIN profesional AS pr
                                                    ON cm.Matricula = pr.Matricula
                                                    WHERE Fecha >= '2022-11-15'");

    $salida = '<div class="table-responsive">
        <table class="display compact table table-condensed table-striped table-bordered table-hover" id="example">
            <thead>
                <tr>
                    <th > ID </th>
                    <th > Matricula </th>
                    <th > Nombre y Apellido </th>
                    <th > Fecha </th>
                    <th > Observacion </th>  
                </tr>
            </thead>
       
            
        
            <tbody>';

        while($fila = $turnTabla->fetch_assoc()){
                    $salida.= '<td>'.utf8_encode($fila['Id']).'</td> 
                                <td>'.utf8_encode($fila['Matricula']).'</td> 
                                <td>'.utf8_encode($fila['NomApe']).'</td> 
                                <td>'.utf8_encode($fila['Fecha']).'</td>
                                <td>'.utf8_encode($fila['Obs']).'</td>
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
                        ordering: true                        
                    });
                });
            </script>';
        echo $salida;

}