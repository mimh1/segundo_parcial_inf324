<div class="container text-center">
	<div class="row justify-content-md-center">
		<form class="row g-3 was-validated " method="POST" action="siguiente.php">
			<div class="fs-2 text-center">Entrega de requisitos</div>
			<div class="row form-check mb-3" style="
												display: flex;
												justify-content: space-evenly;
											">
				<input type="checkbox" class="form-check-input" id="validationFormCheck1" required>
				<label class="form-check-label" for="validationFormCheck1">boleta de deposito de Bs. 65.0</label>
				<div class="invalid-feedback">Requisito</div>
			</div>
			<div class="row form-check mb-3" style="
												display: flex;
												justify-content: space-evenly;
											">
				<input type="checkbox" class="form-check-input" id="validationFormCheck2" required>
				<label class="form-check-label" for="validationFormCheck1">Cuatro fotografias 4x4 (FONDO ROJO)</label>
				<div class="invalid-feedback"></div>
			</div>
			<div class="row form-check mb-3" style="
												display: flex;
												justify-content: space-evenly;
											">
				<input type="checkbox" class="form-check-input" id="validationFormCheck4" required>
				<label class="form-check-label" for="validationFormCheck1">Certificados extendidos por la biblioteca de carrera biblioteca central y area desconcentrada</label>
				<div class="invalid-feedback">Requisito</div>
			</div>
			<div class="col-12">
			<button class="btn btn-primary" type="submit" name="Anterior">Anterior.</button>
				<button class="btn btn-primary" type="submit" name="Siguiente">Siguiente.</button>
			</div>

		</form>
	</div>
</div>