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
	function get__avatar( $args ) {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
			if ( class_exists( 'HavePostsVCWP' ) ) {
				$output = HavePostsVCWP::get_avatar($args);
			}
		}
		return $output;

	}
} // end function get__avatar 






/**
 * the__excerpt
 **/
if ( ! function_exists( 'the__excerpt' ) ) {
	function the__excerpt( $post, $args ) {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
			if ( class_exists( 'HavePostsVCWP' ) ) {
				$output = HavePostsVCWP::the_excerpt($post, $args);
			}
		}
		return $output;

	}
} // end function the__excerpt 






/**
 * the__content
 **/
if ( ! function_exists( 'the__content' ) ) {
	function the__content( $args ) {

		$output = false;
		if ( ! class_exists( 'HavePostsVCWP' ) ) {
			require_once( 'HavePostsVCWP.php' );
			if ( class_exists( 'HavePostsVCWP' ) ) {
				$output = HavePostsVCWP::the_content($args);
			}
		}
		return $output;

	}
} // end function the__content