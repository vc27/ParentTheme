<?php
/**
 * File Name -- Depreciated -- forms-validation.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.7
 * @updated 06.22.13
 *
 * Depreciated in favor of SanitizeValueVCWP & FormFieldsVCWP
 **/
#################################################################################################### */





if ( ! function_exists( 'form_fields_vc' ) ) {

/**
 * Form Fields VC
 * 
 * @version 1.5
 * @updated 05.15.13
 **/
function form_fields_vc( $type, $name, $val, $id = false, $class = false, $desc = false, $options = false, $action = false, $action_args2 = false ) {
	
	return form__field(  $type, $name, $val, $id, $class, $desc, $options, $action, $action_args2 );
	
	/* 
	
	== Depreciated ==
	
	// Set default value is it exists
	if ( empty( $val ) AND !empty( $action_args2['val'] ) )
		$val = $action_args2['val'];
	else if ( empty( $val ) )
		$val = false;
	
	switch ( $type ) {
		
		case "paragraph-text" :
			if ( $desc ) echo "<p class=\"description $class\">$desc</p>";
			break;
		case "text" :
			echo "<input type=\"text\" name=\"$name\" value=\"$val\" id=\"$id\" class=\"large-text $class\"";
				if ( isset( $action_args2['minlength'] ) AND is_numeric( $action_args2['minlength'] ) AND $action_args2['minlength'] > 1 )
					echo " minlength=\"" . $action_args2['minlength'] . "\"";
				echo ">";
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
		case "password" :
			echo "<input type=\"password\" name=\"$name\" value=\"$val\" id=\"$id\" class=\"large-text $class\">";
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
		case "text_multi" :
			if ( is_numeric( $action_args2['count'] ) ) {
				$count = $action_args2['count'] - 1;
				if ( $desc ) echo "<p class=\"description\">$desc</p>";
				echo "<div class=\"vc-sortable-wrap\"><ul id=\"text-multi-$name\" class=\"text-multi multi-sortable\" data-save_name=\"$name\" data-switch-case=\"sortable-metadata\" data-nonce=\"" . wp_create_nonce( 'vc-admin-ajax' ) . "\">";
				for ( $i = 0; $i <= $count; $i++ ) {
					echo "<li id=\"$name-sort-$i\"><span class=\"sort-handle\"></span><input type=\"text\" name=\"" . $name . "[]\" value=\"" . $val[$i] . "\" id=\"$name-$i\" class=\"large-text $class\"></li>";
				}
				echo "</ul></div>";
			}
			break;
		case "text_explain" :
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
		case "button" :
			echo "<p>";
			echo "<input class=\"button\" type=\"button\" name=\"$name\" value=\"" . $options['button_val'] . "\"";
				if ( is_array( $options['data_attr'] ) AND ! empty( $options['data_attr'] ) ) {
					foreach ( $options['data_attr'] as $key => $attr )
						echo "data-$key=\"$attr\" ";
				}
			 	echo "/> ";
			if ( $desc ) echo $desc;
			echo "</p>";
			break;
		case "hidden" :
			echo "<input type=\"hidden\" name=\"$name\" value=\"$val\" id=\"$id\">";
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
		case "text_editor" :
			$options['textarea_name'] = $name;
			
			// Removed 01.19.13 - this may cause some conflict with existing fields.
			// $name = sanitize_title_with_dashes( $name );
			
			wp_editor( $val, $name, $options );
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
		case "simple_text_editor" :
			wp_editor( $val, $name, array(
				'textarea_name' => $name,
				'textarea_rows' => 8,
				'media_buttons' => false,
				'tinymce' => false, // Disables actual TinyMCE buttons // This makes the rich content editor
				'quicktags' => true // Use QuickTags for formatting    // work within a metabox.
				) );
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
			break;
		case "textarea" :
			echo "<textarea style=\"height:250px;\" name=\"$name\" id=\"$id\" class=\"large-text\">$val</textarea>";
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
		case "checkbox" :
			echo "<p><input type=\"checkbox\" name=\"$name\" id=\"$id\" class=\"\" "; checked( $val, 'on' ); echo ">";
			if ( $desc ) echo "&nbsp;&nbsp;&nbsp;<span class=\"description\">$desc</span>";
			echo "</p>";
			break;
		case "multi_checkbox" :
			if ( is_array( $options ) AND !empty( $options ) ) { 
				$i = 0;
				foreach ( $options as $checkbox_key => $checkbox_val ) {
					$i++;
					( is_array( $val ) AND in_array( $checkbox_val, $val ) ) ? $is_checked = true : $is_checked = false;
					echo "<input style=\"width:auto !important\" type=\"checkbox\" name=\"" . $name . "[$checkbox_key]\" id=\"$id-$i\" value=\"$checkbox_val\" class=\"\" "; checked( $is_checked, true ); echo ">&nbsp;$checkbox_val<br />";
				}
			}
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
		case "radio" :
			if ( is_array( $options ) AND !empty( $options ) ) {	
				$i = 0;
				foreach ( $options as $radio_key => $radio_val ) {
					$i++;
					echo "<input type=\"radio\" name=\"$name\" id=\"$id-$i\" class=\"" . $field['option_block_id'] . "-$id\" value=\"$radio_key\" "; checked( $val, $radio_key ); echo ">&nbsp;$radio_val<br />";	
				}
			}				
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
		case "select" :
			if ( is_array( $options ) AND !empty( $options ) ) {
				
				echo "<select id=\"$id\" name=\"$name\">";
					
					foreach ( $options as $sel_key => $sel_val ) {

						if ( $sel_val == $val )
							$sel = 'selected="selected"';
						else
							$sel = '';
						echo "<option $sel value=\"$sel_val\">$sel_key</option>";
					}
				
				echo "</select>";
				if ( $desc ) echo "<p class=\"description\">$desc</p>";
				
			} else {
				return;
			}
			break;
		case "upload" :
			
			if ( ! $val AND isset( $action_args2['defalut_image'] ) )
				$val = $action_args2['defalut_image'];
			
			$formfield = sanitize_title_with_dashes( $id ) . "-upload";
			
			if ( ! $button_text = $options['button_text'] )
				$button_text = "Add a File";
			
			echo "<input type=\"text\" id=\"$formfield\" class=\"media-upload-vc\" name=\"$name\" value=\"$val\">";
			echo "<input data-formfield=\"$formfield\" style=\"width:auto !important; display:inline-block !important;\" type=\"button\" class=\"button media-upload-button-vc\" value=\"$button_text\">";
			echo "<p class=\"description\">$desc Uploading a file will require you to copy and past the file url into the text field.</p>";
			
			break;
		case "image" :
			
			if ( ! $val AND isset( $action_args2['defalut_image'] ) )
				$val = $action_args2['defalut_image'];
			
			$formfield = sanitize_title_with_dashes( $id ) . "-image";
			
			if ( ! $button_text = $options['button_text'] )
				$button_text = "Add an Image";
			
			echo "<input type=\"text\" id=\"$formfield\" class=\"media-upload-vc\" name=\"$name\" value=\"$val\">";
			echo "<input data-formfield=\"$formfield\" style=\"width:auto !important; display:inline-block !important;\" type=\"button\" class=\"button media-upload-button-vc\" value=\"$button_text\">";
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			echo "<p class=\"description $formfield\">";
				if ( $val )
					echo "<img src=\"$val\" alt=\"\" style=\"max-height:150px;width:auto;\" />";
			echo "</p>";
			
			break;
		case "image_multi" :
			
			if ( is_numeric( $action_args2['count'] ) ) {
				$count = $action_args2['count'] - 1;
				if ( $desc ) echo "<p class=\"description\">$desc</p>";
				echo "<div class=\"vc-sortable-wrap\">";
					echo "<ul id=\"image-multi-$name\" class=\"image-multi multi-sortable\" data-save_name=\"$name\" data-switch-case=\"sortable-metadata\" data-nonce=\"" . wp_create_nonce( 'vc-admin-ajax' ) . "\">";
						for ( $i = 0; $i <= $count; $i++ ) {
							echo "<li id=\"$name-sort-$i\">";
								echo "<span class=\"sort-handle\"></span>";
								
								$formfield = sanitize_title_with_dashes( $id ) . "-image";

								if ( ! $button_text = $options['button_text'] )
									$button_text = "Add an Image";

								echo "<input type=\"text\" id=\"$formfield-$i\" class=\"media-upload-vc\" name=\"" . $name . "[]\" value=\"" . $val[$i] . "\">";
								echo "<input data-formfield=\"$formfield-$i\" style=\"width:auto !important; display:inline-block !important;\" type=\"button\" class=\"button media-upload-button-vc\" value=\"$button_text\">";
								
								echo "<p class=\"description $formfield-$i\">";
									if ( $val[$i] )
										echo "<img src=\"" . $val[$i] . "\" alt=\"\" style=\"max-height:150px;width:auto;\" />";
								echo "</p>";
								
								
							echo "</li>";
						}
					echo "</ul>";
				echo "</div>";
			}
			
			break;
		case "custom_menu" :
			$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

			// If no menus exists, direct the user to go and create some.
			if ( !$menus ) {
				echo '<p class="description">'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			} else {
				echo "<select id=\"$id\" name=\"$name\">";
					echo "<option value=\"\">Select a Menu</option>";
					
					foreach ( $menus as $menu ) {
						
						if ( $menu->term_id == $val )
							$sel = 'selected="selected"';
						else
							$sel = '';
						
						echo "<option $sel value=\"$menu->term_id\">$menu->name</option>";
						
					}
				
				echo "</select>";
			}
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
		case "select_post_type" :
			$post_types = get_post_types( array( 'public' => true ) );
			unset( $post_types['attachment'] );
			
			$post_types = apply_filters( 'form_fields_vc-select_post_type', $post_types );
			
			echo "<select id=\"$id\" name=\"$name\">";
				echo "<option value=\"\">Select a Post Type</option>";
				
				foreach ( $post_types as $post_type ) {
					
					$post_type_object = get_post_type_object( $post_type );
					
					if ( $post_type == $val )
						$sel = 'selected="selected"';
					else
						$sel = '';
					
					echo "<option $sel value=\"$post_type\">" . $post_type_object->labels->singular_name . "</option>";
					
				}
			
			echo "</select>";
			
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
		case "select_post_status" :
			
			$post_statuses = apply_filters( 'form_fields_vc-select_post_status', array( 'Publish' => 'publish', 'Draft' => 'draft', 'Private' => 'private' ) );
			
			echo "<select id=\"$id\" name=\"$name\">";
				echo "<option value=\"\">Select a Post Status</option>";
				
				foreach ( $post_statuses as $key => $post_status ) {
					
					if ( $post_status == $val )
						$sel = 'selected="selected"';
					else
						$sel = '';
					
					echo "<option $sel value=\"$post_status\">$key</option>";
					
				}
			
			echo "</select>";
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
		case "select_comment_status" :
			$comment_statuses = apply_filters( 'form_fields_vc-select_comment_status', array( 'Open' => 'open', 'Closed' => 'closed' ) );
			
			echo "<select id=\"$id\" name=\"$name\">";
				echo "<option value=\"\">Select a Comment Status</option>";
				
				foreach ( $comment_statuses as $key => $comment_status ) {
					
					if ( $comment_status == $val )
						$sel = 'selected="selected"';
					else
						$sel = '';
					
					echo "<option $sel value=\"$comment_status\">$key</option>";
					
				}
			
			echo "</select>";
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
		case "select_post_author" :
			
			$get_user_args = apply_filters( 'form_fields_vc-select_post_author-args', array() );
			$users = get_users( $get_user_args );
			
			echo "<select id=\"$id\" name=\"$name\">";
				echo "<option value=\"\">Select a Post Author</option>";
				
				foreach ( $users as $user ) {
					
					if ( user_can( $user->ID, 'delete_posts' ) ) {
						
						if ( $user->ID == $val )
							$sel = 'selected="selected"';
						else
							$sel = '';

						echo "<option $sel value=\"$user->ID\">$user->display_name</option>";
						
					}
					
				}
			
			echo "</select>";
			
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
		case "featured_image" :
			Featured_Images_Post_Type_VC::form_select( array(
				'val' => $val,
				'id' => $id,
				'name' => $name,
				) );
			
			if ( $desc ) echo "<p class=\"description\">$desc</p>";
			break;
		default :
			if ( $action ) do_action( $action, array( 'type' => $type, 'name' => $name, 'val' => $val, 'id' => $id, 'class' => $class, 'desc' => $desc, 'options' => $options ), $action_args2 );
			break;
		
	} // end switch ( $type )
	
	
	== End Depreciated ==
	
	*/
	
} // end function form_fields_vc

} // end if ( ! function_exists( 'form_fields_vc' ) )





if ( ! function_exists( 'sanitize_value_vc' ) ) {
/**
 * Data Sanitization
 * 
 * @version 1.2
 * @updated 05.15.13
 *
 * Unfinished
 * Todo:
 * Add case for each type of form field.
 **/
function sanitize_value_vc( $type, $value, $filter = false, $filter_args2 = false ) {
	
	return sanitize__value( $type, $value, $filter, $filter_args2 );
	
	/*
	
	== Depreciated ==
	
	
	switch ( $type ) {
		
		case "password" :
		case "text_only" :
			return strip_tags( stripslashes( $value ) );
		case "text_multi" :
			if ( is_array( $value ) ) {
				foreach ( $value as $key => $val ) {
					$output[$key] = esc_html( stripslashes( $val ) );
				}
				return $output;
			} else {
				return false;
			}
			break;
		case "text" :
			return esc_html( stripslashes( $value ) );
			break;
		case "textarea" :
			return esc_html( stripslashes( $value ) );
			break;
		case "text_editor" :
			// print_r($value); die();
			return stripslashes( $value );
			break;
		case "checkbox" :
			
			if ( $value == '' )
				return false;
			else if ( $value == 'on' )
				return 'on';
				
			break;
		case "multi_checkbox" :
			return $value;
			if ( is_array( $value ) AND ! empty( $value ) )
				return array_filter( $value );
			else
				return false;
			break;
		case "radio" :
			
			if ( $value == '' )
				return false;
			else
				return $value;
				
			break;
		case "numeric" :
			return (int)$value;
			break;
		case "select" :
			if ( $value != '' )
				return $value;
			break;
		case "upload" :
		case "image" :
			return strip_tags( stripslashes( $value ) );
			break;
		case "image_multi" :
			if ( is_array( $value ) ) {
				foreach ( $value as $key => $val ) {
				    if ( !empty( $val ) )
					    $output[$key] = strip_tags( stripslashes( $val ) );
				}
				return $output;
			} else {
				return false;
			}
			break;
		case "email" :
			if ( is_email( $value ) )
				return $value;
			else
				return false;
			break;
		default :
			if ( $filter )
				return apply_filters( $filter, $value, $filter_args2 );
			else
				return false;
			break;
		
	} // end switch ( $option_args['validation'] )
	
	== End Depreciated ==
	
	*/
	
} // end function sanitize_value_vc

} // end if ( ! function_exists( 'sanitize_value_vc' ) )