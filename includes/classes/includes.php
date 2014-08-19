<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 3.9.0
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
require_once( "HavePostsVCWP/wrapper-functions.php" );


/**
 * Required Admin Classes
 **/

if ( is_admin() ) {
	
	// Parent Theme Options
	require_once( "ParentThemeOptionsVCWP.php" );
	
	// OEmbed MetaBox
	require_once( "OEmbedPostMetaVCWP.php" );

} // end if ( is_admin() )