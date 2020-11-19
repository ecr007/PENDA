<?php if ($info != false && count($info) > 0): ?>
	<div class="row">
		<div class="col-sm-12">
			<h3>Poliza No: <?=$info->id?></h3>

			<div>
				<p><strong>Inmueble:</strong> <?=$info->inmueble?></p>
				<p><strong>Propietario:</strong> <?=$info->cliente?></p>

				<hr>

				<p><strong>Seguro:</strong> <?=$info->seguro?></p>
				<p><strong>Fecha de inicio:</strong> <?=date("d/m/Y",strtotime($info->fecha_inicio))?></p>
				<p><strong>Fecha de expiracion:</strong> <?=date("d/m/Y",strtotime($info->fecha_final))?></p>

				<hr>

				<h5>Deducibles</h5>
				<p>
					<strong><?=$deducibles->nombre?>:</strong>
					Resta: <?=$deducibles->deducir?> | Aumenta: <?=$deducibles->aumentar?>
				</p>

				<hr>

				<h5>Extras</h5>
				<?php if ($extras != false && count($extras) > 0): ?>
					<?php foreach ($extras as $key): ?>
						<p>
							<strong><?=$key->nombre?>:</strong>
							Resta: <?=$key->deducir?> | Aumenta: <?=$key->aumentar?> | Tipo Calculo: <?=$key->tipo_calculo?> 
						</p>
					<?php endforeach ?>
				<?php endif ?>

				<hr>

				<h5>Cargos por materiales de construccion</h5>
				<?php if ($materialesConstruccion != false && count($materialesConstruccion) > 0): ?>
					<?php foreach ($materialesConstruccion as $key): ?>
						<p>
							<strong><?=$key->material?>:</strong>
							Resta: <?=$key->deducir?> | Aumenta: <?=$key->aumentar?> | Tipo Calculo: <?=$key->tipo_calculo?> 
						</p>
					<?php endforeach ?>
				<?php endif ?>

				<hr>

				<h5>Total a pagar</h5>
				
				<p><strong>Subtotal:</strong> RD$<?=number_format($info->subtotal,2)?></p>
				<p><strong>Total:</strong> RD$<?=number_format($info->total,2)?></p>
			</div>
		</div>
	</div>
<?php endif ?>
