
<?php $format = get_post_format(); ?>
<span class="post_type_label <?php echo esc_attr( $format ); ?>"></span>
<?php if ( false != get_theme_mod('post_meta')) { ?>
<span class="post_date"><time datetime="<?php the_time('Y-m-d\TH:i:s'); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time></span>
	<!-- Post Meta -->
	<?php
		if ('aside' == $format) {
	?>
	<div class="post_meta aside">
		<?php if ( get_the_category() ) {?><span class="post_category"><?php the_category(' ') ?></span><?php } ?>
		<span class="post_comment"><i class="fa fa-comments"></i><?php comments_popup_link(__('No comments', 'duena-revival'), __('One comment', 'duena-revival'), __('% comments', 'duena-revival'), 'comments-link', __('Comments are closed', 'duena-revival') ); ?></span>
		<span class="post_author"><i class="fa fa-user"></i><?php the_author_posts_link() ?></span>
		<div class="clear"></div>
	</div>
	<?php
		} elseif ('chat' == $format) {
	?>
	<div class="post_meta chat">
		<?php if ( get_the_category() ) {?><span class="post_category"><?php the_category(' ') ?></span><?php } ?>
		<span class="post_comment"><i class="fa fa-comments"></i><?php comments_popup_link(__('No comments', 'duena-revival'), __('One comment', 'duena-revival'), __('% comments', 'duena-revival'), 'comments-link', __('Comments are closed', 'duena-revival') ); ?></span>
		<span class="post_author"><i class="fa fa-user"></i><?php the_author_posts_link() ?></span>
		<div class="clear"></div>
	</div>
	<?php
		} elseif ('link' == $format) {
	?>
	<div class="post_meta link">
		<?php if ( get_the_category() ) {?><span class="post_category"><?php the_category(' ') ?></span><?php } ?>
		<?php if ( !is_singular() ) { ?>
		<span class="post_permalink"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e(__('Permalink to:', 'duena-revival'));?> <?php the_title(); ?>"><i class="fa fa-link"></i><?php _e(__('Permalink', 'duena-revival')) ?></a></span>
		<?php } ?>
		<span class="post_author"><i class="fa fa-user"></i><?php the_author_posts_link() ?></span>
		<div class="clear"></div>
	</div>
	<?php
		} elseif ('quote' == $format) {
	?>
	<div class="post_meta quote">
		<?php if ( get_the_category() ) {?><span class="post_category"><?php the_category(' ') ?></span><?php } ?>
		<?php if ( !is_singular() ) { ?>
		<span class="post_permalink"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e(__('Permalink to:', 'duena-revival'));?> <?php the_title(); ?>"><i class="fa fa-link"></i><?php _e(__('Permalink', 'duena-revival')) ?></a></span>
		<?php } ?>
		<span class="post_comment"><i class="fa fa-comments"></i><?php comments_popup_link(__('No comments', 'duena-revival'), __('One comment', 'duena-revival'), __('% comments', 'duena-revival'), 'comments-link', __('Comments are closed', 'duena-revival') ); ?></span>
		<span class="post_author"><i class="fa fa-user"></i><?php the_author_posts_link() ?></span>
		<div class="clear"></div>
	</div>
	<?php
		} elseif ('status' == $format) {
	?>
	<div class="post_meta status">
		<?php if ( get_the_category() ) {?><span class="post_category"><?php the_category(' ') ?></span><?php } ?>
		<?php if ( !is_singular() ) { ?>
		<span class="post_permalink"><a href="<?php the_permalink(); ?>" title="<?php esc_attr_e(__('Permalink to:', 'duena-revival'));?> <?php the_title(); ?>"><i class="fa fa-link"></i><?php _e(__('Permalink', 'duena-revival')) ?></a></span>
		<?php } ?>
		<span class="post_comment"><i class="fa fa-comments"></i><?php comments_popup_link(__('No comments', 'duena-revival'), __('One comment', 'duena-revival'), __('% comments', 'duena-revival'), 'comments-link', __('Comments are closed', 'duena-revival') ); ?></span>
		<span class="post_author"><i class="fa fa-user"></i><?php the_author_posts_link() ?></span>
		<div class="clear"></div>
	</div>
	<?php
		} else {
	?>
	<div class="post_meta default">
		<?php if ( get_the_category() ) {?><span class="post_category"><?php the_category(' ') ?></span><?php } ?>
		<span class="post_comment"><i class="fa fa-comments"></i><?php comments_popup_link(__('No comments', 'duena-revival'), __('One comment', 'duena-revival'), __('% comments', 'duena-revival'), 'comments-link', __('Comments are closed', 'duena-revival') ); ?></span>
		<span class="post_author"><i class="fa fa-user"></i><?php the_author_posts_link() ?></span>
		<div class="clear"></div>
	</div>
	<?php } ?>
	<!--// Post Meta -->
<?php } ?>
