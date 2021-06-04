<?php
/**
 * Theme setup and main functions.
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

if ( ! function_exists( 'ajv_proto_theme_setup' ) ) {
	add_action( 'after_setup_theme', 'ajv_proto_theme_setup' );
	/**
	 * Setup theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 1.0.0
	 */
	function ajv_proto_theme_setup() {

		// Set theme localizations.
		load_theme_textdomain( 'ajv-proto', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress provide the document <title> tag.
		add_theme_support( 'title-tag' );

		// Add support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive media embeds.
		add_theme_support( 'responsive-embeds' );

		// Adds support for editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name' => __( 'Small', 'ajv-proto' ),
					'size' => 18,
					'slug' => 'small',
				),
				array(
					'name' => __( 'Normal', 'ajv-proto' ),
					'size' => 20,
					'slug' => 'normal',
				),
				array(
					'name' => __( 'Large', 'ajv-proto' ),
					'size' => 24,
					'slug' => 'large',
				),
				array(
					'name' => __( 'Larger', 'ajv-proto' ),
					'size' => 26,
					'slug' => 'larger',
				),
			)
		);

		// Adds support for editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary Color', 'ajv-proto' ),
					'slug'  => 'primary',
					'color' => '#4173bb',
				),
				array(
					'name'  => __( 'Secondary Color', 'ajv-proto' ),
					'slug'  => 'secondary',
					'color' => '#333',
				),
				array(
					'name'  => __( 'Tertiary Color', 'ajv-proto' ),
					'slug'  => 'tertiary',
					'color' => '#34b79d',
				),
			)
		);

		// Disable editor color gradients.
		add_theme_support( 'disable-custom-gradients' );
		add_theme_support( 'editor-gradient-presets', array() );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		add_editor_style( "assets/css/editor-style{$suffix}.css" );

		// Enable selective refresh for widgets in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Enable HTML5 markup for search form, comment form, and comments.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add support for theme logo.
		add_theme_support(
			'custom-logo',
			array(
				'width'       => 300,
				'height'      => 56,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		/**
		 * Add support for Layout Settings.
		 *
		 * See /inc/layouts.php and /inc/customizer/register-settings.php.
		 *
		 * This enables the Layout Settings control in the Customizer and
		 * the Layout Settings meta box in post types.
		 */
		add_theme_support( 'ajv-proto-layouts' );

		// Add post type support for the Layout Settings meta box (see /inc/layouts.php).
		add_post_type_support( 'post', 'ajv-proto-layouts' );
		add_post_type_support( 'page', 'ajv-proto-layouts' );

		// Register wp_nav_menu() locations.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'ajv-proto' ),
				'footer'  => esc_html__( 'Footer', 'ajv-proto' ),
			)
		);

		// Add image sizes.
		add_image_size( 'featured-image', 800, 400, true );

	}
}

add_filter( 'image_size_names_choose', 'ajv_proto_custom_image_sizes' );
/**
 * Add new image sizes to list of default image sizes so
 * wp_prepare_attachment_for_js() and JS can access them.
 *
 * @since 1.2.0
 * @param  array $size_names An array containing default image sizes and their names.
 * @return array $size_names Merged array containing new image sizes and their names.
 */
function ajv_proto_custom_image_sizes( $size_names ) {

	// Add new image sizes to array.
	$new_size_names = array(
		'featured-image' => esc_html__( 'Featured Image', 'ajv-proto' ),
	);

	// Combine the two arrays.
	$size_names = array_merge( $new_size_names, $size_names );

	return $size_names;

}

// Remove all the edit post button when logged in.
add_filter( 'ajv_proto_display_edit_post_link', '__return_false' );

add_action( 'after_setup_theme', 'ajv_proto_content_width', 0 );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since 1.0.0
 * @global int  $content_width
 */
function ajv_proto_content_width() {

	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound.
	$GLOBALS['content_width'] = apply_filters( 'ajv_proto_content_width', 1140 );

}

add_filter( 'document_title_separator', 'ajv_proto_title_tag_separator' );
/**
 * Filter the WordPress document <title> separator.
 *
 * Might not be necessary when using an SEO plugin.
 *
 * @since 1.0.0
 * @param string $separator Default document title separator.
 * @return string $separator Amended document title separator.
 */
function ajv_proto_title_tag_separator( $separator ) {

	$separator = '|';

	return $separator;

}

add_filter( 'ajv_proto_default_content_layout', 'ajv_proto_set_default_layout' );
/**
 * Set the default theme content layout.
 *
 * See /inc/layouts.php.
 *
 * @since 1.0.0
 * @param string $layout The current default layout.
 * @return string $layout The new default layout.
 */
function ajv_proto_set_default_layout( $layout ) {

	// Define the default layout.
	$default_layout = get_theme_mod( 'ajv_proto_default_layout' ) ? get_theme_mod( 'ajv_proto_default_layout' ) : 'content-sidebar';

	$layout = $default_layout;

	return $layout;

}

add_filter( 'body_class', 'ajv_proto_body_classes' );
/**
 * Add custom classes to the array of body classes.
 *
 * @since 1.0.0
 * @param array $classes Array of classes applied to the body class attribute.
 * @return array $classes The updated array of classes applied to the body class attribute.
 */
function ajv_proto_body_classes( $classes ) {

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class to single post page pages.
	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	return $classes;

}

add_filter( 'body_class', 'ajv_proto_blocks_body_classes' );
/**
 * Add custom body classes to help with block styling.
 *
 * - `has-no-blocks` if content contains no blocks.
 * - `first-block-[block-name]` to allow changes based on the first block (such as removing padding above a Cover block).
 * - `first-block-align-[alignment]` to allow styling adjustment if the first block is wide or full-width.
 * - `last-block-align-[alignment]` to allow styling adjustment if the last block is wide or full-width.
 *
 * @since 1.2.0
 * @param array $classes Array of classes applied to the body class attribute.
 * @return array $classes The updated array of classes applied to the body class attribute.
 */
function ajv_proto_blocks_body_classes( $classes ) {

	if ( ! is_singular() || ! function_exists( 'has_blocks' ) || ! function_exists( 'parse_blocks' ) ) {
		return $classes;
	}

	if ( ! has_blocks() ) {
		$classes[] = 'has-no-blocks';
		return $classes;
	}

	$post_object = get_post( get_the_ID() );
	$blocks      = (array) parse_blocks( $post_object->post_content );

	if ( isset( $blocks[0]['blockName'] ) ) {
		$classes[] = 'first-block-' . str_replace( '/', '-', $blocks[0]['blockName'] );
	}

	if ( isset( $blocks[0]['attrs']['align'] ) ) {
		$classes[] = 'first-block-align-' . $blocks[0]['attrs']['align'];
	}

	if ( isset( end( $blocks )['attrs']['align'] ) ) {
		$classes[] = 'last-block-align-' . end( $blocks )['attrs']['align'];
	}

	return $classes;

}

add_action( 'wp_head', 'ajv_proto_pingback_header' );
/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 *
 * @since 1.0.0
 */
function ajv_proto_pingback_header() {

	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}

}

add_filter( 'frontpage_template', 'ajv_proto_front_page_template' );
/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since 1.0.0
 * @link https://codex.wordpress.org/Creating_a_Static_Front_Page
 * @param string $template front-page.php.
 * @return string $template The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function ajv_proto_front_page_template( $template ) {

	return is_home() ? '' : $template;

}

add_filter( 'comment_form_defaults', 'ajv_proto_filter_comment_form_args' );
/**
 * Filter the comment form default arguments.
 *
 * @since 1.0.0
 * @link https://codex.wordpress.org/Function_Reference/comment_form
 * @param array $defaults Existing array of comment form options.
 * @return array $defaults Amended array of comment form options.
 */
function ajv_proto_filter_comment_form_args( $defaults ) {

	$defaults['comment_notes_after'] = ''; // Comment form allowed tags.
	$defaults['title_reply']         = esc_html__( 'Add a Comment', 'ajv-proto' ); // Reply title.

	return $defaults;

}

add_action( 'get_the_archive_title', 'ajv_proto_filter_archive_title' );
/**
 * Filter the default archive titles.
 *
 * @since 1.2.0
 * @param string $title The current archive title.
 * @return string $title The amended archive title.
 */
function ajv_proto_filter_archive_title( $title ) {

	if ( is_home() ) {
		$title = get_the_title( get_option( 'page_for_posts', true ) );
	} elseif ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}

	return $title;

}

add_action( 'protected_title_format', 'ajv_proto_remove_protected_title_prefix' );
/**
 * Filter the text prepended to the post title for protected posts.
 *
 * @since 1.2.0
 * @param string $format The text displayed before the post title.
 * @return string
 */
function ajv_proto_remove_protected_title_prefix( $format ) {

	$format = __( '%s', 'ajv-proto' ); // phpcs:ignore

	return $format;

}

add_filter( 'wp_trim_words', 'ajv_proto_filter_wp_trim_words', 11, 4 );
/**
 * Filter the excerpt's "read more" link anchor text.
 *
 * This function adds a "read more" link when there is no text
 * or the content is too short.
 *
 * @since 1.2.0
 * @param string $text The trimmed text.
 * @param int    $num_words The number of words to trim the text to.
 * @param string $more An optional string to append to the end of the trimmed text.
 * @param string $original_text The text before it was trimmed.
 * @return string $text Amended trimmed text.
 */
function ajv_proto_filter_wp_trim_words( $text, $num_words, $more, $original_text ) {

	$text = mb_substr( $text, -1 * mb_strlen( $more ) ) === $more ? $text : $text . $more;

	return $text;

}

add_filter( 'excerpt_more', 'ajv_proto_excerpt_more' );
/**
 * Filter the excerpt's "read more" link anchor text.
 *
 * @since 1.0.0
 * @param string $more_string Current "read more" excerpt string.
 * @return string $more_string Amended "read more" excerpt string.
 */
function ajv_proto_excerpt_more( $more_string ) {

	$more_string = ' [...] ' . sprintf(
		'<a class="more-link" href="%1$s">%2$s</a>',
		get_permalink( get_the_ID() ),
		esc_html__( 'Read More', 'ajv-proto' ) . '<span class="screen-reader-text">' . esc_html__( 'about', 'ajv-proto' ) . ' ' . get_the_title() . '</span>'
	);

	return $more_string;

}

add_filter( 'get_the_excerpt', 'ajv_proto_manual_excerpt_more' );
/**
 * Filter the retrieved post excerpt.
 *
 * This function adds a "read more" link to the manual excerpt.
 *
 * @since 1.0.0
 * @param string $post_excerpt The post excerpt.
 * @return string $post_excerpt The modified post excerpt.
 */
function ajv_proto_manual_excerpt_more( $post_excerpt ) {

	if ( has_excerpt() ) {
		$more_string = sprintf(
			'<a class="more-link" href="%1$s">%2$s</a>',
			get_permalink( get_the_ID() ),
			esc_html__( 'Read More', 'ajv-proto' ) . '<span class="screen-reader-text">' . esc_html__( 'about', 'ajv-proto' ) . ' ' . get_the_title() . '</span>'
		);

		return $post_excerpt . $more_string;
	} else {
		return $post_excerpt;
	}

}

add_filter( 'excerpt_length', 'ajv_proto_excerpt_length' );
/**
 * Filter the number of words in an excerpt (default 55).
 *
 * @since 1.0.0
 * @param int $number The default number of words.
 * @return int $number The amended number of words.
 */
function ajv_proto_excerpt_length( $number ) {

	return 20;

}

add_filter( 'nav_menu_css_class', 'ajv_proto_blog_menu_item_classes', 10, 3 );
/**
 * Customize menu item classes for blog pots.
 *
 * @since 1.0.0
 * @param array  $classes Current menu classes.
 * @param object $item Current menu item.
 * @param object $args Menu arguments.
 * @return array $classes Modified menu classes.
 */
function ajv_proto_blog_menu_item_classes( $classes, $item, $args ) {

	if ( ( is_singular( 'post' ) || is_category() || is_tag() ) && 'Blog' === $item->title ) {
		$classes[] = 'current-menu-item';
	}

	return array_unique( $classes );

}

// phpcs:ignore
// add_filter( 'pre_get_posts', 'ajv_proto_ignore_sticky_posts' );
/**
 * Filter the query variable object before the actual query is run.
 *
 * This function removes support for sticky posts to prevent issues with
 * the grid style loop and the number of posts being shown on a page.
 *
 * @since 1.2.0
 * @param object $query The WP_Query instance (passed by reference).
 */
function ajv_proto_ignore_sticky_posts( $query ) {

	/**
	 * Not a query for an admin page and it's the main query
	 * for a front end page of your site.
	 */
	if ( ! is_admin() && $query->is_main_query() ) {
		$query->set( 'ignore_sticky_posts', 1 );
	}

}

add_shortcode( 'year', 'ajv_proto_register_year_shortcode' );
/**
 * Register "year" shortcode.
 *
 * This function registers a shortcode that displays the current year.
 * Useful for displaying the year in the footer credits section.
 *
 * @since 1.0.0
 */
function ajv_proto_register_year_shortcode() {

	$year = date_i18n( 'Y' );

	return $year;

}
