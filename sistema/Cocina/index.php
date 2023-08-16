<?php 

  session_start();
  // echo $_SESSION['tipo'];

  require_once "../../conServicios.php";
  $userr = $_SESSION['NombreApe']; /*VALOR USUARIO*/
  
  if(!isset($_SESSION['active'])){
    echo "<script>
    alert ('Debe iniciar sesión para acceder a esta página');
    window.location = '../../login.php';
    </script>";
  }
    $Datos = mysqli_query($conServicios, "SELECT * FROM form");


?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <?php  include_once "dependencias.php" ?>
    <title> Cocina </title>
    <style>
        body {
            background-image: url('../img/escribir.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        label {
            font-weight: bold;
        }

        p {
            font-weight: bold;
        }

    </style>
</head>
<body>
    <?php  include_once "menuCocina.php" ?>
<div class="">    
    <br><br><br>
        <h1>Encuesta Pre-Admisión </h1>
        <h4>COCINA</h4>
        
    <br>
    
        
    <div class="d-flex h-100">
        <div class="card mx-auto my-auto text-center d-flex flex-column">
            <div class="card-body">
            <label for="startDate">Fecha de inicio:</label>
            <input type="date" id="startDate" name="startDate" onchange="buscarFecha()">

            <label for="endDate">Fecha fin:</label>
            <input type="date" id="endDate" name="endDate" onchange="buscarFecha()">

            <button onclick="buscarFecha()" hidden>Buscar</button>
            </div>
        </div>
    </div>


<br><br>
    

    
        
    <div id='busquedaData'>
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
            <?php while($row = mysqli_fetch_array($Datos)): ?>
                    <tr class="table-light">
                        <td><p class="font-weight-bolder"><?= $row['fecha_cirugia'] ?></p></td>    
                    
                        <td><p class="font-weight-bolder"><?= $row['dni'] ?></p></td>
                        <td><p class="font-weight-bolder"><?= utf8_encode($row['nombre_paciente']) ?></p></td>
                        
                        <td><p class="font-weight-bolder"><?= $nuevo_texto = str_replace(',', "\n",str_replace('enfermedades-', '', $row['enfermedades'])); ?></p></td>                        
                        <td><p class="font-weight-bolder"><?= utf8_encode($row['tipo_alimentacion']) ?></p></td>
                        <td><p class="font-weight-bolder"><?= utf8_encode($row['alimentos_alergia']) ?></p></td>
                        <td><p class="font-weight-bolder"><?= utf8_encode($row['prohibicion_alimentaria']) ?></p></td>
                        <td><p class="font-weight-bolder"><?= utf8_encode($row['alimentos_prohibidos']) ?></p></td>
                        <td><p class="font-weight-bolder"><?= utf8_encode($row['detalle_alimento']) ?></p></td>

                        <td><p class="font-weight-bolder"><?= $row['fecha'] ?></p></td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>                               
    </div>

        

    <br><br><br>
    <br><br><br>
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
                    doc.footer = function(currentPage, pageCount) {
                        return {
                        columns: [
                            {
                            alignment: 'center',
                            text: [
                                { text: 'Sanatorio Modelo ©', fontSize: 10, bold: true }
                            ]
                            }
                        ],
                        margin: [10, 0]
                        }
                    };
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
</body>

</html>



