<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */






/**
 * get__avatar
 **/
if ( ! function_exists( 'get__avatar' ) ) {
	function get__avatar( $args = array() ) {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
		}
		if ( class_exists( 'HavePostsVCWP' ) ) {
			$output = HavePostsVCWP::get_avatar($args);
		}
		return $output;

	}
} // end function get__avatar 






/**
 * the__excerpt
 **/
if ( ! function_exists( 'the__excerpt' ) ) {
	function the__excerpt( $post, $args = array() ) {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
		}
		if ( class_exists( 'HavePostsVCWP' ) ) {
			$output = HavePostsVCWP::the_excerpt($post,$args);
		}
		return $output;

	}
} // end function the__excerpt 






/**
 * the__content
 **/
if ( ! function_exists( 'the__content' ) ) {
	function the__content( $args = array() ) {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
		}
		if ( class_exists( 'HavePostsVCWP' ) ) {
			$output = HavePostsVCWP::the_content($args);
		}
		return $output;

	}
} // end function the__content 






/**
 * the__title
 **/
if ( ! function_exists( 'the__title' ) ) {
	function the__title( $post, $args = array() ) {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
		}
		if ( class_exists( 'HavePostsVCWP' ) ) {
			$output = HavePostsVCWP::the_title($post,$args);
		}
		return $output;

	}
} // end function the__title 






/**
 * the__comments
 **/
if ( ! function_exists( 'the__comments' ) ) {
	function the__comments( $post, $args = array() ) {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
		}
		if ( class_exists( 'HavePostsVCWP' ) ) {
			$output = HavePostsVCWP::the_comments($post,$args);
		}
		return $output;

	}
} // end function the__comments 






/**
 * the__category
 **/
if ( ! function_exists( 'the__category' ) ) {
	function the__category( $post, $args = array() ) {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
		}
		if ( class_exists( 'HavePostsVCWP' ) ) {
			$output = HavePostsVCWP::the_category($post,$args);
		}
		return $output;

	}
} // end function the__category 






/**
 * the__time
 **/
if ( ! function_exists( 'the__time' ) ) {
	function the__time( $post, $args = array() ) {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
		}
		if ( class_exists( 'HavePostsVCWP' ) ) {
			$output = HavePostsVCWP::the_time($post,$args);
		}
		return $output;

	}
} // end function the__time 






/**
 * the__date
 **/
if ( ! function_exists( 'the__date' ) ) {
	function the__date( $post, $args = array() ) {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
		}
		if ( class_exists( 'HavePostsVCWP' ) ) {
			$output = HavePostsVCWP::the_date($post,$args);
		}
		return $output;

	}
} // end function the__date 






/**
 * the__tags
 **/
if ( ! function_exists( 'the__tags' ) ) {
	function the__tags( $post, $args = array() ) {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
		}
		if ( class_exists( 'HavePostsVCWP' ) ) {
			$output = HavePostsVCWP::the_tags($post,$args);
		}
		return $output;

	}
} // end function the__tags 






/**
 * the__author
 **/
if ( ! function_exists( 'the__author' ) ) {
	function the__author( $post, $args = array() ) {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
		}
		if ( class_exists( 'HavePostsVCWP' ) ) {
			$output = HavePostsVCWP::the_author($args);
		}
		return $output;

	}
} // end function the__author 






/**
 * show__loop_excerpt
 **/
if ( ! function_exists( 'show__loop_excerpt' ) ) {
	function show__loop_excerpt() {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
		}
		if ( class_exists( 'HavePostsVCWP' ) ) {
			$output = HavePostsVCWP::show_loop_excerpt();
		}
		return $output;

	}
} // end function show__loop_excerpt 






/**
 * show__loop_featured_image
 **/
if ( ! function_exists( 'show__loop_featured_image' ) ) {
	function show__loop_featured_image() {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
		}
		if ( class_exists( 'HavePostsVCWP' ) ) {
			$output = HavePostsVCWP::show_loop_featured_image();
		}
		return $output;

	}
} // end function show__loop_featured_image