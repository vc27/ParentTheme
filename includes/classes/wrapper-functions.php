<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */






/**
 * PostTypeVCWP --> Wrapper Function
 *
 * @version 1.1
 * @updated	05.02.13
 **/
if ( ! function_exists( 'register__post_type' ) ) {
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
}






/**
 * register__postmeta --> Wrapper Function
 *
 * @version 1.2
 * @updated	05.07.13
 **/
if ( ! function_exists( 'register__postmeta' ) ) {
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
}






/**
 * sanitize__value --> Wrapper Function
 *
 * @version 1.0
 * @updated	05.08.13
 **/
if ( ! function_exists( 'sanitize__value' ) ) {
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
}






/**
 * form__field --> Wrapper Function
 *
 * @version 1.0
 * @updated	05.15.13
 **/
if ( ! function_exists( 'form__field' ) ) {
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
}






/**
 * featured__image --> Wrapper Function
 *
 * @version 1.2
 * @updated	06.28.14
 **/
if ( ! function_exists( 'featured__image' ) ) {
function featured__image( $post, $args = array() ) {
	
	$output = false;
	if ( ! class_exists( 'FeaturedImageVCWP' ) ) {
		require_once( 'FeaturedImageVCWP.php' );
	}
	
	if ( class_exists( 'FeaturedImageVCWP' ) ) {
		
		$FeaturedImageVCWP = new FeaturedImageVCWP();
		if ( isset( $args['get_src'] ) ) {
			$output = $FeaturedImageVCWP->image_src( $post, $args );
		} else {
			$output = $FeaturedImageVCWP->image( $post, $args );
		}
		
	}
	
	return $output;
	
} // end function featured__image 
}






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
if ( ! function_exists( 'create__options_page' ) ) {
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
}






/**
 * create__posts --> Wrapper Function
 *
 * @version 2.0
 * @updated	04.21.14
 **/
if ( ! function_exists( 'create__posts' ) ) {
function create__posts( $posts, $args ) {

	$create_posts = false;
	if ( ! class_exists( 'CreatePostsVCWP' ) ) {
		require_once( "CreatePosts/CreatePostsVCWP.php" );
	}

	if ( class_exists( 'CreatePostsVCWP' ) ) {

		$create_posts = new CreatePostsVCWP();
		$create_posts->add_posts( $posts, $args );

	}

	return $create_posts;

} // end function create__posts
}






/**
 * fetch__data --> Wrapper Function
 *
 * @version 1.0
 * @updated	05.31.13
 **/
if ( ! function_exists( 'fetch__data' ) ) {
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
}






/**
 * upload__image --> Wrapper Function
 *
 * @version 1.0
 * @updated	07.02.13
 **/
if ( ! function_exists( 'upload__image' ) ) {
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
}






/**
 * get__meta_tags --> Wrapper Function
 *
 * @version 1.0
 * @updated	08.03.13
 **/
if ( ! function_exists( 'get__meta_tags' ) ) {
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
}






/**
 * get__option --> Wrapper Function
 *
 * @since 3.9.0
 **/
if ( ! function_exists( 'get__option' ) ) {
function get__option( $option, $setting = 'option', $system = 'acf-theme-options' ) {
	
	$output = false;
	if ( $system == 'acf-theme-options' AND current_theme_supports('acf-theme-options') AND function_exists('get_field') ) {
		$output = get_field( $option, $setting );
	} else if ( $system == 'parent-theme-options' AND current_theme_supports('parent-theme-options') ) {
		if ( ! class_exists( 'ThemeOptions' ) ) {
			require_once( 'ThemeOptions.php' );
		}
		if ( class_exists( 'ThemeOptions' ) ) {
			$ThemeOptions = new ThemeOptions();
			$output = $ThemeOptions->get_option( $option, $setting );
		}
	}
	return $output;
	
} // end function get__option
}






/**
 * featured_image__form_select --> Wrapper Function
 *
 * @since 6.9.0
 **/
if ( ! function_exists( 'featured_image__form_select' ) ) {
function featured_image__form_select( $args = array() ) {
	
	$output = false;
	if ( ! class_exists( 'FeaturedImageFormSelectVCWP' ) ) {
		require_once( 'FeaturedImageFormSelectVCWP.php' );
	}
	
	if ( class_exists( 'FeaturedImageFormSelectVCWP' ) ) {
		
		$output = new FeaturedImageFormSelectVCWP( $args );
		
	}
	
	return $output;
	
} // end function featured_image__form_select
}






/**
 * get__widget_area --> Wrapper Function
 *
 * @since 6.9.0
 **/
if ( ! function_exists( 'get__widget_area' ) ) {
function get__widget_area( $name, $args = array() ) {
	
	$output = false;
	if ( ! class_exists( 'WidgetAreaVCWP' ) ) {
		require_once( 'WidgetAreaVCWP.php' );
	}
	
	if ( class_exists( 'WidgetAreaVCWP' ) ) {
		WidgetAreaVCWP::get_widget_area( $name, $args );
	}
	
} // end function get__option
}






/**
 * featured_image__form_select --> Wrapper Function
 *
 * @since 6.9.1
 **/
if ( ! function_exists( 'comments__callback' ) ) {
function comments__callback( $comment, $args, $depth ) {
	
	if ( ! class_exists( 'CommentsCallbackVCWP' ) ) {
		require_once( 'CommentsCallbackVCWP.php' );
	}
	
	if ( class_exists( 'CommentsCallbackVCWP' ) ) {
		
		new CommentsCallbackVCWP( $comment, $args, $depth );
		
	}
	
} // end function comments__callback
}






/**
 * previous_next___post_link --> Wrapper Function
 *
 * @since 6.9.0
 **/
if ( ! function_exists( 'previous_next___post_link' ) ) {
function previous_next___post_link( $args = array() ) {
	
	$output = false;
	if ( ! class_exists( 'NavigationVCWP' ) ) {		
		require_once( 'NavigationVCWP.php' );			
	}
	
	if ( class_exists( 'NavigationVCWP' ) ) {		
		$NavigationVCWP = new NavigationVCWP();
		$output = $NavigationVCWP->previous_next___post_link( $args );
	}
	
	return $output;
	
} // end function previous_next___post_link
}






/**
 * previous_next___posts_link --> Wrapper Function
 *
 * @since 6.9.0
 **/
if ( ! function_exists( 'previous_next___posts_link' ) ) {
function previous_next___posts_link( $args = array() ) {
	
	$output = false;
	if ( ! class_exists( 'NavigationVCWP' ) ) {		
		require_once( 'NavigationVCWP.php' );			
	}
	
	if ( class_exists( 'NavigationVCWP' ) ) {		
		$NavigationVCWP = new NavigationVCWP();
		$NavigationVCWP->previous_next___posts_link( $args );
		$output = true;
	}
	
	return $output;
	
} // end function previous_next___posts_link
}






/**
 * archive__title --> Wrapper Function
 *
 * @since 6.9.0
 **/
if ( ! function_exists( 'archive__title' ) ) {
function archive__title( $args = array() ) {
	
	$output = false;
	if ( ! class_exists( 'ArchiveTitlesVCWP' ) ) {		
		require_once( 'ArchiveTitlesVCWP.php' );			
	}
	
	if ( class_exists( 'ArchiveTitlesVCWP' ) ) {		
		$ArchiveTitlesVCWP = new ArchiveTitlesVCWP();
		$output = $ArchiveTitlesVCWP->get_title( $args );
	}
	
	return $output;
	
} // end function archive__title
}