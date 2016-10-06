<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * 
 **/
####################################################################################################


$ACFThemeOptionsWP = new ACFThemeOptionsWP();
class ACFThemeOptionsWP {



	/**
	 * __construct
	 **/
	function __construct() {

		add_action( 'init', array( $this, 'init' ) );

	} // end function __construct






	/**
	 * init
	 **/
	function init() {

		$this->add_options();

	} // end function init






	/**
	 * add_options
	 **/
	function add_options() {

		if ( function_exists('acf_add_options_sub_page') ) {

			acf_add_options_sub_page( array(
				'title' => 'Theme Options',
				'menu' => 'Theme Options',
				'slug' => 'theme-options',
				'parent' => 'themes.php',
				'capability' => 'manage_options'
			) );

		}

	} // end function add_options



} // end class ACFThemeOptionsWP
