<div class="row">
	<div class="col-sm-12">
		<form action="<?=DOMAIN?>?c=<?=$controller?>&action=insert" method="post">
			<div class="form-group">
				<label for="ecr-nombre">Nombre:</label>
				<input type="text" name="ecr-nombre" id="ecr-nombre" class="form-control" required="">
			</div>

			<div class="form-group">
				<label for="ecr-municipio">Municipios:</label>
				
				<select name="ecr-municipio" id="ecr-municipio" class="form-control" required="" data-fun="getData" data-method="getSectores" data-des="ecr-sectores">
					<option value="">Seleccionar...</option>
					<?php foreach ($municipios as $key): ?>
						<option value="<?=$key->id?>"><?=$key->nombre?></option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<label for="ecr-sectores">Sectores:</label>
				
				<select name="ecr-sectores" id="ecr-sectores" class="form-control" required="">
					<option value="">Primero seleccionar municipio...</option>
				</select>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
