<div class="container text-center">
	<div class="row justify-content-md-center">
		<form class="row g-3 was-validated " method="POST" action="siguiente.php">
			<div class="row form-check mb-3" style="
												display: flex;
												justify-content: space-evenly;
											">
				<input type="checkbox" class="form-check-input" id="validationFormCheck1" required>
				<label class="form-check-label" for="validationFormCheck1">Se entrego el Certificado de no deudas?</label>
				<div class="invalid-feedback">Debe entregar el certificado de no deudas</div>
			</div>
			<div class="col-12">
			<button class="btn btn-primary" type="submit" name="Anterior">Anterior.</button>
				<button class="btn btn-primary" type="submit" name="Siguiente">Siguiente.</button>
			</div>

		</form>
	</div>
</div>