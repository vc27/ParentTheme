<?php
/**
 * File Name loop-page-list-children.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.8
 * @updated 01.20.14
 *
 * Child Page Note:
 * 
 * The 'orderby' is calling for 'menu_order' this requires 'order to be set to 'ASC'
 * for 'orderby' to call for 'title' in abc the 'orderby' should be set to 'DESC'
 **/
#################################################################################################### */

$query = array(
	'post_parent' => $wp_query->post->ID,
	'post_type' => 'page',
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC',
);

$wp_query = new WP_Query();
$wp_query->query( $query );

if ( have_posts() ) {
	$i = 0;
	
	echo "<div id=\"loop-child-page\" class=\"loop loop-page\">";
	
		// hook
		vc_above_childloop();

		while ( have_posts() ) {
			the_post();
			$i++;

			echo "<article id=\"child-page-$post->post_name\" class=\"hentry\">";
				vc_title( $post, array( 
					'element' => 'div' 
					'class' => 'h2'
				) );
				vc_content();
				echo "<div class=\"clear\"></div>";
			echo "</article>";


		} // endwhile
	
		// Hook
		vc_below_childloop();
	
		echo "<div class=\"clear\"></div>";
	echo "</div>";
	
	wp_reset_postdata();
} // endif have child page loop
wp_reset_query();