<?php
/**
 * Theme Customizer related functionality.
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
 * Load custom Customizer controls.
 */
require_once AJV_PROTO_INC_DIR . '/customizer/load-controls.php';

/**
 * Define Customizer sanitization functions.
 */
require_once AJV_PROTO_INC_DIR . '/customizer/sanitization.php';

/**
 * Register Customizer panels, sections and controls.
 */
require_once AJV_PROTO_INC_DIR . '/customizer/register-settings.php';
