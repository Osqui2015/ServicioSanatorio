<?php
require_once "../../conServicios.php";

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
                    </div> <br><hr><br>
      ';
  }


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
  echo $muestra;
}
