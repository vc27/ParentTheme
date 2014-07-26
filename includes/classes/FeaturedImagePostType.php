<?php
/**
 * File Name FeaturedImagePostType.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################





/**
 * FeaturedImagePostType
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$FeaturedImagePostType = new FeaturedImagePostType();
class FeaturedImagePostType {
	
	
	
	/**
	 * registered
	 * 
	 * @access public
	 * @var array
	 **/
	var $registered = 0;
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {
		
		$this->register_post_type();
		$this->register__postmeta();
		
		// hook method after_setup_theme
		// add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );

		// hook method init
		add_action( 'init', array( &$this, 'init' ) );

		// hook method admin_init
		add_action( 'admin_init', array( &$this, 'admin_init' ) );
		
		// Add a metabox to this post-type
		// add_filter( 'tester_metabox_id-included_post_types', array( &$this, 'add_external_metaboxes' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * after_setup_theme
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 *
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
	 **/
	function after_setup_theme() {
		
		// 
		
	} // end function after_setup_theme
	
	
	
	
	
	
	/**
	 * init
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/init
	 * 
	 * Description:
	 * Runs after WordPress has finished loading but before any headers are sent.
	 **/
	function init() {
		
		$this->add_image_sizes();
		
	} // end function init
	
	
	
	
	
	
	/**
	 * admin_init
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/admin_init
	 * 
	 * Description:
	 * admin_init is triggered before any other hook when a user access the admin area.
	 * This hook doesn't provide any parameters, so it can only be used to callback a 
	 * specified function.
	 **/
	function admin_init() {
		
		$this->create__posts();
		
		// Add Filters for Custom Manage Columns
		add_filter(	'manage_edit-' . $this->registered->_post_type . '_columns', array( &$this, 'edit_columns' ) );
		
		// Add management for capability_type
		if ( 
			( isset( $this->registered->post_type['post_type']['hierarchical'] ) AND ! empty( $this->registered->post_type['post_type']['hierarchical'] ) ) 
			AND 
			( isset( $this->registered->post_type['post_type']['capability_type'] ) AND ! empty( $this->registered->post_type['post_type']['capability_type'] ) AND $this->registered->post_type['post_type']['capability_type'] == 'page' ) 
		) {
			$this->manage_custom_column = 'manage_pages_custom_column';
		} else {
			$this->manage_custom_column = 'manage_posts_custom_column'; // "manage_" . $this->post_type . "_custom_column";
		}
		
		add_action(	$this->manage_custom_column, array( &$this, 'custom_columns' ) );
		
		// Add column specific filtering
		// add_filter( 'manage_edit-' . $this->registered->_post_type . '_sortable_columns', array( &$this, 'column_register_sortable' ) );
		add_filter( 'request', array( &$this, 'column_orderby' ) );
		
		// Added for taxonomy filtering
		if ( $this->registered->have_tax_filters ) {
			add_action( 'restrict_manage_posts', array( &$this, 'restrict_manage_html_filters' ) );
			add_filter( 'pre_get_posts', array( &$this, 'post_type_parse_query' ) );
		}
		
	} // end function admin_init
	
	
	
	
	
	
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
	
	
	
	
	
	
	/**
	 * Add External Metaboxes
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 * 
	 * Description:
	 * Works in conjunction with existing filter used with in
	 * post-meta-vc.php. It will add the post type to the metabox
	 * that is being specified.
	 **/
	function add_external_metaboxes( $post_types ) {
		
		$post_types[] = $this->registered->_post_type;
		return $post_types;
		
	} // end function add_external_metaboxes
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Register
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * register_post_type
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function register_post_type() {
		
		$this->registered = register__post_type( array(
			'post_type' => array(
				'labels' => array(
					'name' => 'Featured Image Sizes',
					'singular_name' => 'Featured Image Sizes',
					'add_new' => 'Add New Size',
					'add_new_item' => 'Add New Size',
					'edit_item' => 'Edit Featured Image Size',
					'new_item' => 'New Featured Image Size',
					'view_item' => 'View Featured Image Sizes',
					'search_items' => 'Search Featured Image Size',
					'not_found' => 'No Featured Image Sizes found',
					'not_found_in_trash' => 'No Featured Image Sizes found in Trash', 
					'parent_item_colon' => '',
					'menu_name' => 'Featured Image Sizes'
					),

				// 'description' => '',
				'public' => false,
				// 'publicly_queryable'	=> true,
				// 'exclude_from_search'	=> false,
				'show_ui' => true,
				'show_in_menu' => 'upload.php',
				// 'menu_position' => null,
				// 'menu_icon' => get_stylesheet_directory_uri() . "/addons/post-types/images/featured-image-16x16.png", // is set in class construct
				'capability_type' => 'post', // requires 'page' to call in post_parent
				// 'capabilities' => array(), --> See codex for detailed description
				// 'map_meta_cap' => false,
				// 'hierarchical' => true, // requires manage_pages_custom_column for custom_columns add_action // requires 'true' to call in post_parent

				'supports' => array( 
					'title',
					// 'editor',
					// 'author',
					'thumbnail',
					// 'excerpt',
					// 'trackbacks',
					// 'custom-fields',
					// 'comments',
					// 'revisions',
					// 'page-attributes', //  (menu order, hierarchical must be true to show Parent option)
					// 'post-formats',
					),

				// 'register_meta_box_cb' => '', --> managed via class method add_meta_boxes()
				// 'taxonomies' => array('post_tag', 'featured-image-tax-hierarchal'), // array of registered taxonomies
				// 'permalink_epmask' => 'EP_PERMALINK',
				// 'has_archive' => true, // Enables post type archives. Will use string as archive slug.

				'rewrite' => array( // Permalinks
					'slug' => 'featured-image',
					// 'with_front' => '', // set this to false to over-write a wp-admin-permalink structure
					// 'feeds' => '', // default to has_archive value
					// 'pages' => true,
					),

				'query_var' => 'featured-image', // This goes to the WP_Query schema
				'can_export' => true,
				// 'show_in_nav_menus' => '', // value of public argument
				'_builtin' => false, 
				'_edit_link' => 'post.php?post=%d',

				), // end 'post_type'

			) );
		
	} // end function register_post_type
	
	
	
	
	
	
	/**
	 * register__postmeta
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function register__postmeta() {
		
		$options = array(
			'id' => 'featured_image_attributes',
			'title' => 'Featured Image Attributes', 
			'context' => 'normal',
			'priority' => 'default',
			// 'desc' => 'my metabox desc',
			'post_meta' => array(
				array(
					'type' => 'checkbox',
					'validation' => 'checkbox',
					'title' => 'Crop',
					'name' => '_featured_image_crop',
					'desc' => '[Currently not working] Crop images to fit Height and Width.',
					),
				array(
					'type' => 'text',
					'validation' => 'numeric',
					'title' => 'Width',
					'name' => '_featured_image_width',
					'desc' => 'Max Width of the image slot.',
					),
				array(
					'type' => 'text',
					'validation' => 'numeric',
					'title' => 'Height',
					'name' => '_featured_image_height',
					'desc' => 'Max Height of the image slot.',
					),
				array(
					'type' => 'title',
					'title' => 'Default Image',
					'desc' => 'Please use the "Featured Image" metabox to the right to upload the backup / default image you would like to associate with this featured image slot. It is highly suggested that you pre-size your default image.',
					),
				),
			);

		$this->register__postmeta = register__postmeta( array( $this->registered->_post_type ), $options );
		
	} // end function register__postmeta
	
	
	
	
	
	
	/**
	 * create__posts
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function create__posts() {
		
		if ( 1 != get_option( $this->registered->_post_type . '-installed' ) ) {
			
			$this->create__posts = create__posts( array(
				array(
					'id' => 'standard-thumbnail',
					'post_meta' => array(
						'_featured_image_width' => array(
							'key' => '_featured_image_width',
							'value' => 150,
							'unique' => 1,
							'prev_value' => 0,
							'pre_delete' => 0
							),
						'_featured_image_height' => array(
							'key' => '_featured_image_height',
							'value' => 150,
							'unique' => 1,
							'prev_value' => 0,
							'pre_delete' => 0
							),
						),
					'post' => array(
						'post_title' => 'Standard Thumbnail',
						'post_status' => 'publish',
						'post_type' => $this->registered->_post_type,
						),
					),
				array(
					'id' => 'medium-thumbnail',
					'post_meta' => array(
						'_featured_image_width' => array(
							'key' => '_featured_image_width',
							'value' => 300,
							'unique' => 1,
							'prev_value' => 0,
							'pre_delete' => 0
							),
						'_featured_image_height' => array(
							'key' => '_featured_image_height',
							'value' => 1000,
							'unique' => 1,
							'prev_value' => 0,
							'pre_delete' => 0
							),
						),
					'post' => array(
						'post_title' => 'Medium Thumbnail',
						'post_status' => 'publish',
						'post_type' => $this->registered->_post_type,
						),
					),
				array(
					'id' => 'large-thumbnail',
					'post_meta' => array(
						'_featured_image_width' => array(
							'key' => '_featured_image_width',
							'value' => 500,
							'unique' => 1,
							'prev_value' => 0,
							'pre_delete' => 0
							),
						'_featured_image_height' => array(
							'key' => '_featured_image_height',
							'value' => 1000,
							'unique' => 1,
							'prev_value' => 0,
							'pre_delete' => 0
							),
						),
					'post' => array(
						'post_title' => 'Large Thumbnail',
						'post_status' => 'publish',
						'post_type' => $this->registered->_post_type,
						),
					),
				), true );
			
			update_option( $this->registered->_post_type . '-installed', 1 );
		
		} // end if ( 1 !== get_option( $this->registered->_post_type . '-installed' ) )
		
		
	} // end function create__posts
	
	
	
	
	
	
	/**
	 * Add Image Sizes
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 *
	 * Notes:
	 * add_image_size does not seem to want to take a crop value
	 * from a $variable=true - very weird
	 **/
	function add_image_sizes() {
		
		$featured_images = new WP_Query();
		$featured_images->query( array(
			'posts_per_page' => -1,
			'post_type' => 'featured-image',
			) );
		
		if ( $featured_images->have_posts() ) {
			
			while ( $featured_images->have_posts() ) {
				$featured_images->the_post();
				
				if ( get_post_meta( $featured_images->post->ID, '_featured_image_crop', true ) )
					$crop = true;
				else
					$crop = false;
				
				add_image_size( 
					$featured_images->post->post_name, 
					get_post_meta( $featured_images->post->ID, '_featured_image_width', true ),
					get_post_meta( $featured_images->post->ID, '_featured_image_height', true ), 
					$crop );
		
			}
			
		}
		
	} // end function add_image_size
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Static
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * featured_image__form_select
	 **/
	function featured_image__form_select( $args = array() ) {

		$defaults = array(
			'val' => '',
			'id' => '',
			'name' => '',
			'attr' => false,
			);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );

		$featured_images = new WP_Query();
		$featured_images->query( array(
			'posts_per_page' => -1,
			'post_type' => 'featured-image',
			) );

		if ( $featured_images->have_posts() ) {

			echo "<select id=\"$id\" name=\"$name\" $attr>";
				echo "<option value=\"\">" . __( 'Select an Image Size', 'parenttheme' ) . "</option>";
				while ( $featured_images->have_posts() ) {
					$featured_images->the_post();

					if ( $val == $featured_images->post->post_name )
						$sel = 'selected="selected"';
					else
						$sel = '';

					$width_height = false;
					$width = get_post_meta( $featured_images->post->ID, '_featured_image_width', true );
					$height = get_post_meta( $featured_images->post->ID, '_featured_image_height', true );

					if ( $width AND $height ) {
						$width_height = " $width x $height";
					} else if ( $width AND ! $height ) {
						$width_height = " Width $width";
					} else if ( ! $width AND $height ) {
						$width_height = " Height $height";
					}

					echo "<option $sel value=\"" . $featured_images->post->post_name . "\">" . $featured_images->post->post_title . $width_height . "</option>";
				}

			echo "</select>";

			wp_reset_postdata();
		} else {
			echo __( "There are no featured image sizes available.", 'parenttheme' ) . " <a href=\"" . home_url() . "/wp-admin/edit.php?post_type=featured-image\">" . __( 'Manage Featured Images', 'parenttheme' ) . "</a>";
		}

	} // end function featured_image__form_select
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Admin Management
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Register the column as sortable
	 * 
	 * @version 1.2
	 * @updated 00.00.13
	 **/
	function column_register_sortable( $columns ) {
		
		// $columns['featured'] = 'featured';

		return $columns;
		
	} // end function column_register_sortable
	
	
	
	
	
	
	/** 
	 * Filter request for ordering
	 * 
	 * @version 1.2
	 * @updated 00.00.13
	 **/
	function column_orderby( $vars ) {
		
		// Sorting by post_meta numeric values
		if ( isset( $vars['orderby'] ) AND $vars['orderby'] == $this->registered->_post_type ) {
			
			$key_val_compair = array(
				'meta_compare'	=> '>',
				'meta_value'	=> 0,
				'orderby'		=> 'meta_value_num'
				);
				
			switch ( $vars['orderby'] ) {
				
				case "featured" :
					
					$key_val_compair['meta_key'] = 'vc_featured_priority';
					$vars = array_merge( $vars, $key_val_compair );
					
				break;
				
			} // end switch ( $vars['orderby'] )
			
		} // end if ( $vars['post_type'] == $this->post_type AND isset( $vars['orderby'] ) )

		return $vars;
		
	} // end function column_orderby
	
	
	
	
	
	
	/**
	 * Add Columns Manage Page
	 * 
	 * @version 1.3
	 * @updated 00.00.13
	 **/
	function edit_columns( $columns ) {
		
		$columns['name'] = 'Name';
		$columns['width'] = 'Width';
		$columns['height'] = 'Height';
		$columns['crop'] = 'Crop';
		$columns['default'] = 'Default';
		
		unset( $columns['date'] );
		
		return $columns;
	
	} // end edit_columns
	
	
	
	
	
	
	/**
	 * Add Columns Details
	 * 
	 * @version 1.2
	 * @updated 00.00.13
	 **/
	function custom_columns( $column ) {
		global $post;
		
		if ( $post->post_type == $this->registered->_post_type ) {
			
			switch ( $column ) {

				case "name" :
					echo $post->post_name;
					break;
				case "default":
					if ( has_post_thumbnail( $post->ID ) )
						echo get_the_post_thumbnail( $post->ID, array( 50, 50 ) );
					break;
				case "width" :
					echo get_post_meta( $post->ID, '_featured_image_width', true );
					break;
				case "height" :
					echo get_post_meta( $post->ID, '_featured_image_height', true );
					break;
				case "crop" :
					if ( $crop = get_post_meta( $post->ID, '_featured_image_crop', true ) )
						echo "<span style=\"color:green;\">&#8730;</span>";
					else
						echo "<span style=\"color:red;\">&#8709;</span>";
					break;
					
			} // end switch
			
		} // end if
	
	} // end custom_columns
	
	
	
	
	
	
	/**
	 * Add html for dropdown select containing taxonomies
	 * 
	 * @version 1.2
	 * @updated 00.00.13
	 *
	 * Notes:
	 * There are no parameters, but there are two globals available
	 * Available:
	 * $post_type_object->taxonomies
	 * $post_type_object->query_var
	 **/
	function restrict_manage_html_filters() {
		global $post_type_object, $cat;
		
		if ( $post_type_object->query_var == $this->registered->_post_type AND $this->registered->have_tax_filters ) {
			
			foreach ( $this->registered->post_type_tax_filters as $taxonomy ) {
				
				echo $this->html_taxonomy_select( $taxonomy );
				
			} // end foreach ( $this->post_type_tax_filters )
			
		} // end if ( post_type )
		
	} // end restrict_manage_html_filters
	
	
	
	
	
	
	/**
	 * Build html for dropdown select containing taxonomies
	 * 
	 * @version 1.2
	 * @updated 00.00.13
	 **/
	function html_taxonomy_select( $taxonomy ) {
		
		$terms = get_terms( $taxonomy );
		$tax = get_taxonomy( $taxonomy );

		$html = " &nbsp;";
		$html .= "<select style=\"width:125px;\" id=\"sortby-term-$taxonomy\" name=\"sortby-term-$taxonomy\">";
		$html .= "<option value=\"none\">All $tax->label</option>";

		foreach ( $terms as $term ) {
			if ( $_GET["sortby-term-$taxonomy"] == $term->slug )
				$sel = ' selected="selected"';

			$html .= "<option value=\"$term->slug\"$sel>$term->name</option>";
			unset( $sel );
		}

		$html .= "</select>&nbsp; ";
		
		return $html;
		
	} // end function html_taxonomy_select
	
	
	
	
	
	
	/**
	 * Filter results of page based on the "restrict_manage" variable
	 * 
	 * @version 1.2
	 * @updated 00.00.13
	 **/
	function post_type_parse_query( $query ) {
		global $pagenow;
		
		// Make sure we are filtering the edit.php query
		if ( is_admin() AND $pagenow == 'edit.php' AND $query->query_vars['post_type'] == $this->registered->_post_type AND $this->registered->have_tax_filters ) {
			
			foreach ( $this->registered->post_type_tax_filters as $taxonomy ) {
				
				if ( isset( $_GET["sortby-term-$taxonomy"] ) AND $_GET["sortby-term-$taxonomy"] != 'none' ) {
					
					$query->set( $taxonomy, $_GET["sortby-term-$taxonomy"] );
				
				} // end if ( isset
				
			} // end foreach ( $this->post_type_tax_filters ) 
			
		} // end if ( is_admin )
	
	} // end function post_type_parse_query
	
	
	
} // end class FeaturedImagePostType