<?php
/**
 * Theme third-party plugin integrations.
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

/** Gravity Forms */

// Enable Gravity Forms label visibility settings.
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

add_filter( 'gform_validation_message', 'ajv_proto_gform_validation_message', 10, 2 );
/**
 * Modify Gravity Forms validation message.
 *
 * @since 1.0.0
 * @param string $message The validation message to be filtered.
 * @param array  $form The current form.
 */
function ajv_proto_gform_validation_message( $message, $form ) {

	return '';

}

/** Jetpack */

add_action( 'after_setup_theme', 'ajv_proto_jetpack_setup' );
/**
 * Jetpack setup function.
 *
 * @since  1.0.0
 * @link   https://jetpack.com/support/infinite-scroll/
 * @link   https://jetpack.com/support/responsive-videos/
 * @link   https://jetpack.com/support/content-options/
 */
function ajv_proto_jetpack_setup() {

	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'ajv_proto_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details'    => array(
			'stylesheet' => 'ajv-proto-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
		'featured-images' => array(
			'archive' => true,
			'post'    => true,
			'page'    => true,
		),
	) );

}

/**
 * Custom render function for Infinite Scroll.
 *
 * @since  1.0.0
 */
function ajv_proto_infinite_scroll_render() {

	while ( have_posts() ) {
		the_post();

		if ( is_search() ) {
			get_template_part( 'template-parts/content', 'search' );
		} else {
			get_template_part( 'template-parts/content', get_post_type() );
		}
	}

}
