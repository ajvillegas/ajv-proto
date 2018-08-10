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

$dark_grey       = '#333333';
$medium_grey     = '#767676';
$light_grey      = '#dddddd';
$very_light_grey = '#f9f9f9';

$alert_color   = '#fff6bf';
$error_color   = '#fbe3e4';
$notice_color  = '#e5edf8';
$success_color = '#e6efc2';

?>
<article id="color-palette" class="entry">

	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title" itemprop="headline">', '</h2>' ); ?>
	</header>

	<div class="entry-content">

		<section class="color-section">
			<h3>Main Colors</h3>
			<div class="color-group">
				<div class="primary-color">
					<div class="color-info">
						<span class="color-heading">Primary</span>
						<span class="color-values">
							<?php
							list($r, $g, $b) = sscanf( $primary_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $primary_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>
				<div class="secondary-color">
					<div class="color-info">
						<span class="color-heading">Secondary</span>
						<span class="color-values">
							<?php
							list($r, $g, $b) = sscanf( $secondary_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $secondary_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>
				<div class="accent-color">
					<div class="color-info">
						<span class="color-heading">Tertiary</span>
						<span class="color-values">
							<?php
							list($r, $g, $b) = sscanf( $tertiary_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $tertiary_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>
				<div class="background-color">
					<div class="color-info">
						<span class="color-heading">Background</span>
						<span class="color-values">
							<?php
							list($r, $g, $b) = sscanf( $background_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $background_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>
			</div>
		</section>

		<section class="color-section">
			<h3>Text</h3>
			<div class="color-text-group">
				<div class="primary-color">
					<p><span class="background-color-text">Lorem ipsum dolor sit amet, consectetur.</span><br>
					<span class="secondary-color-text">Pellentesque interdum arcu eu velit consequat.</span></p>
				</div>
				<div class="secondary-color">
					<p><span class="background-color-text">Lorem ipsum dolor sit amet,</span> <span class="accent-color-text">consectetur</span><span class="background-color-text">.</span><br>
					<span class="primary-color-text">Pellentesque interdum arcu eu velit consequat.</span></p>
				</div>
			</div>
			<div class="color-text-group">
				<div class="accent-color">
					<p><span class="background-color-text">Lorem ipsum dolor sit amet, consectetur.</span><br>
					<span class="secondary-color-text">Pellentesque interdum arcu eu velit consequat.</span></p>
				</div>
				<div class="background-color">
					<p><span class="secondary-color-text">Lorem ipsum dolor sit amet,</span> <span class="accent-color-text">consectetur</span><span class="secondary-color-text">.</span><br>
					<span class="primary-color-text">Pellentesque interdum arcu eu velit consequat.</span></p>
				</div>
			</div>
		</section>

		<section class="color-section">
			<h3>Grey Tones</h3>
			<div class="color-group">
				<div class="dark-grey">
					<div class="color-info">
						<span class="color-heading">Dark Grey</span>
						<span class="color-values">
							<?php
							list($r, $g, $b) = sscanf( $dark_grey, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $dark_grey ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>
				<div class="medium-grey">
					<div class="color-info">
						<span class="color-heading">Medium Grey</span>
						<span class="color-values">
							<?php
							list($r, $g, $b) = sscanf( $medium_grey, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $medium_grey ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>
				<div class="light-grey">
					<div class="color-info">
						<span class="color-heading">Light Grey</span>
						<span class="color-values">
							<?php
							list($r, $g, $b) = sscanf( $light_grey, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $light_grey ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>
				<div class="very-light-grey">
					<div class="color-info">
						<span class="color-heading">Very Light Grey</span>
						<span class="color-values">
							<?php
							list($r, $g, $b) = sscanf( $very_light_grey, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $very_light_grey ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>
			</div>
		</section>

		<section class="color-section">
			<h3>Badge Colors</h3>
			<div class="color-group">
				<div class="alert-color">
					<div class="color-info">
						<span class="color-heading">Alert</span>
						<span class="color-values">
							<?php
							list($r, $g, $b) = sscanf( $alert_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $alert_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>
				<div class="error-color">
					<div class="color-info">
						<span class="color-heading">Error</span>
						<span class="color-values">
							<?php
							list($r, $g, $b) = sscanf( $error_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $error_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>
				<div class="notice-color">
					<div class="color-info">
						<span class="color-heading">Notice</span>
						<span class="color-values">
							<?php
							list($r, $g, $b) = sscanf( $notice_color, '#%02x%02x%02x' );
							echo 'HEX: ' . esc_html( $notice_color ) . '<br>RGB: ' . esc_html( "$r $g $b" );
							?>
						</span>
					</div>
				</div>
				<div class="success-color">
					<div class="color-info">
						<span class="color-heading">Success</span>
						<span class="color-values">
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
