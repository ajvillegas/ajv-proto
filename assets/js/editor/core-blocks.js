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

// This functions makes the editor fail with `Uncaught TypeError: Cannot read property '_ajv_proto_post_layout' of undefined` error.
/* wp.domReady( function() {

	// Start in a checked state.
	let checked = true;

	// Trigger side effect after block editor is done saving meta box values.
	wp.data.subscribe( function() {
		const isSavingMetaBoxes = wp.data.select( 'core/edit-post' ).isSavingMetaBoxes();

		// Get the meta box input.
		const metaboxInput = document.querySelector( '#ajv-proto-layout-meta-box .selected input[type="radio"]' );

		// If meta box input, get its value.
		const metaboxValue = metaboxInput ? metaboxInput.value : 'default-layout';

		// Get the meta value from the database.
		const databaseValue = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'meta' )._ajv_proto_post_layout;

		if ( isSavingMetaBoxes ) {
			checked = false;
		} else {
			if ( ! checked ) {

				// Check if values are different.
				if ( metaboxValue !== databaseValue ) {

					// Reload the page from the server.
					window.location.reload();
				}

				checked = true;
			}
		}
	});

	// Trigger side effect after block editor is done saving the post.
	//wp.data.subscribe( function() {
	//	const isSavingPost = wp.data.select( 'core/editor' ).isSavingPost();
	//
	//	if ( isSavingPost ) {
	//		checked = false;
	//	} else {
	//		if ( ! checked ) {
	//			console.log( 'Done saving post.' );
	//			checked = true;
	//		}
	//	}
	//} );
}); */
