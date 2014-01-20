<?php
/**
 * File Name -- Depreciated -- post-meta.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.1
 * @updated 03.12.13
 * 
 * Depreciated in favor of PostMetaVCWP
 **/
#################################################################################################### */


if ( class_exists( 'Post_Meta_VC' ) ) return;


/* 
$default_metabox = array(
	'id' => 'special_meta_box_test', // required
	'title' => 'Testing', 
	'context' => 'side', // options: normal, side
	'priority' => 'default', // ('high', 'core', 'default' or 'low')
	'desc' => 'my metabox desc',
	// 'save_action' => false, // defaults to 'save_post'
	'post_meta' => array( // array of post_meta fields
		array(
			'type' => 'text',
			'validation' => 'text',
			'title' => 'test 1',
			'name' => '_test_1', // post_meta name and field name
			'options' => false, // used for radio, checkbox, select
			'val' => false, // Default starting value
			'desc' => 'my cool description',
			),
		),
	);
*/


/**
 * Post_Meta_VC Class
 *
 * @version 0.0.2
 * @updated 03.24.12
 **/
class Post_Meta_VC {
	
	
	
	/**
	 * Post_Meta_VC Construct
	 **/
	function Post_Meta_VC( $post_types = array(), $metabox = false ) {
		
		if ( empty( $post_types ) AND ! $metabox ) return;
		
		$this->included_post_types = $post_types;
		$this->metabox = $metabox;
		
		// Add Custom Meta Boxes
		add_action( 'add_meta_boxes', array( &$this, 'add_custom_meta_boxes' ) );
		
		// Save Post
		add_action( 'save_post', array( &$this, 'save_post_meta' ), 10, 2 );
		
		
		
	} // end function Post_Meta_VC
	
	
	
	
	
	
	/**
	 * Add Custom Fields Meta Boxes
	 *
	 * @uses add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );
	 *
	 * @version 0.0.1
	 * @updated 02.18.12
	 **/
	function add_custom_meta_boxes( $post ) {
		
		// Filter post_types array to allow other post_type's to utilize this metabox
		$this->included_post_types = apply_filters( $this->metabox['id'] . "-included_post_types", $this->included_post_types );
		
		if ( ! isset( $this->metabox['callback'] ) OR $this->metabox['callback'] == false )
			$this->metabox['callback'] = array( &$this, 'meta_box' );
		
		foreach ( $this->included_post_types as $post_type )
			add_meta_box( $this->metabox['id'], $this->metabox['title'], $this->metabox['callback'], $post_type, $this->metabox['context'], $this->metabox['priority'], $this->metabox );
		
		
	} // end function add_custom_meta_boxes
	
	
	
	
	
	
	/**
	 * Custom Page Meta
	 *
	 * @version 1.5
	 * @updated 01.19.13
	 **/
	function meta_box( $post, $metabox ) {
		
		if ( is_array( $metabox ) AND !empty( $metabox ) ) {
			
			// Set Meta Box Description
			if ( isset( $metabox['args']['desc'] ) and ! empty( $metabox['args']['desc'] ) ) 
				echo "<p class=\"description\">" . $metabox['args']['desc'] . "</p>";
			
			// 'normal', 'advanced', or 'side'
			switch ( $metabox['args']['context'] ) {
				
				case "side" :
					// Loop through fields
					foreach ( $metabox['args']['post_meta'] as $post_meta ) {
						
						// Desc
						if ( isset( $post_meta['desc'] ) AND ! empty( $post_meta['desc'] ) ) {
							$desc = $post_meta['desc'];
						} else {
							$desc = false;
						}
						
						// Name
						if ( isset( $post_meta['name'] ) AND ! empty( $post_meta['name'] ) ) {
							$name = $post_meta['name'];
						} else {
							$name = false;
						}
						
						// Options
						if ( isset( $post_meta['options'] ) AND ! empty( $post_meta['options'] ) ) {
							$options = $post_meta['options'];
						} else {
							$options = false;
						}
						
						$value = get_post_meta( $post->ID, $name, true );
						
						echo $this->before_form_fields( $post_meta, $metabox );
						
						form_fields_vc( $post_meta['type'], $name, $value, $name, false, $desc, $options, $metabox['id'] . "-$post->post_type-add_settings_field", $post_meta );
						
						echo $this->after_form_fields( $post_meta, $metabox );
						
					} // end foreach ( $metabox['args']['post_meta'] )
					break;
				case "normal" :
				case "advanced" :
				default :
					echo "<table class=\"form-table\">";
						// Loop through fields
						foreach ( $metabox['args']['post_meta'] as $post_meta ) {
							
							// Name
							if ( isset( $post_meta['name'] ) AND ! empty( $post_meta['name'] ) ) {
								$name = $post_meta['name'];
							} else {
								$name = false;
							}
							
							// Options
							if ( isset( $post_meta['options'] ) AND ! empty( $post_meta['options'] ) ) {
								$options = $post_meta['options'];
							} else {
								$options = false;
							}
							
							// Desc
							if ( isset( $post_meta['desc'] ) AND ! empty( $post_meta['desc'] ) ) {
								$desc = $post_meta['desc'];
							} else {
								$desc = false;
							}
							
							$value = get_post_meta( $post->ID, $name, true );
							
							echo $this->before_form_fields( $post_meta, $metabox );
								
							form_fields_vc( $post_meta['type'], $name, $value, $name, false, $desc, $options, $metabox['id'] . "-$post->post_type-add_settings_field", $post_meta );
							
							echo $this->after_form_fields( $post_meta, $metabox );
							
						} // end foreach ( $metabox['args']['post_meta'] )
					echo "</table>";
					break;
				
			} // end switch ( $metabox['args']['context'] )
			
		}

		echo "<input type=\"hidden\" name=\"$post->post_type-nonce\" value=\"" . wp_create_nonce( "$post->post_type-nonce" ) . "\" />";
		
	} // end function vc_custom_page_meta
	
	
	
	
	
	
	/**
	 * Sanitize Post Meta
	 *
	 * @version 1.5
	 * @updated 01.19.13
	 **/
	function sanitize_post_meta( $new_instance, $post ) {
		
		foreach ( $this->metabox['post_meta'] as $post_meta ) {
			
			if ( isset( $post_meta['name'] ) AND ! empty( $post_meta['name'] ) AND isset( $new_instance[$post_meta['name']] ) AND ! empty( $new_instance[$post_meta['name']] ) ) {
				$instance[$post_meta['name']] = sanitize__value( $post_meta['validation'], $new_instance[$post_meta['name']], $this->metabox['id'] . "-$post->post_type-sanitize-post_meta", $post_meta );
			}
			
			if ( isset( $post_meta['name'] ) AND ! empty( $post_meta['name'] ) AND ( ! isset( $new_instance[$post_meta['name']] ) OR empty( $new_instance[$post_meta['name']] ) ) )
				$instance[$post_meta['name']] = false;
			
		}
		
		return apply_filters( "sanitize_post_meta-$post->post_type", $instance );
		
	} // end function sanitize_post_meta
	
	
	
	
	
	
	/**
	 * Update post_meta on save_post
	 *
	 * @version 1.4
	 * @updated 03.12.13
	 **/
	function save_post_meta( $post_id, $post ) {
		
		// Varify nonce
		if ( isset( $_POST["$post->post_type-nonce"] ) AND ! empty( $_POST["$post->post_type-nonce"] ) AND ! wp_verify_nonce( $_POST["$post->post_type-nonce"], "$post->post_type-nonce" ) )
			return $post_id;
		
		// wp_die('post-meta-vc.php save_post_meta');
		// Return if doing autosave
		if ( defined('DOING_AUTOSAVE') AND DOING_AUTOSAVE ) 
			return $post_id;
		
		
		if ( defined('DOING_AJAX') AND DOING_AJAX )
			return $post_id;
		
		
		// Restrict User
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
			
		
		// New
		$new_instance = $this->sanitize_post_meta( $_POST, $post );
		
		if ( is_array( $new_instance ) ) {
			foreach ( $new_instance as $key => $val ) {

				$old = get_post_meta( $post_id, $key, true );
				if ( !empty( $val ) )
					update_post_meta( $post_id, $key, $val, $old );
				elseif ( empty( $val ) )
					delete_post_meta( $post_id, $key, $val);

			} // end foreach ( $new as $key => $val )
		}
		
		
	} // end function save_post_meta
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Helper Functions
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Before form_fields
	 *
	 * @version 1.5
	 * @updated 01.22.13
	 **/
	function before_form_fields( $post_meta, $metabox ) {
		
		// 'normal', 'advanced', or 'side'
		switch ( $metabox['args']['context'] ) {
			
			case "side" :
				if ( $post_meta['type'] == 'title' ) {
					$output = "<div class=\"form-field-vc\"><h4>" . $post_meta['title'] . "</h4>";
					if ( $post_meta['desc'] ) $output .= "<p>" . $post_meta['desc'] . "</p>";
				} else {
					$output = "<div class=\"form-field-vc\">" . $post_meta['title'] . "&nbsp;";
				}
				break;
			case "normal" :
			case "advanced" :
			default :
				if ( $post_meta['type'] == 'title' ) {
					$output = "</table><h4>" . $post_meta['title'] . "</h4>";
					if ( $post_meta['desc'] ) $output .= "<p>" . $post_meta['desc'] . "</p>";
					$output .= "<table class=\"form-table\">";
				} else if ( in_array( $post_meta['type'], array( 'text_editor', 'simple_text_editor' ) ) ) {
					$output = "</table><h4>" . $post_meta['title'] . "</h4><div class=\"text-editor-wrap\">";
				} else {
					$output = "<tr class=\"form-field\"><th scope=\"row\" valign=\"top\">" . $post_meta['title'] . "</th><td>";
				}
				break;
			
		} // end switch ( $metabox['args']['context'] )
		
		return $output;
		
	} // end function before_form_fields
	
	
	
	
	
	
	/**
	 * After form_fields
	 *
	 * @version 1.5
	 * @updated 01.22.13
	 **/
	function after_form_fields( $post_meta, $metabox ) {
		
		// 'normal', 'advanced', or 'side'
		switch ( $metabox['args']['context'] ) {
			
			case "side" :
				$output = "</div>";
				break;
			case "normal" :
			case "advanced" :
			default :
				if ( in_array( $post_meta['type'], array( 'text_editor', 'simple_text_editor' ) ) )
					$output = "</div><table class=\"form-table\">";
				else
					$output = "</td></tr>";
				break;
			
		} // end switch ( $metabox['args']['context'] )
		
		return $output;
		
	} // end function after_form_fields
	
	
	
} // end class Post_Meta_VC