<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nIngreso = $_POST['nIngreso'];
    $fechaCarga = $_POST['fechaCarga'];
    $randomChar = rand(0, 10000);
    $fechaCarga = $fechaCarga.'-'.$randomChar;

    $currentDate = $fechaCarga; // Obtener la fecha actual en formato YYYY-MM-DD

    foreach ($_FILES as $fileInputName => $file) {
        $targetSubfolder = '';

        switch ($fileInputName) {
            case 'Evolucion':
                $targetSubfolder = 'Guardia';
                break;
            case 'Quirurgico':
            case 'Anestesico':
                $targetSubfolder = 'Cirugia';
                break;
            case 'Piso':
            case 'UTI':
            case 'UCO':
            case 'NEO':
                $targetSubfolder = 'Internacion';
                break;
            case 'HEnfermeria':
                $targetSubfolder = 'Enfermeria';
                break;
            case 'Procedimientos':
                $targetSubfolder = 'Indicaciones';
                break;
            case 'Laboratorio':
            case 'Ecografia':
            case 'Radiologia':
            case 'Tomografia':
            case 'Otros':
                $targetSubfolder = 'ApoyoDiagnostico';
                break;
            case 'Kinesiologia':
            case 'Fonoaudiologia':
            case 'Hemoterapia':
            case 'OtrosDos':
                $targetSubfolder = 'ApoyoTerapeutico';
                break;
        }

        if (!empty($targetSubfolder)) {
            $originalFileName = pathinfo($file['name'], PATHINFO_FILENAME);
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $newFileName = $currentDate . '.' . $fileExtension;
        
            // Ruta de la carpeta principal basada en el número de ingreso
            $targetFolder = '../../../uploads/' . $nIngreso . '/';
        
            // Crear la carpeta principal si no existe
            if (!is_dir($targetFolder)) {
                mkdir($targetFolder, 0777, true);
            }
        
            // Ruta de la subcarpeta basada en $targetSubfolder
            $targetFolderSub = $targetFolder . $targetSubfolder . '/';
        
            // Crear la subcarpeta si no existe
            if (!is_dir($targetFolderSub)) {
                mkdir($targetFolderSub, 0777, true);
            }

            $targetFolderSubSub = $targetFolderSub . $fileInputName . '/';

            // Crear la subcarpeta si no existe
            if (!is_dir($targetFolderSubSub)) {
                mkdir($targetFolderSubSub, 0777, true);
            }
        
            // Ruta completa del archivo de destino
            $targetFile = $targetFolderSubSub . $newFileName;
        
            // Mover el archivo a la carpeta de destino
            move_uploaded_file($file['tmp_name'], $targetFile);
        }
        
        
    }

    echo 'Archivos cargados exitosamente.';
}
?>
