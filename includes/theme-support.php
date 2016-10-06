<?php
/**
 * @package WordPress
 * @subpackage ThemeWP
 * 
 **/
#################################################################################################### */



/**
 * is__user
 **/
function is__user( $user_login = false ) {
	$userdata = wp_get_current_user();

	if (
		$user_login
		AND isset( $userdata->data->user_login )
		AND $userdata->data->user_login == $user_login
	) {
		return true;
	} else {
		return false;
	}

} // end function is__user






/**
 * do__comments
 **/
function do__comments() {
	global $post;
	if (
		( is_page() AND get__option( '_comments_page_deactivated' ) )
		OR get__option( '_comment_system_deactivated' )
		OR 'closed' == $post->comment_status
		OR ( $post->post_type == 'attachment' AND $post->post_mime_type == 'application/pdf' )
	) {
		return false;
	} else {
		return true;
	}
} // end function do__comments
