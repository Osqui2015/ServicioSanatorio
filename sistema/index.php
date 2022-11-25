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
    }else{
        header('location: ../');
    }
?>


// 1 AdministradorCallCenter
// 2 AdministradorHoteleria
// 3 ConctactCenter
// 4 Internacion
// 5 Secretaria
// 6 Mucamas
// 7 Camilleros