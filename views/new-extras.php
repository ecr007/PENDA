<div class="row">
	<div class="col-sm-12">
		<form action="<?=DOMAIN?>?c=<?=$controller?>&action=insert" method="post">
			<div class="form-group">
				<label for="ecr-nombre">Nombre:</label>
				<input type="text" name="ecr-nombre" id="ecr-nombre" class="form-control" required="">
			</div>

			<div class="form-group">
				<label for="ecr-tipocalculo">Tipo calculo:</label>
				
				<select name="ecr-tipocalculo" id="ecr-tipocalculo" class="form-control" required="">
					<option value="">Seleccionar...</option>
					<option value="fijo">Fijo</option>
					<option value="porciento">Porciento</option>
				</select>
			</div>

			<div class="form-group">
				<label for="ecr-deducir">Deducir:</label>
				<input type="number" name="ecr-deducir" id="ecr-deducir" class="form-control" min="0">
			</div>

			<div class="form-group">
				<label for="ecr-aumentar">Aumentar:</label>
				<input type="number" name="ecr-aumentar" id="ecr-aumentar" class="form-control" min="0">
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
