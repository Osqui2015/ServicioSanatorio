<?php
require_once "conBar.php";
mysqli_set_charset($conBar, "utf8");


if (isset($_POST['TablaProductos'])) {
    $categoria = $_POST['categoria'];

    $tProductos = mysqli_query($conBar, "SELECT * FROM productos WHERE Categoria = $categoria");
    
    $muestra = '<div class="table-responsive">
    <table class="display compact table table-condensed table-striped table-bordered table-hover" id="TablaProductos">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Subtitulo</th>
                <th scope="col">Lista</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio 1</th>
                <th scope="col">Precio 2</th>
                <th scope="col">Editar</th>
                <th scope="col">Desactivar</th>
                <th scope="col">Seleccionar</th>                   
            </tr>
        </thead>
   
        
    
        <tbody>';
    while($RProductos = $tProductos->fetch_assoc()){
                $muestra.=
                        '<tr>
                            <td>'.$RProductos['Id'].'</td>
                            <td>'.$RProductos['Nombre'].'</td>
                            <td>'.$RProductos['SubTitulo'].'</td>
                            <td>'.$RProductos['Listado'].'</td>
                            <td></td>
                            <td>'.$RProductos['PrecioUno'].'</td>
                            <td></td>
                            <td>
                                <button type="button" class="btn btn-warning" onclick="EditProductos('.$RProductos['Id'].')">Editar</button>
                            </td>
                            <td>';
                $muestra .= ($RProductos['Estado'] == 0) ? '<button type="button" class="btn btn-primary" onclick="ActProductos('.$RProductos['Id'].')">Activar</button>' : '<button type="button" class="btn btn-danger" onclick="DeleteProductos('.$RProductos['Id'].')">Desactivar</button>';
                            
                            

                $muestra.=
                                '</td>
                            <td>
                                <button type="button" class="btn btn-primary" onclick="SelectProductos('.$RProductos['Id'].')">Seleccionar</button>
                            </td>
                        </tr>';
            } 

    $muestra .= '</tbody>
        </table>
      </div>
      <script src="./funciones/categoria.js"></script>';
    echo $muestra;
}

if (isset($_POST['CargarProductos'])){
    $NombreP = $_POST['NombreP'];
    $PrecioUno = $_POST['PrecioUno'];
    $categoria = $_POST['categoria'];
    $SubT = $_POST['SubT'];
    $ListT = $_POST['ListT'];

    $sql = "INSERT INTO productos (Nombre, PrecioUno, Estado, Categoria, SubTitulo, Listado) 
                    value ('$NombreP', $PrecioUno, 1, $categoria, '$SubT', '$ListT' );";                    

    $resultadoUno = mysqli_query($conBar, $sql);
    if (!$resultadoUno) {
      echo "Error en la inserción Guardar: " . $conBar->error;
      $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores, JSON_THROW_ON_ERROR);
    echo $valores;
}

if (isset($_POST['Desactivar'])){
    $x = $_POST['x'];
    $valores['existe'] = "1";
    $sql = "UPDATE productos SET Estado = 0 WHERE Id = $x";

    $resultadoUno = mysqli_query($conBar, $sql);
    if (!$resultadoUno) {
      echo "Error en la inserción Guardar: " . $conBar->error;
      $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores, JSON_THROW_ON_ERROR);
    echo $valores;
}

if (isset($_POST['Activar'])){
    $x = $_POST['x'];
    $valores['existe'] = "1";
    $sql = "UPDATE productos SET Estado = 1 WHERE Id = $x";

    $resultadoUno = mysqli_query($conBar, $sql);
    if (!$resultadoUno) {
      echo "Error en la inserción Guardar: " . $conBar->error;
      $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores, JSON_THROW_ON_ERROR);
    echo $valores;
}

if (isset($_POST['EditarP'])){
    $x = $_POST['x'];
    $valores['existe'] = "1";

    $sql = "SELECT * FROM productos WHERE Id = $x";
    $resultadoUno = mysqli_query($conBar, $sql);

    while($RProductos = $resultadoUno->fetch_assoc()){
        $valores['Id'] = $RProductos['Id'];
        $valores['Nombre'] = $RProductos['Nombre'];
        $valores['PrecioUno'] = $RProductos['PrecioUno'];
        $valores['SubTitulo'] = $RProductos['SubTitulo'];
        $valores['Listado'] = $RProductos['Listado'];        
    }

    if (!$resultadoUno) {
      echo "Error en la inserción Guardar: " . $conBar->error;
      $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores, JSON_THROW_ON_ERROR);
    echo $valores;
}
 

if (isset($_POST['EditCargarProductos'])){
    $NombreP = $_POST['NombreP'];
    $PrecioUno = $_POST['PrecioUno'];
    $categoria = $_POST['categoria'];
    $SubT = $_POST['SubT'];
    $ListT = $_POST['ListT'];
    $x = $_POST['idP'];

    $sql = "UPDATE productos SET Nombre = '$NombreP', PrecioUno = $PrecioUno, Estado = 1, Categoria = $categoria, SubTitulo = '$SubT', Listado = '$ListT' WHERE Id = $x";

    $resultadoUno = mysqli_query($conBar, $sql);
    if (!$resultadoUno) {
      echo "Error en la inserción Guardar: " . $conBar->error;
      $valores['existe'] = "0";
    }
    $valores = JSON_encode($valores, JSON_THROW_ON_ERROR);
    echo $valores;
}