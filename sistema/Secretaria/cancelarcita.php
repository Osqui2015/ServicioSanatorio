<?php
    session_start();
    // echo $_SESSION['tipo'];
    require_once "../../conServicios.php"; 

    $menNombre = mysqli_query($conServicios, "SELECT * FROM profesional ORDER BY NomApe;");

?>

<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema Turnos</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
    <?php  include_once "dependencias.php" ?>

    <!--  Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  
    
    <!-- searchPanes -->
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.0.1/css/searchPanes.dataTables.min.css">
    <!-- select -->
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">


        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' />
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet'>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/es.js'></script>

        <style>
            #calendar {
                max-width: 900px;
                margin: 0 auto;
            }
        </style>
</head>
<body>
  <!–– menu -->
    <?php  include_once "menuSecretaria.php" ?>
  <!–– fin menu -->
  <br><br><br>

    <div class="card mx-auto" style="width: 90%; max-width: 400px;">
      <div class="card-body">
        <h5 class="card-title text-center">Cancelación de turno</h5>
       
          <div class="form-group">
            <label for="nombreDoctor">Nombre Doctor:</label>
            <select class="js-select-Nombre custom-select" name="Nombre" id="Nombre">
                <option value="00"> </option>
                <?php while($row=mysqli_fetch_array($menNombre)) { ?>
                <option value="<?php echo utf8_encode($row['Matricula'])?>"><?php echo utf8_encode($row['NomApe'])?></option>
                <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="tipoCancelacion">Tipo de Cancelación:</label>
            <select class="form-control" id="tipoCancelacion">
              <option>Motivos personales</option>
              <option>Vacaciones</option>
              <option>Licencias</option> 
              <option>Congreso</option>             
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
          <button class="btn btn-primary btn-block" onclick="GCancelar()">Guardar</button>
        
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
            eventRender: function (event, element) {
                switch (true) {
                    case event.title.indexOf("Motivos personales") != -1:
                        element.css('background-color', '#F44336');
                        break;
                    case event.title.indexOf("Vacaciones") != -1:
                        element.css('background-color', '#9C27B0');
                        break;
                    case event.title.indexOf("Licencias") != -1:
                        element.css('background-color', '#03A9F4');
                        break;
                    case event.title.indexOf("Congreso") != -1:
                        element.css('background-color', '#4CAF50');
                        break;
                    default:
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
  
  <br><br>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      
  <!--   Datatables-->
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  

  <!-- searchPanes   -->
  <script src="https://cdn.datatables.net/searchpanes/1.0.1/js/dataTables.searchPanes.min.js"></script>
  <!-- select -->
  <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>        
        
<!--  -->
</body>

</html>
