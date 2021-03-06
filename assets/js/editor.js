'use strict';

/* eslint-disable no-unused-vars */
function _defineProperty( obj, key, value ) {
	if ( key in obj ) {
		Object.defineProperty( obj, key, {
			value: value,
			enumerable: true,
			configurable: true,
			writable: true
		});
	} else {
		obj[key] = value;
	}

	return obj;
}
'use strict';

/* eslint-disable no-undef */
( function( blocks, editor, element, components ) {
	var __ = wp.i18n.__;
	var el = element.createElement;
	var registerBlockType = blocks.registerBlockType;
	var InspectorControls = editor.InspectorControls,
		PanelColorSettings = editor.PanelColorSettings,
		MediaUpload = editor.MediaUpload,
		InnerBlocks = editor.InnerBlocks;
	var Fragment = element.Fragment;
	var PanelBody = components.PanelBody,
		PanelRow = components.PanelRow,
		Button = components.Button;
	var template = [ [ 'core/heading', {
		content: 'Title'
	} ], [ 'core/paragraph', {
		content: 'Description...'
	} ] ];

	registerBlockType( 'ajv-proto/cta-section', {
		title: __( 'CTA Section', 'ajv-proto' ),
		description: __( 'Add a call-to-action section.', 'ajv-proto' ),
		icon: 'megaphone',
		category: 'common',
		supports: _defineProperty({
			align: true
		}, 'align', [ 'wide', 'full' ]),
		keywords: [ 'Custom Block', 'CTA', 'Call to Action' ],
		attributes: {
			backgroundColor: {
				type: 'string',
				default: '#34b79d'
			},
			image: {
				type: 'string',
				default: ''
			}
		},
		example: {
			attributes: {
				backgroundColor: '#34b79d',
				image: ''
			},
			innerBlocks: [ {
				name: 'core/heading',
				attributes: {
					content: __( 'Title', 'ajv-proto' )
				}
			}, {
				name: 'core/paragraph',
				attributes: {
					content: __( 'Description...', 'ajv-proto' )
				}
			} ]
		},
		edit: function edit( props ) {
			var blockStyles;

			if ( props.attributes.image ) {
				blockStyles = {
					padding: '40px',
					backgroundColor: props.attributes.backgroundColor,
					backgroundImage: 'url(' + props.attributes.image + ')',
					backgroundSize: 'cover'
				};
			} else {
				blockStyles = {
					padding: '40px',
					backgroundColor: props.attributes.backgroundColor
				};
			}

			return [ el( Fragment, {
				key: 'fragment'
			}, el( InspectorControls, {}, el( PanelColorSettings, {
				title: __( 'Color settings', 'ajv-proto' ),
				initialOpen: true,
				colorSettings: [ {
					value: props.attributes.backgroundColor,
					label: __( 'Background color', 'ajv-proto' ),
					onChange: function onChange( value ) {
						props.setAttributes({
							backgroundColor: value
						});
					}
				} ]
			}), el( PanelBody, {
				title: __( 'Image settings', 'ajv-proto' ),
				initialOpen: false
			}, el( PanelRow, {}, el( 'div', {
				className: 'wp-block-image-selector'
			}, el( MediaUpload, {
				onSelect: function onSelect( value ) {
					props.setAttributes({
						image: value.url
					});
				},
				type: 'image',
				value: props.attributes.image,
				render: function render( obj ) {
					return el( Button, {
						className: props.attributes.image ? 'image-button' : 'button button-large',
						style: {
							height: 'auto',
							padding: props.attributes.image ? 'inherit' : '0 10px'
						},
						title: 'Click to edit',
						onClick: obj.open
					}, ! props.attributes.image ? __( 'Upload Image', 'ajv-proto' ) : el( 'img', {
						src: props.attributes.image,
						alt: ''
					}) );
				}
			}) ) ), props.attributes.image ? el( PanelRow, {}, el( Button, {
				className: 'button is-large',
				title: 'Remove Image',
				onClick: function onClick() {
					props.setAttributes({
						image: ''
					});
				}
			}, __( 'Remove Image', 'ajv-proto' ) ) ) : null ) ) ), el( 'div', {
				key: 'cta-section',
				className: props.className,
				style: blockStyles
			}, el( 'div', {
				className: 'block-wrap'
			}, el( InnerBlocks, {
				template: template,
				templateLock: false
			}) ) ) ];
		},
		save: function save( props ) {
			var blockStyles;

			if ( props.attributes.image ) {
				blockStyles = {
					padding: '40px',
					backgroundColor: props.attributes.backgroundColor,
					backgroundImage: 'url(' + props.attributes.image + ')',
					backgroundSize: 'cover'
				};
			} else {
				blockStyles = {
					padding: '40px',
					backgroundColor: props.attributes.backgroundColor
				};
			}

			return el( 'div', {
				className: props.className,
				style: blockStyles
			}, el( 'div', {
				className: 'block-wrap'
			}, el( InnerBlocks.Content ) ) );
		}
	});
}( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.components ) );
'use strict';

/* eslint-disable no-undef */
( function( blocks, editor, element, components ) {
	var __ = wp.i18n.__;
	var el = element.createElement;
	var registerBlockType = blocks.registerBlockType;
	var InspectorControls = editor.InspectorControls,
		InnerBlocks = editor.InnerBlocks;
	var Fragment = element.Fragment;
	var PanelBody = components.PanelBody,
		PanelRow = components.PanelRow,
		RangeControl = components.RangeControl;
	var template = [ [ 'core/paragraph' ], [ 'core/paragraph' ], [ 'core/paragraph' ], [ 'core/paragraph' ] ];

	registerBlockType( 'ajv-proto/grid', {
		title: __( 'Grid', 'ajv-proto' ),
		description: __( 'Display inner blocks in a grid pattern.', 'ajv-proto' ),
		icon: 'screenoptions',
		category: 'layout',
		keywords: [ 'Custom Block', 'Grid', 'Columns' ],
		attributes: {
			childWidth: {
				type: 'number',
				default: 250
			}
		},
		example: undefined,
		edit: function edit( props ) {
			return [ el( Fragment, {
				key: 'fragment'
			}, el( InspectorControls, {}, el( PanelBody, {
				title: __( 'Grid Settings', 'ajv-proto' ),
				initialOpen: true
			}, el( PanelRow, {}, el( RangeControl, {
				min: 50,
				max: 1000,
				initialPosition: 250,
				value: props.attributes.childWidth,
				label: __( 'Column min-width in pixels', 'ajv-proto' ),
				onChange: function onChange( value ) {
					50 < value ? props.setAttributes({
						childWidth: value
					}) : props.setAttributes({
						childWidth: 50
					});
				}
			}) ) ) ) ), el( 'style', {
				type: 'text/css'
			}, '#block-' + props.clientId + ' .block-editor-inner-blocks > .block-editor-block-list__layout { grid-template-columns: repeat(auto-fill,minmax(min(' + props.attributes.childWidth + 'px,100%),1fr)); }' ), el( 'div', {
				key: 'grid-section',
				className: props.className
			}, el( InnerBlocks, {
				template: template,
				templateLock: false
			}) ) ];
		},
		save: function save( props ) {
			return el( 'div', {
				className: 'grid '.concat( props.className || '' ),
				style: {
					'--child-width': props.attributes.childWidth + 'px'
				}
			}, el( InnerBlocks.Content ) );
		}
	});
}( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.components ) );
'use strict';

/* eslint-disable no-unused-vars */
( function( blocks, editor, element, components ) {
	var __ = wp.i18n.__;
	var el = element.createElement;
	var registerBlockType = blocks.registerBlockType;
	var InspectorControls = editor.InspectorControls,
		InnerBlocks = editor.InnerBlocks;
	var Fragment = element.Fragment;
	var PanelBody = components.PanelBody,
		PanelRow = components.PanelRow,
		RangeControl = components.RangeControl;
	var serverSideRender = wp.serverSideRender;
	var template = [ [ 'core/heading', {
		content: 'Heading Title'
	} ] ];

	registerBlockType( 'ajv-proto/posts-grid', {
		title: __( 'Posts Grid', 'ajv-proto' ),
		description: __( 'Display a grid of your most recent posts.', 'ajv-proto' ),
		icon: 'grid-view',
		category: 'widgets',
		keywords: [ 'Custom Block', 'Grid', 'Latest Posts' ],
		attributes: {
			childWidth: {
				type: 'number',
				default: 250
			},
			postsPerBlock: {
				type: 'number',
				default: 4
			}
		},
		example: {
			attributes: {
				childWidth: 250,
				postsPerBlock: 4
			},
			innerBlocks: [ {
				name: 'core/heading',
				attributes: {
					content: __( 'Heading Title', 'ajv-proto' )
				}
			} ]
		},
		edit: function edit( props ) {
			return [ el( Fragment, {
				key: 'fragment'
			}, el( InspectorControls, {}, el( PanelBody, {
				title: __( 'Display Settings', 'ajv-proto' ),
				initialOpen: true
			}, el( PanelRow, {}, el( RangeControl, {
				min: 1,
				max: 100,
				initialPosition: 4,
				value: props.attributes.postsPerBlock,
				label: __( 'Number of items', 'ajv-proto' ),
				onChange: function onChange( value ) {
					1 < value ? props.setAttributes({
						postsPerBlock: value
					}) : props.setAttributes({
						postsPerBlock: 1
					});
				}
			}) ), el( PanelRow, {}, el( RangeControl, {
				min: 50,
				max: 1000,
				initialPosition: 250,
				value: props.attributes.childWidth,
				label: __( 'Column min-width in pixels', 'ajv-proto' ),
				onChange: function onChange( value ) {
					50 < value ? props.setAttributes({
						childWidth: value
					}) : props.setAttributes({
						childWidth: 50
					});
				}
			}) ) ) ) ), el( 'div', {
				className: props.className
			}, el( InnerBlocks, {
				template: template,
				templateLock: 'all'
			}), el( serverSideRender, {
				block: 'ajv-proto/posts-grid',
				attributes: props.attributes
			}) ) ];
		},
		save: function save( props ) {
			return el( InnerBlocks.Content );
		}
	});
}( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.components ) );
'use strict';

wp.domReady( function() {
	wp.blocks.unregisterBlockType( 'core/verse' );
	wp.blocks.unregisterBlockStyle( 'core/quote', [ 'large' ]);
});
'use strict';

( function( editor, element, components, compose, hooks ) {
	var __ = wp.i18n.__;
	var el = element.createElement;
	var addFilter = hooks.addFilter;
	var InspectorControls = editor.InspectorControls;
	var Fragment = element.Fragment;
	var PanelBody = components.PanelBody,
		PanelRow = components.PanelRow,
		RadioControl = components.RadioControl,
		RangeControl = components.RangeControl;
	var createHigherOrderComponent = compose.createHigherOrderComponent;
	var allowedBlocks = [ 'core/columns' ];

	var addAttributes = function addAttributes( settings ) {
		if ( ! allowedBlocks.includes( settings.name ) ) {
			return settings;
		}

		settings.attributes = Object.assign( settings.attributes, {
			responsiveBehavior: {
				type: 'string',
				default: 'default-stack'
			},
			columnsLarge: {
				type: 'number',
				default: 1
			},
			columnsMedium: {
				type: 'number',
				default: 1
			},
			columnsSmall: {
				type: 'number',
				default: 1
			}
		});
		return settings;
	};

	var withResponsiveControls = createHigherOrderComponent( function( BlockEdit ) {
		return function( props ) {
			if ( ! allowedBlocks.includes( props.name ) ) {
				return el( Fragment, {}, el( BlockEdit, props ) );
			}

			return el( Fragment, {}, el( BlockEdit, props ), el( InspectorControls, {}, el( PanelBody, {
				className: 'responsive-setting-options',
				title: __( 'Responsive settings', 'ajv-proto' ),
				initialOpen: true
			}, el( PanelRow, {}, el( RadioControl, {
				options: [ {
					label: __( 'Use the same column count on all screen sizes.', 'ajv-proto' ),
					value: 'default-stack'
				}, {
					label: __( 'Specify custom column counts for other screen sizes:', 'ajv-proto' ),
					value: 'responsive-stack'
				} ],
				onChange: function onChange( value ) {
					props.setAttributes({
						responsiveBehavior: value
					});
				},
				selected: props.attributes.responsiveBehavior
			}) ), el( PanelRow, {}, el( RangeControl, {
				min: 1,
				max: 6,
				initialPosition: 1,
				value: props.attributes.columnsLarge,
				beforeIcon: 'laptop',
				label: __( 'Larger screens', 'ajv-proto' ),
				onChange: function onChange( value ) {
					1 < value ? props.setAttributes({
						columnsLarge: value
					}) : props.setAttributes({
						columnsLarge: 1
					});
				}
			}) ), el( PanelRow, {}, el( RangeControl, {
				min: 1,
				max: 6,
				initialPosition: 1,
				value: props.attributes.columnsMedium,
				beforeIcon: 'tablet',
				label: __( 'Medium screens', 'ajv-proto' ),
				onChange: function onChange( value ) {
					1 < value ? props.setAttributes({
						columnsMedium: value
					}) : props.setAttributes({
						columnsMedium: 1
					});
				}
			}) ), el( PanelRow, {}, el( RangeControl, {
				min: 1,
				max: 6,
				initialPosition: 1,
				value: props.attributes.columnsSmall,
				beforeIcon: 'smartphone',
				label: __( 'Small screens', 'ajv-proto' ),
				onChange: function onChange( value ) {
					1 < value ? props.setAttributes({
						columnsSmall: value
					}) : props.setAttributes({
						columnsSmall: 1
					});
				}
			}) ) ) ) );
		};
	}, 'withResponsiveControls' );

	var applyColumnClasses = function applyColumnClasses( extraProps, blockType, attributes ) {
		if ( ! allowedBlocks.includes( blockType.name ) || 'default-stack' === attributes.responsiveBehavior ) {
			return extraProps;
		}

		if ( 'responsive-stack' === attributes.responsiveBehavior ) {
			extraProps.className = extraProps.className + ' col-large-'.concat( attributes.columnsLarge, ' col-medium-' ).concat( attributes.columnsMedium, ' col-small-' ).concat( attributes.columnsSmall );
		}

		return extraProps;
	};

	addFilter( 'blocks.registerBlockType', 'ajv-proto/add-attributes', addAttributes );
	addFilter( 'editor.BlockEdit', 'ajv-proto/with-responsive-controls', withResponsiveControls );
	addFilter( 'blocks.getSaveContent.extraProps', 'ajv-proto/apply-column-classes', applyColumnClasses );
}( window.wp.blockEditor, window.wp.element, window.wp.components, window.wp.compose, window.wp.hooks ) );
'use strict';

( function( editor, element, components, compose, hooks ) {
	var __ = wp.i18n.__;
	var el = element.createElement;
	var cloneElement = element.cloneElement;
	var addFilter = hooks.addFilter;
	var InspectorControls = editor.InspectorControls;
	var Fragment = element.Fragment;
	var PanelBody = components.PanelBody,
		PanelRow = components.PanelRow,
		ToggleControl = components.ToggleControl,
		RangeControl = components.RangeControl;
	var createHigherOrderComponent = compose.createHigherOrderComponent;
	var allowedBlocks = [ 'core/cover', 'core/group' ];

	var addContainerAttributes = function addContainerAttributes( settings ) {
		if ( ! allowedBlocks.includes( settings.name ) ) {
			return settings;
		}

		settings.attributes = Object.assign( settings.attributes, {
			fullContentWidth: {
				type: 'boolean',
				default: false
			},
			adjustContentWidth: {
				type: 'boolean',
				default: false
			},
			contentWidth: {
				type: 'number',
				default: 800
			}
		});
		return settings;
	};

	var withWidthControls = createHigherOrderComponent( function( BlockEdit ) {
		return function( props ) {
			if ( ! allowedBlocks.includes( props.name ) ) {
				return el( Fragment, {}, el( BlockEdit, props ) );
			}

			if ( 'wide' === props.attributes.align || 'full' === props.attributes.align ) {
				return el( Fragment, {}, el( BlockEdit, props ), el( InspectorControls, {}, el( PanelBody, {
					className: 'content-width-options',
					title: __( 'Content width', 'ajv-proto' ),
					initialOpen: true
				}, false === props.attributes.adjustContentWidth ? el( PanelRow, {}, el( ToggleControl, {
					label: __( 'Full width container', 'ajv-proto' ),
					onChange: function onChange( value ) {
						props.setAttributes({
							fullContentWidth: value
						});
					},
					checked: props.attributes.fullContentWidth
				}) ) : null, false === props.attributes.fullContentWidth ? el( PanelRow, {}, el( ToggleControl, {
					label: __( 'Adjust container width', 'ajv-proto' ),
					onChange: function onChange( value ) {
						props.setAttributes({
							adjustContentWidth: value
						});
					},
					checked: props.attributes.adjustContentWidth
				}) ) : null, true === props.attributes.adjustContentWidth ? el( PanelRow, {}, el( RangeControl, {
					min: 100,
					max: 2000,
					initialPosition: 800,
					value: props.attributes.contentWidth,
					label: __( 'Max-width in pixels', 'ajv-proto' ),
					onChange: function onChange( value ) {
						100 < value ? props.setAttributes({
							contentWidth: value
						}) : props.setAttributes({
							contentWidth: 100
						});
					}
				}) ) : null ) ) );
			} else {
				return el( Fragment, {}, el( BlockEdit, props ) );
			}
		};
	}, 'withWidthControls' );
	var withWidthStyles = createHigherOrderComponent( function( BlockListBlock ) {
		return function( props ) {
			var containerClassName;
			var containerStyles;

			if ( ! allowedBlocks.includes( props.name ) ) {
				return el( BlockListBlock, props );
			}

			if ( 'core/cover' === props.name ) {
				containerClassName = 'wp-block-cover__inner-container';
			} else if ( 'core/group' === props.name ) {
				containerClassName = 'wp-block-group__inner-container';
			}

			if ( true === props.attributes.fullContentWidth ) {
				containerStyles = '#block-' + props.clientId + ' .' + containerClassName + '{ max-width: none }';
			} else if ( true === props.attributes.adjustContentWidth ) {
				containerStyles = '#block-' + props.clientId + ' .' + containerClassName + '{ max-width: ' + props.attributes.contentWidth + 'px }';
			}

			if ( true === props.attributes.fullContentWidth || true === props.attributes.adjustContentWidth ) {
				return el( 'div', {}, el( 'style', {
					type: 'text/css'
				}, containerStyles ), el( BlockListBlock, props ) );
			} else {
				return el( BlockListBlock, props );
			}
		};
	}, 'withWidthStyles' );

	var applyChildrenStyles = function applyChildrenStyles( blockElement, blockType, attributes ) {
		var children;
		var innerContainer;
		var containerStyles;

		if ( ! allowedBlocks.includes( blockType.name ) ) {
			return blockElement;
		}

		children = element.Children.toArray( blockElement.props.children );
		children.forEach( function( child ) {
			innerContainer = child;
		});

		if ( true === attributes.fullContentWidth ) {
			containerStyles = {
				style: {
					maxWidth: 'none'
				}
			};
		} else if ( true === attributes.adjustContentWidth ) {
			containerStyles = {
				style: {
					maxWidth: attributes.contentWidth + 'px'
				}
			};
		}

		if ( innerContainer && ( true === attributes.fullContentWidth || true === attributes.adjustContentWidth ) ) {
			return cloneElement( blockElement, {}, cloneElement( innerContainer, containerStyles ) );
		} else {
			return blockElement;
		}
	};

	addFilter( 'blocks.registerBlockType', 'ajv-proto/add-container-attributes', addContainerAttributes );
	addFilter( 'editor.BlockEdit', 'ajv-proto/with-width-controls', withWidthControls );
	addFilter( 'editor.BlockListBlock', 'ajv-proto/with-width-styles', withWidthStyles );
	addFilter( 'blocks.getSaveElement', 'ajv-proto/apply-children-styles', applyChildrenStyles );
}( window.wp.blockEditor, window.wp.element, window.wp.components, window.wp.compose, window.wp.hooks ) );
'use strict';

( function( editor, element, components, compose, hooks ) {
	var __ = wp.i18n.__;
	var el = element.createElement;
	var addFilter = hooks.addFilter;
	var InspectorControls = editor.InspectorControls;
	var Fragment = element.Fragment;
	var PanelBody = components.PanelBody,
		PanelRow = components.PanelRow,
		RadioControl = components.RadioControl,
		RangeControl = components.RangeControl;
	var createHigherOrderComponent = compose.createHigherOrderComponent;
	var allowedBlocks = [ 'core/spacer' ];

	var addAttributes = function addAttributes( settings ) {
		if ( ! allowedBlocks.includes( settings.name ) ) {
			return settings;
		}

		settings.attributes = Object.assign( settings.attributes, {
			responsiveBehavior: {
				type: 'string',
				default: 'default-height'
			},
			heightLarge: {
				type: 'number',
				default: 1
			},
			heightMedium: {
				type: 'number',
				default: 1
			},
			heightSmall: {
				type: 'number',
				default: 1
			}
		});
		return settings;
	};

	var withResponsiveControls = createHigherOrderComponent( function( BlockEdit ) {
		return function( props ) {
			if ( ! allowedBlocks.includes( props.name ) ) {
				return el( Fragment, {}, el( BlockEdit, props ) );
			}

			return el( Fragment, {}, el( BlockEdit, props ), el( InspectorControls, {}, el( PanelBody, {
				className: 'responsive-setting-options',
				title: __( 'Responsive height settings', 'ajv-proto' ),
				initialOpen: true
			}, el( PanelRow, {}, el( RadioControl, {
				options: [ {
					label: __( 'Use the same spacer height on all screen sizes.', 'ajv-proto' ),
					value: 'default-height'
				}, {
					label: __( 'Specify custom spacer height for other screen sizes:', 'ajv-proto' ),
					value: 'responsive-height'
				} ],
				onChange: function onChange( value ) {
					props.setAttributes({
						responsiveBehavior: value
					});
				},
				selected: props.attributes.responsiveBehavior
			}) ), el( PanelRow, {}, el( RangeControl, {
				min: 1,
				max: 500,
				initialPosition: 100,
				value: props.attributes.heightLarge,
				beforeIcon: 'laptop',
				label: __( 'Larger screens', 'ajv-proto' ),
				onChange: function onChange( value ) {
					1 < value ? props.setAttributes({
						heightLarge: value
					}) : props.setAttributes({
						heightLarge: 1
					});
				}
			}) ), el( PanelRow, {}, el( RangeControl, {
				min: 1,
				max: 500,
				initialPosition: 100,
				value: props.attributes.heightMedium,
				beforeIcon: 'tablet',
				label: __( 'Medium screens', 'ajv-proto' ),
				onChange: function onChange( value ) {
					1 < value ? props.setAttributes({
						heightMedium: value
					}) : props.setAttributes({
						heightMedium: 1
					});
				}
			}) ), el( PanelRow, {}, el( RangeControl, {
				min: 1,
				max: 500,
				initialPosition: 100,
				value: props.attributes.heightSmall,
				beforeIcon: 'smartphone',
				label: __( 'Small screens', 'ajv-proto' ),
				onChange: function onChange( value ) {
					1 < value ? props.setAttributes({
						heightSmall: value
					}) : props.setAttributes({
						heightSmall: 1
					});
				}
			}) ) ) ) );
		};
	}, 'withResponsiveControls' );

	var applySpacerStyle = function applySpacerStyle( extraProps, blockType, attributes ) {
		if ( ! allowedBlocks.includes( blockType.name ) || 'default-stack' === attributes.responsiveBehavior ) {
			return extraProps;
		}

		if ( 'responsive-height' === attributes.responsiveBehavior ) {
			Object.assign( extraProps.style, {
				'--spacer-large': attributes.heightLarge + 'px',
				'--spacer-medium': attributes.heightMedium + 'px',
				'--spacer-small': attributes.heightSmall + 'px'
			});
		}

		return extraProps;
	};

	addFilter( 'blocks.registerBlockType', 'ajv-proto/add-attributes', addAttributes );
	addFilter( 'editor.BlockEdit', 'ajv-proto/with-responsive-controls', withResponsiveControls );
	addFilter( 'blocks.getSaveContent.extraProps', 'ajv-proto/apply-spacer-style', applySpacerStyle );
}( window.wp.blockEditor, window.wp.element, window.wp.components, window.wp.compose, window.wp.hooks ) );
