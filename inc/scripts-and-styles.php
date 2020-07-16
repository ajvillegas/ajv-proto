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
	wp_enqueue_style( 'ajv-proto-style', get_stylesheet_uri(), array(), AJV_PROTO_THEME_VERSION, 'all' );

	// Google Fonts.
	wp_enqueue_style( 'ajv-proto-google-fonts', ajv_proto_google_fonts_url(), array(), AJV_PROTO_THEME_VERSION, 'all' );

	// Threaded Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Sitewide JS.
	wp_enqueue_script( 'ajv-proto-site-js', AJV_PROTO_JS . "/custom{$suffix}.js", array( 'jquery' ), AJV_PROTO_THEME_VERSION, true );

}

add_action( 'enqueue_block_editor_assets', 'ajv_proto_block_editor_styles' );
/**
 * Enqueues admin block editor fonts and styles.
 *
 * @since  1.1.0
 */
function ajv_proto_block_editor_styles() {

	// Google Fonts.
	wp_enqueue_style( 'ajv-proto-google-fonts', ajv_proto_google_fonts_url(), array(), AJV_PROTO_THEME_VERSION, 'all' );

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
