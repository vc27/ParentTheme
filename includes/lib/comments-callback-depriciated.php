<?php
/**
 * File Name comments-callback.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.2
 * @updated 04.03.13
 **/
#################################################################################################### */



/**
	This file is not built correctly and needs an update.
 **/






/**
 * VC Comments
 * 
 * This function is the default function use to display individual comments.
 * Noted: closing </li> tag is missing, there is a special wp reason for this.
 *
 * @version 0.1
 * @since 3.5.4
 **/
function vc_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

?>
<li id="li-comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
	<div id="comment-<?php comment_ID(); ?>" class="single_comment-inner_wrap">
		
		<?php echo get_avatar( $comment, 35 ); ?>
		<div class="comment-author vcard"><?php echo get_comment_author_link(); ?></div>
		
		<?php if ( $comment->comment_approved == '0' ) echo "<em>" . _e('Your comment is awaiting moderation.') . "</em>"; ?>
			
		<div class="comment-meta commentmetadata">
			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php echo get_comment_date() . ' at . '. get_comment_time(); ?></a>
			<?php edit_comment_link( '(Edit)' ) ?>
		</div>

		<?php comment_text() ?>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
		<div class="clear"></div>
	</div>
<?php
} // end function vc_comment