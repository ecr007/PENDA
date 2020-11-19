<div class="row">
	<div class="col-sm-12">
		<form action="<?=DOMAIN?>?c=<?=$controller?>&action=insert" method="post">
			<div class="form-group">
				<label for="ecr-nombre">Nombre:</label>
				<input type="text" name="ecr-nombre" id="ecr-nombre" class="form-control" required="">
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>
