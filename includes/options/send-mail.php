<?php
/**
 * File Name -- Depreciated -- send-mail.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.2
 * @updated 02.09.13
 * 
 * Depreciate in favor of SendMailVCWP
 **/
#################################################################################################### */


if ( class_exists( 'Send_Mail_VC' ) ) return;






/**
 * Send Mail Class	
 *
 * @version 1.2
 * @updated 02.09.13
 **/
class Send_Mail_VC {
	
	
	
	
	
	
	/**
	 * Set
	 *
	 * @version 1.0
	 * @updated 02.09.13
	 **/
	function __construct() {
		
		$this->send_mail = new SendMailVCWP();
		
	} // end function __construct
	
	
	
	
	
	
	/**
	 * Send Mail
	 *
	 * @version 1.2
	 * @updated 02.09.13
	 *
	 * Note: the return value does not signify weather or not
	 * the email was sent. unfortunately wp_mail will return false
	 * if there were errors, but that does not mean the email wasn't sent.
	 **/
	function send_mail( $args = array() ) {
		
		$this->send_mail->send_mail( $args );
		
	} // end function send_email
	
	
	
	
	
	
	/**
	 * Set Message
	 *
	 * @version 1.3
	 * @updated 02.09.13
	 **/
	function set_message( $message, $user = false, $allow_html = false, $subject = false, $body_style = false ) {
		
		return $message;
		
	} // end function set_message
	
	
	
} // end class Send_Mail_VC