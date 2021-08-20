<?php
/**
 * duena-revival header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package duena-revival
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="format-detection" content="telephone=no" />
<meta name="theme-color" content="<?php echo esc_attr( get_theme_mod( 'cs_primary_color', '#ff5b5b' ) ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="page-wrapper">
	<?php do_action( 'before' ); ?>
	<header id="header" role="banner">
		<div class="container clearfix">
			<div class="logo">
			<?php if (( get_theme_mod('logo_type') == 'image_logo') && ( get_theme_mod('logo_url') != '')) { ?>
					<a tabindex="0" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_url( get_theme_mod('logo_url') ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
			<?php } else { ?>
				<?php if ( is_front_page() || is_home() || is_404() ) { ?>
					<h1 class="text-logo"><a tabindex="0" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php } else { ?>
					<h2 class="text-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
				<?php } ?>
			<?php } ?>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			</div>
			<?php if ( get_theme_mod('g_search_box_id', '1') === '1') { ?>
	          <div id="top-search">
	            <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>/">
	              <input type="text" name="s"  class="input-search" /><input type="submit" value="" id="submit">
	            </form>
	          </div>
	        <?php } ?>
	        <div class="clear"></div>
			<nav id="site-navigation" class="main-nav" role="navigation">
				<div class="navbar_inner">
				<?php // MAIN DESKTOP MENU
					if (has_nav_menu('primary')):
						wp_nav_menu( array(
							'container'       => 'ul',
							#'menu_class'      => 'sf-menu',
							'menu_id'         => 'topnav',
							'depth'           => 0,
							'theme_location'  => 'primary',
							'walker' 		  => new CSS_Menu_Walker()
					) );
					endif;
				?>
				</div>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->
	<?php if( (is_front_page()) && ( get_theme_mod('sl_show') != '0') ) { ?>
	<section id="slider-wrapper">
		<div class="container">
	    	<?php get_template_part( 'slider' ); ?>
		</div>
	</section><!--#slider-->
  	<?php } ?>
	<div id="main" class="site-main">
		<div class="container">
			<?php if ( get_theme_mod('g_breadcrumbs_id', '1') != '0') { ?>
				<?php duena_revival_breadcrumb(); ?>
			<?php } ?>
			<div class="row">
