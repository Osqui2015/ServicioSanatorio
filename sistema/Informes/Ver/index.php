<?php
    session_start();
    //echo $_SESSION['tipo'];
    if(!empty($_SESSION['active'])){
        
    }else{
        header('location: ../../index.php');
    }
    $userr = $_SESSION['usuario']; /*VALOR USUARIO*/

    require_once "../../../conSanatorio.php";    

    

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

        $documentosPath = '../../uploads/';
        displayFiles($documentosPath);
        ?>
    </ul>
</div>






</body>
<script>

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