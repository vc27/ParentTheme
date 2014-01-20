<?php
/**
 * File Name AdminCustomColumnsVCWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * AdminCustomColumnsVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$AdminCustomColumnsVCWP = new AdminCustomColumnsVCWP();
class AdminCustomColumnsVCWP {
	
	
	
	/**
	 * included_post_types
	 * 
	 * @access public
	 * @var array
	 **/
	var $included_post_types = array( 'post', 'page' );
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {

		add_filter("manage_edit-page_columns", array( &$this, "edit_columns" ) );
		add_filter("manage_edit-post_columns", array( &$this, "edit_columns" ) );

		// Add Columns content to Post & Page manage table
		add_action("manage_pages_custom_column", array( &$this, "custom_columns" ) );
		add_action("manage_posts_custom_column", array( &$this, "custom_columns" ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################






	/**
	 * Add Featured Image to the Post and Page section of the WP admin edit
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function edit_columns( $columns ) {

		$columns['pt-image'] = 'Image';

		return $columns;

	} // end function edit_columns





	/**
	 * Add Custom Columns to Post & Page
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function custom_columns( $column ) {
		global $post;

		if ( in_array( $post->post_type, $this->included_post_types ) ) {

			switch ( $column ) {

				case "pt-image":
					if ( has_post_thumbnail( $post->ID ) )
						echo get_the_post_thumbnail( $post->ID, array( 50, 50 ) );
					break;

			} // end switch

		} // endif
	
	} // end function custom_columns
	
	
	
} // end class AdminCustomColumnsVCWP