<!--BEGIN .hentry -->
<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>

	<!-- Post Content -->
	<div class="post_content <?php if( is_singular() && is_sticky() ) echo esc_attr( $stickyclass ); ?>">
		<?php if ( is_sticky() ) echo "<span class='featured_badge'><i class='fas fa-thumbtack' style='font-weight: 900;'></i><strong>".__( 'Featured', 'duena' )."</strong></span>"; ?>
		<?php the_content( __( 'Continue reading', 'duena' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'duena' ), 'after' => '</div>' ) ); ?>

	</div>
	<!-- //Post Content -->
	<?php if( ( has_tag() ) && ( is_singular() ) ) { ?>
		<footer class="post-footer">
			<i class="icon-tags"></i> <?php the_tags(__( 'Tags: ', 'duena' ), ' ', ''); ?>
		</footer>
	<?php } ?>
	<?php get_template_part('post-formats/post-meta'); ?>

</article><!--END .hentry-->

<?php if ( is_single() && get_the_author_meta( 'description' ) ) {
	get_template_part( 'post-formats/author-bio' );
} ?>
