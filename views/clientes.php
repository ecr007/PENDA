<?php if ($info != false && count($info) > 0): ?>
	<div class="row">
		<div class="col-sm-12">
			<h3>Listado:</h3>

			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Cedula</th>
							<th>Telefono</th>
							<th>Direccion</th>
							<th>Acción</th>
						</tr>
					</thead>
					
					<tbody>
						<?php foreach ($info as $key): ?>
							<tr>
								<td><?=$key->nombre?></td>
								<td><?=$key->cedula?></td>
								<td><?=$key->telefono?></td>
								<td><?=$key->direccion?></td>
								<td>
									<center>
										<a href="<?=DOMAIN?>?c=<?=$controller?>&action=delete&id=<?=$key->id?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Continuar con la acción?');">Eliminar</a>
										
										&nbsp;
										<a href="<?=DOMAIN?>?c=<?=$controller?>&action=edit&id=<?=$key->id?>" class="btn btn-sm btn-warning">Editar</a>
									</center>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endif ?>
