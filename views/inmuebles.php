<?php if ($info != false && count($info) > 0): ?>
	<div class="row">
		<div class="col-sm-12">
			<h3>Listado:</h3>

			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Inmueble</th>
							<th>Propietario</th>
							<th>Tipo</th>
							<th>Condición</th>
							<th>Tamaño</th>
							<th>Baños</th>
							<th>Parqueos</th>
							<th>Habitaciones</th>
							<th>Precio</th>
							<th>Dirección</th>
							<th>Acción</th>
						</tr>
					</thead>
					
					<tbody>
						<?php foreach ($info as $key): ?>
							<tr>
								<td><?=$key->nombre?></td>
								<td><?=$key->propietario?></td>
								<td><?=$key->tipo?></td>
								<td><?=$key->condicion?></td>
								<td><?=$key->tamano?></td>
								<td><?=$key->banos?></td>
								<td><?=$key->parqueos?></td>
								<td><?=$key->habitaciones?></td>
								<td>RD$<?=number_format($key->precio,2)?></td>
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
