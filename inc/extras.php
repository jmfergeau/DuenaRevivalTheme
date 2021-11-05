<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package duena-revival
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function duena_revival_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'duena_revival_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 */
function duena_revival_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'duena_revival_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function duena_revival_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'duena_revival_enhanced_image_navigation', 10, 2 );

/**
 * Show gallery on blog page
 */
function duena_revival_gallery_sl() {
	global $post;
	?>
	<div class="gallery_slider gallery-<?php echo $post->ID; ?>">
	<?php
		global $post;
        $args = array(
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'numberposts' => 20,
            'post_status' => null,
            'post_parent' => $post->ID,
            'orderby' => 'menu_order',
            'order' => 'asc'
        );
        $attachments = get_posts( $args );
        if ( $attachments ) {
        	?>
			<ul class="slides">
        	<?php
        	$gal_counter = 0;
        	foreach ( $attachments as $attachment ) {
        		$cur_url = wp_get_attachment_url( $attachment->ID, false );

        	?>
        		<li>
	        	<?php

	        		$gal_image = wp_get_attachment_image_src( $attachment->ID,'image_post_format' );
	        		if ("" == $gal_image) $gal_image = $cur_url;
	        	?>
		        	<a href="<?php echo esc_url( $cur_url ); ?>" class="lightbox_img" data-effect="mfp-zoom-in">
		        		<img src="<?php echo esc_url( $gal_image[0] ); ?>" alt="">
		        	</a>
	        	</li>
	        	<?php
	        	$gal_counter ++;
        	}
        	?>
        	</ul>
        	<?php
        }
	?>
	</div>
	<?php if ( $attachments ) { ?>
	<script type="text/javascript">
	/* <![CDATA[ */
	    jQuery(window).load(function() {
	        jQuery('.gallery-<?php echo $post->ID; ?>').flexslider({
	            animation: 'fade',
	            slideshow: true,
	            controlNav: true,
	            directionNav: false
	        });

	        jQuery(".gallery-<?php echo $post->ID; ?> .lightbox_img").magnificPopup({
				type: 'image',
				removalDelay: 500, //delay removal by X to allow out-animation
				callbacks: {
				    beforeOpen: function() {
				      // just a hack that adds mfp-anim class to markup
				       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				       this.st.mainClass = this.st.el.attr('data-effect');
				    }
				},
				gallery:{enabled:true}
			});
	    });
	/* ]]> */
	</script>
	<?php
	}
}

/**
 * Image post format custom output
 */
function duena_revival_post_format_image() {
	global $post;
	if ( function_exists('get_post_format_meta') ) {
		$meta = get_post_format_meta( $post->ID );
	}
	if ( ! empty( $meta['image'] ) ) {
		$att_id = img_html_to_post_id( $meta['image'] );
		$image = wp_get_attachment_image( $att_id, array(770, 295) );
		$cur_url = wp_get_attachment_url( $att_id, false );
	} elseif ( has_post_thumbnail() ) {
		$post_thumbnail_id = get_post_thumbnail_id();
		$image = wp_get_attachment_image( $post_thumbnail_id, array(770, 295) );
		$cur_url = wp_get_attachment_url( $post_thumbnail_id, false );
	} else {
		$args = array(
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'numberposts' => 1,
            'post_status' => null,
            'post_parent' => $post->ID,
            'orderby' => 'menu_order',
            'order' => 'asc'
        );
        $attachments = get_posts( $args );

        if ( $attachments ) {
	        foreach ( $attachments as $attachment ) {
	        	$image = wp_get_attachment_image( $attachment->ID, array(770, 295) );
	        	$cur_url = wp_get_attachment_url( $attachment->ID, false );
	        }
        }
	}
	if (isset($cur_url)) {
		echo '<a href="'.$cur_url.'" class="lightbox_img single" data-effect="mfp-zoom-in">'.$image.'</a>';
	}
}

/**
 * Show loop on portfolio page template
 */
function duena_revival_portfolio_show() {
	wp_reset_query();
	global $post;
	$post_num = get_option( 'portfolio_per_page', '12' );
	$post_num = intval($post_num);
	if ( 0 == $post_num ) {
		$post_num = 12;
	}
	$args = array(
		'posts_per_page'      => $post_num,
		'ignore_sticky_posts' => 1
	);
	$from_cat = get_post_meta( $post->ID, 'duena_revival_portfolio_meta_cats', true );
	if ( '' != $from_cat && 'from_all' != $from_cat ) {
		$args['cat'] = $from_cat;
	}

	$count_portf = 0;
	$item_class = 'portf_item';
	$columns =  intval(get_post_meta( $post->ID, 'duena_revival_portfolio_meta_cols', true ));
	if ( '' == $columns || 0 == $columns ) {
		$columns = 3;
	}
	switch ($columns) {
		case 2:
			$item_class .= ' col-md-6';
			break;

		case 3:
			$item_class .= ' col-md-4';
			break;

		case 4:
			$item_class .= ' col-md-3';
			break;
	}

	$portf_query = new WP_Query( $args );
	if ( $portf_query->have_posts() ):
		while ( $portf_query->have_posts() ) :
			$portf_query->the_post(); ?>
			<div class="<?php echo esc_attr( $item_class ); ?>">
				<div class="hentry">
				<?php
					$show_thumb = get_option( 'portfolio_show_thumbnail', true );
					if ( true == $show_thumb ) {
				?>
					<figure class="featured-thumbnail thumbnail">
						<a href="<?php echo get_permalink(); ?>">
							<?php
								switch ($columns) {
									case 2:
										$thumb_size = 'portfolio-large-th';
										break;

									case 3:
										$thumb_size = 'post-thumbnail';
										break;

									case 4:
										$thumb_size = 'portfolio-small-th';
										break;
								}
								the_post_thumbnail( $thumb_size );
							?>
						</a>
					</figure>
				<?php } ?>
					<div class="post_content">
					<?php
						$show_title = get_option( 'portfolio_show_title', true );
						if ( true == $show_title ) {
					?>
						<h5>
							<a href="<?php echo get_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h5>
					<?php
						}
						$show_excerpt = get_option( 'portfolio_show_excerpt', true );
						if ( true == $show_excerpt ) {
					?>
						<div class="excerpt">
						<?php
							$excerpt = get_the_excerpt();
							if (has_excerpt()) {
								the_excerpt();
							} else {
								echo apply_filters( 'the_excerpt', duena_revival_string_limit_words($excerpt,20) );
							}
						?>
						</div>
					<?php
						}
						$show_link = get_option( 'portfolio_show_link', 'true' );
						if ( 'true' == $show_link ) {
					?>
						<a href="<?php the_permalink() ?>" class="more_link"><?php _e('Read more', 'duena-revival'); ?></a>
					<?php } ?>
					</div>
				</div>
			</div>
			<?php
			$count_portf++;
			$portf_num = $count_portf % $columns;
			if ( 0 == $portf_num ) {
				?>
				<div class="clear"></div>
				<?php
			}
		endwhile;
	endif;
	wp_reset_query();
}

/**
 * Get colors
 */
function duena_revival_get_user_colors() {
	$primary_color = get_theme_mod( 'cs_primary_color', '#ff5b5b' );
	$secondary_color = get_theme_mod( 'cs_secondary_color', '#71a08b' );
	$background_color = get_theme_mod( 'cs_background_color', '#210f1d' );

	// This is where the top page pic changes
	if ( $primary_color == '#ff5b5b') {
		$pagetoppic = 'url('.get_template_directory_uri().'/images/page-top-bg.jpg) no-repeat center 0 #FF5B5B';
	} else {
		$pagetoppic = $primary_color.' no-repeat center 0';
	}

	$colors = "
	.page-wrapper:before { background: " . $pagetoppic . "; }

	a, .text-primary, .btn-link, a.list-group-item.active > .badge, .nav-pills > .active > a > .badge, .post-title a:hover,
	.page-links a:hover, .page-links > span, .post-footer i, .post_meta i, .page_nav_wrap .post_nav ul li a:hover, .page_nav_wrap .post_nav ul li .current,
	.author_bio_sidebar .social_box a, .author_bio_sidebar .author_bio_message h3, .author_bio_sidebar .author_bio_message h4, .author_bio_sidebar .author_bio_message h5,
	.author_bio_sidebar .author_bio_message h6, .error404-num, .searchform .screen-reader-text, .has-user-primary-color {
		color: " . $primary_color . ";
	}

	.featured_badge, .post-footer a, .tagcloud a, .author_bio_sidebar .social_box, #toTop, button, html input[type='button'], input[type='reset'],
	input[type='submit'], .wp-block-file .wp-block-file__button, .wp-block-button__link, .flex-control-paging li a:hover, .flex-control-paging li a.flex-active, #content .featured_badge {
		background: " . $primary_color . ";
	}

	.btn-primary, .btn-inverse:active, .btn-inverse.active, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .nav-pills > li.active > a,
	.nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus, .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover,
	.pagination > .active > span:hover, .author_bio_sidebar .social_box, .flex-direction-nav a,
	.pagination > .active > a:focus, .pagination > .active > span:focus, .label-primary, .btn-inverse:hover, .btn-inverse:active, .btn-inverse.active, a.list-group-item.active,
	a.list-group-item.active:hover, a.list-group-item.active:focus, .panel-primary > .panel-heading, .post_type_label, .has-user-primary-background-color {
		background-color: " . $primary_color . ";
	}

	.nav .open > a, .nav .open > a:hover, .nav .open > a:focus,
	.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus,
	.pagination > .active > span:focus, a.thumbnail:hover, a.thumbnail:focus, a.thumbnail.active, .progress-bar, a.list-group-item.active, a.list-group-item.active:hover,
	a.list-group-item.active:focus, .panel-primary, .panel-primary > .panel-heading {
		border-color: " . $primary_color . ";
	}

	a:hover, a:focus, .btn-link:hover, .btn-link:focus, .footer-menu li.current_page_item a, .footer-menu li.current-menu-item a, .has-user-secondary-color {
		color: " . $secondary_color . ";
	}

	.btn-primary:hover, input[type='submit']:hover, input[type='reset']:hover, .slider-caption .btn.btn-primary:hover, .post-footer a:hover, .has-user-secondary-background-color {
		background-color: " . $secondary_color . ";
	}

	.navbar_inner > div > ul > li > a, .navbar_inner > ul > li > a {
		border-bottom: 0 solid " . $primary_color . ";
	}

	.navbar_inner > ul ul, .btn-inverse.disabled, .btn-inverse[disabled] { background-color: " . $primary_color . "; *background-color: " . $primary_color . "; }

	textarea:focus,
	input[type='text']:focus,
	input[type='password']:focus,
	input[type='datetime']:focus,
	input[type='datetime-local']:focus,
	input[type='date']:focus,
	input[type='month']:focus,
	input[type='time']:focus,
	input[type='week']:focus,
	input[type='number']:focus,
	input[type='email']:focus,
	input[type='url']:focus,
	input[type='search']:focus,
	input[type='tel']:focus,
	input[type='color']:focus,
	.uneditable-input:focus {
		border-color: " . $primary_color . ";
		box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 2px " . $primary_color . ";
	}

	.breadcrumb, #slider-wrapper .flexslider, .author-info, .comments-area, .comment-list .bypostauthor .comment-body, .widget {
    border-top: 6px solid " . $primary_color . ";
	}

	.navbar_inner > div > ul > li > a:hover, .navbar_inner > div > ul > li.sfHover > a, .navbar_inner > div > ul > li.current-menu-item > a, .navbar_inner > div > ul > li.current_page_item > a,
	.navbar_inner > ul > li > a:hover, .navbar_inner > ul > li.sfHover > a, .navbar_inner > ul > li.current-menu-item > a, .navbar_inner > ul > li.current_page_item > a, .site-info {
	border-bottom: 6px solid " . $primary_color . "; }

	.panel-primary > .panel-heading + .panel-collapse .panel-body { border-top-color: " . $primary_color . "; }
	.panel-primary > .panel-footer + .panel-collapse .panel-body { border-bottom-color: " . $primary_color . "; }
	.navbar_inner > ul > li > a { border-bottom: 0 solid " . $primary_color . "; }
	.flex-direction-nav a { background-color: " . $primary_color . "; }

	a:hover, a:focus, .btn-link:hover, .btn-link:focus, .footer-menu li.current_page_item a, .footer-menu li.current-menu-item a, .has-user-secondary-color {
	color: " . $secondary_color . "; }


	@media (min-width: 1200px) and (max-width: 1350px) { #primary .post_date time { color: " . $secondary_color . "; }}
	@media (min-width: 980px) and (max-width: 1100px) { #primary .post_date time { color: " . $secondary_color . "; }}
	@media (max-width: 979px) { #primary .post_date time { color: " . $secondary_color . "; }}
	@media (min-width: 768px) and (max-width: 979px) { .navbar_inner > div > ul > li > a, .navbar_inner > ul > li > a { border-bottom: 0 solid " . $primary_color . "; }}

	@media (min-width: 768px) and (max-width: 979px) { .navbar_inner > div > ul > li > a:hover, .navbar_inner > div > ul > li.sfHover > a, .navbar_inner > div > ul > li.current-menu-item > a,
	.navbar_inner > div > ul > li.current_page_item > a, .navbar_inner > ul > li > a:hover, .navbar_inner > ul > li.sfHover > a, .navbar_inner > ul > li.current-menu-item > a,
	.navbar_inner > ul > li.current_page_item > a { color: " . $primary_color . "; border-bottom: 0 solid " . $primary_color . "; }}

	@media (min-width: 1200px) and (max-width: 1350px) { #content .featured_badge { background: " . $primary_color . "; }}
	@media (min-width: 980px) and (max-width: 1100px) { #content .featured_badge { background: " . $primary_color . "; }}
	@media (max-width: 979px) { #content .featured_badge { background: " . $primary_color . "; }}
	@media (max-width: 480px) { .error404-num { color: " . $primary_color . "; }}

	@media (prefers-color-scheme: dark) {
		.single-post-nav a:hover { background: " . $primary_color . " !important; }
	";


	$list_bullet = get_option( 'cs_list_bullet' );
	if ( '' != $list_bullet ) {
		$colors .= "
		ul li {
			background: url(" . esc_url( $list_bullet ) . ") no-repeat 0 0;
		}
		";
	}

	return $colors;
}

/**
 * Add Portfolio page template custom fields
 */
function duena_revival_add_portfolio_meta_box() {
	add_meta_box( 'duena-revival-portfolio-page', __( 'Page Options', 'duena-revival' ), 'duena_revival_show_porfolio_metabox', 'page', 'normal', 'high' );
}
add_action('admin_menu', 'duena_revival_add_portfolio_meta_box');

function duena_revival_show_porfolio_metabox( $post ) {
	echo '<input type="hidden" name="duena_revival_portfolio_meta_box_nonce" value="' . wp_create_nonce( basename(__FILE__) ) . '" />';
	echo '<table class="form-table">';
		echo '<tr>';
			echo '<td>';
				_e( 'Select columns number', 'duena-revival' );
			echo '</td>';
			echo '<td>';

				$curr_cols = intval(get_post_meta( $post->ID, 'duena_revival_portfolio_meta_cols', true ));
				if ( '' == $curr_cols || 0 == $curr_cols ) {
					$curr_cols = 3;
				}

				echo '<select name="duena_revival_portfolio_meta_cols">';
					echo '<optgroup>';
						echo '<option value="2" ' . selected( $curr_cols, 2, false ) . '>2</option>';
						echo '<option value="3" ' . selected( $curr_cols, 3, false ) . '>3</option>';
						echo '<option value="4" ' . selected( $curr_cols, 4, false ) . '>4</option>';
					echo '</optgroup>';
				echo '</select>';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td>';
				_e( 'Select category to pull posts from', 'duena-revival' );
			echo '</td>';
			echo '<td>';

				// Pull all the categories into an array
				$all_categories = array();
				$all_categories_obj = get_categories();
				foreach ($all_categories_obj as $category) {
						$all_categories[$category->cat_ID] = $category->cat_name;
				}

				$all_cats_array = array('from_all' => __( 'Select from all', 'duena-revival' ) ) + $all_categories;

				$curr_cat = get_post_meta( $post->ID, 'duena_revival_portfolio_meta_cats', true );
				if ( '' == $curr_cat ) {
					$curr_cat = 'from_all';
				}

				echo '<select name="duena_revival_portfolio_meta_cats">';
					echo '<optgroup>';
					foreach ($all_cats_array as $cat_id => $cat_name) {
						echo '<option value="' . $cat_id . '" ' . selected( $curr_cat, $cat_id, false ) . '>' . $cat_name . '</option>';
					}
					echo '</optgroup>';
				echo '</select>';
			echo '</td>';
		echo '</tr>';
	echo '</table>';
}

/**
 * Save Portfolio page template custom fields
 */
function duena_revival_save_portfolio_meta( $post_id ) {

	// verify nonce
	if (!isset($_POST['duena_revival_portfolio_meta_box_nonce']) || !wp_verify_nonce($_POST['duena_revival_portfolio_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
	// check user permissions
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	$saved_data = array( 'duena_revival_portfolio_meta_cols', 'duena_revival_portfolio_meta_cats' );

	foreach ( $saved_data as $single_field ) {
		$currnet_data = get_post_meta( $post_id, $single_field, true );
		$new_data = $_POST[$single_field];
		if ( isset($new_data) && $new_data != $currnet_data ) {
			update_post_meta( $post_id, $single_field, $new_data, $currnet_data );
		}

	}


}
add_action('save_post', 'duena_revival_save_portfolio_meta');
?>
