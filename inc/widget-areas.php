<?php
/**
 * Theme widget areas.
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

add_action( 'widgets_init', 'ajv_proto_register_widget_areas' );
/**
 * Register theme widget areas.
 *
 * @since 1.0.0
 */
function ajv_proto_register_widget_areas() {

	$sidebars = array(
		array(
			'id'          => 'utility-bar',
			'name'        => esc_html__( 'Utility Bar', 'ajv-proto' ),
			'description' => esc_html__( 'This is the top utility bar widget area.', 'ajv-proto' ),
		),
		array(
			'id'          => 'header-widget',
			'name'        => esc_html__( 'Header', 'ajv-proto' ),
			'description' => esc_html__( 'This is the header widget area. It typically displays next to the site logo or title.', 'ajv-proto' ),
		),
		array(
			'id'          => 'primary-sidebar',
			'name'        => esc_html__( 'Primary Sidebar', 'ajv-proto' ),
			'description' => esc_html__( 'This is the primary sidebar widget area.', 'ajv-proto' ),
		),
		array(
			'id'          => 'footer-widgets',
			'name'        => esc_html__( 'Footer Widgets', 'ajv-proto' ),
			'description' => esc_html__( 'This is the footer widgets area.', 'ajv-proto' ),
		),
	);

	foreach ( $sidebars as $sidebar ) {

		register_sidebar( array(
			'id'            => $sidebar['id'],
			'name'          => $sidebar['name'],
			'description'   => $sidebar['description'],
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widgettitle widget-title">',
			'after_title'   => '</h3>',
		) );

	}

}
