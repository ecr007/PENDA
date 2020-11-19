<div class="row">
	<div class="col-sm-12">
		<form action="<?=DOMAIN?>?c=<?=$controller?>&action=insert" method="post">
			<div class="form-group">
				<label for="ecr-nombre">Nombre:</label>
				<input type="text" name="ecr-nombre" id="ecr-nombre" class="form-control" required="">
			</div>

			<div class="form-group">
				<label for="ecr-costo">Costo:</label>
				<input type="number" name="ecr-costo" id="ecr-costo" class="form-control" min="0" required="">
			</div>

			<div class="form-group">
				<label for="ecr-informacion">Información:</label>
				<input type="text" name="ecr-informacion" id="ecr-informacion" class="form-control" min="0" required="">
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
