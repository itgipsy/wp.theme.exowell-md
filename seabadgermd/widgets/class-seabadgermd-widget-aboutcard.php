<?php
/**
 * Widget API: Seabadgermd_Widget_Aboutcard - About card on SeaBadgerMD theme
 */

class Seabadgermd_Widget_Aboutcard extends WP_Widget {

	/**
	 * Sets up a new Aboutcard widget instance.
	 *
	 */
	public function __construct() {

		add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
		$widget_ops = array(
			'classname' => 'seabadgermd_widget_aboutcard',
			'description' => __( 'Display About Card on selected pages', 'seabadgermd' ),
			'customize_selective_refresh' => false,
		);
		parent::__construct( 'seabadgermd-aboutcard', __( 'About Card [SeaBadgerMD]', 'seabadgermd' ), $widget_ops );
		$this->alt_option_name = 'seabadgermd_widget_aboutcard';
	}

	public function scripts() {
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_media();
		wp_enqueue_script( 'seabadgermd_admin_js', get_template_directory_uri() . '/js/admin.js',
		array( 'jquery' ) );
	}

	/**
	 * Outputs the content for the current Aboutcard widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Aboutcard widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );


		?>
		<?php echo $args['before_widget']; ?>
		<?php
		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}
		?>
		<div class="about aboutwidget">
			<div class="about-header">
				<img class="img-fluid" src="<?php echo esc_url( $instance['headimg'] ); ?>">
				<img class="about-avatar" src="<?php echo esc_url( $instance['avatar'] ); ?>">
			</div>
			<div class="about-body">
				<p class="about-text"><?php echo wp_kses_post( $instance['about'] ); ?></p>
			</div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['headimg'] = esc_url( $new_instance['headimg'] );
		$instance['avatar'] = esc_url( $new_instance['avatar'] );
		$instance['about'] = wp_kses_post( $new_instance['about'] );
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$headimg    = isset( $instance['headimg'] ) ? esc_url( $instance['headimg'] ) : '';
		$avatar    = isset( $instance['avatar'] ) ? esc_url( $instance['avatar'] ) : '';
		$about = isset( $instance['about'] ) ? wp_kses_post( $instance['about'] ) : '';
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
			<label for="<?php echo $this->get_field_id( 'headimg' ); ?>">
				<?php esc_html_e( 'Header image:' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'headimg' ); ?>" 
			name="<?php echo $this->get_field_name( 'headimg' ); ?>" type="text" 
			value="<?php echo esc_url( $headimg ); ?>" />
			<button class="upload_image_button button button-primary">
				<?php esc_html_e( 'Use media library', 'seabadgermd' ); ?>
			</button>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'avatar' ); ?>">
				<?php esc_html_e( 'Avatar:' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'avatar' ); ?>" 
			name="<?php echo $this->get_field_name( 'avatar' ); ?>" type="text" 
			value="<?php echo esc_url( $avatar ); ?>" />
			<button class="upload_image_button button button-primary">
				<?php esc_html_e( 'Use media library', 'seabadgermd' ); ?>
			</button>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'about' ); ?>">
				<?php esc_html_e( 'About:', 'seabadgermd' ); ?>
			</label>
			<textarea name="<?php echo $this->get_field_name( 'about' ); ?>"
			class="widefat text wp-edit-area" id="<?php echo $this->get_field_id( 'about' ); ?>"
			style="height:200px" cols=20 rows=16><?php echo esc_textarea( $about ); ?></textarea>
		</p>

<?php
	}
}
