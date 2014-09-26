<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */


if ( ! defined('THEME_SUPPORTS_INIT') ) {
	if ( current_theme_supports('parent-theme-options') ) {
		require_once('ParentThemeOptionsVCWP.php');
	}
	if ( current_theme_supports('video-oembed-post-meta') ) {
		require_once('OEmbedPostMetaVCWP.php');
	}
	define( 'THEME_SUPPORTS_INIT', true );
} // end if ( ! defined('THEME_SUPPORTS_INIT') )