<?php
/**
 * File Name -- Depreciated -- featured-image-post_type.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.2
 * @updated 05.30.13
 *
 * Depreciated in favor of FeaturedImagePostType
 **/
#################################################################################################### */


if ( class_exists( 'Featured_Images_Post_Type_VC' ) ) return;






/**
 * Featured Images Post Type VC
 * 
 * @version 1.2
 * @updated 05.30.13
 **/
class Featured_Images_Post_Type_VC {	
	
	
	
	
	
	/**
	 * Form Select
	 * 
	 * @version 1.2
	 * @updated 05.30.13
	 **/
	function form_select( $args = array() ) {
		
		featured_image__form_select( $args );
		
	} // end function form_select
	
	

} // end class Featured_Images_Post_Type_VC