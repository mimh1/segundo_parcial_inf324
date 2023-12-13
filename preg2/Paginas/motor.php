<?php
session_start();
$ci = $_SESSION["ci"];
$nombre = $_SESSION["nombre"];
$rol = $_SESSION["rol"];

if($rol=="usuario"){
	$sql = "SELECT id_seguimiento, ci_alumno, fecha_creacion, flujo, proceso FROM seguimiento WHERE ci_alumno='$ci'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) == 0) {
		echo "No hay datos";
		$sql1 = "INSERT INTO seguimiento(ci_alumno,flujo,proceso) VALUES ('$ci','F1','P1');";
		$conn->execute_query($sql1);
		header("Location: pagina.php?flujo=F1&proceso=P1?pantalla=notas");
	} else {
		$proceso = "";
		while ($fila = mysqli_fetch_row($result)) {
			$proceso = $fila[4];
		}
		$sql2 = "SELECT flujo, proceso, proceso_siguiente, descripcion, rol, pantalla FROM workflow WHERE proceso='$proceso';";
		$result2 = mysqli_query($conn, $sql2);
		if ($filaf = mysqli_fetch_row($result2)) {
			$flujo = $filaf[0];
			$proceso = $filaf[1];
			$pantalla = $filaf[5];
			include("./" . $pantalla . ".vista.inc.php");
		} else {
			include("./conclucion.inc.php");
		}
	}

}elseif($rol== "kardex"){
	$pantalla=$_GET["pantalla"];
	$ci_usuario=$_GET["ci"];
	if($pantalla) {
		include("./" . $pantalla . ".vista.inc.php");
	}else{
		include("./usuarios.inc.php");

	}
}

?>