<?php
/**
 * File Name wrapper-functions.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 03.22.13
 **/
#################################################################################################### */






/**
 * AppendPostData --> Wrapper Function
 *
 * @version 1.0
 * @updated	03.16.13
 **/
function append__post_data( $options ) {
	
	$output = false;
	
	if ( ! class_exists( 'AppendPostData' ) ) {
		require_once( 'AppendPostData.php' );
		
		if ( class_exists( 'AppendPostData' ) ) {
			
			$AppendPostData = new AppendPostData();
			$AppendPostData->init( $options );
			$output = true;
			
		}
			
	}
	
	return $output;
	
} // end function append__post_data






/**
 * PostTypeVCWP --> Wrapper Function
 *
 * @version 1.1
 * @updated	05.02.13
 **/
function register__post_type( $options ) {
	
	$output = false;
	if ( ! class_exists( 'PostTypeVCWP' ) ) {		
		require_once( 'PostTypeVCWP.php' );			
	}
	
	if ( class_exists( 'PostTypeVCWP' ) ) {		
		$PostTypeVCWP = new PostTypeVCWP();
		$output = $PostTypeVCWP->register_post_type( $options );
	}
	
	return $output;
	
} // end function register__post_type






/**
 * register__postmeta --> Wrapper Function
 *
 * @version 1.2
 * @updated	05.07.13
 **/
function register__postmeta( $post_types, $options ) {
	
	if ( ! is_admin() ) {
		return false;
	}
	
	$output = false;
	if ( ! class_exists( 'PostMetaVCWP' ) ) {		
		require_once( 'PostMetaVCWP.php' );
	}
	
	if ( class_exists( 'PostMetaVCWP' ) ) {
		
		$PostMetaVCWP = new PostMetaVCWP();
		$output = $PostMetaVCWP->register__post_meta( $post_types, $options );
		
	}
	
	return $output;
	
} // end function register__postmeta 






/**
 * sanitize__value --> Wrapper Function
 *
 * @version 1.0
 * @updated	05.08.13
 **/
function sanitize__value( $type, $value, $filter = false, $args = false ) {
	
	$output = false;
	if ( ! class_exists( 'SanitizeValueVCWP' ) ) {		
		require_once( 'SanitizeValueVCWP.php' );
	}
	
	if ( class_exists( 'SanitizeValueVCWP' ) ) {
		
		$SanitizeValueVCWP = new SanitizeValueVCWP();
		$output = $SanitizeValueVCWP->sanitize( $type, $value, $filter, $args );
		
	}
	
	return $output;
	
} // end function sanitize__value 






/**
 * form__field --> Wrapper Function
 *
 * @version 1.0
 * @updated	05.15.13
 **/
function form__field( $type, $name, $val, $id = false, $class = false, $desc = false, $options = false, $action = false, $args = false ) {
	
	$output = false;
	if ( ! class_exists( 'FormFieldsVCWP' ) ) {
		require_once( 'FormFieldsVCWP.php' );
	}
	
	if ( class_exists( 'FormFieldsVCWP' ) ) {
		
		$FormFieldsVCWP = new FormFieldsVCWP();
		$output = $FormFieldsVCWP->field( $type, $name, $val, $id, $class, $desc, $options, $action, $args );
		
	}
	
	return $output;
	
} // end function form__field 






/**
 * featured__image --> Wrapper Function
 *
 * @version 1.0
 * @updated	05.16.13
 **/
function featured__image( $post, $args = array() ) {
	
	$output = false;
	if ( ! class_exists( 'FeaturedImageVCWP' ) ) {
		require_once( 'FeaturedImageVCWP.php' );
	}
	
	if ( class_exists( 'FeaturedImageVCWP' ) ) {
		
		$FeaturedImageVCWP = new FeaturedImageVCWP();
		$output = $FeaturedImageVCWP->image( $post, $args );
		
	}
	
	return $output;
	
} // end function featured__image 






/**
 * create__options_page --> Wrapper Function
 *
 * @version 1.0
 * @updated	05.23.13
 * 
 * Note:
 * This function MUST be ran before admin_menu
 * is only ran if is_admin()
 **/
function create__options_page( $option_page ) {
	
	if ( ! is_admin() ) {
		return;
	}
	
	$output = false;
	if ( ! class_exists( 'OptionPageVCWP' ) ) {
		require_once( 'OptionPageVCWP.php' );
	}
	
	if ( class_exists( 'OptionPageVCWP' ) ) {
		
		$OptionPageVCWP = new OptionPageVCWP();
		$output = $OptionPageVCWP->create_page( $option_page );
		
	}
	
	return $output;
	
} // end function create__options_page






/**
 * create__posts --> Wrapper Function
 *
 * @version 1.0
 * @updated	05.30.13
 **/
function create__posts( $posts, $overwrite_posts = false ) {
	
	$output = false;
	if ( ! class_exists( 'CreatePostsVCWP' ) ) {
		require_once( 'CreatePosts/CreatePostsVCWP.php' );
	}
	
	if ( class_exists( 'CreatePostsVCWP' ) ) {
		
		$create_posts = new CreatePostsVCWP();
		$create_posts->set( 'overwrite_posts', $overwrite_posts );
		$create_posts->add_posts( $posts );
		$output = $create_posts;
		
	}
	
	return $output;
	
} // end function create__posts 






/**
 * fetch__data --> Wrapper Function
 *
 * @version 1.0
 * @updated	05.31.13
 **/
function fetch__data( $type, $url, $args = array(), $transient_name = false, $reset_transient = false ) {
	
	$output = false;
	if ( ! class_exists( 'GetRemoteDataVCWP' ) ) {
		require_once( 'GetRemoteDataVCWP.php' );
	}
	
	if ( class_exists( 'GetRemoteDataVCWP' ) ) {
		
		$fetch__data = new GetRemoteDataVCWP();
		$fetch__data->fetch_data( $type, $url, $args, $transient_name, $reset_transient );
		$output = $fetch__data;
		
	}
	
	return $output;
	
} // end function fetch__data 






/**
 * add__featured_image --> Wrapper Function
 *
 * @version 1.0
 * @updated	05.05.13
 **/
function add__featured_image( $array = array() ) {
	
	$output = false;
	if ( ! class_exists( 'MultiPostThumbnailsVCWP' ) ) {
		require_once( 'MultiPostThumbnailsVCWP.php' );
	}
	
	if ( class_exists( 'MultiPostThumbnailsVCWP' ) ) {
		
		$add__featured_image = new MultiPostThumbnailsVCWP();
		$add__featured_image->add_thumbnail( $array );
		$output = $add__featured_image;
		
	}
	
	return $output;
	
} // end function add__featured_image 






/**
 * upload__image --> Wrapper Function
 *
 * @version 1.0
 * @updated	07.02.13
 **/
function upload__image( $image, $post_id = '' ) {
	
	$output = false;
	if ( ! class_exists( 'UploadImageVCWP' ) ) {
		require_once( 'UploadImageVCWP.php' );
	}
	
	if ( class_exists( 'UploadImageVCWP' ) ) {
		
		$upload_image = new UploadImageVCWP();
		$upload_image->upload_image( $image, $post_id );
		$output = $upload_image;
		
	}
	
	return $output;
	
} // end function upload__image 






/**
 * get__meta_tags --> Wrapper Function
 *
 * @version 1.0
 * @updated	08.03.13
 **/
function get__meta_tags( $post_id = false ) {
	
	$output = false;
	if ( ! class_exists( 'GeoMetaTagsVCWP' ) ) {
		require_once( 'GeoMetaTagsVCWP.php' );
	}
	
	if ( class_exists( 'GeoMetaTagsVCWP' ) ) {
		
		$meta_tags = new GeoMetaTagsVCWP();
		$output = $meta_tags->get_meta_tags( $post_id );
		
	}
	
	return $output;
	
} // end function get__meta_tags






/**
 * get__option --> Wrapper Function
 *
 * @version 1.0
 * @updated	01.20.14
 **/
function get__option( $option, $setting ) {
	
	$output = false;
	if ( ! class_exists( 'ThemeOptions' ) ) {
		require_once( 'ThemeOptions.php' );
	}
	
	if ( class_exists( 'ThemeOptions' ) ) {
		
		$ThemeOptions = new ThemeOptions();
		$output = $ThemeOptions->get_option( $option, $setting );
		
	}
	
	return $output;
	
} // end function get__option