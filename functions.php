<?php
/**
 * File Name functions.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 4.3
 * @updated 10.17.13
 *
 * Description:
 * Include core functionality, activation and theme functions.
 **/
#################################################################################################### */






/**
 * Initiate Library
 **/
require_once( 'includes/initiate-lib.php' );






/**
 * ParentTheme_VC Class
 * 
 * @version 2.2
 * @updated 10.17.13
 * @uses ParentTheme_VC
 **/
$ParentTheme_VC = new ParentTheme_VC();
$ParentTheme_VC->init_parent_theme();
class ParentTheme_VC {
	
	
	
	/**
	 * template_directory
	 * 
	 * @access public
	 * @var string
	 **/
	var $template_directory = null;



    /**
     * $template_directory_uri
     *
     * @access public
     * @var string
     **/
    var $template_directory_uri = null;



    /**
     * filter_name__register_sidebars
     *
     * @access public
     * @var string
     **/
    var $filter_name__register_sidebars = 'register_sidebars_vc';
	
	
	
	/**
	 * filter_name__register_sidebars
	 * 
	 * @access public
	 * @var string
	 **/
	var $filter_name__parenttheme_localize_script = 'parenttheme-localize_script';
	
	
	
	/**
	 * filter_name__parenttheme_localize_script__handle
	 * 
	 * @access public
	 * @var string
	 **/
	var $filter_name__parenttheme_localize_script__handle = 'parenttheme-localize_script-handle';
	
	
	
	/**
	 * filter_name__sidebar_args
	 * 
	 * @access public
	 * @var string
	 **/
	var $filter_name__sidebar_args = 'parenttheme-sidebar_args';
	
	
	
	
	/**
	 * Sidebar Args
	 * 
	 * @access public
	 * @var array
	 **/
	var $sidebar_args = array(
		'before_widget' => '<li id="%1$s" class="widget-box %2$s sub_class">',
		'after_widget' => '<span class="clear"></span></li>',
		'before_title' => '<div class="h3 widget-title"><span class="widget-title-wrap">',
		'after_title' => '</span></div>',
	);
	
	
	
	/**
	 * admin_object_name
	 * 
	 * @access public
	 * @var string
	 **/
	var $admin_object_name = 'vcAdminAjax';
	
	
	
	/**
	 * admin_object_action
	 * 
	 * @access public
	 * @var string
	 **/
	var $admin_object_action = 'vc-admin-ajax';






    /**
     * __construct
     *
     * @version 1.0
     * @updated	10.16.13
     **/
    function __construct() {

		$this->set( 'template_directory', get_template_directory() );
		$this->set( 'template_directory_uri', get_template_directory_uri() );
		$this->set( 'stylesheet_directory_uri', get_stylesheet_directory_uri() );
		$this->set( 'home_url', home_url() );

    } // end function __construct
	
	
	
	
	
	
	/**
     * init_parent_theme
     *
     * @version 1.0
     * @updated	10.16.13
     **/
	function init_parent_theme() {
		
		add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );
        add_action( 'init', array( &$this, 'init' ) );
        add_action( 'admin_init', array( &$this, 'admin_init' ) );
        add_action( 'widgets_init', array( &$this, 'widgets_init' ) );
		
	} // end function init_parent_theme






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
	 * after_setup_theme
	 *
	 * @version 1.1
	 * @updated	10.17.13
	 **/
	function after_setup_theme() {
		
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(
            get_option( 'thumbnail_size_w' ),
            get_option( 'thumbnail_size_h' ),
            get_option( 'thumbnail_crop' )
        );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'nav-menus' );
		
		// Translations can be added to the /languages/ directory.
		// load_theme_textdomain( 'parenttheme', "$this->template_directory/languages" );
		
	} // end function after_setup_theme
	
	
	
	
	
	
	/**
	 * init
	 *
	 * @version 1.6
	 * @updated	10.17.13
	 **/
	function init() {
		
		/**
		 * Enqueue
		 **/
		
		// register styles and scripts
		$this->register_style_and_scripts();
		
		// Remove Comments
		$this->remove_comments();
		
		
		/**
		 * Shortcodes
		 **/
		
		// Add Options as Shortcodes
		$this->shortcode_theme_options();
		
		// Add Shortcode recognition to text widget
		add_filter( 'widget_text', 'do_shortcode' );

		
		/**
		 * Remove Actions
		 **/
		
		// WP Head
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wp_generator');
		
		
		/**
		 * Front End - Enqueue, Print & other menial labor
		 * 
		 * http://codex.wordpress.org/Plugin_API/Action_Reference
		 **/
		
		// Javascripts // wp_enqueue_scripts // wp_print_scripts
		add_action( 'wp_enqueue_scripts', array( &$this, 'wp_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( &$this, 'wp_localize_script' ), 1 );
		
		// Remove version from javascript and css file enqueue
		add_filter( 'script_loader_src', array( &$this, 'remove_src_version' ) );
		add_filter( 'style_loader_src', array( &$this, 'remove_src_version' ) );
		
		
		// Filter Classes
		add_filter( 'body_class', array( &$this, 'body_class' ) );
		add_filter( 'post_class', array( &$this, 'post_class' ) );
		
		
		// WP Head
		add_action( 'wp_head', array( &$this, 'wp_head' ) );
		
		// WP Footer
		add_action( 'wp_footer', array( &$this, 'wp_footer' ) );
        if ( is_user_logged_in() ) {
            add_action( 'wp_footer', array( &$this, 'query_info' ), 100 );
        }
		
		
		// Password Form --> to be removed
		add_filter( 'the_password_form', array( &$this, 'the_password_form' ) );
		
		// Title filters
		add_filter( 'protected_title_format', array( &$this, 'title_format' ) );
		add_filter( 'private_title_format', array( &$this, 'title_format' ) );
		
		// Remove post gallery_style --> still needed?
		add_filter( 'gallery_style', array( &$this, 'remove_gallery_css' ) );
		
		
		// Login Filters
		add_filter( 'login_headerurl', array( &$this, 'login_headerurl' ) );
		add_filter( 'login_headertitle', array( &$this, 'login_headertitle' ) );
		
		
		/**
		 * Do ParentTheme
		 **/
		if ( ! is_child_theme() ) {
			
			// CSS // wp_print_styles
			add_action( 'wp_print_styles', array( &$this, 'wp_print_styles' ), 1 );
			
			// register_sidebars
			$this->register_sidebars( array(
				'Primary Sidebar' => array(
					'desc' => __( 'This is the primary widgetized area.', 'parenttheme' ),
					),
				) );

			// register_nav_menus
			register_nav_menus( array(
				'primary-navigation' => __( 'Primary Navigation', 'parenttheme' ),
				'footer-navigation' => __( 'Footer Navigation', 'parenttheme' )
				) );
			
			
			// Layout Options
			add_action( 'template_redirect', array( &$this, 'layout_options' ) );
			
			add_action( 'wp_loaded', array( &$this, 'breadcrumb_navigation' ) );
			
		} // end if ( ! is_child_theme() )
		
	} // end function init
	
	
	
	
	
	
	/**
	 * admin_init
	 *
	 * @version 1.2
	 * @updated	10.17.13
	 **/
	function admin_init() {
		
		$this->set( 'admin_ajaxurl', admin_url( 'admin-ajax.php' ) );
		
		/**
		 * Enqueue
		 **/
		
		// register styles and scripts
		$this->admin_register_scripts_and_css();
		
		// admin css
		add_action( 'admin_print_styles', array( &$this, 'admin_print_styles' ) );
		
		// admin js
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) );
		
		// Filter Admin body class
		add_filter( 'admin_body_class', array( &$this, 'admin_body_class' ) );
		
		
		/**
		 * Admin Modifiers
		 **/
		
		// Add Custom Meta Boxes
		add_action( 'add_meta_boxes', array( &$this, 'add_custom_meta_boxes' ) );
		
	} // end function admin_init 
	
	
	
	
	
	
	/**
	 * admin_init
	 *
	 * @version 1.0
	 * @updated	11.17.12
	 **/
	function widgets_init() {
		
		register_widget( 'LatestPostWidgetVCWP' );
		register_widget( 'PageWidgetVCWP' );
		
	} // end function widgets_init
	
	
	
	
	
	
	/**
	 * Set Options
	 * 
	 * @version 1.3
	 * @updated 11.17.12
	 *
	 * Description:
	 * For utility purposes. This function does not run automatically.
	 **/
	function set_options() {
		
		// Set Options
		$this->set( 'option_name', '_vc_general_options' );
		$this->set( 'option_group', 'vc_general_options' );
		$this->set( 'options', get_option( $this->option_name ) );
		
	} // function set_options
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Admin Register, Enqueue & Other
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Admin Register Scripts and CSS
	 * 
	 * @version 1.4
	 * @updated 11.17.12
	 **/
	function admin_register_scripts_and_css() {
		
		// admin css
		wp_register_style( 'parenttheme-admin-default', "$this->template_directory_uri/includes/css/admin-style.css" );
		
		// admin js
		wp_register_script( 'parenttheme-admin-custom', "$this->template_directory_uri/includes/js/admin-custom.js", array( 'jquery', 'media-upload', 'thickbox', 'jquery-ui-sortable' ), '', true );
		
	} // end function admin_register_scripts_and_css
	
	
	
	
	
	
	/**
	 * Admin CSS
	 * 
	 * @version 1.3
	 * @updated 1.17.12
	 **/
	function admin_print_styles() {
		
		wp_enqueue_style( 'parenttheme-admin-default' );

	} // function admin_print_styles
	
	
	
	
	
	
	/**
	 * Admin Enqueue Scripts
	 *
	 * @version 1.2
	 * @updated	11.17.12
	 **/
	function admin_enqueue_scripts() {

        // wp_localize_script( $handle, $this->admin_object_name, $l10n )
		wp_localize_script(
            'parenttheme-admin-custom',
			$this->admin_object_name,
            apply_filters( 'parenttheme-admin-localize-script', array(
			    'ajaxurl' => $this->admin_ajaxurl,
			    'action' => $this->admin_object_action,
		    ) )
        );
		
		wp_enqueue_script( 'parenttheme-admin-custom' );

	} // end function admin_enqueue_scripts
	
	
	
	
	
	
	/**
	 * Add Custom Fields Meta Boxes
	 * 
	 * @version 1.3
	 * @updated 11.17.12
	 * @uses add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );
	 **/
	function add_custom_meta_boxes( $post ) {

		add_meta_box( 'postexcerpt', 'Excerpt', 'post_excerpt_meta_box', 'page', 'normal', 'core' );

	} // end function add_custom_meta_boxes
	
	
	
	
	
	
	/**
	 * Filter Admin body class
	 * 
	 * Add a post_type class to the admin body element. Helpful when styling custom post types.
	 * 
	 * @version 1.2
	 * @updated 11.17.12
	 **/
	function admin_body_class( $admin_body_class ) {
		global $post;

		if ( isset( $_GET['post_type'] ) AND $_GET['post_type'] ) {
			$post_type = $_GET['post_type'];
		} else if ( isset( $post->post_type ) AND $post->post_type ) {
			$post_type = $post->post_type;
		} else {
			$post_type = false;
		}

		if ( $post_type ) {
			$admin_body_class = "$admin_body_class post_type-$post_type";
		}

		return $admin_body_class;

	} // end function admin_body_class
	
	
	
	
	
	
	/**
	 * Changing the login page URL
	 * 
	 * @version 0.1
	 * @updated 11.18.12
	 **/
	function login_headerurl() {
		
		return $this->home_url;
		
	} // end function login_headerurl
	
    




	/**
	 * Changing the login page URL hover text
	 * 
	 * @version 0.1
	 * @updated 11.18.12
	 **/
	function login_headertitle() {
		
		return get_bloginfo( 'title' );
		
	} // end function login_headertitle
	
	
	
	
	
	
	/**
	 * remove_src_version
	 * 
	 * @version 1.0
	 * @updated 01.17.14
	 **/
	function remove_src_version( $src ) {
      global $wp_version;

	  $version_str = '?ver='.$wp_version;
	  $version_str_offset = strlen( $src ) - strlen( $version_str );

	  if( substr( $src, $version_str_offset ) == $version_str )
	    return substr( $src, 0, $version_str_offset );
	  else
	    return $src;

	} // end function remove_src_version
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Front End Register, Enqueue & Other
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Register Styles and Scripts
	 *
	 * @version 2.1
	 * @updated	10.20.13
	 **/
	function register_style_and_scripts() {
		
		/**
		 * CSS
		 **/
		
		// Reset CSS
		wp_register_style( 'parenttheme-reset', "$this->template_directory_uri/css/reset.css" );
		
		wp_register_style( 'bootstrap-responsive', "$this->template_directory_uri/css/bootstrap-responsive.css" );
		
		
		/**
		 * Do ParentTheme
		 **/
		if ( ! is_child_theme() ) {
			// Default CSS
			wp_register_style( 'parenttheme-default', "$this->template_directory_uri/css/default.css" );

			// Style CSS
			wp_register_style( 'parenttheme-style', "$this->template_directory_uri/style.css", array( 'parenttheme-default' ) );
		}
		
		
		
		/**
		 * JS
		 **/
		
		// Modernizr, Mobile boilerplate helper functions, Respond
		wp_register_script( 'helper', "$this->template_directory_uri/js/compiled-scripts-ck.js", array( 'jquery' ) );
		
	} // end function register_style_and_scripts 
	
	
	
	
	
	
	/**
	 * shortcode_theme_options
	 *
	 * @version 1.3
	 * @updated 11.17.12
	 **/
	function shortcode_theme_options() {
		
		$tags = array( 'copyright', 'street', 'city', 'state', 'zip', 'office', 'cell', 'fax', 'email', 'contact_text' );
		
		foreach ( $tags as $tag ) {
			add_shortcode( "contact_$tag", array( &$this, "shortcode_$tag" ) );
		}
		
		add_shortcode( "clear", array( &$this, "shortcode_clear" ) );
		
	} // end function shortcode_theme_options
	
	
	
	
	
	
	/**
	 * shortcode functions
	 *
	 * @version 1.3
	 * @updated 11.18.12
	 **/
	function shortcode_copyright() { return get_vc_option( 'contact', 'copyright' ); }
	function shortcode_street() { return get_vc_option( 'contact', 'street' ); }
	function shortcode_city() { return get_vc_option( 'contact', 'city' ); }
	function shortcode_state() { return get_vc_option( 'contact', 'state' ); }
	function shortcode_zip() { return get_vc_option( 'contact', 'zip' ); }
	function shortcode_office() { return get_vc_option( 'contact', 'office' ); }
	function shortcode_cell() { return get_vc_option( 'contact', 'cell' ); }
	function shortcode_fax() { return get_vc_option( 'contact', 'fax' ); }
	function shortcode_email() { return get_vc_option( 'contact', 'email' ); }
	function shortcode_contact_text() { return get_vc_option( 'contact', 'contact_text' ); }
	function shortcode_clear() { return "<span class=\"clear span-clear\"></span>"; }
	
	
	
	
	
	
	/**
	 * Register Sidebars
	 * 
	 * @version 1.3
	 * @updated 11.17.12
	 **/
	function register_sidebars( $sidebars = array(), $sidebar_args = 'depreciated' ) {
		
		$this->set( 'sidebar_args', apply_filters( $this->filter_name__sidebar_args, $this->sidebar_args ) );
		
		// Register Sidebars
		foreach ( $sidebars as $name => $info ) {

			$id = sanitize_title_with_dashes( $name );
			
			$args = apply_filters( $this->filter_name__register_sidebars, array(
				'name' => $name,
				'id' => $id,
				'description' => $info['desc'],
				'before_widget' => $this->sidebar_args['before_widget'],
				'after_widget' => $this->sidebar_args['after_widget'],
				'before_title' => $this->sidebar_args['before_title'],
				'after_title' => $this->sidebar_args['after_title'],
				) );

			register_sidebar( $args );

		} // endforeach; register sidebars

	} // end function register_sidebars
	
	
	
	
	
	
	/**
	 * remove_comments
	 *
	 * @version 1.2
	 * @updated	11.17.12
	 **/ 
	function remove_comments() {
		
		if ( get_vc_option( 'comments', 'remove_comments' ) ) {
			
			$get_post_types = get_post_types( array( 'public' => true ) );
			
			foreach ( $get_post_types as $post_type ) {
				remove_post_type_support( $post_type, 'comments' );
			}
			
		}
		
	} // end remove_comments
	
	
	
	
	
	
	/**
	 * wp_print_styles
	 *
	 * @version 0.0.6
	 * @updated	05.21.12
	 **/
	function wp_print_styles() {
		
		wp_enqueue_style( 'parenttheme-reset' );
		wp_enqueue_style( 'parenttheme-style' );

	} // end function wp_print_styles
	
	
	
	
	
	
	/**
	 * Enqueue Scripts
	 *
	 * @version 1.8
	 * @updated	10.20.13
	 **/
	function wp_enqueue_scripts() {
		
		// Add Comment reply
		if ( is_singular() AND get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		wp_enqueue_script( 'helper' );
		
		
	} // function wp_enqueue_scripts
	
	
	
	
	
	
	/**
	 * wp_localize_script
	 *
	 * @version 2.1
	 * @updated	10.17.13
	 **/
	function wp_localize_script() {
		
		$array = array(
			'stylesheet_directory_uri' => $this->stylesheet_directory_uri,
			'template_directory_uri' => $this->template_directory_uri,
			'home_url' => $this->home_url,
		);
				
		wp_localize_script( 
			apply_filters( $this->filter_name__parenttheme_localize_script__handle, 'jquery' ), 
			'siteObject', 
			apply_filters( $this->filter_name__parenttheme_localize_script, $array ) 
		);
		
	} // end function filter_localize_script_array
	
	
	
	
	
	
	/**
	 * Body Class
	 *
	 * @version 1.5
	 * @updated	10.17.13
	 **/
	function body_class( $classes ) {
		global $wp_query;
		
		if ( isset( $wp_query->post->post_type ) AND ! empty( $wp_query->post->post_type ) ) {
			$classes[] = "content-post-type-" . $wp_query->post->post_type;
		}
		
		return $classes;
		
	} // end function body_class
	
	
	
	
	
	
	/**
	 * Post Class
	 *
	 * @version 1.1
	 * @updated	10.17.13
	 **/
	function post_class( $classes ) {
		global $post;
		
		if ( has_post_thumbnail( $post->ID ) ) {
			$classes[] = 'has-post-thumbnail';
		}
		
		return $classes;
		
	} // end function post_class
	
	
	
	
	
	
	/**
	 * Add Actions
	 * 
	 * @version 0.0.5
	 * @updated	05.04.12
	 * 
	 * These actions will add various items to the site.
	 * You are free to turn them off or move them around.
	 * 
	 * ToDo: remove apply_filters. add_action is the same thing, 
	 * this is doubling up on an item that does not need it.
	 **/
	function layout_options() {
		
		// Archive Post Navigation
		add_action( 'vc_below_loop', 'vc_navigation_posts' );
		
		// Single Post Navigation
		add_action( 'vc_below_loop', 'vc_navigation_post' );
		
		// Add Page Title
		add_action( 'inner_wrap_top', 'vc_page_title' );


	} // end function layout_options
	
	
	
	
	
	
	/** 
	 * wp_head
	 *
	 * @version 1.6
	 * @updated	08.01.13
	 **/
	function wp_head() {

		// Favicon
		if ( $image = get_vc_option( 'header_footer', 'favicon' ) ) {
			echo "\n<link rel=\"icon\" href=\"$image\" />\n";
		}

		// General Options Header textarea
		if ( $wp_head = get_vc_option( 'header_footer', 'wp_head' ) ) {
			echo "\n<!-- " . __( 'Start Theme Header', 'parenttheme' ) . " -->\n" . html_entity_decode( str_replace( '&#039;', "'", $wp_head ) ) . "\n<!-- " . __( 'End Theme Header', 'parenttheme' ) . " -->\n";
		}

	} // end function wp_head
	
	
	
	
	
	
	/** 
	 * wp_footer
	 *
	 * @version 1.4
	 * @updated	08.01.13
	 **/
	function wp_footer() {

		// General Options Footer Textarea
		if ( $wp_footer = get_vc_option( 'header_footer', 'wp_footer' ) ) {
			echo "\n<!-- " . __( 'Start Theme Footer', 'parenttheme' ) . " -->\n" . html_entity_decode( str_replace( '&#039;', "'", $wp_footer ) ) . "\n<!-- " . __( 'End Theme Footer', 'parenttheme' ) . " -->\n";
		}
		
	} // end function wp_footer
	
	
	
	
	
	
	/**
	 * Password Form, for password protected pages
	 *
	 * @version 0.4
	 * @updated	07.31.12
     *
     * Todo: Remove this function, it's not been utilized for over a year
	 **/
	function the_password_form( $args = '' ) {
		global $wp_query;

		// Set Defaults
		$defaults = array(
			'welcome' => get_vc_option( 'password_protected', 'welcome_text' ),
			'label_id' => 'pwbox-' . $wp_query->post->ID,
			'label_text' => get_vc_option( 'password_protected', 'label_text' ),
			'submit' => get_vc_option( 'password_protected', 'submit_text' ),
			);

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );

		$output = "<form action=\"" . $this->home_url . "/wp-login.php?action=postpass\" method=\"post\">";
			$output .= wpautop( $welcome );
			$output .= "<label for=\"$label_id\">" . __( $label_text ) . " <input class=\"post_password_field\" name=\"post_password\" id=\"$label_id\" type=\"password\" /></label>";
			$output .= "<input class=\"post_password_button\" type=\"submit\" name=\"Submit\" value=\"" . esc_attr__( $submit ) . "\" />";
		$output .= "</form>";

		return $output;

	} // end function the_password_form
	
	
	
	
	
	
	/**
	 * title_format
	 *
	 * @version 1.1
	 * @updated	10.17.13
	 **/
	function title_format() {
		
		return '%s';
	
	} // end function title_format
	
	
	
	
	
	
	/** 
	 * Prints query number and time for query
	 *
	 * @version 1.1
	 * @updated	10.17.13
	 **/
	function query_info() {
		
        echo "\n<!--" . get_num_queries() . ' queries. ';
		    timer_stop(1);
		echo " seconds.-->\n";
	
	} // end function query_info






	/**
	 * remove gallery inline style
	 *
	 * @version 0.0.1
	 * @updated	03.09.12
	 **/
	function remove_gallery_css( $css ) {
		
		return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
		
	} // end function remove_gallery_css
	
	
	
	
	
	
	/** 
	 * Breadcrumb Navigation
	 * 
	 * @version 1.2
	 * @updated 05.30.13
	 **/
	function breadcrumb_navigation() {
		
		if ( ! get_vc_option( 'post_display', 'childpage_breadcrumb' ) ) {
			return;
		} else {
			
			require_once( "Breadcrumb_Navigation_VC.php" );
			
			$this->Breadcrumb_Navigation_VC = new Breadcrumb_Navigation_VC();
			add_action( 'inner_wrap_top', array( &$this->Breadcrumb_Navigation_VC, 'breadcrumb_navigation' ) );
			
		}
		
	} // end function breadcrumb_navigation
	
	
	
} // end class ParentTheme_VC