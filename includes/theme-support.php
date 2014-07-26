<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */






/**
 * is__user
 *
 **/
function is__user( $user_login = false ) {
	$userdata = wp_get_current_user();
	
	if ( $user_login AND isset( $userdata->data->user_login ) AND $userdata->data->user_login == $user_login )
		return true;
	else
		return false;

} // end function is__user






/**
 * Sidebar function
 *
 * Checks to see if the side bar is being used.
 * Wraps the sidebar in html and give it a class.
 *
 * @version 1.3
 * @updated 07.02.13
 **/
function vc_sidebars( $name, $args = '' ) {
	
	$defaults = array(
		'class' => '',
		'element' => 'ul',
		);
	
	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	// Filter Sidebar
	$name = apply_filters( 'vc_sidebar_name', $name );
	
	if ( ! is_active_sidebar( $name ) ) {
		return false;
	}
	
	// Set html id
	$sidebar_id = sanitize_title_with_dashes( $name );
	
	if ( isset( $class ) AND ! empty( $class ) ) {
		$class = "$sidebar_id $class";
	} else {
		$class = $sidebar_id;
	}
	
	// Sidebar
	echo "\n<!-- $sidebar_id -->\n";
	echo "<$element class=\"sidebar $class\">";
	
		dynamic_sidebar( $name );
		
	echo "</$element>";
	echo "\n<!-- End $sidebar_id -->\n";
	

} // end function vc_sidebars