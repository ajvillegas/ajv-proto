/**
 * Extend the core Spacer block with custom attributes and controls.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

( function( editor, element, components, compose, hooks ) {
	const __ = wp.i18n.__;
	const el = element.createElement;
	const addFilter = hooks.addFilter;
	const { InspectorControls } = editor;
	const { Fragment } = element;
	const { PanelBody, PanelRow, RadioControl, RangeControl } = components;
	const { createHigherOrderComponent } = compose;

	// Restrict to specific block names.
	const allowedBlocks = [ 'core/spacer' ];

	/**
	 * Add custom attributes for responsive column behavior.
	 *
	 * @param {Object} settings Settings for the block.
	 *
	 * @return {Object} settings Modified settings.
	 */
	const addAttributes = ( settings ) => {

		// Bail if it's another block than our defined ones.
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

	/**
	 * Add responsive column controls on settings sidebar.
	 *
	 * @param {function} BlockEdit Block edit component.
	 *
	 * @return {function} BlockEdit Modified block edit component.
	 */
	const withResponsiveControls = createHigherOrderComponent( ( BlockEdit ) => {
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
							className: 'responsive-setting-options',
							title: __( 'Responsive height settings', 'ajv-proto' ),
							initialOpen: true
						},
						el( PanelRow,
							{},
							el( RadioControl,
								{
									options: [
										{
											label: __( 'Use the same spacer height on all screen sizes.', 'ajv-proto' ),
											value: 'default-height'
										},
										{
											label: __( 'Specify custom spacer height for other screen sizes:', 'ajv-proto' ),
											value: 'responsive-height'
										}
									],
									onChange: ( value ) => {
										props.setAttributes({ responsiveBehavior: value });
									},
									selected: props.attributes.responsiveBehavior
								}
							)
						),
						el( PanelRow,
							{},
							el( RangeControl,
								{
									min: 1,
									max: 500,
									initialPosition: 100,
									value: props.attributes.heightLarge,
									beforeIcon: 'laptop',
									label: __( 'Larger screens', 'ajv-proto' ),
									onChange: ( value ) => {
										1 < value ? props.setAttributes({ heightLarge: value }) : props.setAttributes({ heightLarge: 1 });
									}
								}
							)
						),
						el( PanelRow,
							{},
							el( RangeControl,
								{
									min: 1,
									max: 500,
									initialPosition: 100,
									value: props.attributes.heightMedium,
									beforeIcon: 'tablet',
									label: __( 'Medium screens', 'ajv-proto' ),
									onChange: ( value ) => {
										1 < value ? props.setAttributes({ heightMedium: value }) : props.setAttributes({ heightMedium: 1 });
									}
								}
							)
						),
						el( PanelRow,
							{},
							el( RangeControl,
								{
									min: 1,
									max: 500,
									initialPosition: 100,
									value: props.attributes.heightSmall,
									beforeIcon: 'smartphone',
									label: __( 'Small screens', 'ajv-proto' ),
									onChange: ( value ) => {
										1 < value ? props.setAttributes({ heightSmall: value }) : props.setAttributes({ heightSmall: 1 });
									}
								}
							)
						)
					)
				)
			);
		};
	}, 'withResponsiveControls' );

	/**
	 * Add custom column classes in save element.
	 *
	 * @param {Object} extraProps Block element.
	 * @param {Object} blockType Blocks object.
	 * @param {Object} attributes Blocks attributes.
	 *
	 * @return {Object} extraProps Modified block element.
	 */
	const applySpacerStyle = ( extraProps, blockType, attributes ) => {

		// Bail if it's another block than our defined ones.
		if ( ! allowedBlocks.includes( blockType.name ) || 'default-stack' === attributes.responsiveBehavior ) {
			return extraProps;
		}

		if ( 'responsive-height' === attributes.responsiveBehavior ) {
			Object.assign(
				extraProps.style,
				{
					'--spacer-large': attributes.heightLarge + 'px',
					'--spacer-medium': attributes.heightMedium + 'px',
					'--spacer-small': attributes.heightSmall + 'px'
				}
			);
		}

		return extraProps;
	};

	// Add filters.
	addFilter(
		'blocks.registerBlockType',
		'ajv-proto/add-attributes',
		addAttributes
	);

	addFilter(
		'editor.BlockEdit',
		'ajv-proto/with-responsive-controls',
		withResponsiveControls
	);

	addFilter(
		'blocks.getSaveContent.extraProps',
		'ajv-proto/apply-spacer-style',
		applySpacerStyle
	);
}(
	window.wp.blockEditor,
	window.wp.element,
	window.wp.components,
	window.wp.compose,
	window.wp.hooks
) );
