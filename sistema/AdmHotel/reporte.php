<?php
  session_start();
  // echo $_SESSION['tipo'];

  require_once "../../conServicios.php";
  require_once "../../conServicios.php";

 $cargaEstadosHab = mysqli_query($conServicios, "SELECT HE.Id,
                                                    HE.Fecha,
                                                    H.Habitaciones,
                                                    H.Piso,
                                                    E.Estado,
                                                    HE.Obs,
                                                    HE.Usuario
                                                    
                                                    FROM historialEstado AS HE
                                                    INNER JOIN habitacion AS H
                                                    ON HE.Hab = H.Id
                                                    
                                                    INNER JOIN estados AS E
                                                    ON HE.Estado = E.Id
                                                    
                                                    ORDER BY HE.Id DESC ")

?>



<!doctype html>
<html lang="en">
<head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <?php  include_once "dependencias.php" ?>
    <title>Hoteleria Adm</title>
</head>
<body>
    <?php  include_once "menuHoteleria.php" ?>
    <br><br><br> 
    <div class="alert alert-info text-center" role="alert">
        <h5>Reporte de Habitaciones</h5>
    </div>
    <br>
    <br>

    

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="reporteHab">
                    <thead>
                        <tr>
                        <th scope="col"> Fecha </th>
                        <th scope="col"> Piso </th>
                        <th scope="col"> Habitacion </th>
                        <th scope="col"> Tipo </th>
                        <th scope="col"> Estado </th>
                        <th scope="col"> Observacion </th>
                        <th scope="col"> Usuario </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row=mysqli_fetch_array($cargaEstadosHab)) {?>
                            <tr>
                                <td> <?php echo utf8_encode($row['Fecha']); ?> </td>
                                <td> <?php echo utf8_encode($row['Piso']);?> </td>
                                <td> <?php echo utf8_encode($row['Habitaciones']);?> </td>
                                <td>  </td>
                                <td> <?php echo utf8_encode($row['Estado']);?> </td>
                                <td> <?php echo utf8_encode($row['Obs']);?> </td>
                                <td> <?php echo utf8_encode($row['Usuario']);?> </td>
                                                        
                            </tr>
                        <?php } ?>                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function(){
            $('#reporteHab').DataTable({

                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                    },
                    fixedHeader: {
                    header: true,
                    footer: true,
                    },
                    dom: "Bfrtip",
                        buttons:[ 
                            {
                                    extend:    "excelHtml5",
                                    text:      "Exportar a Excel",
                                    titleAttr: "Exportar a Excel",
                                    title:     "Título del documento",
                                    exportOptions: {
                                        columns: [2,3,4,5,6,7]
                                    }
                            },
                            {
                                    extend:    "pdfHtml5",
                                    text:      "Exportar a PDF",
                                    titleAttr: "Exportar a PDF",
                                    className: "btn btn-danger",
                                    title:     "Título del documento",
                                    exportOptions: {
                                        columns: [2,3,4,5,6,7]
                                    }                    
                            },
                            {
                                    extend:    "print",
                                    text:      "Imprimir",
                                    titleAttr: "Imprimir",
                                    className: "btn btn-info",
                                    exportOptions: {
                                        columns: [2,3,4,5,6,7]
                                    }
        
                            }
                        ]
            });
            
            /* $('.js-select-MenHab').select2();
            $('.js-select-Especialidad').select2();
            $('.js-select-Nombre').select2();
            $('.js-select-TipoHabAdd').select2(); */
        });

    </script>
</body>
</html>