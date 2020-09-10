/**
 * Custom 'Colored Line' block.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

( function( blocks, editor, element ) {
	const __ = wp.i18n.__; // The __() for internationalization.
	const el = element.createElement; // The wp.element.createElement() function to create elements.
	const registerBlockType = blocks.registerBlockType; // The registerBlockType() to register blocks.
	const { BlockControls, InspectorControls, AlignmentToolbar, PanelColorSettings } = editor;
	const { Fragment } = element;

	registerBlockType( 'ajv-proto/colored-line', { // Block name. Block names must be string that contains a namespace prefix (e.g., my-plugin/my-custom-block).
		title: __( 'Colored Line', 'ajv-proto' ), // Block title.
		icon: 'minus', // Block icon from Dashicons (https://developer.wordpress.org/resource/dashicons/).
		category: 'common', // Block category. Group blocks together based on common traits (e.g., common, formatting, layout, widgets, embed).
		keywords: [ 'ajv-proto', 'colored', 'line' ], // Keywords for custom block.
		attributes: {
			alignment: {
				type: 'string',
				default: 'left'
			},
			lineColor: {
				type: 'string',
				default: '#ff7f50'
			}
		}, // Placeholders to store customized settings information about the block.
		example: { // Used to define default values for the attributes.
			attributes: {
				alignment: 'left',
				lineColor: '#ff7f50'
			}
		},

		// The 'edit' property must be a valid function.
		edit: ( function( props ) {
			const onChangeAlignment = ( newAlignment ) => {
				props.setAttributes({ alignment: newAlignment === undefined ? 'left' : newAlignment });
			};
			const blockParentStyle = {
				width: '100%',
				padding: '0',
				marginTop: '0',
				marginBottom: '0',
				textAlign: props.attributes.alignment
			};
			const blockInnerStyle = {
				backgroundColor: props.attributes.lineColor,
				width: '100%',
				height: '2px',
				display: 'inline-block'
			};
			const colorSamples = [
				{
					name: 'Coral',
					slug: 'coral',
					color: '#FF7F50'
				},
				{
					name: 'Brown',
					slug: 'brown',
					color: '#964B00'
				},
				{
					name: 'Purple',
					slug: 'purple',
					color: '#800080'
				}
			];

			return [
				el(
					Fragment,
					{ key: 'fragment' },
					el(
						InspectorControls,
						{},
						el(
							PanelColorSettings,
							{
								title: 'Color settings',
								initialOpen: true,
								colorSettings: [
									{
										colors: colorSamples, // Here you can pass custom colors.
										value: props.attributes.lineColor,
										label: 'Line color',
										onChange: ( value ) => {
											props.setAttributes(
												{ lineColor: value }
											);
										}
									}
								]
							}
						)
					)
				),
				el(
					BlockControls,
					{ key: 'controls' },
					el(
						AlignmentToolbar,
						{
							value: props.attributes.alignment,
							onChange: onChangeAlignment
						}
					)
				),
				el(
					'div',
					{
						key: 'colored-line',
						className: props.className
					},
					el(
						'div',
						{
							className: 'ajv-proto-colored-line',
							style: blockParentStyle
						},
						el(
							'span',
							{ style: blockInnerStyle }
						)
					)
				)
			];
		}),

		// The 'save' property must be specified and must be a valid function.
		save: function( props ) {
			const blockParentStyle = {
				width: '100%',
				padding: '0',
				marginTop: '0',
				marginBottom: '0',
				textAlign: props.attributes.alignment
			};
			const blockInnerStyle = {
				backgroundColor: props.attributes.lineColor,
				width: '100%',
				height: '2px',
				display: 'inline-block'
			};

			return (
				el(
					'div',
					{ className: props.className }, // The className property is automatically enabled for each block.
					el(
						'div',
						{
							className: 'ajv-proto-colored-line',
							style: blockParentStyle
						},
						el(
							'span',
							{ style: blockInnerStyle }
						)
					)
				)
			);
		}
	});
}(
	window.wp.blocks,
	window.wp.blockEditor,
	window.wp.element,
	window.wp.components
) );
