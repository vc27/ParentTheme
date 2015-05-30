<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */






/**
 * get__option --> Wrapper Function
 *
 * @since 3.9.0
 **/
if ( ! function_exists( 'get__option' ) ) {
function get__option( $option, $setting = 'option', $system = 'acf-theme-options' ) {

	$output = false;
	if ( $system == 'acf-theme-options' AND current_theme_supports('acf-theme-options') AND function_exists('get_field') ) {
		$output = get_field( $option, $setting );
	} else if ( $system == 'parent-theme-options' AND current_theme_supports('parent-theme-options') ) {
		if ( ! class_exists( 'ThemeOptions' ) ) {
			require_once( 'ThemeOptions.php' );
		}
		if ( class_exists( 'ThemeOptions' ) ) {
			$ThemeOptions = new ThemeOptions();
			$output = $ThemeOptions->get_option( $option, $setting );
		}
	}
	return $output;

} // end function get__option
}






/**
 * get__widget_area --> Wrapper Function
 *
 * @since 6.9.0
 **/
if ( ! function_exists( 'get__widget_area' ) ) {
function get__widget_area( $name, $args = array() ) {

	$output = false;
	if ( ! class_exists( 'WidgetAreaWP' ) ) {
		require_once( 'WidgetAreaWP.php' );
	}

	if ( class_exists( 'WidgetAreaWP' ) ) {
		WidgetAreaWP::get_widget_area( $name, $args );
	}

} // end function get__option
}






/**
 * featured_image__form_select --> Wrapper Function
 *
 * @since 6.9.1
 **/
if ( ! function_exists( 'comments__callback' ) ) {
function comments__callback( $comment, $args, $depth ) {

	if ( ! class_exists( 'CommentsCallbackWP' ) ) {
		require_once( 'CommentsCallbackWP.php' );
	}

	if ( class_exists( 'CommentsCallbackWP' ) ) {

		new CommentsCallbackWP( $comment, $args, $depth );

	}

} // end function comments__callback
}






/**
 * previous_next___post_link --> Wrapper Function
 *
 * @since 6.9.0
 **/
if ( ! function_exists( 'previous_next___post_link' ) ) {
function previous_next___post_link( $args = array() ) {

	$output = false;
	if ( ! class_exists( 'NavigationWP' ) ) {
		require_once( 'NavigationWP.php' );
	}

	if ( class_exists( 'NavigationWP' ) ) {
		$NavigationWP = new NavigationWP();
		$output = $NavigationWP->previous_next___post_link( $args );
	}

	return $output;

} // end function previous_next___post_link
}






/**
 * previous_next___posts_link --> Wrapper Function
 *
 * @since 6.9.0
 **/
if ( ! function_exists( 'previous_next___posts_link' ) ) {
function previous_next___posts_link( $args = array() ) {

	$output = false;
	if ( ! class_exists( 'NavigationWP' ) ) {
		require_once( 'NavigationWP.php' );
	}

	if ( class_exists( 'NavigationWP' ) ) {
		$NavigationWP = new NavigationWP();
		$NavigationWP->previous_next___posts_link( $args );
		$output = true;
	}

	return $output;

} // end function previous_next___posts_link
}






/**
 * archive__title --> Wrapper Function
 *
 * @since 6.9.0
 **/
if ( ! function_exists( 'archive__title' ) ) {
function archive__title( $args = array() ) {

	$output = false;
	if ( ! class_exists( 'ArchiveTitlesWP' ) ) {
		require_once( 'ArchiveTitlesWP.php' );
	}

	if ( class_exists( 'ArchiveTitlesWP' ) ) {
		$ArchiveTitlesWP = new ArchiveTitlesWP();
		$output = $ArchiveTitlesWP->get_title( $args );
	}

	return $output;

} // end function archive__title
}
