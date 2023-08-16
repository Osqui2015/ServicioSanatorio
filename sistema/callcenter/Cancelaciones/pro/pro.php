<?php
    require "../../conServicios.php";
    mysqli_set_charset($conServicios, "utf8");

if (isset($_POST['cancelarG'])) {

    $nombreDoctor = $_POST["nombreDoctor"];
    $tipoCancelacion = $_POST["tipoCancelacion"];
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFin = $_POST["fechaFin"] . ' 23:59:00';
    $observacion = $_POST["observacion"];
    $UsuarioSistema = $_POST["UsuarioSistema"];
    $fecha_actual = date('Y-m-d');

    $sql = "INSERT INTO cancelacionmedico (Matricula, Fecha, Obs, fechaInicio, fechaFin, tipoCancelacion,Usuario)
    VALUES ('$nombreDoctor', '$fecha_actual','$observacion', '$fechaInicio', '$fechaFin', '$tipoCancelacion', '$UsuarioSistema')";

    if ($conServicios->query($sql) === true) {
    echo "Record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conServicios->error;
    }

    $conServicios->close();
}