<?php
/**
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################





/**
 * HavePostsVCWP
 *
 * @version 1.0
 * @updated 00.00.00
 **/
class HavePostsVCWP {
	
	
	
	/**
	 * Option name
	 **/
	var $option_name = false;
	
	
	
	/**
	 * errors
	 * 
	 * @access public
	 * @var array
	 **/
	var $errors = array();
	
	
	
	/**
	 * have_errors
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_errors = 0;
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function __construct() {

	} // end function __construct
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set
	
	
	
	
	
	
	/**
	 * error
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function error( $error_key ) {
		
		$this->errors[] = $error_key;
		
	} // end function error
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * example_function
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function example_function() {
		
		// sss
		
	} // end function example_function
	
	
	
	
	
	
	/**
	 * get_avatar
	 **/
	static function get_avatar( $args = array() ) {
		global $authordata;

		// Set Defaults
		$defaults = array(
			'author_id' => $authordata->ID,
			'user_email' => $authordata->user_email,
			'display_name' => $authordata->display_name,
			'size' => 48,
			'permalink' => get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
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

		// Set Link
		if ( isset( $permalink ) AND !empty( $permalink ) ) {
			$a_ = "<a href=\"$permalink\" title=\"" . esc_attr__( strip_tags( "See All Posts by $display_name" ), 'parenttheme' ) . "\">";
			$_a = '</a>';
		} else {
			$a_ = "";
			$_a = "";
		}


		// Build Output
		$output = "<$element class=\"avatar $class\">" . $before . $a_ . $image . $_a . $after . "</$element>";


		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}

	} // end static function get_avatar
	
	
	
	
	
	
	/**
	 * the_excerpt
	 **/
	static function the_excerpt( $post, $args = array() ) { 

		// Set Defaults
		$defaults = array(
			'post_content' => $post->post_content,
			'remove_shortcodes' => true,
			'strip_tags' => '<p>',
			'read_more' => __( 'Read More', 'parenttheme' ),
			'kill_read_more' => false,
			'read_more_class' => 'read-more',
			'read_more_dots' => '...',
			'permalink' => get_permalink( $post->ID ),
			'title' => $post->post_title,
			'class' => 'entry excerpt',
			'clear_fix' => true,
			'count' => 55,
			'element' => 'div',
			'before' => '',
			'after' => '',
			'echo' => 1,
			
			// depricated
			'text' => '',
			'shortcodes' => '',
		);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );
		
		
		// Backwards compatible
		if ( isset( $text ) AND ! empty( $text ) ) {
			$post_content = $text;
		}
		if ( isset( $shortcodes ) AND ! empty( $shortcodes ) ) {
			$remove_shortcodes = $shortcodes;
		}
		
		
		
		// Clean Text
		if ( isset( $strip_tags ) AND ! empty( $strip_tags ) ) {
			$post_content = strip_tags( $post_content, $strip_tags );
		}
		
		
		
		// if there is a trailing [/caption] get rid of it.
		if ( isset( $remove_shortcodes ) AND ! empty( $remove_shortcodes ) ) {
			$post_content = strip_shortcodes( $post_content );
			$post_content = str_replace( '[/caption]', '', $post_content );
		}


		// If there is a Post Excerpt? use it, and do not cut it.
		if ( isset( $post->post_excerpt ) AND !empty( $post->post_excerpt ) ) {
			$post_content = $post->post_excerpt;
		} else {
			$post_content = wp_trim_words( $post_content, $count, apply_filters( 'excerpt_more', ' ' . '[&hellip;]' ) );
		}
		
		
		// Read more
		$read_more = " <span class=\"read-more-dots\">$read_more_dots</span> <a class=\"$read_more_class\" rel=\"nofollow\" href=\"$permalink\">$read_more</a>";
		if ( isset( $kill_read_more ) AND ! empty( $kill_read_more ) ) {
			$read_more = false;
		}
		$post_content .= $read_more;


		// Do Standard filters for excerpt text
		$post_content = wptexturize( $post_content );
		$post_content = convert_smilies( $post_content );
		$post_content = convert_chars( $post_content );
		$post_content = wpautop( $post_content );

		// If shortcodes do it!
		if ( ! $remove_shortcodes ) {
			$post_content = do_shortcode( $post_content );
		}

		$post_content = shortcode_unautop( $post_content );
		
		if ( $clear_fix ) {
			$clear_fix = "<div class=\"clear\"></div>";
		}


		// Build Output
		$output = "<$element class=\"$class\">" . $before . $post_content . $after . $clear_fix . "</$element>";


		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}



	} // end static function the_excerpt
	
	
	
	
	
	
	/**
	 * the_content
	 **/
	static function the_content( $args = array() ) {

		// Set Defaults
		$defaults = array(
			'more_link_text' => null,
			'stripteaser' => false,
			'post_content' => false,
			'class' => 'entry',
			'element' => 'div',
			'clear_fix' => true,
			'before' => '',
			'after' => '',
			'echo' => 1,
			
			'content' => false,
		);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );
		
		
		// Backwards compatible
		if ( isset( $content ) AND ! empty( $content ) ) {
			$post_content = $content;
		}
		
		
		
		if ( $clear_fix ) {
			$clear_fix = "<div class=\"clear\"></div>";
		}
		if ( $post_content == false OR empty( $post_content ) OR is_attachment() ) {
			$post_content = get_the_content( $more_link_text, $stripteaser );
		} else if ( isset( $post_content ) AND ! empty( $post_content ) ) {
			$post_content = apply_filters( 'the_content', $post_content );
		}
		
		
		
		// build output
		$output = "<$element class=\"$class\">" . $before . $post_content . $after . $clear_fix . "</$element>";
		
		
		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}
		

	} // end static function the_content
	
	
	
	
	
	
	/**
	 * the_title
	 **/
	static function the_title( $post, $args = array() ) {

		// Set Defaults
		$defaults = array(
			'post_id' => $post->ID,
			'post_title' => $post->post_title,
			'post_excerpt' => $post->post_excerpt,
			'class' => '',
			'element' => 'div',
			'add_permalink' => false,
			'the_permalink' => get_permalink($post->ID),
			'before' => '',
			'after' => '',
			'before_inside_a' => '',
			'after_inside_a' => '',
			'target' => '_parent',
			'echo' => 1,
			
			'a_' => false,
			'_a' => false,
			
			'permalink' => '',
			'alt_link' => '',
		);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );
		
		
		
		// Backwards compatible
		if ( isset( $alt_link ) AND ! empty( $alt_link ) ) {
			$the_permalink = $alt_link;
		}
		if ( isset( $permalink ) AND ! empty( $permalink ) ) {
			$add_permalink = $permalink;
		}


		// Set the title according to attachment
		if ( is_attachment() AND isset( $post_excerpt ) AND ! empty( $post_excerpt ) ) {
			$post_title = $post_excerpt;
		}


		// Check to see if we should link the_title
		if ( $add_permalink ) {
			
			$a_ = "<a href=\"$the_permalink\" title=\"" . esc_attr( strip_tags( $post_title ) ) . "\" rel=\"bookmark\" target=\"$target\">";
			$_a = "</a>";

		}

		$output = "<$element class=\"$class\">" . $before . $a_ . $before_inside_a . apply_filters( 'the_title', $post_title ) . $after_inside_a . $_a . $after . "</$element>";


		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}   

	} // end static function the_title
	
	
	
	
	
	
	/** 
	 * the_comments
	 **/
	static function the_comments( $post, $args = array() ) {
		
		// if comments are off or if this is an attachment post
		if ( 
			get__option( 'comments', 'remove_comments' ) 
			OR ( $post->post_type == 'attachment' AND $post->post_mime_type == 'application/pdf' ) 
			OR $post->comment_status != 'open'
		) {
			return false;
		}

		// Set Defaults
		$defaults = array(
			'number' => get_comments_number( $post->ID ),
			'permalink' => get_comments_link( $post->ID ),
			'no_comments' => __( 'Comment', 'parenttheme' ),
			'one_comment' => __( '1&nbsp;Comment', 'parenttheme' ),
			'comments' => __( '%&nbsp;Comments', 'parenttheme' ),
			'before' => '',
			'after' => '',
			'before_inside_a' => '',
			'after_inside_a' => '',
			'element' => 'span',
			'class' => 'post-comments',
			'echo' => 1,
			
			'link' => '',
		);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );
		
		
		// Backwards compatible
		if ( isset( $link ) AND ! empty( $link ) ) {
			$permalink = $link;
		}


		// Set comment Number or text
		if ( $number > 1 ) {
			$comments_number = str_replace( '%', number_format_i18n( $number ), $comments );
		} else if ( $number == 0 ) {
			$comments_number = $no_comments;
		} else {
			$comments_number = $one_comment;
		}

		// apply comment_number filter
		$comments_number = apply_filters('comments_number', $comments_number, $number);


		$output = "<$element class=\"$class\">" . $before . "<a href=\"$permalink\">" . $before_inside_a . $comments_number . $after_inside_a . "</a>" . $after . "</$element>";


		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}



	} // end static function the_comments
	
	
	
	
	
	
	/**
	 * the_category
	 **/
	static function the_category( $post, $args = array() ) {

		// Set Defaults
		$defaults = array(
			'before' => '',
			'after' => '',
			'element' => 'div',
			'class' => 'post-category',
			'separator' => ', ',
			'echo' => 1,
		);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );


		// Build Output
		$output = "<$element class=\"$class\">" . $before . get_the_category_list( $separator, '', $post->ID ) . $after . "</$element>";


		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}   

	} // end static function the_category
	
	
	
	
	
	
	/** 
	 * the_time
	 **/
	static function the_time( $post, $args = array() ) {

		// Set Defaults
		$defaults = array(
			'before' => __( '@', 'parenttheme' ),
			'after' => '',
			'element' => 'span',
			'class' => 'post-time',
			'time' => get_option('time_format'),
			'echo' => 1
		);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );


		// Build Output
		$output = "<$element class=\"$class\">" . $before . get_the_time( $time, $post->ID ) . $after . "</$element>";
		

		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}

	} // end static function the_time
	
	
	
	
	
	
	/**
	 * the_date
	 **/
	static function the_date( $post, $args = array() ) {

		// Set Defaults
		$defaults = array(
			'before' => '',
			'after' => '',
			'before_inside_a' => '',
			'after_inside_a' => '',
			'element' => 'span',
			'class' => 'post-date',
			'date' => get_option('date_format'),
			'permalink' => false,
			'echo' => 1,
			
			'a_' => '',
			'_a' => '',
			
			'link' => false,
		);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );
		
		// Backwards compatible
		if ( isset( $link ) AND ! empty( $link ) ) {
			$permalink = $link;
		}
		
		
		if ( $permalink ) {
			$a_ = "<a href=\"" . get_permalink() . "\" title=\"" . get_the_title() . "\">";
			$_a = "</a>";
		}

		$output = "<$element class=\"$class\">" . $before . $a_ . $before_inside_a . get_the_time( $date, $post->ID ) . $after_inside_a . $_a . $after . "</$element>";

		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}

	} // end static function the_date
	
	
	
	
	
	
	/** 
	 * the_tags
	 **/
	static function the_tags( $post, $args = array() ) {

		// Set Defaults
		$defaults = array(
			'before' => '',
			'after' => '',
			'element' => 'span',
			'class' => 'post-tags',
			'seperate' => ', ',
			'taxonomy' => 'post_tag',
			'echo' => 1,
		);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );


		// Build output
		$output = get_the_term_list( 
			$post->ID, 
			$taxonomy, 
			"<$element class=\"$class\">$before<dfn>", 
			"</dfn>$seperate<dfn>", 
			"</dfn>$after</$element>" 
		);

		
		if ( is_wp_error( $output ) ) {
			return false;
		}

		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}

	} // end static function the_tags
	
	
	
	
	
	
	/** 
	 * the_author
	 **/
	static function the_author( $args = array() ) {
		global $authordata;

		// Set Defaults
		$defaults = array(
			'before' => '',
			'after' => '',
			'before_inside_a' => '',
			'after_inside_a' => '',
			'element' => 'div',
			'class' => 'post-author',
			'permalink' => get_author_posts_url( $authordata->ID ),
			'posted_by' => $authordata->display_name,
			'echo' => 1,
			
			'link' => '',
		);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );
		
		
		// Backwards compatible
		if ( isset( $link ) AND ! empty( $link ) ) {
			$permalink = $link;
		}


		// build output
		$output = "<$element class=\"$class\">$before<a href=\"$permalink\" title=\"" . esc_attr__( strip_tags( "See All Posts by $posted_by" ), 'parenttheme' ) . "\">" . $before_inside_a . $posted_by . $after_inside_a . "</a>$after</$element>";


		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}

	} // end static function the_author
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_errors
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function have_errors() {
		
		if ( isset( $this->errors ) AND ! empty( $this->errors ) AND is_array( $this->errors ) ) {
			$this->set( 'have_errors', 1 );
		} else {
			$this->set( 'have_errors', 0 );
		}
		
		return $this->have_errors;
		
	} // end function have_errors
	
	
	
} // end class HavePostsVCWP