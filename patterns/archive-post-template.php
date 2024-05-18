<?php
/**
 * Title: Archive Post Template
 * Slug: youbou-blocks/archive-post-template
 * Categories: posts
 */
?>

<!-- wp:post-template {"layout":{"type":"default"}} -->
    <!-- wp:post-title {"isLink":true} /-->
    <!-- wp:post-content {"layout":{"type":"default"}} /-->
    <!-- wp:post-terms {"term":"category","prefix":"# "} /-->
    <!-- wp:spacer {"height":"120px"} -->
    <div style="height:120px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->
<!-- /wp:post-template -->

<!-- wp:query-pagination -->
    <!-- wp:query-pagination-previous /-->
    <!-- wp:query-pagination-numbers /-->
    <!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->

    <!-- wp:paragraph -->
    <p><?php esc_html_e( 'It looks like you\'ve stumbled upon a category that currently doesn\'t have any posts. Please check back later or explore other categories for more content.', 'youbou-blocks' ); ?></p>
    <!-- /wp:paragraph -->

    <!-- wp:heading -->
    <h2 class="wp-block-heading"><?php esc_html_e( 'Recent Posts', 'youbou-blocks' ); ?></h2>
    <!-- /wp:heading -->

    <!-- wp:latest-posts /-->

<!-- /wp:query-no-results -->