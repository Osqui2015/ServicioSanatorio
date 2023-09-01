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

    $fechaC = date('Y-m-d', strtotime($row['FIngreso']));

    $carpeta = '../../uploads/'.$row['NIngreso'];  
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultas</title>

    <?php require_once '../dependencias.php' ?>
    <style>
        .db .row {
          margin-bottom: -8px !important; /* Ajusta el valor según tus preferencias */
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
          margin-bottom: -5px !important; /* Ajusta el valor según tus preferencias */
        }
        .ck .row {
          margin-bottom: -15px !important; /* Ajusta el valor según tus preferencias */
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
  <body onload="carpeta()">
    <?php require_once '../menu.php'?>

    <input  disabled readonly type="number" name="nID" id="nID" value="<?php echo $row['Id'] ?>" hidden>

    <input  disabled readonly type="number" name="valorParametro" id="valorParametro" value="<?php echo $valorParametro?>" hidden>
    <br>
        <div class="container">
          <div class="card db">
            <div class="card-body border border-black ck">
              <?php
                  $fields = array(
                    'NIngreso' => 'N de Ingreso',
                    'NOIS' => 'OIS',
                    'FechaIngreso' => 'Fecha de Ingreso',
                    'NDni' => 'DNI',
                    'NombreApellido' => 'Nombre y Apellido',
                    'NAfiliado' => 'N° de Afiliado',
                    'Descripcion' => 'Sector'
                  );

                  foreach ($fields as $field => $label) {
                    echo '<div class="row">';
                    echo '<label class="col-sm-2 col-form-label fst-italic fw-semibold" >' . $label . '</label>';
                    echo '<div class="col-sm-10">';
                    echo '<input type="text" readonly class="form-control-plaintext" value="' . ($field === 'FechaIngreso' ? $fechaC : $row[$field]) . '">';
                    echo '</div>';
                    echo '</div>';
                  }
              ?>
            </div>
          </div>
        </div>

        <div class="container">
            <button class="fixed-button btn btn-dark" data-bs-toggle="modal" data-bs-target="#verComentarios" onclick="verComentario()"> Comentarios</button>
        </div>


      <div class="container text-center">

        <fieldset hidden>
          <legend class="fs-2 text-white fw-semibold">Información de Ingreso</legend>
          <div class="row align-items-center">
            <div class="col-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="nIngreso">N de Ingreso</label>
                <input  disabled readonly type="number" id="nIngreso" class="form-control" aria-describedby="basic-addon1" value="<?php echo $row['NIngreso'] ?>"  required>
              </div>
            </div>
            <div class="col-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="nOIS">OIS</label>
                <input  disabled readonly type="number" id="nOIS" class="form-control" aria-describedby="basic-addon1" value="<?php echo $row['NOIS'] ?>"  required>
              </div>
            </div>
            <div class="col-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="fechaIngreso">Fecha de Ingreso</label>
                <input  disabled readonly type="date" id="fechaIngreso" class="form-control" aria-describedby="basic-addon1" value="<?php echo $fechaC ?>"  required>
              </div>
            </div>
          </div>
        </fieldset>        


        <input type="text" name="" id="carpeta" value="<?php echo $carpeta ?>" hidden>

        <fieldset>
            <p class="d-inline-flex gap-1">
              <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#verArchivos" aria-expanded="false" aria-controls="verArchivos">
                Ver Archivos
              </button>
            </p>
            <div class="collapse" id="verArchivos">
              <div class="card card-body text-start">
               

                
                  <div class="row">
                    <div class="col-sm-3  mb-sm-0">
                      <div id="file-tree">
                        <!-- Aquí se cargará el árbol de archivos -->
                      </div>
                    </div>
                    <div class="col-sm-8">
                      <div id="pdf-viewer">            
                        <iframe id="pdf-iframe" style="width: 110%; height: 700px;"></iframe>
                          <!-- Cambia 'height' a la altura deseada, por ejemplo, '800px' -->
                      </div>
                    </div>
                  </div>
                



              </div>
            </div>          
        </fieldset>

        <fieldset>
          <br>
          <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                  <div class="col-md-4">                    
                      <div class="input-group mb-3">
                        <span class="border-bottom border-danger p-2 mb-2 border-5">    
                          <label class="input-group-text" for="fechaCarga">Fecha de Carga</label>
                        </span>
                        <span class="border-bottom border-danger p-2 mb-2 border-5">    
                          <input type="date" id="fechaCarga" class="form-control" aria-describedby="basic-addon1" required>
                        </span>
                      </div>                    
                  </div>
                </div>
            <br>                
              <form enctype="multipart/form-data">
                <!-- Guardia -->
                  <div>
                    <div class="row justify-content-start">
                      <div class="col-2">
                        <p class="font-monospace fw-semibold">Guardia</p>
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Evolucion</p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Evolucion" type="file" accept=".pdf">
                      </div>
                    </div>              
                  </div>
                  <br>
                <!-- Cirugia -->
                  <div>
                    <div class="row justify-content-start">
                      <div class="col-2">
                        <p class="font-monospace fw-semibold">Cirugia</p>
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Protocolo Quirurgico</p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Quirurgico" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Protocolo Anestesico</p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Anestesico" type="file" accept=".pdf">
                      </div>
                    </div>                
                  </div>
                  <br>
                <!-- Internacion -->
                  <div>
                    <div class="row justify-content-start">
                      <div class="col-2">
                        <p class="font-monospace fw-semibold">Internacion</p>
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Piso</p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Piso" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">UTI</p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="UTI" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">UCO</p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="UCO" type="file" accept=".pdf">
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">NEO</p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="NEO" type="file" accept=".pdf">
                      </div>
                    </div> 
                  </div>
                  <br>
                <!-- Enfermeria -->
                  <div>
                    <div class="row justify-content-start">
                      <div class="col-2">
                        <p class="font-monospace fw-semibold">Enfermeria</p>
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Hoja Enfermeria </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="HEnfermeria" type="file" accept=".pdf">
                      </div>
                    </div>              
                  </div>
                  <br>
                <!-- Indicaciones  -->
                  <div>
                    <div class="row justify-content-start">
                      <div class="col-2">
                        <p class="font-monospace fw-semibold">Indicaciones</p>
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Procedimientos </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Procedimientos" type="file" accept=".pdf">
                      </div>
                    </div>              
                  </div>
                  <br>
                <!-- Interconsultas  Apoyo Diagnostico-->
                  <div>
                    <div class="row justify-content-start">
                      <div class="col-2">
                        <p class="font-monospace fw-semibold">Apoyo Diagnostico</p>
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Laboratorio </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Laboratorio" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Ecografia </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Ecografia" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Radiologia </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Radiologia" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Tomografia </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Tomografia" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Otros </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Otros" type="file" accept=".pdf">
                      </div>
                    </div>
                  </div>
                  <br>
                <!-- Interconsultas  Apoyo Terapeutico-->
                  <div>
                    <div class="row justify-content-start">
                      <div class="col-2">
                        <p class="font-monospace fw-semibold">Apoyo Terapeutico</p>
                      </div>    
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Kinesiologia </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Kinesiologia" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Fonoaudiologia </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Fonoaudiologia" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Hemoterapia </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="Hemoterapia" type="file" accept=".pdf">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <p class="font-monospace fw-semibold mx-4">Otros </p>
                      </div>
                      <div class="col-6">
                        <input class="form-control form-control-sm" id="OtrosDos" type="file" accept=".pdf">
                      </div>
                    </div>
                  </div>
              </form>

                <div class="row justify-content-center">
                  <div class="col-md-4">
                    <button type="button" class="btn btn-primary" onclick="CargarDatos()">Aceptar </button> 
                  </div>
                </div>
            </div>
          </div>
        </fieldset>

      </div>

      <br>
      
  </body>
  <script>
    $(document).ready(function() {
        // Obtener el valor inicial del input
        var initialValue = $('#nEstado').val();

        // Establecer el valor inicial del select según el input
        $('#estado').val(initialValue);

        // Agregar evento de cambio al input
        $('#nEstado').on('input', function() {
            var inputValue = $(this).val();

            // Actualizar el valor seleccionado del select
            $('#estado').val(inputValue);
        });

        // Agregar evento de cambio al select
        $('#estado').on('change', function() {
            var selectedValue = $(this).val();

            // Actualizar el valor del input
            $('#nEstado').val(selectedValue);
        });
    });

    $(document).ready(function () {
        const fileList = $('#file-list');

        $('.view-pdf-link').on('click', function (event) {
            event.preventDefault();
            showPDF($(this).data('url'));
        });

        function showPDF(pdfUrl) {
            const pdfViewer = $('#pdfViewer');
            pdfViewer.attr('src', pdfUrl);

            $('#pdfModal').modal('show');
        }
    });
    document.querySelectorAll('.folder-btn').forEach(folder => {
        folder.addEventListener('click', () => {
            const sublist = folder.nextElementSibling;
            sublist.style.display = sublist.style.display === 'none' ? 'block' : 'none';
        });
    });

    function carpeta (){
        console.log ('entre')
        var nIngreso = $("#carpeta").val();
        console.log(nIngreso)
        console.log (nIngreso)
        // Cargar el árbol de archivos al cargar la página
        loadFileTree(nIngreso);

        // Función para cargar el árbol de archivos
        function loadFileTree(folder) {
            $.ajax({
                url: 'get_tree.php',
                type: 'POST',
                data: { folder: folder },
                success: function(data) {
                    $('#file-tree').html(data);
                }
            });
        }
        // Manejar clics en botones de carpeta para expandir/contraer
        $(document).on('click', 'li.folder > span', function() {
            $(this).parent().toggleClass('open');
            $(this).siblings('ul').slideToggle();
        });

        // Manejar clics en archivos PDF
        $(document).on('click', 'li.file.pdf > a', function(e) {
            e.preventDefault();
            var filePath = $(this).attr('href');
            showPDF(filePath);
        });

        function showPDF(filePath) {
            $('#pdf-iframe').attr('src', filePath);
            $('#pdf-viewer').css('display', 'block');
        }

        // Cerrar el visor de PDF
        $(document).on('click', '#close-pdf', function() {
            $('#pdf-viewer').css('display', 'none');
        });    
    }

    function delteFile(x){
      var respuesta = confirm("¿Estás seguro de Eliminar?");
          if (respuesta) {
              var parametros = {                  
                  nId: x,
                  mDelete: 1
              };
              $.ajax({
                  type: "POST",
                  url: "/servicios/sistema/Informes/Cargas/pro/mdatos.php",
                  data: parametros,
                  success: function(response) {
                      alert(response); // Muestra la respuesta del servidor                     
                  }
              });
          } else {
              alert("Presionaste No");
          }
    }
  </script>
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
              <button class="btn btn-outline-success" type="button" id="btnComentario" onclick="addComentarios()">Guardar</button>
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


