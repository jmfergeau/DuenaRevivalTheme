<?php
/**
 * duena Theme Customizer
 *
 * @package duena
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function duena_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'duena_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function duena_customize_preview_js() {
	wp_enqueue_script( 'duena_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130304', true );
}
add_action( 'customize_preview_init', 'duena_customize_preview_js' );


// Customize primary color (2.1.0)
function duena_customize_colors() {
	$primary_color = get_option( 'cs_primary_color' );
	$secondary_color = get_option( 'cs_secondary_color' );

	if ($secondary_color == '') {
		$secondary_color = '#71A08B'; /* This will prevent a glitch that can make the value empty for some odd reason. For some even more odd reason, this doesn't seem to happen with the primary color. */
	}

	?>
	<style>
	<?php
	/* This will disable the top page picture if the main color has changed */
	if ( $primary_color == '#ff5b5b') {
		$pagetoppic = 'url('.get_template_directory_uri().'/images/page-top-bg.jpg) no-repeat center 0 #bd5bff';
	} else {
		$pagetoppic = $primary_color.' no-repeat center 0';
	} ?>

	.page-wrapper:before { background: <?php echo $pagetoppic; /* This is where the top page pic changes */ ?>; }

	a, .text-primary, .btn-link, a.list-group-item.active > .badge, .nav-pills > .active > a > .badge, .post-title a:hover,
	.page-links a:hover, .page-links > span, .post-footer i, .post_meta i, .page_nav_wrap .post_nav ul li a:hover, .page_nav_wrap .post_nav ul li .current,
	.author_bio_sidebar .social_box a, .author_bio_sidebar .author_bio_message h3, .author_bio_sidebar .author_bio_message h4, .author_bio_sidebar .author_bio_message h5,
	.author_bio_sidebar .author_bio_message h6, .error404-num, .searchform .screen-reader-text, .has-user-primary-color {
	color: <?php echo $primary_color; ?>; }

	#content .featured_badge, .post-footer a, .tagcloud a, .author_bio_sidebar .social_box, #toTop, button, html input[type="button"], input[type="reset"],
	input[type="submit"], .wp-block-file .wp-block-file__button, .wp-block-button__link, .flex-control-paging li a:hover, .flex-control-paging li a.flex-active {
	background: <?php echo $primary_color; ?>; }

	.navbar_inner > ul ul, .btn-inverse.disabled, .btn-inverse[disabled] { background-color: <?php echo $primary_color; ?>; *background-color: <?php echo $primary_color; /* wat */ ?>; }

	.btn-inverse:active, .btn-inverse.active, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .nav-pills > li.active > a,
	.nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus, .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover,
	.pagination > .active > a:focus, .pagination > .active > span:focus, .label-primary, .btn-inverse:hover, .btn-inverse:active, .btn-inverse.active, a.list-group-item.active,
	a.list-group-item.active:hover, a.list-group-item.active:focus, .panel-primary > .panel-heading, .post_type_label, .has-user-primary-background-color {
	background-color: <?php echo $primary_color; ?>; }

	textarea:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="date"]:focus,
	input[type="month"]:focus, input[type="time"]:focus, input[type="week"]:focus, input[type="number"]:focus, input[type="email"]:focus, input[type="url"]:focus,
	input[type="search"]:focus, input[type="tel"]:focus, input[type="color"]:focus, .uneditable-input:focus, .nav .open > a, .nav .open > a:hover, .nav .open > a:focus,
	.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus,
	.pagination > .active > span:focus, a.thumbnail:hover, a.thumbnail:focus, a.thumbnail.active, .progress-bar, a.list-group-item.active, a.list-group-item.active:hover,
	a.list-group-item.active:focus, .panel-primary, .panel-primary > .panel-heading {
	border-color: <?php echo $primary_color; ?>; }

	.navbar_inner > div > ul > li > a:hover, .navbar_inner > div > ul > li.sfHover > a, .navbar_inner > div > ul > li.current-menu-item > a, .navbar_inner > div > ul > li.current_page_item > a,
	.navbar_inner > ul > li > a:hover, .navbar_inner > ul > li.sfHover > a, .navbar_inner > ul > li.current-menu-item > a, .navbar_inner > ul > li.current_page_item > a, .site-info {
	border-bottom: 6px solid <?php echo $primary_color; ?>; }

	.breadcrumb, #slider-wrapper .flexslider, .author-info, .comments-area, .comment-list .bypostauthor .comment-body, .widget { border-top: 6px solid <?php echo $primary_color; ?>; }

	.panel-primary > .panel-heading + .panel-collapse .panel-body { border-top-color: <?php echo $primary_color; ?>; }
	.panel-primary > .panel-footer + .panel-collapse .panel-body { border-bottom-color: <?php echo $primary_color; ?>; }
	.navbar_inner > ul > li > a { border-bottom: 0 solid <?php echo $primary_color; ?>; }
	.flex-direction-nav a { background: url(<?php echo get_template_directory_uri(); ?>/images/bg_direction_nav.png) no-repeat 0 0 <?php echo $primary_color; ?>; }

	a:hover, a:focus, .btn-link:hover, .btn-link:focus, .footer-menu li.current_page_item a, .footer-menu li.current-menu-item a, .has-user-secondary-color {
	color: <?php echo $secondary_color; ?>; }

	.btn { background: <?php echo $secondary_color; ?>; }
	.has-user-secondary-background-color { background-color: <?php echo $secondary_color; ?>; }

	@media (min-width: 1200px) and (max-width: 1350px) { #primary .post_date time { color: <?php echo $secondary_color; ?>; }}
	@media (min-width: 980px) and (max-width: 1100px) { #primary .post_date time { color: <?php echo $secondary_color; ?>; }}
	@media (max-width: 979px) { #primary .post_date time { color: <?php echo $secondary_color; ?>; }}
	@media (min-width: 768px) and (max-width: 979px) { .navbar_inner > div > ul > li > a, .navbar_inner > ul > li > a { border-bottom: 0 solid <?php echo $primary_color; ?>; }}

	@media (min-width: 768px) and (max-width: 979px) { .navbar_inner > div > ul > li > a:hover, .navbar_inner > div > ul > li.sfHover > a, .navbar_inner > div > ul > li.current-menu-item > a,
	.navbar_inner > div > ul > li.current_page_item > a, .navbar_inner > ul > li > a:hover, .navbar_inner > ul > li.sfHover > a, .navbar_inner > ul > li.current-menu-item > a,
	.navbar_inner > ul > li.current_page_item > a { color: <?php echo $primary_color; ?>; border-bottom: 0 solid <?php echo $primary_color; ?>; }}

	@media (min-width: 1200px) and (max-width: 1350px) { #content .featured_badge { background: <?php echo $primary_color; ?>; }}
	@media (min-width: 980px) and (max-width: 1100px) { #content .featured_badge { background: <?php echo $primary_color; ?>; }}
	@media (max-width: 979px) { #content .featured_badge { background: <?php echo $primary_color; ?>; }}
	@media (max-width: 480px) { .error404-num { color: <?php echo $primary_color; ?>; }}
	</style>
	<?php
}

add_action( 'wp_head', 'duena_customize_colors' );
