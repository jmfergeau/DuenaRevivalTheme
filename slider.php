
    <?php
        $sl_num = get_theme_mod('sl_num');
        if ( "" != $sl_num ) {
            $sl_num = (int)$sl_num;
        } else {
            $sl_num = 4;
        }

        $sl_args = array(
            'posts_per_page'      => $sl_num,
            'ignore_sticky_posts' => 1
        );
        $sl_category = get_theme_mod( 'sl_category', 'from_all' );

        if ( 'from_all' != $sl_category ) {
            $sl_args['cat'] = intval( $sl_category );
        }
        $slider_query = new WP_Query( $sl_args );
        $checkthumb = 0;
        while ( $slider_query->have_posts() ) : $slider_query->the_post();
            if(has_post_thumbnail( $post->ID )){
                $checkthumb = 1;
            }
        endwhile;
        if( $slider_query && ( 1 == $checkthumb ) ){
    ?>
<div class="flexslider">
    <ul class="slides">
    <?php
            while ( $slider_query->have_posts() ) : $slider_query->the_post();
            $sl_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slider-post-thumbnail');
    ?>
    <?php if(has_post_thumbnail( $post->ID )){
    ?>
        <li>
            <?php if ( 'false' != get_theme_mod('sl_as_link') ) { ?>
            <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
            <?php } ?>
                <img src="<?php echo esc_url( $sl_image_url[0] ); ?>" alt="<?php the_title(); ?>" />
            <?php if ( 'false' != get_theme_mod('sl_as_link') ) { ?>
            </a>
            <?php } ?>
            <?php
                if ( 'show' == get_theme_mod('sl_caption')) {
            ?>
                <div class="slider-caption">
                    <?php
                        if ( 'hide' != get_theme_mod('sl_capt_title')) { ?>
                        <h4><?php the_title(); ?></h4>
                    <?php
                        }
                        if ( ( 'hide' != get_theme_mod('sl_capt_exc')) && ( '0' != esc_attr(get_theme_mod('sl_capt_exc_length')) ) ) {
                             $exc_length = (int)esc_attr(get_theme_mod('sl_capt_exc_length'));
                             if ($exc_length <= 0) $exc_length = 20;
                    ?>
                    <div class="sl-capt-content"><?php
                        $excerpt = get_the_excerpt();
                        echo duena_revival_string_limit_words($excerpt,$exc_length);
                    ?></div>
                    <?php
                        }
                    ?>
                    <?php if ( 'hide' != get_theme_mod('sl_capt_btn') ) {
                        if ( '' != esc_attr(get_theme_mod('sl_capt_btn_txt')) ) {
                            $btn_txt = esc_attr(get_theme_mod('sl_capt_btn_txt'));
                        } else {
                            $btn_txt = __( 'Read more', 'duena-revival' );
                        }
                    ?>
                    <a href="<?php the_permalink(); ?>" class="wp-block-button__link" title="<?php the_title(); ?>"><?php echo $btn_txt; ?></a>
                    <?php } ?>
                </div>
            <?php
                }
            ?>
        </li>
    <?php }  ?>

    <?php endwhile; ?>
    </ul>
</div>

<script type="text/javascript">
/* <![CDATA[ */
    jQuery(window).load(function() {
        jQuery('.flexslider').flexslider({
            animation: "<?php if (get_theme_mod('sl_effect') != '') { echo  esc_attr(get_theme_mod('sl_effect')); } else { echo 'fade'; }; ?>",
            direction: "<?php if (get_theme_mod('sl_direction') != '') { echo esc_attr(get_theme_mod('sl_direction')); } else { echo 'horizontal'; }; ?>",
            slideshow: <?php if (get_theme_mod('sl_slideshow') != '') { echo esc_attr(get_theme_mod('sl_slideshow')); } else { echo 'true'; }; ?>,
            controlNav: <?php if (get_theme_mod('sl_control') != '') { echo esc_attr(get_theme_mod('sl_control')); } else { echo 'true'; }; ?>,
            directionNav: <?php if (get_theme_mod('sl_direction_nav') != '') { echo esc_attr(get_theme_mod('sl_direction_nav')); } else { echo 'true'; }; ?>
        });
    });
/* ]]> */
</script>
<?php } ?>
    <?php
        wp_reset_query();
        wp_reset_postdata();
    ?>
