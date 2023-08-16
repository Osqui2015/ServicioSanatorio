<?php 
	
	$host = '192.168.1.2';
	$user = 'sanatorio';
	$password = '123';
	$db = 'contaduria';



	$conContaduria = @mysqli_connect($host,$user,$password,$db);

	if(!$conContaduria){
		echo "Error en la conexión Sanatorio";
	}else{
       // echo "conexión ok";
    }

?>