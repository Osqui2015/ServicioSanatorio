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

    
        
        if (($matricula == 00) && ($ObraSocial != 00) && ($Especialidad == 00)){
    
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
        if (($matricula != 00) && ($ObraSocial == 00) && ($Especialidad == 00)) {
    
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
        if (($matricula == 00) && ($ObraSocial == 00) && ($Especialidad != 00)) {
    
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
                                                                    
                                                                    WHERE es.id = $Especialidad");
        }

        if (($ObraSocial != 00) && ($Especialidad != 00)) {
    
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
                                                                    
                                                                    WHERE es.id = $Especialidad
                                                                    AND obs.ObraSocial = $ObraSocial");
        }
    
            
    
            $salida = '<div class="table-responsive">
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
           
        $turnTabla = mysqli_query($conServicios,"SELECT obs.Matricula, 
                                                    ob.Nombre,
                                                    ob.Plan,
                                                    obs.Costo
                                                    
                                                    FROM obrascosto AS obs
                                                    
                                                    INNER JOIN obrasocial AS ob
                                                    ON obs.ObraSocial = ob.Id
                                                    WHERE Matricula = $matricula");

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
                    <th > Plan </th>
                    <th > Costo </th>
                </tr>
            </thead>
       
            
        
            <tbody>';
        while($fila = $turnTabla->fetch_assoc()){
                    $salida.=
                            '<tr>
                                <td>'.utf8_encode($fila['Nombre']).'</td>
                                <td>'.utf8_encode($fila['Plan']).'</td>
                                <td>'.utf8_encode($fila['Costo']).'</td>
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