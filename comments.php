<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * Description
 * Comments file based on twentyeleven
 **/
#################################################################################################### */
global $wp_query;

if ( get__option( 'comments', 'remove_comments' ) ) {
	return;
}

echo "\n<!-- #comments -->\n";
echo "<div id=\"comments\">\n";
	
	/**
	 * Stop the rest of comments.php from being processed,
	 * but don't kill the script entirely -- we still have
	 * to fully load the template.
	 **/
	if ( post_password_required() ) {
			
			echo "<p class=\"nopassword\">";
			 	_e( 'This post is password protected. Enter the password to view any comments.', 'parenttheme' );
			echo "</p>";
		
		echo "</div><!-- #comments -->";
			
		return;
		
	} // end if ( post_password_required() )
	
	
	if ( have_comments() ) {
		
		echo "<h4 class=\"post-title\">";
			comments_number( 
				__( 'No Responses', 'parenttheme' ), 
				__( 'One Response', 'parenttheme' ), 
				__( '% Responses', 'parenttheme' )
				);
			echo " " . sprintf( __( 'to &#8220; %1$s &#8221', 'parenttheme' ), get_the_title() );
		echo "</h4>";
		
		
		// are there comments to navigate through
		if ( get_comment_pages_count() > 1 AND get_option( 'page_comments' ) ) {
			?>
			
			<div id="comment-nav-above">
				<h1 class="assistive-text"><?php _e( 'Comment navigation', 'parenttheme' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'parenttheme' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'parenttheme' ) ); ?></div>
			</div>
			<?php
 		} // end if ( get_comment_pages_count() > 1 AND get_option( 'page_comments' ) )
		
		
		echo "<ol class=\"list-comments\">";
				wp_list_comments( array( 'callback' => 'comments__callback' ) );
		echo "</ol>";
		
		
		// are there comments to navigate through
		if ( get_comment_pages_count() > 1 AND get_option( 'page_comments' ) ) {
			?>
			
			<div id="comment-nav-above">
				<h1 class="assistive-text"><?php _e( 'Comment navigation', 'parenttheme' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'parenttheme' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'parenttheme' ) ); ?></div>
			</div>
			<?php
 		} // end if ( get_comment_pages_count() > 1 AND get_option( 'page_comments' ) )
		
	
	// Comments are closed or not available
	} elseif ( !comments_open() AND !is_page() AND post_type_supports( get_post_type(), 'comments' ) ) {
		
		echo "<p class=\"nocomments\">";
			echo get__option( 'comments', 'comments_closed' );
		echo "</p>";
	
	} // end if ( have_comments() )
	
	
	// http://codex.wordpress.org/Function_Reference/comment_form
	comment_form( array(
		'label_submit' => __( 'Submit', 'parenttheme' ),
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', 'parenttheme' ) . '</p>',
		'comment_notes_after' => false,
	) );

echo "\n</div>\n<!-- #comments -->\n";