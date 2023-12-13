<?php
	if($_SESSION["rol"]=="kardex"){
		$sql='SELECT u.ci,u.nombre,w.proceso,w.descripcion,w.pantalla FROM usuario u INNER JOIN seguimiento s ON u.ci=s.ci_alumno AND u.rol="usuario" INNER JOIN workflow w ON s.proceso=w.proceso AND w.rol="kardex"';
		$result=mysqli_query($conn,$sql);
		echo "<table class='table'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th scope='col'>CI</th>";
		echo "<th scope='col'>Nombre</th>";
		echo "<th scope='col'>Proceso</th>";
		echo "<th scope='col'>Descripcion</th>";
		echo "<th scope='col'>Ver</th>";
		echo "</tr></thead>";
		echo "<tbody class='table-group-divider'>";
		while($row=mysqli_fetch_array($result)){
			$ci_u= $row[0];
			$nom_u= $row[1];
			$pro_u= $row[2];
			$desc_u= $row[3];
			$pant_u= $row[4];
			echo "<tr>";
			echo "<th>".$ci_u."</th>";
			echo "<td>".$nom_u."</td>";
			echo "<td>".$pro_u."</td>";
			echo "<td>".$desc_u."</td>";
			echo "<td><a href='pagina.php?ci=".$ci_u."&pantalla=".$pant_u."'>Ver</a>";
			echo "</tr>";
		}
		echo "</tbody></table>";
	}
?>