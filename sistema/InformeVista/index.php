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

    $sql = "SELECT * FROM informes";


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
  </head>
  <body >
    <?php require_once 'menu.php'?>


    <div class="container table-responsive-sm">
      <div class="card">
        <div class="card-body">    
          <table class="table table-striped table-hover table-bordered table-sm" id="TInformes">
            <thead>
              <tr>
                <th scope="col">DNI</th>
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
      </div>
    </div> 





    <footer>
        <img src="../img/imgtres.png" alt="Pie de página">
        <!-- Otros elementos de tu pie de página -->
    </footer>

  </body>
  <script>
    $(document).ready(function() {
        $("#TInformes").DataTable({
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
                            extend: "pdfHtml5",
                            text: "Exportar a PDF",
                            titleAttr: "Exportar a PDF",
                            title: "Título del documento",                    
                        }
            ]                        
        });

    });       
  </script>
  <script src="funciones.js"></script>
</html>

<?php ?>