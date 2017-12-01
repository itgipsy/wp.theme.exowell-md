<?php
/**
 * Comments template
 */

if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
	die ( 'Can not load page directly' );

if ( post_password_required() ) {
	?><p class="alert alert-danger"><?php _e( 'This post is password protected. Enter the password to view comments.', 'seabadgermd' ); ?></p><?php
	return;
}

if ( have_comments() ) {

	?><h4 class="h4 comments-title">
	<?php
		printf( _n( '%1$s response to %2$s', '%1$s responses to %2$s', get_comments_number(), 'seabadgermd' ),
									number_format_i18n( get_comments_number() ),  get_the_title() );
	?></h4>
	<div class="row">
		<div class="commentlist col-12"><?php
			wp_list_comments( array( 'avatar_size' => 45, 'callback' => 'seabadgermd_comments_callback' ) );
		?></div>
	</div>	
	<div class="row">
		<div class="col-6">
			<?php 
				echo str_replace('<a ', '<a class="btn btn-sm themecolor" ',
					get_previous_comments_link(__('Older comments', 'seabadgermd')));
			?>
		</div>
		<div class="col-6 text-right">
			<?php
				echo str_replace('<a ', '<a class="btn btn-sm themecolor" ',
					get_next_comments_link(__('Newer comments', 'seabadgermd')));
			?>
		</div>
	</div>
<?php
	if ( !comments_open() ) {
		// if there are comments, but commenting is disabled, show info
		?><p class="alert alert-info"><?php _e( 'Comments are disabled', 'seabadgermd' ); ?></p><?php
	}
}

if ( comments_open() ) {
	comment_form(array(
		'comment_field' => '<label for="comment">' . __('Comment', 'seabadgermd') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="form-control"></textarea>',
		'class_submit' => 'btn btn-sm themecolor'
	));
}
