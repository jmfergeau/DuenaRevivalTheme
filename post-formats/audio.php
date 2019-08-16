<!--BEGIN .hentry -->
<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder'); ?>>
	<?php $stickyclass = 'sticky'; ?>
	<header class="post-header <?php if( is_singular() && is_sticky() ) echo esc_attr( $stickyclass ); ?>">
		<?php if ( is_sticky() ) echo "<span class='featured_badge'><i class='fas fa-thumbtack' style='font-weight: 900;'></i><strong>".__( 'Featured', 'duena' )."</strong></span>"; ?>
		<?php if(!is_singular()) : ?>
			<h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e(__('Permalink to:', 'duena'));?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
		<?php else :?>
			<h1 class="post-title"><?php the_title(); ?></h1>
		<?php endif; ?>

	</header>

	<!-- Post Content -->
	<div class="post_content">
		<?php
			if ( function_exists('the_post_format_audio') ) {
				the_post_format_audio();
			}
		?>
		<?php
			if ( function_exists('the_remaining_content') ) {
				the_remaining_content( __( 'Continue reading', 'duena' ) );
			} else {
				the_content('');
			}
		?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'duena' ), 'after' => '</div>' ) ); ?>
	</div>
	<?php if( ( has_tag() ) && ( is_singular() ) ) { ?>
		<footer class="post-footer">
			<i class="fa fa-tags"></i> <?php the_tags(__( 'Tags: ', 'duena' ), ' ', ''); ?>
		</footer>
	<?php } ?>
	<!--// Post Content -->

	<?php get_template_part('post-formats/post-meta'); ?>

</article><!--END .hentry-->

<?php if ( is_single() && get_the_author_meta( 'description' ) ) {
	get_template_part( 'post-formats/author-bio' );
} ?>
