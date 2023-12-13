<div class="container text-center">
	<div class="row justify-content-md-center">
		<?php
		session_start();
		$rol = $_SESSION["rol"];
		if ($rol == "usuario") {
			echo "Debe esperar a que kardex compruebe que todos los dats subidos son correctos</br>";
			echo '<button class="btn btn-primary" type="submit" name="Anterior">Anterior.</button>';
		} elseif ($rol == "kardex") {
			
			echo '<form class="row g-3 was-validated " method="POST" action="siguiente.php?ci_usuario='.$_GET["ci"].'">';

			echo '<div class="row form-check mb-3" style="display: flex;justify-content: space-evenly;">';
			echo '<input type="radio" class="form-check-input" value="si"  name="radio-stacked" required>';
			echo '<label class="form-check-label" for="validationFormCheck2">Los datos son correctos</label>';
			echo '</div>';
			echo '<div class="row form-check mb-3" style="display: flex;justify-content: space-evenly;">';
			echo '<input type="radio" class="form-check-input" value="no"  name="radio-stacked" required>';
			echo '<label class="form-check-label" for="validationFormCheck3">Los datos no son correctos (devolver para corregir)</label>';
			echo '<div class="invalid-feedback">Seleccione una opcion</div>';
			echo '</div>';

			echo '<div class="col-12">';
			echo '<button class="btn btn-primary" type="submit" name="Siguiente">Siguiente.</button>';
			echo '</div>';
			echo '</form>';
		}
		?>


	</div>
</div>