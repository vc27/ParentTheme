<?php
/**
 * File Name ParentThemeOptionsVCWP.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.3
 * @updated 07.16.13
 **/
####################################################################################################





/**
 * ParentThemeOptionsVCWP
 **/
$ParentThemeOptionsVCWP = new ParentThemeOptionsVCWP();
class ParentThemeOptionsVCWP {
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.2
	 * @updated 06.22.13
	 **/
	function __construct() {
		
		if ( is_admin() ) {
			$this->set( 'version', '4.9' );
			$this->set( 'option_name', '_vc_general_options' );
			$this->set( 'option_group', 'vc_general_options' );

			$this->set__existing_version();
			$this->set__options();

			$this->initial_installation();
			$this->update();

			add_action( 'after_setup_theme', array( &$this, 'init_options' ) );
		}

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
	
	
	
	
	
	
	/**
	 * get
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function get( $key ) {
		
		if ( isset( $key ) AND ! empty( $key ) AND isset( $this->$key ) AND ! empty( $this->$key ) ) {
			return $this->$key;
		} else {
			return false;
		}
		
	} // end function get
	
	
	
	
	
	
	/**
	 * set__existing_version
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__existing_version() {
		
		$this->set( 'existing_version', get_option( "$this->option_name-version" ) );
		
	} // end function set__existing_version
	
	
	
	
	
	
	/**
	 * set__options
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__options() {
		
		$this->set( 'options', get_option( "$this->option_name" ) );
		
	} // end function set__options
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * initial_installation
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function initial_installation() {
		
		if ( ! $this->have_version() ) {
			
			update_option( 'thumbnail_crop', false );
			update_option( 'date_format', 'F j, Y' );
		
		}
		
	} // end function initial_installation
	
	
	
	
	
	
	/**
	 * update
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function update() {
		
		if ( $this->have_options() AND $this->have_version() AND $this->version > $this->existing_version ) {
			
			add_action( "$this->option_name-version_update", array( &$this, 'update_theme_options' ) );
		
		}
		
	} // end function update
	
	
	
	
	
	
	/**
	 * Update Theme Options
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function update_theme_options( $option_page ) {
		
		switch ( $this->version ) {
			
			case "3.5.5" : // nothing happens just yet...
			default :
				return true;
				break;
			
		} // end switch ( $this->version )
		
	} // end function update_theme_options
	
	
	
	
	
	
	/**
	 * Set Default Options
	 *
	 * @version 1.1
	 * @updated 07.16.13
	 **/
	function init_options() {
		
		$this->default_options = apply_filters( 'filter_default_vc_options', array(
			'version' 				=> $this->version,

			'option_name' 			=> $this->option_name,
			'option_group' 			=> $this->option_group,

			'add_submenu_page' 	=> array(
				'parent_slug' 	=> 'themes.php',
				'page_title'	=> __( 'Theme Options', 'childtheme' ),
				'menu_title'	=> __( 'Theme Options', 'childtheme' ),
				'capability'	=> 'administrator',
				),

			// 'options_page_title' 	=> false,
			// 'options_page_desc' 	=> 'Theme Options.',
			'options' 	=> array(
				
				// Contact
				'contact' => array(
					'meta_box' 	=> array(
						'title'		=> __( 'Contact Settings', 'childtheme' ),
						'context'	=> 'normal',
						'priority'	=> 'core',
						'desc'		=> __( 'General contact info to be used through out the site. Please be aware if you enter contact info into a text-editor it will be managed separately from this section.', 'childtheme' ),
						'save_all_settings' => __( 'Save all Settings', 'childtheme' ),
						),
					'settings' => array(
						'copyright'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Copyright', 'childtheme' ),
							'val' 			=> '&copy; %year%',
							'desc'			=> __( '%year% will be swapped out with the current year.', 'childtheme' ),
							),
						'street'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Street address', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'city'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'City', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'state'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'State', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'zip'	=> array(
							'type'			=> 'text',
							'validation'	=> 'numeric',
							'title' 		=> __( 'Zip', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'office'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Office Phone', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'cell'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Cell', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'fax'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Fax', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'name'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Name', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'email'	=> array(
							'type'			=> 'text',
							'validation'	=> 'email',
							'title' 		=> __( 'Email', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'contact_text'	=> array(
							'type'			=> 'text_editor',
							'validation'	=> 'text_editor',
							'title' 		=> __( 'Contact Text', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Text to be added to the contact section.', 'childtheme' ),
							),
						),
					), // end Contact
				
				
				// Layout Settings
				'post_display' => array(
					'meta_box' => array(
						'title'		=> __( 'General Post Display', 'childtheme' ),
						'context'	=> 'normal',
						'priority'	=> 'core',
						'desc'		=> __( 'General post display for various pages through out your site.', 'childtheme' ),
						'save_all_settings' => __( 'Save all Settings', 'childtheme' ),
						),
					'settings' => array(
						'category_content' => array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Include category content', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> __( 'Category content refers to "posts" that are being displayed on a category term page.', 'childtheme' ),
							),
						'tag_content' => array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Include tag content', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> __( 'Tag content refers to "posts" that are being displayed on a tag term page.', 'childtheme' ),
							),
						'numeric_archive_content' => array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Include numeric archive content', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> __( 'Numeric archive content refers to "posts" that are being displayed on a page by date.', 'childtheme' ),
							),
						'author_content' => array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Include author content', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> __( 'Author archive content refers to "posts" that are being displayed on an author archive page.', 'childtheme' ),
							),
						'search_content' => array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Include search content', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> __( 'Search content refers to "posts" that are being displayed as results to a standard WordPress search.', 'childtheme' ),
							),
						'home_page_posts' => array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Include home page posts content', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> __( 'Home page post content refers to "posts" that are being displayed on the home page.', 'childtheme' ),
							),
						'word_count' => array(
							'type'			=> 'text',
							'validation'	=> 'numeric',
							'title' 		=> __( 'Word Count', 'childtheme' ),
							'val' 			=> (int)100,
							'desc'			=> __( 'Search content refers to the amount of word displayed in the excerpt.', 'childtheme' ),
							),
						'read_more' => array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( '"Read More" text', 'childtheme' ),
							'val' 			=> __( "Read More", 'childtheme' ),
							'desc'			=> __( '"Read More" refers to the link found at the bottom of a standard excerpt.', 'childtheme' ),
							),
						'strip_tags' => array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Strip html tags', 'childtheme' ),
							'val' 			=> htmlentities( "<p>" ),
							'desc'			=> __( 'Striping html tags from an excerpt will remove items such as "Bold", "Underline", "Italics" and the like. This is recommended due to possibility of tags being cut in half and bleeding through out the page.', 'childtheme' ),
							),
						'show_featured_image' => array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display featured image', 'childtheme' ),
							'val' 			=> false, 
							'desc'			=> __( 'Will display featured image with excerpt where settings have been applied.', 'childtheme' ),
							),
						'featured_image_size' => array(
							'type'			=> 'featured_image',
							'validation'	=> 'select',
							'title' 		=> __( 'Featured image size', 'childtheme' ),
							'val' 			=> '', 
							),
						'childpage_breadcrumb' => array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Child page breadcrumb ', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> __( 'Will activate a breadcrumb navigation above the page title of any page that has a parent.', 'childtheme' ),
							),
						), // end "settings"
					), // end post_display
				
				// Social Networks
				'social_networks' => array(
					'meta_box' 	=> array(
						'title'		=> __( 'Social Networks', 'childtheme' ),
						'context'	=> 'normal',
						'priority'	=> 'core',
						'desc'		=> __( 'Add urls for available networks.', 'childtheme' ),
						'save_all_settings' => __( 'Save all Settings', 'childtheme' ),
						),
					'settings' => array(
						'pinterest'	=> array(
							'type'			=> 'text',
							'validation'	=> 'url',
							'title' 		=> __( 'Pinterest', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Please enter the full url.', 'childtheme' ),
							),
						'youtube'	=> array(
							'type'			=> 'text',
							'validation'	=> 'url',
							'title' 		=> __( 'Youtube', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Please enter the full url.', 'childtheme' ),
							),
						'twitter'	=> array(
							'type'			=> 'text',
							'validation'	=> 'url',
							'title' 		=> __( 'Twitter', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Please enter the full url.', 'childtheme' ),
							),
						'twitter_username'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Twitter Username', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'facebook'	=> array(
							'type'			=> 'text',
							'validation'	=> 'url',
							'title' 		=> __( 'Facebook', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Please enter the full url.', 'childtheme' ),
							),
						'facebook_like'	=> array(
							'type'			=> 'textarea',
							'validation'	=> 'textarea',
							'title' 		=> __( 'Facebook Like', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Please see the following url for creating your Facebook "Like" button.', 'childtheme' ),
							),
						),
					), // end Social Networks
				
				// Comments
				'comments' => array(
					'meta_box' 	=> array(
						'title'		=> __( 'Comments Settings', 'childtheme' ),
						'context'	=> 'normal',
						'priority'	=> 'core',
						'desc'		=> false,
						'save_all_settings' => __( 'Save all Settings', 'childtheme' ),
						),
					'settings' => array(
						'remove_comments' => array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Remove Comments Completely', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'This option will attempt to over write all default setting and remove comments from the site completely.', 'childtheme' ),
							),
						'no_comments'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Text to display when there are no comments', 'childtheme' ),
							'val' 			=> __( 'There are no comments yet.', 'childtheme' ),
							'desc'			=> false,
							),
						'comments_closed'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Text to display when comments are closed', 'childtheme' ),
							'val' 			=> __( 'Comments are closed', 'childtheme' ),
							'desc'			=> false,
							),
						),
					), // end comments
				
				// HTML head footer
				'header_footer' => array(
					'meta_box' 	=> array(
						'title'		=> __( 'HTML head footer', 'childtheme' ),
						'context'	=> 'normal',
						'priority'	=> 'core',
						'desc'		=> __( 'These sections are dedicated to adding various scripts to the WordPress tags for wp_head &amp; wp_footer. It is not recommended that you add strait html to these locations. Please see your webmaster for further questions.', 'childtheme' ),
						'save_all_settings' => __( 'Save all Settings', 'childtheme' ),
						),
					'settings' => array(
						'favicon'	=> array(
							'type'			=> 'image',
							'validation'	=> 'image',
							'title' 		=> __( 'Favicon Image', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Favicon image is the small image next to the address in the browser.', 'childtheme' ),
							),
						'wp_head'	=> array(
							'type'			=> 'textarea',
							'validation'	=> 'textarea',
							'title' 		=> __( 'HTML head section', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'wp_footer'	=> array(
							'type'			=> 'textarea',
							'validation'	=> 'textarea',
							'title' 		=> __( 'HTML footer section', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						),
					), // end default metabox option
				
				// Author Page Title
				'author_title' => array(
					'meta_box' 	=> array(
						'title'		=> __( 'Author Page Title', 'childtheme' ),
						'context'	=> 'normal',
						'priority'	=> 'core',
						'desc'		=> __( 'Display options for an author archive page.', 'childtheme' ),
						'save_all_settings' => __( 'Save all Settings', 'childtheme' ),
						),
					'settings' => array(
						'author_show'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display author title', 'childtheme' ),
							'val' 			=> 'on',
							'desc'			=> __( 'Will display the following settings above the archive list of posts.', 'childtheme' ),
							),
						'author_title'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Display author title', 'childtheme' ),
							'val' 			=> __( 'Author: %author_name%', 'childtheme' ),
							'desc'			=> __( '%author_name% will be swapped out with current authors "Display Name"', 'childtheme' ),
							),
						'author_bio'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display author bio', 'childtheme' ),
							'val' 			=> 'on',
							'desc'			=> false,
							),
						'author_avatar'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display author avatar', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> __( 'Will retrieve and display an authors avatar from Gravatar.com using the default WordPress avatar system.', 'childtheme' ),
							),
						'before_author_show'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display optional text above author title.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						'before_author_text'	=> array(
							'type'			=> 'simple_text_editor',
							'validation'	=> 'text_editor',
							'title' 		=> __( 'Optional text above author title', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'wpautop_before_author'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Automatically add paragraph line breaks.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						'after_author_show'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display optional text below author title.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						'after_author_text'	=> array(
							'type'			=> 'simple_text_editor',
							'validation'	=> 'textarea',
							'title' 		=> __( 'Optional text after author title', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'wpautop_after_author'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Automatically add paragraph line breaks.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						),
					), // end Author Page Title
				
				// Category Page Title
				'category_title' => array(
					'meta_box' 	=> array(
						'title'		=> __( 'Category Page Title', 'childtheme' ),
						'context'	=> 'normal',
						'priority'	=> 'core',
						'desc'		=> __( 'Display options for a category archive page.', 'childtheme' ),
						'save_all_settings' => __( 'Save all Settings', 'childtheme' ),
						),
					'settings' => array(
						'cat_show'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display category title', 'childtheme' ),
							'val' 			=> 'on',
							'desc'			=> __( 'Will display the following settings above the archive list of posts.', 'childtheme' ),
							),
						'cat_title'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Display category title', 'childtheme' ),
							'val' 			=> __( 'Category: %cat_name%', 'childtheme' ),
							'desc'			=> __( '%cat_name% will be swapped out with current category "Term Name"', 'childtheme' ),
							),
						'cat_rss'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display category rss link', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						'cat_desc'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display category description', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						'before_cat_show'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display optional text above category title.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						'before_cat_text'	=> array(
							'type'			=> 'simple_text_editor',
							'validation'	=> 'textarea',
							'title' 		=> __( 'Optional text above category title', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'wpautop_before_cat'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Automatically add paragraph line breaks.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						'after_cat_show'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display optional text below category title.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						'after_cat_text'	=> array(
							'type'			=> 'simple_text_editor',
							'validation'	=> 'textarea',
							'title' 		=> __( 'Optional text after category title', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'wpautop_after_cat'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Automatically add paragraph line breaks.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						),
					), // end Category Page Title
				
				// Tag Page Title
				'tag_title' => array(
					'meta_box' 	=> array(
						'title'		=> __( 'Tag Page Title', 'childtheme' ),
						'context'	=> 'normal',
						'priority'	=> 'core',
						'desc'		=> __( 'Display options for a tag archive page.', 'childtheme' ),
						'save_all_settings' => __( 'Save all Settings', 'childtheme' ),
						),
					'settings' => array(
						'tag_show'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display tag title', 'childtheme' ),
							'val' 			=> 'on',
							'desc'			=> __( 'Will display the following settings above the archive list of posts.', 'childtheme' ),
							),
						'tag_title'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Display tag title', 'childtheme' ),
							'val' 			=> __( 'Tag: %tag_name%', 'childtheme' ),
							'desc'			=> __( '%tag_name% will be swapped out with current tag "Term Name"', 'childtheme' ),
							),
						'tag_desc'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display tag description', 'childtheme' ),
							'val' 			=> 'on',
							'desc'			=> false,
							),
						'before_tag_show'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display optional text above tag title.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						'before_tag_text'	=> array(
							'type'			=> 'simple_text_editor',
							'validation'	=> 'textarea',
							'title' 		=> __( 'Optional text above tag title', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'wpautop_before_tag'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Automatically add paragraph line breaks.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						'after_tag_show'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display optional text below tag title.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						'after_tag_text'	=> array(
							'type'			=> 'simple_text_editor',
							'validation'	=> 'textarea',
							'title' 		=> __( 'Optional text after tag title', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'wpautop_after_tag'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Automatically add paragraph line breaks.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						),
					), // end Tag Page Title
				
				// Date Archive Page Title
				'date_archive_title' => array(
					'meta_box' 	=> array(
						'title'		=> __( 'Date Archive Page Title', 'childtheme' ),
						'context'	=> 'normal',
						'priority'	=> 'core',
						'desc'		=> __( 'Display options for a date archive archive page.', 'childtheme' ),
						'save_all_settings' => __( 'Save all Settings', 'childtheme' ),
						),
					'settings' => array(
						'date_archive_show'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display date archive title', 'childtheme' ),
							'val' 			=> 'on',
							'desc'			=> __( 'Will display the following settings above the archive list of posts.', 'childtheme' ),
							),
						'date_archive_title'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Display date archive title', 'childtheme' ),
							'val' 			=> __( 'Date Archive: %date_archive_name%', 'childtheme' ),
							'desc'			=> __( '%date_archive_name% will be swapped out with current date_archive "Term Name"', 'childtheme' ),
							),
						'before_date_archive_show'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display optional text above date archive title.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						'before_date_archive_text'	=> array(
							'type'			=> 'simple_text_editor',
							'validation'	=> 'textarea',
							'title' 		=> __( 'Optional text above date archive title', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'wpautop_before_date_archive'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Automatically add paragraph line breaks.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						'after_date_archive_show'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display optional text below date archive title.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						'after_date_archive_text'	=> array(
							'type'			=> 'simple_text_editor',
							'validation'	=> 'textarea',
							'title' 		=> __( 'Optional text after date archive title', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'wpautop_after_date_archive'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Automatically add paragraph line breaks.', 'childtheme' ),
							'val' 			=> false,
							'desc'			=> false,
							),
						),
					), // end Date Archive Page Title
				
				// Search Title &amp; Page Settings
				'search' => array(
					'meta_box' 	=> array(
						'title'		=> __( 'Search Title &amp; Page Settings', 'childtheme' ),
						'context'	=> 'normal',
						'priority'	=> 'core',
						'desc'		=> false,
						'save_all_settings' => __( 'Save all Settings', 'childtheme' ),
						),
					'settings' => array(
						'results_title'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Search results title', 'childtheme' ),
							'val' 			=> __( 'Showing results for: %search_term%', 'childtheme' ),
							'desc'			=> __( '%search_term% will be swapped out with current search "Term Name"', 'childtheme' ),
							),
						'results_explain'	=> array(
							'type'			=> 'simple_text_editor',
							'validation'	=> 'textarea',
							'title' 		=> __( 'Search results explanation', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Give a brief text explanation about general search results', 'childtheme' ),
							),
						'noresults_title'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'No results title', 'childtheme' ),
							'val' 			=> __( 'No results found for: %search_term%', 'childtheme' ),
							'desc'			=> __( '%search_term% will be swapped out with current search "Term Name"', 'childtheme' ),
							),
						'noresults_explain'	=> array(
							'type'			=> 'simple_text_editor',
							'validation'	=> 'textarea',
							'title' 		=> __( 'No results explanation', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Give a brief text explanation about no search results', 'childtheme' ),
							),
						'search_form'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display search form', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'list_pages_on_search'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display a list of pages', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Will display a list of site pages, when there are no results to display.', 'childtheme' ),
							),
						'list_cats_on_search'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display a list of categories', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Will display a list of site categories, when there are no results to display.', 'childtheme' ),
							),
						'list_post_by_cat_on_search'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display a list of posts by category', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Will display a list of posts by category, when there are no results to display.', 'childtheme' ),
							),
						),
					), // end search
				
				// 404 Title &amp; Page Settings
				'_404' => array(
					'meta_box' 	=> array(
						'title'		=> __( '404 Page Title &amp; Page Settings', 'childtheme' ),
						'context'	=> 'normal',
						'priority'	=> 'core',
						'desc'		=> false,
						'save_all_settings' => __( 'Save all Settings', 'childtheme' ),
						),
					'settings' => array(
						'_404title'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Page title', 'childtheme' ),
							'val' 			=> __( '404 Not Found', 'childtheme' ),
							'desc'			=> false,
							),
						'_404explain'	=> array(
							'type'			=> 'simple_text_editor',
							'validation'	=> 'textarea',
							'title' 		=> __( '404 page explanation', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Give a brief text explanation about general 404 results', 'childtheme' ),
							),
						'search_form'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display search form', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> false,
							),
						'list_pages_on_404'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display a list of pages', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Will display a list of site pages on the 404 page.', 'childtheme' ),
							),
						'list_cats_on_404'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display a list of categories', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Will display a list of site categories on the 404 page.', 'childtheme' ),
							),
						'list_post_by_cat_on_404'	=> array(
							'type'			=> 'checkbox',
							'validation'	=> 'checkbox',
							'title' 		=> __( 'Display a list of posts by category', 'childtheme' ),
							'val' 			=> '',
							'desc'			=> __( 'Will display a list of posts by category on the 404 page.', 'childtheme' ),
							),
						),
					), // end 404
				
				// Password Settings
				'password_protected' => array(
					'meta_box' 	=> array(
						'title'		=> __( 'Password Protected', 'childtheme' ),
						'context'	=> 'normal',
						'priority'	=> 'core',
						'desc'		=> __( 'These settings apply to all content that has been password protected.', 'childtheme' ),
						'save_all_settings' => __( 'Save all Settings', 'childtheme' ),
						),
					'settings' => array(
						'welcome_text'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Welcome Text for the password from.', 'childtheme' ),
							'val' 			=> __( 'This post is password protected. To view it please enter your password below:', 'childtheme' ),
							),
						'label_text'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Password field label text', 'childtheme' ),
							'val' 			=> __( 'Enter the Password Here:', 'childtheme' ),
							),
						'submit_text'	=> array(
							'type'			=> 'text',
							'validation'	=> 'text',
							'title' 		=> __( 'Submit button text', 'childtheme' ),
							'val' 			=> __( 'Submit', 'childtheme' ),
							),
						),
					), // end password_protected
					
				), // end options

			) ); // end var $default_options = array()
		
		create__options_page( $this->default_options );
		
	} // end function default_options
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_version
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_version() {
		
		if ( false === $this->existing_version ) {
			$this->set( 'have_existing_version', 0 );
		} else {
			$this->set( 'have_existing_version', 1 );
		}
		
		return $this->have_existing_version;
		
	} // end function have_version
	
	
	
	
	
	
	/**
	 * have_options
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_options() {
		
		if ( isset( $this->options ) AND is_array( $this->options ) AND ! empty( $this->options )  ) {
			$this->set( 'have_options', 1 );
		} else {
			$this->set( 'have_options', 0 );
		}
		
		return $this->have_options;
		
	} // end function have_options
	
	
	
} // end class ParentThemeOptionsVCWP