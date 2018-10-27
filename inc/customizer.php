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

	?>
	<style>
	/* This will disable the top page picture if the main color has changed */
	<?php
	if ( $primary_color == '#ff5b5b') {
		$pagetoppic = 'url('.get_template_directory_uri().'/images/page-top-bg.jpg) no-repeat center 0 #bd5bff';
	} else {
		$pagetoppic = $primary_color.' no-repeat center 0';
	} ?>


	/* bootstrap.css */
	a {
	  color: <?php echo $primary_color; ?>;
	}
	a:hover,
	a:focus {
	  color: <?php echo $secondary_color; ?>;
	}
	.text-primary {
	  color: <?php echo $primary_color; ?>;
	}
	textarea:focus,
	input[type="text"]:focus,
	input[type="password"]:focus,
	input[type="datetime"]:focus,
	input[type="datetime-local"]:focus,
	input[type="date"]:focus,
	input[type="month"]:focus,
	input[type="time"]:focus,
	input[type="week"]:focus,
	input[type="number"]:focus,
	input[type="email"]:focus,
	input[type="url"]:focus,
	input[type="search"]:focus,
	input[type="tel"]:focus,
	input[type="color"]:focus,
	.uneditable-input:focus {
	  border-color: <?php echo $primary_color; ?>;
	}
	.btn {
	  background: <?php echo $secondary_color; ?>;
	}
	.btn-inverse:hover,
	.btn-inverse:active,
	.btn-inverse.active,
	.btn-inverse.disabled,
	.btn-inverse[disabled] {
	  background-color: <?php echo $primary_color; ?>;
	  *background-color: <?php echo $primary_color; ?>;
	}
	.btn-inverse:active,
	.btn-inverse.active {
	  background-color: <?php echo $primary_color; ?>;
	}
	.btn-link {
	  color: <?php echo $primary_color; ?>;
	}
	.btn-link:hover,
	.btn-link:focus {
	  color: <?php echo $secondary_color; ?>;
	}
	.dropdown-menu > .active > a,
	.dropdown-menu > .active > a:hover,
	.dropdown-menu > .active > a:focus {
	  background-color: <?php echo $primary_color; ?>;
	}
	.nav .open > a,
	.nav .open > a:hover,
	.nav .open > a:focus {
	  border-color: <?php echo $primary_color; ?>;
	}
	.nav-pills > li.active > a,
	.nav-pills > li.active > a:hover,
	.nav-pills > li.active > a:focus {
	  background-color: <?php echo $primary_color; ?>;
	}
	.breadcrumb {
	  border-top: 6px solid <?php echo $primary_color; ?>;
	}
	.pagination > .active > a,
	.pagination > .active > span,
	.pagination > .active > a:hover,
	.pagination > .active > span:hover,
	.pagination > .active > a:focus,
	.pagination > .active > span:focus {
	  background-color: <?php echo $primary_color; ?>;
	  border-color: <?php echo $primary_color; ?>;
	}
	.label-primary {
	  background-color: <?php echo $primary_color; ?>;
	}
	a.list-group-item.active > .badge,
	.nav-pills > .active > a > .badge {
	  color: <?php echo $primary_color; ?>;
	}
	a.thumbnail:hover,
	a.thumbnail:focus,
	a.thumbnail.active {
	  border-color: <?php echo $primary_color; ?>;
	}
	.progress-bar {
	  background-color: <?php echo $primary_color; ?>;
	}
	a.list-group-item.active,
	a.list-group-item.active:hover,
	a.list-group-item.active:focus {
	  background-color: <?php echo $primary_color; ?>;
	  border-color: <?php echo $primary_color; ?>;
	}
	.panel-primary {
	  border-color: <?php echo $primary_color; ?>;
	}
	.panel-primary > .panel-heading {
	  background-color: <?php echo $primary_color; ?>;
	  border-color: <?php echo $primary_color; ?>;
	}
	.panel-primary > .panel-heading + .panel-collapse .panel-body {
	  border-top-color: <?php echo $primary_color; ?>;
	}
	.panel-primary > .panel-footer + .panel-collapse .panel-body {
	  border-bottom-color: <?php echo $primary_color; ?>;
	}

	/* style.css */
	@media (min-width: 1200px) and (max-width: 1350px) {
	  .hentry.post__holder {
	    padding-top: 55px;
	  }
	  #primary .post_type_label {
	    top: 6px;
	    left: 0;
	    border-radius: 0 30px 30px 0;
	    background-position: -10px -240px;
	    -moz-transform: scale(0.7);
	    -webkit-transform: scale(0.7);
	    -o-transform: scale(0.7);
	    -ms-transform: scale(0.7);
	    transform: scale(0.7);
	    -webkit-transform-origin: left top;
	    -moz-transform-origin: left top;
	    -ms-transform-origin: left top;
	    -o-transform-origin: left top;
	    transform-origin: left top;
	  }
	  #primary .post_type_label.gallery {
	    background-position: -10px 0;
	  }
	  #primary .post_type_label.quote {
	    background-position: -10px -60px;
	  }
	  #primary .post_type_label.image {
	    background-position: -10px -120px;
	  }
	  #primary .post_type_label.video {
	    background-position: -10px -180px;
	  }
	  #primary .post_type_label.audio {
	    background-position: -10px -300px;
	  }
	  #primary .post_type_label.aside {
	    background-position: -10px -360px;
	  }
	  #primary .post_type_label.link {
	    background-position: -10px -420px;
	  }
	  #primary .post_type_label.chat {
	    background-position: -10px -480px;
	  }
	  #primary .post_type_label.status {
	    background-position: -10px -540px;
	  }
	  #primary .post_date {
	    max-width: none;
	    top: 18px;
	    left: 65px;
	    right: auto;
	  }
	  #primary .post_date time {
	    color: <?php echo $secondary_color; ?>;
	    text-align: left;
	    float: none;
	  }
	}
	@media (min-width: 980px) and (max-width: 1100px) {
	  .hentry.post__holder {
	    padding-top: 55px;
	  }
	  #primary .post_type_label {
	    top: 6px;
	    left: 0;
	    border-radius: 0 30px 30px 0;
	    background-position: -10px -240px;
	    -moz-transform: scale(0.7);
	    -webkit-transform: scale(0.7);
	    -o-transform: scale(0.7);
	    -ms-transform: scale(0.7);
	    transform: scale(0.7);
	    -webkit-transform-origin: left top;
	    -moz-transform-origin: left top;
	    -ms-transform-origin: left top;
	    -o-transform-origin: left top;
	    transform-origin: left top;
	  }
	  #primary .post_type_label.gallery {
	    background-position: -10px 0;
	  }
	  #primary .post_type_label.quote {
	    background-position: -10px -60px;
	  }
	  #primary .post_type_label.image {
	    background-position: -10px -120px;
	  }
	  #primary .post_type_label.video {
	    background-position: -10px -180px;
	  }
	  #primary .post_type_label.audio {
	    background-position: -10px -300px;
	  }
	  #primary .post_type_label.aside {
	    background-position: -10px -360px;
	  }
	  #primary .post_type_label.link {
	    background-position: -10px -420px;
	  }
	  #primary .post_type_label.chat {
	    background-position: -10px -480px;
	  }
	  #primary .post_type_label.status {
	    background-position: -10px -540px;
	  }
	  #primary .post_date {
	    max-width: none;
	    top: 18px;
	    left: 65px;
	    right: auto;
	  }
	  #primary .post_date time {
	    color: <?php echo $secondary_color; ?>;
	    text-align: left;
	    float: none;
	  }
	}
	@media (max-width: 979px) {
	  .hentry.post__holder {
	    padding-top: 55px;
	  }
	  #primary .post_type_label {
	    top: 6px;
	    left: 0;
	    border-radius: 0 30px 30px 0;
	    background-position: -10px -240px;
	    -moz-transform: scale(0.7);
	    -webkit-transform: scale(0.7);
	    -o-transform: scale(0.7);
	    -ms-transform: scale(0.7);
	    transform: scale(0.7);
	    -webkit-transform-origin: left top;
	    -moz-transform-origin: left top;
	    -ms-transform-origin: left top;
	    -o-transform-origin: left top;
	    transform-origin: left top;
	  }
	  #primary .post_type_label.gallery {
	    background-position: -10px 0;
	  }
	  #primary .post_type_label.quote {
	    background-position: -10px -60px;
	  }
	  #primary .post_type_label.image {
	    background-position: -10px -120px;
	  }
	  #primary .post_type_label.video {
	    background-position: -10px -180px;
	  }
	  #primary .post_type_label.audio {
	    background-position: -10px -300px;
	  }
	  #primary .post_type_label.aside {
	    background-position: -10px -360px;
	  }
	  #primary .post_type_label.link {
	    background-position: -10px -420px;
	  }
	  #primary .post_type_label.chat {
	    background-position: -10px -480px;
	  }
	  #primary .post_type_label.status {
	    background-position: -10px -540px;
	  }
	  #primary .post_date {
	    max-width: none;
	    top: 18px;
	    left: 65px;
	    right: auto;
	  }
	  #primary .post_date time {
	    color: <?php echo $secondary_color; ?>;
	    text-align: left;
	    float: none;
	  }
	}
	.footer-menu li.current_page_item a,
	.footer-menu li.current-menu-item a {
	  color: <?php echo $secondary_color; ?>;
	}
	/* This is where the top page pic changes */
	.page-wrapper:before {
		background: <?php echo $pagetoppic; ?>;
	}
	#slider-wrapper .flexslider {
		border-top: 6px solid <?php echo $primary_color; ?>;
	}
	.navbar_inner > ul ul {
	  background: <?php echo $primary_color; ?>;
	}
	.navbar_inner > ul > li > a {
	  border-bottom: 0 solid <?php echo $primary_color; ?>;
	}
	@media (min-width: 768px) and (max-width: 979px) {
	  .navbar_inner > div > ul,
	  .navbar_inner > ul {
	    padding: 10px 0 0 0;
	  }
	  .navbar_inner > div > ul > li,
	  .navbar_inner > ul > li {
	    margin: 0 15px 10px;
	    line-height: 26px;
	    height: 26px;
	  }
	  .navbar_inner > div > ul > li > a,
	  .navbar_inner > ul > li > a {
	    font-size: 18px;
	    line-height: 26px;
	    height: 26px;
	    padding: 0;
	    border-bottom: 0 solid <?php echo $primary_color; ?>;
	  }
	}
	.navbar_inner > div > ul > li > a:hover,
	.navbar_inner > div > ul > li.sfHover > a,
	.navbar_inner > div > ul > li.current-menu-item > a,
	.navbar_inner > div > ul > li.current_page_item > a,
	.navbar_inner > ul > li > a:hover,
	.navbar_inner > ul > li.sfHover > a,
	.navbar_inner > ul > li.current-menu-item > a,
	.navbar_inner > ul > li.current_page_item > a {
	  border-bottom: 6px solid <?php echo $primary_color; ?>;
	}
	@media (min-width: 768px) and (max-width: 979px) {
	  .navbar_inner > div > ul > li > a:hover,
	  .navbar_inner > div > ul > li.sfHover > a,
	  .navbar_inner > div > ul > li.current-menu-item > a,
	  .navbar_inner > div > ul > li.current_page_item > a,
	  .navbar_inner > ul > li > a:hover,
	  .navbar_inner > ul > li.sfHover > a,
	  .navbar_inner > ul > li.current-menu-item > a,
	  .navbar_inner > ul > li.current_page_item > a {
	    color: <?php echo $primary_color; ?>;
	    border-bottom: 0 solid <?php echo $primary_color; ?>;
	  }
	}
	.post-title a:hover {
	  color: <?php echo $primary_color; ?>;
	}
	#content .featured_badge {
	  background: <?php echo $primary_color; ?>;
	}
	@media (min-width: 1200px) and (max-width: 1350px) {
	  .featured_badge + .post-title {
	    padding-top: 0;
	  }
	  .single .sticky.post_content {
	    padding-top: 5px;
	  }
	  .single .sticky.video_wrap {
	    padding-top: 5px;
	  }
	  #content .featured_badge {
	    font-size: 30px;
	    line-height: 58px;
	    width: 69px;
	    height: 60px;
	    text-align: center;
	    background: <?php echo $primary_color; ?>;
	    border-radius: 30px 0 0 30px;
	    font-weight: bold;
	    color: #ffffff;
	    font-family: Arial, Helvetica, sans-serif;
	    letter-spacing: 0;
	    vertical-align: top;
	    margin: 0;
	    position: absolute;
	    right: 0;
	    left: auto;
	    top: 6px;
	    padding: 0;
	    -moz-transform: scale(0.7);
	    -webkit-transform: scale(0.7);
	    -o-transform: scale(0.7);
	    -ms-transform: scale(0.7);
	    transform: scale(0.7);
	    -webkit-transform-origin: right top;
	    -moz-transform-origin: right top;
	    -ms-transform-origin: right top;
	    -o-transform-origin: right top;
	    transform-origin: right top;
	  }
	  #content .featured_badge i {
	    font-size: 30px;
	    margin: 0;
	    font-weight: normal;
	  }
	  #content .featured_badge strong {
	    display: none;
	  }
	}
	@media (min-width: 980px) and (max-width: 1100px) {
	  .featured_badge + .post-title {
	    padding-top: 0;
	  }
	  .single .sticky.post_content {
	    padding-top: 5px;
	  }
	  .single .sticky.video_wrap {
	    padding-top: 5px;
	  }
	  #content .featured_badge {
	    font-size: 30px;
	    line-height: 58px;
	    width: 69px;
	    height: 60px;
	    text-align: center;
	    background: <?php echo $primary_color; ?>;
	    border-radius: 30px 0 0 30px;
	    font-weight: bold;
	    color: #ffffff;
	    font-family: Arial, Helvetica, sans-serif;
	    letter-spacing: 0;
	    vertical-align: top;
	    margin: 0;
	    position: absolute;
	    right: 0;
	    left: auto;
	    top: 6px;
	    padding: 0;
	    -moz-transform: scale(0.7);
	    -webkit-transform: scale(0.7);
	    -o-transform: scale(0.7);
	    -ms-transform: scale(0.7);
	    transform: scale(0.7);
	    -webkit-transform-origin: right top;
	    -moz-transform-origin: right top;
	    -ms-transform-origin: right top;
	    -o-transform-origin: right top;
	    transform-origin: right top;
	  }
	  #content .featured_badge i {
	    font-size: 30px;
	    margin: 0;
	    font-weight: normal;
	  }
	  #content .featured_badge strong {
	    display: none;
	  }
	}
	/* All Devices */
	@media (max-width: 979px) {
	  .featured_badge + .post-title {
	    padding-top: 0;
	  }
	  .single .sticky.post_content {
	    padding-top: 5px;
	  }
	  .single .sticky.video_wrap {
	    padding-top: 5px;
	  }
	  #content .featured_badge {
	    font-size: 30px;
	    line-height: 58px;
	    width: 69px;
	    height: 60px;
	    text-align: center;
	    background: <?php echo $primary_color; ?>;
	    border-radius: 30px 0 0 30px;
	    font-weight: bold;
	    color: #ffffff;
	    font-family: Arial, Helvetica, sans-serif;
	    letter-spacing: 0;
	    vertical-align: top;
	    margin: 0;
	    position: absolute;
	    right: 0;
	    left: auto;
	    top: 6px;
	    padding: 0;
	    -moz-transform: scale(0.7);
	    -webkit-transform: scale(0.7);
	    -o-transform: scale(0.7);
	    -ms-transform: scale(0.7);
	    transform: scale(0.7);
	    -webkit-transform-origin: right top;
	    -moz-transform-origin: right top;
	    -ms-transform-origin: right top;
	    -o-transform-origin: right top;
	    transform-origin: right top;
	  }
	  #content .featured_badge i {
	    font-size: 30px;
	    margin: 0;
	    font-weight: normal;
	  }
	  #content .featured_badge strong {
	    display: none;
	  }
	}
	.page-links a:hover {
	  color: <?php echo $primary_color; ?>;
	}
	.page-links > span {
	  color: <?php echo $primary_color; ?>;
	}
	.post-footer i {
	  color: <?php echo $primary_color; ?>;
	}
	.post-footer a {
	  background: <?php echo $primary_color; ?>;
	}
	.tagcloud a {
	  background: <?php echo $primary_color; ?>;
	}
	.post_type_label {
	  background: <?php echo $primary_color; ?> url(<?php echo get_template_directory_uri(); ?>/images/post-format-icons.png) no-repeat 0 -240px;
	}
	.post_meta i {
	  color: <?php echo $primary_color; ?>;
	}
	.author-info {
	  border-top: 6px solid <?php echo $primary_color; ?>;
	}
	.page_nav_wrap .post_nav ul li a:hover {
	  color: <?php echo $primary_color; ?>;
	}
	.page_nav_wrap .post_nav ul li .current {
	  color: <?php echo $primary_color; ?>;
	}
	.author_bio_sidebar .social_box {
	  background: <?php echo $primary_color; ?>;
	}
	.author_bio_sidebar .social_box a {
	  color: <?php echo $primary_color; ?>;
	}
	.author_bio_sidebar .author_bio_message h3 {
	  color: <?php echo $primary_color; ?>;
	}
	.author_bio_sidebar .author_bio_message h4 {
	  color: <?php echo $primary_color; ?>;
	}
	.author_bio_sidebar .author_bio_message h5 {
	  color: <?php echo $primary_color; ?>;
	}
	.author_bio_sidebar .author_bio_message h6 {
	  color: <?php echo $primary_color; ?>;
	}
	.error404-num {
	  color: <?php echo $primary_color; ?>;
	}
	@media (max-width: 480px) {
	  .error404-num {
	    font-size: 100px;
	    line-height: 80px;
	    color: <?php echo $primary_color; ?>;
	    padding: 20px 0 10px 0;
	  }
	  .page404 .hentry .searchform {
	    margin: 0 10px;
	  }
	}
	.comments-area {
	  border-top: 6px solid <?php echo $primary_color; ?>;
	}
	.comment-list .bypostauthor .comment-body {
	  border-top: 6px solid <?php echo $primary_color; ?>;
	}
	.widget {
	  border-top: 6px solid <?php echo $primary_color; ?>;
	}
	.searchform .screen-reader-text {
	  color: <?php echo $primary_color; ?>;
	}
	.site-info {
	  border-bottom: 6px solid <?php echo $primary_color; ?>;
	}
	#toTop {
	  background: <?php echo $primary_color; ?>;
	}
	button,
	html input[type="button"],
	input[type="reset"],
	input[type="submit"] {
	  background: <?php echo $primary_color; ?>;
	}

	/* flexslider.css */
	.flex-direction-nav a {
		background: url(<?php echo get_template_directory_uri(); ?>/images/bg_direction_nav.png) no-repeat 0 0 <?php echo $primary_color; ?>;
	}
	.flex-control-paging li a:hover {
		background: <?php echo $primary_color; ?>;
	}
	.flex-control-paging li a.flex-active {
		background: <?php echo $primary_color; ?>;
	}
	.has-user-primary-color {
		color: <?php echo $primary_color; ?>;
	}
	.has-user-primary-background-color {
		background-color: <?php echo $primary_color; ?>;
	}
	.has-user-secondary-color {
		color: <?php echo $secondary_color; ?>;
	}
	.has-user-secondary-background-color {
		background-color: <?php echo $secondary_color; ?>;
	}

	</style>

	<?php

}

add_action( 'wp_head', 'duena_customize_colors' );
