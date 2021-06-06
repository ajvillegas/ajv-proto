<?php
/**
 * Custom 'Posts Grid' dynamic block.
 *
 * Included by inc/dynamic-blocks/register-blocks.php.
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

add_action( 'init', 'ajv_proto_register_post_grid_block' );
/**
 * Reister the Posts Grid dynamic block.
 *
 * @since 1.2.0
 */
function ajv_proto_register_post_grid_block() {

	// Bail if block editor is not available.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	register_block_type(
		'ajv-proto/posts-grid',
		array(
			'attributes'      => array(
				'childWidth'    => array(
					'type'    => 'number',
					'default' => 250,
				),
				'postsPerBlock' => array(
					'type'    => 'number',
					'default' => 4,
				),
			),
			'render_callback' => 'ajv_proto_render_post_grid_block',
		)
	);

}

/**
 * Render the Posts Grid dynamic block.
 *
 * @since 1.2.0
 * @param array  $attributes The block attributes.
 * @param string $content The block content.
 * @return string
 */
function ajv_proto_render_post_grid_block( $attributes, $content ) {

	ob_start();

	?>
	<div class="<?php echo esc_attr( $attributes['className'] ); ?>">
		<?php echo wp_kses_post( $content ); ?>
		<p>Here are the block attributes:</p>
		<ul>
			<li>childWidth: <?php echo esc_html( $attributes['childWidth'] ); ?>px</li>
			<li>postsPerBlock: <?php echo esc_html( $attributes['postsPerBlock'] ); ?></li>
		</ul>
	</div>
	<?php

	$html = ob_get_clean();

	return $html;

}
