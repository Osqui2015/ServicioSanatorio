<?php
include '../../../../conServicios.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nIngreso = $_POST["nIngreso"];
    $nOIS = $_POST["nOIS"];
    $fechaIngreso = $_POST["fechaIngreso"];
    $dni = $_POST["dni"];
    $nombreApellido = $_POST["nombreApellido"];
    $numAfiliado = $_POST["numAfiliado"];
    $habitacion = $_POST["habitacion"];
    $estado = $_POST["estado"];
    $Usuario = $_POST["Usuario"];
    $fechaHoraActual = date('Y-m-d H:i:s');


    $sql = "INSERT INTO informes (NIngreso, NDni, NOIS, NombreApellido, NAfiliado, Habitacion, Estado, FIngreso, Fecha, Usuario)
            VALUES ($nIngreso, $dni, $nOIS, '$nombreApellido', $numAfiliado, $habitacion, $estado, '$fechaIngreso', '$fechaHoraActual','$Usuario')";

    if ($conServicios->query($sql) === TRUE) {
        echo "Datos insertados correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conServicios->error;
    }
}

$conServicios->close();
?>
