<?php
/**
 * The sidebar containing the main widget area.
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

// Add sidebar only when necessary.
if ( ! is_active_sidebar( 'primary-sidebar' )
	|| in_array( 'full-width-content', get_body_class(), true )
	|| in_array( 'full-width-padded', get_body_class(), true )
) {
	return;
}

?>
<aside id="sidebar-primary" class="sidebar sidebar-primary" role="complementary" aria-label="Primary Sidebar" itemscope itemtype="https://schema.org/WPSideBar">
	<h2 class="screen-reader-text">
		<?php esc_html_e( 'Primary Sidebar', 'ajv-proto' ); ?>
	</h2>
	<?php dynamic_sidebar( 'primary-sidebar' ); ?>
</aside>
