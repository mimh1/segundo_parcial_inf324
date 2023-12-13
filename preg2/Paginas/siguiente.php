<?php
include("../conexion.php");
session_start();

$ci = $_SESSION["ci"];
$rol = $_SESSION["rol"];
echo "" . $ci . "";
if (isset($_POST["Siguiente"]))
{
	if ($rol == 'usuario') {
		$sql = "SELECT w.proceso_siguiente FROM seguimiento s INNER JOIN workflow w ON s.proceso=w.proceso AND s.ci_alumno='$ci' order by w.proceso desc;";
		$result = mysqli_query($conn, $sql);
		if ($fila = mysqli_fetch_row($result)) {
			$procesosiguiente = $fila[0];
			//$sql2 = "UPDATE seguimiento SET proceso='$procesosiguiente' WHERE ci_alumno='$ci'";
			$sql2 = "INSERT INTO seguimiento(ci_alumno,flujo,proceso) VALUES ('$ci','F1','$procesosiguiente')";
			$result2 = mysqli_query($conn, $sql2);
			header("location: pagina.php?proceso=".$procesosiguiente);
		}
	}
	if ($rol == "kardex") {
		if($_POST["radio-stacked"]){
			$ci_alumno= $_GET["ci_usuario"];
			$estado= $_POST["radio-stacked"];
			$sql="SELECT ".$estado." FROM workflow_quest WHERE proceso='P3'";
			$result = mysqli_query($conn, $sql);
			if ($fila = mysqli_fetch_row($result)) {
				$procesosiguiente = $fila[0];
				$sql2 = "UPDATE seguimiento SET proceso='$procesosiguiente' WHERE ci_alumno='$ci_alumno'";
				$result2 = mysqli_query($conn, $sql2);
				header("location: pagina.php");
			}
			
		}
	}
}
if (isset($_POST["Anterior"]))
{
	echo "funciona";
  if ($rol == 'usuario') {
	$sql = "SELECT w.proceso FROM seguimiento s INNER JOIN workflow w ON s.proceso=w.proceso_siguiente AND s.ci_alumno='$ci' order by w.proceso desc;";
	$result = mysqli_query($conn, $sql);
	if ($fila = mysqli_fetch_row($result)) {
		$procesoanterior = $fila[0];
		//$sql2 = "UPDATE seguimiento SET proceso='$procesosiguiente' WHERE ci_alumno='$ci'";
		$sql2 = "INSERT INTO seguimiento(ci_alumno,flujo,proceso) VALUES ('$ci','F1','$procesoanterior')";
		$result2 = mysqli_query($conn, $sql2);
		header("location: pagina.php?proceso=".$procesoanterior);
	}
}
}




//$sql="UPDATE seguimiento SET proceso=" 

?>