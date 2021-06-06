/* eslint-disable no-undef */

/**
 * Custom 'Grid' block.
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
	const { InspectorControls, InnerBlocks } = editor;
	const { Fragment } = element;
	const { PanelBody, PanelRow, RangeControl } = components;
	const template = [
		[ 'core/paragraph' ],
		[ 'core/paragraph' ],
		[ 'core/paragraph' ],
		[ 'core/paragraph' ]
	];

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

		edit: function( props ) {
			return [
				el( Fragment,
					{
						key: 'fragment'
					},
					el( InspectorControls,
						{},
						el( PanelBody,
							{
								title: __( 'Grid Settings', 'ajv-proto' ),
								initialOpen: true
							},
							el( PanelRow,
								{},
								el( RangeControl,
									{
										min: 50,
										max: 1000,
										initialPosition: 250,
										value: props.attributes.childWidth,
										label: __( 'Column min-width in pixels', 'ajv-proto' ),
										onChange: ( value ) => {
											50 < value ? props.setAttributes({ childWidth: value }) : props.setAttributes({ childWidth: 50 });
										}
									}
								)
							)
						)
					)
				),
				el( 'style',
					{
						type: 'text/css'
					},
					'#block-' + props.clientId + ' .block-editor-inner-blocks > .block-editor-block-list__layout { grid-template-columns: repeat(auto-fill,minmax(min(' + props.attributes.childWidth + 'px,100%),1fr)); }'
				),
				el( 'div',
					{
						key: 'grid-section',
						className: props.className
					},
					el( InnerBlocks,
						{
							template: template,
							templateLock: false // Can use 'all', 'block' or false.
						}
					)
				)
			];
		},

		save: function( props ) {
			return (
				el( 'div',
					{
						className: `grid ${props.className || ''}`,
						style: {
							'--child-width': props.attributes.childWidth + 'px'
						}
					},
					el( InnerBlocks.Content )
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
