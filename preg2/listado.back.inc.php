<?php
$ci=$_GET["ci"];
$nombre=$_GET["nombre"];

$link=mysqli_connect("localhost","scion","123456","marbanDB"); 

$resultadof=mysqli_query($link, "update academico.alumno set nombre='$nombre' where ci='$ci'");
?>

