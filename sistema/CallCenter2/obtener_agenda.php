<?php

require_once "../../conServicios.php";

$id_doctor = $_POST["doctorId"];

$events = array();
$query = "SELECT * FROM cancelacionmedico where Matricula = $id_doctor";
$result = mysqli_query($conServicios, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $start = $row['fechaInicio'];
    $end = $row['fechaFin'];
    $event = array(
        'title' => $row['tipoCancelacion'],
        'start' => $start,
        'end' => $end
    );
    $events[] = $event;
}
echo json_encode($events);

mysqli_close($conServicios);
