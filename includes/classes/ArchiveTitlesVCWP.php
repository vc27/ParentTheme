<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since 0.0.0
 **/
####################################################################################################





/**
 * ArchiveTitlesVCWP
 * @since 0.0.0
 **/
class ArchiveTitlesVCWP {
	
	
	
	/**
	 * options
	 * 
	 * @access public
	 * @var string
	 * @since 0.0.0
	 * Description: available options based on type
	 **/
	var $options = array(
		'category' => array(
			'name' => 'category_title'
			,'show' => 'cat_show'
			,'title' => 'cat_title'
			,'show_desc' => 'cat_desc'
		)
		,'tag' => array(
			'name' => 'tag_title'
			,'show' => 'tag_show'
			,'title' => 'tag_title'
			,'show_desc' => 'tag_desc'
		)
		,'author' => array(
			'name' => 'author_title'
			,'show' => 'author_show'
			,'title' => 'author_title'
			,'show_desc' => 'author_bio'
		)
		,'date' => array(
			'name' => 'date_archive_title'
			,'show' => 'date_archive_show'
			,'title' => 'date_archive_title'
			,'show_desc' => false
		)
	);
	
	
	
	/**
	 * option_group
	 * 
	 * @access public
	 * @var string
	 * @since 0.0.0
	 * Description: current option being displayed
	 **/
	var $option_group = false;
	
	
	
	/**
	 * description
	 * 
	 * @access public
	 * @var string
	 * @since 0.0.0
	 * Description: Term description
	 **/
	var $description = false;
	
	
	
	/**
	 * errors
	 * 
	 * @access public
	 * @var array
	 * @since 0.0.0
	 **/
	var $errors = array();
	
	
	
	/**
	 * have_errors
	 * 
	 * @access public
	 * @var bool
	 * @since 0.0.0
	 **/
	var $have_errors = 0;
	
	
	
	
	
	
	/**
	 * __construct
	 * @since 0.0.0
	 **/
	function __construct() {

	} // end function __construct
	
	
	
	
	
	
	/**
	 * set
	 * @since 0.0.0
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set
	
	
	
	
	
	
	/**
	 * error
	 * @since 0.0.0
	 **/
	function error( $error_key ) {
		
		$this->errors[] = $error_key;
		
	} // end function error
	
	
	
	
	
	
	/**
	 * get
	 * @since 0.0.0
	 **/
	function get( $key ) {
		
		if ( isset( $key ) AND ! empty( $key ) AND isset( $this->$key ) AND ! empty( $this->$key ) ) {
			return $this->$key;
		} else {
			return false;
		}
		
	} // end function get
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * get_title
	 * @since 0.0.0
	 **/
	function get_title( $args = array() ) {
		
		$this->set_type();
		$this->set_option_group();
		if ( ! get__option( $this->option_group['name'], $this->option_group['show'] ) ) {
			return false;
		}
		
		global $wp_query;
		$defaults = array(
			'class' => '',
			'echo' => 1,
		);
		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );
		
		$this->set_the_title();
		$this->set_description();


		$output = "<div class=\"archive-title $class\">";
		
			$output .= "<h1>$this->the_title</h1>";
			
			if ( $this->have_description() ) {
				$output .= "<div class=\"entry\">";
					$output .= wpautop( $this->description );
				$output .= '</div>';
			}
			
		$output .= '</div>';
		
		
		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}


	} // end function get_title
	
	
	
	
	
	
	/**
	 * set_type
	 * @since 0.0.0
	 **/
	function set_type() {

		if ( is_category() ) {
			$this->set( 'type', 'category' );
		} else if ( is_tag() ) {
			$this->set( 'type', 'tag' );
		} else if ( is_author() ) {
			$this->set( 'type', 'author' );
		} else if ( ( is_day() OR is_month() OR is_year() ) ) {
			$this->set( 'type', 'date' );
		} else {
			return false;
		}


	} // end function set_type 
	
	
	
	
	
	
	/**
	 * set_option_group
	 * @since 0.0.0
	 **/
	function set_option_group() {

		$this->set( 'option_group', $this->options[$this->type] );

	} // end function set_option_group
	
	
	
	
	
	
	/**
	 * set_the_title
	 * @since 0.0.0
	 **/
	function set_the_title() {
		
		$this->set( 'the_title', get__option( $this->option_group['name'], $this->option_group['title'] ) );
		
	} // end function set_the_title
	
	
	
	
	
	
	/**
	 * set_description
	 * @since 0.0.0
	 **/
	function set_description() {
		
		if ( get__option( $this->option_group['name'], $this->option_group['show_desc'] ) ) {
			switch ( $this->type ) {
				case "category" :
					$this->set( 'description', $wp_query->queried_object->category_description );
					break;
			}
		}
		
	} // end function set_description
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_errors
	 * @since 0.0.0
	 **/
	function have_errors() {
		
		if ( isset( $this->errors ) AND ! empty( $this->errors ) AND is_array( $this->errors ) ) {
			$this->set( 'have_errors', 1 );
		} else {
			$this->set( 'have_errors', 0 );
		}
		
		return $this->have_errors;
		
	} // end function have_errors 
	
	
	
	
	
	
	/**
	 * have_description
	 * @since 0.0.0
	 **/
	function have_description() {
		
		if ( isset( $this->description ) AND ! empty( $this->description ) AND get__option( 'category_title', 'cat_desc' ) ) {
			$this->set( 'have_description', 1 );
		} else {
			$this->set( 'have_description', 0 );
		}
		
		return $this->have_description;
		
	} // end function have_description
	
	
	
} // end class ArchiveTitlesVCWP