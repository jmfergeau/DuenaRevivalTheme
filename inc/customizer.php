<?php
/**
 * duena-revival Theme Customizer
 *
 * @package duena-revival
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function duena_revival_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/*-----------------------------------------------------------------------------------*/
	/*	General
	/*-----------------------------------------------------------------------------------*/
	$wp_customize->add_section( 'duena_revival_header', array(
		'title' => __( 'General', 'duena-revival' ),
		'priority' => 200
	));

	/* Search Box */
	$wp_customize->add_setting( 'g_search_box_id', array(
			'default' => '1',
			'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'g_search_box_id', array(
			'label' 			=> __( "Display search box?", "duena-revival" ),
			'section' 		=> 'duena_revival_header',
			'settings'		=> 'g_search_box_id',
			'type' 				=> "checkbox",
			'priority' 		=> 11
	) );

	/* Breadcrumbs */
	$wp_customize->add_setting( 'g_breadcrumbs_id', array(
			'default' => '1',
			'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'g_breadcrumbs_id', array(
			'label' 		=> __( "Display breadcrumbs?", "duena-revival" ),
			'section' 	=> 'duena_revival_header',
			'settings' 	=> 'g_breadcrumbs_id',
			'type' 			=> 'checkbox',
			'priority' 	=> 12
	) );

	/* Portfolio cat */
	$wp_customize->add_setting( 'g_portfolio_cat', array(
			'default' => '',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
	) );
	$wp_customize->add_control( 'g_portfolio_cat', array(
			'label' => __( "Category slug for portfolio page", "duena-revival" ),
			'section' => 'duena_revival_header',
			'settings' => 'g_portfolio_cat',
			'priority' => 13
	) );

	/* g_author_bio */
	$wp_customize->add_setting( 'g_author_bio', array(
			'default' => '1',
			'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'g_author_bio', array(
			'label' => __( "Display Author Bio in sidebar", "duena-revival" ),
			'section' => 'duena_revival_header',
			'settings' => 'g_author_bio',
			'type' => 'checkbox',
			'priority' => 14
	) );

	/* g_author_bio_title */
	$wp_customize->add_setting( 'g_author_bio_title', array(
			'default' => __( "Welcome to my site", "duena-revival" ),
			'sanitize_callback' => 'wp_filter_nohtml_kses'
	) );
	$wp_customize->add_control( 'g_author_bio_title', array(
			'label' => __( "Author Bio Title", "duena-revival" ),
			'section' => 'duena_revival_header',
			'settings' => 'g_author_bio_title',
			// "class" => "hidden", ???
			'priority' => 15
	) );

	/* g_author_bio_img */
	$wp_customize->add_setting( 'g_author_bio_img', array(
			'sanitize_callback' => 'duena_revival_sanitize_image'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'g_author_bio_img', array(
		'label' => __( "Author Bio image", "duena-revival" ),
		'section' => 'duena_revival_header',
		'settings' => 'g_author_bio_img',
		'type'  => 'upload',
		// "class" => "hidden", ???
		'priority' => 16
	)));

	/* g_author_bio_message */
	$wp_customize->add_setting( 'g_author_bio_message', array(
			'default' => __( "Hello, and welcome to my site! I hope you like the place and decide to stay.", "duena-revival" ),
			'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'g_author_bio_message', array(
			'label' => __( "Author Bio Message", "duena-revival" ),
			'section' => 'duena_revival_header',
			'settings' => 'g_author_bio_message',
			'priority' => 17
	) );

	/*-----------------------------------------------------------------------------------*/
	/*	Author sidebar icons
	/*-----------------------------------------------------------------------------------*/
	/*
	 * Preparing icons lists. First 5 are defaults.
	 * You can add your own icons if there's any missing in the list. (really?)
	 * To make them work, just respect the following rule:
	 * 'FontAwesome-icon-code' => 'Human readable name for the icon',
	 * ex: 'facebook-f' => 'Facebook',
	 * To get the list of available icons, follow this link:
	 * https://fontawesome.com/icons?d=gallery&s=brands
	 */


	$fa_icons_list = array(
		'none' => __( "Disable", "duena-revival" ), 	// Disables the icon spot
		'amazon' => 'Amazon',
		'amazon-pay' => 'Amazon Pay',
		'app-store' => 'Apple App Store',
		'apple-pay' => 'Apple Pay',
		'bandcamp' => 'Bandcamp',
		'bitbucket' => 'BitBucket',
		'btc' => 'Bitcoin',
		'discord' => 'Discord',
		'ebay' => 'Ebay',
		'etsy' => 'Etsy',
		'facebook-f' => 'Facebook',					// Spot 2 default
		'flickr' => 'Flickr',
		'git' => __( "Generic git repository", "duena-revival" ),
		'github-alt' => 'GitHub',
		'gitlab' => 'GitLab',
		'google-play' => 'Google Play',
		'instagram' => 'Instagram',
		'itch-io' => 'Itch.io',
		'itunes-note' => 'Itunes',
		'kickstarter-k' => 'Kickstarter',
		'lastfm' => 'Last.fm',
		'linkedin-in' => 'LinkedIn',				// Spot 4 default
		'mastodon' => 'Mastodon',
		'patreon' => 'Patreon',							// Spot 3 default
		'paypal' => 'PayPal',
		'pinterest-p' => 'Pinterest',
		'reddit-alien' => 'Reddit',
		'salesforce' => 'SalesForce',
		'skype' => 'Skype',
		'slack-hash' => 'Slack',
		'snapchat-ghost' => 'Snapchat',
		'soundcloud' => 'Soundcloud',
		'steam-symbol' => 'Steam',
		'teamspeak' => 'TeamSpeak',
		'telegram-plane' => 'Telegram',
		'trello' => 'Trello',
		'tumblr' => 'Tumblr',
		'teamspeak' => 'TeamSpeak',
		'twitter' => 'Twitter', 						// Spot 1 default
		'uber' => 'Uber',
		'viadeo' => 'Viadeo',
		'vimeo-v' => 'Vimeo',
		'whatsapp' => 'WhatsApp',
		'wordpress-simple' => 'Wordpress',
		'youtube' => 'YouTube',
		// The icons below are not brands so they're separated.
		'rss' => __( "RSS feed", "duena-revival" ),								// Spot 5 default
		'envelope' => 'E-Mail'
	);

	/* g_author_bio_social_twitter_icon */
	$wp_customize->add_setting( 'g_author_bio_social_twitter_icon', array(
			'default' => 'twitter',
			'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'g_author_bio_social_twitter_icon', array(
			'label' => __( "Icon for spot #", "duena-revival" ) . '1',
			'description' => __( "Default is", "duena-revival" ) . " " . strval($fa_icons_list['twitter']),
			'section' => 'duena_revival_header',
			'settings' => 'g_author_bio_social_twitter_icon',
			'type' => 'select',
			'choices' => $fa_icons_list,
			'priority' => 18
	) );
	/* g_author_bio_social_twitter_text */
	$wp_customize->add_setting( 'g_author_bio_social_twitter_text', array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( 'g_author_bio_social_twitter_text', array(
			'label' => __( "URL for spot #", "duena-revival" ) . '1',
			'description' => __( "Default is", "duena-revival" ) . " " . strval($fa_icons_list['twitter']),
			'section' => 'duena_revival_header',
			'settings' => 'g_author_bio_social_twitter_text',
			'priority' => 18
	) );

	/* g_author_bio_social_facebook_icon */
	$wp_customize->add_setting( 'g_author_bio_social_facebook_icon', array(
			'default' => 'facebook-f',
			'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'g_author_bio_social_facebook_icon', array(
			'label' => __( "Icon for spot #", "duena-revival" ) . '2',
			'description' => __( "Default is", "duena-revival" ) . " " . strval($fa_icons_list['facebook-f']),
			'section' => 'duena_revival_header',
			'settings' => 'g_author_bio_social_facebook_icon',
			'type' => 'select',
			'choices' => $fa_icons_list,
			'priority' => 18
	) );
	/* g_author_bio_social_facebook_text */
	$wp_customize->add_setting( 'g_author_bio_social_facebook_text', array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( 'g_author_bio_social_facebook_text', array(
			'label' => __( "URL for spot #", "duena-revival" ) . '2',
			'description' => __( "Default is", "duena-revival" ) . " " . strval($fa_icons_list['facebook-f']),
			'section' => 'duena_revival_header',
			'settings' => 'g_author_bio_social_facebook_text',
			'priority' => 18
	) );

	/* g_author_bio_social_patreon_icon */
	$wp_customize->add_setting( 'g_author_bio_social_patreon_icon', array(
			'default' => 'patreon',
			'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'g_author_bio_social_patreon_icon', array(
			'label' => __( "Icon for spot #", "duena-revival" ) . '3',
			'description' => __( "Default is", "duena-revival" ) . " " . strval($fa_icons_list['patreon']),
			'section' => 'duena_revival_header',
			'settings' => 'g_author_bio_social_patreon_icon',
			'type' => 'select',
			'choices' => $fa_icons_list,
			'priority' => 18
	) );
	/* g_author_bio_social_patreon_text */
	$wp_customize->add_setting( 'g_author_bio_social_patreon_text', array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( 'g_author_bio_social_patreon_text', array(
			'label' => __( "URL for spot #", "duena-revival" ) . '3',
			'description' => __( "Default is", "duena-revival" ) . " " . strval($fa_icons_list['patreon']),
			'section' => 'duena_revival_header',
			'settings' => 'g_author_bio_social_patreon_text',
			'priority' => 18
	) );

	/* g_author_bio_social_linkedin_icon */
	$wp_customize->add_setting( 'g_author_bio_social_linkedin_icon', array(
			'default' => 'linkedin-in',
			'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'g_author_bio_social_linkedin_icon', array(
			'label' => __( "Icon for spot #", "duena-revival" ) . '4',
			'description' => __( "Default is", "duena-revival" ) . " " . strval($fa_icons_list['linkedin-in']),
			'section' => 'duena_revival_header',
			'settings' => 'g_author_bio_social_linkedin_icon',
			'type' => 'select',
			'choices' => $fa_icons_list,
			'priority' => 18
	) );
	/* g_author_bio_social_linkedin_text */
	$wp_customize->add_setting( 'g_author_bio_social_linkedin_text', array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( 'g_author_bio_social_linkedin_text', array(
			'label' => __( "URL for spot #", "duena-revival" ) . '4',
			'description' => __( "Default is", "duena-revival" ) . " " . strval($fa_icons_list['linkedin-in']),
			'section' => 'duena_revival_header',
			'settings' => 'g_author_bio_social_linkedin_text',
			'priority' => 18
	) );

	/* g_author_bio_social_rss_icon */
	$wp_customize->add_setting( 'g_author_bio_social_rss_icon', array(
			'default' => 'rss',
			'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'g_author_bio_social_rss_icon', array(
			'label' => __( "Icon for spot #", "duena-revival" ) . '5',
			'description' => __( "Default is", "duena-revival" ) . " " . strval($fa_icons_list['rss']),
			'section' => 'duena_revival_header',
			'settings' => 'g_author_bio_social_rss_icon',
			'type' => 'select',
			'choices' => $fa_icons_list,
			'priority' => 18
	) );
	/* g_author_bio_social_rss_text */
	$wp_customize->add_setting( 'g_author_bio_social_rss_text', array(
			'default' => '#',
			'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( 'g_author_bio_social_rss_text', array(
			'label' => __( "URL for spot #", "duena-revival" ) . '5',
			'description' => __( "Default is", "duena-revival" ) . " " . strval($fa_icons_list['rss']),
			'section' => 'duena_revival_header',
			'settings' => 'g_author_bio_social_rss_text',
			'priority' => 18
	) );

	/*-----------------------------------------------------------------------------------*/
	/*  Color scheme (2.1.0) That orange color changer #ff5b5b
	/*-----------------------------------------------------------------------------------*/
	$wp_customize->add_setting( 'cs_primary_color', array(
			'default'						=> '#ff5b5b',
			'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cs_primary_color', array(
			'label' 			=> __( "Primary color", "duena-revival" ),
			'description' => __( "Color of links, borders on content boxes, social icons, meta icons, post type labels", "duena-revival" ),
			'section' 		=> 'colors',
			'settings' 		=> 'cs_primary_color'
	)));

	$wp_customize->add_setting( 'cs_secondary_color', array(
			'default' => '#71A08B',
			'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cs_secondary_color', array(
					'label' => __( "Secondary color", "duena-revival" ),
					'description' => __( "Color of links hovers", "duena-revival" ),
					'section' => 'colors',
					'settings' => 'cs_secondary_color'
	)));

	/*-----------------------------------------------------------------------------------*/
	/*	Logo - NOTE: This has moved to the title_tagline section
	/*-----------------------------------------------------------------------------------*/
	/* Logo Type */
	$wp_customize->add_setting( 'logo_type', array(
			'default' => 'text_logo',
			'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'logo_type', array(
			'label' => __( "What kind of logo?", "duena-revival" ),
			'section' => 'title_tagline',
			'settings' => 'logo_type',
			'type' => 'radio',
			'choices' => array(
					"image_logo" => __( "Image Logo", 'duena-revival'),
					"text_logo"  => __( "Text Logo", 'duena-revival')
			),
			'priority' => 11
	) );

	/* Logo Path */
	$options['logo_url'] = array( "name" => __( "Logo Image Path", "duena-revival" ),
						"desc" => __( "Upload logo image", "duena-revival" ),
						"id"   => "logo_url",
						"type" => "upload");
	$wp_customize->add_setting( 'logo_url', array(
		'sanitize_callback' => 'duena_revival_sanitize_image'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_url', array(
		'label' => __( "Logo Image Path", "duena-revival" ),
		'section' => 'title_tagline',
		'settings' => 'logo_url',
		'type'  => 'upload',
		'priority' => 12
	) ) );

	/*-----------------------------------------------------------------------------------*/
	/*	Blog
	/*-----------------------------------------------------------------------------------*/
	$wp_customize->add_section( 'duena_revival_blog', array(
			'title' => __( 'Blog', 'duena-revival' ),
			'priority' => 204
	) );

	/* Blog sidebar position */
	$wp_customize->add_setting( 'blog_sidebar_pos', array(
			'default' => 'right',
			'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'blog_sidebar_pos', array(
			'label' => __( "Sidebar position", "duena-revival" ),
			'section' => 'duena_revival_blog',
			'settings' => 'blog_sidebar_pos',
			'type' => 'radio',
			'choices' => array(
				"left" => __( "Left Sidebar", 'duena-revival'),
				"right" => __( "Right Sidebar", 'duena-revival')
			),
			'priority' => 11
	) );

	/* Blog image size */
	$wp_customize->add_setting( 'post_image_size', array(
			'default' => 'normal',
			'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'post_image_size', array(
			'label' => __( "Show featured image on Blog page", "duena-revival" ),
			'section' => 'duena_revival_blog',
			'settings' => 'post_image_size',
			'type' => 'select',
			// "class"   => "small", //mini, tiny, small ???
			'choices' => array(
				"normal" => __( "Yes", 'duena-revival'),
				"noimg" => __( "No", 'duena-revival')
			),
			'priority' => 12
	) );

	/* Single post image size */
	$wp_customize->add_setting( 'single_image_size', array(
			'default' => 'normal',
			'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'single_image_size', array(
			'label' => __( "Show featured image on Single post page", "duena-revival" ),
			'section' => 'duena_revival_blog',
			'settings' => 'single_image_size',
			'type' => 'select',
			'choices' => array(
				"normal" => __( "Yes", 'duena-revival'),
				"noimg" => __( "No", 'duena-revival')
			),
			'priority' => 13
	) );

	/* Post Meta */
	$wp_customize->add_setting( 'post_meta', array(
			'default' => '1',
			'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'post_meta', array(
			'label' => __( "Enable Meta for blog posts?", "duena-revival" ),
			'section' => 'duena_revival_blog',
			'settings' => 'post_meta',
			'type' => 'checkbox',
			'priority' => 14
	) );

	/* Post Excerpt */
	$wp_customize->add_setting( 'post_excerpt', array(
			'default' => '1',
			'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'post_excerpt', array(
			'label' => __( "Enable excerpt for blog posts?", "duena-revival" ),
			'section' => 'duena_revival_blog',
			'settings' => 'post_excerpt',
			'type' => 'checkbox',
			'priority' => 15
	) );

	/* Post Button */
	$wp_customize->add_setting( 'post_button', array(
			'default' => '1',
			'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'post_button', array(
			'label' => __( "Enable read more button for blog posts?", "duena-revival" ),
			'section' => 'duena_revival_blog',
			'settings' => 'post_button',
			'type' => 'checkbox',
			'priority' => 16
	) );

	/* Post Button Text */
	$wp_customize->add_setting( 'post_button_txt', array(
			'default' => __( "Read More", "duena-revival" ),
			'sanitize_callback' => 'wp_filter_nohtml_kses'
	) );
	$wp_customize->add_control( 'post_button_txt', array(
			'label' => __( "'Read more' button text", "duena-revival" ),
			'section' => 'duena_revival_blog',
			'settings' => 'post_button_txt',
			'priority' => 17
	) );


	/* Post author */
	$wp_customize->add_setting( 'post_author', array(
			'default' => '1',
			'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'post_author', array(
			'label' => __( "Show author bio on single post page?", "duena-revival" ),
			'section' => 'duena_revival_blog',
			'settings' => 'post_author',
			'type' => 'checkbox',
			'priority' => 19
	) );


	/* Related title */
	$wp_customize->add_setting( 'duena_revival[blog_related]', array(
			'default' => __( 'Related posts', 'duena-revival' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses'
	) );
	$wp_customize->add_control( 'blog_related', array(
			'label' => __( "Related Posts Title", "duena-revival" ),
			'section' => 'duena_revival_blog',
			'settings' => 'blog_related',
			'priority' => 20
	) );

	/*-----------------------------------------------------------------------------------*/
	/*  Slider (visualisation)
	/*-----------------------------------------------------------------------------------*/
	$wp_customize->add_section( 'duena_revival_slider_visual', array(
			'title' => __( 'Slider (visualisation)', 'duena-revival' ),
			'priority' => 202
	) );

	/* Slider Show */
	$wp_customize->add_setting( 'sl_show', array(
			'default' => '1',
			'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'sl_show', array(
			'label' => __( "Show slider", "duena-revival" ),
			'section' => 'duena_revival_slider_visual',
			'settings' => 'sl_show',
			'type' => 'checkbox',
			'priority' => 11
	) );

	/* Slider Effect */
	$wp_customize->add_setting( 'sl_effect', array(
			'default' => 'fade',
			'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'sl_effect', array(
			'label' => __( "Sliding effect", "duena-revival" ),
			'section' => 'duena_revival_slider_visual',
			'settings' => 'sl_effect',
			'type' => 'select',
			'choices' => array(
						"fade" => __( "Fade", 'duena-revival'),
						"slide" => __( "Slide", 'duena-revival')
			),
			'priority' => 12
	) );

	/* Slider Direction */
	$wp_customize->add_setting( 'sl_direction', array(
			'default' => 'horizontal',
			'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'sl_direction', array(
			'label' => __( "Sliding direction", "duena-revival" ),
			'section' => 'duena_revival_slider_visual',
			'settings' => 'sl_direction',
			'type' => 'select',
			'choices' => array(
						'horizontal' => __( 'Horizontal', 'duena-revival'),
						'vertical' => __( 'Vertical', 'duena-revival')
			),
			'priority' => 13
	) );

	/* Slider Slideshow */
	$wp_customize->add_setting( 'sl_slideshow', array(
					'default' => '1',
					'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'sl_slideshow', array(
					'label' => __( "Slideshow", "duena-revival" ),
					'section' => 'duena_revival_slider_visual',
					'settings' => 'sl_slideshow',
					'type' => 'checkbox',
					'priority' => 14
	) );

	/* Slider Controls */
	$wp_customize->add_setting( 'sl_control', array(
					'default' => '1',
					'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'sl_control', array(
					'label' => __( "Paging control", "duena-revival" ),
					'section' => 'duena_revival_slider_visual',
					'settings' => 'sl_control',
					'type' => 'checkbox',
					'priority' => 15
	) );

	/* Slider Effect */
	$wp_customize->add_setting( 'sl_direction_nav', array(
					'default' => '1',
					'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'sl_direction_nav', array(
					'label' => __( "Previous/Next navigation", "duena-revival" ),
					'section' => 'duena_revival_slider_visual',
					'settings' => 'sl_direction_nav',
					'type' => 'checkbox',
					'priority' => 16
	) );

	/*-----------------------------------------------------------------------------------*/
	/*  Slider (content)
	/*-----------------------------------------------------------------------------------*/
	$wp_customize->add_section( 'duena_revival_slider_content', array(
			'title' => __( 'Slider (content)', 'duena-revival' ),
			'priority' => 203
	) );

	/* Slider Number */
	$wp_customize->add_setting( 'sl_num', array(
					'default' => '4',
					'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( 'sl_num', array(
					'label' => __( "How many slides to show?", "duena-revival" ),
					'section' => 'duena_revival_slider_content',
					'settings' => 'sl_num',
					'type' => 'number',
					'priority' => 11
	) );

	/* Slider Category */
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	};
	$all_cats_array = array('from_all' => __( 'Select from all', 'duena-revival' ) ) + $options_categories;
	$wp_customize->add_setting( 'sl_category', array(
					'default' => '',
					'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'sl_category', array(
					'label' => __( "Which category to pull from?", "duena-revival" ),
					'section' => 'duena_revival_slider_content',
					'settings' => 'sl_category',
					'type' => 'select',
					'choices' => $all_cats_array,
					'priority' => 12
	) );

	/* Slider Link */
	$wp_customize->add_setting( 'sl_as_link', array(
					'default' => 'true',
					'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'sl_as_link', array(
					'label' => __( "Slide as link to the post", "duena-revival" ),
					'section' => 'duena_revival_slider_content',
					'settings' => 'sl_as_link',
					'type' => 'select',
					'choices' => array(
						"true" => __( "Yes", 'duena-revival'),
						"false" => __( "No", 'duena-revival')
					),
					'priority' => 13
	) );

	/* Slider Caption */
	$wp_customize->add_setting( 'sl_caption', array(
					'default' => 'hide',
					'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'sl_caption', array(
					'label' => __( "Show/Hide slide caption", "duena-revival" ),
					'section' => 'duena_revival_slider_content',
					'settings' => 'sl_caption',
					'type' => 'select',
					'choices' => array(
						'show' => __( 'Show', 'duena-revival'),
						'hide' => __( 'Hide', 'duena-revival')
					),
					'priority' => 14
	) );

	/* Slider Caption Title */
	$wp_customize->add_setting( 'sl_capt_title', array(
					'default' => 'show',
					'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'sl_capt_title', array(
					'label' => __( "Show/Hide slide caption title", "duena-revival" ),
					'section' => 'duena_revival_slider_content',
					'settings' => 'sl_capt_title',
					'type' => 'select',
					'choices' => array(
						'show' => __( 'Show', 'duena-revival'),
						'hide' => __( 'Hide', 'duena-revival')
					),
					'priority' => 15
	) );

	/* Slider Captiopn Excerpt */
	$wp_customize->add_setting( 'sl_capt_exc', array(
					'default' => 'show',
					'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'sl_capt_exc', array(
					'label' => __( "Show/Hide slide caption excerpt", "duena-revival" ),
					'section' => 'duena_revival_slider_content',
					'settings' => 'sl_capt_exc',
					'type' => 'select',
					'choices' => array(
						'show' => __( 'Show', 'duena-revival'),
						'hide' => __( 'Hide', 'duena-revival')
					),
					'priority' => 16
	) );

	/* Slider Caption Excerpt Length */
	$wp_customize->add_setting( 'sl_capt_exc_length', array(
					'default' => '20',
					'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( 'sl_capt_exc_length', array(
					'label' => __( "Slide caption excerpt length", "duena-revival" ),
					'section' => 'duena_revival_slider_content',
					'settings' => 'sl_capt_exc_length',
					'type' => 'number',
					'priority' => 17
	) );

	/* Slider Caption Button */
	$wp_customize->add_setting( 'sl_capt_btn', array(
					'default' => 'show',
					'sanitize_callback' => 'duena_revival_sanitize_choices'
	) );
	$wp_customize->add_control( 'sl_capt_btn', array(
					'label' => __( "Show/Hide slide caption button", "duena-revival" ),
					'section' => 'duena_revival_slider_content',
					'settings' => 'sl_capt_btn',
					'type' => 'select',
					'choices' => array(
						'show' => __( 'Show', 'duena-revival'),
						'hide' => __( 'Hide', 'duena-revival')
					),
					'priority' => 18
	) );

	/* Slider Caption Button Text */
	$wp_customize->add_setting( 'sl_capt_btn_txt', array(
					'default' => __( 'Read more', 'duena-revival' ),
					'sanitize_callback' => 'wp_filter_nohtml_kses'
	) );
	$wp_customize->add_control( 'sl_capt_btn_txt', array(
					'label' => __( "Slide caption button text", "duena-revival" ),
					'section' => 'duena_revival_slider_content',
					'settings' => 'sl_capt_btn_txt',
					'priority' => 19
	) );


	/*-----------------------------------------------------------------------------------*/
	/*	Portfolio
	/*-----------------------------------------------------------------------------------*/
	$wp_customize->add_section( 'duena_revival_portfolio', array(
			'title' => __( 'Portfolio', 'duena-revival' ),
			'priority' => 205
	) );

	/* Per page */
	$wp_customize->add_setting( 'portfolio_per_page', array(
			'default' => '12',
			'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( 'portfolio_per_page', array(
			'label' => __( "Posts per page", "duena-revival" ),
			'section' => 'duena_revival_portfolio',
			'settings' => 'portfolio_per_page',
			'type' => 'number',
			'priority' => 11
	) );

	/* Thumb */
	$wp_customize->add_setting( 'portfolio_show_thumbnail', array(
			'default' => '1',
			'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'portfolio_show_thumbnail', array(
			'label' => __( "Show thumbnail", "duena-revival" ),
			'section' => 'duena_revival_portfolio',
			'settings' => 'portfolio_show_thumbnail',
			'type' => 'checkbox',
			'priority' => 12
	) );

	/* Title */
	$wp_customize->add_setting( 'portfolio_show_title', array(
			'default' => '1',
			'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'portfolio_show_title', array(
			'label' => __( "Show title", "duena-revival" ),
			'section' => 'duena_revival_portfolio',
			'settings' => 'portfolio_show_title',
			'type' => 'checkbox',
			'priority' => 13
	) );

	/* Excerpt */
	$wp_customize->add_setting( 'portfolio_show_excerpt', array(
			'default' => '1',
			'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'portfolio_show_excerpt', array(
			'label' => __( "Show excerpt", "duena-revival" ),
			'section' => 'duena_revival_portfolio',
			'settings' => 'portfolio_show_excerpt',
			'type' => 'checkbox',
			'priority' => 14
	) );

	/* Link */
	$wp_customize->add_setting( 'portfolio_show_link', array(
			'default' => '1',
			'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'portfolio_show_link', array(
			'label' => __( "Show 'Read more' link", "duena-revival" ),
			'section' => 'duena_revival_portfolio',
			'settings' => 'portfolio_show_link',
			'type' => 'checkbox',
			'priority' => 15
	) );

	/*-----------------------------------------------------------------------------------*/
	/*	Footer
	/*-----------------------------------------------------------------------------------*/
	$wp_customize->add_section( 'duena_revival_footer', array(
		'title' => __( 'Footer', 'duena-revival' ),
		'priority' => 206
	) );

	/* Footer Copyright Text */
	$wp_customize->add_setting( 'footer_text', array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'footer_text', array(
			'label' => __( "Footer copyright text", "duena-revival" ),
			'description' => __( "Enter text used in the right side of the footer. HTML tags are allowed.", "duena-revival" ),
			'section' => 'duena_revival_footer',
			'settings' => 'footer_text'
	) );


	/* Display Footer Menu */
	$wp_customize->add_setting( 'footer_menu', array(
			'default' => '0',
			'sanitize_callback' => 'duena_revival_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'footer_menu', array(
			'label' => __( "Display Footer menu?", "duena-revival" ),
			'section' => 'duena_revival_footer',
			'settings' => 'footer_menu',
			'type' => 'checkbox'
	) );

}
add_action( 'customize_register', 'duena_revival_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function duena_revival_customize_preview_js() {
	wp_enqueue_script( 'duena_revival_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130304', true );
}
add_action( 'customize_preview_init', 'duena_revival_customize_preview_js' );
