<?php
    // Conexión a la base de datos (ajusta los valores según tu configuración)
    require_once "../../conSanatorio.php";    
    require_once "../../conServicios.php";

    // Obtener los datos enviados por AJAX
    $nIngreso = $_POST['NIngreso'];
    $nois = $_POST['NOIS'];
    $fechaIngreso = $_POST['FechaIngreso'];
    $nDni = $_POST['NDni'];
    $nombreApellido = $_POST['NombreApellido'];
    $nAfiliado = $_POST['NAfiliado'];
    $habitacion = $_POST['Habitacion'];
    $Usuario = $_POST['Usuario'];    
    $fechaHoraActual = date('Y-m-d H:i:s');

    $sql = "INSERT INTO informes (NIngreso, NDni, NOIS, NombreApellido, NAfiliado, Habitacion, Estado, FIngreso, Fecha, Usuario, Internado)
    VALUES ($nIngreso, $nDni, $nois, '$nombreApellido', '$nAfiliado', $habitacion, 0, '$fechaIngreso', '$fechaHoraActual','$Usuario', 1)";

    if ($conServicios->query($sql) === TRUE) {
        echo "Datos del paciente guardados correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conServicios->error;
    }


?>
