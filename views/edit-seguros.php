<div class="row">
	<div class="col-sm-12">
		<form action="<?=DOMAIN?>?c=<?=$controller?>&action=update&id=<?=$info->id?>" method="post">
			<div class="form-group">
				<label for="ecr-nombre">Nombre:</label>
				<input type="text" name="ecr-nombre" id="ecr-nombre" class="form-control" required="" value="<?=$info->nombre?>">
			</div>

			<div class="form-group">
				<label for="ecr-costo">Costo:</label>
				<input type="number" name="ecr-costo" id="ecr-costo" class="form-control" min="0" required="" value="<?=$info->costo?>">
			</div>

			<div class="form-group">
				<label for="ecr-informacion">Información:</label>
				<input type="text" name="ecr-informacion" id="ecr-informacion" class="form-control" min="0" required="" value="<?=$info->informacion?>">
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
