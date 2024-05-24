<?php
/**
 * Title: Archive Post Template
 * Slug: youboublocks/archive-post-template
 * Categories: posts
 */
?>

<!-- wp:query {"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":true},"layout":{"type":"default"}} -->
<div class="wp-block-query">

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
        <p><?php esc_html_e( 'It looks like you\'ve stumbled upon a category that currently doesn\'t have any posts. Please check back later or explore other categories for more content.', 'youboublocks' ); ?></p>
        <!-- /wp:paragraph -->
        <!-- wp:heading -->
        <h2 class="wp-block-heading"><?php esc_html_e( 'Recent Posts', 'youboublocks' ); ?></h2>
        <!-- /wp:heading -->
        <!-- wp:latest-posts /-->
    <!-- /wp:query-no-results -->

</div>
<!-- /wp:query -->
