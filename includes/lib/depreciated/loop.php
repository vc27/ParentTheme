<?php
/**
-- Depreciated --
**/
/**
 * File Name functions.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.8
 * @updated 07.16.13
 *
 * ToDo:
 * Create a new version of this file using post_{name}
 * Update all code to new streamlined methods of coding, if possible
 * strip function that can be filtered instead.
 * 
 * Description:	
 * Loop items such as title, category, date. The purpose is to stream line html and provide consistent
 * loop functionality within and without the standard loop.
 **/
#################################################################################################### */

		


/**
 * VC Avatar
 * 
 * This function is a addition to get_avatar()
 * Adds options link, class, before, after, img_path, echo
 * 
 * @version 1.2
 * @updated 07.16.12
 **/
function vc_avatar( $args = '' ) {
	global $authordata;
	
	// Set Defaults
	$defaults = array(
		'author_id' => $authordata->ID,
		'user_email' => $authordata->user_email,
		'display_name' => $authordata->display_name,
		'size' => 48,
		'link' => get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		'class' => '',
		'element' => 'div',
		'before' => '',
		'after' => '',
		'echo' => 1,
		);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	
	// Set Image
	$image = get_avatar( $user_email, $size );
	
	// Backwards compatible
	if ( ( isset( $link ) AND ! empty( $link ) ) AND ( isset( $permalink ) AND ! $permalink ) ) {
		$permalink = $link;
	}
	
	// Set Link
	if ( isset( $permalink ) AND !empty( $permalink ) ) {
		$a_ = "<a href=\"$permalink\" title=\"" . esc_attr__( strip_tags( "See All Posts by $display_name" ), 'parenttheme' ) . "\">";
		$_a = '</a>';
	} else {
		$a_ = false;
		$_a = false;
	}
	
	
	// Build Output
	$output = "<$element class=\"avatar $class\">" . $before . $a_ . $image . $_a . $after . "</$element>";
	
	
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}
	    
} // end function vc_avatar






/**
 * VC Excerpt
 * 
 * This function is a addition to the_excerpt() and get_the_excerpt()
 * Add a slew of options and is not dependant on the wp_query
 * This function can be fed any text and will return an excerpt based on the params.
 *
 * @version 1.3
 * @updated 07.05.13
 **/
function vc_excerpt( $object, $args = '', $show_item = '' ) { 
	
	if ( $show_item === false ) {
		return false;
	}
	
	// Set Defaults
	$defaults = array(
		'text' => $object->post_content,
		'shortcodes' => true,
		'strip_tags' => '',
		'read_more' => __( 'Read More', 'parenttheme' ),
		'push_read_more' => false,
		'kill_read_more' => false,
		'read_more_class' => '',
		'read_more_dots' => '[...]',
		'permalink' => get_permalink( $object->ID ),
		'title' => $object->post_title,
		'class' => '',
		'count' => 55,
		'element' => 'div',
		'before' => '',
		'after' => '',
		'echo' => 1,
		);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	
	// Clean Text
	if ( isset( $strip_tags ) AND ! empty( $strip_tags ) ) {
		$text = strip_tags( $text, $strip_tags );
	}
	
	// if there is a trailing [/caption] get rid of it.
	if ( isset( $shortcodes ) AND ! empty( $shortcodes ) ) {
		$text = strip_shortcodes( $text );
		$text = str_replace( '[/caption]', '', $text );
	}
	
	
	// Set Read More Link
	if ( isset( $kill_read_more ) AND ! empty( $kill_read_more ) ) {
		$read_more = false;
	} else {
		$read_more = " <span class=\"read_more-dots\">$read_more_dots</span> <a title=\"" . esc_html( strip_tags( $title ) ) . "\" class=\"read_more $read_more_class\" rel=\"nofollow\" href=\"$permalink\">$read_more</a>";
	}
		

	// Count Words and Cut Text
	if ( $count >= 2 ) {
		$word_count = count( explode( ' ', $text ) );
	}
	
	
	// If there is a Post Excerpt? use it, and do not cut it.
	if ( isset( $object->post_excerpt ) AND !empty( $object->post_excerpt ) ) {
		
		$text = $object->post_excerpt;
		
		if ( $count >= 5 ) {
			$word_count = count( explode( ' ', $text ) );
		}
		
		if ( $count >= 5 AND $word_count > $count ) {
			$vc_excerpt = vclib_cut_excerpt( $text, $count ) . $read_more;
		} else {
			$vc_excerpt = $text . $read_more;
		}
	
	
	// Build an except if the word count is higher than the text limit, may varie + - 1 word. 
	} elseif ( $count >= 5 AND $word_count > $count ) {
		
		$vc_excerpt = vclib_cut_excerpt( $text, $count ) . $read_more;
		
		
	// Else just print out the text
	} else {
		
		if ( $push_read_more ) {
			$vc_excerpt = $text . $read_more;
		} else {
			$vc_excerpt = $text;
		}
		
	}
	
	
	// Do Standard filters for excerpt text
	$vc_excerpt = wptexturize( $vc_excerpt );
	$vc_excerpt = convert_smilies( $vc_excerpt );
	$vc_excerpt = convert_chars( $vc_excerpt );
	$vc_excerpt = wpautop( $vc_excerpt );
	
	// If shortcodes do it!
	if ( $shortcodes ) {
		$vc_excerpt = do_shortcode( $vc_excerpt );
	}
		
	$vc_excerpt = shortcode_unautop( $vc_excerpt );
	
	
	// Build Output
	$output = "<$element class=\"entry excerpt $class\">" . $before . $vc_excerpt . $after . "<div class=\"clear\"></div></$element>";
	
	
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}
		
		
		
} // end function vc_excerpt






/**
 * VC Content
 * 
 * This function is an addition to the_content()
 * Adds a few options but more or less just wraps the_content in a div
 * This function will also account for attachment display.
 *
 * @version 0.0.2
 * @updated 03.14.12
 **/
function vc_content( $args = '' ) {
	global $wp_query;
	
	// Set Defaults
	$defaults = array(
		'more_link_text' => null,
		'stripteaser' => 0,
		'content' => false,
		'class' => '',
		'element' => 'div',
		'before' => '',
		'after' => '',
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	
	// Default Content
	if ( empty( $content ) OR is_attachment() ) {
		
		echo "<$element class=\"entry $class\">";
			
			echo $before;
			
			the_content( $more_link_text, $stripteaser );
			
			echo $after;
			echo "<div class=\"clear\"></div>";
			
		echo "</$element>";
	
	
	// Spcifically Provided content
	} else if ( isset( $content ) AND ! empty( $content ) ) {
		
		echo "<$element class=\"entry $class\">";
			
			echo $before;
			
			echo apply_filters( 'the_content', $content );
			
			echo $after;
			echo "<div class=\"clear\"></div>";
		echo "</$element>";
	
	} else {
		
		return false;
	
	}
	
} // end function vc_content






/**
 * VC Title
 * 
 * This function is an addition to the_title()
 * Adds a number of options, and make itself available for use outside a loop.
 * This function will also account loop titles that should be linked and single items that should not be linked.
 * This function will also account for attachment titles
 *
 * @version 1.7
 * @updated 08.05.13
 * 
 * Notes:
 * Consider using the_title_attribute or finding how it works and applying it.
 **/
function vc_title( $object, $args = '' ) {
	
	
	// Set element based on page or single.
	if ( is_single() OR is_page() ) {
		$this_element = 'h1';
	} else if ( ( is_archive() AND in_the_loop() ) OR ( is_home() AND in_the_loop() ) ) {
		$this_element = 'h3';
	} else {
		$this_element = 'div';
	}
	
	
	// Set Defaults
	$defaults = array(
		'post_id' => $object->ID,
		'post_title' => $object->post_title,
		'post_excerpt' => $object->post_excerpt,
		'title_image' => '',
		'class' => 'title',
		'element' => $this_element,
		'alt_link' => '',
		'before' => '',
		'after' => '',
		'a_' => null,
		'_a' => null,
		'target' => '_parent',
		'echo' => 1,
		);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	
	// Set the title according to attachment
	if ( is_attachment() AND !empty( $post_excerpt ) ) {
		$title = $post_excerpt;
	} else {
		$title = $post_title;
	}
	
	
	if ( ( isset( $permalink ) AND $permalink == false ) OR ( isset( $permalink ) AND ! $permalink AND ( is_single() OR is_page() ) ) ) {
		$permalink = false;
	} else {
		$permalink = true;
	}
	
	
	// Check to see if we should link the_title
	if ( $permalink ) {
		
		// Set $link
		empty( $alt_link ) ? $link = get_permalink( $post_id ) : $link = $alt_link;
		
		$a_ = "<a href=\"$link\" title=\"" . esc_attr( strip_tags( $post_title ) ) . "\" rel=\"bookmark\" target=\"$target\">"; // the_title_attribute
		$_a = "</a>";
	
	}
	
	$output = "<$element class=\"$class\">" . $before . $a_ . apply_filters( 'the_title', $title ) . $_a . $after . "</$element>";
	
		
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}   
		
} // end function vc_title






/** 
 * VC Comments
 * 
 * This function is an addition to the_comments()
 * Adds a few basic options
 * This function makes comment text w/ formatting available in return format for easy global use.
 *
 * @version 0.0.2
 * @since 3.5.3
 * @updated 05.14.12
 **/
function vc_comments( $object, $args = '' ) {
	
	if ( get__option( 'comments', 'remove_comments' ) OR ( $object->post_type == 'attachment' AND $object->post_mime_type == 'application/pdf' ) ) {
		return false;
	}
	
	
	$number = get_comments_number( $object->ID );
	
	// Set Defaults
	$defaults = array(
		'link' => get_comments_link( $object->ID ),
		'no_comments' => __( 'Comment', 'parenttheme' ),
		'one_comment' => __( '1&nbsp;Comment', 'parenttheme' ),
		'comments' => __( '%&nbsp;Comments', 'parenttheme' ),
		'before' => '',
		'after' => '',
		'element' => 'span',
		'class' => '',
		'zero' => false,
		'one' => false,
		'more' => false,
		'echo' => 1,
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	
	// Set Comment Link
	$no_comments = "<a href=\"$link\">$no_comments</a>";
	$one_comment = "<a href=\"$link\">$one_comment</a>";
	$comments = "<a href=\"$link\">$comments</a>";
	
	
	// Set comment Number or text
	if ( $number > 1 ) {
		$comments_number = str_replace( '%', number_format_i18n( $number ), ( false === $more ) ? $comments : $more );
	} else if ( $number == 0 ) {
		$comments_number = ( false === $zero ) ? $no_comments : $zero;		
	} else {
		$comments_number = ( false === $one ) ? $one_comment : $one;
	}
	
	// apply comment_number filter
	$comments_number = apply_filters('comments_number', $comments_number, $number);
	
	
	// if comments are open
	if ( 'open' == $object->comment_status ) {
		$output = "<$element class=\"post-comments $class\">" . $before . $comments_number . $after . "</$element>";
	} else {
		$output = false;
	}
	
	
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}
		
		
		
} // end function vc_comments






/**
 * VC Category
 * 
 * This function is an addition to the_category()
 * Adds a few basic options
 * This function makes comment text w/ formatting available in return format for easy global use.
 *
 * @version 0.1
 * @since 3.5.3
 **/
function vc_category( $args = '' ) {
	global $wp_query;
	
	// Set Defaults
	$defaults = array(
		'before' => '',
		'after' => '',
		'element' => 'div',
		'class' => '',
		'show_item' => false,
		'separator' => ', ',
		'echo' => 1,
	);
	
	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	
	// Build Output
	if ( !is_page() OR $show_item ) {
		$output = "<$element class=\"post-category $class\">" . $before . get_the_category_list( $separator, '', $wp_query->post->ID ) . $after . "</$element>";
	} else {
		return false;
	}
	
	
	
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}   
		
} // end function vc_category






/** 
 * VC Time
 * 
 * This function is an addition to the_time()
 * Adds a few basic options
 * This function makes comment text w/ formatting available in return format for easy global use.
 *
 * @version 0.1
 * @since 3.5.3
 **/
function vc_time( $args = '' ) {
	global $wp_query;
	
	// Set Defaults
	$defaults = array(
		'before' => __( '@', 'parenttheme' ),
		'after' => ' ',
		'element' => 'span',
		'class' => '',
		'show_item' => false,
		'time' => get_option('time_format'),
		'echo' => 1
	);
	
	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	
	// Build Output
	if ( !is_page() OR $show_item ) {
		$output = "<$element class=\"post-time $class\">" . $before . get_the_time( $time, $wp_query->post->ID ) . $after . "</$element>";
	}	
	
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}

} // end function vc_time






/**
 * VC Date
 *
 * This function is an addition to the_date()
 * Adds a few basic options
 * This function makes comment text w/ formatting available in return format for easy global use.
 *
 * @version 0.2
 * @since 3.5.3
 **/
function vc_date( $args = '' ) {
	global $wp_query;

	// Set Defaults
	$defaults = array(
		'before' => '',
		'after' => '',
		'element' => 'span',
		'class' => '',
		'show_item' => false,
		'date' => get_option('date_format'),
		'link' => false,
		'a_' => null,
		'_a' => null,
		'echo' => 1,
		);
	
	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	if ( !is_page() OR $show_item ) {
		
		// Create Link
		if ( $link ) {
			$a_ = "<a href=\"" . get_permalink() . "\" title=\"" . get_the_title() . "\">";
			$_a = "</a>";
		} else {
			$a_ = false;
			$_a = false;
		}
		
		// Build output
		$output = "<$element class=\"post-date $class\">" . $a_ . $before . get_the_time( $date, $wp_query->post->ID ) . $after . $_a . "</$element>";
		
	} else {
		
		return false;
		
	} // end if ( !is_page() OR $show_item )
	
	
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}
		
} // end function vc_date






/** 
 * VC Tags
 * 
 * This function is an addition to the_date()
 * Adds a few basic options
 * This function makes comment text w/ formatting available in return format for easy global use.
 *
 * @version 0.1
 * @since 3.5.3
 **/
function vc_tags( $args = '' ) {
	global $wp_query;
	
	// Set Defaults
	$defaults = array(
		'before' => __( 'Tags: ', 'parenttheme' ),
		'after' => ' ',
		'element' => 'span',
		'class' => '',
		'show_item' => false,
		'seperate' => ', ',
		'id' => 0,
		'taxonomy' => 'post_tag',
		'echo' => 1,
	);
	
	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	
	// Build output
	if ( !is_page() OR $show_item ) {
		
		$before_output = "<$element class=\"post-tags $class\">$before<dfn>";
		$inbetween_output = "</dfn>$seperate<dfn>";
		$after_output = "</dfn>$after</$element>";

		$output = get_the_term_list( $wp_query->post->ID, $taxonomy, $before_output, $inbetween_output, $after_output );
		
		
		// Echo / Return output
		if ( is_wp_error( $output ) ) {
			return false;
		}

		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}
		
	} // end if ( !is_page() OR $show_item )	
	
} // end function vc_tags






/** 
 * VC Author
 *
 * This function is an addition to the_author()
 * Adds a few basic options
 * This function makes comment text w/ formatting available in return format for easy global use.
 *
 * @version 0.0.2
 * @updated 05.31.12
 * @since 3.5.3
 * 
 * Note: getting 404 on localhost install, but not live.. Odd..
 **/
function vc_author( $args = '' ) {
	global $authordata;
	
	// Set Defaults
	$defaults = array(
		'before' => __( 'Written By: ', 'parenttheme' ),
		'after' => ' ',
		'element' => 'div',
		'class' => '',
		'show_item' => false,
		'link' => get_author_posts_url( $authordata->ID ),
		'posted_by' => $authordata->display_name,
		'echo' => 1,
	);
	
	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );
	
	
	// build output
	if ( !is_page() OR $show_item ) {
		$output = "<$element class=\"post-author $class\">$before<a href=\"$link\" title=\"" . esc_attr__( strip_tags( "See All Posts by $posted_by" ), 'parenttheme' ) . "\">$posted_by</a>$after</$element>";
	} else {
		return false;
	}
	
	
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}

} // end function vc_author