<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */


if ( ! defined('THEME_LIB_INIT') ) {
	
	// Theme Support
	require_once('theme-support.php');
	
	// Load Classes
	require_once( "classes/includes.php" );
	
	// Widget Classes
	require_once( "widgets/includes.php" );
	
	define( 'THEME_LIB_INIT', true );
	
} // end if ( ! defined('THEME_LIB_INIT') )