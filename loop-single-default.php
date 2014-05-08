<?php
/**
 * File Name loop-single-default.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.6
 * @updated 01.20.14
 **/
#################################################################################################### */

do_action( 'vc_above_loop' );


if ( have_posts() ) {
	$i = 0; 
	
	echo "<div id=\"loop-default\" class=\"loop loop-single\">";

	while ( have_posts() ) { 
		the_post(); 
		$i++;

			echo "<article "; post_class(); echo ">";
				
				vc_title( $post, array(
					'element' => 'h1',
					'class' => 'h1',
					'permalink' => false,
				) );
				
				echo "<div class=\"meta-data\">";
					vc_date();
					vc_comments( $post );
				echo "</div>";

				vc_content();

				echo "<div class=\"clear\"></div>";
			echo "</article>";
			
			// Insert Comments if turned on
			if( ! get__option( 'comments', 'remove_comments' ) AND 'open' == $post->comment_status ) {
				comments_template( '', true );
			}
			

		} // End while(have_post())


		echo "<div class=\"clear\"></div>";
	echo "</div>";

} // End if(have_post()) 

do_action( 'vc_below_loop' ); 