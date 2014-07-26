<?php
/**
-- Depreciated --
**/
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






/**
 * Get post_id from meta_key => meta_value
 *
 * @version 0.1
 * @updated 07.30.12
 *
 **/
function vc_get_post_id_by_meta__key_value( $meta_key, $meta_value, $limit = 1 ) {
	global $wpdb;
	
	$querystr = "SELECT $wpdb->postmeta.post_id FROM $wpdb->postmeta WHERE $wpdb->postmeta.meta_key = '$meta_key' AND $wpdb->postmeta.meta_value = '$meta_value' LIMIT $limit";
	$results = $wpdb->get_results( $querystr );
	if ( isset( $results[0]->post_id ) AND is_numeric( $results[0]->post_id ) )
		return $results[0]->post_id;
	else
		return false;
	
} // end function vc_get_post_id_by_meta__key_value






/**
 * Page Sub Navigation
 *
 * @version 0.1
 * @updated 07.09.12
 *
 **/
function vc_get_term_image_url( $term_id, $option_name ) {
	
	if ( is_numeric( $term_id ) ) {
		
		$options = get_option( $option_name );
		
		if ( isset( $options[$term_id]['image']['url'] ) )
			return $options[$term_id]['image']['url'];
			
	}
	
} // end function vc_get_term_image_url






/**
 * Page Sub Navigation
 *
 * @version 0.1
 * @updated 07.09.12
 *
 **/
function vc_sub_navigation( $args = '' ) {
	global $wp_query;
	
	$defaults = array(
		'post_id' => $wp_query->post->ID,
		'menu_id' => 'menu-sub-nav',
		'container' => 'div', 
		'container_id' => 'page-sub-nav',
		);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	// Get selected menu and print navigation
	if ( $vc_menu_meta = get_post_meta( $post_id, '_secondary_menu', true ) ) {
		wp_nav_menu( array( 
			'fallback_cb' => null, 
			'menu_id' => $menu_id, 
			'container' => $container, 
			'container_id' => $container_id, 
			'menu' => $vc_menu_meta ) );
	}
		
} // end function vc_sub_navigation






/**
 * Get VC Option
 *
 * Alternate function for sanitizing option data.
 * Most options for parent-theme are stored in an array.
 * This means that they will not see the default wp-sanitization.
 *
 * @version 1.3
 * @updated 02.09.13
 **/
function get_vc_option( $id, $setting ) {
	global $wp_query, $vc_general_options;
	
	if ( !$vc_general_options ) {
		$vc_general_options = get_option( '_vc_general_options' );
	}
	
	if ( ! isset( $vc_general_options[$id][$setting] ) ) {
		return false;
	}
	
	switch ( $id ) {
		
		case "author_title" :
			return str_replace( '%author_name%', $wp_query->queried_object->display_name, vc_sanitize_option( $vc_general_options[$id][$setting] ) );
			break;
		case "category_title" :
			return str_replace( '%cat_name%', $wp_query->queried_object->name, vc_sanitize_option( $vc_general_options[$id][$setting] ) );
			break;
		case "tag_title" :
			return str_replace( '%tag_name%', $wp_query->queried_object->name, vc_sanitize_option( $vc_general_options[$id][$setting] ) );
		case "date_archive_title" :
			if ( is_day() )
				$archive_type = get_the_date();
			elseif ( is_month() )
				$archive_type = get_the_date('F Y');
			elseif ( is_year() )
				$archive_type = get_the_date('Y');
				
			return str_replace( '%date_archive_name%', $archive_type, vc_sanitize_option( $vc_general_options[$id][$setting] ) );
			break;
		case "contact" :
			return str_replace( '%year%', date('Y'), vc_sanitize_option( $vc_general_options[$id][$setting] ) );
		case "search" :
			global $s;
			return str_replace( '%search_term%', $s, vc_sanitize_option( $vc_general_options[$id][$setting] ) );
			break;
		default :
			return vc_sanitize_option( $vc_general_options[$id][$setting] );
			break;
			
	} // end switch ( $id )
	
} // end function vc_sanitize_option






/**
 * Sanitize Option data
 *
 * Alternate function for sanitizing option data.
 * Most options for parent-theme are stored in an array.
 * This means that they will not see the default wp-sanitization.
 *
 * @version 0.1
 * @since 3.5.4
 **/
function vc_sanitize_option( $option ) {
	
	return stripslashes( $option );
	
} // end function vc_sanitize_option






/**
 * Create actions for various places with in the site.
 **/
function vc_after_content() { do_action( 'vc_after_content' ); }
function vc_below_childloop() { do_action( 'vc_below_childloop' ); }
function vc_above_childloop() { do_action( 'vc_above_childloop' ); }






/**
 * Cut the excerpt length
 *
 * This function cuts the post_content by wordspace and then puts it back together.
 *
 * @version 0.2
 * @since 3.5.4
 * todo array_slice
 **/
function vclib_cut_excerpt( $text, $count ) {
	
	$words = explode( ' ', $text );
	return implode( ' ', array_slice( $words, 0, $count ) );

} // end function vclib_cut_excerpt






/** 
 * Cut a string and add a trailing text
 *
 * @version 0.1
 * @since 3.5.4
 **/
function vc_strlen( $content, $count, $trail = '...' ) {
	
	$trail_count = strlen( $trail );
	$content_cut = $count - $trail_count;
	
	if ( strlen( $content ) > $count ) {
		$content = substr( $content, 0, $content_cut ) . $trail;
	}
	
	return $content;
		
} // end function vc_strlen






/** 
 * Cut a string and add a trailing text
 *
 * @version 0.0.1
 * @updated 03.15.12
 **/
function vc_leading_zero( $num ) {
	
	if ( ( strlen( $num ) < 2 ) AND $num <= 9 AND $num >= 0 ) {
		return "0$num";
	} else {
		return $num;
	}
	
} // end function vc_leading_zero






/**
 * Has Children
 *
 * @version 0.0.1
 * @updated 3.5.4
 **/
function vc_has_children( $post_id, $post_type ) {
	global $wpdb;

	$querystr = "SELECT $wpdb->posts.ID FROM $wpdb->posts WHERE $wpdb->posts.post_type = '$post_type' AND $wpdb->posts.post_parent = '$post_id' LIMIT 1";

	$results = $wpdb->get_results( $querystr, ARRAY_N );

	if ( is_numeric( $results[0][0] ) AND $results[0][0] > 0 ) {
		return true;
	} else {
		return false;
	}

} // end function has_children






/**
 * Get Parent Post Id's
 *
 * @version 0.0.1
 * @updated 05.07.12
 **/
function get_parent_post_ids( $post_type ) {
	global $wpdb;

	$querystr = "SELECT $wpdb->posts.ID FROM $wpdb->posts WHERE $wpdb->posts.post_type = '$post_type' AND $wpdb->posts.post_parent < 1";
	$results = $wpdb->get_results( $querystr );

	if ( is_array( $results ) ) {
		foreach ( $results as $post_id ) {
			$post__in[] = $post_id->ID;
		}
	}

	if ( isset( $post__in ) AND is_array( $post__in ) AND ! empty( $post__in ) ) {
		return $post__in;
	} else {
		return false;
	}

} // end function get_parent_post_ids






/** 
 * is page for posts
 *
 * @version 1.1
 * @since 3.6.0
 * @updated 02.03.13
 **/
function is_page_for_posts__vc() {
	global $wp_query;
	
	if ( isset( $wp_query->queried_object ) AND ( isset( $wp_query->queried_object->ID ) AND $wp_query->queried_object->ID == get_option('page_for_posts') ) ) {
		$is_page_for_posts = true;
	} else {
		$is_page_for_posts = false;
	}
	
	return $is_page_for_posts;
	
} // end function is_page_for_posts__vc






/**
 * Odd Or Even
 *
 * @version 0.0.1
 * @since 3.5.4
 **/
function vc_OddOrEven( $int, $args = '' ) {
	
	$defaults = array(
		'even' => 'even',
		'odd' => 'odd',
		'echo' => 1,
		);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	if ( $int % 2 == 0 ) {
		$output = $even;
	} else {
		$output = $odd;
	}
	
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}

} // end function vc_OddOrEven