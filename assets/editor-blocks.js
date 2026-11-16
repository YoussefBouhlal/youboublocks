( function( blocks, blockEditor, components, element, i18n, serverSideRender ) {
	'use strict';

	const apiVersion = window.youbouBlocksSettings
		? window.youbouBlocksSettings.apiVersion
		: 2;

	const ServerSideRender =
		serverSideRender.ServerSideRender ||
		serverSideRender.default ||
		serverSideRender;
	const createElement = element.createElement;

	blocks.registerBlockType( 'youboublocks/post-preview', {
		apiVersion,
		title: i18n.__( 'Post Preview', 'youboublocks' ),
		icon: 'excerpt-view',
		category: 'theme',
		parent: [ 'core/post-template' ],
		usesContext: [ 'postId', 'postType' ],
		supports: { html: false },
		edit( props ) {
			const blockProps = blockEditor.useBlockProps();
			if ( ! props.context.postId ) {
				return createElement(
					'div',
					blockProps,
					i18n.__( 'Post preview', 'youboublocks' ),
				);
			}
			return createElement(
				'div',
				blockProps,
				createElement( ServerSideRender, {
					block: 'youboublocks/post-preview',
					attributes: props.attributes,
					urlQueryArgs: { post_id: props.context.postId },
				} ),
			);
		},
		save() {
			return null;
		},
	} );

	blocks.registerBlockType( 'youboublocks/copyright', {
		apiVersion,
		title: i18n.__( 'Copyright', 'youboublocks' ),
		icon: 'admin-site',
		category: 'theme',
		attributes: {
			holder: { type: 'string', default: '' },
		},
		supports: {
			html: false,
			color: { text: true, background: false },
			typography: { fontSize: true },
		},
		edit( props ) {
			return createElement(
				element.Fragment,
				null,
				createElement(
					blockEditor.InspectorControls,
					null,
					createElement(
						components.PanelBody,
						{ title: i18n.__( 'Copyright settings', 'youboublocks' ) },
						createElement( components.TextControl, {
							label: i18n.__( 'Copyright holder', 'youboublocks' ),
							help: i18n.__( 'Leave empty to use the site title.', 'youboublocks' ),
							value: props.attributes.holder || '',
							onChange( holder ) {
								props.setAttributes( { holder } );
							},
						} ),
					),
				),
				createElement(
					'div',
					blockEditor.useBlockProps(),
					createElement( ServerSideRender, {
						block: 'youboublocks/copyright',
						attributes: props.attributes,
					} ),
				),
			);
		},
		save() {
			return null;
		},
	} );
}(
	window.wp.blocks,
	window.wp.blockEditor,
	window.wp.components,
	window.wp.element,
	window.wp.i18n,
	window.wp.serverSideRender,
) );
