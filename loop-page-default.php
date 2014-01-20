<?php
/**
 * File Name loop-page-default.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.9
 * @updated 10.02.13
 **/
#################################################################################################### */


do_action( 'vc_above_loop' ); 

// Default Loop
if ( have_posts() ) { 
	$i = 0; 
	
	echo "<div id=\"loop-default\" class=\"loop loop-page\">";

		while ( have_posts() ) { 
			the_post(); 
			$i++;

			echo "<article "; post_class(); echo ">";

				vc_title( $wp_query->post, array( 
					'permalink' => false,
					'class' => 'h1',
				) );
				vc_comments( $wp_query->post );
				vc_content();

				echo "<div class=\"clear\"> </div>";
			echo "</article>";

			// Insert Comments if turned on
			if( ! get__option( 'comments', 'remove_comments' ) AND 'open' == $wp_query->post->comment_status ) {
				comments_template( '', true );
			}

		} // End while(have_post())
	
		echo "<div class=\"clear\"></div>";
	echo "</div>";
	
	// list_child_pages
	if ( get_post_meta( $wp_query->post->ID, 'list_child_pages', true ) ) {
		get_template_part( 'loop', 'page-list-children' );
	}


} // End if(have_post())

do_action( 'vc_below_loop' );