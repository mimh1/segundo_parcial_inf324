<?php
	include("./conexion.php");
	$ci=$_GET["ci"];
	$password=$_GET["clave"];

	echo"".$ci."".$password."";

	$sql="SELECT nombre, rol, password FROM usuario WHERE ci=?;";

	$stmt = $conn->prepare($sql);

	echo "<br>";

	if($stmt===false){
		echo "no llegue";
		die("Error en la preparación de la consulta: " . $conn->error);
	}else{
		echo "llegue";
	}

	echo "<br>";

	$stmt->bind_param("s", $ci);
	//$stmt->bind_param("s", $password);
	echo "llegue2";

	if($stmt->execute()===false){
		die("Error en la ejecución de la consulta: " . $stmt->error);
	}

	$stmt->bind_result($resultNombre,$resultRol,$resultPassword);

	if( $stmt->fetch() ){
		if($resultPassword==$password){
			session_start();
			$_SESSION["nombre"]=$resultNombre;
			$_SESSION["rol"]=$resultRol;
			$_SESSION["ci"]=$ci;
			header("location: Paginas/pagina.php?proceso=P1");
			echo "Datos correctos";
			echo "".$resultNombre."".$resultRol."";

		}else{
			echo "Password Incorrecto";
		}
	}else{
		echo "sin resultados";
	}

	$stmt->close();
?>