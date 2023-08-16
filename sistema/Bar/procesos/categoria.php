<?php
require_once "conBar.php";
mysqli_set_charset($conBar, "utf8");


if (isset($_POST['TablaCategoria'])) {

    $tCategoria = mysqli_query($conBar, "SELECT * FROM categoria");
  
  
    $muestra = '<div class="table-responsive">
    <table class="display compact table table-condensed table-striped table-bordered table-hover" id="EspecialidadTabla">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Categoria</th>                
                <th scope="col">Editar</th>
                <th scope="col">Desactivar</th>
                <th scope="col">Seleccionar</th>                    
            </tr>
        </thead>
   
        
    
        <tbody>';
    while($RCategoria = $tCategoria->fetch_assoc()){
                $muestra.=
                        '<tr>
                            <td>'.$RCategoria['Id'].'</td>
                            <td>'.$RCategoria['Nombre'].'</td>
                            <td>
                                <button type="button" class="btn btn-warning" onclick="EditCategoria('.$RCategoria['Id'].')">Editar</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="DeleteCategoria('.$RCategoria['Id'].')">Desactivar</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" onclick="SelectCategoria('.$RCategoria['Id'].')">Seleccionar</button>
                            </td>
                        </tr>';
            } 

    $muestra .= '</tbody>
        </table>
      </div>
      <script src="./funciones/categoria.js"></script>';
    echo $muestra;
}

if (isset($_POST['CargarCategoria'])){
    $nom = $_POST['nom'];

    $sql = "INSERT INTO categoria (Nombre, Estado) value ('$nom', 1);";

    $resultadoUno = mysqli_query($conBar, $sql);
    if (!$resultadoUno) {
      echo "Error en la inserción Guardar: " . $conBar->error;
      $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores, JSON_THROW_ON_ERROR);
    echo $valores;
}