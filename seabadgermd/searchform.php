<?php
/**
 * Template for displaying search forms in SeaBadgerMD
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s" class="sr-only"><?= __( 'Search', 'seabadgermd' ); ?></label>
	<div class="md-form">
		<!-- <i class="fa fa-search prefix grey-text"></i> -->
		<input type="text" class="form-control" name="s" id="s" 
			placeholder="<?= __( 'Search', 'seabadgermd' ); ?>">
	</div>
</form>
