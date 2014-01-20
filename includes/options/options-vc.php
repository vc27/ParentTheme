<?php
/**
 * File Name  -- Depreciated -- options-vc.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 3.5.5
 * @version 1.8
 * @updated 05.29.13
 * 
 * Depreciated in favor of OptionPageVCWP
 **/
####################################################################################################

if ( class_exists( 'Options_VC' ) ) return;


/**
 * Default Settings Array
 *
 * Description:
 * This array translates to settings, metaboxes & an options array.
 **/

/*
$Options_VC = new Options_VC( array(

	'version' => '0.2',

	'option_name' => '_azza_options',
	'option_group' => 'azza_options',

	'add_submenu_page' => array(
		'parent_slug' => 'edit.php?post_type=azza',
		'page_title' => 'Azza Options',
		'menu_title' => 'Azza Options',
		'capability' => 'administrator',
		),

	// 'options_page_title' => false,
	'options_page_desc' => 'Options page description and general information here.',

	// Metaboxs and Optionns
	'options' => array(

		// Default Metabox and Options
		'option_1' => array(

			// Metabox
			'meta_box' => array(
				'title' => 'Metabox one',
				'context' => 'normal',
				'priority' => 'core',
				'desc' => 'Description.',
				// 'callback' => array( 'Azza_PostType_VC', 'custom_meta_box_option' ),
				'save_all_settings' => false, // uses value as button text & sanitize_title_with_dashes(save_all_settings) for value
				),

			// settings and options
			'settings' => array(

				// Single setting and option
				'option_1_text' => array(
					'type' => 'text',
					'validation' => 'text',
					'title' => 'Title',
					'val' => 'Value',
					'desc' => 'Description',
					),
				),
			), // end Default Metabox and Options
			
		),

	) ); // end default_settings array
*/





/**
 * Options VC
 * 
 * @version 1.4
 * @updated 01.19.13
 **/

class Options_VC {
	
	
	/**
	 * Options page default title
	 *
	 * @since 3.6.1
	 * @access public
	 * @var string
	 */
	var $options_page_title = 'Options';
	
	/**
	 * Options page default description
	 *
	 * @since 3.6.1
	 * @access public
	 * @var string
	 */
	var $options_page_desc = false;
	
	
	
	/**
	 * Initiate All Functionality
	 * 
	 * @version		0.0.2
	 * @since 		0.0.1
	 * @update 		02.15.12
	 **/
	function Options_VC( $settings = array() ) {
		
		// Options name and group are required!!!!
		if ( $settings['option_name'] == false OR $settings['option_group'] == false ) return;
		
		$this->activate( $settings );
		
		/**
		 * Settings & Options
		 **/
		
		// Register Settings
		add_action( 'admin_init', array( &$this, 'register_settings' ) );
		
		// Add admin Menus
		add_action( 'admin_menu', array( &$this, 'on_admin_menu' ) );
		
		// Add Options page column support
		add_filter( 'screen_layout_columns', array( &$this, 'on_screen_layout_columns' ), 10, 2 );
		
		
	} // end function Options_VC()
	
	
	
	
	
	
	/**
	 * Activate
	 * 
	 * @version 1.4
	 * @updated 01.19.13
	 **/
	function activate( $settings ) {
		
		// Set version and option name/group
		$this->version 			= $settings['version'];
		$this->option_name 		= $settings['option_name'];
		$this->option_group 	= $settings['option_group'];
		$this->default_settings = $settings;
		
		// Set Options page
		$this->add_submenu_page = $settings['add_submenu_page'];
		
		// Set Options page title
		if ( isset( $settings['options_page_title'] ) AND ! empty( $settings['options_page_title'] ) )
			$this->options_page_title = $settings['options_page_title'];
		else if ( isset( $settings['add_submenu_page']['page_title'] ) AND ! empty( $settings['add_submenu_page']['page_title'] ) )
			$this->options_page_title = $settings['add_submenu_page']['page_title'];
		
		// options_page_desc
		if ( isset( $settings['options_page_desc'] ) AND ! empty( $settings['options_page_desc'] ) )
			$this->options_page_desc = $settings['options_page_desc'];
		
		// init options
		if ( false === get_option( "$this->option_name-version" ) ) {
			
			$this->options = $this->default_options( $settings['options'] );
			
			add_option( $this->option_name, $this->options );
			add_option( "$this->option_name-version", $this->version );
			
		} else if ( $this->version > get_option( "$this->option_name-version" ) ) {
			
			do_action( "$this->option_name-version_update", $settings );
			$this->options = get_option( $this->option_name );
			
		} else {
			
			$this->options = get_option( $this->option_name );
			
		}
		
	} // end function activate
	
	
	
	
	
	
	/**
	 * De-Activate
	 * 
	 * @version		0.0.1
	 * @since 		0.0.1
	 * @update 		02.01.12
	 **/
	function deactivate() {
		
		delete_option( $this->option_name );
		delete_option( "$this->option_name-version" );
		
	} // end function deactivate
	
	
	
	
	
	
	/**
	 * Default Options
	 * 
	 * @version		0.0.2
	 * @update 		03.06.12
	 **/
	function default_options( $options ) {
		
		// Set Options from Settings
		foreach ( $options as $option_block_id => $option_block ) {
			
			foreach ( $option_block['settings'] as $option_key => $option_args ) {
				
				$new_options[$option_block_id][$option_key] = $option_args['val'];
				
			}
			
		}
		
		return $new_options;
		
	} // end function default_options
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Options Page
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Admin Menu
	 * 
	 * @version 1.3
	 * @update 01.19.13
	 * 
	 * ToDo:
	 * This should be compatible with a top-level menu page as well.
	 **/
	function on_admin_menu() {
		
		// Set parent_slug default to options-general.php
		if ( ! isset( $this->add_submenu_page['parent_slug'] ) OR empty( $this->add_submenu_page['parent_slug'] ) )
			$this->add_submenu_page['parent_slug'] = 'options-general.php';
		
		switch ( $this->add_submenu_page['parent_slug'] ) {
			case "themes.php" : 
				$this->pagehook = add_theme_page( $this->add_submenu_page['page_title'], $this->add_submenu_page['menu_title'], $this->add_submenu_page['capability'], "$this->option_group-admin-page", array( &$this, 'on_show_page' ) );
				break;
			default :
				$this->pagehook = add_submenu_page( $this->add_submenu_page['parent_slug'], $this->add_submenu_page['page_title'], $this->add_submenu_page['menu_title'], $this->add_submenu_page['capability'], "$this->option_group-admin-page", array( &$this, 'on_show_page' ) );
				break;
		}
		
		// Load Page Hook
		add_action( "load-$this->pagehook", array( &$this, 'on_load_page' ) );

	} // function on_admin_menu
	
	
	
	
	
	
	/**
	 * On screen layout columns
	 * 
	 * @version		0.0.1
	 * @since 		0.0.1
	 * @update 		02.01.12
	 **/
	function on_screen_layout_columns( $columns, $screen ) {
		
		if ( $screen == $this->pagehook )
			$columns[$this->pagehook] = 1;
			
		return $columns;
		
	} // end function on_screen_layout_columns
	
	
	
	
	
	
	/**
	 * Register Settings
	 * 
	 * @version		0.0.1
	 * @since 		0.0.1
	 * @update 		02.01.12
	 **/
	function register_settings() {

		register_setting( $this->option_group, $this->option_name, array( &$this, 'sanitize_callback' ) );

	} // end register_options
	
	
	
	
	
	
	/**
	 * On Load Page
	 * 
	 * @version		0.0.3
	 * @update 		04.03.12
	 **/
	function on_load_page() {
		
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		wp_enqueue_style('thickbox');
		
		// Add Meta Boxes
		foreach ( $this->default_settings['options'] as $option_block_id => $option_block ) {
			
			// Add Setting Section
			if ( is_array( $option_block['settings'] ) AND is_array( $option_block['meta_box'] ) AND !empty( $option_block['meta_box']['title'] ) ) {
				
				// add_meta_box params
				if ( empty( $option_block['meta_box']['context'] ) )
					$option_block['meta_box']['context'] = 'normal';
				
				if ( empty( $option_block['meta_box']['priority'] ) )
					$option_block['meta_box']['priority'] = '';
				
				if ( isset( $option_block['meta_box']['callback'] ) AND ! empty( $option_block['meta_box']['callback'] ) )
					$callback = $option_block['meta_box']['callback'];
				else
					$callback = array( &$this, 'add_settings_section' );
				
				// add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args )
				add_meta_box( $option_block_id, $option_block['meta_box']['title'], $callback, $this->pagehook, $option_block['meta_box']['context'], $option_block['meta_box']['priority'], $option_block['settings'] );
				
				// add_settings_section( $id, $title, $callback, $page ); // $this->pagehook . "_" . $option_block_id . "_callback"
				add_settings_section( $option_block_id, "", array( &$this, "settings_section_callback" ), $this->pagehook . "_" . $option_block_id . "_page" );
				
				foreach ( $option_block['settings'] as $option_key => $option_args ) {
					
					$option_args['val'] = $this->options[$option_block_id][$option_key];
					$args = array( 'option_block_id' => $option_block_id, 'option_key' => $option_key, 'args' => $option_args );
					
					// add_settings_field( $id, $title, $callback, $page, $section, $args )
					add_settings_field( $option_key, $option_args['title'], array( &$this, 'add_settings_field' ), $this->pagehook . "_" . $option_block_id . "_page", $option_block_id, $args );
					
				} // end foreach
				
			}
			
		} // end foreach
		
	} // function on_load_page
	
	
	
	
	
	
	/**
	 * Add Settings Section
	 * 
	 * @version		0.0.1
	 * @since 		0.0.1
	 * @update 		02.01.12
	 **/
	function add_settings_section( $options, $metabox ) {
		
		if ( $this->default_settings['options'][$metabox['id']]['meta_box']['desc'] )
			echo "<p class=\"description\">" . $this->default_settings['options'][$metabox['id']]['meta_box']['desc'] . "</p>";
		
		do_settings_sections( $this->pagehook . "_" . $metabox['id'] . "_page" );
		
		if ( $this->default_settings['options'][$metabox['id']]['meta_box']['save_all_settings'] )
			echo "<p><input type=\"submit\" value=\"" . $this->default_settings['options'][$metabox['id']]['meta_box']['save_all_settings'] . "\" class=\"button-primary\" name=\"" . sanitize_title_with_dashes( $this->default_settings['options'][$metabox['id']]['meta_box']['save_all_settings'] ) . "\"/></p>";
		
	} // end function add_settings_section
	
	
	
	
	
	
	/**
	 * Add Settings Field
	 * 
	 * @version 1.3
	 * @update 03.22.13
	 *
	 * Unfinished
	 * Todo:
	 * Add case for each type of form field.
	 **/
	function add_settings_field( $field ) {
		
		if ( is_array( $field['args'] ) )
			extract( $field['args'], EXTR_SKIP );
		else
			return;
		
		// Options
		if ( isset( $field['args']['options'] ) AND ! empty( $field['args']['options'] ) )
			$options = $field['args']['options'];
		else
			$options = false;
		
		// Desc
		if ( isset( $field['args']['desc'] ) AND ! empty( $field['args']['desc'] ) )
			$desc = $field['args']['desc'];
		else
			$desc = false;
		
		// form__field( $type, $name, $val, $id = false, $class = false, $desc = false, $options = false, $action = false, $action_args2 = false )
		form__field( 
			$field['args']['type'], // type
			$this->option_name . "[" . $field['option_block_id'] . "][" . $field['option_key'] . "]",  // name
			$field['args']['val'], // val
			$field['option_key'], // id
			'', // class
			$desc, // description
			$options,// options
			"$this->option_name-add_settings_field", // actions
			$field['args']
			);
		
	} // end function add_settings_field
	
	
	
	
	
	
	/**
	 * Settings Section Callback
	 * 
	 * @version		0.0.1
	 * @since 		0.0.1
	 * @update 		02.01.12
	 **/
	function settings_section_callback( $args ) {
		
		do_action( "$this->pagehook-" . $args['id'] );
		
	} // end function settings_section_callback
	
	
	
	
	
	
	/**
	 * Sanitize Callback
	 * 
	 * @version		0.0.3
	 * @update 		03.09.12
	 **/
	function sanitize_callback( $new_options ) {
		
		// sanatize stuff!!! 
		$existing_options = get_option( $this->option_name );
		
		foreach ( $new_options as $option_block_id => $option ) {
			
			if ( is_array( $this->default_settings['options'][$option_block_id]['settings'] ) ) {
				
				$new_option = '';
				foreach ( $this->default_settings['options'][$option_block_id]['settings'] as $option_key => $option_args ) {
					
					if ( isset( $option_args['validation'] ) AND ! empty( $option_args['validation'] ) ) {
						$validation = $option_args['validation'];
					} else {
						$validation = false;
					}
					
					if ( isset( $new_options[$option_block_id][$option_key] ) AND ! empty( $new_options[$option_block_id][$option_key] ) ) {
						$key = $new_options[$option_block_id][$option_key];
					} else {
						$key = false;
					}
					
					$existing_options[$option_block_id][$option_key] = sanitize__value( $validation, $key, "$this->option_name-sanitize-option", $option_args );

				} // end foreach ( $default_settings )
				
			}
			
		} // end foreach ( $new_options as $option_block_id => $option )
		
		
		return $existing_options;
		
	} // end function sanitize_callback
	
	
	
	
	
	
	/**
	 * Options Page HTML
	 * 
	 * @version		0.0.2
	 * @since 		0.0.1
	 * @update 		02.15.12
	 **/
	function on_show_page() {
		global $screen_layout_columns;
		
		?>
		<div id="<?php echo $this->pagehook; ?>-wrap" class="wrap">
			
			<?php screen_icon(); ?>
			<h2><?php echo $this->options_page_title; ?></h2>
			
			<?php if ( $this->options_page_desc ) echo "<div class=\"options-page-description\">$this->options_page_desc</div>"; ?>
			<?php do_action( "$this->option_name-before-options-form" ); ?>
			
			<form action="options.php" method="post">
				
				<?php 
				
				do_action( "$this->option_name-options-form-add-fields" );
				settings_fields( $this->option_group );
				wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false );
				wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); 
				
				?>
				
				<!-- Load page Blocks -->
				<div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
					
					<!-- Main Body -->
					<div id="post-body" class="has-sidebar">
						<div id="post-body-content" class="has-sidebar-content">
							<?php 
							
							do_meta_boxes( $this->pagehook, 'normal', false );
							do_meta_boxes( $this->pagehook, 'additional', false ); 
						
							?>
							
							<p>
								<input type="submit" value="Save Changes" class="button-primary" name="Submit"/>
							</p>
							
							<div class="clear"/></div>
						</div>
					</div>
					
					<div class="clear"/></div>
				</div>	
				
			</form>
			
			<?php do_action( "$this->option_name-after-options-form" ); ?>
			
		</div>
		
		<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				// close postboxes that should be closed
				$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
				// postboxes setup
				postboxes.add_postbox_toggles('<?php echo $this->pagehook; ?>');
			});
			//]]>
		</script>
		
		<?php
		
	} // end function on_show_page
	
	

} // end class Options_VC