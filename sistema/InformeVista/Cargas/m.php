<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizador de Archivos</title>
    <!-- Agrega tus enlaces a CSS y JavaScript aquí -->
    <link rel="stylesheet" href="styles.css">
    <?php require_once '../dependencias.php' ?>
</head>
<body>
<?php require_once '../menu.php'?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <fieldset>
                    <div class="container mt-4">
                        <ul class="list-group" id="file-list">
                            <!-- Aquí se agregará la salida generada por PHP -->
                            <?php
                            function displayFiles($basePath) {
                                $files = scandir($basePath);
                                foreach ($files as $fileName) {
                                    if ($fileName !== '.' && $fileName !== '..') {
                                        $filePath = $basePath . '/' . $fileName;
                                        echo '<li class="list-group-item mb-3">';
                                        if (is_dir($filePath)) {
                                            echo '<button type="button" class="btn folder-btn">' . $fileName . '</button>';
                                            echo '<ul class="list-group sublist" style="display: none;">';
                                            displayFiles($filePath);
                                            echo '</ul>';
                                        } else {
                                            echo '<div class="d-flex justify-content-between align-items-center">';                                            
                                            if (strtolower(pathinfo($fileName, PATHINFO_EXTENSION)) === 'pdf') {
                                                echo '<a href="#" class="view-pdf-link" data-bs-toggle="modal" data-bs-target="#pdfModal" data-url="' . $filePath . '">' . $fileName . '</a>';
                                            }
                                            echo '</div>';
                                        }
                                        echo '</li>';
                                    }
                                }
                            }

                            $valorParametro = "1"; // Cambiar esto con el valor correcto
                            $documentosPath = '../../uploads/'.$valorParametro.'/';
                            displayFiles($documentosPath);
                            ?>
                        </ul>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-8">
                <div class="pdf-container">
                    <iframe id="pdf-viewer" src="" width="100%" height="550" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>    
   
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewPdfLinks = document.querySelectorAll('.view-pdf-link');
        const pdfViewer = document.getElementById('pdf-viewer');

        viewPdfLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const pdfUrl = this.getAttribute('data-url');
                pdfViewer.setAttribute('src', pdfUrl);
            });
        });

        document.querySelectorAll('.folder-btn').forEach(folder => {
            folder.addEventListener('click', () => {
                const sublist = folder.nextElementSibling;
                sublist.style.display = sublist.style.display === 'none' ? 'block' : 'none';
            });
        });
    });
</script>


</body>
</html>
