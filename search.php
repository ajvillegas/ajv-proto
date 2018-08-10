<?php
/**
 * The template for displaying search results pages.
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

		if ( have_posts() ) :

			?>
			<header class="entry-header">
				<div class="archive-description">
					<h1 class="archive-title" itemprop="headline">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'ajv-proto' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</div>
			</header><!-- .page-header -->
			<?php

			while ( have_posts() ) :

				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to override this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile; // End of the loop.

			ajv_proto_archive_pagination( 'numeric' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- .content -->

	<?php get_sidebar(); ?>

</div><!-- .content-sidebar-wrap -->
<?php

get_footer();
