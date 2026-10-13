<?php
/**
 * Theme setup and assets.
 *
 * @package YoubouBlocks
 */

/**
 * Configure translations and supplementary editor styles.
 *
 * @return void
 */
function youbou_blocks_setup() {
	load_theme_textdomain( 'youboublocks', get_template_directory() . '/languages' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'youbou_blocks_setup' );

/**
 * Enqueue style sheet.
 *
 * @since 1.0.0
 */
function youbou_blocks_enqueue_style() {
	wp_enqueue_style( 'youbou_blocks_style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'youbou_blocks_enqueue_style' );

require_once get_template_directory() . '/inc/blocks.php';
