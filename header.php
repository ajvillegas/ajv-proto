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
<head itemscope itemtype="https://schema.org/WebSite">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Replace no-js class in <html> tag if JS is loaded -->
	<script type="text/javascript">(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

	<?php if ( is_active_sidebar( 'utility-bar' ) ) : ?>
		<aside id="utility-bar" class="widget-area utility-bar">
			<span class="screen-reader-text"><?php echo esc_html__( 'Utility Bar', 'ajv-proto' ); ?></span>
			<div class="wrap">
				<?php dynamic_sidebar( 'utility-bar' ); ?>
			</div>
		</aside>
	<?php endif; ?>

	<div class="site-container">
		<ul class="skip-links">
			<li>
				<a class="screen-reader-text" href="#primary-nav"><?php echo esc_html__( 'Skip to primary navigation', 'ajv-proto' ); ?></a>
			</li>
			<li>
				<a class="screen-reader-text" href="#site-content"><?php echo esc_html__( 'Skip to content', 'ajv-proto' ); ?></a>
			</li>
			<li>
				<a class="screen-reader-text" href="#sidebar-primary"><?php echo esc_html__( 'Skip to primary sidebar', 'ajv-proto' ); ?></a>
			</li>
			<li>
				<a class="screen-reader-text" href="#footer-widgets"><?php echo esc_html__( 'Skip to footer', 'ajv-proto' ); ?></a>
			</li>
		</ul>

		<header class="site-header" itemscope itemtype="https://schema.org/WPHeader">
			<div class="wrap">
				<div class="title-area">
					<?php
					$html_tag = is_front_page() ? 'h1' : 'p';

					if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) :
						the_custom_logo();

						echo '<' . esc_attr( $html_tag ) . ' class="screen-reader-text">';
							bloginfo( 'name' );
						echo '</' . esc_attr( $html_tag ) . '>';
					else :
						echo '<' . esc_attr( $html_tag ) . ' class="site-title">';
						?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						<?php
						echo '</' . esc_attr( $html_tag ) . '>';

						if ( get_bloginfo( 'description', 'display' ) || is_customize_preview() ) :
							?>
							<p class="site-description"><?php bloginfo( 'description' ); ?></p>
							<?php
						endif;
					endif;
					?>
				</div><!-- .title-area -->

				<?php if ( is_active_sidebar( 'header-widget' ) ) : ?>
					<div class="widget-area header-widget-area">
						<span class="screen-reader-text"><?php echo esc_html__( 'Header Widget Area', 'ajv-proto' ); ?></span>
						<?php dynamic_sidebar( 'header-widget' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</header><!-- .site-header -->

		<nav id="primary-nav" class="primary-nav" aria-label="Main" itemscope itemtype="https://schema.org/SiteNavigationElement">
			<div class="wrap">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span class="navicon"></span>
					<span class="screen-reader-text"><?php echo esc_html__( 'Menu', 'ajv-proto' ); ?></span>
				</button>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'link_before'    => '<span>',
						'link_after'     => '</span>',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'site-menu primary',
					)
				);
				?>
			</div>
		</nav><!-- #primary-nav -->

		<div class="site-inner">
