<?php if(!is_singular()) { ?>

  <?php if ( function_exists('duena_revival_pagination') ) : ?>
  	<?php duena_revival_pagination($wp_query->max_num_pages); ?>
  <?php else : ?>
    <?php if ( $wp_query->max_num_pages > 1 ) : ?>
      <ul class="pager">
        <li class="previous">
          <?php next_posts_link( __('&laquo; Older Entries', 'duena-revival')) ?>
        </li><!--.older-->
        <li class="next">
          <?php previous_posts_link(__('Newer Entries &raquo;', 'duena-revival')) ?>
        </li><!--.newer-->
      </ul><!--.oldernewer-->
    <?php endif; ?>
  <?php endif; ?>
<?php } else { ?>
<div class="single-post-nav">
    <?php previous_post_link('%link', '&larr; %title'); ?>
    <?php next_post_link('%link', '%title &rarr;'); ?>
</div>
<?php } ?>
<!-- Posts navigation -->
