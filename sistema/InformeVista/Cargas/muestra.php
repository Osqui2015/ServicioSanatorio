<?php
    session_start();
    //echo $_SESSION['tipo'];
    if(!empty($_SESSION['active'])){
        
    }else{
        header('location: ../../index.php');
    }
    $userr = $_SESSION['usuario']; /*VALOR USUARIO*/

    require_once "../../../conSanatorio.php";    
    require_once "../../../conServicios.php";

    // Verifica si se recibió el parámetro 'parametro' en la URL
    if (isset($_GET['parametro'])) {
        // Obtiene el valor del parámetro y lo almacena en una variable
        $valorParametro = intval($_GET['parametro']);

        // Utiliza una sentencia preparada para evitar inyección SQL
        $sql = "SELECT * 
                  FROM informes AS fr
                  LEFT JOIN sectores AS sec
                  ON fr.Habitacion = sec.id
                  WHERE fr.Id =  $valorParametro";

        $query = mysqli_query($conServicios, $sql);
        if ($query) {
            $row = mysqli_fetch_assoc($query);
            // Resto del código para procesar la fila obtenida
        } else {
            echo "Error en la consulta: " . mysqli_error($conServicios);
        }

    }

    $carpeta = '../../uploads/'.$row['NIngreso'];

    $fechaC = date('Y-m-d', strtotime($row['FIngreso']));    
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultas</title>
    <?php require_once '../dependencias.php' ?>
    
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            margin-bottom: 20px;
        }

        ul.tree {
            list-style-type: none;
            padding-left: 20px;
            border-left: 1px solid #ccc;
        }

        ul.tree li {
            margin: 0;
            padding: 0;
            line-height: 1.5em;
            position: relative;
        }

        ul.tree li.folder > span:before {
            content: "+";
            display: inline-block;
            width: 1em;
            cursor: pointer;
            margin-right: 15px;
        }

        ul.tree li.folder.open > span:before {
            content: "-";
        }

        ul.tree ul {
            display: none;
            list-style-type: none;
            padding-left: 20px;
            border-left: 1px solid #ccc;
        }

        ul.tree li.file {
            margin-left: 20px;
            padding-left: 0;
            list-style-type: none;
            position: relative;
        }

        ul.tree li.file:before {
            content: "\f15b";
            font-family: FontAwesome;
            display: inline-block;
            width: 1em;
            margin-left: -20px;
            margin-right: 5px;
            color: #888;
        } 
        .card-body .row {
    margin-bottom: -18px !important; /* Ajusta el valor según tus preferencias */
  }
        .fixed-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            z-index: 1;
        }
    </style>
  </head>
 
  <body onload="carpeta()" >
    <?php require_once '../menu.php'?>

    <input  disabled readonly type="number" name="nID" id="nID" value="<?php echo $row['Id'] ?>" hidden>
    
      <div class="">


      <input type="number" name="nIngreso" id="nIngreso" value="<?php echo $row['NIngreso']  ?>" hidden>

      <div class="card">
        <div class="card-body border border-black">
          <div class="row">
            <div class="col-md-6"> <!-- División de la primera columna -->
              <?php
                $fields = array(
                  'NIngreso' => 'N de Ingreso',
                  'NOIS' => 'OIS',
                  'FechaIngreso' => 'Fecha de Ingreso',
                  'NDni' => 'DNI'
                );

                foreach ($fields as $field => $label) {
                  echo '<div class="row">';
                  echo '<label class="col-sm-4 col-form-label fst-italic fw-semibold text-start">' . $label . '</label>';
                  echo '<div class="col-sm-6">';
                  echo '<input type="text" readonly class="form-control-plaintext" value="' . ($field === 'FechaIngreso' ? $fechaC : $row[$field]) . '">';
                  echo '</div>';
                  echo '</div>';
                }
              ?>
            </div>
            <div class="col-md-6"> <!-- División de la segunda columna -->
              <?php
                $fields = array(
                  'NombreApellido' => 'Nombre y Apellido',
                  'NAfiliado' => 'N° de Afiliado',
                  'Descripcion' => 'Sector'
                );

                foreach ($fields as $field => $label) {
                  echo '<div class="row">';
                  echo '<label class="col-sm-4 col-form-label fst-italic fw-semibold text-start">' . $label . '</label>';
                  echo '<div class="col-sm-6">';
                  echo '<input type="text" readonly class="form-control-plaintext" value="' . $row[$field] . '">';
                  echo '</div>';
                  echo '</div>';
                }
              ?>
            </div>
          </div>
          <br>
        </div>
      </div>

      <div class="container">
          <button class="fixed-button btn btn-dark" data-bs-toggle="modal" data-bs-target="#verComentarios" onclick="verComentario()">Comentarios</button>
      </div>



        <input type="text" name="" id="carpeta" value="<?php echo $carpeta ?>" hidden>


      </div>

      <br>

      
    

<div class="">
  <div class="row">
    <div class="col-sm-3  mb-sm-0">
      <div id="file-tree">
        <!-- Aquí se cargará el árbol de archivos -->
      </div>
    </div>
    <div class="col-sm-9">
      <div id="pdf-viewer">            
        <iframe id="pdf-iframe" style="width: 102%; height: 700px;"></iframe>
          <!-- Cambia 'height' a la altura deseada, por ejemplo, '800px' -->
      </div>
    </div>
  </div>
</div>

    
  </body>
  <script src="funciones/funciones.js"></script>
</html>

<?php ?> 

<!-- Modal -->
<div class="modal fade" id="verComentarios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Comentarios</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">

            <div class="input-group">
              <span class="input-group-text">Comentarios</span>
              <textarea class="form-control" aria-label="With textarea" id="cComentario"></textarea>
              <button class="btn btn-outline-secondary" type="button" id="btnComentario" onclick="addComentarios()">Guardar</button>
            </div>              
            <!-- Lista con los comentarios del usuario-->            
            <br>
            <div id="verTablaCom"></div>
            <p></p>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" hidden>Save changes</button>
      </div>
    </div>
  </div>
</div>