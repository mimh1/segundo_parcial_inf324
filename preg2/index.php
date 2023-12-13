<!DOCTYPE html>

<html lang="es" data-bs-theme="dark">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<title>Respuesta Pregunta 1</title>
</head>
<body>
	<?php
		include("./conexion.php");
	?>
	<h1 class="fw-bold">Iniciar Sesion</h1>
	<form action='IniciarSesion.php' method="GET">
		Ci<input type="text" name="ci" value=""/>
		<br/>
		Clave<input type="text" name="clave" value=""/>
		<br/>
		<input type="submit" name="Aceptar" value="Aceptar"/>
	</form>
	<script src="./js/bootstrap.min.js"></script>
</body>
</html>