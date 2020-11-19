<div class="row">
	<div class="col-sm-12">
		<form action="<?=DOMAIN?>?c=<?=$controller?>&action=update&id=<?=$info->id?>" method="post">
			<div class="form-group">
				<label for="ecr-nombre">Nombre:</label>
				<input type="text" name="ecr-nombre" id="ecr-nombre" class="form-control" required="" value="<?=$info->nombre?>">
			</div>

			<div class="form-group">
				<label for="ecr-municipio">Municipios:</label>
				
				<select name="ecr-municipio" id="ecr-municipio" class="form-control" required="">
					<option value="">Seleccionar...</option>
					<?php foreach ($municipios as $key): ?>
						<option value="<?=$key->id?>" <?php if($info->id_municipio == $key->id){echo "selected"; } ?> ><?=$key->nombre?></option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
