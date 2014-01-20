<?php
/**
 * File Name loop-w-latest-post.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.6
 * @updated 01.20.14
 **/
#################################################################################################### */
global $LatestPostWidgetVCWP;

$wp_query = new WP_Query();
$wp_query->query( $LatestPostWidgetVCWP->query );

if ( have_posts() ) { 
	$i = 0; 
	
	echo $LatestPostWidgetVCWP->before_widget . $LatestPostWidgetVCWP->title;
	
	echo "<ul class=\"loop widget-loop-post\">";
	
	while ( have_posts() ) { 
		the_post();
		$i++;
		
		echo "<li "; post_class(); echo ">";
			
			// Featured Image
			if ( $LatestPostWidgetVCWP->show__featured_image() ) {
				featured__image( $post, array( 
					'post_thumbnail_size' => $LatestPostWidgetVCWP->featured_image_size 
				) );
			}


			// Title and Date
			vc_title( $post, array( 
				'permalink' => true, 
				'element' => 'div' 
			) );
			
			vc_date( array( 
				'show_item' => true 
			) );

			
			
			// Content and post meta
			if ( ! $LatestPostWidgetVCWP->hide_entry() ) {
				
				if ( $LatestPostWidgetVCWP->full_post() ) {
					vc_content();
					
					echo '<div class="meta_data">';
						
						vc_tags( array( 
							'before' => __( 'Posted Under: ', 'parenttheme' ), 
							'show_item' => true 
						) );
						
						vc_author( array( 
							'before' => __( 'Written By: ', 'parenttheme' ), 
							'show_item' => true 
						) );
						
						vc_time( array( 
							'show_item' => true 
						) );
						
					echo '</div>';

				} else {
					vc_excerpt( $post, array(
						'count' => $LatestPostWidgetVCWP->word_count,
						'strip_tags' => $LatestPostWidgetVCWP->strip_tags,
						'read_more' => $LatestPostWidgetVCWP->read_more,
						'push_read_more' => true,
						'kill_read_more' => $LatestPostWidgetVCWP->kill_read_more
					) );

				} // end if ( $full_post )
				
			} // end if ( !$hide_entry )
			
			
			echo "<div class=\"clear\"></div>";
		echo "</li>";

	} // endwhile
	
	wp_reset_postdata();
	
	echo "</ul>";
	
	echo $LatestPostWidgetVCWP->after_widget;

} // endif have posts

wp_reset_query();