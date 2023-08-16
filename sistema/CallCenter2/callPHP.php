<?php
require_once "../../conServicios.php";

if (isset($_POST['TMedico'])) {

  $x = $_POST['x'];
  $Especialidad = $_POST['Especialidad'];
  $ObraSocial = $_POST['ObraSocial'];
  $Estudios = $_POST['Estudios'];

  $Consultasql = "SELECT pr.Matricula,
                        pr.NomApe,
                        es.Id,
                        es.Especialidad,
                        tp.TipoAtencion,
                        estn.Id,
                        estn.Estudios,
                        ob.Id,
                        ob.Nombre
                                                                      
                        FROM profesional AS pr

                        LEFT JOIN especialidad AS es
                        ON pr.Especialidad = es.Id

                        LEFT JOIN tipoatencion AS tp
                        ON pr.TipoAtencion = tp.id 

                        LEFT JOIN obrascosto AS est
                        ON est.Matricula = pr.Matricula

                        LEFT JOIN estudios AS estn
                        ON estn.id = est.Estudio

                        LEFT JOIN obrasocial AS ob
                        ON ob.id = est.ObraSocial ";
  if ($x == 1) {
  } else {
    $Consultasql .= "WHERE pr.Matricula IS NOT NULL  ";
  }

  if ($Especialidad <> 0) {
    $Consultasql .= "AND es.Id = $Especialidad ";
  }
  if ($ObraSocial <> 0) {
    $Consultasql .= "AND ob.id = $ObraSocial ";
  }
  if ($Estudios <> 0) {
    $Consultasql .= "AND  estn.Id = $Estudios ";
  }
  $Consultasql .= "GROUP BY pr.Matricula";

  $sql = mysqli_query($conServicios, $Consultasql);

  $salida = '<table id="Tdoc" class="table compact table-striped">
                    <thead>
                        <tr>
                            <th> Matricula </th>
                            <th> Apellido y Nombre </th>
                            <th> Especialidad </th>
                            <th> Tipo de Atencion </th>
                            <th> Ver </th>                
                        </tr>
                    </thead>
                    <tbody>';
  while ($fila = $sql->fetch_assoc()) {
    $salida .=
      '<tr>
                              <td>' . $fila['Matricula'] . '</td>
                              <td>' . utf8_encode($fila['NomApe']) . '</td>
                              <td>' . utf8_encode($fila['Especialidad']) . '</td>
                              <td>' . $fila['TipoAtencion'] . '</td>
                              <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#infoDoc" onclick="infoDoc(' . $fila['Matricula'] . ')" > Ver </button>
                              </td>
                          </tr>';
  }
  $salida .= '</tbody>
              </table> 
              <script src="/servicios/sistema/CallCenter/funciones.js"></script>';
  echo $salida;
}

if (isset($_POST['TInfo'])) {

  $x = $_POST['x'];

  $obraTabla = mysqli_query($conServicios, "SELECT obc.id,
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
    
    WHERE obc.Matricula = $x");

  $docInfo = mysqli_query($conServicios, "SELECT * FROM profesional WHERE Matricula = $x;");

  $salida = '<div class="card border border-0">';
  while ($datos = $docInfo->fetch_assoc()) {
    $salida .= '<div class="card-header fs-2">
              ' . utf8_encode($datos['NomApe']) . '
            </div>
            <ul class="list-group list-group-flush ">
              <li class="list-group-item">' . utf8_encode($datos['Especialidad']) . '</li>
              <li class="list-group-item">' . utf8_encode($datos['Consultorio']) . '</li>
              <li class="list-group-item">' . utf8_encode($datos['HorarioAtencion']) . '</li>
              <li class="list-group-item">' . utf8_encode($datos['Telefono']) . '</li>
              <li class="list-group-item">Email</li>
            </ul>
          </div>
          <br>
          <p class="fs-3"><u>Informacion Adicional:</u></p>
            <p class="fs-6">' . utf8_encode($datos['Obs']) . '</p>
          <br>';
  }
  $salida .= '<br>
          <div>
            <table id="Tos" class="table compact table-striped">
              <thead>
                <tr>
                  <th> Id </th>
                  <th> Obra Social </th>
                  <th> Plan </th>
                  <th> Costo </th>
                  <th> Tipo </th>
                  <th> Estudios </th>
                  <th> Costo de Estudio </th>
                </tr>
              </thead>
              <tbody>';
  while ($fila = $obraTabla->fetch_assoc()) {
    $salida .= '<td>' . utf8_encode($fila['id']) . '</td> 
                  <td>' . utf8_encode($fila['nombre']) . '</td> 
                  <td>' . utf8_encode($fila['plan']) . '</td> 
                  <td>' . utf8_encode($fila['Costo']) . '</td> 

                  <td>' . utf8_encode($fila['Tipo']) . '</td>            
                  <td>' . utf8_encode($fila['Estudios']) . '</td>

                  <td>' . utf8_encode($fila['CostoEstudio']) . '</td>

                  </tr>';
  }
  $salida .= '</tbody>
          </table>
          </div>
          <script src="/servicios/sistema/CallCenter/funciones.js"></script>';
  echo $salida;
}

if (isset($_POST['cancelarG'])) {

  $nombreDoctor = $_POST["nombreDoctor"];
  $tipoCancelacion = $_POST["tipoCancelacion"];
  $fechaInicio = $_POST["fechaInicio"];
  $fechaFin = $_POST["fechaFin"] . ' 23:59:00';
  $observacion = $_POST["observacion"];
  $fecha_actual = date('Y-m-d');

  $sql = "INSERT INTO cancelacionmedico (Matricula, Fecha, Obs, fechaInicio, fechaFin, tipoCancelacion)
    VALUES ('$nombreDoctor', '$fecha_actual','$observacion', '$fechaInicio', '$fechaFin', '$tipoCancelacion')";

  if ($conServicios->query($sql) === true) {
    echo "Record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conServicios->error;
  }

  $conServicios->close();
}

if (isset($_POST['Tpreguntas'])) {

  $x = $_POST["x"];
  $muestra = '';

  $preg = mysqli_query($conServicios, "SELECT * FROM datosM WHERE id = 1");

  // Realizar la consulta
  $resp = mysqli_query($conServicios, "SELECT * FROM datosM WHERE caso = $x");

  // Verificar que la consulta se haya ejecutado correctamente
  if (!$resp) {
    die("Error al ejecutar la consulta: " . mysqli_error($conServicios));
  }

  // Crear un array vacío para almacenar los datos
  $datos = array();
  // Recorrer los resultados de la consulta y agregarlos al array
  while ($row = mysqli_fetch_assoc($resp)) {
    for ($x = 1; $x < 28; $x++) {
      $datos[] = $row['preg' . $x];
    }
    $datos[] = $row['obs'];
    $obs = $row['obs'];
  }

  $muestra = '';
  while ($fila = $preg->fetch_assoc()) {
    for ($x = 1; $x < 28; $x++) {
      $valorCampo = $datos[$x - 1];
      $muestra .= '<form class="row g-2">
                        <div class="col-auto">
                            <label>' . utf8_encode($fila['preg' . $x]) . '</label>
                        </div>
                        <div class="col-auto">                    
                            <input disabled readonly type="text" class="form-control" id="input" value="' . $valorCampo . '">
                        </div>
                    </form>';
    }

    $muestra .= '<div class="input-group">
                  <span class="input-group-text">OBSERVACIONES</span>
                  <textarea disabled readonly class="form-control" aria-label="With textarea">' . $obs . '</textarea>
                </div>';
  }

  // Imprimir el formulario

  echo $muestra;
}

if (isset($_POST['Tcard'])) {
  $x = $_POST["x"];
  $muestra = '';

  $card = mysqli_query($conServicios, "SELECT * FROM tabla_metricas WHERE Num_Caso = $x");

  while ($fila = $card->fetch_assoc()) {
    $muestra .= '<div class="row mt-2">
                    <div class="col-2">
                      Fecha
                    </div>
                    <div class="col-4">
                      <input disabled readonly type="date" class="form-control" id="fecha" name="fecha" value="' . utf8_encode($fila['Fecha']) . '">
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-2">
                      ID #:
                    </div>
                    <div class="col-4">
                      <input disabled readonly type="text" class="form-control" id="texto" name="texto" value="' . utf8_encode($fila['id_r']) . '">
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-2">
                      Evaluador:
                    </div>
                    <div class="col-4">
                      <input disabled readonly type="text" class="form-control" id="texto" name="texto" value="' . utf8_encode($fila['Evaluador']) . '">
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-2">
                      N° Caso
                    </div>
                    <div class="col-4">
                      <input disabled readonly type="text" class="form-control" id="texto" name="texto" value="' . utf8_encode($fila['Num_Caso']) . '">
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-2">
                      Canal
                    </div>
                    <div class="col-4">
                      <input disabled readonly type="text" class="form-control" id="texto" name="texto" value="' . utf8_encode($fila['Canal']) . '">
                    </div>
                  </div>

                  <div class="row mt-2">
                    <div class="col-2">
                      Motivo de contacto:
                    </div>
                    <div class="col-4">
                      <input disabled readonly type="text" class="form-control" id="texto" name="texto" value="' . utf8_encode($fila['Motivo_Contacto']) . '">
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
                          <div class="col-sm-3"><input disabled readonly type="text" class="form-control" id="AHT" name="AHT" value="' . utf8_encode($fila['aht_n']) . '"</div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="row">
                          <div class="col-sm-3">NPC</div>
                          <div class="col-sm-3"><input disabled readonly type="text" class="form-control" id="NPC" name="NPC" value="' . utf8_encode($fila['nps_n']) . '"></div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="row">
                          <div class="col-sm-3">FCR</div>
                          <div class="col-sm-3"><input disabled readonly type="text" class="form-control" id="FCR" name="FCR" value="' . utf8_encode($fila['fcr_n']) . '"></div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="row">
                          <div class="col-sm-3">OTRO</div>
                          <div class="col-sm-3"><input disabled readonly type="text" class="form-control" id="OTRO" name="OTRO" value="' . utf8_encode($fila['otro_n']) . '"></div>
                        </div>
                      </div>

                    </div>
                    <br>
                  </div>
    ';
  }
  echo $muestra;
}
