<?php
	$servername="localhost";
	$database="segparcial";
	$username="inf324";
	$password="123456";
	//Creando conexion
	$conn=mysqli_connect($servername,$username,$password,$database);
	//verificar Conexion
	if(!$conn){
		die("Conexion fallida: ".mysqli_connect_error());
	}
	echo "<div class='bg-success' style='width:15px;height:15px;background:green;'></div>";
?>