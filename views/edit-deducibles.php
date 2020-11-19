<div class="row">
	<div class="col-sm-12">
		<form action="<?=DOMAIN?>?c=<?=$controller?>&action=update&id=<?=$info->id?>" method="post">
			<div class="form-group">
				<label for="ecr-nombre">Nombre:</label>
				<input type="text" name="ecr-nombre" id="ecr-nombre" class="form-control" required="" value="<?=$info->nombre?>">
			</div>

			<div class="form-group">
				<label for="ecr-tipocalculo">Tipo calculo:</label>
				
				<select name="ecr-tipocalculo" id="ecr-tipocalculo" class="form-control" required="">
					<option value="">Seleccionar...</option>
					<option value="fijo" <?php if($info->tipo_calculo == "fijo"){echo "selected"; }?> >Fijo</option>
					<option value="porciento" <?php if($info->tipo_calculo == "porciento"){echo "selected"; }?> >Porciento</option>
				</select>
			</div>

			<div class="form-group">
				<label for="ecr-deducir">Deducir:</label>
				<input type="number" name="ecr-deducir" id="ecr-deducir" class="form-control" min="0" value="<?=$info->deducir?>" >
			</div>

			<div class="form-group">
				<label for="ecr-aumentar">Aumentar:</label>
				<input type="number" name="ecr-aumentar" id="ecr-aumentar" class="form-control" min="0" value="<?=$info->aumentar?>" >
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
