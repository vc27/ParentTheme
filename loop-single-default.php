<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */



do_action( 'before_loop' );
if ( have_posts() ) {
	echo "<div id=\"section-loop-default\" class=\"clearfix loop loop-single\">";
		while ( have_posts() ) { 
			the_post(); 
			echo "<article "; post_class('clearfix'); echo ">";
				the__title( $post, array(
					'element' => 'h1'
					,'class' => 'h1'
				) );
				echo "<div class=\"meta-data\">";
					the__date( $post );
					the__comments( $post );
				echo "</div>";
				the__content( $post );
			echo "</article>";
			if( do__comments() ) {
				comments_template( '', true );
			}
		} // End while(have_post())
	echo "</div>";
} // End if(have_post()) 
do_action( 'after_loop' );