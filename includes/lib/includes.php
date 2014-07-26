<?php
/**
 * File Name includes.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.2
 * @updated 05.31.13
 **/
#################################################################################################### */


/**
 * Include files.
 **/
if ( is_child_theme() AND ( ! isset( $ThemeCompatibility ) OR $ThemeCompatibility < 4.9 ) ) {
	require_once('depreciated/theme-support-depreciated.php');
}

if ( is_child_theme() AND ( ! isset( $ThemeCompatibility ) OR $ThemeCompatibility < 6.9 ) ) {
	require_once('depreciated/loop.php');
	require_once('theme-support.php');
}

require_once('page-titles.php');
require_once('navigation.php');
require_once('comments-callback.php');
require_once('pass-wp-themecheck.php');


if ( is_child_theme() AND ( ! isset( $ThemeCompatibility ) OR $ThemeCompatibility < 4.9 ) ) {
	
	require_once('remote-data-vc.php');
	
	require_once( 'depreciated/embed-swf.php' );
	require_once( 'depreciated/header-image-text.php' );
	require_once( 'depreciated/forms-validation.php' );
	require_once( 'depreciated/featured-image.php' );
    require_once( 'depreciated/search.php' );
	
} // end $ThemeCompatibility