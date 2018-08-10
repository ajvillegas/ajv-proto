<?php
/**
 * Defines all the theme constants.
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

// Get the theme object.
$theme = wp_get_theme();

/** Define Theme Constants */

// @type constant Theme Name, used in footer.
if ( ! defined( 'AJV_PROTO_THEME_NAME' ) ) {
	define( 'AJV_PROTO_THEME_NAME', $theme->get( 'Name' ) );
}

// @type constant Theme URL, used in footer.
if ( ! defined( 'AJV_PROTO_THEME_URL' ) ) {
	define( 'AJV_PROTO_THEME_URL', $theme->get( 'ThemeURI' ) );
}

// @type constant Theme Version.
if ( ! defined( 'AJV_PROTO_THEME_VERSION' ) ) {
	define( 'AJV_PROTO_THEME_VERSION', $theme->get( 'Version' ) );
}

// @type constant Text Domain.
if ( ! defined( 'AJV_PROTO_THEME_TEXTDOMAIN' ) ) {
	define( 'AJV_PROTO_THEME_TEXTDOMAIN', $theme->get( 'TextDomain' ) );
}

/** Define Developer Information */

// @type constant Theme Developer, used in footer.
if ( ! defined( 'AJV_PROTO_DEVELOPER' ) ) {
	define( 'AJV_PROTO_DEVELOPER', $theme->get( 'Author' ) );
}

// @type constant Theme Developer URL, used in footer.
if ( ! defined( 'AJV_PROTO_DEVELOPER_URL' ) ) {
	define( 'AJV_PROTO_DEVELOPER_URL', $theme->{'Author URI'} );
}

/** Define Directory Location Constants */

// @type constant Theme lib folder location.
if ( ! defined( 'AJV_PROTO_INC_DIR' ) ) {
	define( 'AJV_PROTO_INC_DIR', get_template_directory() . '/inc' );
}

// @type constant Theme images folder location.
if ( ! defined( 'AJV_PROTO_IMAGES_DIR' ) ) {
	define( 'AJV_PROTO_IMAGES_DIR', get_template_directory() . '/assets/images' );
}

// @type constant Theme js folder location.
if ( ! defined( 'AJV_PROTO_JS_DIR' ) ) {
	define( 'AJV_PROTO_JS_DIR', get_template_directory() . '/assets/js' );
}

// @type constant Theme css folder location.
if ( ! defined( 'AJV_PROTO_CSS_DIR' ) ) {
	define( 'AJV_PROTO_CSS_DIR', get_template_directory() . '/assets/css' );
}

/** Define URL Location Constants */

// @type constant Theme lib URL location.
if ( ! defined( 'AJV_PROTO_INC' ) ) {
	define( 'AJV_PROTO_INC', get_template_directory_uri() . '/inc' );
}

// @type constant Theme images URL location.
if ( ! defined( 'AJV_PROTO_IMAGES' ) ) {
	define( 'AJV_PROTO_IMAGES', get_template_directory_uri() . '/assets/images' );
}

// @type constant Theme js URL location.
if ( ! defined( 'AJV_PROTO_JS' ) ) {
	define( 'AJV_PROTO_JS', get_template_directory_uri() . '/assets/js' );
}

// @type constant Theme css URL location.
if ( ! defined( 'AJV_PROTO_CSS' ) ) {
	define( 'AJV_PROTO_CSS', get_template_directory_uri() . '/assets/css' );
}
