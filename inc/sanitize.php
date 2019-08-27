<?php
/*
  Custom sanitization. Because Wordpress needs us to do it.
  */

/**
 * Sanitization for checkbox input
 *
 * @param $input string (1 or empty) checkbox state
 * @return $output '1' or false
 */
function duena_revival_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
};
add_filter( 'duena_revival_sanitize_checkbox', 'duena_revival_sanitize_checkbox' );

/**
 * Sanitization for radio buttons input
 *
 * @param string $input
 * @returns string $output
 */
function duena_revival_sanitize_choices( $input, $setting ){

    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible choices
    $choices = $setting->manager->get_control( $setting->id )->choices;

    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

};
add_filter( 'duena_revival_sanitize_choices', 'duena_revival_sanitize_choices' );

/**
 * File upload sanitization.
 *
 * Returns a sanitized filepath if it has a valid extension.
 *
 * @param string $input filepath
 * @returns string $output filepath
 */
function duena_revival_sanitize_image( $input ){

    /* default output */
    $output = '';

    /* check file type */
    $filetype = wp_check_filetype( $input );
    $mime_type = $filetype['type'];

    /* only mime type "image" allowed */
    if ( strpos( $mime_type, 'image' ) !== false ){
        $output = $input;
    }

    return $output;
};
add_filter( 'duena_revival_sanitize_image', 'duena_revival_sanitize_image' );

?>
