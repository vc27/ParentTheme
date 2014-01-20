<?php
/**
 * File Name send-mail.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.1
 * @updated 04.03.13
 **/
#################################################################################################### */


if ( class_exists( 'Send_Mail_VC' ) ) return;






/**
 * Send Mail Class
 *
 * @version 0.1
 * @updated 06.29.12
 **/
class Send_Mail_VC {
	
	
	
	
	
	
	/**
	 * Send Mail
	 *
	 * @version 0.1
	 * @updated 06.29.12
	 *
	 * Note: the return value does not signify weather or not
	 * the email was sent. unfortunately wp_mail will return false
	 * if there were errors, but that does not mean the email wasn't sent.
	 **/
	function send_mail( $args = array() ) {
		
		$defaults = array(
			'message' => false,
			'from_email' => get_option( 'admin_email' ),
			'from_name' => get_bloginfo('name'),
			'subject' => '[' . get_bloginfo('name') . ']',
			'to_email' => false,
			'allow_html' => false,
			);
		
		$this->r = wp_parse_args( $args, $defaults );
		extract( $this->r, EXTR_SKIP );
		
		// Allow for html email
		if ( $allow_html )
			add_filter( 'wp_mail_content_type', array( &$this, 'mail_content_type' ) );

		
		// Only send if there is a message and a "to" email
		if ( $this->has_errors() ) {
			
			return $this->errors;
			
		} else {
			
			// Setup Email Info
			$headers = "From: " . stripslashes( $from_name ) . " <$from_email>\r\n ";
			$subject = strip_tags( stripslashes( $subject ) );
			
			// Send Mail - $to, $subject, $message, $headers, $attachment
			$sent = wp_mail( $to_email, $subject, $message, $headers);
			
			return $sent;

		}
		
	} // end function send_email
	
	
	
	
	
	
	/**
	 * Has Errors
	 *
	 * @version 0.1
	 * @updated 07.02.12
	 **/
	function has_errors() {
		
		if ( ! isset( $this->r['message'] ) OR empty( $this->r['message'] ) OR $this->r['message'] == false )
			$this->errors[] = 'no-message';
		
		if ( ! isset( $this->r['to_email'] ) OR empty( $this->r['to_email'] ) OR $this->r['to_email'] == false )
			$this->errors[] = 'no-to-email';
		
		if ( is_array( $this->errors ) AND ! empty( $this->errors ) )
			return true;
		
	} // end function has_errors
	
	
	
	
	
	
	/**
	 * Mail Content Type
	 *
	 * @version 0.1
	 * @updated 06.29.12
	 **/
	function mail_content_type() {
		
		return "text/html";
		
	} // end function mail_content_type
	
	
	
	
	
	
	/**
	 * Set Message
	 *
	 * @version 0.2
	 * @updated 07.02.12
	 **/
	function set_message( $message, $user = false, $allow_html = false, $subject = false, $body_style = false ) {
		
		// do stuff to the message
		if ( ! $allow_html ) {
			
			$message = strip_tags( stripslashes( $message ) );
			$message = $this->apply_shortcodes( $message, $user );
			
		} else {
			
			$message = stripslashes( $message );
			$message = $this->apply_shortcodes( $message, $user );
			$message = html_entity_decode( $message );
			$message = wpautop( $message );
			
			// ToDo: Add advanced html options for sending full html pages
			$message = $this->html_frame( $message, $subject, $body_style );
			
		}
		
		return $message;
		
	} // end function set_message
	
	
	
	
	
	
	/**
	 * Apply Shortcodes
	 *
	 * @version 0.2
	 * @updated 07.02.12
	 **/
	function apply_shortcodes( $message, $user = false ) {
		
		if ( $user ) {
			$message = str_replace( '%display_name%', $user->display_name, $message );
			$message = str_replace( '%user_id%', $user->ID, $message );
		}
		
		return $message;
		
	} // end function apply_shortcodes
	
	
	
	
	
	
	####################################################################################################
	/**
	 * HTML Email Methods
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * HTML Frame
	 *
	 * @version 0.1
	 * @updated 06.29.12
	 *
	 * Note: html was pulled directly from mailchimp template as
	 * a secure starting point for an html frame.
	 **/
	function html_frame( $html_body, $subject, $body_style = false ) {
		
		$html = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
		$html .= "<html>";
			$html .= "<head>";
				$html .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
		        $html .= "<title>$subject</title>";

			$html .= "</head>";
			$html .= "<body leftmargin=\"0\" marginwidth=\"0\" topmargin=\"0\" marginheight=\"0\" offset=\"0\" style=\"-webkit-text-size-adjust: none;margin: 0;padding: 10px;width: 100% !important; $body_style\">";
				
				$html .= $html_body;
				
			$html .= "</body>";
		$html .= "</html>";
		
		return $html;
		
	} // end function html_frame
	
	
	
} // end class Send_Mail_VC