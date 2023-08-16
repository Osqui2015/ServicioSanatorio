<?php
    require_once "../../conServicios.php";
    
/* -----------MUESTRA VALORES EN LA TABLA POR LA FECHA SELECCIONADA------------------ */
if(isset($_POST['fbuscar'])){ 
    $matricula = $_POST['matricula'];
           
        $turnTabla = mysqli_query($conServicios,"SELECT * FROM obrasocial WHERE Matricula = $matricula");
        $docInfo = mysqli_query($conServicios,"SELECT * FROM docinfo WHERE Matricula = $matricula;");

 
            $salida = '<div class="card mb-3" style="max-width: 500px;">
            <div class="row no-gutters">            
                <div class="col">
                    <div class="card-body">';
                    while($datos = $docInfo->fetch_assoc()){
                        $salida.=
                                '<h5 class="card-title">'.utf8_encode($datos['Nombre']).'</h5>
                                <p class="card-text"><small class="text-muted">'.utf8_encode($datos['Especialidad']).'</small></p>
                                <p class="card-text"> '.utf8_encode($datos['Consultorio']).' </p>
                                <p class="card-text"> '.utf8_encode($datos['HorarioAtencion']).' </p>
                                <p class="card-text"> Particular: '.utf8_encode($datos['Particular']).' </p>
                                <p class="card-text"><small class="text-muted">Teléfono: </small></p>
                                <p class="card-text"><small class="text-muted">Email: </small></p>';
                    }
                    $salida.='</div>
                </div>
            </div>
        </div>
        <br><br>';
        

        $salida .= '<div class="table-responsive">
        <table class="display compact table table-condensed table-striped table-bordered table-hover" id="example">
            <thead>
                <tr>
                    <th > Obra Social </th>
                    <th > Plus </th>
                </tr>
            </thead>
       
            
        
            <tbody>';
        while($fila = $turnTabla->fetch_assoc()){
                    $salida.=
                            '<tr>
                                <td>'.utf8_encode($fila['ObraSocial']).'</td>
                                <td>'.$fila['Plus'].'</td>
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

/* -----------MUESTRA VALORES EN LA TABLA POR LA FECHA SELECCIONADA------------------ */
if(isset($_POST['Tabla'])){ 
    $matricula = $_POST['Nombre'];
    $Especialidad = $_POST['Especialidad'];
    $ObraSocial = $_POST['ObraSocial'];
    $Estudio = $_POST['Estudios'];

    $Consulta = "SELECT pr.Matricula,
                        pr.NomApe,
                        es.Especialidad,
                        ob.Nombre,
                        ob.Plan,
                        obs.Costo,
                        est.Estudios,
                        obs.CostoEstudio,
                        obs.Tipo
                        
                        FROM obrascosto AS obs
                        
                        INNER JOIN obrasocial AS ob
                        ON obs.ObraSocial = ob.Id
                        
                        INNER JOIN profesional AS pr
                        ON obs.Matricula = pr.Matricula
                        
                        INNER JOIN especialidad AS es
                        ON pr.Especialidad = es.Id
                        
                        LEFT JOIN estudios AS est ON obs.Estudio = est.Id ";
    
    if (($matricula != 0)  && ($Estudio == 0) && ($Especialidad == 0) && ($ObraSocial == 0)){
        $Consulta .= "WHERE pr.Matricula = $matricula;";
    }
    if ( ($Estudio != 0)  && ($matricula == 0) && ($Especialidad == 0) && ($ObraSocial == 0)){
        $Consulta .= "WHERE obs.Estudio = $Estudio;";
    }
    if ( ($Especialidad != 0)  && ($matricula == 0) && ($Estudio == 0) && ($ObraSocial == 0)){
        $Consulta .= "WHERE pr.Especialidad = $Especialidad;";
    }       
    if ( ($ObraSocial != 0)  && ($Especialidad == 0) && ($Estudio == 0) && ($matricula == 0)){
        $Consulta .= "WHERE obs.ObraSocial = $ObraSocial;";
    }

    if (($matricula == 0)  && ($Estudio != 0) && ($Especialidad == 0) && ($ObraSocial != 0)){
        $Consulta .= "WHERE obs.Estudio = $Estudio
                    AND obs.ObraSocial = $ObraSocial;";
    }
    if (($matricula == 0)  && ($Estudio == 0) && ($Especialidad != 0) && ($ObraSocial != 0)){
        $Consulta .= "WHERE pr.Especialidad = $Especialidad
                    AND obs.ObraSocial = $ObraSocial;";
    }




        $infoObraSocial = mysqli_query($conServicios,$Consulta);

            $salida = '<div class="table-responsive">
            <table class="display compact table table-condensed table-striped table-bordered table-hover" id="EspecialidadTabla">
                <thead>
                    <tr>
                        <th > Matricula </th>
                        <th > Doctor </th>
                        <th > Especialidad </th>    
                        <th > Obra Social </th>
                        <th > Plan </th>
                        <th > Costo </th>
                        <th > Estudio </th>
                        <th > Costo Estudio </th>
                        <th > Tipo</th>                        
                        <th > Mas Info </th>                    
                    </tr>
                </thead>
           
                
            
                <tbody>';
            while($ObraS = $infoObraSocial->fetch_assoc()){
                        $salida.=
                                '<tr>
                                    <td>'.utf8_encode($ObraS['Matricula']).'</td>
                                    <td>'.utf8_encode($ObraS['NomApe']).'</td>
                                    <td>'.utf8_encode($ObraS['Especialidad']).'</td>
                                    <td>'.utf8_encode($ObraS['Nombre']).'</td>
                                    <td>'.utf8_encode($ObraS['Plan']).'</td>
                                    <td>'.utf8_encode($ObraS['Costo']).'</td>
                                    <td>'.utf8_encode($ObraS['Estudios']).'</td>
                                    <td>'.utf8_encode($ObraS['CostoEstudio']).'</td>
                                    <td>'.utf8_encode($ObraS['Tipo']).'</td>
                                    
                                    
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
if(isset($_POST['TablaM'])){ 
    $matricula = $_POST['Nombre'];
    $Especialidad = $_POST['Especialidad'];
    $ObraSocial = $_POST['ObraSocial'];

    
        
    
      
            $infoObraSocial = mysqli_query($conServicios,"SELECT pr.Matricula,
                                                                pr.NomApe,
                                                                es.Especialidad,
                                                                pr.Telefono,
                                                                pr.HorarioAtencion,
                                                                pr.Consultorio,
                                                                pr.Obs
                                                                FROM profesional AS pr
                                                                INNER JOIN especialidad AS es
                                                                ON pr.Especialidad = es.Id 
                                                                WHERE es.id = $Especialidad ");

            $salida = '<div class="table-responsive">
            <table class="display compact table table-condensed table-striped table-bordered table-hover" id="EspecialidadTabla">
                <thead>
                    <tr>
                        <th > Matricula </th>
                        <th > Nombre y Apellido</th> </th>
                        <th > Especialidad </th>
                        <th > Telefono </th>
                        <th > HorarioAtencion </th>
                        <th > Consultorio </th>                        
                        <th > Mas Info </th>                    
                    </tr>
                </thead>
           
                
            
                <tbody>';
            while($ObraS = $infoObraSocial->fetch_assoc()){
                        $salida.=
                                '<tr>
                                    <td>'.utf8_encode($ObraS['Matricula']).'</td>
                                    <td>'.utf8_encode($ObraS['NomApe']).'</td>                                    
                                    <td>'.utf8_encode($ObraS['Especialidad']).'</td>
                                    <td>'.utf8_encode($ObraS['Telefono']).'</td>
                                    <td>'.utf8_encode($ObraS['HorarioAtencion']).'</td>
                                    <td>'.utf8_encode($ObraS['Consultorio']).'</td>                                    
                                    
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



if(isset($_POST['fbuscarMedico'])){ 
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


    $salida = '<div class="">
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
    <label for="exampleFormControlTextarea1">Información Adicional</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly > '.utf8_encode($datos['Obs']).' </textarea>';

    } 


    $salida.='</div>
                </div>

                </div>
                </div>
                <br>';

        $salida .= '<div class="table-responsive">
        <table class="display compact table table-condensed table-striped table-bordered table-hover" id="example">
            <thead>
                <tr>
                <th > ID </th>
                <th > Obra Social </th>
                <th > Plan </th>
                <th > Costo </th>
                <th > Tipo </th>
                <th > Estudio </th>
                <th > Costo Estudio</th>

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
                }
            });
        });
    </script>';
    echo $salida;
    
}


if (isset($_POST['addCancelacion'])){

    $matricula = $_POST['NombreM'];    

    $events = array();
    $query = "SELECT * FROM cancelacionmedico";
    $result = mysqli_query($conServicios, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $start = $row['fechaInicio'];
        $end = $row['fechaFin'];
        $event = array(
            'title' => $row['tipoCancelacion'].' '.$row['Obs'],
            'start' => $start,
            'end' => $end
        );
        $events[] = $event;
    }
    echo json_encode($events);

    mysqli_close($conServicios);


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