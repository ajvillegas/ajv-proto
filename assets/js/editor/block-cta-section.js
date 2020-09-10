/* eslint-disable no-dupe-keys */

/**
 * Custom 'CTA Section' block.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

( function( blocks, editor, element ) {
	const __ = wp.i18n.__;
	const el = element.createElement;
	const registerBlockType = blocks.registerBlockType;
	const { InspectorControls, PanelColorSettings, InnerBlocks } = editor;
	const { Fragment } = element;
	const template = [
		[ 'core/heading', { content: 'Title', className: 'container' }, [] ],
		[ 'core/paragraph', { content: 'Description', className: 'container' }, [] ]
	];

	registerBlockType( 'ajv-proto/cta-section', {
		title: __( 'CTA Section', 'ajv-proto' ),
		icon: 'megaphone',
		category: 'common', // Block category (common, formatting, layout, widgets, embed).
		supports: {
			align: true,
			align: [ 'wide', 'full' ]
		},
		keywords: [ 'ajv-proto', 'CTA', 'Call to Action' ],
		attributes: {
			backgroundColor: {
				type: 'string',
				default: '#4173bb'
			}
		}, // Placeholders to store customized settings information about the block.
		example: { // Used to define default values for the attributes.
			attributes: {
				backgroundColor: '#4173bb'
			}
		},

		// The 'edit' property must be a valid function.
		edit: ( function( props ) {
			const blockParentStyle = {
				backgroundColor: props.attributes.backgroundColor,
				padding: '40px',
				margin: '0'
			};

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
										value: props.attributes.backgroundColor,
										label: 'Background color',
										onChange: ( value ) => {
											props.setAttributes(
												{ backgroundColor: value }
											);
										}
									}
								]
							}
						)
					)
				),
				el(
					'div',
					{
						key: 'cta-section',
						className: props.className,
						style: blockParentStyle
					},
					el(
						'div',
						{
							className: 'wrap'
						},
						el(
							InnerBlocks,
							{
								template: template,
								templateLock: 'all'
							}
						)
					)
				)
			];
		}),

		// The 'save' property must be specified and must be a valid function.
		save: function( props ) {
			const blockParentStyle = {
				backgroundColor: props.attributes.backgroundColor,
				padding: '40px',
				margin: '0'
			};

			return (
				el(
					'div',
					{
						className: props.className,
						style: blockParentStyle
					}, // The className property is automatically enabled for each block.
					el(
						'div',
						{
							className: 'wrap'
						},
						el(
							InnerBlocks.Content
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
