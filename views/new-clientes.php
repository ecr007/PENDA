<div class="row">
	<div class="col-sm-12">
		<form action="<?=DOMAIN?>?c=<?=$controller?>&action=insert" method="post">
			<div class="form-group">
				<label for="ecr-nombre">Nombre:</label>
				<input type="text" name="ecr-nombre" id="ecr-nombre" class="form-control" required="">
			</div>

			<div class="form-group">
				<label for="ecr-cedula">Cedula:</label>
				<input type="number" name="ecr-cedula" id="ecr-cedula" class="form-control" required="">
			</div>

			<div class="form-group">
				<label for="ecr-telefono">Telefono:</label>
				<input type="number" name="ecr-telefono" id="ecr-telefono" class="form-control" required="">
			</div>

			<div class="form-group">
				<label for="ecr-direccion">Dirección:</label>
				<input type="text" name="ecr-direccion" id="ecr-direccion" class="form-control" required="">
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
