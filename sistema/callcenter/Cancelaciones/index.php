<?php
session_start();
// echo $_SESSION['tipo'];
require_once "../conServicios.php";
$userr = $_SESSION['usuario'];
$menNombre = mysqli_query($conServicios, "SELECT * FROM profesional ORDER BY NomApe;");

?>

<!DOCTYPE html>
<html lang="es-ES">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cancelacion de Turnos</title>
  <?php require_once "../dependencias.php" ?>
  <style>
    #calendar {
      max-width: 900px;
      margin: 0 auto;
    }
  </style>
</head>

<body>
  <!–– menu -->
  <?php require_once "../menu.php" ?>
  <input type="text" name="" id="UsuarioSistema" value="<?php echo $userr ?>" hidden>
    <!–– fin menu -->
      <div class="card mx-auto" style="width: 90%; max-width: 400px;">
        <div class="card-body">
          <h5 class="card-title text-center">Cancelación de turno</h5>

          <div class="form-group">
            <label for="nombreDoctor">Nombre Doctor:</label>
            <select id="select-doctor" name="especialidad" class="form-select form-select-sm" aria-label=".form-select-sm example">
              <option value="00"> </option>
              <?php while ($row = mysqli_fetch_array($menNombre)) { ?>
                <option value="<?php echo utf8_encode($row['Matricula']) ?>"><?php echo utf8_encode($row['NomApe']) ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="tipoCancelacion">Tipo:</label>
            <select class="form-control" id="tipoCancelacion">
              <option> </option>
              <option>Cancelacion</option>
              <option>Modificacion</option>
              <option>Habilitacion</option>
              <option>Otros.</option>
            </select>
          </div>
          <div class="form-group">
            <label for="fechaInicio">Fecha Inicio:</label>
            <input type="date" class="form-control" id="fechaInicio">
          </div>
          <div class="form-group">
            <label for="fechaFin">Fecha Fin:</label>
            <input type="date" class="form-control" id="fechaFin">
          </div>
          <div class="form-group">
            <label for="observacion">Observación:</label>
            <textarea class="form-control" id="observacion" rows="3"></textarea>
          </div>
          <br>
          <button class="btn btn-primary btn-block" onclick="verificarDatos()">Guardar</button>

        </div>
      </div>
      <br><br><br>
      <div class="container">
        <div id="calendar">

        </div>
      </div>



      <br><br>

      <script>
        $(document).ready(function() {
          $("#calendar").fullCalendar({
            events: 'events.php',
            header: {
              left: 'prev,next today',
              center: 'title',
              right: 'month,agendaWeek,agendaDay,listMonth'
            },
            defaultView: 'month',
            editable: true,
            eventRender: function(event, element) {
              switch (true) {
                case event.title.indexOf("Cancelacion") != -1:
                  element.css('background-color', '#F44336');
                  break;
                case event.title.indexOf("Modificacion") != -1:
                  element.css('background-color', '#03A9F4');
                  break;
                case event.title.indexOf("Habilitacion") != -1:
                  element.css('background-color', '#4CAF50');
                  break;
                default:
                  element.css('background-color', '#9C27B0');
                  break;
              }
              element.css('color', 'white');
              element.css('font-size', '18px');
              element.click(function() {
                alert(event.title);
              });
            },

            locale: 'es'
          });

          $("#Nombre").change(function() {
            var doctorId = $(this).val();
            $.ajax({
              url: "obtener_agenda.php",
              type: "post",
              data: {
                doctorId: doctorId
              },
              success: function(response) {
                var agenda = JSON.parse(response);
                var events = [];
                for (var i = 0; i < agenda.length; i++) {
                  events.push({
                    title: agenda[i].title,
                    start: agenda[i].start,
                    end: agenda[i].end
                  });
                }
                $("#calendar").fullCalendar("removeEvents");
                $("#calendar").fullCalendar("addEventSource", events);
              }
            });
          });
        });
      </script>
      <script src="./funciones/funciones.js"></script>
      
      <br><br>



      <!--  -->
</body>

</html>