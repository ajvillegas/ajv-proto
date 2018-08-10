<?php
/**
 * Template part for displaying posts.
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
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				ajv_proto_posted_on();
				ajv_proto_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php ajv_proto_post_thumbnail(); ?>

	<div class="entry-content" itemprop="text">
		<?php
		if ( is_singular() ) :

			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ajv-proto' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

		else :

			the_excerpt();

		endif;

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ajv-proto' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php ajv_proto_entry_footer(); ?>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
