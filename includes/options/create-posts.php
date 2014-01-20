<?php
/**
 * File Name -- Depreciated -- create-posts.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.4
 * @updated 05.30.13
 *
 * Depreciated in favor of CreatePostsVCWP
 **/
#################################################################################################### */


if ( class_exists( 'Create_Posts_VC' ) ) return;

/* $default_posts = array(
	array(
		'id' => 'post-identifier', // used as an array key in stored option
		'post_meta' => array(
			'meta_key' => 'meta_value',
			),
		'options' => array(
			'option_name' => 'option_value', // retrievalbe as $option_name-{option_name}
			),
		'post' => array( // post array
			'post_title' => 'My Post',
			'post_content' => '',
			'post_status' => 'draft',
			'post_author' => 1,
			'post_type' => 'post',
			),
		),
		*/





/**
 * Create_Posts_VC Class
 *
 * @version 0.0.1
 * @updated 05.23.12
 **/
class Create_Posts_VC {
	
	
	
	
	
	
	/**
	 * Initiate Create Posts
	 *
	 * @version 0.0.1
	 * @updated 05.23.12
	 **/
	function init_create_posts( $posts, $option_name = 'vc-default', $option_sufix = false ) {
		
		// Init Check
		if ( $this->has_been_created( $option_name, $option_sufix ) )
			return false;


		// Create Posts
		$this->create_posts( apply_filters( "$option_name-account_default_posts", $posts ), $option_name, $option_sufix );
		
		
	} // end function function init_create_posts
	
	
	
	
	
	
	/**
	 * Create Posts
	 *
	 * @version 0.0.1
	 * @updated 05.23.12
	 **/
	function has_been_created( $option_name, $option_sufix = false ) {
		
		if ( get_option( "$option_name-default_posts-$option_sufix" ) )
			return true;
		else
			return false;
		
	} // end function has_been_created
	
	
	
	
	
	
	/**
	 * Confirm Creation
	 *
	 * @version 0.0.1
	 * @updated 05.23.12
	 **/
	function confirm_creation( $inserted_post_ids, $option_name, $option_sufix = false ) {
		
		if ( update_option( "$option_name-default_posts-$option_sufix", $inserted_post_ids ) )
			return true;
		else
			return false;
		
	} // end function confirm_creation
	
	
	
	
	
	
	/**
	 * Create Posts
	 *
	 * @version 0.3
	 * @updated 06.28.12
	 **/
	function create_posts( $posts, $option_name, $option_sufix = false, $do_confirmation = true, $force_insert = false ) {
		
		
		$inserted_post_ids = $this->insert_posts( $posts, $option_name, $force_insert );
		
		// Confirm Creation
		if ( $do_confirmation AND $inserted_post_ids )
			$this->is_confirmed = $this->confirm_creation( $inserted_post_ids, $option_name, $option_sufix );
		
		return $inserted_post_ids;
		
	} // end function create_posts
	
	
	
	
	
	
	/**
	 * Insert Posts
	 *
	 * @version 0.2
	 * @updated 06.19.12
	 * 
	 * @param $force_insert is used to for a new post to be created 
	 * even if a post with the same post_name exists.
	 **/
	function insert_posts( $posts, $option_name, $force_insert = false ) {
		
		// Loop insert posts
		foreach ( $posts as $post ) {
			
			if ( $this->has_post_type( $post['post'] ) AND $this->has_post_title( $post['post'] ) ) {
				
				$post = $this->prep_post_data( $post );
				
				if ( ! $force_insert AND $post_id = $this->check_for_post_existance( $post['post']['post_name'], $post['post']['post_type'] ) )
					$post['post']['ID'] = $post_id;
				
				$post_id = wp_insert_post( $post['post'] );
				
				if ( $post_id > 0 ) {
					
					$inserted_post_ids[$post['post']['post_name']] = $post_id;
					
					$this->after_insert_posts( $post_id, $post, $option_name );
					
				}
				
				
			} // end if ( has_post_type AND has_post_title )
			
			$i++;
		} // end foreach ( $posts as $val )
		
		return $inserted_post_ids;
		
	} // end function insert_posts
	
	
	
	
	
	
	/**
	 * Prep Posts Data
	 *
	 * @version 0.0.1
	 * @updated 05.23.12
	 **/
	function prep_post_data( $post ) {
		
		if ( ! isset( $post['post']['post_name'] ) OR empty( $post['post']['post_name'] ) )
			$post['post']['post_name'] = sanitize_title_with_dashes( $post['post']['post_title'] );
		
		// Post Status
		if ( ! isset( $post['post']['post_status'] ) OR empty( $post['post']['post_status'] ) )
			$post['post']['post_status'] = 'draft';
		
		// Comments Setting
		if ( ! isset( $post['post']['comment_status'] ) OR empty( $post['post']['comment_status'] ) )
			$post['post']['comment_status'] = 'closed';
		
		
		return $post;
		
	} // end function prep_post_data
	
	
	
	
	
	
	/**
	 * Check for post Existence
	 *
	 * @version 0.0.1
	 * @updated 05.23.12
	 **/
	function check_for_post_existance( $post_name, $post_type ) {
		global $wpdb;

		// Set post_name
		$post_name = sanitize_title_with_dashes( $post_name );

		// Query DB
		$querystr = "	SELECT $wpdb->posts.ID
						FROM $wpdb->posts

						WHERE 
							$wpdb->posts.post_name = '$post_name' AND 
							$wpdb->posts.post_type = '$post_type' AND
							$wpdb->posts.post_status = 'publish' 
						";

		$results = $wpdb->get_results( $querystr );

		// Return results
		if ( isset( $results[0]->ID ) AND is_numeric( $results[0]->ID ) )
			return $results[0]->ID;
		else
			return false;

	} // end function check_for_post_existance
	
	
	
	
	
	
	####################################################################################################
	/**
	 * After Insert Post
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Insert Posts
	 *
	 * @version 0.0.1
	 * @updated 05.23.12
	 **/
	function after_insert_posts( $post_id, $post, $option_name = false ) {
		
		if ( is_array( $post['post_meta'] ) AND ! empty( $post['post_meta'] ) ) 
			$this->add_post_meta( $post_id, $post['post_meta'] );
		
		if ( is_array( $post['options'] ) AND ! empty( $post['options'] ) ) 
			$this->add_post_options( $post_id, $post['options'], $option_name );
		
	} // end function after_insert_posts
	
	
	
	
	
	
	/**
	 * Add Post Meta
	 *
	 * @version 0.0.1
	 * @updated 05.23.12
	 **/
	function add_post_meta( $post_id, $post_meta ) {
		
		if ( is_array( $post_meta ) AND ! empty( $post_meta ) ) {
			
			foreach ( $post_meta as $key => $val ) {
				update_post_meta( $post_id, $key, $val );
			}
			
		}
		
	} // end function add_post_meta
	
	
	
	
	
	
	/**
	 * Add Post Options
	 *
	 * @version 0.0.1
	 * @updated 05.23.12
	 **/
	function add_post_options( $post_id, $post_options, $option_name = false ) {
		
		if ( is_array( $post_options ) AND ! empty( $post_options ) ) {
			
			foreach ( $post_options as $key => $val ) {
				
				if ( $option_name )
					$option_name = "$option_name-$key";
				else
					$option_name = $key;
					
				update_post_meta( $post_id, $option_name, $val );
			}
			
		}
		
	} // end function add_post_options
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Has Post Type
	 *
	 * @version 0.0.1
	 * @updated 05.23.12
	 **/
	function has_post_type( $post ) {
		
		if ( isset( $post['post_type'] ) AND !empty( $post['post_type'] ) )
			return true;
		else
			return false;
		
	} // end function has_post_type
	
	
	
	
	
	
	/**
	 * Has Post Type
	 *
	 * @version 0.0.1
	 * @updated 05.23.12
	 **/
	function has_post_title( $post ) {
		
		if ( isset( $post['post_title'] ) AND !empty( $post['post_title'] ) )
			return true;
		else
			return false;
		
	} // end function has_post_type
	
	
	
} // end class Create_Posts_VC