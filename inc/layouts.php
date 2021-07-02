<?php
/**
 * The theme post content layout functionality.
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
 * Get the default content layout.
 *
 * @since 1.0.0
 */
function ajv_proto_get_default_layout() {

	$layouts = array(
		'content-sidebar',
		'sidebar-content',
		'full-width-content',
		'full-width-padded',
	);

	$default_layout = sanitize_title_with_dashes( apply_filters( 'ajv_proto_default_content_layout', 'content-sidebar' ) );

	if ( in_array( $default_layout, $layouts, true ) ) {
		return $default_layout;
	} else {
		return 'content-sidebar';
	}

}

add_action( 'admin_menu', 'ajv_proto_add_layout_meta_box' );
/**
 * Register the Layout Settings meta box.
 *
 * @since 1.0.0
 */
function ajv_proto_add_layout_meta_box() {

	// Bail if theme doesn't support layout settings.
	if ( ! current_theme_supports( 'ajv-proto-layouts' ) ) {
		return;
	}

	foreach ( (array) get_post_types(
		array(
			'public' => true,
		)
	) as $type ) {
		if ( post_type_supports( $type, 'ajv-proto-layouts' ) ) {
			add_meta_box(
				'ajv-proto-layout-meta-box',
				esc_html__( 'Layout Settings', 'ajv-proto' ),
				'ajv_proto_layout_meta_box',
				$type,
				'normal',
				'high',
				// phpcs:ignore
				// array( '__back_compat_meta_box' => true ) // Hide meta box when using the block editor.
			);
		}
	}

}

/**
 * Define the Layout Settings meta box.
 *
 * @since 1.0.0
 *
 * @param object $post The post object.
 */
function ajv_proto_layout_meta_box( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'ajv_proto_layout_settings_nonce' );
	$post_layout_stored_meta = get_post_meta( $post->ID );

	// Set the default layout.
	$default_layout = 'default-layout';

	// Get the Theme Settings Customizer URL.
	$query['autofocus[section]'] = 'ajv_proto_layout_section';
	$customizer_section_link     = add_query_arg( $query, wp_customize_url() );

	?>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row">
					<label for="_ajv_proto_post_layout"><?php echo esc_html__( 'Select Layout', 'ajv-proto' ); ?></label>
				</th>
				<td class="layout-selector">
					<p>
						<input type="radio" class="default-layout" name="_ajv_proto_post_layout" id="default-layout" value="default-layout"
							<?php
							if ( isset( $post_layout_stored_meta['_ajv_proto_post_layout'] ) ) {
								checked( $post_layout_stored_meta['_ajv_proto_post_layout'][0], 'default-layout' );
							} else {
								checked( $default_layout, 'default-layout' );
							}
							?>
						>
						<label for="default-layout">
							<?php
							printf(
								/* translators: 1: theme settings URL opening tag, 2: theme settings URL closing tag */
								esc_html__( 'Default Layout from %1$sTheme Settings%2$s', 'ajv-proto' ),
								'<a href="' . esc_url( $customizer_section_link ) . '">',
								'</a>'
							);
							?>
						</label>
					</p>

					<label for="content-sidebar" class="box">
						<span class="screen-reader-text"><?php echo esc_html__( 'Content, Primary Sidebar', 'ajv-proto' ); ?></span>
						<img src="<?php echo esc_attr( AJV_PROTO_IMAGES ) . '/post-layouts/content-sidebar.gif'; ?>" alt="Content, Sidebar">
						<input type="radio" name="_ajv_proto_post_layout" id="content-sidebar" value="content-sidebar" class="screen-reader-text"
							<?php
							if ( isset( $post_layout_stored_meta['_ajv_proto_post_layout'] ) ) {
								checked( $post_layout_stored_meta['_ajv_proto_post_layout'][0], 'content-sidebar' );
							} else {
								checked( $default_layout, 'content-sidebar' );
							}
							?>
						>
					</label>

					<label for="sidebar-content" class="box">
						<span class="screen-reader-text"><?php echo esc_html__( 'Primary Sidebar, Content', 'ajv-proto' ); ?></span>
						<img src="<?php echo esc_attr( AJV_PROTO_IMAGES ) . '/post-layouts/sidebar-content.gif'; ?>" alt="Sidebar, Content">
						<input type="radio" name="_ajv_proto_post_layout" id="sidebar-content" value="sidebar-content" class="screen-reader-text"
							<?php
							if ( isset( $post_layout_stored_meta['_ajv_proto_post_layout'] ) ) {
								checked( $post_layout_stored_meta['_ajv_proto_post_layout'][0], 'sidebar-content' );
							} else {
								checked( $default_layout, 'sidebar-content' );
							}
							?>
						>
					</label>

					<label for="full-width-padded" class="box">
						<span class="screen-reader-text"><?php echo esc_html__( 'Full Width Padded', 'ajv-proto' ); ?></span>
						<img src="<?php echo esc_attr( AJV_PROTO_IMAGES ) . '/post-layouts/full-width-padded.gif'; ?>" alt="Full Width Padded">
						<input type="radio" name="_ajv_proto_post_layout" id="full-width-padded" value="full-width-padded" class="screen-reader-text"
							<?php
							if ( isset( $post_layout_stored_meta['_ajv_proto_post_layout'] ) ) {
								checked( $post_layout_stored_meta['_ajv_proto_post_layout'][0], 'full-width-padded' );
							} else {
								checked( $default_layout, 'full-width-padded' );
							}
							?>
						>
					</label>

					<label for="full-width-content" class="box">
						<span class="screen-reader-text"><?php echo esc_html__( 'Full Width Content', 'ajv-proto' ); ?></span>
						<img src="<?php echo esc_attr( AJV_PROTO_IMAGES ) . '/post-layouts/full-width-content.gif'; ?>" alt="Full Width Content">
						<input type="radio" name="_ajv_proto_post_layout" id="full-width-content" value="full-width-content" class="screen-reader-text"
							<?php
							if ( isset( $post_layout_stored_meta['_ajv_proto_post_layout'] ) ) {
								checked( $post_layout_stored_meta['_ajv_proto_post_layout'][0], 'full-width-content' );
							} else {
								checked( $default_layout, 'full-width-content' );
							}
							?>
						>
					</label>
				</td>
			</tr>
		</tbody>
	</table>
	<?php

}

add_action( 'save_post', 'ajv_proto_save_layout_meta_box_value' );
/**
 * Save the Layout Settings meta box value.
 *
 * @since 1.0.0
 *
 * @param int $post_id The post ID number.
 */
function ajv_proto_save_layout_meta_box_value( $post_id ) {

	// Check save status.
	$is_autosave    = wp_is_post_autosave( $post_id );
	$is_revision    = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['ajv_proto_layout_settings_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['ajv_proto_layout_settings_nonce'], basename( __FILE__ ) ) ) ) ? 'true' : 'false'; // WPCS: input var ok.

	// Exit depending on save status.
	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
		return;
	}

	// Check for input and sanitize/save if needed.
	if ( isset( $_POST['_ajv_proto_post_layout'] ) ) { // WPCS: input var ok.
		update_post_meta( $post_id, '_ajv_proto_post_layout', sanitize_text_field( wp_unslash( $_POST['_ajv_proto_post_layout'] ) ) ); // WPCS: input var ok.
	}

}

add_action( 'init', 'ajv_proto_register_layout_meta' );
/**
 * Register the layout meta key to make available to the REST API.
 *
 * @since 1.1.0
 */
function ajv_proto_register_layout_meta() {
	register_meta(
		'post',
		'_ajv_proto_post_layout',
		array(
			'show_in_rest'      => true,
			'type'              => 'string',
			'single'            => true,
			'sanitize_callback' => 'sanitize_text_field',
			'auth_callback'     => function() {
				return current_user_can( 'edit_posts' );
			},
		)
	);
}

add_filter( 'body_class', 'ajv_proto_add_layout_body_classes' );
/**
 * Add the content layout classes to the array of body classes.
 *
 * @since 1.0.0
 *
 * @param array $classes Array of classes applied to the body class attribute.
 *
 * @return array $classes The updated array of classes applied to the body class attribute.
 */
function ajv_proto_add_layout_body_classes( $classes ) {

	if ( ! is_singular() ) {
		$classes[] = ajv_proto_get_default_layout();

		return $classes;
	}

	global $post;

	// Get post layout meta data.
	$layout = isset( $post ) ? get_post_meta( $post->ID, '_ajv_proto_post_layout', true ) : '';

	if ( 'content-sidebar' === $layout ) {
		// Add the content-sidebar layout body class.
		$classes[] = 'content-sidebar';
	} elseif ( 'sidebar-content' === $layout ) {
		// Add the sidebar-content layout body class.
		$classes[] = 'sidebar-content';
	} elseif ( 'full-width-content' === $layout ) {
		// Add the full-width-content layout body class.
		$classes[] = 'full-width-content';
	} elseif ( 'full-width-padded' === $layout ) {
		// Add the full-width-padded layout body class.
		$classes[] = 'full-width-padded';
	} else {
		// Add the default layout body class.
		$classes[] = ajv_proto_get_default_layout();
	}

	return $classes;

}
