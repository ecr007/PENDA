<div class="row">
	<div class="col-sm-12">
		<form action="<?=DOMAIN?>?c=<?=$controller?>&action=insert" method="post">
			<div class="form-group">
				<label for="ecr-seguros">Seleccionar seguro:</label>
				
				<select name="ecr-seguros" id="ecr-seguros" class="form-control" required="">
					<option value="">Seleccionar...</option>
					<?php foreach ($seguros as $key): ?>
						<option value="<?=$key->id?>"><?=$key->nombre?> | RD$<?=number_format($key->costo,2)?></option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<label for="ecr-inmuebles">Seleccionar inmueble:</label>
				
				<select name="ecr-inmuebles" id="ecr-inmuebles" class="form-control" required="" >
					<option value="">Seleccionar...</option>
					<?php foreach ($inmuebles as $key): ?>
						<option value="<?=$key->id?>"><?=$key->nombre?></option>
					<?php endforeach ?>
				</select>
			</div>

			<hr>

			<h4>Seleccionar deducible</h4>

			<div class="form-group">

				<?php foreach ($deducibles as $key): ?>
					<label for="ecr-deducible">
						<input type="radio" name="ecr-deducible" value="<?=$key->id?>" required="">
						<?=$key->nombre?>
					</label>	
				<?php endforeach ?>
			</div>


			<h4>Seleccionar Extras</h4>

			<div class="form-group">

				<?php foreach ($extras as $key): ?>
					<label for="ecr-extras">
						<input type="checkbox" name="ecr-extras[]" value="<?=$key->id?>">
						<?=$key->nombre?>
					</label>	
				<?php endforeach ?>
			</div>

			<hr>

			<div class="form-group">
				<label for="ecr-finicio">Fecha de inicio:</label>
				<input type="date" name="ecr-finicio" id="ecr-finicio" class="form-control" required="">
			</div>

			<div class="form-group">
				<label for="ecr-ffinal">Fecha de final:</label>
				<input type="date" name="ecr-ffinal" id="ecr-ffinal" class="form-control" required="">
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="Generar poliza">
			</div>
		</form>
	</div>
</div>
