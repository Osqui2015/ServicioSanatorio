<?php
include '../../../../conServicios.php';


if (isset($_POST['addC'])) {

    $cComentario = $_POST['cComentario'];
    $nIngreso = $_POST['nIngreso'];
    $Usuario = $_POST['Usuario'];
    $Fecha = date('Y-m-d');
    

    $sql = "INSERT INTO tcomentario (nIngreso, aComentario, Fecha, Usuario)
    VALUES ($nIngreso, '$cComentario', '$Fecha', '$Usuario')";

    if ($conServicios->query($sql) === TRUE) {
        echo "Datos insertados correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conServicios->error;
    }

}

if (isset($_POST['verC'])) {

    $nIngreso = $_POST['nIngreso'];
    $salida = ' ';

    $sql = "SELECT * FROM tcomentario WHERE nIngreso = $nIngreso ORDER BY id DESC";

    $tComentarios = mysqli_query($conServicios,$sql);

    while ($fila = $tComentarios->fetch_assoc()) {

        $salida .= '
            <div class="input-group">
              <span class="input-group-text">' . $fila['Usuario'] . '</span>              
              <textarea class="form-control fst-italic fs-5" aria-label="With textarea" disabled readonly>' . $fila['aComentario'] . '</textarea>
              <span class="input-group-text fw-light" id="basic-addon2">' . $fila['Fecha'] . '</span>
            </div>
            <br>        
        ';
    }

    echo $salida;
    
}