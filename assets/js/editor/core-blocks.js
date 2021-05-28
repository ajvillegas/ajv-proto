/**
 * Core block modifications and tweaks.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

wp.domReady( function() {

	// Unregister core blocks.
	wp.blocks.unregisterBlockType( 'core/verse' );

	// Remove block styles.
	wp.blocks.unregisterBlockStyle(
		'core/quote',
		[ 'large' ]
	);
});
