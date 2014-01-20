<?php
/**
 * File Name initiate-lib.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.2
 * @updated 05.31.13
 *
 * Description:
 * Include core functionality, activation and theme functions.
 **/
#################################################################################################### */


if ( ! defined('THEME_LIB_INIT') ) {
	
	// Depreciated -- in favor of Classes -- Core functionality and foundation of the framework.
	if ( is_child_theme() AND ( ! isset( $ThemeCompatibility ) OR $ThemeCompatibility < 4.9 ) ) {
		require_once( "options/includes.php" );
	}
	
	// Load Classes
	require_once( "classes/includes.php" );
	
	// Various Theme supporting functional functions
	require_once( "lib/includes.php" );
	
	// Widget Classes
	require_once( "widgets/includes.php" );
	
	define( 'THEME_LIB_INIT', true );
	
} // end if ( ! defined('THEME_LIB_INIT') )