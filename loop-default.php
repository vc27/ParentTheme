<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */



do_action( 'vc_above_loop' );
if ( have_posts() ) {
	echo "<div id=\"loop-default\" class=\"loop\">";
		while ( have_posts() ) { 
			the_post(); 
			echo "<article "; post_class(); echo ">";
				if ( vc_show_featured_image() ) { 
					featured__image( $post, array( 
						'post_thumbnail_size' => get__option( 'post_display', 'featured_image_size' ) 
					) );
				}
				the__title( $post, array( 
					'element' => 'h3'
					,'class' => 'h3'
					,'permalink' => true 
				) );
				echo "<div class=\"meta-data\">";
					the__date( $post );
					the__comments( $post );
				echo "</div>";
				if ( vc_is_excerpt() ) {
					the__excerpt( $post, array( 
						'count' => get__option( 'post_display', 'word_count' )
						,'read_more' => get__option( 'post_display', 'read_more' )
						,'strip_tags' => get__option( 'post_display', 'strip_tags' )
					) );
				} else {
					the__content( $post );
				}
				echo "<div class=\"clear\"></div>";
			echo "</article>";
			// Insert Comments if turned on
			if ( ! get__option( 'comments', 'remove_comments' ) AND 'open' == $post->comment_status ) {
				comments_template( '', true );
			}
		} // End while(have_post())
		echo "<div class=\"clear\"></div>";
	echo "</div>";
} // End if(have_post()) 
do_action( 'vc_below_loop' ); 