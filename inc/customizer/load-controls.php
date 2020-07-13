<?php
/**
 * Load custom Customizer controls.
 *
 * Included by customizer.php.
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
 * Load the Image Radio Button custom control.
 */
require_once AJV_PROTO_INC_DIR . '/customizer/controls/class-ajv-proto-image-radio-button.php';

/**
 * Load the TinyMCE custom control.
 */
require_once AJV_PROTO_INC_DIR . '/customizer/controls/class-ajv-proto-tinymce.php';
