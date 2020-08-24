/**
 * JS functionality for the block editor.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

wp.domReady( () => {
	// Unregister core blocks.
	wp.blocks.unregisterBlockType( 'core/verse' );

	// Remove block styles.
	wp.blocks.unregisterBlockStyle(
		'core/quote',
		[ 'large' ]
	);

	// Start in a checked state.
	var checked = true;

	// Trigger side effect after block editor is done saving meta box values.
	wp.data.subscribe( () => {
		const isSavingMetaBoxes = wp.data.select( 'core/edit-post' ).isSavingMetaBoxes();

		if ( isSavingMetaBoxes ) {
			checked = false;
		} else {
			if ( ! checked ) {
				// Get the meta box input.
				const metaboxInput = document.querySelector( '#ajv-proto-layout-meta-box .selected input[type="radio"]' );
				// If meta box input, get its value.
				const metaboxValue = metaboxInput ? metaboxInput.value : 'default-layout';
				// Get the meta value from the database.
				const databaseValue = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'meta')['_ajv_proto_post_layout'];

				// Check if values are different.
				if ( metaboxValue !== databaseValue ) {
					// Reload the page from the server.
					window.location.reload( true );
				}

				checked = true;
			}
		}
	} );

	// Trigger side effect after block editor is done saving the post.
	/* wp.data.subscribe( () => {
		const isSavingPost = wp.data.select( 'core/editor' ).isSavingPost();

		if ( isSavingPost ) {
			checked = false;
		} else {
			if ( ! checked ) {
				console.log( 'Done saving post.' );
				checked = true;
			}
		}
	} ); */
} );
