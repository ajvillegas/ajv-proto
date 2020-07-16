<?php
/**
 * Template part for displaying the Color Palette page template content.
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

// Theme colors.
$primary_color    = '#4173bb';
$secondary_color  = '#333333';
$tertiary_color   = '#34b79d';
$background_color = '#ffffff';

$dark_gray       = '#333333';
$medium_gray     = '#767676';
$light_gray      = '#dddddd';
$very_light_gray = '#f9f9f9';

$alert_color   = '#fff6bf';
$error_color   = '#fbe3e4';
$notice_color  = '#e5edf8';
$success_color = '#e6efc2';

?>
<article id="colors" class="entry">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
	</header>

	<div class="entry-content color-palette">
		<section class="section">
			<h3>Main Colors</h3>

			<div class="colorgroup">
				<div class="color -primary">
					<div class="info">
						<span class="heading">Primary</span>
						<span class="value">
							<?php
							list($r, $g, $b) = sscanf( $primary_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $primary_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>

				<div class="color -secondary">
					<div class="info">
						<span class="heading">Secondary</span>
						<span class="value">
							<?php
							list($r, $g, $b) = sscanf( $secondary_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $secondary_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>

				<div class="color -tertiary">
					<div class="info">
						<span class="heading">Tertiary</span>
						<span class="value">
							<?php
							list($r, $g, $b) = sscanf( $tertiary_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $tertiary_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>

				<div class="color -background">
					<div class="info">
						<span class="heading">Background</span>
						<span class="value">
							<?php
							list($r, $g, $b) = sscanf( $background_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $background_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>
			</div>
		</section>

		<section class="section">
			<h3>Text</h3>

			<div class="textgroup">
				<div class="color -primary">
					<p><span class="background">Lorem ipsum dolor sit amet, consectetur.</span><br>
					<span class="secondary">Pellentesque interdum arcu eu velit consequat.</span></p>
				</div>

				<div class="color -secondary">
					<p><span class="background">Lorem ipsum dolor sit amet,</span> <span class="tertiary">consectetur</span><span class="background">.</span><br>
					<span class="primary">Pellentesque interdum arcu eu velit consequat.</span></p>
				</div>
			</div>

			<div class="textgroup">
				<div class="color -tertiary">
					<p><span class="background">Lorem ipsum dolor sit amet, consectetur.</span><br>
					<span class="secondary">Pellentesque interdum arcu eu velit consequat.</span></p>
				</div>

				<div class="color -background">
					<p><span class="secondary">Lorem ipsum dolor sit amet,</span> <span class="tertiary">consectetur</span><span class="secondary">.</span><br>
					<span class="primary">Pellentesque interdum arcu eu velit consequat.</span></p>
				</div>
			</div>
		</section>

		<section class="section">
			<h3>Gray Tones</h3>

			<div class="colorgroup">
				<div class="color -darkgray">
					<div class="info">
						<span class="heading">Dark Gray</span>
						<span class="value">
							<?php
							list($r, $g, $b) = sscanf( $dark_gray, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $dark_gray ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>

				<div class="color -mediumgray">
					<div class="info">
						<span class="heading">Medium Gray</span>
						<span class="value">
							<?php
							list($r, $g, $b) = sscanf( $medium_gray, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $medium_gray ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>

				<div class="color -lightgray">
					<div class="info">
						<span class="heading">Light Gray</span>
						<span class="value">
							<?php
							list($r, $g, $b) = sscanf( $light_gray, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $light_gray ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>

				<div class="color -verylightgray">
					<div class="info">
						<span class="heading">Very Light Gray</span>
						<span class="value">
							<?php
							list($r, $g, $b) = sscanf( $very_light_gray, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $very_light_gray ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>
			</div>
		</section>

		<section class="section">
			<h3>Badge Colors</h3>

			<div class="colorgroup">
				<div class="color -alert">
					<div class="info">
						<span class="heading">Alert</span>
						<span class="value">
							<?php
							list($r, $g, $b) = sscanf( $alert_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $alert_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>

				<div class="color -error">
					<div class="info">
						<span class="heading">Error</span>
						<span class="value">
							<?php
							list($r, $g, $b) = sscanf( $error_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $error_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>

				<div class="color -notice">
					<div class="info">
						<span class="heading">Notice</span>
						<span class="value">
							<?php
							list($r, $g, $b) = sscanf( $notice_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $notice_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>

				<div class="color -success">
					<div class="info">
						<span class="heading">Success</span>
						<span class="value">
							<?php
							list($r, $g, $b) = sscanf( $success_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $success_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>
			</div>
		</section>
	</div>
</article>
<?php
