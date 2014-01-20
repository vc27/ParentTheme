<?php
/**
 * File Name includes.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 3.5.4
 * @version 2.0
 * @updated 05.29.13
 **/
#################################################################################################### */


/**
 * Include all needed files.
 **/

if ( is_child_theme() AND ( ! isset( $ThemeCompatibility ) OR $ThemeCompatibility < 4.9 ) ) {
	
	require_once( "options-vc.php" );
	require_once( "post-type-vc.php" );
	require_once( "post-meta-vc.php" );
	require_once( "create-posts.php" );
	require_once( "send-mail.php" );
	require_once( "featured-image-post_type.php" );
	require_once( "taxonomy-options.php" );
	
} // end $ThemeCompatibility