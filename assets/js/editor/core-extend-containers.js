/**
 * Extend the core Cover and Group blocks with custom attributes and controls.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

( function( editor, element, components, compose, hooks ) {
	const __ = wp.i18n.__;
	const el = element.createElement;
	const cloneElement = element.cloneElement;
	const addFilter = hooks.addFilter;
	const { InspectorControls } = editor;
	const { Fragment } = element;
	const { PanelBody, PanelRow, ToggleControl, RangeControl } = components;
	const { createHigherOrderComponent } = compose;

	// Restrict to specific block names.
	const allowedBlocks = [ 'core/cover', 'core/group' ];

	/**
	 * Add custom attributes for responsive column behavior.
	 *
	 * @param {Object} settings Settings for the block.
	 *
	 * @return {Object} settings Modified settings.
	 */
	const addContainerAttributes = ( settings ) => {

		// Bail if it's another block than our defined ones.
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

	/**
	 * Add inner container width controls on settings sidebar.
	 *
	 * @param {function} BlockEdit Block edit component.
	 *
	 * @return {function} BlockEdit Modified block edit component.
	 */
	const withWidthControls = createHigherOrderComponent( ( BlockEdit ) => {
		return function( props ) {

			// Bail if it's another block than our defined ones.
			if ( ! allowedBlocks.includes( props.name ) ) {
				return el( Fragment,
					{},
					el(
						BlockEdit,
						props
					)
				);
			}

			if ( 'wide' === props.attributes.align || 'full' === props.attributes.align ) {
				return el( Fragment,
					{},
					el(
						BlockEdit,
						props
					),
					el(
						InspectorControls,
						{},
						el(
							PanelBody,
							{
								className: 'content-width-options',
								title: __( 'Content width', 'ajv-proto' ),
								initialOpen: true
							},
							false === props.attributes.adjustContentWidth ?
								el( PanelRow,
									{},
									el( ToggleControl,
										{
											label: __( 'Full width container', 'ajv-proto' ),
											onChange: ( value ) => {
												props.setAttributes({ fullContentWidth: value });
											},
											checked: props.attributes.fullContentWidth
										}
									)
								) : null,
							false === props.attributes.fullContentWidth ?
								el( PanelRow,
									{},
									el( ToggleControl,
										{
											label: __( 'Adjust container width', 'ajv-proto' ),
											onChange: ( value ) => {
												props.setAttributes({ adjustContentWidth: value });
											},
											checked: props.attributes.adjustContentWidth
										}
									)
								) : null,
							true === props.attributes.adjustContentWidth ?
								el( PanelRow,
									{},
									el( RangeControl,
										{
											min: 100,
											max: 2000,
											initialPosition: 800,
											value: props.attributes.contentWidth,
											label: __( 'Max-width in pixels', 'ajv-proto' ),
											onChange: ( value ) => {
												100 < value ? props.setAttributes({ contentWidth: value }) : props.setAttributes({ contentWidth: 100 });
											}
										}
									)
								) : null
						)
					)
				);
			} else {
				return el( Fragment,
					{},
					el(
						BlockEdit,
						props
					)
				);
			}
		};
	}, 'withWidthControls' );

	/**
	 * Add custom style attributes to block edit component.
	 *
	 * @param {function} BlockListBlock Block edit component and all toolbars.
	 *
	 * @return {function} BlockListBlock Modified block edit component and toolbars.
	 */
	const withWidthStyles = createHigherOrderComponent( ( BlockListBlock ) => {
		return function( props ) {
			let containerClassName;
			let containerStyles;

			// Bail if it's another block than our defined ones.
			if ( ! allowedBlocks.includes( props.name ) ) {
				return el(
					BlockListBlock,
					props
				);
			}

			// Define inner container class name.
			if ( 'core/cover' === props.name ) {
				containerClassName = 'wp-block-cover__inner-container';
			} else if ( 'core/group' === props.name ) {
				containerClassName = 'wp-block-group__inner-container';
			}

			// Define inline CSS styles.
			if ( true === props.attributes.fullContentWidth ) {
				containerStyles = '#block-' + props.clientId + ' .' + containerClassName + '{ max-width: none }';
			} else if ( true === props.attributes.adjustContentWidth ) {
				containerStyles = '#block-' + props.clientId + ' .' + containerClassName + '{ max-width: ' + props.attributes.contentWidth + 'px }';
			}

			if ( true === props.attributes.fullContentWidth || true === props.attributes.adjustContentWidth ) {
				return el( 'div',
					{},
					el( 'style',
						{
							type: 'text/css'
						},
						containerStyles
					),
					el(
						BlockListBlock,
						props
					)
				);
			} else {
				return el(
					BlockListBlock,
					props
				);
			}
		};
	}, 'withWidthStyles' );

	/**
	 * Add custom style attributes in save element.
	 *
	 * @param {Object} blockElement Block element.
	 * @param {Object} blockType Blocks object.
	 * @param {Object} attributes Blocks attributes.
	 *
	 * @return {Object} extraProps Modified block element.
	 */
	const applyChildrenStyles = ( blockElement, blockType, attributes ) => {
		let children;
		let innerContainer;
		let containerStyles;

		// Bail if it's another block than our defined ones.
		if ( ! allowedBlocks.includes( blockType.name ) ) {
			return blockElement;
		}

		// Convert the block children objects into arrays.
		children = element.Children.toArray( blockElement.props.children );

		// Define innerContainer.
		children.forEach( ( child ) => {
			innerContainer = child;
		});

		// Define inline CSS styles.
		if ( true === attributes.fullContentWidth ) {
			containerStyles = { style: { maxWidth: 'none' } };
		} else if ( true === attributes.adjustContentWidth ) {
			containerStyles = { style: { maxWidth: attributes.contentWidth + 'px' } };
		}

		// Check innerContainer is not null and content width option is enabled.
		if ( innerContainer && ( true === attributes.fullContentWidth || true === attributes.adjustContentWidth ) ) {
			return cloneElement(
				blockElement,
				{},
				cloneElement(
					innerContainer,
					containerStyles
				)
			);
		} else {
			return blockElement;
		}
	};

	// Add filters.
	addFilter(
		'blocks.registerBlockType',
		'recplex/add-container-attributes',
		addContainerAttributes
	);

	addFilter(
		'editor.BlockEdit',
		'recplex/with-width-controls',
		withWidthControls
	);

	addFilter(
		'editor.BlockListBlock',
		'recplex/with-width-styles',
		withWidthStyles
	);

	addFilter(
		'blocks.getSaveElement',
		'recplex/apply-children-styles',
		applyChildrenStyles
	);
}(
	window.wp.blockEditor,
	window.wp.element,
	window.wp.components,
	window.wp.compose,
	window.wp.hooks
) );
