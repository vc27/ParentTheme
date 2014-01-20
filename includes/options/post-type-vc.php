<?php
/**
 * File Name -- Depreciated -- post-type-vc.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.5
 * @updated 01.19.13
 * 
 * Depreciate in favor of PostTypeVCWP
 **/
#################################################################################################### */


if ( class_exists( 'Post_Type_VC' ) ) return;

/* Default Post Type Array

$Azza_Post_Type_VC = new Azza_Post_Type_VC( array(
	'post_type' => array(
		'labels' => array(
			'name' => 'Azza',
			'singular_name' => 'Azza',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New',
			'edit_item' => 'Edit Azza',
			'new_item' => 'New Azza',
			'view_item' => 'View Azza',
			'search_items' => 'Search Azza',
			'not_found' => 'No Azza found',
			'not_found_in_trash' => 'No Azza found in Trash', 
			'parent_item_colon' => '',
			'menu_name' => 'Azza'
			),
		
		// 'description' => '',
		'public' => true,
		// 'publicly_queryable'	=> true,
		// 'exclude_from_search'	=> false,
		'show_ui' => true,
		'show_in_menu' => true, // edit.php?post_type=page
		// 'menu_position' => null,
		// 'menu_icon' => get_stylesheet_directory_uri() . "/addons/post-types/images/azza-16x16.png", // is set in class construct
		'capability_type' => 'post', // requires 'page' to call in post_parent
		// 'capabilities' => array(), --> See codex for detailed description
		// 'map_meta_cap' => false,
		// 'hierarchical' => true, // requires manage_pages_custom_column for custom_columns add_action // requires 'true' to call in post_parent
		
		'supports' => array( 
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			// 'trackbacks',
			'custom-fields',
			'comments',
			'revisions',
			'page-attributes', //  (menu order, hierarchical must be true to show Parent option)
			// 'post-formats',
			),
			
		// 'register_meta_box_cb' => '', --> managed via class method add_meta_boxes()
		// 'taxonomies' => array('post_tag', 'azza-tax-hierarchal'), // array of registered taxonomies
		// 'permalink_epmask' => 'EP_PERMALINK',
		// 'has_archive' => true, // Enables post type archives. Will use string as archive slug.
		
		'rewrite' => array( // Permalinks
			'slug' => 'azza',
			// 'with_front' => '', // set this to false to over-write a wp-admin-permalink structure
			// 'feeds' => '', // default to has_archive value
			// 'pages' => true,
			),
			
		'query_var' => 'azza', // This goes to the WP_Query schema
		'can_export' => true,
		// 'show_in_nav_menus' => '', // value of public argument
		'_builtin' => false, 
		'_edit_link' => 'post.php?post=%d',
		
		), // end 'post_type'
	
	
	// add_image_size( $name, $width, $height, $crop )
	'featured_image_sizes' => array(
		array(
			'name' => '{Featured Image} EX Small',
			'width' => '75',
			'height' => '75',
			'crop' => false,
			),
		),

	) ); // $post_type array

*/


/**
 * Custom Post Type VC
 * 
 * @version 1.5
 * @updated 01.19.13
 **/
class Post_Type_VC {
	
	
	/**
	 * Post type args array
	 *
	 * @since 3.6.1
	 * @access public
	 * @var array
	 */
	var $register_post_type = false;
	
	/**
	 * Post type query var
	 *
	 * @since 3.6.1
	 * @access public
	 * @var string
	 */
	var $post_type = false;
	
	/**
	 * Post type taxonomy filter
	 *
	 * @since 3.6.1
	 * @access public
	 * @var array
	 *
	 * Adding taxonomies to this array will include
	 * them in the basic post type admin-management page.
	 */
	var $post_type_tax_filters = false;
	
	/**
	 * Numeric array of featured images
	 *
	 * @since 3.6.1
	 * @access public
	 * @var array
	 */
	var $featured_image_sizes = false;
	
	/**
	 * Continue loading script
	 *
	 * @since 3.6.1
	 * @access public
	 * @var bool
	 */
	var $continue = true;
	
	
	
	/**
	 * Construct
	 * 
	 * @version 1.1
	 * @updated 12.29.12
	 **/
	function Post_Type_VC( $post_type = false ) {
		
		if ( ! is_array( $post_type ) ) return;
		
		$this->init_post_type( $post_type );
		
	} // end function Post_Type_VC
	
	
	
	
	
	
	/**
	 * set
	 * 
	 * @version 1.0
	 * @updated 01.19.13
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set
	
	
	
	
	
	
	/**
	 * Initiate Post Type
	 * 
	 * @version	1.4
	 * @updated	01.19.13
	 **/
	function init_post_type( $post_type ) {
		
		$this->set_post_type( $post_type );
		
		// Register Post Type
		if ( $this->continue ) {
			
			register_post_type( $this->post_type, $this->register_post_type );


			// Flush Re-writes - temporarly removed because it's really not needed.
			// if ( !get_option( "is-set-$this->post_type-rewrite" ) )
				// add_action( 'admin_init', array( &$this, 'flush_rewrites') );


			// Add Featured Images
			if ( $this->featured_image_sizes ) {

				if ( ! current_theme_supports( 'post-thumbnails' ) )
					add_theme_support( 'post-thumbnails' );

				$this->init_featured_image_sizes( $this->featured_image_sizes );

			}
			
		}
		
	} // end function init_post_type
	
	
	
	
	
	
	/**
	 * set_post_type
	 * 
	 * @version 1.0
	 * @updated 01.19.13
	 **/
	function set_post_type( $post_type ) {
		
		// Register post type array
		if ( isset( $post_type['post_type'] ) ) {
			$this->set( 'register_post_type', $post_type['post_type'] );
		} else {
			$this->continue = false;
		}
		
		// Post type query_var
		if ( $this->continue and isset( $post_type['post_type']['query_var'] ) ) {
			$this->set( 'post_type', $post_type['post_type']['query_var'] );
		} else {
			$this->continue = false;
		}
		
		if ( isset( $post_type['post_type_tax_filters'] ) )
			$this->set( 'post_type_tax_filters', $post_type['post_type_tax_filters'] );
		
		if ( isset( $post_type['featured_image_sizes'] ) AND is_array( $post_type['featured_image_sizes'] ) AND ! empty( $post_type['featured_image_sizes'] ) ) {
			$this->set( 'featured_image_sizes', $post_type['featured_image_sizes'] );
		}
		
	} // end function set_post_type
	
	
	
	
	
	
	/**
	 * Update rewrite_rules transient (soft flush)
	 * 
	 * @version 1.3
	 * @updated 12.29.12
	 **/
	function flush_rewrites() {
		
		flush_rewrite_rules( false );
		update_option( "is-set-$this->post_type-rewrite", 1 );
		
	} // end function flush_rewrites
	
	
	
	
	
	
	/**
	 * Set Featured Images
	 * 
	 * @version 1.2
	 * @updated	12.29.12
	 **/
	function init_featured_image_sizes( $featured_image_sizes ) {
		
		foreach ( $featured_image_sizes as $image ) {

			$name = sanitize_title_with_dashes( $image['name'] );
			add_image_size( $name, $image['width'], $image['height'], $image['crop'] );

		} // endforeach
		
	} // function init_featured_image_sizes
	
	
	
	
	
	
	/**
	 * Add External Metaboxes
	 * 
	 * @version 1.1
	 * @updated	01.19.13
	 * 
	 * Description:
	 * Works in conjunction with existing filter used with in
	 * post-meta-vc.php. It will add the post type to the metabox
	 * that is being specified.
	 **/
	function add_external_metaboxes( $post_types ) {
		
		$post_types[] = $this->post_type;
		return $post_types;
		
	} // end function add_external_metaboxes
	
	

} // end class Post_Type_VC