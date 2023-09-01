<?php
require_once "../../conSanatorio.php";
require_once "../../conServicios.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idUsuario = $_POST['idUsuario'];
    $contraseñaActualIngresada = $_POST['actual'];
    $contraseñaNueva = $_POST['nueva'];
    $repetirContraseña = $_POST['repetir'];

    // Verificar si algún campo está vacío
    if (empty($idUsuario) || empty($contraseñaActualIngresada) || empty($contraseñaNueva) || empty($repetirContraseña)) {
        echo json_encode(array('success' => false, 'message' => 'Por favor, complete todos los campos.'));
        exit;
    }

    // Realizar la consulta preparada para obtener la contraseña actual de la base de datos

    $query = mysqli_prepare($conServicios, "SELECT contra FROM usuario WHERE usuario = ?");
    mysqli_stmt_bind_param($query, "s", $idUsuario);
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $contraseñaActualEnBaseDeDatos);
    mysqli_stmt_fetch($query);
    mysqli_stmt_close($query);

// La contraseña actual ingresada por el usuario (supongamos que está en $contraseñaActualIngresada)
$contraseñaActualIngresadaMD5 = md5($contraseñaActualIngresada);

// Verificar si la contraseña actual ingresada (en MD5) coincide con la de la base de datos
if ($contraseñaActualIngresadaMD5 === $contraseñaActualEnBaseDeDatos) {
 

        // Verificar si la nueva contraseña y la repetición coinciden
        if ($contraseñaNueva === $repetirContraseña) {            

            $pass = md5(mysqli_real_escape_string($conServicios, $contraseñaNueva));

            $sql = "UPDATE usuario SET contra = '$pass' WHERE usuario = '$idUsuario'";

            $resultados = mysqli_query($conServicios, $sql);

            if (!$resultados) {
                echo json_encode(array('success' => false, 'message' => 'Error al modificar su contraseña.'));
            } else {
                echo json_encode(array('success' => true, 'message' => 'Contraseña modificada con éxito.'));
            }

        } else {
            echo json_encode(array('success' => false, 'message' => 'La nueva contraseña y la repetición no coinciden.'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'La contraseña actual es incorrecta.'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Petición no válida.'));
}
?>
