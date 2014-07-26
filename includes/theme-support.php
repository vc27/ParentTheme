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






/** 
 * Show Excerpt based on Theme Option
 *
 * WP_DEBUG: Notice: Undefined index: 11-19-11
 * All the excerpt variable have been deemed undefined index.
 * Consider a function that checks for this. Perhaps there is a wp-function.
 *
 * @version 0.0.3
 * @since 3.5.4
 **/
function vc_is_excerpt() {
	global $wp_query;
	
	if ( is_home() ) {
		$show_on_front = get_option('show_on_front');
	}
	
	if ( ( is_year() OR is_month() OR is_day() ) AND get__option( 'post_display', 'numeric_archive_content' ) ) {
		return true;
		
	} else if ( is_category() AND get__option( 'post_display', 'category_content' ) ) {
		return true;
	
	} else if ( is_page_for_posts__vc() AND get__option( 'post_display', 'home_page_posts' ) ) {
		return true;
		
	} else if ( $wp_query->is_posts_page AND get__option( 'post_display', 'home_page_posts' ) ) {
		return true;
	
	} else if ( $wp_query->is_home AND $show_on_front == 'posts' AND get__option( 'post_display', 'home_page_posts' ) ) {
		return true;
	
	} else if ( is_tag() AND get__option( 'post_display', 'tag_content' ) ) {
		return true;
	
	} else if ( is_author() AND get__option( 'post_display', 'author_content' ) ) {
		return true;
	
	} else if ( is_search() AND get__option( 'post_display', 'search_content' ) ) {
		return true;
	
	} else {
		return false;
	}
	
} // end function vc_is_excerpt






/** 
 * Show Featured Image based on Theme option
 *
 * @version 1.3
 * @updated 05.30.13
 **/
function vc_show_featured_image() {
	
	if ( vc_is_excerpt() AND get__option( 'post_display', 'show_featured_image' ) ) {
		return true;
	} else {
		return false;
	}
	
} // end function vc_show_featured_image






/** 
 * Display a link to the media popup window.
 *
 * @version 1.4
 * @updated 07.16.13
 **/
function vc_media_link( $args = '' ) {
	
	isset( $_GET['post'] ) ? $post_id = $_GET['post'] : $post_id = null;
	
	$defaults = array(
		'before_media' => ' ',
		'after_media' => ' ',
		'class' => '',
		'note' => __( 'Media Gallery &amp; Image Upload', 'parenttheme' ),
		'post_id' => $post_id,
		'echo' => 1,
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	$output = $before_media;
	
		$output .= "<a class=\"vc_medialink\" href=\"" . home_url() . "/wp-admin/media-upload.php?post_id=$post_id\" target=\"popupwindow\" onclick=\"window.open('" . home_url() . "/wp-admin/media-upload.php', 'popupwindow', 'scrollbars=yes,width=640,height=500');\" title=\"" . __( 'Image Upload', 'parenttheme' ) . "\">";
			$output .= "<small><em>$note</em></small>";
		$output .= "</a>";
	
	$output .= $after_media;
	
	
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}
	
} // end function vc_media_link