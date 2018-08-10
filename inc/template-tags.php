<?php
/**
 * Custom theme template tags.
 *
 * Included by functions.php.
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

if ( ! function_exists( 'ajv_proto_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 *
	 * @since 1.0.0
	 */
	function ajv_proto_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		echo '<span class="posted-on">' . $time_string . '</span>'; // WPCS: xss ok.

	}
}

if ( ! function_exists( 'ajv_proto_posted_by' ) ) {
	/**
	 * Prints HTML with meta information for the current author and comments.
	 *
	 * @since 1.0.0
	 */
	function ajv_proto_posted_by() {

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html__( 'by %s', 'ajv-proto' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span> '; // WPCS: xss ok.

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			if ( get_comments_number() > 0 ) {

				echo '<span class="comments-link"><span class=svg-icon>' . ajv_proto_get_icon( 'admin-comments' ) . '</span>'; // WPCS: XSS ok.
					comments_popup_link( '' );
				echo '</span>';

			}
		}

	}
}

if ( ! function_exists( 'ajv_proto_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories and tags.
	 *
	 * @since 1.0.0
	 */
	function ajv_proto_entry_footer() {

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'ajv-proto' ) );

			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"><span class=svg-icon>%1$s</span>' . esc_html__( 'Filed Under: %2$s', 'ajv-proto' ) . '</span>',
					ajv_proto_get_icon( 'category' ),
					$categories_list
				); // WPCS: xss ok.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'ajv-proto' ) );

			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links"><span class=svg-icon>%1$s</span>' . esc_html__( 'Tagged With: %2$s', 'ajv-proto' ) . '</span>',
					ajv_proto_get_icon( 'tag' ),
					$tags_list
				); // WPCS: xss ok.
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'ajv-proto' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<div class="edit-link">',
			'</div>'
		);

	}
}

if ( ! function_exists( 'ajv_proto_post_thumbnail' ) ) {
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @since 1.0.0
	 */
	function ajv_proto_post_thumbnail() {

		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) {

			?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php

		} else {

			?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail( 'post-thumbnail', array(
					'alt' => the_title_attribute( array(
						'echo' => false,
					) ),
				) );
				?>
			</a>
			<?php

		}

	}
}

if ( ! function_exists( 'ajv_proto_archive_pagination' ) ) {
	/**
	 * Display numerical or prev/next archive pagination links.
	 *
	 * @since 1.0.0
	 * @param string $pagination The pagination style.
	 */
	function ajv_proto_archive_pagination( $pagination = 'numeric' ) {

		if ( 'numeric' === $pagination ) {

			$args = array(
				'prev_text' => '&laquo; ' . esc_html__( 'Previous Page', 'ajv-proto' ),
				'next_text' => esc_html__( 'Next Page', 'ajv-proto' ) . ' &raquo;',
			);

			?>
			<div class="archive-pagination pagination">
				<?php echo wp_kses_post( paginate_links( $args ) ); ?>
			</div>
			<?php

		} elseif ( 'prev-next' === $pagination ) {

			?>
			<div class="archive-pagination pagination">
				<div class="pagination-previous alignleft">
					<?php previous_posts_link( '&laquo; ' . esc_html__( 'Previous Page', 'ajv-proto' ) ); ?>
				</div>

				<div class="pagination-next alignright">
					<?php next_posts_link( esc_html__( 'Next Page', 'ajv-proto' ) . ' &raquo;' ); ?>
				</div>
			</div>
			<?php

		}

	}
}

if ( ! function_exists( 'ajv_proto_get_sitemap' ) ) {
	/**
	 * Generate markup for an HTML sitemap.
	 *
	 * @since 1.0.0
	 * @param string $heading Heading element; defaults to `h2`.
	 * @return string $sitemap Sitemap content.
	 */
	function ajv_proto_get_sitemap( $heading = 'h2' ) {

		$sitemap  = sprintf( '<%2$s>%1$s</%2$s>', esc_html__( 'Pages:', 'ajv-proto' ), $heading );
		$sitemap .= sprintf( '<ul>%s</ul>', wp_list_pages( 'title_li=&echo=0' ) );

		$post_counts = wp_count_posts();

		// Only display if there are published posts.
		if ( $post_counts->publish > 0 ) {

			$sitemap .= sprintf( '<%2$s>%1$s</%2$s>', esc_html__( 'Categories:', 'ajv-proto' ), $heading );
			$sitemap .= sprintf( '<ul>%s</ul>', wp_list_categories( 'sort_column=name&title_li=&echo=0' ) );

			$sitemap .= sprintf( '<%2$s>%1$s</%2$s>', esc_html__( 'Authors:', 'ajv-proto' ), $heading );
			$sitemap .= sprintf( '<ul>%s</ul>', wp_list_authors( 'exclude_admin=0&optioncount=1&echo=0' ) );

			$sitemap .= sprintf( '<%2$s>%1$s</%2$s>', esc_html__( 'Monthly:', 'ajv-proto' ), $heading );
			$sitemap .= sprintf( '<ul>%s</ul>', wp_get_archives( 'type=monthly&echo=0' ) );

			$sitemap .= sprintf( '<%2$s>%1$s</%2$s>', esc_html__( 'Recent Posts:', 'ajv-proto' ), $heading );
			$sitemap .= sprintf( '<ul>%s</ul>', wp_get_archives( 'type=postbypost&limit=100&echo=0' ) );

		}

		return $sitemap;

	}
}
