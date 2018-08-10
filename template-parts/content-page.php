<?php
/**
 * Template part for displaying page content.
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

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?> itemscope="" itemtype="https://schema.org/CreativeWork">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php ajv_proto_post_thumbnail(); ?>

	<div class="entry-content" itemprop="text">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ajv-proto' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'ajv-proto' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
