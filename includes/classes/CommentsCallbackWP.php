<?php
/**
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################





/**
 * CommentsCallbackWP
 *
 * @version 1.0
 * @updated 00.00.00
 **/
class CommentsCallbackWP {
	
	
	
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
	function __construct( $comment, $args, $depth ) {
		
		$GLOBALS['comment'] = $comment;

		echo "<li id=\"comment-" . get_comment_ID() . "\" "; comment_class(); echo ">";
			echo "<div class=\"comment-body\">";

				echo "<div class=\"comment-details-block\">";

					echo "<div class=\"comment-author\">" . get_comment_author_link() . "</div>";
					echo "<div class=\"comment-date\">" . get_comment_date() . "</div>";

				echo "</div>"; // end span3

				echo "<div class=\"comment-text-block-wrap\">";
					echo "<div class=\"comment-text-block\">";

						if ( $comment->comment_approved == '0' ) {
							echo "<em>"; _e('Your comment is awaiting moderation.'); echo "</em>";
						}

						comment_text();

						echo "<div class=\"reply\">";
							comment_reply_link( array_merge( $args, array( 
								'reply_text' => 'Reply &raquo;',
								'depth' => $depth, 
								'max_depth' => $args['max_depth'] ) 
								) );
						echo "</div>";

					echo "</div>";

				echo "</div>"; // end span9

				echo "<div class=\"clear\"></div>";
			echo "</div>"; // end row-fluid
		
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
	
	
	
} // end class CommentsCallbackWP