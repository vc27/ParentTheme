<?php
/**
 * File Name -- Depreciated -- featured-image.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.7
 * @updated 05.08.13
 * 
 * Depreciated in favor of featured__image( $post, $args = array() )
 **/
#################################################################################################### */




/**
 * Featured Image
 * 
 * Take a post object and display the associated Featured Image or
 * post_meta value image.
 *
 * @version 1.6
 * @updated 05.08.13
 **/
function vc_featured_image( $post, $args = array() ) {
	
	
	if ( !is_object( $post ) AND is_numeric( $post ) )
		$post = get_post( $post );
	else if ( isset( $args['post_id'] ) AND is_numeric( $args['post_id'] ) )
		$post = get_post( $args['post_id'] );
	else if ( !is_object( $post ) )
		$post = null;
	
	$defaults = array(
		'post_id' 				=> $post->ID,
		'title'					=> $post->post_title,
		'before' 				=> '',
		'after' 				=> '',
		'class' 				=> '',
		'permalink' 			=> get_permalink( $post->ID ),
		'target'	 			=> false,
		'post_thumbnail_size' 	=> false,
		'post_meta' 			=> false,
		'alt_image'				=> false,
		'height'				=> false,
		'width'					=> false,
		'post_type'				=> $post->post_type,
		'multi_id'				=> false,
		'echo' 					=> 1,
		);
	
	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	// Backwards compatible
	if ( isset( $link ) AND ! empty( $link ) AND !$permalink ) $permalink = $link;
	
	// Set Link tag
	if( $permalink ) {
		$a_ = "<a class=\"$class-wrap\" href=\"$permalink\" title=\"$title\" target=\"$target\">";
		$_a = "</a>";
	}
	
	
	// link target
	if ( $target ) $target = "target=\"$target\"";
	
	
	// Post Meta -- Allow to accept an alternate post meta name
	if ( $post_meta )
		$post_meta_img = get_post_meta( $post_id, $post_meta, true );
	else
		$post_meta_img = false;
	
	
	
	// Build Alternate Image
	if ( $post_meta_img OR $alt_image ) {
		
		// alt_image or post_meta_img
		if ( $alt_image )
			$image_url = $alt_image;
		elseif ( $post_meta_img )
			$image_url = $post_meta_img;
		
		
		$image = vc_img_html( array(
			'content_id'	=> '',
			'title' 		=> $title,
			'src'			=> $image_url,
			'height'		=> $height,
			'width'			=> $width,
			'class' 		=> $class,
			'alt_text'		=> sanitize_title_with_dashes( $title ),
			'echo' 			=> 0,
			) );
	
	// Featured Image
	} elseif ( has_post_thumbnail( $post_id ) OR ( $multi_id AND class_exists( 'MultiPostThumbnails' ) AND MultiPostThumbnails::has_post_thumbnail( $post_type, $multi_id, $post_id ) ) ) {
		
		
		// Size
		if ( $width AND $height )
			$size = array( $width, $height );
		elseif ( $post_thumbnail_size )
			$size = sanitize_title_with_dashes( $post_thumbnail_size );
		
		
		// Image Attributes
		$attr = array(
			'class'	=> "$class attachment-$size",
			'alt'	=> trim( strip_tags( $title ) ),
			'title'	=> trim( strip_tags( $title ) ),
			);
		
		
		// Set Image -- allows for plugin multi-post-thumbnails !!!
		if ( $multi_id AND class_exists('MultiPostThumbnails') )
			$image = MultiPostThumbnails::get_the_post_thumbnail( $post->post_type, $multi_id, $post_id, $size, $attr );
		else
			$image = get_the_post_thumbnail( $post_id, $size, $attr );
	
	
	// Nothing ? Return false
	} else {
		
		$image = false;
		
	}
	
	
	// Build final out put and echo / return
	if ( $image ) {
		
		$image = $a_ . $before . apply_filters( 'vc_featured_image', $image, $post, $args ) . $after . $_a;
		
		if ( $echo )
			echo $image;
		else
			return $image;
		
	} else {
		
		return false;
		
	} // end if ( $image )
	
	
} // end function vc_featured_image






/** 
 * Create a Raw Image HTML 
 *
 * This function is use as a substitute for image placement.
 *
 * @version 0.0.1
 * @updated 03.09.12
 **/
function vc_img_html( $args = '' ) {

	// Set Defaults
	$defaults = array(
		'content_id'	=> false,
		'title' 		=> false,
		'src'			=> false,
		'height'		=> false,
		'width'			=> false,
		'class' 		=> false,
		'alt_text'		=> false,
		'echo' 			=> 1,
		);
	
	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	
	// sanatize class sting
	$class = sanitize_title_with_dashes( $class );
	
	
	// Check for width and height
	if ( is_numeric( $width ) AND is_numeric( $height ) ) {
		$width 	= "width=\"$width\"";
		$height = "height=\"$height\"";
	}
	
	
	// Set html id
	if ( $content_id ) $content_id = "id=\"$content_id\"";
	
	// Set html class
	if ( $class ) $class = "class=\"$class\"";
	
	
	// Build Image or return false
	if ( $src )
		$image = "<img $class $content_id title=\"$title\" alt=\"$alt_text\" src=\"$src\" $width $height />";
	else
		return false;
	
	
	// Echo or return
	if ( $echo )
		echo $image;
	else
		return $image;
	
} // end function vc_img_html