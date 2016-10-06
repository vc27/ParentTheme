<?php
/**
 * @package WordPress
 * @subpackage ThemeWP
 * 
 **/
#################################################################################################### */







/**
 * Initiate Library
 **/
require_once( 'includes/initiate-lib.php' );






/**
 * ParentTheme Class
 **/
$ParentTheme = new ParentTheme();
$ParentTheme->initParentTheme();
class ParentTheme {



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
	 * Sidebar Args
	 *
	 * @access public
	 * @var array
	 **/
	var $sidebar_args = array(
		'before_widget' => '<div id="%1$s" class="widget-box %2$s">'
		,'after_widget' => '</div>'
		,'before_title' => '<div class="h3 widget-title"><span class="widget-title-wrap">'
		,'after_title' => '</span></div>'
	);






	/**
 	 * __construct
	 **/
	function __construct() {

		$this->set( 'template_directory', get_template_directory() );
		$this->set( 'template_directory_uri', get_template_directory_uri() );
		$this->set( 'stylesheet_directory_uri', get_stylesheet_directory_uri() );
		$this->set( 'home_url', home_url() );

		add_action( 'admin_menu', array( $this, 'remove_menu_pages' ), 99 );

	} // end function __construct






	/**
	* initParentTheme
	**/
	function initParentTheme() {

		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		add_action( 'init', array( $this, 'init' ) );

	} // end function initParentTheme






	/**
	 * set
	 **/
	 function set( $key, $val = false ) {

		 if ( isset( $key ) AND ! empty( $key ) ) {
			 $this->$key = $val;
		 }

	 } // end function set






	/**
	 * after_setup_theme
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

		if ( ! is_child_theme() ) {

			add_image_size( 'standard', 300, 300, false );
			add_image_size( 'medium', 600, 1000, false );
			add_image_size( 'large', 1000, 2000, false );
			add_image_size( 'large-ex', 2000, 4000, false );

			add_theme_support( 'acf-theme-options' );
		}

		$this->loadThemeSupports();

	} // end function after_setup_theme






	/**
	 * loadThemeSupports
	 **/
	function loadThemeSupports() {

		require_once( "includes/theme-supports/initiate.php" );

	} // end function loadThemeSupports






	/**
	 * init
	 **/
	function init() {

		$this->remove_comments();
		add_action( 'admin_menu', array( $this, 'remove_menu_pages' ), 99 );

		add_filter( 'widget_text', 'do_shortcode' );
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wp_generator');



		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_localize_script' ), 9 );



		add_filter( 'post_class', array( $this, 'post_class' ) );
		add_filter( 'gallery_style', array( $this, 'remove_gallery_css' ) );



		add_action( 'wp_head', array( $this, 'wp_head' ) );
		add_action( 'wp_footer', array( $this, 'wp_footer' ) );
		add_action( 'after_body_tag', array( $this, 'after_body_tag' ) );



		add_filter( 'protected_title_format', array( $this, 'title_format' ) );
		add_filter( 'private_title_format', array( $this, 'title_format' ) );



		add_filter( 'login_headerurl', array( $this, 'login_headerurl' ) );
		add_filter( 'login_headertitle', array( $this, 'login_headertitle' ) );



		// Load parent theme as primary theme
		if ( ! is_child_theme() ) {
			$this->loadParentTheme();
		}



	} // end function init






	/**
	 * loadParentTheme
	 **/
	function loadParentTheme() {

		$this->pt__register_style_and_scripts();

		add_action( 'wp_enqueue_scripts', array( $this, 'pt__wp_enqueue_scripts' ), 1 );
		add_action( 'template_redirect', array( $this, 'pt__layout_options' ) );

		$this->register_sidebars( array(
			'Primary Sidebar' => array(
				'desc' => __( 'This is the primary widgetized area.', 'parenttheme' ),
			)
		) );

		register_nav_menus( array(
			'primary-menu' => __( 'Primary Menu Navigation', 'parenttheme' ),
			'footer-menu' => __( 'Footer Menu Navigation', 'parenttheme' )
		) );

	} // end function loadParentTheme






	####################################################################################################
	/**
	 * init
	 **/
	####################################################################################################






	/**
	 * remove_comments
	 **/
	function remove_comments() {

		// remove all public post type comments
		if ( get__option( '_comment_system_deactivated' ) ) {
			$get_post_types = get_post_types( array( 'public' => true ) );
			foreach ( $get_post_types as $post_type ) {
				remove_post_type_support( $post_type, 'comments' );
			}
		}

		// remove all page post type comments
		if ( get__option( '_comments_page_deactivated' ) ) {
			remove_post_type_support( 'page', 'comments' );
		}

	} // end remove_comments






	/**
	 * remove_menu_pages
	 **/
	function remove_menu_pages() {

		if ( get__option( '_comment_system_deactivated' ) ) {
			remove_menu_page( 'edit-comments.php' );
		}

	} // end remove_menu_pages






	/**
	 * wp_enqueue_scripts
	 **/
	function wp_enqueue_scripts() {

		if ( is_singular() AND get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	} // function wp_enqueue_scripts






	/**
	 * wp_localize_script
	 **/
	function wp_localize_script() {

		$array = array(
			'stylesheet_directory_uri' => $this->stylesheet_directory_uri,
			'template_directory_uri' => $this->template_directory_uri,
			'home_url' => $this->home_url,
		);

		wp_localize_script(
			apply_filters( 'parenttheme-localize_script-handle', 'jquery' ),
			'siteObject',
			apply_filters( 'parenttheme-localize_script', $array )
		);

	} // end function wp_localize_script






	/**
	 * post_class
	 **/
	function post_class( $classes ) {
		global $post;

		if ( has_post_thumbnail( $post->ID ) ) {
			$classes[] = 'has-post-thumbnail';
		}

		return $classes;

	} // end function post_class






	/**
	 * remove_gallery_css
	 **/
	function remove_gallery_css( $css ) {

		return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );

	} // end function remove_gallery_css






	/**
	 * wp_head
	 **/
	function wp_head() {

		// Favicon
		$favicon_url = "/favicon.ico";
		if ( get__option( '_use_custom_favicon' ) ) {
			$favicon_url = get__option( '_favicon_image_url' );
		}
		echo "\n<link rel=\"icon\" href=\"$favicon_url\" type=\"image/x-icon\" />\n";

		// General Options Header textarea
		if ( get__option( '_head_html' ) ) {
			echo "\n<!-- " . __( 'Start Theme Header', 'parenttheme' ) . " -->\n" . get__option( '_head_html' ) . "\n<!-- " . __( 'End Theme Header', 'parenttheme' ) . " -->\n";
		}

	} // end function wp_head






	/**
	 * wp_footer
	 **/
	function wp_footer() {

		if ( get__option( '_footer_html' ) ) {
			echo "\n<!-- " . __( 'Start Theme Footer', 'parenttheme' ) . " -->\n" . get__option( '_footer_html' ) . "\n<!-- " . __( 'End Theme Footer', 'parenttheme' ) . " -->\n";
		}

	} // end function wp_footer






	/**
	 * after_body_tag
	 **/
	function after_body_tag() {

		if ( get__option( '_after_opening_body_tag' ) ) {
			echo get__option( '_after_opening_body_tag' );
		}

	} // end function after_body_tag






	/**
	 * title_format
	 **/
	function title_format() {

		return '%s';

	} // end function title_format






	/**
	 * Changing the login page URL
	 **/
	function login_headerurl() {

		return $this->home_url;

	} // end function login_headerurl






	/**
	 * Changing the login page URL hover text
	 **/
	function login_headertitle() {

		return get_bloginfo( 'title' );

	} // end function login_headertitle






	####################################################################################################
	/**
	 * Utility
	 **/
	####################################################################################################






	/**
	 * register_sidebars
	 **/
	function register_sidebars( $sidebars = array() ) {

		// Register Sidebars
		foreach ( $sidebars as $name => $info ) {

			$id = sanitize_title_with_dashes( $name );

			$args = apply_filters( 'parenttheme-register_sidebars', array(
				'name' => $name
				,'id' => $id
				,'description' => $info['desc']
				,'before_widget' => $this->sidebar_args['before_widget']
				,'after_widget' => $this->sidebar_args['after_widget']
				,'before_title' => $this->sidebar_args['before_title']
				,'after_title' => $this->sidebar_args['after_title']
			) );

			register_sidebar( $args );

		} // endforeach; register sidebars

	} // end function register_sidebars






	####################################################################################################
	/**
	 * If parent theme is being used with out a child theme
	 **/
	####################################################################################################






	/**
	 * pt__register_style_and_scripts
	 **/
	function pt__register_style_and_scripts() {

		wp_register_style( 'parent-theme-default', "$this->template_directory_uri/css/style.css" );
		wp_register_script( 'parent-theme-js', "$this->template_directory_uri/js/siteScripts.js", array( 'jquery' ) );

	} // end function pt__register_style_and_scripts






	/**
	 * pt__wp_enqueue_scripts
	 **/
	function pt__wp_enqueue_scripts() {

		wp_enqueue_style( 'parent-theme-default' );
		wp_enqueue_script( 'parent-theme-js' );

	} // end function pt__wp_enqueue_scripts






	/**
	 * pt__layout_options
	 **/
	function pt__layout_options() {

		// Archive Post Navigation
		add_action( 'after-loop', 'previous_next___posts_link' );

		// Single Post Navigation
		add_action( 'after-loop', 'previous_next___post_link' );

		// Add Page Title
		add_action( 'before-loop', 'archive__title' );


	} // end function pt__layout_options



} // end class ParentTheme
