/* eslint-disable no-undef */

/**
 * Custom 'CTA Section' block.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

( function( blocks, editor, element, components ) {
	const __ = wp.i18n.__;
	const el = element.createElement;
	const registerBlockType = blocks.registerBlockType;
	const { InspectorControls, PanelColorSettings, MediaUpload, InnerBlocks } = editor;
	const { Fragment } = element;
	const { PanelBody, PanelRow, Button } = components;
	const template = [
		[ 'core/heading', { content: 'Title' } ],
		[ 'core/paragraph', { content: 'Description...' } ]
	];

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
			innerBlocks: [
				{
					name: 'core/heading',
					attributes: {
						content: __( 'Title', 'ajv-proto' )
					}
				},
				{
					name: 'core/paragraph',
					attributes: {
						content: __( 'Description...', 'ajv-proto' )
					}
				}
			]
		},

		edit: function( props ) {
			let blockStyles;

			// Define block styles.
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

			return [
				el( Fragment,
					{
						key: 'fragment'
					},
					el( InspectorControls,
						{},
						el( PanelColorSettings,
							{
								title: __( 'Color settings', 'ajv-proto' ),
								initialOpen: true,
								colorSettings: [
									{
										value: props.attributes.backgroundColor,
										label: __( 'Background color', 'ajv-proto' ),
										onChange: ( value ) => {
											props.setAttributes(
												{
													backgroundColor: value
												}
											);
										}
									}
								]
							}
						),
						el( PanelBody,
							{
								title: __( 'Image settings', 'ajv-proto' ),
								initialOpen: false
							},
							el( PanelRow,
								{},
								el( 'div',
									{
										className: 'wp-block-image-selector'
									},
									el( MediaUpload,
										{
											onSelect: ( value ) => {
												props.setAttributes({
													image: value.url
												});
											},
											type: 'image',
											value: props.attributes.image,
											render: function( obj ) {
												return el( Button,
													{
														className: props.attributes.image ? 'image-button' : 'button button-large',
														style: {
															height: 'auto',
															padding: props.attributes.image ? 'inherit' : '0 10px'
														},
														title: 'Click to edit',
														onClick: obj.open
													},
													! props.attributes.image ? __( 'Upload Image', 'ajv-proto' ) : el( 'img', { src: props.attributes.image, alt: '' })
												);
											}
										}
									)
								)
							),
							props.attributes.image ?
								el( PanelRow,
									{},
									el( Button,
										{
											className: 'button is-large',
											title: 'Remove Image',
											onClick: () => {
												props.setAttributes({
													image: ''
												});
											}
										},
										__( 'Remove Image', 'ajv-proto' )
									)
								) :
								null
						)
					)
				),
				el( 'div',
					{
						key: 'cta-section',
						className: props.className,
						style: blockStyles
					},
					el( 'div',
						{
							className: 'block-wrap'
						},
						el( InnerBlocks,
							{
								template: template,
								templateLock: false // Can use 'all', 'block' or false.
							}
						)
					)
				)
			];
		},

		save: function( props ) {
			let blockStyles;

			// Define block styles.
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

			return (
				el( 'div',
					{
						className: props.className,
						style: blockStyles
					},
					el( 'div',
						{
							className: 'block-wrap'
						},
						el( InnerBlocks.Content )
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
