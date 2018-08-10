/**
 * Initialise Superfish with custom arguments.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

jQuery( function ( $ ) {
	
    'use strict';
    
    $( '.js-superfish' ).superfish( {
	    
        'delay': 100, // 0.1 second delay on mouseout.
        'animation': { 'opacity': 'show', 'height': 'show' }, // Default os fade-in and slide-down animation.
        'disableHI': true, // Disable submenu mouseenter delay.
        'dropShadows': false // Disable drop shadows.
        
    } );
    
} );
