<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */



do_action( 'before_loop' );
if ( have_posts() ) {
	echo "<div id=\"section-loop-default\" class=\"loop\">";
		while ( have_posts() ) { 
			the_post(); 
			echo "<article "; post_class('clearfix'); echo ">";
				featured__image( $post, array( 
					'post_thumbnail_size' => 'standard'
				) );
				the__title( $post, array( 
					'element' => 'h3'
					,'class' => 'h3'
					,'permalink' => true 
				) );
				echo "<div class=\"meta-data\">";
					the__date( $post );
					the__comments( $post );
				echo "</div>";
				the__excerpt( $post, array( 
					'count' => 55
					,'read_more' => 'Read More'
					,'strip_tags' => '<p>'
				) );
			echo "</article>";
			// Insert Comments if turned on
			if ( do__comments() ) {
				comments_template( '', true );
			}
		} // End while(have_post())
	echo "</div>";
} // End if(have_post()) 
do_action( 'after_loop' ); 