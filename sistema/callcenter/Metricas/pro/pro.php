<?php
    require "../conServicios.php";
    mysqli_set_charset($conServicios, "utf8");

if (isset($_POST['gMetrica'])) { 
        $fecha = mysqli_real_escape_string($conServicios, $_POST['fecha']);
        $ID = mysqli_real_escape_string($conServicios, $_POST['ID']);
        $Evaluador = mysqli_real_escape_string($conServicios, $_POST['Evaluador']);
        $Caso = mysqli_real_escape_string($conServicios, $_POST['Caso']);
        $Canal = mysqli_real_escape_string($conServicios, $_POST['Canal']);
        $Motivo = mysqli_real_escape_string($conServicios, $_POST['Motivo']);
        $input = $_POST['inputs'];
        $Legajo = mysqli_real_escape_string($conServicios, $_POST['Legajo']);
        $suma = mysqli_real_escape_string($conServicios, $_POST['suma']);
        $AHT = mysqli_real_escape_string($conServicios, $_POST['AHT']);
        $NPC = mysqli_real_escape_string($conServicios, $_POST['NPC']);
        $FCR = mysqli_real_escape_string($conServicios, $_POST['FCR']);
        $OTRO = mysqli_real_escape_string($conServicios, $_POST['OTRO']);
        $obs = mysqli_real_escape_string($conServicios, $_POST['obs']);
        $fechaActual = date("Y-m-d");
        
        $valores = array();
        $valores['existe'] = "1";
        
        $TMetricas = "INSERT INTO tabla_metricas (ID_r, Legajo, Num_Caso, Fecha, Evaluador, Canal, Motivo_Contacto, Puntaje, aht_n, nps_n, fcr_n, otro_n, Fecha_Carga, EstadoCarg) 
                      VALUES ($ID, $Legajo, $Caso, '$fecha', '$Evaluador', '$Canal', '$Motivo', $suma, $AHT, $NPC, $FCR, $OTRO, '$fechaActual', 0)";
        
        $sql = "INSERT INTO datosm (legajo, caso, preg1, preg2, preg3, preg4, preg5, preg6, preg7, preg8, preg9, preg10, preg11, preg12, preg13, preg14, preg15, preg16, preg17, preg18, preg19, preg20, preg21, preg22, preg23, preg24, preg25, preg26, preg27, obs)
        VALUES ($Legajo, $Caso, '$input[1]', '$input[2]', '$input[3]', '$input[4]', '$input[5]', '$input[6]', '$input[7]', '$input[8]', '$input[9]', '$input[10]', '$input[11]', '$input[12]', '$input[13]', '$input[14]', '$input[15]', '$input[16]', '$input[17]', '$input[18]', '$input[19]', '$input[20]', '$input[21]', '$input[22]', '$input[23]', '$input[24]', '$input[25]', '$input[26]', '$input[27]', '$obs')";

        $resultadoUno = mysqli_query($conServicios, $TMetricas);
        $resultadoDos = mysqli_query($conServicios, $sql);

        if (!$resultadoUno) {
        echo "Error en la inserción resultadoUno: " . $conServicios->error;
        $valores['existe'] = "0";
        } else if (!$resultadoDos) {
        echo "Error en la inserción resultadoDos: " . $conServicios->error;
        $valores['existe'] = "0";
        }

        $valores = json_encode($valores, JSON_THROW_ON_ERROR);
        header('Content-Type: application/json');
        echo $valores;
    
}    

if (isset($_POST['RCaso'])){
    $Ncaso = mysqli_real_escape_string($conServicios, $_POST['caso']);
    $muestra = '';
    
    $caso = "SELECT us.*,tm.*, d.*
                FROM tabla_metricas AS tm
                LEFT JOIN usuario AS us
                ON tm.Legajo = us.usuario
                LEFT JOIN datosm AS d
                ON tm.Num_Caso = d.caso
                WHERE d.caso = $Ncaso;";
    $resultado = mysqli_query($conServicios, $caso);

    $consulta = "SELECT * FROM tabla_preguntas";

    $preguntas = mysqli_query($conServicios, $consulta);

    $consultaR = "SELECT * FROM datosm WHERE caso = $Ncaso";

    $respuesta = mysqli_query($conServicios,  $consultaR);


    while ($Rcaso = $resultado->fetch_assoc()) {
    $muestra .= '
        <div class="container">
            <div class="card">
                <div class="card-body ">

                    <div class="row mt-2 ">
                        <div class="col-2 border-end">
                            Legajo
                        </div>
                        <div class="col-4">
                            <p>'. $Rcaso['usuario']. '</p>
                        </div>
                    </div>

                    <div class="row mt-2 ">
                        <div class="col-2 border-end">
                            Nombre y Apellido
                        </div>
                        <div class="col-4">
                            <p>'. $Rcaso['NombreApe']. '</p>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-2 border-end">
                            Fecha
                        </div>
                        <div class="col-4">
                            <p>'. $Rcaso['Fecha']. '</p>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-2 border-end">
                            Fecha de Carga
                        </div>
                        <div class="col-4">
                            <p>'. $Rcaso['Fecha_Carga']. '</p>
                        </div>
                    </div>

                    <div class="row mt-2">
                    <div class="col-2 border-end">
                        ID #:
                    </div>
                    <div class="col-4">
                        <p>'. $Rcaso['id_r']. '</p>
                    </div>
                    </div>

                    <div class="row mt-2">
                    <div class="col-2 border-end">
                        Evaluador:
                    </div>
                    <div class="col-4">
                        <p>'. $Rcaso['Evaluador']. '</p>
                    </div>
                    </div>

                    <div class="row mt-2">
                    <div class="col-2 border-end">
                        N° Caso
                    </div>
                    <div class="col-4">
                        <p>'. $Rcaso['Num_Caso']. '</p>
                    </div>
                    </div>

                    <div class="row mt-2">
                    <div class="col-2 border-end">
                        Canal
                    </div>
                    <div class="col-4">
                        <p>'. $Rcaso['Canal']. '</p>
                    </div>
                    </div>

                    <div class="row mt-2">
                    <div class="col-2 border-end">
                        Motivo de contacto:
                    </div>
                    <div class="col-4">
                        <p>'. $Rcaso['Motivo_Contacto']. '</p>
                    </div>
                    </div>

                    <div class="row mt-2">

                    <div class="col-sm-2 d-flex align-items-center justify-content-center border-end">
                        KPIS
                    </div>

                    <div class="col-sm-8">
                        <div class="row">
                        <div class="row">
                            <div class="col-sm-3">AHT</div>
                            <div class="col-sm-3">
                                <p>'. $Rcaso['aht_n']. '</p>
                            </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="row">
                            <div class="col-sm-3">NPC</div>
                            <div class="col-sm-3">
                                <p>'. $Rcaso['nps_n']. '</p>
                            </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="row">
                            <div class="col-sm-3">FCR</div>
                            <div class="col-sm-3">
                                <p>'. $Rcaso['fcr_n']. '</p>
                            </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="row">
                            <div class="col-sm-3">OTRO</div>
                            <div class="col-sm-3">
                                <p>'. $Rcaso['otro_n']. '</p>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    ';
                    $i=1;
                    while ($Rpreguntas = $preguntas->fetch_assoc()) { 
                        $muestra .= ' <div class="row">
                        <div class="col">                                
                            <p>'. $Rpreguntas['pregunta']. '</p>
                        </div>
                        <div class="col">
                            <p>';
                    
                                if ($Rcaso['preg'.$i] == 1) {
                                    $muestra .= 'no aplica';
                                } else if ($Rcaso['preg'.$i] == 0) {
                                    $muestra .= 'no';
                                } else {
                                    $muestra .= 'si';
                                }
                                
                                $muestra .= '</p>
                                    </div>
                                </div>';
                            $i++;
                    }                    

    $muestra .= ' 
                        <br>                     
                        <div class="row">
                            <div class="col">
                                <p>Observaciones</p>
                            </div>
                            <div class="col">
                                <textarea class="form-control" id="ObserTarea" rows="5" readonly>'. $Rcaso['obs']. '</textarea>
                            </div>
                        </div>
                        <br>

                        <br>';

                        if ($Rcaso['EstadoCarg'] == 0){

                        $muestra .= '       <div class="container text-center">
                                                <div class="row justify-content-md-center">
                                                <div class="col-6">
                                                    <label for="ObsTarea" class="form-label">Observacion: </label>
                                                    <textarea class="form-control" id="ObsTareaText" rows="4" ></textarea>
                                                </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="container text-center">
                                                <div class="row justify-content-md-center">
                                                <div class="col-md-auto">
                                                    <button type="button" class="btn btn-success" onclick="GEstado(1,'. $Rcaso['Num_Caso']. ')"> Acepto </button>
                                                </div>
                                                <div class="col-md-auto">
                                                    <button type="button" class="btn btn-danger" onclick="GEstado(2,'. $Rcaso['Num_Caso']. ')"> Rechazo </button>
                                                </div>
                                                </div>
                                            </div>';
                        }else{
                            $muestra .= '       <div class="container text-center">
                                                    <div class="row justify-content-md-center">
                                                    <div class="col-6">
                                                        <label for="ObsTarea" class="form-label">Observacion: </label>
                                                        <p>'. $Rcaso['ObsCarg'] .'</p>
                                                    </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="container text-center">
                                                    <div class="row justify-content-md-center">';
                                                    switch ($Rcaso['EstadoCarg']) {                                                    
                                                    case 1:
                                                        $muestra .= '
                                                            <div class="col-md-auto">
                                                                <p class="fs-2 fw-bolder" >ACEPTADO</p>
                                                            </div>
                                                        ';
                                                        break;
                                                    case 2:
                                                        $muestra .= '
                                                            <div class="col-md-auto">
                                                                <p class="fs-2 fw-bolder" >RECHAZADO</p>
                                                            </div>
                                                        ';
                                                        break;
                                                }

                                        $muestra .= '</div>
                                                </div>';    
                        }

    

    $muestra .= '</div>
            </div>        
        </div>
        ';
    }

    echo $muestra;
}

if (isset($_POST['GEstadoCaso'])){
    $x = intval($_POST['x']);
    $Ncaso = intval($_POST['y']);
    $ObsTarea = $_POST['ObsTarea'];
     
    $sql= "UPDATE tabla_metricas SET ObsCarg='$ObsTarea' ,EstadoCarg=$x WHERE Num_Caso = $Ncaso;";

    $resultado = mysqli_query($conServicios, $sql);

    if (mysqli_affected_rows($conServicios)) {
        $msg = "Cargado correctamente.";
    } else {
        $msg = "Error al Cargar.";
    }

    echo $msg;

}
