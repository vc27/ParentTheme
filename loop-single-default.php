<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */



do_action( 'vc_above_loop' );
if ( have_posts() ) {
	echo "<div id=\"loop-default\" class=\"loop loop-single\">";
		while ( have_posts() ) { 
			the_post(); 
			echo "<article "; post_class(); echo ">";
				the__title( $post, array(
					'element' => 'h1'
					,'class' => 'h1'
				) );
				echo "<div class=\"meta-data\">";
					the__date( $post );
					the__comments( $post );
				echo "</div>";
				the__content( $post );
				echo "<div class=\"clear\"></div>";
			echo "</article>";
			if( ! get__option( 'comments', 'remove_comments' ) AND 'open' == $post->comment_status ) {
				comments_template( '', true );
			}
		} // End while(have_post())
		echo "<div class=\"clear\"></div>";
	echo "</div>";
} // End if(have_post()) 
do_action( 'vc_below_loop' );