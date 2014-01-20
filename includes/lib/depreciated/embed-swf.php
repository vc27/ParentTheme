<?php
/**
 * File Name -- Depreciated -- embed-swf.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.6
 * @updated 04.03.13
 *
 * Depreciated
 **/
#################################################################################################### */






/**
 * Google Embed SWF
 *
 * Utilizes the google swfobject.embedSWF js.
 *
 * @version 0.0.3
 * @updated: 01.31.12
 * @since 3.5.4
 **/
add_shortcode( 'embedswf', 'vc_google_embedswf_shortcode' );
function vc_google_embedswf( $object, $args = '' ) {
	
	// Set Defaults
	$defaults = array(
		'url'	 		=> '',
		'width' 		=> 640,
		'height'		=> 480,
		'container_id' 	=> "vcswf-$object->post_name",
		'alt_content' 	=> '',
		'echo'			=> 1,
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	
	// Set URL
	if ( empty( $url ) )
		$url = get_post_meta( $object->ID, 'embedswf_url', true );
	
	
	// Build Output
	$output = '';
	if ( !empty( $url ) ) {
		$output .= "<script type=\"text/javascript\">swfobject.embedSWF('$url', '$container_id', '$width', '$height', '9.0.0'); </script>";
		$output .= "<div class=\"vc-embedswf-google\"><div id=\"$container_id\"><p>$alt_content</p></div></div>";
	}
	
	
	if ( $echo )
		echo $output;
	else 
		return $output;
	

} // end function vc_google_embedswf






/**
 * Shortcode Google Embed SWF
 *
 * @version 0.1
 * @since 3.5.4
 **/
function vc_google_embedswf_shortcode( $args = '' ) {
	global $wp_query;
	
	$args['echo'] = 0;
	return vc_google_embedswf( $wp_query->post, $args );
	
} // end function vc_google_embedswf_shortcode