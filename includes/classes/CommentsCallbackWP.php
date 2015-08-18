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



} // end class CommentsCallbackWP
