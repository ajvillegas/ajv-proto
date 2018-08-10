<?php
/**
 * The template for displaying all single posts.
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

		while ( have_posts() ) :

			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation( array(
				'prev_text' => '&laquo; %title',
				'next_text' => '%title &raquo;',
			) );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- .content -->

	<?php get_sidebar(); ?>

</div><!-- .content-sidebar-wrap -->
<?php

get_footer();
