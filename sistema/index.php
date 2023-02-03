<?php
    session_start();
    if ($_SESSION['Sector'] == 1){ 
        header('location: AdmCall');
    }else if($_SESSION['Sector'] == 2){
        header('location: AdmHotel');
    }else if($_SESSION['Sector'] == 3){
        header('location: CallCenter');
    }else if($_SESSION['Sector'] == 4){
        header('location: Internacion');
    }else if($_SESSION['Sector'] == 5){
        header('location: Secretaria');
    }else if($_SESSION['Sector'] == 6){
        header('location: Mucamas');
    }else if($_SESSION['Sector'] == 7){
        header('location: Camilleros');
    }else if($_SESSION['Sector'] == 8){
        header('location: Enfermeria');
    }else if($_SESSION['Sector'] == 9){
        header('location: mantenimiento');
    }else if($_SESSION['Sector'] == 10){
        header('location: Admin');
    }else{
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