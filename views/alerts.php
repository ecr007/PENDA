<?php if (isset($_SESSION['errors']) || isset($_SESSION['success'])): ?>
	<div class="row">
		<div class="col-sm-12">
			<?php
				// SHOW Errors
				if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
					echo '<div class="alert alert-danger" role="alert">';
						foreach ($_SESSION['errors'] as $key) {
							echo '<p>'.$key.'</p>';
						}
					echo '</div>';
				}

				// SHOW Success
				if (isset($_SESSION['success']) && count($_SESSION['success']) > 0) {
					echo '<div class="alert alert-success" role="alert">';
						foreach ($_SESSION['success'] as $key) {
							echo '<p>'.$key.'</p>';
						}
					echo '</div>';
				}

				flushAlerts();
			?>
		</div>
	</div>
<?php endif; ?>