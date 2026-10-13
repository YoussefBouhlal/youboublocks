<?php
/**
 * Title: Archive Post Template
 * Slug: youboublocks/archive-post-template
 * Categories: posts
 *
 * @package YoubouBlocks
 */

?>

<!-- wp:query {"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":true},"layout":{"type":"default"}} -->
<div class="wp-block-query">

	<!-- wp:post-template {"className":"youbou-blocks-post-list","layout":{"type":"default"}} -->
		<!-- wp:post-title {"level":2,"isLink":true} /-->
		<!-- wp:youboublocks/post-preview /-->
		<!-- wp:post-terms {"term":"category","prefix":"# "} /-->
	<!-- /wp:post-template -->

	<!-- wp:query-pagination {"paginationArrow":"chevron","showLabel":false} -->
		<!-- wp:query-pagination-previous /-->
		<!-- wp:query-pagination-numbers /-->
		<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->

	<!-- wp:query-no-results -->
		<!-- wp:paragraph -->
		<p><?php esc_html_e( 'No matching content was found. Try another search or explore the recent posts below.', 'youboublocks' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:heading -->
		<h2 class="wp-block-heading"><?php esc_html_e( 'Recent Posts', 'youboublocks' ); ?></h2>
		<!-- /wp:heading -->
		<!-- wp:latest-posts /-->
	<!-- /wp:query-no-results -->

</div>
<!-- /wp:query -->
