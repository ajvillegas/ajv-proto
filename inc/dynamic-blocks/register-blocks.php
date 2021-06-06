<?php
/**
 * Register server-side rendered dynamic blocks.
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

/**
 * Reister the Posts Grid dynamic block.
 */
require_once AJV_PROTO_INC_DIR . '/dynamic-blocks/block-posts-grid.php';
