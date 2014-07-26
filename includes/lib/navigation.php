<?php
/**
To be converted to class NavigationVCWP
**/
/**
 * File Name navigation.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.8
 * @updated 12.11.13
 **/
#################################################################################################### */






/**
 * Single Post Navigation
 *
 * @version 1.2
 * @updated 11.20.13
 **/
function vc_navigation_post( $args = '' ) {
	
	if ( is_single() ) {
		
		$defaults = array(
			'before' => '',
			'after' => '',
			'prev_spacer' => '&laquo;',
			'prev_text' => '%title',
			'next_spacer' => '&raquo;',
			'next_text' => '%title',
			'element' => 'div',
			'class' => '',
			'spacer' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
			);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );
	
		echo "<$element class=\"navigation-post $class\">";
			echo $before;
			
			echo "<span class=\"prev-post\">";
				previous_post_link( '%link', "<span class=\"spacer\">$prev_spacer</span> $prev_text" );
			echo '</span>';
			
			echo $spacer;
			
			echo "<span class=\"next-post\">";
				next_post_link( '%link', "$next_text <span class=\"spacer\">$next_spacer</span>" );
			echo '</span>';
			
			echo $after;
			echo "<$element class=\"clear\"></$element>";
		echo "</$element>";
	
	} // end if ( is_single() )
	
} // end function vc_post_nav






/**
 * Archive Post Navigation
 *
 * @version 1.4
 * @updated 12.11.13
 **/
function vc_navigation_posts( $args = array() ) {
	global $wp_query;
	
	$navigation_posts = apply_filters( 'vc_navigation_posts', null );
	
	if ( ( is_home() OR is_archive() OR is_search() OR $navigation_posts ) AND ( $wp_query->found_posts >= $wp_query->query_vars['posts_per_page'] ) ) {
	
		$defaults = array(
			'before' => ' ',
			'after' => ' ',
			'element' => 'div',
			'class' => '',
			'spacer' => ' ',
			);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );
	
		echo "<$element class=\"navigation-posts $class\">";
			
			echo $before;
			
			if ( function_exists('wp_pagenavi') ) {
				wp_pagenavi();
			} else {
				echo "<span class=\"prev-post\">"; previous_posts_link(); echo "</span>$spacer<span class=\"next-post\">"; next_posts_link(); echo "</span>";
			}
			
			echo $after;
		
		echo "</$element>";

	} 
	
} // end function vc_navigation_posts






/**
 * Add Paged Navigation only if page is "paged"
 *
 * @version 0.0.1
 * @updated 05.04.12
 **/
function add_pagenav_topofpage() { 
	
	if ( is_paged() ) {
		vc_page_nav();
	}
	
} // end function add_pagenav_topofpage