/**
 * JS functionality for the theme's admin.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

( function( $ ) {
	'use strict';

	$( document ).ready( function() {

		/**
		 * Layout Settings meta box functionality.
		 *
		 * @since	1.0.0
		 */

		// Add .selected class if a layout input is checked.
		$( '#ajv-proto-layout-meta-box input[type="radio"]' )
			.filter( ':checked' )
			.each( function( index ) {
				$( this )
					.parent( 'label' )
					.addClass( 'selected' );
			});

		// Remove current .selected class then add to new selected layout.
		$( '#ajv-proto-layout-meta-box .box' ).on( 'change', function() {

			// Remove class from label.
			$( 'input[name="' + $( event.target ).attr( 'name' ) + '"]' )
				.parent( 'label' )
				.removeClass( 'selected' );

			// Add class to selected layout.
			$( event.currentTarget ).addClass( 'selected' );
		});
	});
}( jQuery ) );
