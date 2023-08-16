<?php

$host = '192.168.1.4';
$user = 'sanatorio';
$password = '123';
$db = 'formulario';



$conForm = @mysqli_connect($host, $user, $password, $db);

if (!$conForm) {
  echo "Error en la conexión Sanatorio";
} else {
  // echo "conexión ok";
}
