<?php
/**
 * File Name theme-support.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.1
 * @updated 07.16.13
 **/
#################################################################################################### */






/**
 * featured_image__form_select
 *
 * @version 1.1
 * @updated	07.16.13
 **/
function featured_image__form_select( $args = array() ) {
	
	$defaults = array(
		'val' => '',
		'id' => '',
		'name' => '',
		'attr' => false,
		);
	
	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	$featured_images = new WP_Query();
	$featured_images->query( array(
		'posts_per_page' => -1,
		'post_type' => 'featured-image',
		) );
	
	if ( $featured_images->have_posts() ) {
		
		echo "<select id=\"$id\" name=\"$name\" $attr>";
			echo "<option value=\"\">" . __( 'Select an Image Size', 'parenttheme' ) . "</option>";
			while ( $featured_images->have_posts() ) {
				$featured_images->the_post();

				if ( $val == $featured_images->post->post_name )
					$sel = 'selected="selected"';
				else
					$sel = '';
				
				$width_height = false;
				$width = get_post_meta( $featured_images->post->ID, '_featured_image_width', true );
				$height = get_post_meta( $featured_images->post->ID, '_featured_image_height', true );
				
				if ( $width AND $height ) {
					$width_height = " $width x $height";
				} else if ( $width AND ! $height ) {
					$width_height = " Width $width";
				} else if ( ! $width AND $height ) {
					$width_height = " Height $height";
				}
				
				echo "<option $sel value=\"" . $featured_images->post->post_name . "\">" . $featured_images->post->post_title . $width_height . "</option>";
			}
			
		echo "</select>";
		
		wp_reset_postdata();
	} else {
		echo __( "There are no featured image sizes available.", 'parenttheme' ) . " <a href=\"" . home_url() . "/wp-admin/edit.php?post_type=featured-image\">" . __( 'Manage Featured Images', 'parenttheme' ) . "</a>";
	}
	
} // end function featured_image__form_select






/**
 * Is MS IE
 *
 * @version 0.1
 * @updated	08.16.12
 **/
function is_msie() {
	global $is_msie;
	
	return $is_msie;
	
} // end function is_msie






/**
 * Is Mobile
 *
 * @version 0.1
 * @updated	08.16.12
 **/
function is_mobile() {
	global $is_mobile;
	
	return $is_mobile;
	
} // end function is_mobile






/**
 * Is Mobile
 *
 * @version 0.1
 * @updated	08.16.12
 **/
function is_ipad() {
	global $is_ipad;
	
	return $is_ipad;
	
} // end function is_ipad






/**
 * Is User
 *
 * @version 2.0
 * @updated 06.09.14
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
	
	if ( ( is_year() OR is_month() OR is_day() ) AND get_vc_option( 'post_display', 'numeric_archive_content' ) ) {
		return true;
		
	} else if ( is_category() AND get_vc_option( 'post_display', 'category_content' ) ) {
		return true;
	
	} else if ( is_page_for_posts__vc() AND get_vc_option( 'post_display', 'home_page_posts' ) ) {
		return true;
		
	} else if ( $wp_query->is_posts_page AND get_vc_option( 'post_display', 'home_page_posts' ) ) {
		return true;
	
	} else if ( $wp_query->is_home AND $show_on_front == 'posts' AND get_vc_option( 'post_display', 'home_page_posts' ) ) {
		return true;
	
	} else if ( is_tag() AND get_vc_option( 'post_display', 'tag_content' ) ) {
		return true;
	
	} else if ( is_author() AND get_vc_option( 'post_display', 'author_content' ) ) {
		return true;
	
	} else if ( is_search() AND get_vc_option( 'post_display', 'search_content' ) ) {
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
	
	if ( vc_is_excerpt() AND get_vc_option( 'post_display', 'show_featured_image' ) ) {
		return true;
	} else {
		return false;
	}
	
} // end function vc_show_featured_image






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