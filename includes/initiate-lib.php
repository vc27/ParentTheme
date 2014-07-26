<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */


if ( ! defined('THEME_LIB_INIT') ) {
	
	// Depreciated
	if ( is_child_theme() AND ( ! isset( $ThemeCompatibility ) OR $ThemeCompatibility < 4.9 ) ) {
		require_once( "options/includes.php" );
	}
	if ( is_child_theme() AND ( ! isset( $ThemeCompatibility ) OR $ThemeCompatibility < 6.9 ) ) {
		// require_once( "options/includes.php" );
	}
	
	// Load Classes
	require_once( "classes/includes.php" );
	
	// Various Theme supporting functional functions
	require_once( "lib/includes.php" );
	
	// Theme Support
	require_once('theme-support.php');
	
	// Widget Classes
	require_once( "widgets/includes.php" );
	
	define( 'THEME_LIB_INIT', true );
	
} // end if ( ! defined('THEME_LIB_INIT') )