<?php
/*session_start();
// echo $_SESSION['tipo'];


$userr = $_SESSION['usuario']; VALOR USUARIO

if (!isset($_SESSION['active'])) {
  echo "<script>
    alert ('Debe iniciar sesión para acceder a esta página');
    window.location = '../../login.php';
    </script>";
}*/
require_once "conServicios.php";

mysqli_set_charset($conServicios, "utf8");
 
$Consultasql = "SELECT tm.*,
                  us.NombreApe 

                  FROM tabla_metricas AS tm

                  LEFT JOIN usuario AS us
                  ON tm.Legajo = us.usuario";

$metricas = mysqli_query($conServicios, $Consultasql);

?>


<!DOCTYPE html>
<html>
<head>
  <title>Gráfico de Barras</title>
  <?php require_once "../dependencias.php" ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
            <table id="Tdoc" class="table compact table-striped">
              <thead>
                <tr>
                  <th scope="col"> Legajo </th>
                  <th scope="col"> Fecha de Carga </th>
                  <th scope="col"> Nombre </th>
                  <th scope="col"> Fecha </th>
                  <th scope="col"> N° Caso </th>
                  <th scope="col"> Puntaje </th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php while ($fila = $metricas->fetch_assoc()) { ?>
                  <tr>
                    <td> <?php echo $fila['Legajo'] ?> </td>
                    <td> <?php echo $fila['Fecha_Carga'] ?> </td>
                    <td> <p class="fw-medium"> <?php echo $fila['NombreApe'] ?> </p> </td>
                    <td> <?php echo $fila['Fecha'] ?> </td>
                    <td> <?php echo $fila['Num_Caso'] ?> </td>
                    <td> <?php echo $fila['Puntaje'] ?> </td>
                    <td> <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#infoMetricas" onclick="idMetrica(<?php echo $fila['Num_Caso'] ?>)"> Ver </button> </td>
                    <td> <button type="button" class="btn btn-warning btn-sm"> Editar </button> </td>
                    <td> <button type="button" class="btn btn-danger btn-sm" onclick="borrarId(<?php echo $fila['Num_Caso'] ?>)" > Borrar </button> </td>
                  </tr>
                <?php }  ?>
              </tbody>
            </table>

  <canvas id="myChart"></canvas>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
    var data = {};
    $("#Tdoc tbody tr").each(function() {
        var legajo = $(this).find("td:nth-child(1)").text();
        var nombre = $(this).find("td:nth-child(3)").text();
        var puntaje = parseFloat($(this).find("td:nth-child(6)").text());

        if (!data[legajo]) {
        data[legajo] = {
            total: puntaje,
            count: 1,
            nombre: nombre
        };
        } else {
        data[legajo].total += puntaje;
        data[legajo].count++;
        }
    });

    var labels = [];
    var averages = [];
    for (var legajo in data) {
        var average = data[legajo].total / data[legajo].count;
        var label = legajo + " - " + data[legajo].nombre;
        labels.push(label);
        averages.push(average.toFixed(2));
    }

    var ctx = document.getElementById("myChart").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "bar",
        data: {
        labels: labels,
        datasets: [
            {
            label: "Promedio de Puntajes",
            data: averages,
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            borderColor: "rgba(75, 192, 192, 1)",
            borderWidth: 1
            }
        ]
        },
        options: {
        responsive: true,
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
    });

  </script>
</body>
</html>
