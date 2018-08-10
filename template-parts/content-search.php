<?php
/**
 * Template part for displaying results in search pages.
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
		the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

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

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php ajv_proto_entry_footer(); ?>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
