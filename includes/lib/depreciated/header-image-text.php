<?php
/**
 * File Name -- Depreciated -- 
header-image-text.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.7
 * @updated 04.03.13
 * 
 * Depreciated
 **/
#################################################################################################### */






/**
 * Header Image or Title Text
 *
 * This function allows you to print the sites Title and Description
 * or you can print out a header Image which is assigned from the themes options.
 * 
 * WP_DEBUG --> Notice: Undefined variable 'header_alt_link' -- is this really a bad thing
 * or is it more of a preference?
 *
 * @version 0.0.5
 * @updated: 01.31.12
 * @since 3.5.4
 **/
function header_image_or_text( $args = '' ) {
	
	// Set Defaults
	$defaults = array(
		'img_or_text'		=> get_vc_option( 'website_title', 'img_or_text' ),
		'header_image'		=> get_vc_option( 'website_title', 'header_image' ),
		'header_alt_link'	=> get_vc_option( 'website_title', 'header_alt_link' ),
		'echo'				=> 1,
		);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	if ( !empty( $header_alt_link ) )
		$link = $header_alt_link;
	else
		$link = home_url();
	
	$a_ = "<a href=\"$link\" title=\"" . get_bloginfo('name') . "\">";
	$_a = "</a>";
	
	// Set Text
	if ( $img_or_text == 'text' ) {

		$header_img_text = "<h1>" . $a_ . get_bloginfo('name') . $_a . "</h1>";
		$header_img_text .= "<div class=\"site-desc\">" . wpautop( get_bloginfo('description') ) . "</div>";
	
	
	// Set Image
	} elseif ( $img_or_text == 'image' ) {

		$header_img_text = $a_ . "<img src=\"$header_image\" alt=\"" . get_bloginfo('name') . "\" />" . $_a;
		
		// Add header_image filters
		$header_img_text = apply_filters( 'vc_header_image', $header_img_text );
	
	
	} else {

		$header_img_text = false;

	}
	
	
	// Build Output
	$output = '';
	$output .= "<div class=\"site-title\">";
		$output .= $header_img_text;
	$output .= "</div>";
	
	
	$output = apply_filters( 'header_img_text', $output );
	
	
	if ( $echo )
		echo $output;
	else
		return $output;
		
} // end function header_img_text