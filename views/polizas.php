<?php if ($info != false && count($info) > 0): ?>
	<div class="row">
		<div class="col-sm-12">
			<h3>Listado:</h3>

			<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Cliente</th>
							<th>Inmueble</th>
							<th>Seguro</th>
							<th>Subtotal</th>
							<th>Total</th>
							<th>F. Inicio</th>
							<th>F. Final</th>
							<th>Acción</th>
						</tr>
					</thead>
					
					<tbody>
						<?php foreach ($info as $key): ?>
							<tr>
								<td><?=$key->cliente?></td>
								<td><?=$key->inmueble?></td>
								<td><?=$key->seguro?></td>
								<td>RD$<?=number_format($key->subtotal)?></td>
								<td>RD$<?=number_format($key->total)?></td>
								<td><?=date("d/m/Y",strtotime($key->fecha_inicio))?></td>
								<td><?=date("d/m/Y",strtotime($key->fecha_final))?></td>
								<td>
									<center>
										<a href="<?=DOMAIN?>?c=<?=$controller?>&action=view&id=<?=$key->id?>" class="btn btn-sm btn-info">Ver</a>

										&nbsp;
										<!-- <a href="<?=DOMAIN?>?c=<?=$controller?>&action=edit&id=<?=$key->id?>" class="btn btn-sm btn-warning">Editar</a> -->

										&nbsp;
										<a href="<?=DOMAIN?>?c=<?=$controller?>&action=delete&id=<?=$key->id?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Desea continuar con la acción?');">Eliminar</a>
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
