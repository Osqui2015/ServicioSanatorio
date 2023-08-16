<?php
session_start();
// echo $_SESSION['tipo'];

require_once "../../conServicios.php";
$userr = $_SESSION['usuario']; /*VALOR USUARIO*/

if (!isset($_SESSION['active'])) {
  echo "<script>
    alert ('Debe iniciar sesión para acceder a esta página');
    window.location = '../../login.php';
    </script>";
}

$sql = mysqli_query($conServicios, "SELECT * FROM usuario WHERE Sector = 3");


?>

<html class=" ">

<head>
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php require_once "dependencia.php" ?>
  <title>Call Center</title>
</head>

<body onload="pregyresp()">
  <?php require_once "menuSecretaria.php" ?>
  <br>
  <br>
  <br>
  <div class=" container">
    <div class="card">
      <div class="card-body ">

        <div class="row mt-2 ">
          <div class="col-2 border-end">
            Legajo
          </div>
          <div class="col-4">
            <select id="select-Legajo" class="form-select form-select-sm" aria-label=".form-select-sm example">
              <option value="00"></option>
              <?php while ($row = mysqli_fetch_array($sql)) { ?>
                <option value="<?php echo $row['usuario'] ?>"><?php echo utf8_encode($row['NombreApe']) ?> </option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-2 border-end">
            Fecha
          </div>
          <div class="col-4">
            <input type="date" class="form-control" id="fecha" name="fecha">
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-2 border-end">
            ID #:
          </div>
          <div class="col-4">
            <input type="text" class="form-control" id="ID" name="ID">
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-2 border-end">
            Evaluador:
          </div>
          <div class="col-4">
            <input type="text" class="form-control" id="Evaluador" name="Evaluador">
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-2 border-end">
            N° Caso
          </div>
          <div class="col-4">
            <input type="text" class="form-control" id="Caso" name="Caso">
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-2 border-end">
            Canal
          </div>
          <div class="col-4">
            <input type="text" class="form-control" id="Canal" name="Canal">
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-2 border-end">
            Motivo de contacto:
          </div>
          <div class="col-4">
            <input type="text" class="form-control" id="Motivo" name="Motivo">
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
                <div class="col-sm-3"><input type="text" class="form-control" id="AHT" name="AHT"></div>
              </div>
            </div>

            <div class="row">
              <div class="row">
                <div class="col-sm-3">NPC</div>
                <div class="col-sm-3"><input type="text" class="form-control" id="NPC" name="NPC"></div>
              </div>
            </div>

            <div class="row">
              <div class="row">
                <div class="col-sm-3">FCR</div>
                <div class="col-sm-3"><input type="text" class="form-control" id="FCR" name="FCR"></div>
              </div>
            </div>

            <div class="row">
              <div class="row">
                <div class="col-sm-3">OTRO</div>
                <div class="col-sm-3"><input type="text" class="form-control" id="OTRO" name="OTRO"></div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>


    <br>
    <div class="card">
      <div class="card-body">
        <div id='preguntas'>

        </div>
        <div class="container text-center">
          <button type="button" class="btn btn-primary" onclick="gMetricas()">Guardar</button>
        </div>
      </div>
    </div>

  </div>
  <br><br>
  <script>
    $(document).ready(function() {
      $('#select-Legajo').select2();


    });

    function pregyresp() {
      var parametros = {
        "Tpreguntas": "1",
      };
      console.log(parametros)
      $.ajax({
        data: parametros,
        url: '/servicios/sistema/AdmCall/admCall.php',
        type: 'POST',
        success: function(r) {
          $('#preguntas').html(r)
        }
      })
    }

    function gMetricas() {
      fecha = $("#fecha").val();
      ID = $("#ID").val();
      Evaluador = $("#Evaluador").val();
      Caso = $("#Caso").val();
      Canal = $("#Canal").val();
      Motivo = $("#Motivo").val();
      Legajo = $("#select-Legajo").val();
      AHT = $("#AHT").val();
      NPC = $("#NPC").val();
      FCR = $("#FCR").val();
      OTR = $("#OTRO").val();
      obs = $("#obs").val();

      if (fecha == "" || fecha == null || ID == "" || ID == null || Evaluador == "" || Evaluador == null || Caso == "" || Caso == null || Canal == "" || Canal == null || Motivo == "" || Motivo == null || Legajo == "" || Legajo == null) {
        alert("Completar Datos");
      } else {
        let suma = 0;
        let inputs = [];

        for (let x = 1; x < 28; x++) {
          inputs[x] = $("#input" + x).val();
          suma += parseFloat(inputs[x]) || 0; // suma los valores de los inputs y convierte el valor a número usando parseFloat
        }
        console.log("La suma de los valores de los inputs es: " + suma);
        var parametros = {
          "gMetrica": 1,
          "fecha": fecha,
          "ID": ID,
          "Evaluador": Evaluador,
          "Caso": Caso,
          "Canal": Canal,
          "Motivo": Motivo,
          "Legajo": Legajo,
          "inputs": inputs,
          "suma": suma,
          "AHT": AHT,
          "NPC": NPC,
          "FCR": FCR,
          "OTRO": OTR,
          "obs": obs
        };
        console.log(parametros)
        $.ajax({
          type: "POST",
          url: '/servicios/sistema/AdmCall/admCall.php',
          data: parametros,
          success: function(data) {
            // Se ejecuta si se ha guardado el registro correctamente            
            alert("Registro guardado correctamente.");
            setTimeout(function() {
              $(location).attr('href', '/servicios/sistema/AdmCall/metricas.php');
            }, 0);
          },
          error: function(xhr, status, error) {
            // Se ejecuta si ha ocurrido un error al guardar el registro
            console.log("Error al guardar el registro.");
          }
        });
      }

    }
  </script>
</body>

</html>