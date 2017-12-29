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
	 * @param array $args     Display arguments including 'before_widget' and 'after_widget'.
	 * @param array $instance Settings for the current Aboutcard widget instance.
	 */
	public function widget( $args, $instance ) {

		$headimg = isset( $instance['headimg'] ) ? esc_url( $instance['headimg'] ) : '';
		$avatar = isset( $instance['avatar'] ) ? esc_url( $instance['avatar'] ) : '';
		$about = isset( $instance['about'] ) ? wp_kses_post( $instance['about'] ) : '';
		$aboutpage = isset( $instance['aboutpage'] ) ? esc_html( $instance['aboutpage'] ) : '';
		$only_on_frontpage = isset( $instance['only_on_frontpage'] ) ? (bool) $instance['only_on_frontpage'] : false;

		if ( $only_on_frontpage && ! is_front_page() ) {
			return;
		}
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		?>
		<?php echo $args['before_widget']; ?>
		<div class="about aboutwidget">
			<div class="about-header">
				<img class="img-fluid" src="<?php echo esc_url( $headimg ); ?>">
				<img class="about-avatar" src="<?php echo esc_url( $avatar ); ?>">
			</div>
			<div class="about-body">
				<p class="about-text"><?php echo wp_kses_post( $about ); ?></p>
			</div>
			<?php
			if ( $aboutpage ) :
				$abouturl = get_permalink( $aboutpage );
			?>
			<div class="about-footer">
				<a href="<?php echo esc_url( $abouturl ); ?>" class="btn btn-round themecolor"
				title="<?php esc_attr_e( 'Visit About page', 'sesabadgermd' ); ?>">
				<i class="fa fa-id-card-o" aria-hidden="true"></i>
				<span class="sr-only">Visit About page</span></a>
			</div>
			<?php
			endif;
			?>
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
		$instance['headimg'] = esc_url( $new_instance['headimg'] );
		$instance['avatar'] = esc_url( $new_instance['avatar'] );
		$instance['about'] = wp_kses_post( $new_instance['about'] );
		$instance['aboutpage'] = esc_html( $new_instance['aboutpage'] );
		$instance['only_on_frontpage'] = (bool) $new_instance['only_on_frontpage'];
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$headimg    = isset( $instance['headimg'] ) ? esc_url( $instance['headimg'] ) : '';
		$avatar    = isset( $instance['avatar'] ) ? esc_url( $instance['avatar'] ) : '';
		$about = isset( $instance['about'] ) ? wp_kses_post( $instance['about'] ) : '';
		$aboutpage = isset( $instance['aboutpage'] ) ? esc_html( $instance['aboutpage'] ) : '';
		$only_on_frontpage = isset( $instance['only_on_frontpage'] ) ? (bool) $instance['only_on_frontpage'] : false;
?>
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

		<p>
			<label for="<?php echo $this->get_field_id( 'aboutpage' ); ?>">
				<?php esc_html_e( 'About page:', 'seabadgermd' ); ?>
			</label>
			<?php
				$pargs = array(
					'selected' => $aboutpage,
					'echo' => 1,
					'name' => $this->get_field_name( 'aboutpage' ),
					'id' => $this->get_field_id( 'aboutpage' ),
					'class' => '',
					'show_option_none' => esc_html__( 'Show no "About page" button', 'seabadgermd' ),
				);
			?>
			<?php wp_dropdown_pages( $pargs ); ?>
		</p>

		<p>
			<input class="checkbox" type="checkbox"<?php checked( $only_on_frontpage ); ?>
			id="<?php echo $this->get_field_id( 'only_on_frontpage' ); ?>" 
			name="<?php echo $this->get_field_name( 'only_on_frontpage' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'only_on_frontpage' ); ?>">
				<?php esc_html_e( 'Only show this widget on the front page', 'seabadgermd' ); ?>
			</label>
		</p>

		<small>*This widget doesn't support widget title</small>
<?php
	}
}
