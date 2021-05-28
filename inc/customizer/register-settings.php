<?php
/**
 * Register Customizer panels, sections and controls.
 *
 * Included by customizer.php.
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

add_action( 'customize_register', 'ajv_proto_register_customizer_panels' );
/**
 * Register Customizer panels.
 *
 * @since 1.1.0
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function ajv_proto_register_customizer_panels( $wp_customize ) {

	// Panel: Theme Settings.
	$wp_customize->add_panel(
		'ajv_proto_theme_settings',
		array(
			'priority'    => 125,
			'title'       => esc_html__( 'Theme Settings', 'ajv-proto' ),
			'description' => esc_html__( 'Edit the theme\'s default settings.', 'ajv-proto' ),
			'capability'  => 'edit_theme_options',
		)
	);

}

add_action( 'customize_register', 'ajv_proto_register_customizer_sections' );
/**
 * Register Customizer sections.
 *
 * @since 1.0.0
 *
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function ajv_proto_register_customizer_sections( $wp_customize ) {

	// Section: Site Layout.
	if ( current_theme_supports( 'ajv-proto-layouts' ) ) {
		$wp_customize->add_section(
			'ajv_proto_layout_section',
			array(
				'priority'    => 10,
				'panel'       => 'ajv_proto_theme_settings',
				'title'       => esc_html__( 'Site Layout', 'ajv-proto' ),
				'description' => esc_html__( 'Select the default site layout for post and pages.', 'ajv-proto' ),
				'capability'  => 'edit_theme_options',
			)
		);
	}

	// Section: Footer.
	$wp_customize->add_section(
		'ajv_proto_footer_section',
		array(
			'priority'    => 30,
			'panel'       => 'ajv_proto_theme_settings',
			'title'       => esc_html__( 'Footer', 'ajv-proto' ),
			'description' => esc_html__( 'Edit the text that displays in your site footer.', 'ajv-proto' ),
			'capability'  => 'edit_theme_options',
		)
	);

}

add_action( 'customize_register', 'ajv_proto_register_customizer_controls' );
/**
 * Register theme Customizer controls.
 *
 * @since 1.0.0
 *
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function ajv_proto_register_customizer_controls( $wp_customize ) {

	// Site Layout Control.
	$wp_customize->add_setting(
		'ajv_proto_default_layout',
		array(
			'default'           => 'content-sidebar',
			'transport'         => 'refresh',
			'sanitize_callback' => 'ajv_proto_radio_sanitization',
		)
	);
	$wp_customize->add_control(
		new AJV_Proto_Image_Radio_Button(
			$wp_customize,
			'ajv_proto_default_layout',
			array(
				'label'   => esc_html__( 'Default Site Layout', 'ajv-proto' ),
				'section' => 'ajv_proto_layout_section',
				'choices' => array(
					'content-sidebar'    => array(
						'image' => AJV_PROTO_IMAGES . '/post-layouts/content-sidebar.gif',
						'name'  => esc_html__( 'Right Sidebar', 'ajv-proto' ),
					),
					'sidebar-content'    => array(
						'image' => AJV_PROTO_IMAGES . '/post-layouts/sidebar-content.gif',
						'name'  => esc_html__( 'Left Sidebar', 'ajv-proto' ),
					),
					'full-width-padded'  => array(
						'image' => AJV_PROTO_IMAGES . '/post-layouts/full-width-padded.gif',
						'name'  => esc_html__( 'Full Width Padded', 'ajv-proto' ),
					),
					'full-width-content' => array(
						'image' => AJV_PROTO_IMAGES . '/post-layouts/full-width-content.gif',
						'name'  => esc_html__( 'Full Width Content', 'ajv-proto' ),
					),
				),
			)
		)
	);

	// Footer Credits Control.
	$wp_customize->add_setting(
		'ajv_proto_footer_creds',
		array(
			'default'           => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		new AJV_Proto_TinyMCE(
			$wp_customize,
			'ajv_proto_footer_creds',
			array(
				'label'       => esc_html__( 'Footer Credits', 'ajv-proto' ),
				'description' => esc_html__( 'You can use the [year] shortcode to dynamically display the current year.', 'ajv-proto' ),
				'section'     => 'ajv_proto_footer_section',
				'input_attrs' => array(
					'toolbar1' => 'bold italic link',
				),
			)
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'ajv_proto_footer_creds',
		array(
			'selector'            => '.footer-creds p',
			'container_inclusive' => false,
			'render_callback'     => 'ajv_proto_footer_creds',
			'fallback_refresh'    => true,
		)
	);

}

add_action( 'customize_register', 'ajv_proto_modify_default_customizer_controls' );
/**
 * Modify default theme Customizer controls.
 *
 * @since 1.0.0
 *
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function ajv_proto_modify_default_customizer_controls( $wp_customize ) {

	// Modify the Site Icon control label.
	$wp_customize->get_control( 'site_icon' )->label = esc_html__( 'Site Icon (Favicon)', 'ajv-proto' );

}
