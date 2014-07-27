<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */






/**
 * is__user
 *
 **/
function is__user( $user_login = false ) {
	$userdata = wp_get_current_user();
	
	if ( $user_login AND isset( $userdata->data->user_login ) AND $userdata->data->user_login == $user_login )
		return true;
	else
		return false;

} // end function is__user