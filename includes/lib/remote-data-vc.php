<?php
/**
 * File Name remote-data-vc.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.6
 * @updated 04.03.13
 * 
 * Depreciated in favor of GetRemoteDataVCWP
 **/
#################################################################################################### */



/**
 * Check for existence Remote_Data_VC
 **/
if ( class_exists( 'Remote_Data_VC' ) ) return;






/**
 * Remote_Data_VC Class
 *
 * @version 0.0.2
 * @updated 05.14.12
 **/
class Remote_Data_VC {
	
	
	var $transient_timeout = 86400; // one day in seconds
	
	
	
	/**
	 * Fetch Data
	 *
	 * @version 0.3
	 * @updated 09.14.12
	 **/
	function fetch_data( $type, $url, $args = false, $transient_name = false, $reset_transient = false ) {
		
		$data = $this->get_transient( $transient_name, $reset_transient );
		
		if ( ! $data ) {
			
			$type = sanitize_title_with_dashes( $type );
			switch ( $type ) {
				case "get" :
					$data = wp_remote_get( $url, $args );
					break;
				case "post" :
					$data = wp_remote_post( $url, $args );
				default :
					$data = apply_filters( 'vc_remote_fetch_data', $url, $args );
					break;
			} // end switch
			
			if ( $data ) {
				$data = $this->extract_data( $data );
				if ( $transient_name )
					$data['has_transient'] = set_transient( $transient_name, $data, apply_filters( 'vc-remote_data-transient_timeout', $this->transient_timeout ) );
				else
					$data['has_transient'] = 0;
			} else {
				$data = false;
			}
			
		} else {
			
			$data['has_transient'] = 1;
			
		} // end if ( $data )
		
		return $data;
		
	} // end function fetch_data
	
	
	
	
	
	
	/**
	 * Extract Data
	 *
	 * @version 0.0.4
	 * @updated 05.15.12
	 **/
	function extract_data( $data ) {
		
		
		if ( wp_remote_retrieve_response_code( $data ) != 200 ) {
			
			$response['message'] = wp_remote_retrieve_response_message( $data );
			$response['status'] = wp_remote_retrieve_response_code( $data );
			
		} else if ( ! $body = wp_remote_retrieve_body( $data ) ) {
			
			if ( is_wp_error( $data ) )
				$response['message'] = 'WP_Error';
			else
				$response['message'] = 'Unregistered Error';
			
			$response['status'] = 'error';
			$response['body'] = $data;
				
		} else {
			
			$response['message'] = 'Data was received.';
			$response['status'] = 'success';
			$response['has_transient'] = 0;
			
			$content_type = $this->get_content_type( $data );
			switch ( $content_type ) {
				
				case "json" :
					$response['content_type'] = 'json';
					$response['body'] = $this->_parse_json( $body );
					break;
				case "xml" :
					$response['content_type'] = 'xml';
					$response['body'] = $this->_parse_xml( $body );
					break;
				default :
					$response['content_type'] = $content_type;
					$response['body'] = 'unregistered-content-type';
					break;
				
			} // end switch ( $content_type )
				
		}
		
		return apply_filters( 'vc_remote_extract_data', $response );
		
	} // end function fetch_data
	
	
	
	
	
	
	/**
	 * Get Content Type
	 *
	 * @version 0.0.1
	 * @updated 02.27.12
	 **/
	function get_content_type( $data ) {
		
		// e.g. = application/json; charset=utf-8
		$content_type = explode( '/', $data['headers']['content-type'] );
		
		// e.g. = json; charset=utf-8
		$content_type = explode( ';', $content_type[1] );
		
		if ( $content_type[0] )
			return $content_type[0];
		else
			return false;
		
	} // end function get_content_type
	
	
	
	
	
	
	/**
	 * Parses a json response body.
	 *
	 * @version 0.0.2
	 * @updated 05.14.12
	 */
	function _parse_json( $response_body ) {
		
		if ( $data = json_decode( trim( $response_body ) ) ) {
			
			if ( is_object( $data ) )
				$data = (array)$data;
				
		} else {
			
			$data = false;
			
		}
		
		return $data;
		
	} // end function _parse_json
	
	
	
	
	
	
	/**
	 * Parses an XML response body.
	 *
	 * @version 0.0.2
	 * @updated 05.14.12
	 */
	function _parse_xml( $response_body ) {
		
		if ( function_exists('simplexml_load_string') ) {
			
			$errors = libxml_use_internal_errors( 'true' );
			$data = simplexml_load_string( $response_body );
			libxml_use_internal_errors( $errors );
			
			if ( is_object( $data ) )
				$data = (array)$data;
				
		} else {
			
			$data = false;
			
		}
		
		return $data;
		
	} // end function _parse_xml
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Transient Caching
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Get Transient
	 * 
	 * @version 0.0.1
	 * @updated 05.14.12
	 **/
	function get_transient( $transient_name, $reset_transient ) {
		
		if ( $transient_name != false AND $reset_transient != false ) {
			$this->reset_transient( $transient_name, $reset_transient );
			$data = false;
		} else if ( $transient_name != false ) {
			$data = get_transient( $transient_name );
		} else {
			$data = false;
		}
		
		return $data;
		
	} // end function get_transient
	
	
	
	
	
	
	/**
	 * Reset Transient
	 * 
	 * @version 0.0.2
	 * @updated 05.17.12
	 **/
	function reset_transient( $transient_name, $reset = false ) {
		
		if ( $reset ) {
			$deleted = delete_transient( $transient_name );
			if ( $deleted )
				$this->reset_transient = 1;
			else
				$this->reset_transient = 'no';
		}
		
	} // end function reset_transient
	
	
	
} // end class Remote_Data_VC