<?php
/**
 * The template for displaying 404 error (not found) pages.
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

get_header();

?>
<div class="content-sidebar-wrap">
	<main id="site-content" class="content">

		<?php
		if ( function_exists( 'breadcrumb_trail' ) ) {
			breadcrumb_trail( array(
				'show_on_front' => false,
				'labels'        => array(
					'browse' => esc_html__( 'You are here:', 'ajv-proto' ),
				),
			) );
		}

		?>
		<section class="error-404 not-found entry">
			<header class="entry-header">
				<h1 class="entry-title" itemprop="headline"><?php esc_html_e( 'Oops! That page can\'t be found.', 'ajv-proto' ); ?></h1>
			</header><!-- .page-header -->

			<div class="entry-content">
				<?php
				echo sprintf(
					'<p>' . wp_kses(
						/* translators: %s: homepage URL */
						__( 'It looks like nothing was found at this location. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you\'re looking for. Or, you can try finding it by using the search form below.', 'ajv-proto' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					) . '</p>',
					esc_url( trailingslashit( home_url() ) )
				);

				get_search_form();

				echo '<h2>' . esc_html__( 'Sitemap', 'ajv-proto' ) . '</h2>';
				echo wp_kses_post( ajv_proto_get_sitemap( 'h3' ) );
				?>
			</div><!-- .entry-content -->
		</section><!-- .error-404 -->
	</main><!-- .content -->

	<?php get_sidebar(); ?>

</div><!-- .content-sidebar-wrap -->
<?php

get_footer();
