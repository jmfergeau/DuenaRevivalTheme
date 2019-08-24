<?php
/*
  Custom sanitization. Because Wordpress needs us to do it.
  */

function duena_revival_yesno_sanitization( $input ) {
   if ( true === $input ) {
      return 'yes';
   } else {
      return 'no';
   }
};
add_filter( 'duena_revival_yesno_sanitization', 'duena_revival_yesno_sanitization' );

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
function duena_revival_sanitize_choices( $input, $option ) {
  global $wp_customize;

    $control = $wp_customize->get_control( $setting->id );

    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
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
