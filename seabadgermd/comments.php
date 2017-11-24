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

	?><h3 class="h3 comments-title">
	<?php
		printf( _n( '%1$s response to %2$s', '%1$s responses to %2$s', get_comments_number(), 'seabadgermd' ),
									number_format_i18n( get_comments_number() ),  get_the_title() );
	?></h3>
	<div class="row">
		<div class="commentlist col-12"><?php
			wp_list_comments( array( 'avatar_size' => 45, 'callback' => 'seabadgermd_comments_callback' ) );
		?></div>
	</div>	
	<div class="row">
		<div class="col-6">
			<?php previous_comments_link(__('Older comments', 'seabadgermd')) ?>
		</div>
		<div class="col-6 text-right">
			<?php next_comments_link(__('Newer comments', 'seabadgermd')) ?>
		</div>
	</div>
<?php
} else {
	if ( comments_open() ) {
	} else {
		?><p class="alert alert-info"><?php _e( 'Comments are disabled', 'seabadgermd' ); ?></p><?php
	}
}

if ( comments_open() ) {
	comment_form();
}
