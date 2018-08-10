/**
 * TinyMCE plugin for formatting and styling links.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

(function() {
	
    tinymce.PluginManager.add( 'ajv_proto_button_links', function( editor, url ) {
	    
        editor.addButton( 'ajv_proto_button_links', {
            title: 'Insert Button',
            title: 'Insert Button',
            type: 'button',
            icon: 'icon dashicons-migrate',
            onclick: function() {
				editor.windowManager.open( {
				    title: 'Insert Button',
				    body: [{
				        type: 'textbox',
				        name: 'text',
				        label: 'Button Text'
				    },
				    {
				        type: 'textbox',
				        name: 'url',
				        label: 'Button URL',
				        placeholder: 'http://...',
				    },
				    {
				        type: 'listbox',
				        name: 'target',
				        label: 'Target',
				        'values': [
				            {text: 'Same Window', value: 'target="_self"'},
				            {text: 'New Window', value: 'target="_blank"'},
				        ]
				    },
				    {
				        type: 'listbox',
				        name: 'size',
				        label: 'Size',
				        'values': [
					        {text: 'Default', value: ''},
				            {text: 'Small', value: 'button-small '},
				            {text: 'Large', value: 'button-large '},
				        ]
				    },
				    {
				        type: 'listbox',
				        name: 'color',
				        label: 'Color',
				        'values': [
					        {text: 'Primary', value: ''},
				            {text: 'Secondary', value: 'button-secondary '},
				            {text: 'Tertiary', value: 'button-tertiary '},
				            {text: 'Ghost', value: 'button-ghost '},
				        ]
				    },
				    {
				        type: 'listbox',
				        name: 'style',
				        label: 'Style',
				        'values': [
				            {text: 'Square', value: 'button-square'},
				            {text: 'Round', value: 'button-round'},
				        ]
				    }],
				    onsubmit: function( e ) {
				        editor.insertContent( '<a class="button ' + e.data.size + e.data.color + e.data.style + '" href="' + e.data.url + '"' + e.data.target + '>' + e.data.text + '</a>' );
				    }
				} );
			}
        } );
        
    } );
    
} ) ();
