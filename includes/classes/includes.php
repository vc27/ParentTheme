<?php
/**
 * File Name includes.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.6
 * @updated 06.18.13
 **/
#################################################################################################### */


/**
 * Wrapper Classes
 *
 * Note:
 * The following file includes wrapper functions for
 * various classes. Each wrapper function will include 
 * the required class as it is needed.
 **/
require_once( "wrapper-functions.php" );


/**
 * None Wrapper Classes
 *
 * Note:
 * The following classes will initialize on load.
 **/

if ( is_admin() ) {
	
	// Parent Theme Options
	require_once( "ParentThemeOptionsVCWP.php" );

	// Page Attributes
	require_once( "PageAttrPostMetaVCWP.php" );
	
	// OEmbed MetaBox
	require_once( "OEmbedPostMetaVCWP.php" );
	
	// Admin Custom Columns
	require_once( "AdminCustomColumnsVCWP.php" );
	
	// Admin Ajax
	require_once( "AdminAjaxVCWP.php" );

} // end if ( is_admin() )


// Featured Image Size Post Type
require_once( "FeaturedImagePostType.php" );
// require_once( "ThemeOptions.php" );



// Depreciated require
if ( is_child_theme() AND ( ! isset( $ThemeCompatibility ) OR $ThemeCompatibility < 4.9 ) ) {
	require_once( "Breadcrumb_Navigation_VC.php" );
}