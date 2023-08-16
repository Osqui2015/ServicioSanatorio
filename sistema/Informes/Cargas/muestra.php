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
        $sql = "SELECT * FROM informes WHERE Id = $valorParametro";

        $query = mysqli_query($conServicios, $sql);
        if ($query) {
            $row = mysqli_fetch_assoc($query);
            // Resto del código para procesar la fila obtenida
        } else {
            echo "Error en la consulta: " . mysqli_error($conServicios);
        }

    }

    $fechaC = date('Y-m-d', strtotime($row['FIngreso']));    
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultas</title>

    <?php require_once '../dependencias.php' ?>
  </head>
  <body >
    <?php require_once '../menu.php'?>

    <input  disabled readonly type="number" name="nID" id="nID" value="<?php echo $row['Id'] ?>" hidden>
    
      <div class="container text-center">

        <fieldset>
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

        <fieldset>
          <legend class="fs-3 text-white fw-semibold">Información Personal</legend>
          <div class="row justify-content-start">
            <div class="col-md-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="dni">DNI</label>
                <input  disabled readonly type="number" id="dni" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $row['NDni'] ?>"  required>
              </div>            
            </div>
            <div class="col-md-8">
              <div class="input-group mb-3">
                <label class="input-group-text" for="nombreApellido">Nombre y Apellido</label>
                <input  disabled readonly type="text" id="nombreApellido" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $row['NombreApellido'] ?>"  required>
              </div>
            </div>
          </div>

          <div class="row justify-content-start">
            <div class="col-md-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="numAfiliado">N° de Afiliado</label>
                <input  disabled readonly type="number" id="numAfiliado" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $row['NAfiliado'] ?>"  required>
              </div>            
            </div>
            <div class="col-md-4">
              <div class="input-group mb-3">
                <label class="input-group-text" for="habitacion">Habitación</label>
                <input  disabled readonly type="number" id="habitacion" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?php echo $row['Habitacion'] ?>"  required>
              </div>
            </div>
            <div class="col-md-4">
              <input type="number" name="nEstado" id="nEstado" value="<?php echo $row['Estado'] ?>" hidden>
              <div class="input-group mb-3">
                <label class="input-group-text" for="estado">Estado</label>
                <select id="estado" class="form-select" aria-label="Default select example">
                  <option value="1">Activo</option>
                  <option value="2">Desactivado</option>
                </select>
              </div>
            </div>
          </div>

          <button type="button" class="btn btn-light" onclick="Gestado(<?php echo $row['Id'] ?>)">Guardar Estado</button>
        </fieldset>

        <fieldset>
          <legend class="fs-3 text-white fw-semibold">Archivos Adjuntos</legend>
          <input  disabled readonly type="number" name="n" id="n" value="<?php echo $row['Id'] ?>" hidden>
          <br>
            <div class="col-md-8">
              <div class="input-group mb-3">
                <label class="input-group-text" for="fechaIngreso">Fecha</label>
                <input type="date" id="fechaC" class="form-control" aria-describedby="basic-addon1" required>
              </div>
            </div>
            <div class="col-md-8">
              <div class="input-group mb-3">
                <label class="input-group-text" for="historiaClinica">Historia Clínica</label>
                <input  type="file" id="historiaClinica" class="form-control" accept=".pdf, .doc, .docx">
              </div>
            </div>
            <div class="col-md-8">
              <div class="input-group mb-3">
                <label class="input-group-text" for="evolucion">Evolución</label>
                <input  type="file" id="evolucion" class="form-control" accept=".pdf, .doc, .docx">
              </div>
            </div>
            <div class="col-md-8">
              <div class="input-group mb-3">
                <label class="input-group-text" for="apoyoDiagnostico">Apoyo Diagnóstico</label>
                <input  type="file" id="apoyoDiagnostico" class="form-control" accept=".pdf, .doc, .docx">
              </div>
            </div>
            <div class="col-md-8">
              <div class="input-group mb-3">
                <label class="input-group-text" for="interconsulta">Interconsulta</label>
                <input  type="file" id="interconsulta" class="form-control" accept=".pdf, .doc, .docx">
              </div>
            </div>
          
        </fieldset>

        <button type="button" class="btn btn-primary" onclick="CDatos()">Cargar Datos </button>


      </div>

      <br>

      <!-- muestra de archivos -->
    <fieldset>
        <div class="container mt-4" style="width: 38rem;">
            <ul class="list-group" id="file-list">
                <!-- Los archivos y carpetas se agregarán dinámicamente aquí -->
                <?php
                function displayFiles($basePath) {
                    $files = scandir($basePath);
                    foreach ($files as $fileName) {
                        if ($fileName !== '.' && $fileName !== '..') {
                            $filePath = $basePath . '/' . $fileName;
                            echo '<li class="list-group-item mb-3">';
                            if (is_dir($filePath)) {
                                echo '<button type="button" class="btn folder-btn">' . $fileName . '</button>';
                                echo '<ul class="list-group sublist" style="display: none;">'; // Ocultar subcarpetas inicialmente
                                displayFiles($filePath); // Mostrar contenido de subcarpetas de manera recursiva
                                echo '</ul>';
                            } else {
                                echo '<div class="d-flex justify-content-between align-items-center">';
                                echo '<span>' . $fileName . '</span>';
                                if (strtolower(pathinfo($fileName, PATHINFO_EXTENSION)) === 'pdf') {
                                    echo '<a href="#" class="btn btn-sm btn-primary view-pdf-link" data-bs-toggle="modal" data-bs-target="#pdfModal" data-url="' . $filePath . '">Ver PDF</a>';
                                }
                                echo '</div>';
                            }
                            echo '</li>';
                        }
                    }
                }

                $documentosPath = '../../uploads/'.$valorParametro.'/';
                displayFiles($documentosPath);
                ?>
            </ul>
        </div>
    </fieldset>

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
  </script>
  <script src="funciones/funciones.js"></script>
</html>

<?php ?> 


<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="pdfViewer" src="" width="100%" height="600"></iframe>
            </div>
        </div>
    </div>
</div>