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
			<div id="footer-widgets" class="footer-widgets">
				<span class="screen-reader-text"><?php echo esc_html__( 'Footer', 'ajv-proto' ); ?></span>
				<div class="wrap">
					<?php dynamic_sidebar( 'footer-widgets' ); ?>
				</div>
			</div>
		<?php endif; ?>

		<footer class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
			<div class="wrap">
				<nav id="footer-nav" class="footer-nav" aria-label="Footer" itemscope itemtype="https://schema.org/SiteNavigationElement">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'depth'          => 1,
							'container'      => false,
							'menu_id'        => 'footer-menu',
						)
					);
					?>
				</nav>

				<div class="footer-creds">
					<p><?php ajv_proto_footer_creds(); ?></p>
				</div>
			</div>
		</footer><!-- .site-footer -->

		<button title="Back To Top" class="to-top">
			<span class="screen-reader-text"><?php esc_html__( 'Back to top', 'ajv-proto' ); ?></span>
			<span class="arrow-up"></span>
		</button>
	</div><!-- .site-container -->

	<?php wp_footer(); ?>

</body>
</html>
