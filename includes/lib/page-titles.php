<?php
/**
 * File Name page-titles.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.8
 * @updated 07.16.13
 **/
#################################################################################################### */






/**
 * Page Title Category
 *
 * @version 0.0.2
 * @update 01.31.12
 * @since 3.5.4
 **/
function vc_page_title( $args = '' ) {
	
	if ( is_category() AND get_vc_option( 'category_title', 'cat_show' ) ) {
		vc_page_title_category();
	} else if ( is_tag() AND get_vc_option( 'tag_title', 'tag_show' ) ) {
		vc_page_title_tag();
	} else if ( is_author() AND get_vc_option( 'author_title', 'author_show' ) ) {
		vc_page_title_author();
	} else if ( ( is_day() OR is_month() OR is_year() ) AND get_vc_option( 'date_archive_title', 'date_archive_show' ) ) {
		vc_page_title_date();
	} else {
		return false;
	}
		
	
} // end function vc_page_title_category






/**
 * Page Title Category
 *
 * WP_DEBUG: Notice: Undefined index: before_cat_show, cat_rss, cat_desc, after_cat_show
 *
 * @version 1.6
 * @updated 07.16.13
 **/
function vc_page_title_category( $args = '' ) {
	global $wp_query;
	
	// Set Defaults
	$defaults = array(
		'class' => '',
		'echo' => 1,
		);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	

	$output = "<div class=\"page-title-wrapper page-title-wrapper-category " . apply_filters( 'page_title_class', $class ) . "\">";
		
		// Before Category Text
		if ( get_vc_option( 'category_title', 'before_cat_show' ) ) {

			// check for wpautop
			if ( get_vc_option( 'category_title', 'wpautop_before_cat' ) ) {
				$before_cat_text = wpautop( get_vc_option( 'category_title', 'before_cat_text' ) );
			} else {
				$before_cat_text = get_vc_option( 'category_title', 'before_cat_text' );
			}
			
			
			$output .= "<div class=\"before-category-text\">$before_cat_text</div>";
			
		}
		
		$output .= "<h1 class=\"title\">" . apply_filters( 'vc_page_title_category', get_vc_option( 'category_title', 'cat_title' ) ) . "</h1>";
		
		
		// Add RSS link
		if ( get_vc_option( 'category_title', 'cat_rss' ) ) {
			$output .= "<a class=\"rss-link-category\" href=\"" . get_category_link( $wp_query->queried_object->cat_ID ) . "feed\" title=\"" . esc_html( strip_tags( $wp_query->queried_object->name ) ) . "\">" . __( 'RSS', 'parenttheme' ) . "</a>";
		}
		
		
		// Add Description
		if ( get_vc_option( 'category_title', 'cat_desc' ) AND category_description( $wp_query->queried_object->cat_ID ) ) {
			
			$output .= "<div class=\"entry entry-category\">";
				$output .= wpautop( category_description( $wp_query->queried_object->cat_ID ) );
			$output .= '</div>';
			
		}
		
		
		// After Category Text
		if ( get_vc_option( 'category_title', 'after_cat_show' ) ) {
			
			// check for wpautop
			if ( get_vc_option( 'category_title', 'wpautop_after_cat' ) ) {
				$after_cat_text = wpautop( get_vc_option( 'category_title', 'after_cat_text' ) );
			} else {
				$after_cat_text = get_vc_option( 'category_title', 'after_cat_text' );
			}

			
			$output .= "<div class=\"after-category-text\">$after_cat_text</div>";
			
		}
		
		
		$output .= '<div class="clear"></div>';
	$output .= '</div>';
	
	
	$output = apply_filters( 'vc_category_header', $output );

	
	// Echo or Return
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}
	
	
} // end function vc_page_title_category






/**
 * Page Title Tag
 *
 * WP_DEBUG: Notice: Undefined index: before_tag_show, tag_desc, after_tag_show
 *
 * @version 0.0.4
 * @update 01.31.12
 * @since 3.5.4
 **/
function vc_page_title_tag( $args = array() ) {
	global $wp_query;

	$defaults = array(
		'class' => '',
		'echo' => 1,
		);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	$output = "<div class=\"page-title-wrapper page-title-wrapper-tag " . apply_filters( 'page_title_class', $class ) . "\">";
		
		// Before Tag Text
		if ( get_vc_option( 'tag_title', 'before_tag_show' ) ) {
			
			// check of wpautop
			if ( get_vc_option( 'tag_title', 'wpautop_before_tag' ) ) {
				$before_tag_text = wpautop( get_vc_option( 'tag_title', 'before_tag_text' ) );
			} else {
				$before_tag_text = get_vc_option( 'tag_title', 'before_tag_text' );
			}
			
			
			$output .= "<div class=\"before-tag-text\">$before_tag_text</div>";
			
		}
		
		
		// Title
		$output .=  "<h1 class=\"title\">" . get_vc_option( 'tag_title', 'tag_title' ) . "</h1>";
		
		
		// Description
		if ( get_vc_option( 'tag_title', 'tag_desc' ) AND tag_description() ) {
			$output .= "<div class=\"entry entry-tag\">";
				$output .= wpautop( $wp_query->queried_object->description );
			$output .= '</div>';
		}
		
		
		// After Tag Text
		if ( get_vc_option( 'tag_title', 'after_tag_text' ) ) {
			
			// check of wpautop
			if ( get_vc_option( 'tag_title', 'wpautop_after_tag' ) ) {
				$after_tag_text = wpautop( get_vc_option( 'tag_title', 'after_tag_text' ) );
			} else {
				$after_tag_text = get_vc_option( 'tag_title', 'after_tag_text' );
			}
			
			$output .= "<div class=\"after-tag-text\">$after_tag_text</div>";
			
		}
		
		$output .= '<div class="clear"></div>';
	$output .= '</div>';
	
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}
	
} // end function vc_page_title_tag






/**
 * Page Title Author
 *
 * WP_DEBUG: Notice: Undefined index: before_author_show, author_avatar, after_author_show
 *
 * @version 0.0.4
 * @update 01.31.12
 * @since 3.5.4
 **/
function vc_page_title_author( $args = array() ) {
	global $wp_query;

	$defaults = array(
		'class'	=> '',
		'echo' => 1,
		);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	$output = "<div class=\"page-title-wrapper page-title-wrapper-author " . apply_filters( 'page_title_class', $class ) . "\">";
		
		// Before Author Text
		if ( get_vc_option( 'author_title', 'before_author_show' ) ) {
			
			// check of wpautop
			if ( get_vc_option( 'author_title', 'wpautop_before_author' ) ) {
				$before_author_text = wpautop( get_vc_option( 'author_title', 'before_author_text' ) );
			} else {
				$before_author_text = get_vc_option( 'author_title', 'before_author_text' );
			}
			
			$output .= "<div class=\"before-author-text\">$before_author_text</div>";
			
		}
		
		
		// Title
		$output .= '<h1 class="title">' . get_vc_option( 'author_title', 'author_title' ) . '</h1>';
		
			
		// Show Avatar
		if ( get_vc_option( 'author_title', 'author_avatar' ) ) {
			$output .= vc_avatar( array( 'echo' => 0 ) );
		}
		
		
		// Show the Author Bio
		if ( $wp_query->queried_object->description AND get_vc_option( 'author_title', 'author_bio' ) ) { 
			$output .= "<div class=\"entry entry-author\">";
				$output .= wpautop( $wp_query->queried_object->description );
			$output .= '</div>';
		}
		
		
		// After Author Text
		if ( get_vc_option( 'author_title', 'after_author_show' ) ) {
			
			// check of wpautop
			if ( get_vc_option( 'author_title', 'wpautop_after_author' ) ) {
				$after_author_text = wpautop( get_vc_option( 'author_title', 'after_author_text' ) );
			} else {
				$after_author_text = get_vc_option( 'author_title', 'after_author_text' );
			}
			
			
			$output .= "<div class=\"after-author-text\">$after_author_text</div>";
		
		}

		$output .= '<div class="clear"></div>';
	$output .= '</div>';
	
	
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}
	
} // end function vc_page_title_author






/**
 * Page Title Date
 *
 * @version 0.0.3
 * @update 01.31.12
 * @since 3.5.4
 **/
function vc_page_title_date( $args = array() ) {
	global $wp_query;
	
	$defaults = array(
		'class'	=> '',
		'echo' => 1,
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	
	if ( is_day() OR is_month() OR is_year() ) {
		
		$output = "<div class=\"page-title-wrapper page-title-wrapper-archive " . apply_filters( 'page_title_class', $class ) . "\">";
			
			// Before Archive Text
			if ( get_vc_option( 'date_archive_title', 'before_archive_show' ) ) {

				// check of wpautop
				if ( get_vc_option( 'date_archive_title', 'wpautop_before_archive' ) ) {
					$before_archive_text = wpautop( get_vc_option( 'date_archive_title', 'before_archive_text' ) );
				} else {
					$before_archive_text = get_vc_option( 'date_archive_title', 'before_archive_text' );
				}

				$output .= "<div class=\"before-archive-text\">$before_archive_text</div>";
				
			}
			
			
			// Title
			$output .= "<h1 class=\"title\">" . get_vc_option( 'date_archive_title', 'date_archive_title' ) . "</h1>";
			
			
			// After Archive Text
			if ( get_vc_option( 'date_archive_title', 'after_archive_show' ) ) {
				
				// check of wpautop
				if ( get_vc_option( 'date_archive_title', 'wpautop_after_archive' ) ) {
					$after_archive_text = wpautop( get_vc_option( 'date_archive_title', 'after_archive_text' ) );
				} else {
					$after_archive_text = get_vc_option( 'date_archive_title', 'after_archive_text' );
				}

				$output .= "<div class=\"after-archive-text\">$after_archive_text</div>";
				
			}
			
			$output .= '<div class="clear"></div>';
		$output .= '</div>';
		
	} // end if ( !empty( $archive_type ) )
	
	
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}
	
} // end function vc_page_title_date