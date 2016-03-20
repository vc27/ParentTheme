<?php
/**
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################


/**
 * Comments Callback
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
		?>

		<li id="comment-<?php echo get_comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">

				<div class="comment-details-block">

					<div class="comment-author"><?php echo get_comment_author_link(); ?></div>
					<div class="comment-date"><?php echo get_comment_date(); ?></div>

				</div>

				<div class="comment-text-block-wrap">
					<div class="comment-text-block">
						<?php if ( $comment->comment_approved == '0' ) { ?>
							<em> <?php _e('Your comment is awaiting moderation.'); ?></em>
						<?php } ?>
						<?php comment_text(); ?>
						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array(
								'reply_text' => 'Reply &raquo;',
								'depth' => $depth,
								'max_depth' => $args['max_depth'] )
								) );
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
		// </li> is added from wrapping php function
	} // end function __construct

} // end class CommentsCallbackWP
