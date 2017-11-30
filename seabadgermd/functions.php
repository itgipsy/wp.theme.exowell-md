<?php

// Theme Constants
define( "SBMD_THEME_DIR", get_template_directory() );
define( "SBMD_THEME_DIR_URI", get_template_directory_uri() );
define( "SBMD_STYLESHEET_DIR", get_stylesheet_directory() );
define( "SBMD_STYLESHEET_DIR_URI", get_stylesheet_directory_uri() );
$sbmd_theme = wp_get_theme();
define( "SBMD_THEME_VERSION", $sbmd_theme->get( 'Version' ) );

/**
* Include external files
*/
require_once('inc/seabadgermd_customizer.php');
require_once('widgets/class-wp-widget-archives.php');
require_once('widgets/class-widget-recent-posts-grid.php');
require_once('inc/mdb_navwalker.php');
require_once('inc/mdb_pagination.php'); 

/**
 * Include CSS/JS dependencies 
 */
function theme_enqueue_scripts() {
	wp_enqueue_style( 'Font_Awesome', SBMD_THEME_DIR_URI . '/css/font-awesome.min.css', array(), '4.7.0' );
	wp_enqueue_style( 'Bootstrap_css', SBMD_THEME_DIR_URI . '/css/bootstrap.min.css', array(), '4.0.0' );
	wp_enqueue_style( 'MDB', SBMD_THEME_DIR_URI . '/css/mdb.min.css', array(), '4.4.3' );
	wp_enqueue_style( 'Style', SBMD_THEME_DIR_URI . '/style.css', array(), SBMD_THEME_VERSION );
	wp_enqueue_script( 'jQuery', SBMD_THEME_DIR_URI . '/js/jquery-3.2.1.min.js', array(), '3.2.1', true );
	wp_enqueue_script( 'Tether', SBMD_THEME_DIR_URI . '/js/popper.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'Bootstrap', SBMD_THEME_DIR_URI . '/js/bootstrap.min.js', array(), '4.0.0', true );
	wp_enqueue_script( 'MDB', SBMD_THEME_DIR_URI . '/js/mdb.min.js', array(), '4.4.3', true );
	wp_enqueue_script( 'SBMDJS', SBMD_THEME_DIR_URI . '/js/site.js', array(), SBMD_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

/**
 * Setup Theme
 */
function seabadgermd_setup() {
	// Let WP manage the title tag
	add_theme_support('title-tag');
	// Automated feed link support
	add_theme_support('automatic-feed-links');
	// Default width to bootstrap lg container width
	if (!isset($content_width)) $content_width = 1170;
	// Add text domain
	load_theme_textdomain('seabadgermd', SBMD_THEME_DIR . '/languages');
	// Navigation Menus
	register_nav_menus(array(
		'navbar' => __( 'Navbar Menu', 'seabadgermd'),
		'footer' => __( 'Footer Menu', 'seabadgermd')
	));
	// Add featured image support
	add_theme_support('post-thumbnails');
	add_image_size('main-full', 1078, 516, false); // main post image in full width
	// Allow custom background
	add_theme_support('custom-background');
	// Support custom header image
	add_theme_support('custom-header', array(
		'width' => 1160,
		'flex-width' => true,
		'flex-height' => true,
		'header-text' => true,
		'default-text-color' => '#ffffff'
	));
}
add_action('after_setup_theme', 'seabadgermd_setup');

function seabadgermd_editor_style() {
	// Add some text style to the editor
	add_editor_style('css/editor.css');
}
add_action('admin_init', 'seabadgermd_editor_style');

function seabadgermd_posts_link_attributes() {
	return 'class="page-link"';
}

add_filter('next_posts_link_attributes', 'seabadgermd_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'seabadgermd_posts_link_attributes');



/* Load custom CSS based on the selected color theme and settings */
function seabadgermd_customize_css()
{
	$colorTheme = get_theme_mod('seabadgermd_color_theme');
	if (!seabadgermd_color_theme_exists($colorTheme)) {
		$colorTheme = 'mdb_dark';
	}
	$colorThemeConf = seabadgermd_get_color_theme($colorTheme);
	wp_enqueue_style( 'ColorTheme_css', get_template_directory_uri() . $colorThemeConf['css'] );
}
add_action( 'wp_enqueue_scripts', 'seabadgermd_customize_css');

/**
 * Register sidebars and widgetized areas.
 */

function seabadgermd_widgets_init() {

	register_sidebar( array(
		'name'			=> 'Sidebar',
		'id'			=> 'sidebar',
		'description'	=> 'Main sidebar',
		'before_widget' => '<div id="%1$s" class="card widget %2$s"><div class="card-body">',
		'after_widget'	=> '</div></div>',
		'before_title'	=> '<div class="card-title widget-title themecolor">',
		'after_title'	 => '</div>',
	) );

	register_sidebar( array(
		'name'			=> 'Footer',
		'id'			=> 'footer',
		'description'	=> 'Footer area',
		'before_widget' => '',
		'after_widget'	=> '',
		'before_title'	=> '<span style="display:none">',
		'after_title'	 => '</span>',
	) );

	unregister_widget('WP_Widget_Archives');
	register_widget('WP_Widget_ArchivesMD');
	register_widget('SBMD_Widget_Recent_Posts_Grid');
}

add_action( 'widgets_init', 'seabadgermd_widgets_init' );

function seabadgermd_post_navigation(){
	if ( "" != get_adjacent_post( false, "", false ) || "" != get_adjacent_post( false, "", true ) ):
?>
	<div class="row post-navigation">
		<div class="col-6 post-navigation-next">
<?php
	if ( "" != get_adjacent_post( false, "", false ) ):
		next_post_link( '%link', __( 'Next post', 'seabadgermd') );
	endif;
?>
		</div>
		<div class="col-6 post-navigation-prev">
<?php
	if ( "" != get_adjacent_post( false, "", true ) ):
		previous_post_link( '%link', __( 'Previous post', 'seabadgermd' ) );
	endif;
?>
		</div>
	</div>
<?php
endif;
}

/** https://justinklemm.com/add-class-to-wordpress-next_post_link-and-previous_post_link-links/ **/ 
add_filter('next_post_link', 'seabadgermd_post_navlink_attributes');
add_filter('previous_post_link', 'seabadgermd_post_navlink_attributes');

function seabadgermd_post_navlink_attributes($output) {
    $class = 'class="btn themecolor"';
    return str_replace('<a href=', '<a ' . $class . ' href=', $output);
}


function seabadgermd_comments_callback( $comment, $args, $depth ) {
?>
	<div class="media comment" id="comment-<?php comment_ID(); ?>">
		<?php echo get_avatar($comment, $args['avatar_size'], 'gravatar_default', '', array('class' => 'd-flex rounded-circle mr-3')); ?>
		<div class="media-body comment">
			<h5 class="mt-0 comment-header"><?php echo get_comment_author_link( $comment ); ?>
				<?php printf('%s ago', human_time_diff(get_comment_time( 'U' ), current_time( 'timestamp' ))); ?>
			</h5>
			<?php
				if ( '0' == $comment->comment_approved ) {
					echo '<div class="alert alert-warning">' . __('You comment is awaiting moderation', 'seabadgermd') . '</div>';
				}
				comment_text();
				echo preg_replace('/comment-reply-link/','comment-reply-link btn btn-sm themecolor',
					get_comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'      => $depth,
					'max_depth' => $args['max_depth'],
				))));
				printf('<a href="%s" class="comment-edit-link btn btn-sm themecolor">%s</a>',
					get_edit_comment_link($comment), __('Edit', 'seabadgermd'));
			?>
		</div>
	</div>
<?php
}

function seabadgermd_wp_link_pages_link($link) {
	if (!preg_match('/href=/', $link)) {
		return preg_replace('/class="/','class="active ', $link);
	}
	return $link;
}
add_filter( 'wp_link_pages_link',  'seabadgermd_wp_link_pages_link' );

// https://wordpress.stackexchange.com/questions/43558/how-to-manually-fix-the-wordpress-gallery-code-using-php-in-functions-php
// responsive image gallery
function seabadgermd_post_gallery($output, $attr) {
    global $post;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $columns = intval($columns);
	if ($columns > 12) {
		$columns = 12;
	} else if (12 % $columns != 0) {
		while (12 % $columns != 0) {
			$columns--;
		}
	}
    $itemwidth = $columns > 0 ? 12 / $columns : 12;

    $selector = "gallery-{$instance}";

    $size_class = sanitize_html_class( $size );
    $output = "<div id='$selector' class='row gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output .= '<div class="col-12">';

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        // $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
		if ($i === 0) $output .= '<div class="row">';
        $output .= sprintf("<div class='col-xs-12 col-md-%d gallery-item'>", $itemwidth);
		$get_icon = isset($attr['link']) && 'file' == $attr['link'];
		$src = wp_get_attachment_image_src($id, $size, $get_icon)[0];
		$srcs = array();
		foreach (get_intermediate_image_sizes() as $s) {
			$imgsrc = wp_get_attachment_image_src($id, $s, $get_icon);
			if ($imgsrc)
				array_push($srcs, $imgsrc[0] . ' ' . $imgsrc[1] . 'w');
		}
		$srcset = implode(',', $srcs);
		$sizelist = array();
		array_push($sizelist, '(max-width: 767px) 750px'); // no columns on xs screen
		array_push($sizelist, sprintf('(max-width: 992px) %dpx', 750 / $columns)); // a very rough maximum width of space to fill
		array_push($sizelist, sprintf('(max-width: 1200px) %dpx', 970 / $columns));
		array_push($sizelist, sprintf('%dpx', 1170 / $columns));
		$sizes = implode(',', $sizelist);
        //$output .= preg_replace('/class="/', 'class="img-fluid ', $link);
		$output .= sprintf('<img src="%s" srcset="%s" sizes="%s" class="img-thumbnail">', $src, $srcset, $sizes);
        if ( trim($attachment->post_excerpt) ) {
            $output .= "
                <p class='wp-caption-text gallery-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </p>";
        } else {
			$output .= '<p class="wp-caption-text gallery-caption"><!-- no caption --></p>';
		}
        $output .= "</div>";
		if (++$i === $columns) {
			$output .= '</div>'; //close row
			$i = 0;
		}
    }

    $output .= "</div>
		</div>\n";

    return $output;
}
add_filter("post_gallery", "seabadgermd_post_gallery",10,2);

function add_default_table_format($content) {
	return str_replace('<table>', '<table class="table">', $content);
}
add_filter("the_content", "add_default_table_format");

?>
