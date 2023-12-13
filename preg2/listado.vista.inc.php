<?php
session_start();
$ci=$_SESSION["ci"];
$link=mysqli_connect("localhost","scion","123456","marbanDB"); 
$resultadof=mysqli_query($link, "select * from academico.alumno where ci='$ci'");
$filaf=mysqli_fetch_array($resultadof);
$ci=$filaf["ci"];
$nombre=$filaf["nombre"];
?>
<input type="text" name="ci" value="<?php echo $ci;?>"/>
<input type="text" name="nombre" value="<?php echo $nombre;?>"/>
