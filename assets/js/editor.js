( function( blocks, editor, element ) {
	const __ = wp.i18n.__;
	const el = element.createElement;
	const registerBlockType = blocks.registerBlockType;
	const { BlockControls, InspectorControls, AlignmentToolbar, PanelColorSettings } = editor;
	const { Fragment } = element;

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
								title: 'Color Settings',
								initialOpen: true,
								colorSettings: [
									{
										colors: colorSamples,
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
					{ className: props.className },
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

wp.domReady( () => {

	wp.blocks.unregisterBlockType( 'core/verse' );

	wp.blocks.unregisterBlockStyle(
		'core/quote',
		[ 'large' ]
	);

	let checked = true;

	wp.data.subscribe( () => {
		const isSavingMetaBoxes = wp.data.select( 'core/edit-post' ).isSavingMetaBoxes();

		if ( isSavingMetaBoxes ) {
			checked = false;
		} else {
			if ( ! checked ) {

				const metaboxInput = document.querySelector( '#ajv-proto-layout-meta-box .selected input[type="radio"]' );

				const metaboxValue = metaboxInput ? metaboxInput.value : 'default-layout';

				const databaseValue = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'meta' )._ajv_proto_post_layout;

				if ( metaboxValue !== databaseValue ) {

					window.location.reload( true );
				}

				checked = true;
			}
		}
	});

});

wp.domReady( () => {

	const el = wp.element.createElement;
	const Fragment = wp.element.Fragment;
	const PluginSidebar = wp.editPost.PluginSidebar;
	const PluginSidebarMoreMenuItem = wp.editPost.PluginSidebarMoreMenuItem;
	const registerPlugin = wp.plugins.registerPlugin;
	const moreIcon = 'layout';

	function Component() {
		return el(
			Fragment,
			{},
			el(
				PluginSidebarMoreMenuItem,
				{
					target: 'sidebar-name'
				},
				'Layout Settings'
			),
			el(
				PluginSidebar,
				{
					name: 'sidebar-name',
					title: 'Layout Settings'
				},
				'Content of the sidebar'
			)
		);
	}
	registerPlugin( 'plugin-name', {
		icon: moreIcon,
		render: Component
	});
});
