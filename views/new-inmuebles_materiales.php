<div class="row">
	<div class="col-sm-12">
		<form action="<?=DOMAIN?>?c=<?=$controller?>&action=insert" method="post">

			<div class="form-group">
				<label for="ecr-inmuebles">Inmuebles:</label>
				
				<select name="ecr-inmuebles" id="ecr-inmuebles" class="form-control" required="">
					<option value="">Seleccionar...</option>
					<?php foreach ($inmuebles as $key): ?>
						<option value="<?=$key->id?>"><?=$key->nombre?></option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<label for="ecr-materiales">Materiales:</label>
				
				<select name="ecr-materiales" id="ecr-materiales" class="form-control" required="">
					<option value="">Seleccionar...</option>
					<?php foreach ($materiales as $key): ?>
						<option value="<?=$key->id?>"><?=$key->nombre?></option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>