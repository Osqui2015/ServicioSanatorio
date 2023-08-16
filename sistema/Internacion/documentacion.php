<?php 

  session_start();
  // echo $_SESSION['tipo'];

  require_once "../../conServicios.php";
  $userr = $_SESSION['NombreApe']; /*VALOR USUARIO*/
    $Datos = mysqli_query($conServicios, "SELECT fr.*,
                                          fr.imgUno, img1.dire AS uno, 
                                          fr.imgDos, img2.dire AS dos, 
                                          fr.imgTres, img3.dire AS tres
                                          FROM form AS fr
                                          LEFT JOIN formimg AS img1 ON fr.imgUno = img1.id
                                          LEFT JOIN formimg AS img2 ON fr.imgDos = img2.id
                                          LEFT JOIN formimg AS img3 ON fr.imgTres = img3.id");

?>

<!doctype html>
<html lang="es-ES">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <?php  include_once "dependencias.php" ?>
    <title> Administración </title>
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
    <?php  include_once "menuInter.php" ?>
<div class="container">
    <br>
    <br><br>
        <h1>Encuesta Pre-Admisión </h1>
        <h4>Administración</h4>
        
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
        <table class="table table-striped table-hover" id="example">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Fecha de carga</th>
                    <th scope="col">Dni</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha Cirugia</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Altura</th>
                    <th scope="col">Tipo de Alimentacion</th>
                    <th scope="col">imagen 1</th>
                    <th scope="col">imagen 2</th>
                    <th scope="col">imagen 3</th>
                    <th scope="col">Detalle</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_array($Datos)): ?>
                    <tr class="table-info">
                        <td><p class="font-weight-bolder"><?= $row['fecha'] ?></p></td>
                        <td><p class="font-weight-bolder"><?= $row['dni'] ?></p></td>
                        <td><p class="font-weight-bolder"><?= utf8_encode($row['nombre_paciente']) ?></p></td>
                        <td><p class="font-weight-bolder"><?= $row['fecha_cirugia'] ?></p></td>
                        <td><p class="font-weight-bolder"><?= $row['peso'] ?></p></td>
                        <td><p class="font-weight-bolder"><?= $row['estatura'] ?></p></td>
                        <td><p class="font-weight-bolder"><?= utf8_encode($row['tipo_alimentacion']) ?></p></td>
                       

                        <td>
                          <?php if ($row['uno'] === null): ?>
                          <?php else: ?>
                            <a href="../../../Formulario/<?= $row['uno'] ?>" download>Descargar</a>
                          <?php endif; ?>
                        </td>

                        <td>
                          <?php if ($row['dos'] === null): ?>
                          <?php else: ?>
                            <a href="../../../Formulario/<?= $row['dos'] ?>" download>Descargar</a>
                          <?php endif; ?>
                        </td>

                        <td>
                          <?php if ($row['tres'] === null): ?>
                          <?php else: ?>
                            <a href="../../../Formulario/<?= $row['tres'] ?>" download>Descargar</a>
                          <?php endif; ?>
                        </td>

                        <td><p class="font-weight-bolder"> info </p></td>
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