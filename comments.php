<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
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

/*
 * Bail if the current post is protected by a password and
 * the visitor has not yet entered the password.
 */
if ( post_password_required() ) {
	return;
}

?>
<h2 class="screen-reader-text"><?php esc_html_e( 'Reader Comments', 'ajv-proto' ); ?></h2>
<div id="comments" class="entry-comments">

	<?php
	if ( have_comments() ) :
		?>
		<h3 class="comments-title">
			<?php
			$ajv_proto_comment_count = get_comments_number();

			if ( '1' === $ajv_proto_comment_count ) {
				echo esc_html__( 'One Comment', 'ajv-proto' );
			} else {
				printf( // WPCS: XSS OK.
					/* translators: comment count number. */
					esc_html( _nx( '%s Comment', '%s Comments', $ajv_proto_comment_count, 'comments title', 'ajv-proto' ) ),
					number_format_i18n( $ajv_proto_comment_count )
				);
			}
			?>
		</h3><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 60,
			) );
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'ajv-proto' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form();
	?>

</div><!-- #comments -->
