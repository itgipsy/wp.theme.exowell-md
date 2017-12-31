<?php
/**
 * Widget API: Seabadgermd_Widget_Fp_Pagecards - display pages on front page
 */

class Seabadgermd_Widget_Fp_Pagecards extends WP_Widget {

	/**
	 * Sets up a new FrontPage Pagecards widget instance.
	 *
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'seabadgermd_widget_fp_pagecards',
			'description' => __( 'List pages as cards on Front Page', 'seabadgermd' ),
			'customize_selective_refresh' => false,
		);
		parent::__construct( 'seabadgermd-fp-pagecards', __( 'FrontPage Pagecards', 'seabadgermd' ), $widget_ops );
		$this->alt_option_name = 'seabadgermd_widget_fp_pagecards';
	}

	/**
	 * Outputs the content for the current FrontPage Pagecards widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current FrontPage Pagecards widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$disable_image = isset( $instance['disable_image'] ) ? $instance['disable_image'] : false;

		?>
		<?php echo $args['before_widget']; ?>
		<?php
		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}

		echo '<div class="card-deck post-wrapper">';

		echo '</div>';

		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current FrontPage Pagecards widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['disable_image'] = isset( $new_instance['disable_image'] ) ? (bool) $new_instance['disable_image'] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the FrontPage Pagecards widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$disable_image = isset( $instance['disable_image'] ) ? (bool) $instance['disable_image'] : false;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php esc_html_e( 'Title:', 'seabadgermd' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			name="<?php echo $this->get_field_name( 'title' ); ?>"
			type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox"<?php checked( $disable_image ); ?>
			id="<?php echo $this->get_field_id( 'disable_image' ); ?>" 
			name="<?php echo $this->get_field_name( 'disable_image' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'disable_image' ); ?>">
				<?php esc_html_e( 'Disable featured image', 'seabadgermd' ); ?>
			</label>
		</p>
<?php
	}
}
