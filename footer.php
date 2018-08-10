<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the .site-container div and all content after.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @license    GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
		</div><!-- .site-inner -->

		<?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
			<div id="site-footer-widgets" class="footer-widgets">
				<span class="screen-reader-text"><?php echo esc_html__( 'Footer', 'ajv-proto' ); ?></span>
				<div class="wrap">
					<?php dynamic_sidebar( 'footer-widgets' ); ?>
				</div>
			</div>
		<?php endif; ?>

		<footer class="site-footer" itemscope="" itemtype="https://schema.org/WPFooter">
			<div class="wrap">				
				<nav id="site-nav-footer" class="nav-footer" aria-label="Footer" itemscope="" itemtype="https://schema.org/SiteNavigationElement">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_id'        => 'menu-footer-menu',
						'menu_class'     => 'site-nav-menu menu-footer',
						'depth'          => 1,
					) );
					?>
				</nav>
				<?php
				echo '<p>' . esc_html__( 'Copyright', 'ajv-proto' ) . ' &copy; ' . esc_html( date( 'Y' ) );
				echo ' &middot; <a href="' . esc_url( home_url() ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a> &middot; ';
				echo esc_html__( 'All Rights Reserved', 'ajv-proto' ) . '</p>';
				?>
			</div>
		</footer><!-- .site-footer -->
	</div><!-- .site-container -->

	<?php wp_footer(); ?>

</body>
</html>
