<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
			breadcrumb_trail(
				array(
					'show_on_front' => false,
					'labels'        => array(
						'browse' => esc_html__( 'You are here:', 'ajv-proto' ),
					),
				)
			);
		}

		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header class="page-header">
					<div class="archive-description">
						<h1 class="archive-title" itemprop="headline"><?php single_post_title(); ?></h1>
					</div>
				</header>
				<?php
			endif;

			while ( have_posts() ) :

				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

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
