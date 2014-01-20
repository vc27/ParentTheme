<?php
/**
 * File Name theme-support-depreciated.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 05.31.13
 **/
#################################################################################################### */






/**
 * Widget Title
 *
 * This function creates the widget titles
 * Decides if the title is an image, text or turned off...
 *
 * @version 0.1
 * @since 3.5.4
 **/
function get_vclib_w_title( $title_display, $text_title, $image_title ) {
	
	if ( $title_display == 'Image' AND !empty( $image_title ) ) {
		$title = "<img src=\"$image_title\" title=\"$text_title\" alt=\"$text_title\" />";

	} elseif ( $title_display == 'Off' ) {
		$title = false;
	
	} elseif ( $title_display == 'Post Title' ) {
		$title = "%post_title%";
		
	} else {
		$title = $text_title;
		
	}
	
	return $title;

} // end function get_vclib_w_title






/**
 * Widget Class
 *
 * This function creates the class for widgets
 * breaks apart the value as csv and prints each after sanitizing them.
 *
 * This needs to be altered, it currently uses str_replace and puts the class
 * in all html elements within $before_widget which is not necessary.
 *
 * @version 0.1
 * @since 3.5.4
 **/
function vclib_w_css_class( $css_class, $before_widget ) {

	// Set CSS
	$css_class = explode( ',', $css_class );
	foreach( $css_class as $class ) {
		$classes[] = sanitize_title_with_dashes( $class );
	}
	
	$css_class 		= implode( ' ', $classes );
	$output 		= str_replace( 'sub_class', $css_class, $before_widget );
	
	return $output;

} // end function vclib_w_css_class