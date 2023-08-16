<?php
  session_start();
  // echo $_SESSION['tipo'];


  $userr = $_SESSION['usuario'];

  if (!isset($_SESSION['active'])) {
    echo "<script>
      alert ('Debe iniciar sesión para acceder a esta página');
      window.location = '../../login.php';
      </script>";
  }
  require_once "conServicios.php";

  mysqli_set_charset($conServicios, "utf8");

?>

  
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Metricas</title>
    <?php require_once "dependencias.php" ?>
    <!-- <link rel="icon" href="../../imagen/modelo.jpg"> -->
  </head>
  <body>
  <?php require_once "menu.php" ?>

   <div class="container">
        <p>Novedades</p>
   </div>
  <br>
  <br><br><br>
      <div class="container">
        <div id="calendar">

        </div>
      </div>  
  <script>
        $(document).ready(function() {
          $("#calendar").fullCalendar({
            events: './Cancelaciones/events.php',
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
  </body>
</html>

<?php ?>
