<?php
   	
require_once "../../conServicios.php";

$events = array();
$query = "SELECT pr.NomApe AS Nombre,
cn.fechaInicio,
cn.fechaFin,
CONCAT(pr.NomApe,' ',cn.tipoCancelacion,' ', cn.obs) AS titulo,
cn.fecha AS cargado
FROM cancelacionmedico AS cn 
INNER JOIN profesional AS pr
ON pr.Matricula = cn.Matricula

WHERE cn.fechaInicio IS NOT NULL";
$result = mysqli_query($conServicios, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $start = $row['fechaInicio'];
    $end = $row['fechaFin'];
    $titulo = $row['titulo'];    
    $event = array(
        'title' => $titulo,
        'start' => $start,
        'end' => $end
    );
    $events[] = $event;
}
echo json_encode($events);

mysqli_close($conServicios);
