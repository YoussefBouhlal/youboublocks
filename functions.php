<?php

/**
 * Trime the content of the post in archive pages.
 * 
 * @param string $content
 * @since 1.0.0
 * @return string
 */
function youbou_blocks_trim_content_in_archive( $content ) {

    if ( ! is_single() ) {
        $content = str_replace( ']]>', ']]&gt;', $content );
        $content = explode( '<h2 class="wp-block-heading">', $content );
        $content = array_slice( $content, 0, 1 );
        $content = implode( '<h2 class="wp-block-heading">', $content );
        $content = preg_replace( '/<!--(.|\s)*?-->/', '', $content );
    }

    return $content;
}
add_filter( 'the_content', 'youbou_blocks_trim_content_in_archive' );
