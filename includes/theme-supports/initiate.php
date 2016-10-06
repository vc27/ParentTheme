<?php
/**
 * @package WordPress
 * @subpackage ThemeWP
 * 
 **/
#################################################################################################### */


if ( ! defined('THEME_SUPPORTS_INIT') ) {

	if ( ! is_child_theme() AND current_theme_supports('acf-theme-options') ) {
		require_once('ACFThemeOptionsWP.php');
	}

	define( 'THEME_SUPPORTS_INIT', true );

} // end if ( ! defined('THEME_SUPPORTS_INIT') )
