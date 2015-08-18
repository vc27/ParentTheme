<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */


if ( ! defined('THEME_SUPPORTS_INIT') ) {

	if ( ! is_child_theme() AND current_theme_supports('acf-theme-options') ) {
		require_once('ACFThemeOptionsWP.php');
	}

	define( 'THEME_SUPPORTS_INIT', true );

} // end if ( ! defined('THEME_SUPPORTS_INIT') )
