/**
 * The widget's TinyMCE visual editor modifications.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */
 
/**
 * Filter the widget's TinyMCE before init function.
 *
 * Defines the custom format select dropdown options for the
 * widget's visual editor TinyMCE instance.
 *
 * @since 1.0.0
 */
(function( $ ) {

	$( document ).on( 'wp-before-tinymce-init', function( id, settings ) {
		
		settings.style_formats = [{
			title: visual_editor_mods.lead_text,
			block: 'p',
			classes: 'lead-text',
			icon: 'icon dashicons-editor-textcolor'
		}, {
			title: visual_editor_mods.code,
			format: 'code',
			icon: 'icon dashicons-editor-code'
		}, {
			title: visual_editor_mods.highlight,
			inline: 'mark',
			icon: 'icon dashicons-admin-customizer'
		}, {
			title: visual_editor_mods.label_link,
			selector: 'a',
			classes: 'label-link',
			icon: 'icon dashicons-admin-links'
		}, {
			title: visual_editor_mods.list_style,
			icon: 'icon dashicons-editor-ul',
			items: [{
				title: visual_editor_mods.list_style_1,
				selector: 'ul',
				classes: 'custom-list-1'
			}, {
				title: visual_editor_mods.list_style_2,
				selector: 'ul',
				classes: 'custom-list-2'
			}]
		}, {
			title: visual_editor_mods.content_box,
			icon: 'icon dashicons-editor-table',
			items: [{
				title: visual_editor_mods.blue,
				block: 'div',
				classes: 'content-box-blue'
			}, {
				title: visual_editor_mods.gray,
				block: 'div',
				classes: 'content-box-gray'
			}, {
				title: visual_editor_mods.green,
				block: 'div',
				classes: 'content-box-green'
			}, {
				title: visual_editor_mods.purple,
				block: 'div',
				classes: 'content-box-purple'
			}, {
				title: visual_editor_mods.red,
				block: 'div',
				classes: 'content-box-red'
			}, {
				title: visual_editor_mods.yellow,
				block: 'div',
				classes: 'content-box-yellow'
			}]
		}];
		
	} );

} ) ( jQuery );
 
/**
 * Filter the widget's TinyMCE setup function.
 *
 * Defines custom buttons, and assigns the toolbar buttons and editor styles
 * for the widget's visual editor TinyMCE instance.
 *
 * @since 1.0.0
 */
(function( $ ) {

	$( document ).on( 'tinymce-editor-setup', function( event, editor ) {
		
	    // Define custom button.
	    editor.addButton( 'ajv_proto_button_links', {
            title: visual_editor_mods.button_title,
            type: 'button',
            icon: 'icon dashicons-migrate',
            onclick: function() {
				editor.windowManager.open( {
				    title: visual_editor_mods.window_title,
				    body: [{
				        type: 'textbox',
				        name: 'text',
				        label: visual_editor_mods.button_text
				    },
				    {
				        type: 'textbox',
				        name: 'url',
				        label: visual_editor_mods.button_url,
				        placeholder: 'http://...',
				    },
				    {
				        type: 'listbox',
				        name: 'target',
				        label: visual_editor_mods.target,
				        'values': [
				            {text: visual_editor_mods.same_window, value: 'target="_self"'},
				            {text: visual_editor_mods.new_window, value: 'target="_blank"'},
				        ]
				    },
				    {
				        type: 'listbox',
				        name: 'size',
				        label: visual_editor_mods.size,
				        'values': [
					        {text: visual_editor_mods.def, value: ''},
				            {text: visual_editor_mods.small, value: 'button-small '},
				            {text: visual_editor_mods.large, value: 'button-large '},
				        ]
				    },
				    {
				        type: 'listbox',
				        name: 'color',
				        label: visual_editor_mods.color,
				        'values': [
					        {text: visual_editor_mods.primary, value: ''},
				            {text: visual_editor_mods.secondary, value: 'button-secondary '},
				            {text: visual_editor_mods.tertiary, value: 'button-tertiary '},
				            {text: visual_editor_mods.ghost, value: 'button-ghost '},
				        ]
				    },
				    {
				        type: 'listbox',
				        name: 'style',
				        label: visual_editor_mods.button_style,
				        'values': [
				            {text: visual_editor_mods.square, value: 'button-square'},
				            {text: visual_editor_mods.round, value: 'button-round'},
				        ]
				    }],
				    onsubmit: function( e ) {
				        editor.insertContent( '<a class="button ' + e.data.size + e.data.color + e.data.style + '" href="' + e.data.url + '"' + e.data.target + '>' + e.data.text + '</a>' );
				    }
				} );
			}
        } );
        
        // Assign toolbar buttons.
	    editor.settings.toolbar1 = 'formatselect,styleselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,strikethrough,hr,ajv_proto_button_links';
	    // editor.settings.toolbar1 = 'formatselect,bold,italic,bullist,numlist,blockquote,link,wp_adv';
	    // editor.settings.toolbar2 = 'styleselect,alignleft,aligncenter,alignright,strikethrough,hr,ajv_proto_button_links';
	    
	    // Assign editor styles.
	    // editor.settings.content_css += ',http://absolute-url/editor-style.min.css';
		editor.settings.content_css += visual_editor_mods.editor_style;
	    
	} );

} ) ( jQuery );
