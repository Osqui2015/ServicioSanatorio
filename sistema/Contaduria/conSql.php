<?php
    $serverName = '192.168.1.195,1433';
    $connectionOptions = array(
        "Database" => 'SBDAMODS',
        "Uid" => 'sa',
        "PWD" => '@Bejerman'
    );

    $conSQL = sqlsrv_connect($serverName, $connectionOptions);

    if ($conSQL === false) {
        echo "Error en la conexión Modelo conSQL";
    } else {
        //echo "Conexión exitosa";
    }
?>
