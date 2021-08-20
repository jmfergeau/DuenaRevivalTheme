<?php
/**
 * The template for displaying Author bios.
 *
 * @package duena-revival
 *
 */
?>
<?php if ( false != esc_attr( get_theme_mod('post_author', true) ) ) { ?>
<div class="author-info">
	<figure class="thumbnail">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 80, '' ,get_the_author_meta( 'nickname' ) ); ?>
	</figure><!-- .author-avatar -->
	<div class="author-description">
		<h2><?php _e( "About", "duena-revival" ); ?> <a tabindex="0" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author() ?></a></h2>
		<p>
			<?php the_author_meta( 'description' ); ?>
		</p>
	</div><!-- .author-description -->
</div><!-- .author-info -->
<?php } ?>
