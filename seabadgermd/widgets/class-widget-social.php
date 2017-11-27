<?php
/**
 * Widget API: SBMD_Widget_Social - display social icons configured for SeaBadgerMD theme
 */

class SBMD_Widget_Social extends WP_Widget {

	/**
	 * Sets up a new Social widget instance.
	 *
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'seabadgermd_widget_social',
			'description' => __( 'Display your social site buttons', 'seabadgermd' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct('social', __('SeaBadgerMD Social buttons', 'seabadgermd'), $widget_ops);
	}

	/**
	 * Outputs the content for the current Social widget instance.
	 *
	 * @param array $args		 Display arguments including 'before_title', 'after_title',
	 *												'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Social widget instance.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];
		if ( array_key_exists('title', $instance) && $instance['title'] ) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}

		seabadgermd_display_social_buttons();

		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Social widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *														SBMD_Widget_Social::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '') );
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Outputs the settings form for the Social widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = sanitize_text_field( $instance['title'] );
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php __('Title:', 'seabadgermd'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<?php
	}
}
