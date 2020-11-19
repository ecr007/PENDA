<div class="row">
	<div class="col-sm-12">
		<form action="<?=DOMAIN?>?c=<?=$controller?>&action=update&id=<?=$info->id?>" method="post">
			<div class="form-group">
				<label for="ecr-nombre">Nombre:</label>
				<input type="text" name="ecr-nombre" id="ecr-nombre" class="form-control" required="" value="<?=$info->nombre?>">
			</div>

			<div class="form-group">
				<label for="ecr-tamano">Tamaño en M<sup>2</sup>:</label>
				<input type="number" name="ecr-tamano" id="ecr-tamano" class="form-control" required="" value="<?=$info->tamano?>">
			</div>

			<div class="form-group">
				<label for="ecr-banos">Baños:</label>
				<input type="number" name="ecr-banos" id="ecr-banos" class="form-control" required="" value="<?=$info->banos?>">
			</div>

			<div class="form-group">
				<label for="ecr-parqueos">Parqueos:</label>
				<input type="number" name="ecr-parqueos" id="ecr-parqueos" class="form-control" required="" value="<?=$info->parqueos?>">
			</div>

			<div class="form-group">
				<label for="ecr-habitaciones">Habitaciones:</label>
				<input type="number" name="ecr-habitaciones" id="ecr-habitaciones" class="form-control" required="" value="<?=$info->habitaciones?>">
			</div>

			<div class="form-group">
				<label for="ecr-precio">Precio:</label>
				<input type="number" name="ecr-precio" id="ecr-precio" class="form-control" required="" value="<?=$info->precio?>">
			</div>

			<div class="form-group">
				<label for="ecr-direccion">Dirección:</label>
				<input type="text" name="ecr-direccion" id="ecr-direccion" class="form-control" required="" value="<?=$info->direccion?>">
			</div>

			<div class="form-group">
				<label for="ecr-clientes">Propietario:</label>
				
				<select name="ecr-clientes" id="ecr-clientes" class="form-control" required="">
					<option value="">Seleccionar...</option>
					<?php foreach ($clientes as $key): ?>
						<option value="<?=$key->id?>" <?php if($info->id_cliente == $key->id){echo "selected"; } ?> ><?=$key->nombre?></option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<label for="ecr-condiciones">Condición:</label>
				
				<select name="ecr-condiciones" id="ecr-condiciones" class="form-control" required="">
					<option value="">Seleccionar...</option>
					<?php foreach ($condiciones as $key): ?>
						<option value="<?=$key->id?>" <?php if($info->id_condicion == $key->id){echo "selected"; } ?> ><?=$key->nombre?></option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<label for="ecr-tipos">Tipo inmueble:</label>
				
				<select name="ecr-tipos" id="ecr-tipos" class="form-control" required="">
					<option value="">Seleccionar...</option>
					<?php foreach ($tipos as $key): ?>
						<option value="<?=$key->id?>" <?php if($info->id_tipos_inmuebles == $key->id){echo "selected"; } ?> ><?=$key->nombre?></option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
