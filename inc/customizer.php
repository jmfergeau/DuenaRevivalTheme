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
	$primary_color = get_option( 'main_color' );

	?>
	<style>
	/* bootstrap.css */
	a {
	  color: <?php echo $primary_color; ?>;
	  text-decoration: none;
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
	  outline: none;
	  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(255,91,91,.3);
	}
	.btn-inverse:hover,
	.btn-inverse:active,
	.btn-inverse.active,
	.btn-inverse.disabled,
	.btn-inverse[disabled] {
	  color: #ffffff;
	  background-color: <?php echo $primary_color; ?>;
	  *background-color: <?php echo $primary_color; ?>;
	}
	.btn-inverse:active,
	.btn-inverse.active {
	  background-color: <?php echo $primary_color; ?>;
	}
	.btn-link {
	  color: <?php echo $primary_color; ?>;
	  font-weight: normal;
	  cursor: pointer;
	  border-radius: 0;
	}
	.dropdown-menu > .active > a,
	.dropdown-menu > .active > a:hover,
	.dropdown-menu > .active > a:focus {
	  color: #ffffff;
	  text-decoration: none;
	  outline: 0;
	  background-color: <?php echo $primary_color; ?>;
	}
	.nav .open > a,
	.nav .open > a:hover,
	.nav .open > a:focus {
	  background-color: #eeeeee;
	  border-color: <?php echo $primary_color; ?>;
	}
	.nav-pills > li.active > a,
	.nav-pills > li.active > a:hover,
	.nav-pills > li.active > a:focus {
	  color: #ffffff;
	  background-color: <?php echo $primary_color; ?>;
	}
	.breadcrumb {
	  padding: 8px 15px;
	  margin: 0 0 20px;
	  list-style: none;
	  background-color: #ffffff;
	  box-shadow: 0 5px 7px rgba(0, 0, 0, 0.22);
	  border-top: 6px solid <?php echo $primary_color; ?>;
	  margin: 0 0 30px 0;
	  -webkit-border-radius: 0;
	  -moz-border-radius: 0;
	  border-radius: 0;
	}
	.pagination > .active > a,
	.pagination > .active > span,
	.pagination > .active > a:hover,
	.pagination > .active > span:hover,
	.pagination > .active > a:focus,
	.pagination > .active > span:focus {
	  z-index: 2;
	  color: #ffffff;
	  background-color: <?php echo $primary_color; ?>;
	  border-color: <?php echo $primary_color; ?>;
	  cursor: default;
	}
	.label-primary {
	  background-color: <?php echo $primary_color; ?>;
	}
	a.list-group-item.active > .badge,
	.nav-pills > .active > a > .badge {
	  color: <?php echo $primary_color; ?>;
	  background-color: #ffffff;
	}
	a.thumbnail:hover,
	a.thumbnail:focus,
	a.thumbnail.active {
	  border-color: <?php echo $primary_color; ?>;
	}
	.progress-bar {
	  float: left;
	  width: 0%;
	  height: 100%;
	  font-size: 11px;
	  line-height: 17px;
	  color: #ffffff;
	  text-align: center;
	  background-color: <?php echo $primary_color; ?>;
	  -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
	  box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
	  -webkit-transition: width 0.6s ease;
	  transition: width 0.6s ease;
	}
	a.list-group-item.active,
	a.list-group-item.active:hover,
	a.list-group-item.active:focus {
	  z-index: 2;
	  color: #ffffff;
	  background-color: <?php echo $primary_color; ?>;
	  border-color: <?php echo $primary_color; ?>;
	}
	.panel-primary {
	  border-color: <?php echo $primary_color; ?>;
	}
	.panel-primary > .panel-heading {
	  color: #ffffff;
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
	.page-wrapper:before {
		position: absolute;
		content: "";
		left: 0;
		right: 0;
		top: 0;
		height: 6px;
		background: url(<?php echo get_template_directory_uri(); ?>/images/page-top-bg.jpg) no-repeat center 0 <?php echo $primary_color; ?>;
	}
	#slider-wrapper .flexslider {
		border-top: 6px solid <?php echo $primary_color; ?>;
		margin: 0 0 30px 0;
	}
	.navbar_inner > ul ul {
	  position: absolute;
	  top: -999em;
	  min-width: 200px;
	  left: 0;
	  background: <?php echo $primary_color; ?>;
	  padding: 10px 0;
	  box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
	}
	.navbar_inner > ul > li > a {
	  color: #fff8ed;
	  font-size: 18px;
	  line-height: 52px;
	  height: 52px;
	  text-decoration: none;
	  text-transform: uppercase;
	  letter-spacing: 0;
	  background: none;
	  font-weight: bold;
	  padding: 0 15px;
	  /* font-family: 'BenchNine', sans-serif; */
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
	  color: #ffffff;
	  outline: 0;
	  text-decoration: none;
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
	  display: block;
	  position: absolute;
	  top: 0;
	  left: 0;
	  right: 0;
	  height: 35px;
	  line-height: 35px;
	  padding: 0 35px;
	  background: <?php echo $primary_color; ?>;
	  color: #ffffff;
	  font-size: 22px;
	  font-family: 'BenchNine', sans-serif;
	  font-weight: bold;
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
	  text-decoration: none;
	  color: <?php echo $primary_color; ?>;
	}
	.page-links > span {
	  display: inline-block;
	  text-decoration: none;
	  color: <?php echo $primary_color; ?>;
	  font-family: 'BenchNine', sans-serif;
	  line-height: 20px;
	  font-size: 22px;
	  font-weight: bold;
	  margin: 0 2px;
	}
	.post-footer i {
	  font-size: 14px;
	  color: <?php echo $primary_color; ?>;
	}
	.post-footer a {
	  display: inline-block;
	  margin: 0 2px 2px 0;
	  font-size: 11px;
	  line-height: 18px;
	  height: 18px;
	  padding: 0 10px;
	  border-radius: 10px;
	  background: <?php echo $primary_color; ?>;
	  border: 1px solid #f40000;
	  color: #ffffff;
	}
	.tagcloud a {
	  display: inline-block;
	  margin: 0 2px 2px 0;
	  font-size: 11px !important;
	  line-height: 18px;
	  height: 18px;
	  padding: 0 10px;
	  border-radius: 10px;
	  background: <?php echo $primary_color; ?>;
	  border: 1px solid #f40000;
	  color: #ffffff;
	}
	.post_type_label {
	  position: absolute;
	  top: 35px;
	  left: -69px;
	  width: 69px;
	  height: 60px;
	  background: <?php echo $primary_color; ?> url(<?php echo get_template_directory_uri(); ?>/images/post-format-icons.png) no-repeat 0 -240px;
	  border-radius: 30px 0 0 30px;
	}
	.post_meta i {
	  font-size: 14px;
	  color: <?php echo $primary_color; ?>;
	}
	.author-info {
	  padding: 20px;
	  background: #ffffff;
	  box-shadow: 0 5px 7px rgba(0, 0, 0, 0.22);
	  margin: 0 0 30px 0;
	  border-top: 6px solid <?php echo $primary_color; ?>;
	}
	.page_nav_wrap .post_nav ul li a:hover {
	  color: <?php echo $primary_color; ?>;
	  text-decoration: none;
	}
	.page_nav_wrap .post_nav ul li .current {
	  color: <?php echo $primary_color; ?>;
	  text-decoration: none;
	  cursor: default;
	}
	.author_bio_sidebar .social_box {
	  background: <?php echo $primary_color; ?>;
	  padding: 3px 5px;
	  text-align: center;
	  font-size: 0;
	  list-style: 0;
	}
	.author_bio_sidebar .social_box a {
	  color: <?php echo $primary_color; ?>;
	  font-size: 26px;
	  height: 42px;
	  line-height: 40px;
	  width: 42px;
	  padding: 0;
	  margin: 9px 2px;
	  background: #ffffff;
	  border-radius: 21px;
	  display: inline-block;
	  text-decoration: none !important;
	}
	.author_bio_sidebar .author_bio_message h3 {
	  font-size: 32px;
	  line-height: 32px;
	  color: <?php echo $primary_color; ?>;
	}
	.author_bio_sidebar .author_bio_message h4 {
	  font-size: 30px;
	  line-height: 32px;
	  color: <?php echo $primary_color; ?>;
	}
	.author_bio_sidebar .author_bio_message h5 {
	  font-size: 24px;
	  line-height: 30px;
	  color: <?php echo $primary_color; ?>;
	}
	.author_bio_sidebar .author_bio_message h6 {
	  font-size: 18px;
	  line-height: 30px;
	  color: <?php echo $primary_color; ?>;
	}
	.error404-num {
	  font-size: 200px;
	  line-height: 150px;
	  color: <?php echo $primary_color; ?>;
	  padding: 20px 0 10px 0;
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
	  background: #ffffff;
	  box-shadow: 0 5px 7px rgba(0, 0, 0, 0.22);
	  padding: 20px;
	  border-top: 6px solid <?php echo $primary_color; ?>;
	  margin: 0 0 30px 0;
	}
	.comment-list .bypostauthor .comment-body {
	  border-top: 6px solid <?php echo $primary_color; ?>;
	}
	.widget {
	  background: #ffffff;
	  box-shadow: 0 5px 7px rgba(0, 0, 0, 0.22);
	  border-top: 6px solid <?php echo $primary_color; ?>;
	  padding: 15px 15px 15px;
	  margin: 0 0 30px 0;
	  overflow: hidden;
	  -webkit-transition: all 300ms linear;
	  -moz-transition: all 300ms linear;
	  -o-transition: all 300ms linear;
	  transition: all 300ms linear;
	}
	.searchform .screen-reader-text {
	  padding: 0 0 0 15px;
	  font-style: italic;
	  color: <?php echo $primary_color; ?>;
	  font-size: 15px;
	  font-weight: bold;
	}
	.site-info {
	  padding: 15px 60px 15px 15px;
	  background: #ffffff;
	  box-shadow: 0 5px 7px rgba(0, 0, 0, 0.22);
	  border-bottom: 6px solid <?php echo $primary_color; ?>;
	  position: relative;
	}
	#toTop {
	  text-align: center;
	  position: absolute;
	  top: 50%;
	  margin: -16px 0 0 0;
	  right: 14px;
	  cursor: pointer;
	  display: none;
	  width: 32px;
	  height: 32px;
	  line-height: 32px;
	  border-radius: 16px;
	  color: #ffffff;
	  background: <?php echo $primary_color; ?>;
	  -webkit-transition: all 200ms linear;
	  -moz-transition: all 200ms linear;
	  -o-transition: all 200ms linear;
	  transition: all 200ms linear;
	}
	button,
	html input[type="button"],
	input[type="reset"],
	input[type="submit"] {
	  border: none;
	  border-radius: 0;
	  background: <?php echo $primary_color; ?>;
	  color: #ffffff;
	  cursor: pointer;
	  /* Improves usability and consistency of cursor style between image-type 'input' and others */

	  -webkit-appearance: button;
	  /* Corrects inability to style clickable 'input' types in iOS */

	  font-size: 12px;
	  line-height: 28px;
	  height: 28px;
	  border-radius: 14px;
	  display: inline-block;
	  position: relative;
	  padding: 0 15px;
	  vertical-align: top;
	  -webkit-box-sizing: content-box;
	  -moz-box-sizing: content-box;
	  box-sizing: content-box;
	  -webkit-transition: all 300ms linear;
	  -moz-transition: all 300ms linear;
	  -o-transition: all 300ms linear;
	  transition: all 300ms linear;
	}

	/* flexslider.css */
	.flex-direction-nav a {
		width: 50px;
		height: 50px;
		margin: -25px 0 0;
		display: block;
		background: url(<?php echo get_template_directory_uri(); ?>/images/bg_direction_nav.png) no-repeat 0 0 <?php echo $primary_color; ?>;
		position: absolute;
		top: 50%;
		z-index: 10;
		cursor: pointer;
		text-indent: -99px;
		z-index: 999;
		opacity: 0;
		overflow: hidden;
		border-radius: 25px;
		filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
		-webkit-transition: all .3s ease;
		-moz-transition: all .3s ease;
		-o-transition: all .3s ease;
		-ms-transition: all .3s ease;
		transition: all .3s ease;
	}
	.flex-control-paging li a:hover {
		background: <?php echo $primary_color; ?>;
	}
	.flex-control-paging li a.flex-active {
		background: <?php echo $primary_color; ?>;
		cursor: default;
	}

	</style>

	<?php

}

add_action( 'wp_head', 'duena_customize_colors' );
