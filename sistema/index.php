<?php
session_start();
if ($_SESSION['Sector'] == 1) {
    header('location: AdmCall/index.php');
} else if ($_SESSION['Sector'] == 2) {
    header('location: AdmHotel/index.php');
} else if ($_SESSION['Sector'] == 3) {
    header('location: CallCenter/index.php');
} else if ($_SESSION['Sector'] == 4) {
    header('location: Internacion/index.php');
} else if ($_SESSION['Sector'] == 5) {
    header('location: Secretaria/index.php');
} else if ($_SESSION['Sector'] == 6) {
    header('location: Mucamas/index.php');
} else if ($_SESSION['Sector'] == 7) {
    header('location: Camilleros/index.php');
} else if ($_SESSION['Sector'] == 8) {
    header('location: Enfermeria/index.php');
} else if ($_SESSION['Sector'] == 9) {
    header('location: mantenimiento/index.php');
} else if ($_SESSION['Sector'] == 10) {
    header('location: Admin/index.php');
} else if ($_SESSION['Sector'] == 11) {
    header('location: Cocina/index.php');
} else if ($_SESSION['Sector'] == 12) {
    header('location: RRHH/index.php');
} else if ($_SESSION['Sector'] == 13) {
    header('location: Bar/index.php'); 
} else if ($_SESSION['Sector'] == 14) {
    header('location: Contaduria/index.php');
} else if ($_SESSION['Sector'] == 15) {
    header('location: Informes/index.php');
} else if ($_SESSION['Sector'] == 16) {
    header('location: InformeVista/index.php');
} else {
    header('location: ../');
}
?>


// 1 Administrador CallCenter
// 2 Administrador Hoteleria
// 3 Conctact Center
// 4 Internacion
// 5 Secretaria
// 6 Mucamas
// 7 Camilleros
// 8 Administrador Secretaria
// 9 Mantenimiento
// 10 Admin
// 11 Cocina
// 12 RRHH
// 13 BAR
// 14 Contaduria