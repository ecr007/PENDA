<div class="row">
	<div class="col-sm-12">
		<form action="<?=DOMAIN?>?c=<?=$controller?>&action=update&id=<?=$info->id?>" method="post">

			<div class="form-group">
				<label for="ecr-inmpuebles">Inmuebles:</label>
				
				<select name="ecr-inmpuebles" id="ecr-inmpuebles" class="form-control" required="">
					<option value="">Seleccionar...</option>
					<?php foreach ($inmuebles as $key): ?>
						<option value="<?=$key->id?>" <?php if($key->id_inmueble == $key->id){echo "selected";}?>><?=$key->nombre?></option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<label for="ecr-materiales">Materiales:</label>
				
				<select name="ecr-materiales" id="ecr-materiales" class="form-control" required="">
					<option value="">Seleccionar...</option>
					<?php foreach ($materiales as $key): ?>
						<option value="<?=$key->id?>" <?php if($key->id_material == $key->id){echo "selected";}?>><?=$key->nombre?></option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>