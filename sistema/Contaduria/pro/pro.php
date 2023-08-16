<?php
    require "../conSanatorio.php";
    require "../conContaduria.php";
    require "../conSql.php";
    mysqli_set_charset($conSanatorio, "utf8");

if (isset($_POST['BFactMed'])){
    $fechaI = $_POST['fechaI'];
    $fechaF = $_POST['fechaF'];
    $matriDoc = $_POST['matriDoc'];


    $consulta = '';

    $resultado = mysqli_query($conServicios, $sql);

}