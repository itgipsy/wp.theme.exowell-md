<?php
/**
 * Template for displaying search forms in SeaBadgerMD
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s" class="sr-only"><?php _e( 'Search' ); ?></label>
	<input type="text" class="form-control" name="s" id="s" 
		placeholder="<?php esc_attr_e( 'Search' ); ?>">
<!--	<input type="submit" class="btn btn-sm themecolor" id="searchsubmit" value="<?php esc_attr_e( 'Search' ); ?>"> -->
</form>
