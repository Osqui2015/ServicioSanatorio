<?php
require_once "../../conServicios.php";
require_once "../../conForm.php";

if (isset($_POST['Tpuesto'])) {
  $x = $_POST["Puesto"];

  $card = 'SELECT * FROM postulantes ';

  if ($x != 0) {
    $card .= "WHERE puesto = '$x'";
  }

  $sql = mysqli_query($conForm, "$card");

  $salida = '<table id="TPostulantes" class="table compact table-striped">
                    <thead>
                        <tr>
                            <th scope="col">DNI</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Puesto</th>
                            <th scope="col">Info</th>
                            <th scope="col">CV</th>               
                        </tr>
                    </thead>
                    <tbody>';
  while ($fila = $sql->fetch_assoc()) {
    $salida .= '<tr>
              <td>' . $fila['dni'] . '</td>
              <td>' . utf8_encode($fila['apellido']) . '</td>
              <td>' . utf8_encode($fila['nombre']) . '</td>
              <td>' . $fila['fecha_nacimiento'] . '</td>
              <td></td>
              <td>
                <a href="/cv/Documentos/curriculum/' . utf8_encode($fila['cv']) . '" download>
                  <button type="button" class="btn btn-info">Info</button>
                </a>
              </td>
              <td>
                <button type="button" class="btn btn-info">CV</button>
              </td>
            </tr>';

  }
  $salida .= '</tbody>
              </table> 
              <script src="/servicios/sistema/RRHH/funciones.js"></script>';
  echo $salida;
}
