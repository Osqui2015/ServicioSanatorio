<?php
    session_start();
    //echo $_SESSION['tipo'];
    if(!empty($_SESSION['active'])){
        
    }else{
        header('location: ../../index.php');
    }
    $userr = $_SESSION['usuario']; /*VALOR USUARIO*/

    require_once "../../conSanatorio.php";    
    require_once "../../conServicios.php";

    $sql = "SELECT * FROM informes WHERE Estado = 1";


    $Info = mysqli_query($conServicios,$sql);

    
    $numRows = mysqli_num_rows($Info);                   

    

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultas</title>

    <?php require_once 'dependencias.php' ?>
    


    <style>        
        .dataTables_filter {
            float: none !important; /* Elimina el flotador anterior */
            text-align: center !important; /* Centra el texto */
        }
        #TInformes_filter label {
            font-size: 25px; /* Tamaño de fuente */
            font-weight: bold; /* Texto en negrita */
            font-family: "Arial", sans-serif; /* Tipo de letra */
            color: #0C5195; /* Color de texto (cambiar a tu preferencia) */
            text-decoration: underline; /* Subrayado */
            margin-bottom: 50px; /* Margen inferior */
        }
        .bottom {
          font-family: "Arial", sans-serif; /* Tipo de letra */
          margin-bottom: 70px; /* Margen inferior */
          margin-top: 40px;
        }
        /* Estilo personalizado para el botón rojo */
        .btn-red {
            color: #100000 !important; /* Cambia el color del texto a blanco */
            background-color: #ff000066 !important; /* Cambia el color de fondo a rojo */
            border-color: #ff000038 !important; /* Cambia el color del borde a rojo */
        }

    </style>
  </head>
  <body >
    <?php require_once 'menu.php'?>


<div class="container">
      
          <table class="table table-striped table-hover table-bordered table-sm" id="TInformes">
            <thead>
              <tr>
                <th scope="col">DNI</th>
                <th scope="col">N° Ingreso</th>
                <th scope="col">Nombre Apellido</th>
                <th scope="col">N° Afiliado</th>
                <th scope="col">N° OIS</th>
                <th scope="col">Fecha Ingreso</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php while ($fila = $Info->fetch_assoc()) { ?>
                <tr>
                  <th scope="row"><?php echo $fila['NDni'] ?></th>
                  <td><?php echo $fila['NIngreso'] ?></td>
                  <td><?php echo $fila['NombreApellido'] ?></td>
                  <td><?php echo $fila['NAfiliado'] ?></td>
                  <td><?php echo $fila['NOIS'] ?></td>
                  <td>
                    <?php 
                          $fecha_formateada = date('d-m-Y', strtotime($fila['FIngreso']));

                          echo  $fecha_formateada;
                      ?>
                  </td>
                  <td>
                    <button type="button" class="btn btn-primary" onclick="ver(<?php echo $fila['Id'] ?>)">Ver</button>
                  </td>
                </tr>
              <?php } ?>  
            </tbody>
          </table>
        
</div>






  </body>
  <script>
    $(document).ready(function() {
        $("#TInformes").DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },
            "paging": false, // Desactiva la paginación
            dom: '<"top"f>rt<"bottom"lp><"clear">',
            fixedHeader: {
                header: true,
                footer: true
            },
            dom: "Bfrtip",
            buttons: [                        
                {
                    extend: "pdfHtml5",
                    text: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5 4H15V8H19V20H5V4ZM3.9985 2C3.44749 2 3 2.44405 3 2.9918V21.0082C3 21.5447 3.44476 22 3.9934 22H20.0066C20.5551 22 21 21.5489 21 20.9925L20.9997 7L16 2H3.9985ZM10.4999 7.5C10.4999 9.07749 10.0442 10.9373 9.27493 12.6534C8.50287 14.3757 7.46143 15.8502 6.37524 16.7191L7.55464 18.3321C10.4821 16.3804 13.7233 15.0421 16.8585 15.49L17.3162 13.5513C14.6435 12.6604 12.4999 9.98994 12.4999 7.5H10.4999ZM11.0999 13.4716C11.3673 12.8752 11.6042 12.2563 11.8037 11.6285C12.2753 12.3531 12.8553 13.0182 13.5101 13.5953C12.5283 13.7711 11.5665 14.0596 10.6352 14.4276C10.7999 14.1143 10.9551 13.7948 11.0999 13.4716Z" fill="rgba(234,66,46,1)"></path></svg>PDF',
                    titleAttr: "Exportar a PDF",
                    title: "Sanatorio Modelo",                    
                    className: "btn-red",
                    customize: function(doc) {
                      doc.content.splice(1, 0, {
                              text: "Auditoria",
                              style: "subtitulo"
                          });
                    }
                }
            ]        
        });
    });
   
  </script>
  <script src="funciones.js"></script>
</html>

<?php ?>