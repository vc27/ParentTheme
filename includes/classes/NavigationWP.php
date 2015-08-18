<?php
/**
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 3.9.0
 **/
####################################################################################################





/**
 * NavigationWP
 **/
class NavigationWP {






	/**
	 * __construct
	 **/
	function __construct() {

	} // end function __construct






	/**
	 * previous_next___post_link
	 * @since 3.9.0
	 **/
	function previous_next___post_link( $args = array() ) {

		if ( ! is_single() ) {
			return false;
		}

		$defaults = array(
			'before' => ''
			,'after' => ''
			,'prev_spacer' => '&laquo;'
			,'prev_text' => '%title'
			,'next_spacer' => '&raquo;'
			,'next_text' => '%title'
			,'element' => 'div'
			,'class' => 'navigation-post'
			,'spacer' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
			,'in_same_term' => false
			,'excluded_terms' => ''
			,'taxonomy' => 'category'
			,'echo' => 1
		);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );

		$output = "<$element class=\"clearfix $class\">";
			$output .= $before;

			$output .= "<span class=\"prev-post\">";
				$output .= get_previous_post_link( '%link', "<span class=\"spacer\">$prev_spacer</span> $prev_text", $in_same_term, $excluded_terms, $taxonomy );
			$output .= '</span>';

			$output .= $spacer;

			$output .= "<span class=\"next-post\">";
				$output .= get_next_post_link( '%link', "$next_text <span class=\"spacer\">$next_spacer</span>", $in_same_term, $excluded_terms, $taxonomy );
			$output .= '</span>';

			$output .= $after;
		$output .= "</$element>";

		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}

	} // end function previous_next___post_link






	/**
	 * previous_next___posts_link
	 * @since 3.9.0
	 **/
	function previous_next___posts_link( $args = array() ) {
		global $wp_query;

		if (
			( is_home() OR is_archive() OR is_search() )
			AND ( $wp_query->found_posts >= $wp_query->query_vars['posts_per_page'] )
		) {

			$defaults = array(
				'before' => ''
				,'after' => ''
				,'element' => 'div'
				,'class' => 'navigation-posts'
				,'spacer' => ' '
			);

			$r = wp_parse_args( $args, $defaults );
			extract( $r, EXTR_SKIP );

			echo "<$element class=\"$class\">";

				echo $before;

				if ( function_exists('wp_pagenavi') ) {
					wp_pagenavi();
				} else {
					echo "<span class=\"prev-post\">"; previous_posts_link(); echo "</span>";
						echo $spacer;
					echo "<span class=\"next-post\">"; next_posts_link(); echo "</span>";
				}

				echo $after;

			echo "</$element>";

		}

	} // end function previous_next___posts_link



} // end class NavigationWP
