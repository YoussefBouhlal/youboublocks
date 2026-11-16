<?php
/**
 * Title: Post Comments
 * Slug: youboublocks/post-comments
 * Inserter: no
 *
 * @package YoubouBlocks
 */

if ( version_compare( get_bloginfo( 'version' ), '6.1', '<' ) ) {
	echo '<!-- wp:post-comments /-->';
	return;
}
?>

<!-- wp:comments -->
<div class="wp-block-comments">
	<!-- wp:comments-title {"showPostTitle":false} /-->
	<!-- wp:comment-template -->
		<!-- wp:comment-author-name /-->
		<!-- wp:comment-date /-->
		<!-- wp:comment-content /-->
		<!-- wp:comment-reply-link /-->
	<!-- /wp:comment-template -->
	<!-- wp:comments-pagination {"layout":{"type":"flex","justifyContent":"space-between"}} -->
	<div class="wp-block-comments-pagination">
		<!-- wp:comments-pagination-previous /-->
		<!-- wp:comments-pagination-numbers /-->
		<!-- wp:comments-pagination-next /-->
	</div>
	<!-- /wp:comments-pagination -->
	<!-- wp:post-comments-form /-->
</div>
<!-- /wp:comments -->