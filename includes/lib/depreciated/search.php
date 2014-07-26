<?php
/**
-- Depreciated --
**/
/**
 * File Name search.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.5
 * @updated 04.03.13
 **/
#################################################################################################### */






/**
 * Search Box
 *
 * @version 0.1
 * @since 3.5.4
 **/
add_shortcode( 'site_search', 'vc_searchbox_shortcode' );
function vc_search( $args = '' ) {
	
	$defaults = array(
		'before' => '',
		'after' => '',
		'element' => 'div',
		'class' => '',
		'echo' => 1,
	);
	
	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	$output .= "<$element class=\"site-search $class\">";
		
		$output .= $before;
		
		$output .= get_search_form( false );
		
		$output .= $after;
	
	$output .= "</$element>";
	
	$output = apply_filters( 'vc_search', $output );
	
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}

} // end function vc_search






/**
 * Search Box Short Code
 *
 * @version 0.1
 * @since 3.5.4
 **/
function vc_searchbox_shortcode() {
	
	return vc_search( array( 'echo' => 0, 'element' => 'span' ) );
	
} // function vc_searchbox_shortcode