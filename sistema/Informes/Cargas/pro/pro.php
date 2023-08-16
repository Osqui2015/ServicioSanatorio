<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nIngreso = $_POST['nIngreso'];

    $fechaC = date('d-m-Y', strtotime($_POST['fechaC']));

    echo $fechaC;
   

    foreach ($_FILES as $fieldName => $fileData) {


        



        $fileExtension = pathinfo($fileData['name'], PATHINFO_EXTENSION);
        $uniqueFileName = $fieldName . '.' . $fileExtension;

        $uploadDir = '../../../uploads/' . $nIngreso . '/' . $fieldName . '/' . $fechaC . '/' ;
    
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }



        $uploadFile = $uploadDir . $uniqueFileName;
        
        if (move_uploaded_file($fileData['tmp_name'], $uploadFile)) {
            echo 'Archivo ' . $fileData['name'] . ' subido con éxito.<br>';
        } else {
            echo 'Error al subir el archivo ' . $fileData['name'] . '.<br>';
        }
    }
} else {
    echo 'Método no permitido.';
}
?> 

