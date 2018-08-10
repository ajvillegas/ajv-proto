<?php
/**
 * Custom TinyMCE functions.
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

add_filter( 'mce_buttons_2', 'ajv_proto_mce_buttons' );
/**
 * Modify TinyMCE buttons on the second row of the editor toolbar.
 *
 * @since 1.0.0
 * @param array $buttons Array of exising buttons.
 * @return array $buttons Array of amended buttons.
 * @link http://www.tinymce.com/wiki.php/Buttons/controls
 */
function ajv_proto_mce_buttons( array $buttons ) {

	// Add buttons to the second row.
	$additional_buttons = array(
		'styleselect',
	);

	return array_unique( array_merge( $additional_buttons, $buttons ) );

}

add_filter( 'tiny_mce_before_init', 'ajv_proto_mce_before_init' );
/**
 * Add column entries to the style dropdown.
 *
 * @since 1.0.0
 * @param array $settings Existing settings for all toolbar items.
 * @return array $settings The amended settings.
 */
function ajv_proto_mce_before_init( array $settings ) {

	$style_formats = array(
		array(
			'title'   => esc_html__( 'Lead Text', 'ajv-proto' ),
			'block'   => 'p',
			'classes' => 'lead-text',
			'icon'    => 'icon dashicons-editor-textcolor',
		),
		array(
			'title'  => esc_html__( 'Code', 'ajv-proto' ),
			'format' => 'code',
			'icon'   => 'icon dashicons-editor-code',
		),
		array(
			'title'  => esc_html__( 'Highlight', 'ajv-proto' ),
			'inline' => 'mark',
			'icon'   => 'icon dashicons-admin-customizer',
		),
		array(
			'title'    => esc_html__( 'Label Link', 'ajv-proto' ),
			'selector' => 'a',
			'classes'  => 'label-link',
			'icon'     => 'icon dashicons-admin-links',
		),
		array(
			'title' => esc_html__( 'List Style', 'ajv-proto' ),
			'icon'  => 'icon dashicons-editor-ul',
			'items' => array(
				array(
					'title'    => esc_html__( 'List Style 1', 'ajv-proto' ),
					'selector' => 'ul',
					'classes'  => 'custom-list-1',
				),
				array(
					'title'    => esc_html__( 'List Style 2', 'ajv-proto' ),
					'selector' => 'ul',
					'classes'  => 'custom-list-2',
				),
			),
		),
		array(
			'title' => esc_html__( 'Content Box', 'ajv-proto' ),
			'icon'  => 'icon dashicons-editor-table',
			'items' => array(
				array(
					'title'   => esc_html__( 'Blue', 'ajv-proto' ),
					'block'   => 'div',
					'classes' => 'content-box-blue',
				),
				array(
					'title'   => esc_html__( 'Gray', 'ajv-proto' ),
					'block'   => 'div',
					'classes' => 'content-box-gray',
				),
				array(
					'title'   => esc_html__( 'Green', 'ajv-proto' ),
					'block'   => 'div',
					'classes' => 'content-box-green',
				),
				array(
					'title'   => esc_html__( 'Purple', 'ajv-proto' ),
					'block'   => 'div',
					'classes' => 'content-box-purple',
				),
				array(
					'title'   => esc_html__( 'Red', 'ajv-proto' ),
					'block'   => 'div',
					'classes' => 'content-box-red',
				),
				array(
					'title'   => esc_html__( 'Yellow', 'ajv-proto' ),
					'block'   => 'div',
					'classes' => 'content-box-yellow',
				),
			),
		),
	);

	// Check if there are some styles already.
	if ( isset( $settings['style_formats'] ) ) {

		// Decode any existing style formats.
		$existing_style_formats = json_decode( $settings['style_formats'] );

		// Merge our new formats with any existing formats and re-encode.
		$settings['style_formats'] = wp_json_encode( array_merge( (array) $existing_style_formats, $style_formats ) );

	} else {

		$settings['style_formats'] = wp_json_encode( $style_formats );

	}

	return $settings;

}

add_action( 'init', 'ajv_proto_tinymce_plugin' );
/**
 * Register TinyMCE plugin.
 *
 * This TinyMCE plugin adds a custom button for
 * formatting and styling links.
 *
 * @since 1.0.0
 */
function ajv_proto_tinymce_plugin() {

	// Bail if the current user lacks permissions.
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}

	// Add only in rich editor mode.
	if ( 'true' === get_user_option( 'rich_editing' ) ) {

		// Register custom tinyMCE button to second row.
		add_filter( 'mce_buttons_2', 'ajv_proto_tinymce_register_button' );

		// Load custom tinyMCE plugin.
		add_filter( 'mce_external_plugins', 'ajv_proto_tinymce_add_button' );

	}

}

/**
 * Register custom tinyMCE button.
 *
 * @since 1.0.0
 * @param array $buttons List of buttons.
 */
function ajv_proto_tinymce_register_button( $buttons ) {

	// Button ID array.
	array_push( $buttons, 'ajv_proto_button_links' );

	return $buttons;

}

/**
 * Load custom tinyMCE plugin.
 *
 * @since 1.0.0
 * @param array $plugin_array An array of external TinyMCE plugins.
 */
function ajv_proto_tinymce_add_button( $plugin_array ) {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	$plugin_array['ajv_proto_button_links'] = AJV_PROTO_JS . "/button-links{$suffix}.js";

	return $plugin_array;

}
