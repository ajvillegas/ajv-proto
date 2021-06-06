/* eslint-disable no-unused-vars */

/**
 * Custom 'Posts Grid' dynamic block.
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
	const serverSideRender = wp.serverSideRender;
	const template = [
		[ 'core/heading', { content: 'Heading Title' } ]
	];

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
			innerBlocks: [
				{
					name: 'core/heading',
					attributes: {
						content: __( 'Heading Title', 'ajv-proto' )
					}
				}
			]
		},

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
								title: __( 'Display Settings', 'ajv-proto' ),
								initialOpen: true
							},
							el( PanelRow,
								{},
								el( RangeControl,
									{
										min: 1,
										max: 100,
										initialPosition: 4,
										value: props.attributes.postsPerBlock,
										label: __( 'Number of items', 'ajv-proto' ),
										onChange: ( value ) => {
											1 < value ? props.setAttributes({ postsPerBlock: value }) : props.setAttributes({ postsPerBlock: 1 });
										}
									}
								)
							),
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
				el( 'div',
					{
						className: props.className
					},
					el( InnerBlocks,
						{
							template: template,
							templateLock: 'all' // Can use 'all', 'block' or false.
						}
					),
					el( serverSideRender,
						{
							block: 'ajv-proto/posts-grid',
							attributes: props.attributes
						}
					)
				)
			];
		},

		save: function( props ) {
			return (
				el( InnerBlocks.Content )
			);
		}
	});
}(
	window.wp.blocks,
	window.wp.blockEditor,
	window.wp.element,
	window.wp.components
) );
