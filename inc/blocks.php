<?php
/**
 * Dynamic theme blocks.
 *
 * @package YoubouBlocks
 */

/**
 * Register the listing preview and its editor script.
 *
 * @return void
 */
function youbou_blocks_register_blocks() {
	$api_version = version_compare( get_bloginfo( 'version' ), '6.3', '>=' ) ? 3 : 2;

	wp_register_script(
		'youbou-blocks-editor',
		get_template_directory_uri() . '/assets/editor-blocks.js',
		array( 'wp-blocks', 'wp-block-editor', 'wp-element', 'wp-i18n', 'wp-server-side-render' ),
		wp_get_theme( get_template() )->get( 'Version' ),
		true
	);
	wp_add_inline_script( 'youbou-blocks-editor', 'window.youbouBlocksSettings = ' . wp_json_encode( array( 'apiVersion' => $api_version ) ) . ';', 'before' );
	wp_set_script_translations( 'youbou-blocks-editor', 'youboublocks', get_template_directory() . '/languages' );

	register_block_type(
		'youboublocks/post-preview',
		array(
			'api_version'     => $api_version,
			'editor_script'   => 'youbou-blocks-editor',
			'uses_context'    => array( 'postId', 'postType' ),
			'render_callback' => 'youbou_blocks_render_post_preview',
			'supports'        => array( 'html' => false ),
		)
	);
	register_block_type(
		'youboublocks/copyright',
		array(
			'api_version'     => $api_version,
			'editor_script'   => 'youbou-blocks-editor',
			'render_callback' => 'youbou_blocks_render_copyright',
			'supports'        => array(
				'html'       => false,
				'color'      => array(
					'text'       => true,
					'background' => false,
				),
				'typography' => array( 'fontSize' => true ),
			),
		)
	);
}
add_action( 'init', 'youbou_blocks_register_blocks' );

/**
 * Render the copyright year on every request, including saved templates.
 *
 * @return string Copyright markup.
 */
function youbou_blocks_render_copyright() {
	/* translators: 1: Current year, 2: Copyright holder. */
	$text = sprintf( __( 'Copyright %1$s %2$s', 'youboublocks' ), wp_date( 'Y' ), 'YOUSSEF BOUHLAL' );
	return '<p ' . get_block_wrapper_attributes( array( 'class' => 'youbou-blocks-copyright' ) ) . '>' . esc_html( $text ) . '</p>';
}

/**
 * Find an H2 in a block or reference without rendering it.
 *
 * @param array $block Parsed block.
 * @param array $references References already visited on this branch.
 * @param int   $depth Current traversal depth.
 * @return bool|null Whether an H2 exists, or null for an unsafe reference.
 */
function youbou_blocks_has_preview_heading( $block, $references = array(), $depth = 0 ) {
	if ( 50 <= $depth ) {
		return null;
	}
	if ( 'core/heading' === $block['blockName'] && 2 === (int) ( $block['attrs']['level'] ?? 2 ) ) {
		return true;
	}
	if ( 'core/block' === $block['blockName'] ) {
		$reference_id = absint( $block['attrs']['ref'] ?? 0 );
		$reference    = get_post( $reference_id );
		if ( ! $reference_id || in_array( $reference_id, $references, true ) || ! $reference || 'wp_block' !== $reference->post_type || 'publish' !== $reference->post_status || post_password_required( $reference ) ) {
			return null;
		}
		$references[] = $reference_id;
		$children     = parse_blocks( $reference->post_content );
	} else {
		$children = $block['innerBlocks'];
	}
	foreach ( $children as $child ) {
		$result = youbou_blocks_has_preview_heading( $child, $references, $depth + 1 );
		if ( false !== $result ) {
			return $result;
		}
	}
	return false;
}

/**
 * Select complete introductory blocks.
 *
 * @param string $content Original post content.
 * @return array Selection, H2 presence and reference safety.
 */
function youbou_blocks_select_preview( $content ) {
	$intro = array();
	foreach ( parse_blocks( $content ) as $block ) {
		$result = youbou_blocks_has_preview_heading( $block );
		if ( null === $result ) {
			return array(
				'content' => '',
				'heading' => false,
				'safe'    => false,
			);
		}
		if ( $result ) {
			return array(
				'content' => serialize_blocks( $intro ),
				'heading' => true,
				'safe'    => true,
			);
		}
		$intro[] = $block;
	}
	return array(
		'content' => '',
		'heading' => false,
		'safe'    => true,
	);
}

/**
 * Render a preview without changing full post content or leaking protected text.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content Saved block content.
 * @param WP_Block $block Current block instance.
 * @return string Preview markup.
 */
function youbou_blocks_render_post_preview( $attributes, $content, $block ) {
	static $rendering = array();

	$post_id      = absint( $block->context['postId'] ?? 0 );
	$preview_post = $post_id ? get_post( $post_id ) : null;
	if ( ! $preview_post || isset( $rendering[ $post_id ] ) ) {
		return '';
	}
	$wrapper = get_block_wrapper_attributes( array( 'class' => 'entry-content youbou-blocks-post-preview' ) );
	if ( post_password_required( $preview_post ) ) {
		return '<div ' . $wrapper . '><p>' . esc_html( get_the_excerpt( $preview_post ) ) . '</p></div>';
	}

	$rendering[ $post_id ] = true;
	$global_names          = array( 'post', 'id', 'authordata', 'currentday', 'currentmonth', 'page', 'pages', 'multipage', 'more', 'numpages' );
	$saved_globals         = array();
	foreach ( $global_names as $name ) {
		$saved_globals[ $name ] = array(
			'exists' => array_key_exists( $name, $GLOBALS ),
			'value'  => $GLOBALS[ $name ] ?? null,
		);
	}

	try {
		// phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- Match the Query Loop post for content filters; restore its context in finally.
		$GLOBALS['post'] = $preview_post;
		setup_postdata( $preview_post );
		$selection = youbou_blocks_select_preview( $preview_post->post_content );
		$intro     = '';
		if ( $selection['heading'] && '' !== trim( $selection['content'] ) ) {
			$source = preg_replace( '/<!--(?:more(?:.*?)|nextpage)-->/', '', $selection['content'] );
			$intro  = apply_filters( 'the_content', $source );
			if ( '' === trim( wp_strip_all_tags( $intro ) ) && ! preg_match( '/<(?:img|video|audio|iframe|svg)\b/i', $intro ) ) {
				$intro = '';
			}
		}
		if ( '' === $intro ) {
			if ( $selection['safe'] ) {
				$excerpt = get_the_excerpt( $preview_post );
			} else {
				$excerpt = $preview_post->post_excerpt ? $preview_post->post_excerpt : strip_shortcodes( $preview_post->post_content );
			}
			$intro = '<p>' . esc_html( wp_trim_words( wp_strip_all_tags( $excerpt ), 55 ) ) . '</p>';
		}

		/* translators: %s: Post title. */
		$link_label = sprintf( __( 'Read more about %s', 'youboublocks' ), wp_strip_all_tags( get_the_title( $preview_post ) ) );
		$link       = '<p class="youbou-blocks-read-more"><a href="' . esc_url( get_permalink( $preview_post ) ) . '" aria-label="' . esc_attr( $link_label ) . '">' . esc_html__( 'Read more', 'youboublocks' ) . '</a></p>';
		return '<div ' . $wrapper . '>' . $intro . $link . '</div>';
	} finally {
		foreach ( $saved_globals as $name => $saved ) {
			if ( $saved['exists'] ) {
				$GLOBALS[ $name ] = $saved['value'];
			} else {
				unset( $GLOBALS[ $name ] );
			}
		}
		unset( $rendering[ $post_id ] );
	}
}
