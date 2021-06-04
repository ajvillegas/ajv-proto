/**
 * Extend the core Columns block with custom attributes and controls.
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
	const allowedBlocks = [ 'core/columns' ];

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
							className: 'responsive-column-options',
							title: __( 'Responsive settings', 'ajv-proto' ),
							initialOpen: true
						},
						el( PanelRow,
							{},
							el( RadioControl,
								{
									options: [
										{
											label: __( 'Use the same column count on all screen sizes.', 'ajv-proto' ),
											value: 'default-stack'
										},
										{
											label: __( 'Specify custom column counts for other screen sizes:', 'ajv-proto' ),
											value: 'responsive-stack'
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
									max: 6,
									initialPosition: 1,
									value: props.attributes.columnsLarge,
									beforeIcon: 'laptop',
									label: __( 'Larger screens', 'ajv-proto' ),
									onChange: ( value ) => {
										1 < value ? props.setAttributes({ columnsLarge: value }) : props.setAttributes({ columnsLarge: 1 });
									}
								}
							)
						),
						el( PanelRow,
							{},
							el( RangeControl,
								{
									min: 1,
									max: 6,
									initialPosition: 1,
									value: props.attributes.columnsMedium,
									beforeIcon: 'tablet',
									label: __( 'Medium screens', 'ajv-proto' ),
									onChange: ( value ) => {
										1 < value ? props.setAttributes({ columnsMedium: value }) : props.setAttributes({ columnsMedium: 1 });
									}
								}
							)
						),
						el( PanelRow,
							{},
							el( RangeControl,
								{
									min: 1,
									max: 6,
									initialPosition: 1,
									value: props.attributes.columnsSmall,
									beforeIcon: 'smartphone',
									label: __( 'Small screens', 'ajv-proto' ),
									onChange: ( value ) => {
										1 < value ? props.setAttributes({ columnsSmall: value }) : props.setAttributes({ columnsSmall: 1 });
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
	const applyColumnClasses = ( extraProps, blockType, attributes ) => {

		// Bail if it's another block than our defined ones.
		if ( ! allowedBlocks.includes( blockType.name ) || 'default-stack' === attributes.responsiveBehavior ) {
			return extraProps;
		}

		if ( 'responsive-stack' === attributes.responsiveBehavior ) {
			extraProps.className = extraProps.className + ` col-large-${attributes.columnsLarge} col-medium-${attributes.columnsMedium} col-small-${attributes.columnsSmall}`;
		}

		return extraProps;
	};

	// Add filters.
	addFilter(
		'blocks.registerBlockType',
		'recplex/add-attributes',
		addAttributes
	);

	addFilter(
		'editor.BlockEdit',
		'recplex/with-responsive-controls',
		withResponsiveControls
	);

	addFilter(
		'blocks.getSaveContent.extraProps',
		'recplex/apply-column-classes',
		applyColumnClasses
	);
}(
	window.wp.blockEditor,
	window.wp.element,
	window.wp.components,
	window.wp.compose,
	window.wp.hooks
) );
