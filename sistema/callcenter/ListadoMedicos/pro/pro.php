<?php
    require "../conServicios.php";
    mysqli_set_charset($conServicios, "utf8");

if(isset($_POST['fbuscar'])){ 
    $matricula = intval($_POST['matricula']);
    if ($matricula != 0){
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
                    <div class="card mb-3" >
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
                    <p class="card-text"><small class="text-muted">Matricula: {$matricula} </small></p>
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
                <table class="display compact table table-condensed table-striped table-bordered table-hover" id="tdoc">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Obra Social</th>
                        <th>Plan</th>
                        <th>Costo</th>
                        <th>Tipo</th>
                        <th>Estudio</th>
                        <th>Costo Estudio</th>                        
                    
                    </tr>
                </thead>
                <tbody>
                HTML;

        while ($fila = $turnTabla->fetch_assoc()) {
                $salida .= <<<HTML
                <tr>
                    <td>
                        <input class="form-check-input" type="checkbox" value="{$fila['id']}" id="flexCheck{$fila['id']}">
                    </td>
                    <td>{$fila['id']}</td>
                    <td>{$fila['nombre']}</td>
                    <td>{$fila['plan']}</td>
                    <td>{$fila['Costo']}</td>
                    <td>{$fila['Tipo']}</td>
                    <td>{$fila['Estudios']}</td>
                    <td>{$fila['CostoEstudio']}</td>
                
                </tr>
                HTML;
        }

        $salida .= <<<HTML
            </tbody>
            </table>
            </div> 
            <br>
                <br><br><br><br><br>
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#tdoc").DataTable({
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
            <script src="./funciones/funciones.js"></script>
        HTML;
    }
    else{
        $salida = ' ';
    }   
    echo $salida;
    
}
   
if(isset($_POST['data'])){

    // Obtener los datos enviados por Ajax
    $data = json_decode($_POST['data']);

    // Obtener los valores individuales
    $estudio = $data->estudio;
    $precio = $data->precio;
    $ids = $data->ids;

    // Realizar las modificaciones en la base de datos
    if ($estudio == 1) {
        $columna = "CostoEstudio";
        $tipo = 'estudios';
    } else {
        $columna = "Costo";
        $tipo = 'obrasocial';
    }

    foreach ($ids as $id) {
        // Escapar los valores para evitar inyección de SQL
        $id = $conServicios->real_escape_string($id);
        $precio = $conServicios->real_escape_string($precio);

        // Consulta UPDATE
        $sql = "UPDATE obrascosto SET $columna = $precio WHERE id = $id";

        // Ejecutar la consulta
        $resultado = $conServicios->query($sql);
        
        // Verificar si hubo error en la consulta
        if (!$resultado) {
            echo "Error en la actualización de $tipo: " . $conServicios->error;
            break; // Detener el bucle en caso de error
        }
    }

    echo 'Actualización exitosa';

}

if(isset($_POST['tbusqueda'])){
    $Especialidad = intval($_POST['Especialidad']);
    $ObraSocial = intval($_POST['ObraSocial']);
    $Estudio = intval($_POST['Estudio']);

    $sql= "SELECT pr.Matricula,
                    pr.NomApe,
                    es.id,
                    es.Especialidad,
                    est.Estudios,
                    ob.Nombre,
                    pr.HorarioAtencion, 
                    tp.TipoAtencion
                    
                    FROM profesional AS pr
                    
                    LEFT JOIN especialidad AS es
                    ON pr.Especialidad = es.Id
                    
                    LEFT JOIN tipoatencion AS tp
                    ON tp.id = pr.TipoAtencion
                    
                    LEFT JOIN obrascosto AS obc
                    ON  obc.Matricula = pr.Matricula
                    
                    LEFT JOIN obrasocial AS ob
                    ON ob.Id = obc.ObraSocial
                    
                    LEFT JOIN estudios AS est
                    ON est.Id = obc.Estudio ";



    $cardT = '';

    
    if ($Especialidad != 0 && $ObraSocial == 0 && $Estudio == 0) {
        $sql .= " WHERE es.id = $Especialidad
                    GROUP BY pr.NomApe";
    } 
    if ($Especialidad == 0 && $ObraSocial != 0 && $Estudio == 0) {
        $sql .= " WHERE ob.Id = $ObraSocial";
    } 
    if ($Especialidad == 0 && $ObraSocial == 0 && $Estudio != 0) {
        $sql.= " WHERE obc.Estudio = $Estudio 
                        GROUP BY pr.NomApe";   
    } 
    if ($Especialidad != 0 && $ObraSocial != 0 && $Estudio == 0) {
        $sql.= " WHERE es.id = $Especialidad AND ob.Id = $ObraSocial
                GROUP BY pr.NomApe";   
    } 
    if ($Especialidad == 0 && $ObraSocial != 0 && $Estudio != 0) {
        $sql.= " WHERE obc.Estudio = $Estudio AND ob.Id = $ObraSocial
                GROUP BY pr.NomApe";   
    }
     if ($Especialidad != 0 && $ObraSocial == 0 && $Estudio != 0) {
        $sql.= " WHERE obc.Estudio = $Estudio AND es.id = $Especialidad 
                GROUP BY pr.NomApe";   
    }  

    if ($Especialidad == 0 && $ObraSocial == 0 && $Estudio == 0) {
        $cardT = '';
    } else {
        $EspeTabla = mysqli_query($conServicios,$sql);
        $cardT .= '
        <table class="display compact table table-condensed table-striped table-bordered table-hover" id="tdocOB">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Especialidad</th>
                    <th scope="col">Tipo de Atencion</th>
                    <th scope="col">Horario de Atencion</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>';
            while($REspe = $EspeTabla->fetch_assoc()){
                $cardT .= '<tr>
                            <th scope="row"></th>
                            <td>'.$REspe['NomApe'].'</td>
                            <td>'.$REspe['Especialidad'].'</td>
                            <td>'.$REspe['HorarioAtencion'].'</td>
                            <td>'.$REspe['TipoAtencion'].'</td>
                            <td><button type="button" class="btn btn-success" onclick="verMedico('.$REspe['Matricula'].')">Ver</button></td>
                        </tr>';
            }

        $cardT .= '</tbody>
        </table> 
        
        <script type="text/javascript">
            $(document).ready(function() {
                $("#tdocOB").DataTable({
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    },
                    fixedHeader: {
                        header: true,
                    footer: true
                    }                    
                });                
            });           
        </script>

        ';
    }

    echo $cardT;
}
