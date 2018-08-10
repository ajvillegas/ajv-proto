<?php
/**
 * Enqueue scripts and styles.
 *
 * Included by functions.php.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Build the Google fonts URL to enqueue in a translator friendly manner.
 *
 * When adding font families replace the '+' (plus) sign in the string
 * with a space, otherwise the URL will be encoded with the '%2B' entity
 * and generate a request error.
 *
 * @since 1.0.0
 * @return string Google Fonts URL
 * @link http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 */
function ajv_proto_google_fonts_url() {

	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by this font type, translate to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = esc_html_x( 'on', 'Source Sans Pro font: on or off?', 'ajv-proto' );

	if ( 'off' !== $source_sans_pro ) {

		$font_families = array();

		if ( 'off' !== $source_sans_pro ) {
			$font_families[] = 'Source Sans Pro:400,600,700';
		}

		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

	}

	return esc_url_raw( $fonts_url );

}

add_action( 'wp_enqueue_scripts', 'ajv_proto_scripts_and_styles' );
/**
 * Enqueue scripts and styles.
 *
 * @since  1.0.0
 */
function ajv_proto_scripts_and_styles() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Main Stylesheet.
	wp_enqueue_style( 'ajv-proto-style', get_stylesheet_uri() );

	// Google Fonts.
	wp_enqueue_style( 'ajv-proto-google-fonts', ajv_proto_google_fonts_url(), array(), AJV_PROTO_THEME_VERSION, 'all' );

	// WP Dashicons.
	wp_enqueue_style( 'dashicons' );

	// Skip Links.
	wp_enqueue_script( 'ajv-proto-skip-link-focus-fix', AJV_PROTO_JS . "/skip-link-focus-fix{$suffix}.js", array(), '20151215', true );

	// Threaded Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Sitewide JS.
	wp_enqueue_script( 'ajv-proto-site-js', AJV_PROTO_JS . "/site{$suffix}.js", array( 'jquery' ), AJV_PROTO_THEME_VERSION, true );

	// Superfish.
	wp_enqueue_script( 'ajv-proto-superfish', AJV_PROTO_JS . "/superfish{$suffix}.js", array( 'jquery', 'hoverIntent' ), '1.7.5', true );
	wp_enqueue_script( 'ajv-proto-superfish-args', AJV_PROTO_JS . "/superfish.args{$suffix}.js", array( 'superfish' ), AJV_PROTO_THEME_VERSION, true );

	// Responsive Menus.
	wp_enqueue_script( 'ajv-proto-responsive-menus', AJV_PROTO_JS . "/responsive-menus{$suffix}.js", array( 'jquery' ), '1.1.2', true );
	wp_localize_script( 'ajv-proto-responsive-menus', 'ajv_proto_responsive_menus',
		array(
			'mainMenu'         => esc_html__( 'Menu', 'ajv-proto' ),
			'menuIconClass'    => 'dashicons-before dashicons-menu',
			'subMenu'          => esc_html__( 'Submenu', 'ajv-proto' ),
			'subMenuIconClass' => 'dashicons-before dashicons-arrow-down-alt2',
			'menuClasses'      => array(
				'combine' => array(
					'.nav-primary',
					// '.nav-secondary',
				),
				'others'  => array(
					// '.nav-secondary',
				),
			),
		)
	);

}

add_action( 'admin_enqueue_scripts', 'ajv_proto_admin_scripts_and_styles' );
/**
 * Enqueue admin scripts and styles.
 *
 * @since  1.0.0
 */
function ajv_proto_admin_scripts_and_styles() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Admin CSS.
	wp_enqueue_style( 'ajv-proto-admin-style', AJV_PROTO_CSS . "/admin{$suffix}.css", array(), AJV_PROTO_THEME_VERSION, 'all' );

	// Admin JS.
	wp_enqueue_script( 'ajv-proto-admin-script', AJV_PROTO_JS . "/admin{$suffix}.js", array( 'jquery' ), AJV_PROTO_THEME_VERSION, true );

}

add_action( 'admin_enqueue_scripts', 'ajv_proto_widget_scripts_and_styles' );
/**
 * Enqueue widget scripts and styles.
 *
 * Adds custom buttons and editor styles to the
 * widget's TinyMCE visual editor.
 *
 * @since 1.0.0
 * @param string $hook The current admin page.
 */
function ajv_proto_widget_scripts_and_styles( $hook ) {

	// Load script on widgets page only.
	if ( 'widgets.php' !== $hook ) {
		return;
	}

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Visual editor scripts.
	wp_enqueue_script( 'ajv-proto-visual-editor-mods', AJV_PROTO_JS . "/visual-editor-mods{$suffix}.js", array( 'jquery', 'backbone', 'editor', 'wp-util' ), AJV_PROTO_THEME_VERSION, false );
	wp_localize_script( 'ajv-proto-visual-editor-mods', 'visual_editor_mods',
		array(
			// Format Dropdown.
			'lead_text'    => esc_html__( 'Lead Text', 'ajv-proto' ),
			'code'         => esc_html__( 'Code', 'ajv-proto' ),
			'highlight'    => esc_html__( 'Highlight', 'ajv-proto' ),
			'label_link'   => esc_html__( 'Label Link', 'ajv-proto' ),
			'list_style'   => esc_html__( 'List Style', 'ajv-proto' ),
			'list_style_1' => esc_html__( 'List Style 1', 'ajv-proto' ),
			'list_style_2' => esc_html__( 'List Style 2', 'ajv-proto' ),
			'content_box'  => esc_html__( 'Content Box', 'ajv-proto' ),
			'blue'         => esc_html__( 'Blue', 'ajv-proto' ),
			'gray'         => esc_html__( 'Gray', 'ajv-proto' ),
			'green'        => esc_html__( 'Green', 'ajv-proto' ),
			'purple'       => esc_html__( 'Purple', 'ajv-proto' ),
			'red'          => esc_html__( 'Red', 'ajv-proto' ),
			'yellow'       => esc_html__( 'Yellow', 'ajv-proto' ),
			// Insert Button Dialog.
			'button_title' => esc_html_x( 'Insert Button', 'Button title', 'ajv-proto' ),
			'window_title' => esc_html_x( 'Insert Button', 'Dialog window title', 'ajv-proto' ),
			'button_text'  => esc_html__( 'Button Text', 'ajv-proto' ),
			'button_url'   => esc_html__( 'Button URL', 'ajv-proto' ),
			'target'       => esc_html__( 'Target', 'ajv-proto' ),
			'same_window'  => esc_html__( 'Same Window', 'ajv-proto' ),
			'new_window'   => esc_html__( 'New Window', 'ajv-proto' ),
			'size'         => esc_html__( 'Size', 'ajv-proto' ),
			'def'          => esc_html__( 'Default', 'ajv-proto' ),
			'small'        => esc_html__( 'Small', 'ajv-proto' ),
			'large'        => esc_html__( 'Large', 'ajv-proto' ),
			'color'        => esc_html__( 'Color', 'ajv-proto' ),
			'primary'      => esc_html__( 'Primary', 'ajv-proto' ),
			'secondary'    => esc_html__( 'Secondary', 'ajv-proto' ),
			'tertiary'     => esc_html__( 'Tertiary', 'ajv-proto' ),
			'ghost'        => esc_html__( 'Ghost', 'ajv-proto' ),
			'alignment'    => esc_html__( 'Alignment', 'ajv-proto' ),
			'none'         => esc_html__( 'None', 'ajv-proto' ),
			'left'         => esc_html__( 'Left', 'ajv-proto' ),
			'right'        => esc_html__( 'Right', 'ajv-proto' ),
			'center'       => esc_html__( 'Center', 'ajv-proto' ),
			'button_style' => esc_html__( 'Style', 'ajv-proto' ),
			'square'       => esc_html__( 'Square', 'ajv-proto' ),
			'round'        => esc_html__( 'Round', 'ajv-proto' ),
			// Editor Styles.
			'editor_style' => ',' . AJV_PROTO_CSS . "/editor-style{$suffix}.css",
		)
	);

}
