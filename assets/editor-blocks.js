( function ( blocks, blockEditor, element, i18n, serverSideRender ) {
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
					i18n.__( 'Post preview', 'youboublocks' )
				);
			}
			return createElement(
				'div',
				blockProps,
				createElement( ServerSideRender, {
					block: 'youboublocks/post-preview',
					attributes: props.attributes,
					urlQueryArgs: { post_id: props.context.postId },
				} )
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
		supports: {
			html: false,
			color: { text: true, background: false },
			typography: { fontSize: true },
		},
		edit( props ) {
			return createElement(
				'div',
				blockEditor.useBlockProps(),
				createElement( ServerSideRender, {
					block: 'youboublocks/copyright',
					attributes: props.attributes,
				} )
			);
		},
		save() {
			return null;
		},
	} );
} )(
	window.wp.blocks,
	window.wp.blockEditor,
	window.wp.element,
	window.wp.i18n,
	window.wp.serverSideRender
);
