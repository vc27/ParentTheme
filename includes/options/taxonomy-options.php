<?php
/**
 * File Name taxonomy-options.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.5
 * @updated 04.03.13
 * 
 * Description:
 * Taxonomy option child class adds functionality for adding options to taxonomy manage pages.
 **/
#################################################################################################### */



/**
 * Taxonomy_Options_VC Class
 *
 * @version 1.2
 * @updated 11.17.12
 **/
$Taxonomy_Options_VC = new Taxonomy_Options_VC();
class Taxonomy_Options_VC {
	
	
	
	/**
	 * __construct
	 * 
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {
		
		add_action( 'admin_init', array( &$this, 'init' ) );
		
	} // end function __construct
	
	
	
	
	
	
	/**
	 * Init
	 * 
	 * @version 1.2
	 * @updated 11.17.12
	 **/
	function init() {
				
		
		// Set Options
		$this->option_name = '_vc_general_options';
		$this->option_group = 'vc_general_options';
		$this->options = get_option( $this->option_name );
		
		
		// Category Options
		$this->cat_options_name = "$this->option_name-tax_category";
		$this->update_cat_options();
		$this->cat_options = get_option( $this->cat_options_name );
		
		if ( !is_array( $this->cat_options ) )
			$this->cat_options = array();
		
		
		
		
		/**
		 * Add Taxonomy Management
		 **/
		
		// Update Category Option
		$this->update_tax_category_options();
		
		// Category Admin
		add_action( 'category_edit_form', array( &$this, 'category_form_fields' ) );
		
		
		
	} // end function Taxonomy_Options_VC
	
	
	
	
	
	
	/**
	 * Adds an image field to individual category editing pages.
	 *
	 * @version 1.3
	 * @updated 11.17.12
	 **/
	function category_form_fields( $taxonomy ) {
		
		?>
		<table class="form-table">
			
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="category-image">Category Image</label>
					<?php 
					if ( !empty( $this->cat_options[$taxonomy->term_id]['image']['url'] ) )
						echo "<img style=\"max-width:100px;max-height:75px;\" src=\"" . $this->cat_options[$taxonomy->term_id]['image']['url'] . "\" alt=\"\" />";

					?>
				</th>
				<td>
					<input id="category-image" type="text" name="<?php echo $this->cat_options_name; ?>[<?php echo $taxonomy->term_id; ?>][image][url]" value="<?php if ( isset( $this->cat_options[$taxonomy->term_id]['image']['url'] ) ) echo $this->cat_options[$taxonomy->term_id]['image']['url']; ?>" />
					<p class="description"><?php _e('This is the Featured Image for this Category.'); vc_media_link(); ?></p>
				</td>
			</tr>
		</table>

		<input name="vc_category_term_id" type="hidden" value="<?php echo $taxonomy->term_id; ?>" />
		<?php

	} // end function vc_add_category_form_fields






	/** 
	 * Update Options
	 *
	 * @version 1.3
	 * @updated 11.17.12
	 **/
	function update_tax_category_options() {

		if ( isset( $_POST[$this->cat_options_name] ) AND isset( $_POST['vc_category_term_id'] ) ) {

			$this->cat_options[$_POST['vc_category_term_id']] = $_POST[$this->cat_options_name][$_POST['vc_category_term_id']];
			update_option( $this->cat_options_name, $this->cat_options );

		}


	} // end function vc_update_options_category_tax_options
	
	
	
	
	
	
	/**
	 * Update Old Category Options
	 *
	 * @version 1.2
	 * @updated 11.17.12
	 **/
	function update_cat_options() {
		
		if ( isset( $this->options['updates']['tax_category-options'] ) AND ! $this->options['updates']['tax_category-options'] ) {
			
			$old_options	= get_option('_vc_cat_general_options');
			$updated		= update_option( $this->cat_options_name, $old_options );
			
			$this->options['updates']['tax_category-options'] = 1;
			update_option( $this->option_name, $this->options );
		
		} // end if ( !$this->options['tax_category-options_updated'] )
		
		
		
	} // function update_cat_options
	
	
	
} // end class Taxonomy_Options_VC