<?php
/**
 * File Name post-meta-meta.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.1
 * @updated 04.03.13
 *
 * Description:
 * This file is not included with theme load. The function found here can be used filter options-vc class
 **/
#################################################################################################### */


####################################################################################################
/**
 * Add filtering for additional post meta
 **/
####################################################################################################






/**
 * Add Settings Field
 * 
 * @version	0.0.1
 * @updated 02.15.12
 **/
function add_actions_for_meta_boxes( $id, $post_types ) {
	
	foreach ( $post_types as $post_type ) {
		
		add_action( "$id-$post_type-add_settings_field", array( &$this, 'add_settings_field' ), 10, 2 );
		add_action( "$id-$post_type-sanitize-post_meta", array( &$this, 'sanitize_callback' ), 10, 2 );
		
	}

} // end function add_actions_for_options






/**
 * Add Settings Field
 * 
 * @version	0.0.1
 * @updated 02.15.12
 **/
function add_settings_field( $field, $metabox ) {
	
	switch ( $field['type'] ) {

		case "blank" :
			
			break;

	}

} // end function add_settings_field






/**
 * Sanitize Callback
 * 
 * @version	0.0.1
 * @updated 02.15.12
 **/
function sanitize_callback( $new_instance, $post_meta ) {

	switch ( $post_meta['validation'] ) {

		case "list_songs" :
			$new_instance = "$new_instance-blank";
			break;

	}

	return $new_instance;

} // end function sanitize_callback






/**
 * Create Post meta form, Meta box content
 * 
 * @version	0.0.1
 * @updated 02.15.12
 **/
function custom_meta_box_option( $options, $metabox ) {

	// Custom Form fields

} // end function custom_meta_box