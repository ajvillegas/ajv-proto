/**
 * The scrolling functionality of the website.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

( function() {
	function scrollToTop() {
		const element = document.querySelector( 'body' ).offsetTop;

		window.scroll({
			top: element,
			left: 0,
			behavior: 'smooth'
		});
	}

	function scrollClasses() {
		const topButton = document.querySelector( '.to-top' );

		// When the user scrolls down 100px from the top of the document.
		if ( 100 < document.body.scrollTop || 100 < document.documentElement.scrollTop ) {

			// Display scroll button.
			topButton.style.display = 'block';
		} else {

			// Hide scroll button.
			topButton.style.display = 'none';
		}
	}

	// Add click handler to scroll button.
	scrollClasses();
	document.querySelector( '.to-top' ).addEventListener( 'click', scrollToTop, false );

	// When the user scrolls, call function to toggle classes.
	window.onscroll = function() {
		scrollClasses();
	};
}() );
