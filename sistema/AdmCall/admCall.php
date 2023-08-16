<?php
require_once "../../conServicios.php";
if (isset($_POST['Tpreguntas'])) {

  $muestra = '';

  $preg = mysqli_query($conServicios, "SELECT * FROM tabla_preguntas");


  $muestra = '';
  while ($fila = $preg->fetch_assoc()) {

    $muestra .= '<form class="row g-2">
                        <div class="col-auto">
                            <label>' . utf8_encode($fila['pregunta']) . '</label>
                        </div>
                        <div class="col-auto">                                                
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="input' . $fila['Id'] . '" >                              
                              <option value="' . $fila['pts'] . '" selected>Si</option>
                              <option value="0">No</option>
                              <option value="' . $fila['pts'] . '" >No Aplica</option>
                            </select>
                        </div>
                    </form>';
  }

  $muestra .= '<div class="input-group">
          <span class="input-group-text">OBSERVACIONES</span>
          <textarea id="obs" class="form-control" aria-label="With textarea"></textarea>
        </div>';

  // Imprimir el formulario

  echo $muestra;
}

if (isset($_POST['gMetrica'])) {


  $fecha = $_POST['fecha'];
  $ID = $_POST['ID'];
  $Evaluador = $_POST['Evaluador'];
  $Caso = $_POST['Caso'];
  $Canal = $_POST['Canal'];
  $Motivo = $_POST['Motivo'];
  $input = $_POST['inputs'];
  $Legajo = $_POST['Legajo'];
  $suma = $_POST['suma'];
  $AHT = $_POST['AHT'];
  $NPC = $_POST['NPC'];
  $FCR = $_POST['FCR'];
  $OTRO = $_POST['OTRO'];
  $obs = $_POST['obs'];
  $fechaActual = date("Y-m-d");


  $valores = array();
  $valores['existe'] = "1";

  $TMetricas = "INSERT INTO tabla_metricas (id_r, Legajo, Num_Caso, Fecha, Evaluador, Canal, Motivo_Contacto, Puntaje, aht_n, nps_n, fcr_n, otro_n) 
                                    value ($ID, $Legajo, $Caso, '$fecha', '$Evaluador', '$Canal', '$Motivo', $suma, $AHT, $NPC, $FCR, $OTRO)";



  // Crear la consulta SQL para insertar el registro en la tabla
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
  $valores = JSON_encode($valores, JSON_THROW_ON_ERROR);
  echo $valores;
}
