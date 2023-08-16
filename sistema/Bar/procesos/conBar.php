<?php 
	
	$host = '192.168.1.4';
	$user = 'sanatorio';
	$password = '123';
	$db = 'bar';



	$conBar = @mysqli_connect($host,$user,$password,$db);

	if(!$conBar){
		echo "Error en la conexión Sanatorio";
	}else{
       // echo "conexión ok";
    }

?>