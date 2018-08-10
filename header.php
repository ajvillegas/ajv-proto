<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div class="site-inner">.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @license    GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!doctype html>
<html <?php language_attributes( 'html' ); ?> class="no-js">
<head itemscope="" itemtype="https://schema.org/WebSite">
	<!-- Replace no-js class in <html> tag if JS is loaded -->
	<script type="text/javascript">(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope="" itemtype="https://schema.org/WebPage">

	<?php if ( is_active_sidebar( 'utility-bar' ) ) : ?>
		<aside id="utility-bar" class="widget-area utility-bar">
			<span class="screen-reader-text"><?php esc_html_e( 'Utility Bar', 'ajv-proto' ); ?></span>
			<div class="wrap">
				<?php dynamic_sidebar( 'utility-bar' ); ?>
			</div>
		</aside>
	<?php endif; ?>

	<a href="javascript://" class="to-top" title="<?php esc_html_e( 'Back To Top', 'ajv-proto' ); ?>"><?php esc_html_e( 'Top', 'ajv-proto' ); ?></a>

	<div class="site-container">

		<ul class="site-skip-link">
			<li>
				<a class="skip-link screen-reader-text" href="#site-nav-primary"><?php esc_html_e( 'Skip to primary navigation', 'ajv-proto' ); ?></a>
			</li>
			<li>
				<a class="skip-link screen-reader-text" href="site-content"><?php esc_html_e( 'Skip to content', 'ajv-proto' ); ?></a>
			</li>
			<li>
				<a class="skip-link screen-reader-text" href="#site-sidebar-primary"><?php esc_html_e( 'Skip to primary sidebar', 'ajv-proto' ); ?></a>
			</li>
			<li>
				<a class="skip-link screen-reader-text" href="#site-footer-widgets"><?php esc_html_e( 'Skip to footer', 'ajv-proto' ); ?></a>
			</li>
		</ul>

		<header class="site-header" itemscope="" itemtype="https://schema.org/WPHeader">
			<div class="wrap">
				<div class="title-area">
					<?php
					if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) :
						?>
						<span class="screen-reader-text"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
						<?php

						the_custom_logo();
					else :
						?>
						<p class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</p>
						<?php
					endif;

					$ajv_proto_description = get_bloginfo( 'description', 'display' );
					$screen_reader_text    = function_exists( 'has_custom_logo' ) && has_custom_logo() ? ' screen-reader-text' : '';

					if ( $ajv_proto_description || is_customize_preview() ) :
						?>
						<p class="site-description<?php echo $screen_reader_text; /* WPCS: xss ok. */ ?>"><?php echo $ajv_proto_description; /* WPCS: xss ok. */ ?></p>
						<?php
					endif;
					?>
				</div><!-- .title-area -->

				<?php if ( is_active_sidebar( 'header-widget' ) ) : ?>
					<div class="widget-area header-widget-area">
						<span class="screen-reader-text"><?php esc_html_e( 'Header Widget Area', 'ajv-proto' ); ?></span>
						<?php dynamic_sidebar( 'header-widget' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</header><!-- .site-header -->

		<nav id="site-nav-primary" class="nav-primary" aria-label="Main" itemscope="" itemtype="https://schema.org/SiteNavigationElement">
			<div class="wrap">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_id'        => 'menu-primary-menu',
					'menu_class'     => 'site-nav-menu menu-primary js-superfish',
				) );
				?>
			</div>
		</nav><!-- #site-nav-primary -->

		<div class="site-inner">
