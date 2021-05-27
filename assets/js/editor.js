'use strict';

( function( blocks, editor, element ) {
	var __ = wp.i18n.__;
	var el = element.createElement;
	var registerBlockType = blocks.registerBlockType;
	var BlockControls = editor.BlockControls,
		InspectorControls = editor.InspectorControls,
		AlignmentToolbar = editor.AlignmentToolbar,
		PanelColorSettings = editor.PanelColorSettings;
	var Fragment = element.Fragment;

	registerBlockType( 'ajv-proto/colored-line', {
		title: __( 'Colored Line', 'ajv-proto' ),
		icon: 'minus',
		category: 'common',
		keywords: [ 'ajv-proto', 'colored', 'line' ],
		attributes: {
			alignment: {
				type: 'string',
				default: 'left'
			},
			lineColor: {
				type: 'string',
				default: '#ff7f50'
			}
		},
		example: {
			attributes: {
				alignment: 'left',
				lineColor: '#ff7f50'
			}
		},
		edit: function edit( props ) {
			var onChangeAlignment = function onChangeAlignment( newAlignment ) {
				props.setAttributes({
					alignment: newAlignment === undefined ? 'left' : newAlignment
				});
			};

			var blockParentStyle = {
				width: '100%',
				padding: '0',
				marginTop: '0',
				marginBottom: '0',
				textAlign: props.attributes.alignment
			};
			var blockInnerStyle = {
				backgroundColor: props.attributes.lineColor,
				width: '100%',
				height: '2px',
				display: 'inline-block'
			};
			var colorSamples = [ {
				name: 'Coral',
				slug: 'coral',
				color: '#FF7F50'
			}, {
				name: 'Brown',
				slug: 'brown',
				color: '#964B00'
			}, {
				name: 'Purple',
				slug: 'purple',
				color: '#800080'
			} ];

			return [ el( Fragment, {
				key: 'fragment'
			}, el( InspectorControls, {}, el( PanelColorSettings, {
				title: 'Color settings',
				initialOpen: true,
				colorSettings: [ {
					colors: colorSamples,
					value: props.attributes.lineColor,
					label: 'Line color',
					onChange: function onChange( value ) {
						props.setAttributes({
							lineColor: value
						});
					}
				} ]
			}) ) ), el( BlockControls, {
				key: 'controls'
			}, el( AlignmentToolbar, {
				value: props.attributes.alignment,
				onChange: onChangeAlignment
			}) ), el( 'div', {
				key: 'colored-line',
				className: props.className
			}, el( 'div', {
				className: 'ajv-proto-colored-line',
				style: blockParentStyle
			}, el( 'span', {
				style: blockInnerStyle
			}) ) ) ];
		},
		save: function save( props ) {
			var blockParentStyle = {
				width: '100%',
				padding: '0',
				marginTop: '0',
				marginBottom: '0',
				textAlign: props.attributes.alignment
			};
			var blockInnerStyle = {
				backgroundColor: props.attributes.lineColor,
				width: '100%',
				height: '2px',
				display: 'inline-block'
			};

			return el( 'div', {
				className: props.className
			}, el( 'div', {
				className: 'ajv-proto-colored-line',
				style: blockParentStyle
			}, el( 'span', {
				style: blockInnerStyle
			}) ) );
		}
	});
}( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.components ) );
'use strict';

function _defineProperty( obj, key, value ) {
	if ( key in obj ) {
		Object.defineProperty( obj, key, { value: value, enumerable: true, configurable: true, writable: true });
	} else {
		obj[key] = value;
	} return obj;
}

/* eslint-disable no-dupe-keys */
( function( blocks, editor, element ) {
	var __ = wp.i18n.__;
	var el = element.createElement;
	var registerBlockType = blocks.registerBlockType;
	var InspectorControls = editor.InspectorControls,
		PanelColorSettings = editor.PanelColorSettings,
		InnerBlocks = editor.InnerBlocks;
	var Fragment = element.Fragment;
	var template = [ [ 'core/heading', {
		content: 'Title',
		className: 'container'
	}, [] ], [ 'core/paragraph', {
		content: 'Description',
		className: 'container'
	}, [] ] ];

	registerBlockType( 'ajv-proto/cta-section', {
		title: __( 'CTA Section', 'ajv-proto' ),
		icon: 'megaphone',
		category: 'common',
		supports: _defineProperty({
			align: true
		}, 'align', [ 'wide', 'full' ]),
		keywords: [ 'ajv-proto', 'CTA', 'Call to Action' ],
		attributes: {
			backgroundColor: {
				type: 'string',
				default: '#4173bb'
			}
		},
		example: {
			attributes: {
				backgroundColor: '#4173bb'
			}
		},
		edit: function edit( props ) {
			var blockParentStyle = {
				backgroundColor: props.attributes.backgroundColor,
				padding: '40px',
				margin: '0'
			};

			return [ el( Fragment, {
				key: 'fragment'
			}, el( InspectorControls, {}, el( PanelColorSettings, {
				title: 'Color settings',
				initialOpen: true,
				colorSettings: [ {
					value: props.attributes.backgroundColor,
					label: 'Background color',
					onChange: function onChange( value ) {
						props.setAttributes({
							backgroundColor: value
						});
					}
				} ]
			}) ) ), el( 'div', {
				key: 'cta-section',
				className: props.className,
				style: blockParentStyle
			}, el( 'div', {
				className: 'wrap'
			}, el( InnerBlocks, {
				template: template,
				templateLock: 'all'
			}) ) ) ];
		},
		save: function save( props ) {
			var blockParentStyle = {
				backgroundColor: props.attributes.backgroundColor,
				padding: '40px',
				margin: '0'
			};

			return el( 'div', {
				className: props.className,
				style: blockParentStyle
			}, el( 'div', {
				className: 'wrap'
			}, el( InnerBlocks.Content ) ) );
		}
	});
}( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.components ) );
'use strict';

wp.domReady( function() {
	wp.blocks.unregisterBlockType( 'core/verse' );
	wp.blocks.unregisterBlockStyle( 'core/quote', [ 'large' ]);
});
'use strict';

wp.domReady( function() {
	var el = wp.element.createElement;
	var Fragment = wp.element.Fragment;
	var PluginSidebar = wp.editPost.PluginSidebar;
	var PluginSidebarMoreMenuItem = wp.editPost.PluginSidebarMoreMenuItem;
	var registerPlugin = wp.plugins.registerPlugin;
	var moreIcon = 'layout';

	function Component() {
		return el( Fragment, {}, el( PluginSidebarMoreMenuItem, {
			target: 'sidebar-name'
		}, 'Layout Settings' ), el( PluginSidebar, {
			name: 'sidebar-name',
			title: 'Layout Settings'
		}, 'Content of the sidebar' ) );
	}

	registerPlugin( 'plugin-name', {
		icon: moreIcon,
		render: Component
	});
});
