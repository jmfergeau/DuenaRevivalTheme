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
	$options['g_search_box_id'] = array( "name" => __( "Display search box?", "duena-revival" ),
						"desc"    => __( "Display search box in the header?", "duena-revival" ),
						"id"      => "g_search_box_id",
						"type"    => "checkbox",
						"std"     => 1);
	$wp_customize->add_setting( 'duena_revival[g_search_box_id]', array(
			'default' => $options['g_search_box_id']['std'],
			'sanitize_callback' => 'duena_revival_sanitize_checkbox',
			'type' => 'option'
	) );
	$wp_customize->add_control( 'duena_revival_g_search_box_id', array(
			'label' => $options['g_search_box_id']['name'],
			'section' => 'duena_revival_header',
			'settings' => 'duena_revival[g_search_box_id]',
			'type' => $options['g_search_box_id']['type'],
			'priority' => 11
	) );

	/* Breadcrumbs */
	$options['g_breadcrumbs_id'] = array( "name" => __( "Display breadcrumbs?", "duena-revival" ),
						"desc"    => __( "Display breadcrumbs?", "duena-revival" ),
						"id"      => "g_breadcrumbs_id",
						"type"    => "checkbox",
						"std"     => true);
	$wp_customize->add_setting( 'duena_revival[g_breadcrumbs_id]', array(
			'default' => $options['g_breadcrumbs_id']['std'],
			'sanitize_callback' => 'duena_revival_sanitize_checkbox',
			'type' => 'option'
	) );
	$wp_customize->add_control( 'duena_revival_g_breadcrumbs_id', array(
			'label' => $options['g_breadcrumbs_id']['name'],
			'section' => 'duena_revival_header',
			'settings' => 'duena_revival[g_breadcrumbs_id]',
			'type' => $options['g_breadcrumbs_id']['type'],
			'priority' => 12
	) );

	/* Portfolio cat */
	$options['g_portfolio_cat'] = array( "name" => __( "Category slug for portfolio page", "duena-revival" ),
						"desc" => __( "Enter category slug, from which you like to fill portfolio page", "duena-revival" ),
						"id"   => "g_portfolio_cat",
						"type" => "text",
						"std"  => "");
	$wp_customize->add_setting( 'duena_revival[g_portfolio_cat]', array(
			'default' => $options['g_portfolio_cat']['std'],
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'type' => 'option'
	) );
	$wp_customize->add_control( 'duena_revival_g_portfolio_cat', array(
			'label' => $options['g_portfolio_cat']['name'],
			'section' => 'duena_revival_header',
			'settings' => 'duena_revival[g_portfolio_cat]',
			'type' => $options['g_portfolio_cat']['type'],
			'priority' => 13
	) );

	/* g_author_bio */
	$options['g_author_bio'] = array( "name" => __( "Display Author Bio in sidebar", "duena-revival" ),
						"desc"    => __( "Show/hide author bio in sidebar", "duena-revival" ),
						"id"      => "g_author_bio",
						"type"    => "checkbox",
						"std"     => true);
	$wp_customize->add_setting( 'duena_revival[g_author_bio]', array(
			'default' => $options['g_author_bio']['std'],
			'sanitize_callback' => 'duena_revival_sanitize_checkbox',
			'type' => 'option'
	) );
	$wp_customize->add_control( 'duena_revival_g_author_bio', array(
			'label' => $options['g_author_bio']['name'],
			'section' => 'duena_revival_header',
			'settings' => 'duena_revival[g_author_bio]',
			'type' => $options['g_author_bio']['type'],
			'priority' => 14
	) );

	/* g_author_bio_title */
	$options['g_author_bio_title'] = array( "name" => __( "Author Bio Title", "duena-revival" ),
						"desc"  => __( "Enter Author Bio Title", "duena-revival" ),
						"id"    => "g_author_bio_title",
						"type"  => "text",
						"class" => "hidden",
						"std"   => __( "Welcome to my site", "duena-revival" ));
	$wp_customize->add_setting( 'duena_revival[g_author_bio_title]', array(
			'default' => $options['g_author_bio_title']['std'],
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'type' => 'option'
	) );
	$wp_customize->add_control( 'duena_revival_g_author_bio_title', array(
			'label' => $options['g_author_bio_title']['name'],
			'section' => 'duena_revival_header',
			'settings' => 'duena_revival[g_author_bio_title]',
			'type' => $options['g_author_bio_title']['type'],
			'priority' => 15
	) );

	/* g_author_bio_img */
	$options['g_author_bio_img'] = array( "name" => __( "Author Bio image", "duena-revival" ),
						"desc"  => __( "Upload Author Bio image", "duena-revival" ),
						"id"    => "g_author_bio_img",
						"class" => "hidden",
						"type"  => "upload");
	$wp_customize->add_setting( 'duena_revival[g_author_bio_img]', array(
			'type' => 'option',
			'sanitize_callback' => 'duena_revival_sanitize_image'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'g_author_bio_img', array(
		'label' => $options['g_author_bio_img']['name'],
		'section' => 'duena_revival_header',
		'settings' => 'duena_revival[g_author_bio_img]',
		'priority' => 16
	) ) );

	/* g_author_bio_message */
	$options['g_author_bio_message'] = array( "name" => __( "Author Bio Message", "duena-revival" ),
						"desc"  => __( "Enter Author Bio Message (HTML tags allowed)", "duena-revival" ),
						"id"    => "g_author_bio_message",
						"type"  => "textarea",
						"class" => "hidden",
						"std"   => __( "Hello, and welcome to my site! I hope you like the place and decide to stay.", "duena-revival" ));
	$wp_customize->add_setting( 'duena_revival[g_author_bio_message]', array(
			'default' => $options['g_author_bio_message']['std'],
			'sanitize_callback' => 'sanitize_text_field',
			'type' => 'option'
	) );
	$wp_customize->add_control( 'duena_revival_g_author_bio_message', array(
			'label' => $options['g_author_bio_message']['name'],
			'section' => 'duena_revival_header',
			'settings' => 'duena_revival[g_author_bio_message]',
			'type' => 'text',
			'priority' => 17
	) );

	/* g_author_bio_social_twitter */
	$options['g_author_bio_social_twitter'] = array( "name" => __( "Author Twitter URL", "duena-revival" ),
						"desc"  => __( "Enter Author Twitter URL", "duena-revival" ),
						"id"    => "g_author_bio_social_twitter",
						"type"  => "text",
						"class" => "hidden",
						"std"   => "#");
	$wp_customize->add_setting( 'duena_revival[g_author_bio_social_twitter]', array(
			'default' => $options['g_author_bio_social_twitter']['std'],
			'sanitize_callback' => 'esc_url_raw',
			'type' => 'option'
	) );
	$wp_customize->add_control( 'duena_revival_g_author_bio_social_twitter', array(
			'label' => $options['g_author_bio_social_twitter']['name'],
			'section' => 'duena_revival_header',
			'settings' => 'duena_revival[g_author_bio_social_twitter]',
			'type' => $options['g_author_bio_social_twitter']['type'],
			'priority' => 18
	) );

	/* g_author_bio_social_facebook */
	$options['g_author_bio_social_facebook'] = array( "name" => __( "Author Facebook URL", "duena-revival" ),
						"desc"  => __( "Enter Author Facebook URL", "duena-revival" ),
						"id"    => "g_author_bio_social_facebook",
						"type"  => "text",
						"class" => "hidden",
						"std"   => "#");
	$wp_customize->add_setting( 'duena_revival[g_author_bio_social_facebook]', array(
			'default' => $options['g_author_bio_social_facebook']['std'],
			'sanitize_callback' => 'esc_url_raw',
			'type' => 'option'
	) );
	$wp_customize->add_control( 'duena_revival_g_author_bio_social_facebook', array(
			'label' => $options['g_author_bio_social_facebook']['name'],
			'section' => 'duena_revival_header',
			'settings' => 'duena_revival[g_author_bio_social_facebook]',
			'type' => $options['g_author_bio_social_facebook']['type'],
			'priority' => 19
	) );

	/* g_author_bio_social_patreon */
	$options['g_author_bio_social_patreon'] = array( "name" => __( "Author Patreon URL", "duena-revival" ),
						"desc"  => __( "Enter Author Patreon URL", "duena-revival" ),
						"id"    => "g_author_bio_social_patreon",
						"type"  => "text",
						"class" => "hidden",
						"std"   => "#");
	$wp_customize->add_setting( 'duena_revival[g_author_bio_social_patreon]', array(
			'default' => $options['g_author_bio_social_patreon']['std'],
			'sanitize_callback' => 'esc_url_raw',
			'type' => 'option'
	) );
	$wp_customize->add_control( 'duena_revival_g_author_bio_social_patreon', array(
			'label' => $options['g_author_bio_social_patreon']['name'],
			'section' => 'duena_revival_header',
			'settings' => 'duena_revival[g_author_bio_social_patreon]',
			'type' => $options['g_author_bio_social_patreon']['type'],
			'priority' => 20
	) );

	/* g_author_bio_social_linked */
	$options['g_author_bio_social_linked'] = array( "name" => __( "Author LinkedIn URL", "duena-revival" ),
						"desc"  => __( "Enter Author LinkedIn URL", "duena-revival" ),
						"id"    => "g_author_bio_social_linked",
						"type"  => "text",
						"class" => "hidden",
						"std"   => "#");
	$wp_customize->add_setting( 'duena_revival[g_author_bio_social_linked]', array(
			'default' => $options['g_author_bio_social_linked']['std'],
			'sanitize_callback' => 'esc_url_raw',
			'type' => 'option'
	) );
	$wp_customize->add_control( 'duena_revival_g_author_bio_social_linked', array(
			'label' => $options['g_author_bio_social_linked']['name'],
			'section' => 'duena_revival_header',
			'settings' => 'duena_revival[g_author_bio_social_linked]',
			'type' => $options['g_author_bio_social_linked']['type'],
			'priority' => 21
	) );

	/* g_author_bio_social_rss */
	$options['g_author_bio_social_rss'] = array( "name" => __( "Author RSS URL", "duena-revival" ),
						"desc"  => __( "Enter Author RSS URL", "duena-revival" ),
						"id"    => "g_author_bio_social_rss",
						"type"  => "text",
						"class" => "hidden",
						"std"   => "#");
	$wp_customize->add_setting( 'duena_revival[g_author_bio_social_rss]', array(
			'default' => $options['g_author_bio_social_rss']['std'],
			'sanitize_callback' => 'esc_url_raw',
			'type' => 'option'
	) );
	$wp_customize->add_control( 'duena_revival_g_author_bio_social_rss', array(
			'label' => $options['g_author_bio_social_rss']['name'],
			'section' => 'duena_revival_header',
			'settings' => 'duena_revival[g_author_bio_social_rss]',
			'type' => $options['g_author_bio_social_rss']['type'],
			'priority' => 22
	) );

	/*-----------------------------------------------------------------------------------*/
	/*  Color scheme (2.1.0) That orange color changer #ff5b5b
	/*-----------------------------------------------------------------------------------*/
	$options['cs_primary_color'] = array( "name" => __( "Primary color", "duena-revival" ),
						"desc" => __( "Color of links, borders on content boxes, social icons, meta icons, post type labels", "duena-revival" ),
						"id"   => "cs_primary_color",
						"std"  => "#FF5B5B",
						"type" => "color");

	$options['cs_secondary_color'] = array( "name" => __( "Secondary color", "duena-revival" ),
						"desc" => __( "Color of links hovers", "duena-revival" ),
						"id"   => "cs_secondary_color",
						"std"  => "#71A08B",
						"type" => "color");
	$wp_customize->add_setting( 'cs_primary_color', array(
		'default'=>'#ff5b5b',
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option',
		'capability' =>  'edit_theme_options'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
				$wp_customize, 'cs_primary_color', array(
					'label' => $options['cs_primary_color']['name'],
					'section' => 'colors',
					'settings' => 'cs_primary_color')
		)
	);

	$wp_customize->add_setting( 'cs_secondary_color', array(
		'default'=>'#71A08B',
		'sanitize_callback' => 'sanitize_hex_color',
		'type' => 'option',
		'capability' =>  'edit_theme_options'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
				$wp_customize, 'cs_secondary_color', array(
					'label' => $options['cs_secondary_color']['name'],
					'section' => 'colors',
					'settings' => 'cs_secondary_color')
		)
	);

	/*-----------------------------------------------------------------------------------*/
	/*	Logo - NOTE: This has moved to the title_tagline section
	/*-----------------------------------------------------------------------------------*/

	/* Logo Type */
	$options['logo_type'] = array( "name" => __( "What kind of logo?", "duena-revival" ),
						"desc"    => __( "Select whether you want your main logo to be an image or text. If you select 'image' you can put in the image url in the next option, and if you select 'text' your Site Title will show instead.", "duena-revival" ),
						"id"      => "logo_type",
						"std"     => "text_logo",
						"type"    => "radio");
	$wp_customize->add_setting( 'duena_revival[logo_type]', array(
			'default' => $options['logo_type']['std'],
			'sanitize_callback' => 'duena_revival_sanitize_choices',
			'type' => 'option'
	) );
	$wp_customize->add_control( 'duena_revival_logo_type', array(
			'label' => $options['logo_type']['name'],
			'section' => 'title_tagline',
			'settings' => 'duena_revival[logo_type]',
			'type' => $options['logo_type']['type'],
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
	$wp_customize->add_setting( 'duena_revival[logo_url]', array(
		'sanitize_callback' => 'duena_revival_sanitize_image',
		'type' => 'option'
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_url', array(
		'label' => $options['logo_url']['name'],
		'section' => 'title_tagline',
		'settings' => 'duena_revival[logo_url]',
		'priority' => 12
	) ) );






}
add_action( 'customize_register', 'duena_revival_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function duena_revival_customize_preview_js() {
	wp_enqueue_script( 'duena_revival_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130304', true );
}
add_action( 'customize_preview_init', 'duena_revival_customize_preview_js' );
