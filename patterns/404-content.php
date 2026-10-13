<?php
/**
 * Title: Not Found Content
 * Slug: youboublocks/404-content
 * Inserter: no
 *
 * @package YoubouBlocks
 */

?>
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( '404', 'youboublocks' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'This page could not be found. It may have moved or been deleted.', 'youboublocks' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:search {"showLabel":true,"buttonUseIcon":true} /-->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Recent Posts', 'youboublocks' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:latest-posts /-->