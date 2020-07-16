<?php
/**
 * This file adds the homepage template to the theme.
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

add_filter( 'body_class', 'ajv_proto_landing_body_class' );
/**
 * Adds a unique class to the body element.
 *
 * @since 1.0.0
 * @param array $classes Array of classes applied to the body class attribute.
 * @return array $classes The updated array of classes applied to the body class attribute.
 */
function ajv_proto_landing_body_class( $classes ) {

	$classes[] = 'theme-homepage';

	return $classes;

}

// Reuse the page.php template.
require_once 'page.php';
