<?php
/**
 * Theme admin functions.
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

add_filter( 'admin_footer_text', 'ajv_proto_admin_footer_text' );
/**
 * Modify the admin footer text message.
 *
 * @since 1.0.0
 */
function ajv_proto_admin_footer_text() {

	?>
	<span id="footer-thankyou">
		<a href="<?php echo esc_url( admin_url( 'themes.php?theme=' ) . esc_attr( AJV_PROTO_THEME_TEXTDOMAIN ) ); ?>"><?php echo esc_html( AJV_PROTO_THEME_NAME ); ?></a>
		<?php echo ' ' . esc_html__( 'theme developed by', 'ajv-proto' ) . ' '; ?>
		<a href="<?php echo esc_url( AJV_PROTO_DEVELOPER_URL ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( AJV_PROTO_DEVELOPER ); ?></a>
	</span>
	<?php

}

add_action( 'admin_init', 'ajv_proto_remove_dashboard_widgets' );
/**
 * Remove WordPress dashboard widgets.
 *
 * @since 1.0.0
 */
function ajv_proto_remove_dashboard_widgets() {

	remove_action( 'welcome_panel', 'wp_welcome_panel' ); // Welcome widget.
	// remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // At a Glance widget.
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // Activity widget.
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Quick Draft widget.
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress Events and News widget.

}

add_filter( 'custom_menu_order', '__return_true' );
add_filter( 'menu_order', 'ajv_proto_custom_menu_order' );
/**
 * Customize dashboard menu order.
 *
 * @since 1.0.0
 * @param array $menu_order Array with current menu order.
 * @return array $menu_order Array with new menu order.
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/custom_menu_order
 */
function ajv_proto_custom_menu_order( $menu_order ) {

	if ( ! $menu_order ) {
		return true;
	}

	return array(
		'index.php', // Admin dashboard.
		'video-user-manuals/plugin.php', // Video User Manuals plugn.
		'separator1', // First of 3 separators available: separator1, separator2, separator-last.
		'edit.php?post_type=page', // Pages.
		'edit.php', // Posts.
		'edit-comments.php', // Comments.
		'gf_edit_forms', // Gravity Forms plugin.
		'upload.php', // Media.
	);

}

add_action( 'widgets_init', 'ajv_proto_unregister_widgets' );
/**
 * Unregister unwanted widgets.
 *
 * See /wp-includes/widgets/ folder for all core widget classes.
 *
 * @since 1.0.0
 */
function ajv_proto_unregister_widgets() {

	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_RSS' );
	unregister_widget( 'Akismet_Widget' );

}
