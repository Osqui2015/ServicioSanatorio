<?php

  require_once "../../conServicios.php";

  $startDate = $_POST['startDate'];
  $endDate = $_POST['endDate'];

  

  $query = "SELECT * FROM form WHERE fecha_cirugia = '$startDate'";
  if (!empty($endDate)) {
    $query = "SELECT * FROM form WHERE fecha_cirugia BETWEEN '$startDate' AND '$endDate'";
  }

  $result = mysqli_query($conServicios, $query);
  
  if (mysqli_num_rows($result) > 0) {
    
      /*---------*/
      $salida = <<<HTML
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered" id="example">
              <thead class="thead-light">
                  <tr>
                      <th scope="col">Fecha Cirugia</th>
                      <th scope="col">Dni</th>
                      <th scope="col">Nombre</th>
                      
                      <th scope="col">Antecedente Enfermedades</th>                      
                      <th scope="col">Tipo de Alimentacion</th>
                      <th scope="col">Alergica Alimentos</th>
                      <th scope="col">Detalle</th>
                      <th scope="col">Prohibicion por Religion</th>
                      <th scope="col">Detalle</th>
                      <th scope="col">Fecha de carga</th>
                  </tr>
              </thead>
              <tbody>
        HTML;
        
        while ($row = $result->fetch_assoc()) {
            $nuevo_texto = str_replace(',',"<br>",str_replace('enfermedades', ' ', $row['enfermedades']));
            $salida .= <<<HTML
                <tr class="table-light">
                    <td><p class="font-weight-bolder"> {$row['fecha_cirugia']} </p></td>
                    
                    <td><p class="font-weight-bolder"> {$row['dni']} </p></td>
                    <td><p class="font-weight-bolder"> {$row['nombre_paciente']} </p></td>
                    
                    <td><p class="font-weight-bolder"> {$nuevo_texto} </p></td>                    
                    <td><p class="font-weight-bolder"> {$row['tipo_alimentacion']} </p></td>
                    <td><p class="font-weight-bolder"> {$row['alimentos_alergia']} </p></td>
                    <td><p class="font-weight-bolder"> {$row['prohibicion_alimentaria']} </p></td>
                    <td><p class="font-weight-bolder"> {$row['alimentos_prohibidos']} </p></td>
                    <td><p class="font-weight-bolder"> {$row['detalle_alimento']} </p></td>
                    <td><p class="font-weight-bolder"> {$row['fecha']} </p></td>
                </tr>
        HTML;
        }

        
        $salida .= <<<HTML
                </tbody>
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
                    title: "Encuesta Pre-Admisión",
                    customize: function (doc) {
                    doc.pageOrientation = "landscape";
                    doc.content.splice(0, 0, {
                            text: [
                            {text: "Fecha:  ", style: "header"},
                            {text: new Date().toLocaleDateString(), alignment: "right"}
                            ],
                            style: "header"
                        });
                    }
                }
              ],
              initComplete: function(settings, json) {
                  $("#example").wrap("<div style='overflow:auto; width:100%;height:100%;'></div>");
                  $("#example_filter").addClass("text-center");
              }
          });
          });
        </script>
        HTML;
  
      /*---------*/
    
  } else {
    $salida = 'No se encontraron resultados';
  }

  echo $salida;
?>

